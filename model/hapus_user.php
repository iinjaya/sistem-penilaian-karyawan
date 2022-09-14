<?php
require_once '../db/db_config.php';
$user_foto = $db->select('foto', 'hrd')->where('nip=' . $_GET['nip'])->get()[0]['foto'];
if (file_exists("../assets/img/$user_foto")) {
  unlink("../assets/img/$user_foto");
}
$db->delete('hrd')->where('nip=' . $_GET['nip'])->count();
header("Location:../user.php");
