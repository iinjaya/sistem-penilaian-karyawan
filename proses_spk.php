<?php
session_start();
error_reporting(1);
if (empty($_SESSION['id'])) {
    header('location:login.php?error_login=1');
}
?>
<?php include 'partials/header.php'; ?>
<style>
    table {
        text-transform: capitalize !important;
    }

    .dontshow {
        display: none;
        transition: .5s ease-in-out;
    }
</style>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br>
                <h4 class="page-head-line">perhitungan penilaian karyawan</h4>
            </div>
        </div>
        <div class="row" style="margin-bottom: 5px">
            <div class="col-md-12">
                <button class="tab btn btn-primary" data-tab="pembobotan">Pembobotan</button>
                <button class="tab btn btn-success" data-tab="normalisasi">Normalisasi</button>
                <button class="tab btn btn-warning" data-tab="penentuan">Penentuan</button>
                <button class="tab btn btn-danger" data-tab="ranking">Perangkingan</button>
            </div>
        </div>
        <div class="row" id="pembobotan">
            <div class="col-md-12" style="margin-bottom: 20px">
                <h3>Pembobotan Alternatif</h3>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama Karyawan (Alternatif)</th>
                                <?php foreach ($db->select('kriteria', 'kriteria')->get() as $k) : ?>
                                    <th>
                                        <?php
                                        $tmp = explode('_', $k['kriteria']);
                                        echo ucwords(implode(' ', $tmp));
                                        ?>
                                    </th>
                                <?php endforeach ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($db->select('calon_karyawan.nama,calon_karyawan.foto,hasil_tpa.*', 'calon_karyawan,hasil_tpa')->where('calon_karyawan.id_calon_kr=hasil_tpa.id_calon_kr')->get() as $data) :
                            ?>
                                <tr>
                                    <td>
                                        <img src="assets/foto_calon_karyawan/<?= $data['foto'] ?>" width="30px" height="30px" style="border-radius: 50%;border:3px solid green; display: inline-block; margin-right: 10px;">
                                        <?= $data['nama'] ?>
                                    </td>
                                    <?php foreach ($db->select('kriteria', 'kriteria')->get() as $td) : ?>
                                        <td><?= $data[$td['kriteria']] ?></td>
                                    <?php endforeach ?>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row dontshow" id="normalisasi">
            <div class="col-md-12">
                <h3>Normalisasi</h3>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama Karyawan (Alternatif)</th>
                                <?php foreach ($db->select('kriteria', 'kriteria')->get() as $k) : ?>
                                    <th>
                                        <?php
                                        $tmp = explode('_', $k['kriteria']);
                                        echo ucwords(implode(' ', $tmp));
                                        ?>
                                    </th>
                                <?php endforeach ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($db->select('calon_karyawan.nama,calon_karyawan.foto,hasil_tpa.*', 'calon_karyawan,hasil_tpa')->where('calon_karyawan.id_calon_kr=hasil_tpa.id_calon_kr')->get() as $data) :
                            ?>
                                <tr>
                                    <td>
                                        <img src="assets/foto_calon_karyawan/<?= $data['foto'] ?>" width="30px" height="30px" style="border-radius: 50%;border:3px solid green; display: inline-block; margin-right: 10px;">
                                        <?= $data['nama'] ?>
                                    </td>
                                    <?php foreach ($db->select('kriteria', 'kriteria')->get() as $td) : ?>
                                        <td><?= $db->rumus($data[$td['kriteria']], $td['kriteria']); ?></td>
                                    <?php endforeach ?>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row dontshow" id="penentuan">
            <div class="col-md-12">
                <h3>Proses Penentuan</h3>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama Karyawan (Alternatif)</th>
                                <th>Hasil</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($db->select('calon_karyawan.id_calon_kr,calon_karyawan.nama,calon_karyawan.foto,hasil_tpa.*', 'calon_karyawan,hasil_tpa')->where('calon_karyawan.id_calon_kr=hasil_tpa.id_calon_kr')->get() as $data) :
                            ?>
                                <tr>
                                    <td>
                                        <img src="assets/foto_calon_karyawan/<?= $data['foto'] ?>" width="30px" height="30px" style="border-radius: 50%;border:3px solid green; display: inline-block; margin-right: 10px;">
                                        <?= $data['nama'] ?>
                                    </td>
                                    <td>
                                        <?php
                                        $hasil = [];
                                        foreach ($db->select('kriteria', 'kriteria')->get() as $dt) {
                                            array_push($hasil, $db->rumus($data[$dt['kriteria']], $dt['kriteria']) * $db->bobot($dt['kriteria']));
                                        }
                                        echo $h = array_sum($hasil);
                                        if ($db->select('id_calon_kr', 'hasil_spk')->where("id_calon_kr='$data[id_calon_kr]'")->count() == 0) {
                                            $db->insert('hasil_spk', "'','$data[id_calon_kr]','$h'")->count();
                                        } else {
                                            $db->update('hasil_spk', "hasil_spk='$h'")->where("id_calon_kr='$data[id_calon_kr]'")->count();
                                        }

                                        ?>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row dontshow" id="ranking">
            <div class="col-md-12">
                <h3>Perankingan</h3>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Kriteria </th>
                                <?php $no = 1;
                                foreach ($db->select('kriteria', 'kriteria')->get() as $th) : ?>
                                    <th>K<?= $no ?></th>
                                <?php $no++;
                                endforeach ?>
                                <th rowspan="2" style="padding-bottom:25px">Hasil</th>
                                <th rowspan="2" style="padding-bottom:25px">Ranking</th>
                            </tr>
                            <tr>
                                <th>Bobot </th>
                                <?php foreach ($db->select('bobot', 'kriteria')->get() as $th) : ?>
                                    <th><?= $th['bobot'] ?></th>
                                <?php endforeach ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($db->select('distinct(calon_karyawan.nama),calon_karyawan.foto,hasil_tpa.*', 'calon_karyawan,hasil_tpa,hasil_spk')->where('calon_karyawan.id_calon_kr=hasil_tpa.id_calon_kr and calon_karyawan.id_calon_kr=hasil_spk.id_calon_kr')->order_by('hasil_spk.hasil_spk', 'desc')->get() as $data) :
                            ?>
                                <tr>
                                    <td>
                                        <img src="assets/foto_calon_karyawan/<?= $data['foto'] ?>" width="30px" height="30px" style="border-radius: 50%;border:3px solid green; display: inline-block; margin-right: 10px;">
                                        <?= $data['nama'] ?>
                                    </td>
                                    <?php foreach ($db->select('kriteria', 'kriteria')->get() as $td) : ?>
                                        <td><?= $db->rumus($data[$td['kriteria']], $td['kriteria']); ?></td>
                                    <?php endforeach ?>
                                    <td>
                                        <?php
                                        $hasil = [];
                                        foreach ($db->select('kriteria', 'kriteria')->get() as $dt) {
                                            array_push($hasil, $db->rumus($data[$dt['kriteria']], $dt['kriteria']) * $db->bobot($dt['kriteria']));
                                        }
                                        echo $r = array_sum($hasil);
                                        ?>
                                    </td>
                                    <td>
                                        <?= $no ?>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            endforeach;
                            ?>
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
        $("#proses").addClass('menu-top-active');
    });
    $('.tab').click(function() {
        const id = $(this).data('tab');
        for (div of ['pembobotan', 'normalisasi', 'penentuan', 'ranking']) {
            $('#' + div).addClass('dontshow');
        }
        $('#' + id).removeClass('dontshow');
    });
</script>