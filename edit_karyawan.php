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
                        Form Karyawan
                    </div>
                    <div class="panel-body">
                        <form method="post" action="model/do_update_ck.php" enctype="multipart/form-data">
                            <?php if (!empty($_GET['error_msg'])) : ?>
                                <div class="alert alert-danger">
                                    <?= $_GET['error_msg']; ?>
                                </div>
                            <?php endif ?>
                            <?php foreach ($db->select('*', 'calon_karyawan')->where('id_calon_kr=' . $_GET['id'])->get() as $val) : ?>
                                <input type="hidden" name="id_calon_kr" value="<?= $val['id_calon_kr'] ?>">
                                <div class="form-group">
                                    <label for="nip">NIP (Nomor Induk Pegawai)</label>
                                    <input type="text" class="form-control" id="nip" name="nip" value="<?= $val['nip'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Karyawan</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $val['nama'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $val['jabatan'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="ttl">Tanggal / Bulan / Tahun Lahir</label>
                                    <input type="date" class="form-control" id="ttl" name="ttl" value="<?= $val['ttl'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <input type="file" id="foto" name="foto" />
                                </div>
                                <div class="form-group">
                                    <label for="skill">Skill</label>
                                    <input type="text" class="form-control" id="skill" name="skill" value="<?= $val['skill'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Pengalaman</label>
                                    <textarea class="form-control" rows="8" name="pengalaman"><?= $val['pengalaman'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">Simpan</button>
                                </div>
                            <?php endforeach ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include 'partials/footer.php'; ?>