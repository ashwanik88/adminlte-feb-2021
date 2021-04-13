<?php require_once('include/startup.php');

$response = array('success' => false, 'msg' => 'invalid form data!');

if($_POST){
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
			
			$response['success'] = true;
			$response['msg'] = 'Successfully logged in!';

			addAlert('success', 'Successfully logged in!');
			
			// redirect('dashboard.php');
		}else{
			// $_SESSION['alert']['type'] = 'danger';
			// $_SESSION['alert']['msg'] = 'Incorrect login details!';
			$response['msg'] = 'Incorrect login details!';
			addAlert('danger', 'Incorrect login details!');
			//redirect('index.php');
		}

	}
}

echo json_encode($response);
die;