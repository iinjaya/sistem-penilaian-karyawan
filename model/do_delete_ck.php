<?php
include '../db/db_config.php';
$id = $_GET['id'];

try {
	if ($db->delete('calon_karyawan')->where('id_calon_kr=' . $id)->count() == 1) {
		header('location:../karyawan_show.php');
	} else {
		// header('location:../karyawan_show.php?error_msg=error_delete');
	}
} catch (\Throwable $e) {
	die($e->getMessage());
}
