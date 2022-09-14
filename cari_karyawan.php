<?php
session_start();
error_reporting(1);
if (empty($_SESSION['id'])) {
    header('location:login.php');
}
?>
<?php include 'partials/header.php'; ?>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Cari Data</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success">
                    <strong> Cari Calon Karyawan</strong>
                    <form method="get" action="model/cari_karyawan.php">
                        <div class="input-group">
                            <input type="text" class="form-control" name="nama" placeholder="Search">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hovered">
                    <thead>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nilai Akhir</th>
                    </thead>
                    <tbody>
                        <?php
                        $name = $_GET['nama'];
                        $no = 1;
                        foreach ($db->select('calon_karyawan.*,hasil_spk.hasil_spk', 'calon_karyawan,hasil_spk')->where('calon_karyawan.id_calon_kr=hasil_spk.id_calon_kr and calon_karyawan.nama')->like("$name")->get() as $row) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['hasil_spk'] ?></td>
                            </tr>
                        <?php $no++;
                        endforeach ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->

<?php include 'partials/footer.php'; ?>
<script type="text/javascript">
    $(function() {
        $("#home").addClass('menu-top-active');
    });
</script>