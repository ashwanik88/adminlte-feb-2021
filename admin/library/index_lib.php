<?php
if($_COOKIE){
	if(isset($_COOKIE['EMAIL']) && !empty($_COOKIE['EMAIL']) && isset($_COOKIE['PASSWORD']) && !empty($_COOKIE['PASSWORD'])){
		$email = $_COOKIE['EMAIL'];
		$password = $_COOKIE['PASSWORD'];
		
		
		$sql = "SELECT * FROM ". DB_PREFIX ."users WHERE email_id = '". $email ."' AND password = '". $password ."'";
		
		$rs = mysqli_query($conn, $sql);
		if(mysqli_num_rows($rs) > 0){
			// echo 'redirect to dashboard!';
			// header('Location: dashboard.php');
			// die;
			$data = mysqli_fetch_assoc($rs);
			$_SESSION['admin_user'] = $data;
			
			if(isset($_POST['remember']) && !empty($_POST['remember'])){
				setcookie('EMAIL', $email, time() + (60*60*24));
				setcookie('PASSWORD', $password, time() + (60*60*24));
			}
			
			addAlert('success', 'You have successfully logged in');
			redirect('dashboard.php');
		}else{
			// echo 'incorrect details';
			addAlert('danger', 'You have entered wrong login information!');
			redirect('index.php');
		}
	}
}

if($_POST){
	echo json_encode(array('success' => true));
	die;
	if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])){
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		
		$sql = "SELECT * FROM ". DB_PREFIX ."users WHERE email = '". $email ."' AND password = '". $password ."'";
		
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
			
			if(isset($_POST['remember']) && !empty($_POST['remember'])){
				setcookie('EMAIL', $email, time() + (60*60*24));
				setcookie('PASSWORD', $password, time() + (60*60*24));
			}
			
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