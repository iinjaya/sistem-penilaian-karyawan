<?php
require_once '../db/db_config.php';
function upload($file)
{
  $name = $_FILES[$file]['name'];
  $error = $_FILES[$file]['error'];
  $tmp_name = $_FILES[$file]['tmp_name'];
  $size = round($_FILES[$file]['size'] / 1024);
  $extend = explode('.', $name);
  $extension = strtolower(end($extend));

  $dir = '../assets/img/';
  $filename = uniqid() . '.' . $extension;

  if ($error == 4) return null;
  if ($size > 1024) {
    throw new Exception('file maksimal berukuan 1 mb');
  }
  if (!in_array($extension, ['jpg', 'png', 'jpeg', 'ico', 'jfif'])) {
    throw new Exception('file yang di uplod harus gambar');
  }
  move_uploaded_file($tmp_name, $dir . $filename);
  return $filename;
}
try {
  $_POST['foto'] = upload('foto');
  $password = $_POST['password'] != "" ? $_POST['password'] : '1234';
  $_POST['password'] = md5($password);
  $keys = implode(',', array_keys($_POST));
  $values = implode("','", array_values($_POST));
  $db->insert("hrd ($keys)", "'$values'")->count();
  header("location:../user.php");
} catch (Exception $e) {
  header("Location:../tambah_user.php?error=" . $e->getMessage());
}
