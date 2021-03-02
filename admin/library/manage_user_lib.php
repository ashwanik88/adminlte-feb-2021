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
 
 
 // $sql = "SELECT * FROM ". DB_PREFIX ."users ORDER BY user_id DESC LIMIT 10, 5";
 //pagination starts
 $page_limit = 5;
 $page_start = 0;	// 0, 5 , 10
 $total_users = 0;
 $sql_total = "SELECT count(*) as total FROM ". DB_PREFIX ."users ORDER BY user_id DESC";
 $rs_total = mysqli_query($conn, $sql_total);
 if(mysqli_num_rows($rs_total)){
	$rec_total = mysqli_fetch_assoc($rs_total);
	$total_users = $rec_total['total'];
 }
 if(isset($_GET['page']) && !empty($_GET['page'])){
	$page = $_GET['page'];
	$page_start = ($page - 1) * $page_limit;
 }
 //pagination ends
 // 0 , 5 , 10
 // 1, 2 , 3
 
 $sql = "SELECT * FROM ". DB_PREFIX ."users ORDER BY user_id DESC LIMIT ". $page_start .", " . $page_limit;
 
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