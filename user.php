<?php
session_start();
error_reporting(1);
if (empty($_SESSION['id'])) {
  header('location:login.php?error_login=1');
}
$akses = $_SESSION['admin']['akses'] == "";
?>
<?php include 'partials/header.php';
?>
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <br>
        <h4 class="page-head-line">Data User</h4>
        <?php if ($akses) : ?>
          <a href="tambah_user.php" class="btn btn-primary">Tambah User</a>
          <br>
          <br>
        <?php endif ?>
        <table class="table table-bordered table-hover table-stripped" style="text-transform: uppercase !important">
          <thead>
            <td>#</td>
            <th>NIP</th>
            <td>Foto</td>
            <th>Username</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>Akses User</th>
            <?php if ($akses) : ?>
              <th>Aksi</th>
            <?php endif ?>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($db->select('*', 'hrd')->get() as $user) : ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $user['nip'] ?></td>
                <td><img src="assets/img/<?= $user['foto'] ?>" alt="" width="50px" height="50px" style="border-radius: 50%;border:3px solid green"></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['nama_lengkap'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['akses'] != "" ? $user['akses'] : 'super admin' ?></td>
                <?php if ($akses) : ?>
                  <td>
                    <a href="edit_user.php?nip=<?= $user['nip'] ?>" class="btn btn-warning">EDIT</a>
                    <a href="model/hapus_user.php?nip=<?= $user['nip'] ?>" class="btn btn-danger">HAPUS</a>
                  </td>
                <?php endif ?>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include 'partials/footer.php'; ?>
<script type="text/javascript">
  $(function() {
    $("#user").addClass('menu-top-active');
  });
</script>