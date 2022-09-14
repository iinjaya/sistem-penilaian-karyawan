<?php
session_start();
error_reporting(1);
if (empty($_SESSION['id'])) {
  header('location:login.php?error_login=1');
}
include 'partials/header.php';

$nip = $_GET['nip'];
function upload($file)
{
  global $nip;
  global $db;
  $name = $_FILES[$file]['name'];
  $error = $_FILES[$file]['error'];
  $tmp_name = $_FILES[$file]['tmp_name'];
  $size = round($_FILES[$file]['size'] / 1024);
  $extend = explode('.', $name);
  $extension = strtolower(end($extend));

  $dir = 'assets/img/';
  $filename = uniqid() . '.' . $extension;

  if ($error == 4) return null;
  if ($size > 1024) {
    throw new Exception('file maksimal berukuan 1 mb');
  }
  if (!in_array($extension, ['jpg', 'png', 'jpeg', 'ico', 'jfif'])) {
    throw new Exception('file yang di uplod harus gambar');
  }
  move_uploaded_file($tmp_name, $dir . $filename);
  $last_foto = $db->select('foto', 'hrd')->where('nip=' . "$nip")->get()[0]['foto'];
  if (file_exists('assets/img/' . $last_foto)) {
    unlink('assets/img/' . $last_foto);
  }
  return $filename;
}


if (isset($_POST['update'])) {
  unset($_POST['update']);
  if ($_POST['password'] == '') {
    unset($_POST['password']);
  } else {
    $_POST['password'] = md5($_POST['passowrd']);
  }
  if ($_FILES['foto']['error'] != 4) {
    $_POST['foto'] = upload('foto');
  }
  $data = implode(', ', array_map(function ($value) {
    return "$value = '$_POST[$value]'";
  }, array_keys($_POST)));
  $db->update('hrd', $data)->where('nip=' . $nip)->count();
  echo "<script>window.location.href='user.php'</script>";
  exit;
}

$user = $db->select('*', 'hrd')->where('nip=' . $_GET['nip'])->get()[0];
?>
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <br />
        <div class="panel panel-default">
          <div class="panel-heading">
            Form User
          </div>
          <div class="panel-body">
            <form method="post" action="" enctype="multipart/form-data">
              <?php if (!empty($_GET['error'])) : ?>
                <div class="alert alert-danger">
                  <?= $_GET['error']; ?>
                </div>
              <?php endif ?>
              <div class="form-group">
                <label for="nip">NIP (Nomor Induk Pegawai)</label>
                <input type="text" class="form-control" id="nip" name="nip" value="<?= $user['nip'] ?>">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>">
              </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>">
              </div>
              <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $user['nama_lengkap'] ?>">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <div class="alert alert-info">
                  <strong>Password default adalah: 1234. jika password kolom password tidak diisi.</strong>
                </div>
                <input type="password" class="form-control" id="password" name="password">
              </div>
              <div class="form-group">
                <label for="ttl">Tanggal / Bulan / Tahun Lahir</label>
                <input type="date" class="form-control" id="ttl" / name="ttl" value="<?= $user['ttl'] ?>">
              </div>
              <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" id="foto" name="foto" />
              </div>
              <div class="form-group">
                <label for="akses">Akses</label>
                <select name="akses" id="akses" class="form-control form-select">
                  <option value="hrd" <?= $user['akses'] == 'hrd' ? 'selected' : '' ?>>HRD</option>
                  <option value="audit" <?= $user['akses'] == 'audit' ? 'selected' : '' ?>>Audit</option>
                  <option value="direktur" <?= $user['akses'] == 'direktur' ? 'selected' : '' ?>>Direktur</option>
                </select>
              </div>
              <div class="form-group">
                <button class="btn btn-primary" name="update">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php include 'partials/footer.php'; ?>