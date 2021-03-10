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
 
 $data_categories = getChildren(0);
 
 
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