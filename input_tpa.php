<?php
session_start();
error_reporting(1);
if (empty($_SESSION['id'])) {
    header('location:login.php?error_login=1');
}
$hrd = ['absensi', 'attituted'];
$audit = ['sop', 'target', 'kerajinan'];
?>
<?php include 'partials/header.php'; ?>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br />
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Form Kriteria
                    </div>
                    <div class="panel-body">
                        <form method="post" action="model/do_insert_tpa.php" enctype="multipart/form-data">
                            <?php if (!empty($_GET['error_msg'])) : ?>
                                <div class="alert alert-danger">
                                    <?= $_GET['error_msg']; ?>
                                </div>
                            <?php endif ?>
                            <div class="form-group">
                                <div class="alert alert-info">
                                    <strong> Nama Yang Ditampilkan adalah nama karyawan yang belum memiliki nilai bobot nilai</strong>
                                    <ul style="margin: 0; padding: 0; list-style: none">
                                        <li><strong>HRD</strong> : Abensi & Attituted</li>
                                        <li><strong>Audit</strong> : Targer, Kerajinan & SOP</li>
                                    </ul>
                                </div>
                                <label for="nama">Nama Calon Karyawan</label>
                                <select class="form-control" name="id_calon_kr">
                                    <?php
                                    $query = "SELECT * FROM calon_karyawan WHERE id_calon_kr NOT in (SELECT id_calon_kr FROM hasil_tpa)";
                                    foreach ($db->getFrom($query, true) as $val) : ?>
                                        <option value="<?= $val['id_calon_kr'] ?>"><?= $val['nama'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="alert alert-warning">
                                <strong>Harap untuk input sesuai form yang di berikan</strong>
                            </div>
                            <div class="col-md-12" style="padding: 0; margin: 0; ">
                                <?php foreach ($db->select('kriteria', 'kriteria')->get() as $r) : ?>
                                    <?php $hrd = in_array(strtolower($r['kriteria']), $$_SESSION['admin']['akses']); ?>
                                    <div class="form-group col-sm-2" style="padding: 0; margin-right: 10px">
                                        <label><?= $r['kriteria'] ?></label>
                                        <input type="number" name="<?= $r['kriteria'] ?>" <?= $hrd ? '' : 'readonly' ?> class="form-control">
                                    </div>
                                <?php endforeach ?>
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
<script type="text/javascript">
</script>