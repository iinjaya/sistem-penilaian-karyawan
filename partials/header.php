<?php
session_start();
error_reporting(1);
include 'db/db_config.php';
if (isset($_POST['save'])) {
    unset($_POST['save']);
    $dir = 'assets/img/';
    if ($_POST['password'] != '') $_POST['password'] = md5($_POST['password']);
    else unset($_POST['password']);
    $map = array_map(function ($key) {
        return "$key = '$_POST[$key]'";
    }, array_keys($_POST));
    $data = implode(',', $map);
    if ($_FILES['foto']['error'] != 4) {
        $extend = explode('.', $_FILES['foto']['name']);
        $file = uniqid() . '.' . strtolower(end($extend));
        move_uploaded_file($_FILES['foto']['tmp_name'], $dir . $file);
        if (file_exists($dir . $_SESSION['admin']['foto'])) {
            unlink($dir . $_SESSION['admin']['foto']);
        }
        $_POST['foto'] = $file;
    }
    $success = $db->update('hrd', $data)->where('nip=' . $_SESSION['admin']['nip'])->count();
    if ($success) {
        $_SESSION['admin'] = $db->select('*', 'hrd')->where('nip=' . $_SESSION['admin']['nip'])->get()[0];
        echo "<script>alert('Menyimpan perubahan akun')</script>";
    }
}
$show = isset($_SESSION['id']) ? 'block' : 'none';
$user = $_SESSION['admin'];
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Sistem Penilaian Karyawan</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.4/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/r-2.3.0/datatables.min.css" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        table {
            text-transform: capitalize !important;
            font-weight: bold !important;
        }

        table th,
        table td {
            vertical-align: middle !important;
        }
    </style>
</head>

<body>
    <!-- HEADER END-->
    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="left-div">
                <div class="user-settings-wrapper">
                    <ul class="nav">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" style="display:<?= $show ?>">
                                <span class="glyphicon glyphicon-user" style="font-size: 25px;"></span>
                            </a>
                            <h2 style="color:white;display: inline-block;">Sistem Penilaian Karyawan</h2>
                            <div class="dropdown-menu dropdown-settings" style="width: 400px">
                                <div class="media">
                                    <div class="media-body">
                                        <div class="popx" style="display: flex;justify-content: space-between;align-items: center">
                                            <img src="assets/img/<?= $user['foto'] ?>" alt="" style="border-radius: 50%" />
                                            <div class="profile" style="text-align: right">
                                                <h4 style="text-transform: capitalize">
                                                    <?= $user['nama_lengkap'] ?> [<?= $user['akses'] != "" ? $user['akses'] : 'super admin' ?>]
                                                </h4>
                                                <a href="logout.php" class="btn btn-sm btn-danger">Keluar</a>
                                            </div>
                                        </div>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <hr style="background-color:#bbb; height: 2px">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="username">Username</label>
                                                        <input type="text" name="username" value="<?= $user['username'] ?>" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="nama_lengkap">Nama Lengkap</label>
                                                        <input type="text" value="<?= $user['nama_lengkap'] ?>" name="nama_lengkap" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" name="password" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" value="<?= $user['email'] ?>" name="email" class="form-control">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label for="foto">Foto</label>
                                                <input type="file" name="foto">
                                            </div>
                                            <hr style="background-color:#bbb; height: 2px">
                                            <button class="btn btn-sm btn-primary" name="save">Simpan Akun</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a href="index.php" id="home">Dashboard</a></li>
                            <li><a href="user.php" id="user">User</a></li>
                            <li><a href="kriteria_show.php" id="ds">Kriteria</a></li>
                            <li><a href="karyawan_show.php" id="ck">Data Karyawan</a></li>
                            <li><a href="tpa_show.php" id="tpa">Pembobotan</a></li>
                            <li><a href="proses_spk.php" id="proses">Perhitungan</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- MENU SECTION END-->