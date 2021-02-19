 <?php checkUserLogin();
 
 $document_title = 'Add New User';
$username = '';
$password = '';
$cpassword = '';
$email = '';
$firstname = '';
$lastname = '';
$phone = '';
$status = '';
if($_POST){	

	$username = $_POST['username'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	$email = $_POST['email'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$phone = $_POST['phone'];
	$status = $_POST['status'];
	
	if(validate()){
		
		$sql = "INSERT INTO ". DB_PREFIX ."users SET username='". $username ."', password='". md5($password) ."', email='". $email ."', firstname='". $firstname ."', lastname='". $lastname ."', phone='". $phone ."', status='". $status ."', date_added=NOW()";
		
		mysqli_query($conn, $sql);
		
		addAlert('success','User added successfully');
		redirect('manage_users.php');
	}
}

function alreadyExist($field, $value){
	global $conn;
	$sql = "SELECT * FROM ". DB_PREFIX ."users WHERE ". $field ."='". $value ."'";
	$rs = mysqli_query($conn, $sql);
	if(mysqli_num_rows($rs)){
		return true;
	}
	return false;
}

function validate(){
	$errors = array();
	if(!isset($_POST['username']) || empty($_POST['username'])){
		array_push($errors, 'Username is required!');
	}
	
	if(alreadyExist('username', $_POST['username'])){
		array_push($errors, 'Username already exists!');
	}
	
	// password validation
	if(!isset($_POST['password']) || empty($_POST['password'])){
		array_push($errors, 'Password is required!');
	}
	if(!isset($_POST['cpassword']) || empty($_POST['cpassword'])){
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
	if(alreadyExist('email', $_POST['email'])){
		array_push($errors, 'Email already exists!');
	}
	
	if(!isset($_POST['phone']) || empty($_POST['phone'])){
		array_push($errors, 'Phone is required!');
	}
	if(!preg_match("/^[0-9]{10}$/", $_POST['phone'])) {
		array_push($errors, 'Invalid phone number!');
	}
	if(sizeof($errors) == 0){
		return true;
	}else{
		addAlert('danger', implode('<br>', $errors));
		return false;
	}
}