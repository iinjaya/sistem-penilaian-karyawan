<?php
session_start();
error_reporting(1);
if (empty($_SESSION['id'])) {
    header('location:login.php?error_login=1');
}
$akses = strtolower($_SESSION['admin']['akses']) != 'direktur';
?>
<?php include 'partials/header.php'; ?>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br>
                <h4 class="page-head-line">pembobotan alternatif</h4>
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
                    <div><a href="input_tpa.php" class="btn btn-info">Tambah Data</a></div>
                    <br>
                <?php endif ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <?php foreach ($db->select('kriteria', 'kriteria')->get() as $kr) : ?>
                                    <th><?= $kr['kriteria'] ?></th>
                                <?php endforeach ?>
                                <?php if ($akses) : ?>
                                    <th>Action</th>
                                <?php endif ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($db->select('calon_karyawan.id_calon_kr,calon_karyawan.nama,calon_karyawan.foto,hasil_tpa.*', 'calon_karyawan,hasil_tpa')->where('calon_karyawan.id_calon_kr=hasil_tpa.id_calon_kr')->get() as $data) : ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td>
                                        <img src="assets/foto_calon_karyawan/<?= $data['foto'] ?>" width="30px" height="30px" style="border-radius: 50%;border:3px solid green; display: inline-block;margin-right: 5px;">
                                        <?= $data['nama'] ?>
                                    </td>
                                    <?php foreach ($db->select('kriteria', 'kriteria')->get() as $k) : ?>
                                        <td><?= $data[$k['kriteria']] ?></td>
                                    <?php endforeach ?>
                                    <?php if ($akses) : ?>
                                        <td>
                                            <a class="btn btn-warning" href="edit_tpa.php?id=<?php echo $data['id_calon_kr'] ?>">Edit</a>
                                            <a class="btn btn-danger" href="model/do_delete_tpa.php?id=<?php echo $data['id_calon_kr'] ?>">Hapus</a>
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
        $("#tpa").addClass('menu-top-active');
    });
</script>