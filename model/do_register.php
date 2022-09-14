<?php
	include '../db/db_config.php';
	extract($_POST);
	$pass = md5($password);
	if($db->insert('users',"'','$fullname','$email','$address','$username','$pass','2'")->count()==1){
		session_start();
		$_SESSION['id'] = session_id();
		$_SESSION['name'] = $username;
		if($_GET['p']=='show'){
			header('location:../users_show.php');
		} else {
			header('location:index.php');	
		}
	} else {
		echo "Error";
	}
?>