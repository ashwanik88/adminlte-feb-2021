<?php require_once('include/startup.php'); 
unset($_SESSION['admin_user']);
addAlert('success', 'Successfully logged out!');
redirect('index.php');
