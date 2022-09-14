<?php
include '../db/db_config.php';
try {
	$id = $_GET['id'];
	foreach ($db->select('kriteria', 'kriteria')->where("id_kriteria=$id")->get() as $c) {
		$krt = $c['kriteria'];
	}
	$db->delete('kriteria')->where('id_kriteria=' . $id)->count();
	$db->alter('hasil_tpa', 'drop column', "$krt", '')->get(false);
	header('location:../kriteria_show.php');
} catch (\Exception $e) {
	header('location:../kriteria_show.php?error_msg=delete_failed');
}
