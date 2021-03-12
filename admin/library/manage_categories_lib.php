 <?php checkUserLogin();
 
 $document_title = 'Manage Categories';
 if($_POST){
	 if(isset($_POST['category_ids']) && !empty($_POST['category_ids'])){
		 $category_ids = $_POST['category_ids'];
		 foreach($category_ids as $category_id){
			deleteCategory($category_id);
		 }
		 redirect('manage_categories.php');
	 }
 }
 if($_GET){
	 if(isset($_GET['category_id']) && !empty($_GET['category_id'])){
		 $category_id = $_GET['category_id'];
		 deleteCategory($category_id);
		 
		 redirect('manage_categories.php');
	 }
 }
 

 
 
 // $sql = "SELECT * FROM ". DB_PREFIX ."categories WHERE parent_id=0";
 // $rs = mysqli_query($conn, $sql);
 // if(mysqli_num_rows($rs)){
	 // while($rec = mysqli_fetch_assoc($rs)){
		 // $data_categories[] = $rec;
	 // }
 // }

 
 function deleteCategory($category_id){
	global $conn;
	addAlert('success', 'Category deleted successfully!');
	$sql = "DELETE FROM ". DB_PREFIX ."categories WHERE category_id='". (int)$category_id ."'";
	$rs = mysqli_query($conn, $sql);

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
 
 function showCategories($category_id, $parent_name = array()){
	$sub_children = getChildren($category_id); 
	if(sizeof($sub_children)){
			  foreach($sub_children as $child){
				  	if($category_id == 0){
						$parent_name = array();
					}
					$parent_name[] = $child['category_name'];
				  ?>
	<tr>
		<td><input type="checkbox" class="chk" value="<?php echo $child['category_id']; ?>" name="category_ids[]" /></td>
		<td><?php echo $child['category_id']; ?></td>
		
		<td><?php echo implode(' &raquo; ', $parent_name); ?> </td>
		<td><?php echo $child['parent_id']; ?></td>
		<td><a onclick="return confirm('Are you sure want to delete this?');" href="manage_categories.php?category_id=<?php echo $child['category_id']; ?>">Delete</a> | <a href="form_category.php?category_id=<?php echo $child['category_id']; ?>">Edit</a></td>
	</tr>				
				  <?php
				  showCategories($child['category_id'], $parent_name);
			  }
		  }
 }