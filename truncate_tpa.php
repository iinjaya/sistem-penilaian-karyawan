<?php
include 'db/db_config.php';
$db->truncate('hasil_spk');
header("Location:index.php");
