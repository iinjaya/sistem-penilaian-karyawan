<?php
include '../db/db_config.php';
extract($_POST);
function valid_extension($extension)
{
	$valid = ['jpg', 'jpeg', 'png'];
	$validate = !in_array($extension, $valid);
	return $validate;
}
function get_extension_file($filename)
{
	$extension = explode('.', $filename);
	return strtolower(end($extension));
}
$data = implode(',', array_map(function ($e) {
	return "$e = '$_POST[$e]'";
}, array_keys($_POST)));

$maximalSize = 1024; //1mb
$target_dir = "../assets/foto_calon_karyawan/";
$file_name = $_FILES['foto']['name'];
$tmp_name = $_FILES['foto']['tmp_name'];
$error = $_FILES['foto']['error'];
$size = $_FILES['foto']['size'];
$file_uploader = time() . '.' . get_extension_file($filename);
$target_file = $target_dir . $file_uploader;

if ($error != 4) {
	$valid = !valid_extension(get_extension_file($file_name));
	if (!$valid) {
		header('location:../edit_karyawan.php?error_msg=invalid_extension_file_upload&id=' . $id_calon_kr);
		die;
	}
	if (round($size / 1024) >  $maximalSize) {
		header('location:../edit_karyawan.php?error_msg=maximal_file_upload_1mb&id=' . $id_calon_kr);
		die;
	}
	$old_photo = $db->select('foto', 'calon_karyawan')->where('id_calon_kr=' . $id_calon_kr)->get()[0]['foto'];
	if (file_exists($target_dir . $old_photo)) {
		unlink($target_dir . $old_photo);
	}
	move_uploaded_file($tmp_name, $target_file);
	$data .= ", foto = '$file_uploader'";
}
try {
	$success = $db->update('calon_karyawan', $data)->where('id_calon_kr=' . $id_calon_kr)->count();
	if ($success) {
		header('location:../karyawan_show.php');
		die;
	}
} catch (Exception $e) {
	header('location:../edit_karyawan.php?error_msg=' . $e->getMessage() . '&id=' . $id_calon_kr);
}
