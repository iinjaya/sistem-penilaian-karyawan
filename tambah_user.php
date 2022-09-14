<?php
session_start();
error_reporting(1);
if (empty($_SESSION['id'])) {
  header('location:login.php?error_login=1');
}
?>
<?php include 'partials/header.php'; ?>
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
            <form method="post" action="model/do_insert_user.php" enctype="multipart/form-data">
              <?php if (!empty($_GET['error'])) : ?>
                <div class="alert alert-danger">
                  <?= $_GET['error']; ?>
                </div>
              <?php endif ?>
              <div class="form-group">
                <label for="nip">NIP (Nomor Induk Pegawai)</label>
                <input type="text" class="form-control" id="nip" name="nip">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
              </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username">
              </div>
              <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap">
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
                <input type="date" class="form-control" id="ttl" / name="ttl">
              </div>
              <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" id="foto" name="foto" />
              </div>
              <div class="form-group">
                <label for="akses">Akses</label>
                <select name="akses" id="akses" class="form-control form-select">
                  <option value="hrd">HRD</option>
                  <option value="audit">Audit</option>
                  <option value="direktur">Direktur</option>
                </select>
              </div>
              <div class="form-group">
                <button class="btn btn-primary">Simpan</button>
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