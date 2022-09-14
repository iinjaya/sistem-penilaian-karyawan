<?php
include '../db/db_config.php';
$id = $_GET['id'];
$db->delete('hasil_tpa')->where('id_calon_kr=' . $id)->count();
header('location:../tpa_show.php');
