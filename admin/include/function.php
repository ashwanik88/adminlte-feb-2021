<?php

function redirect($url){
	header('Location: ' . $url);
	die;
}

//function showAlert($type, $message){
function showAlert(){
	$str = '';
	if(isset($_SESSION['alert']['type']) && !empty($_SESSION['alert']['type']) && isset($_SESSION['alert']['msg']) && !empty($_SESSION['alert']['msg'])){
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