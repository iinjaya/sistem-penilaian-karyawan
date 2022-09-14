<?php
include '../db/db_config.php';
$data = implode(',', array_map(function ($d) {
	return "'$_POST[$d]'";
}, array_keys($_POST)));
if ($db->insert('hasil_tpa', "'',$data")->count() == 1) {
	header('location:../tpa_show.php');
}
