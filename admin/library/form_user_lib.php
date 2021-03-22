 <?php checkUserLogin();
 
$document_title = 'Add New User';
$username = '';
$password = '';
$cpassword = '';
$email = '';
$firstname = '';
$lastname = '';
$phone = '';
$filename = '';
$status = '1';
$user_id = 0;

if($_GET){
	if(isset($_GET['user_id']) && !empty($_GET['user_id'])){
		$user_id = $_GET['user_id'];
		$document_title = 'Edit User :: ' . $user_id;
		
		$data_user = getUser($user_id);
		
		$username = $data_user['username'];
		$password = '';
		$cpassword = '';
		$email = $data_user['email'];
		$firstname = $data_user['firstname'];
		$lastname = $data_user['lastname'];
		$phone = $data_user['phone'];
		$filename = $data_user['photo'];
		$status = $data_user['status'];
	}
	
}
if($_POST){	

	$username = $_POST['username'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	$email = $_POST['email'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$phone = $_POST['phone'];
	$status = $_POST['status'];
	
	if(validate($user_id)){
		
		if(isset($_FILES['photo']) && !empty($_FILES['photo'])){
			$filename = uploadPhoto($_FILES['photo'], $filename);
		}
		
		if($user_id > 0){	// edit user
			$sql = "UPDATE ". DB_PREFIX ."users SET username='". $username ."', email='". $email ."', firstname='". $firstname ."', lastname='". $lastname ."', phone='". $phone ."', photo='". $filename ."', status='". $status ."', date_modified=NOW() WHERE user_id='". (int)$user_id ."'";
			
			// update password
			if(!empty($password)){
				$sql_pwd = "UPDATE ". DB_PREFIX ."users SET password='". md5($password) ."' WHERE user_id='". (int)$user_id ."'";
				mysqli_query($conn, $sql_pwd);
			}
			
			
			addAlert('success','User updated successfully');
			
			
		}else{	// add new user
			$sql = "INSERT INTO ". DB_PREFIX ."users SET username='". $username ."', password='". md5($password) ."', email='". $email ."', firstname='". $firstname ."', lastname='". $lastname ."', phone='". $phone ."', photo='". $filename ."', status='". $status ."', date_added=NOW(), date_modified=NOW()";
			addAlert('success','User added successfully');
		}
		
		mysqli_query($conn, $sql);
		
		
		redirect('manage_users.php');
	}
}

function alreadyExist($field, $value, $user_id){
	global $conn;
	$sql = "SELECT * FROM ". DB_PREFIX ."users WHERE ". $field ."='". $value ."' AND user_id!='". $user_id ."'";
	$rs = mysqli_query($conn, $sql);
	if(mysqli_num_rows($rs)){
		return true;
	}
	return false;
}

function validate($user_id){
	$errors = array();
	if(!isset($_POST['username']) || empty($_POST['username'])){
		array_push($errors, 'Username is required!');
	}
	
	if(alreadyExist('username', $_POST['username'], $user_id)){
		array_push($errors, 'Username already exists!');
	}
	
	// password validation
	
	if(!isset($_POST['password']) || empty($_POST['password']) && $user_id == 0){
		array_push($errors, 'Password is required!');
	}
	if(!isset($_POST['cpassword']) || empty($_POST['cpassword']) && !empty($_POST['password'])){
		array_push($errors, 'Confirm Password is required!');
	}
	
	if($_POST['password'] != $_POST['cpassword']){
		array_push($errors, 'Confirm Password not match!');
	}
	
	if(!isset($_POST['email']) || empty($_POST['email'])){
		array_push($errors, 'Email is required!');
	}
	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		array_push($errors, 'Invalid email address!');
	}
	if(alreadyExist('email', $_POST['email'], $user_id)){
		array_push($errors, 'Email already exists!');
	}
	
	if(!isset($_POST['phone']) || empty($_POST['phone'])){
		array_push($errors, 'Phone is required!');
	}
	if(!preg_match("/^[0-9]{10}$/", $_POST['phone'])) {
		array_push($errors, 'Invalid phone number!');
	}
	
	if(isset($_FILES['photo']) && !empty($_FILES['photo'])){
		if($_FILES['photo']['error'] != 0 || ($_FILES['photo']['type'] != 'image/png' && $_FILES['photo']['type'] != 'image/jpg')){
			array_push($errors, 'Invalid file format!');
		}
	}
	
	if(sizeof($errors) == 0){
		return true;
	}else{
		addAlert('danger', implode('<br>', $errors));
		return false;
	}
}

function getUser($user_id){
	global $conn;
	$sql = "SELECT * FROM ". DB_PREFIX ."users WHERE user_id='". $user_id ."'";
	$rs = mysqli_query($conn, $sql);
	$data = array();
	if(mysqli_num_rows($rs)){
		$data = mysqli_fetch_assoc($rs);
	}
	return $data;
}

function uploadPhoto($src, $old_file = ''){
	$src_path = $src['tmp_name'];
	$filename = time() . '_' . $src['name'];
	$dest_path = DIR_UPLOADS. $filename;
	copy($src_path, $dest_path);
	
	if(!empty($old_file)){
		unlink(DIR_UPLOADS. $old_file);	
	}
	return $filename;
}