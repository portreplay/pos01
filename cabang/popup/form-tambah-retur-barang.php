<?php 
	include '../core/init.php';
?>
<div class="row">
	<div class="col-md-12">
		<div class="col-md-12 msg_tambah_retur"></div>
		<form action="" method="POST" role="form" id="form-tambah-retur-barang">
			<div class="form-group">
				<label for="kd_retur">Kode Retur</label>
				<input type="text" name="kd_retur" id="kd_retur" class="form-control">
			</div>
			<div class="form-group">
				<label for="tgl_retur">Tanggal Retur</label>
				<input type="text" name="tgl_retur" id="tgl_retur" class="form-control">
			</div>
			<div class="form-group">
				<label for="kd_penjualan">Kode Penjualan</label>
				<input type="text" name="kd_penjualan" id="kd_penjualan" class="form-control">
			</div>
			<div class="form-group">
				<label for="replace_kd_barang">Ganti Dengan Barang</label>
				<input type="text" name="replace_kd_barang" id="replace_kd_barang" class="form-control">
			</div>
			<div class="form-group">
				<label for="jenis_retur">Jenis Retur</label>
				<input type="text" name="jenis_retur" id="jenis_retur" class="form-control">
			</div>
			<button type="submit" class="btn btn-primary">Simpan</button>
		</form>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#tgl_retur').datepicker({
			format: 'yyyy-mm-dd'
		});
	});
</script>