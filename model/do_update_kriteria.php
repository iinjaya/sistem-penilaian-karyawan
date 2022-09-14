<?php
include '../db/db_config.php';
try {
	extract($_POST);
	$crt_tmp = explode(' ', $kriteria);
	$crt = implode('_', $crt_tmp);
	foreach ($db->select('kriteria', 'kriteria')->where("id_kriteria='$id'")->get() as $r) {
		$k = $r['kriteria'];
	}
	$db->update('kriteria', "kriteria='$crt',bobot='$bobot',type='$type'")->where("id_kriteria='$id'")->count();
	$db->alter('hasil_tpa', 'change', "$k $crt", "int")->get(false);
	header('location:../kriteria_show.php');
} catch (\Exception $e) {
	die($e->getMessage());
}
