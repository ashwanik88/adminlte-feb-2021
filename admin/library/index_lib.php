<?php

if($_POST){
	if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])){
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		$sql = "SELECT * FROM ". DB_PREFIX ."users WHERE email = '". $email ."' AND password = '". md5($password) ."'";
		
		$rs = mysqli_query($conn, $sql);
		if(mysqli_num_rows($rs) > 0){
			// echo 'redirect to dashboard!';
			header('Location: dashboard.php');
			die;
		}else{
			echo 'incorrect details';
			
		}
		
		die;
	}
}