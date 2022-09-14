<?php
include '../db/db_config.php';
try {
	extract($_POST);
	$crt_tmp = explode(' ', $kriteria);
	$crt = implode('_', $crt_tmp);
	$db->insert('kriteria', "'','$crt','$bobot','$type'")->count();
	$db->alter('hasil_tpa', 'add column', "$crt", 'int')->get(false);
	header('location:../kriteria_show.php');
} catch (\Exception $e) {
	die($e->getMessage());
}
