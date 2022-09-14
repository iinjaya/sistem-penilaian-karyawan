<?php
include '../db/db_config.php';
foreach ($db->select('*', 'users')->where('id_user=' . $_POST['id'])->get() as $data) {
}
