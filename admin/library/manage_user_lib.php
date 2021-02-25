 <?php checkUserLogin();
 
 $document_title = 'Manage Users';
 if($_POST){
	 if(isset($_POST['user_ids']) && !empty($_POST['user_ids'])){
		 $user_ids = $_POST['user_ids'];
		 foreach($user_ids as $user_id){
			deleteUser($user_id);
		 }
		 redirect('manage_users.php');
	 }
 }
 if($_GET){
	 if(isset($_GET['user_id']) && !empty($_GET['user_id'])){
		 $user_id = $_GET['user_id'];
		 deleteUser($user_id);
		 
		 redirect('manage_users.php');
	 }
 }
 
 
 $sql = "SELECT * FROM ". DB_PREFIX ."users ORDER BY user_id DESC";
 
 $rs = mysqli_query($conn, $sql);
 
 $data_users = array();
 if(mysqli_num_rows($rs)){
	 while($rec = mysqli_fetch_assoc($rs)){
		 $data_users[] = $rec;
	 }
 }
 
 function deleteUser($user_id){
	 global $conn;
	if($user_id == 1){
		addAlert('warning', 'You can\'t delete admin user!'); 
	}else{
		addAlert('success', 'User deleted successfully!');
		$sql = "DELETE FROM ". DB_PREFIX ."users WHERE user_id='". (int)$user_id ."'";
		$rs = mysqli_query($conn, $sql);
	}
	 
 }