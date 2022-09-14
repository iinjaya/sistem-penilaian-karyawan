<?php
include '../db/db_config.php';
extract($_POST);
$pass = md5($password);
$sql = $db->select('*', 'hrd')->where("username='$username'");
$check = $sql->count();

if ($check == 1) {
	session_start();
	foreach ($sql->get() as $data) {
		$id_user = $data['nip'];
		$_SESSION['id'] = $id_user;
		$_SESSION['admin'] = $data;
	}

	header('location:../index.php');
} else {
	header('location:../login.php');
}
