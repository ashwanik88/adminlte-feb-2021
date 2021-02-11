<?php

if($_POST){
	if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])){
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		$sql = "SELECT * FROM ". DB_PREFIX ."users WHERE email = '". $email ."' AND password = '". md5($password) ."'";
		
		$rs = mysqli_query($conn, $sql);
		if(mysqli_num_rows($rs) > 0){
			
			// $data = mysqli_fetch_row($rs);
			 $data = mysqli_fetch_assoc($rs);
			// $data = mysqli_fetch_array($rs);
			// $data = mysqli_fetch_object($rs);
			
			// echo '<pre>';
				// print_r($data['username']);
				// // print_r($data->username);
			// die;
			$_SESSION['admin_user'] = $data;
			addAlert('success', 'Successfully logged in!');
			redirect('dashboard.php');
		}else{
			// $_SESSION['alert']['type'] = 'danger';
			// $_SESSION['alert']['msg'] = 'Incorrect login details!';
			
			addAlert('danger', 'Incorrect login details!');
			redirect('index.php');
		}

	}
}