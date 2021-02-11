<?php
function checkUserLogin(){
	if(!isset($_SESSION['admin_user']) || empty($_SESSION['admin_user'])){
		addAlert('warning','Restricted Area - Access denied!');
		redirect('index.php');
	}
}
function redirect($url){
	header('Location: ' . $url);
	die;
}

//function showAlert($type, $message){
function showAlert(){
	$str = '';
	if(isset($_SESSION['alert']) && !empty($_SESSION['alert'])){
		$type = $_SESSION['alert']['type'];
		$msg = $_SESSION['alert']['msg'];
		$str = '<div class="alert alert-'. $type .' alert-dismissible fade show" role="alert">';
		$str .= $msg;
		$str .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span></button></div>';
		unset($_SESSION['alert']);
	}
	echo  $str;
}

function addAlert($type, $msg){
	$_SESSION['alert'] = array(
		'type'	=> $type,
		'msg'	=> $msg
	);
}