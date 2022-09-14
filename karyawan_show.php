<?php
session_start();
error_reporting(1);
if (empty($_SESSION['id'])) {
    header('location:login.php?error_login=1');
}
$akses  = strtolower($_SESSION['admin']['akses']) == 'hrd';
?>
<?php include 'partials/header.php'; ?>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br>
                <h4 class="page-head-line">Data Karyawan (Alternatif)</h4>
                <p style="font-style: italic; font-weight: bold;">Halaman ini hanya diakses oleh HRD. Selain HRD Hanya bisa melihat data saja.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php if (!empty($_GET['error_msg'])) : ?>
                    <div class="alert alert-danger">
                        <?= $_GET['error_msg']; ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php if ($akses) : ?>
                    <div><a href="input_karyawan.php" class="btn btn-info">Tambah Data</a></div>
                    <br>
                <?php endif ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Ttl</th>
                                <th>Skill</th>
                                <th>Pengalaman</th>
                                <?php if ($akses) : ?>
                                    <th>Action</th>
                                <?php endif ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($db->select('*', 'calon_karyawan')->get() as $data) : ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $data['nip'] ?></td>
                                    <td><img src="assets/foto_calon_karyawan/<?= $data['foto'] ?>" width="50px" height="50px" style="border-radius: 50%;border:3px solid green"></td>
                                    <td><?= $data['nama'] ?></td>
                                    <td><?= $data['jabatan'] ?></td>
                                    <td><?= date('d.m.Y', strtotime($data['ttl'])) ?></td>
                                    <td><?= $data['skill'] ?></td>
                                    <td><?= $data['pengalaman'] ?></td>
                                    <?php if ($akses) : ?>
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="edit_karyawan.php?id=<?php echo $data[0] ?>">
                                                Edit
                                            </a>
                                            <a class="btn btn-sm btn-danger" href="model/do_delete_ck.php?id=<?php echo $data[0] ?>">
                                                Hapus
                                            </a>
                                        </td>
                                    <?php endif ?>
                                </tr>
                            <?php $no++;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->

<?php include 'partials/footer.php'; ?>
<script type="text/javascript">
    $(function() {
        $("#ck").addClass('menu-top-active');
    });
</script>