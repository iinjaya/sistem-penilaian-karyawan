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
                        <div class="alert alert-info">
                            <ul style="margin: 0; padding: 0; list-style: none">
                                <li><strong>HRD</strong> : Abensi & Attituted</li>
                                <li><strong>Audit</strong> : Targer, Kerajinan & SOP</li>
                            </ul>
                        </div>
                        <div class="alert alert-warning">
                            <strong>Harap untuk input sesuai form yang di berikan</strong>
                        </div>
                        <form method="post" action="model/do_update_tpa.php">
                            <?php if (!empty($_GET['error_msg'])) : ?>
                                <div class="alert alert-danger">
                                    <?= $_GET['error_msg']; ?>
                                </div>
                            <?php endif ?>
                            <?php foreach ($db->select('hasil_tpa.*,calon_karyawan.id_calon_kr,calon_karyawan.nama', 'hasil_tpa,calon_karyawan')->where('hasil_tpa.id_calon_kr=calon_karyawan.id_calon_kr and hasil_tpa.id_calon_kr=' . $_GET['id'])->get() as $data) : ?>
                                <input type="hidden" name="id" value="<?= $data['id_calon_kr'] ?>">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama'] ?>" readonly>
                                </div>
                                <?php foreach ($db->select('kriteria', 'kriteria')->get() as $r) : ?>
                                    <?php $hrd = in_array(strtolower($r['kriteria']), $$_SESSION['admin']['akses']); ?>
                                    <div class="form-group col-md-2" style="padding: 0; margin-right:10px">
                                        <label><?= $r['kriteria'] ?></label>
                                        <input type="number" name="kriteria[]" <?= $hrd ? '' : 'readonly' ?> class="form-control" value="<?= $data[$r['kriteria']] ?>">
                                    </div>
                                <?php endforeach ?>
                            <?php endforeach ?>
                            <div class="form-group col-md-12" style="margin-top: 30px; margin-left:0; padding: 0;">
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