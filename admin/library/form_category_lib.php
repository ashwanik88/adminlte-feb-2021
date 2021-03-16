 <?php checkUserLogin();
 
$document_title = 'Add New Category';
$category_name = '';
$parent_id = '';

$category_id = 0;

if($_GET){
	if(isset($_GET['category_id']) && !empty($_GET['category_id'])){
		$category_id = $_GET['category_id'];
		$document_title = 'Edit Category :: ' . $category_id;
		
		$data_category = getCategory($category_id);
		
		$category_name = $data_category['category_name'];
		$parent_id = $data_category['parent_id'];
	}
	
}
if($_POST){	

	$category_name = $_POST['category_name'];
	$parent_id = $_POST['parent_id'];
	
	if(validate($category_id)){
		if($category_id > 0){	// edit category
			$sql = "UPDATE ". DB_PREFIX ."categories SET category_name='". $category_name ."', parent_id='". $parent_id ."' WHERE category_id='". (int)$category_id ."'";
			
			addAlert('success','Category updated successfully');
			
			
		}else{	// add new category
			$sql = "INSERT INTO ". DB_PREFIX ."categories SET category_name='". $category_name ."', parent_id='". $parent_id ."'";
			addAlert('success','Category added successfully');
		}
		
		mysqli_query($conn, $sql);
		
		
		redirect('manage_categories.php');
	}
}

function alreadyExist($field, $value, $category_id){
	global $conn;
	$sql = "SELECT * FROM ". DB_PREFIX ."categories WHERE ". $field ."='". $value ."' AND category_id!='". $category_id ."'";
	$rs = mysqli_query($conn, $sql);
	if(mysqli_num_rows($rs)){
		return true;
	}
	return false;
}

function validate($category_id){
	$errors = array();
	if(!isset($_POST['category_name']) || empty($_POST['category_name'])){
		array_push($errors, 'Category name is required!');
	}
	
	if(alreadyExist('category_name', $_POST['category_name'], $category_id)){
		array_push($errors, 'Category name already exists!');
	}
	
	// password validation
	
	if(sizeof($errors) == 0){
		return true;
	}else{
		addAlert('danger', implode('<br>', $errors));
		return false;
	}
}

function getCategory($category_id){
	global $conn;
	$sql = "SELECT * FROM ". DB_PREFIX ."categories WHERE category_id='". $category_id ."'";
	$rs = mysqli_query($conn, $sql);
	$data = array();
	if(mysqli_num_rows($rs)){
		$data = mysqli_fetch_assoc($rs);
	}
	return $data;
}
 function getChildren($parent_id){
	 global $conn;
	 $sql = "SELECT * FROM ". DB_PREFIX ."categories WHERE parent_id='". $parent_id ."'";
	 $rs = mysqli_query($conn, $sql);
	 $data_categories = array();
	  if(mysqli_num_rows($rs)){
		while($rec = mysqli_fetch_assoc($rs)){
		 $data_categories[] = $rec;
		}
	}
	return $data_categories;
 }
 function showCategories($category_id, $sep = ''){
	$sub_children = getChildren($category_id); 
	if(sizeof($sub_children)){
			  foreach($sub_children as $child){
				  ?>
	<option value="<?php echo $child['category_id']; ?>"><?php echo $sep . $child['category_name']; ?></option>
 <?php
				  showCategories($child['category_id'], '----'. $sep);
			  }
		  }
 }