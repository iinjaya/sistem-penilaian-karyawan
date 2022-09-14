<?php
include '../db/db_config.php';
extract($_POST);
$target_dir = "../assets/foto_calon_karyawan/";
$extension = explode('.', $_FILES['foto']['name']);
$extension = strtolower(end($extension));
$file_name = uniqid() . '.' . $extension;
$target_file = $target_dir . $file_name;
$file_type = $_FILES['foto']['type'];
if ($_FILES['foto']['size'] < 2000000) {
	if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
		$db->insert('calon_karyawan', "'','$nip','$nama','$jabatan','$file_name','$ttl','$skill','$pengalaman'")->count();
		header('location:../karyawan_show.php');
	} else {
		header('location:../input_karyawan.php?error_msg=error_upload');
	}
} else {
	header('location:../input_karyawan.php?error_msg=error_ukuran');
}
