<?php
	include '../db/db_config.php';
	foreach ($db->select('*','lokasi')->where('id_lokasi='.$_POST['id'])->get() as $data):
?>
	<input type="hidden" name="id_lokasi" value="<?= $data['id_lokasi']?>">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" name="nama" class="form-control" value="<?= $data['nama_lokasi']?>">
	</div>
	<div class="form-group">
		<label>Lat</label>
		<input type="text" name="lat" class="form-control" value="<?= $data['lat']?>">
	</div>
	<div class="form-group">
		<label>Lng</label>
		<input type="text" name="lng" class="form-control" value="<?= $data['lng']?>">
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea class="form-control" name="deskripsi" rows="5"><?= $data['deskripsi']?></textarea>
	</div>
<?php endforeach ?>