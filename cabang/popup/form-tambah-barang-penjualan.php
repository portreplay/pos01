<?php 
	include '../core/init.php';
	$kd_pelanggan = $_GET['follow'];
?>
<div class="row">
	<div class="col-md-12">
		<div class="col-md-12 msg_tambah_barang"></div>
		<form action="core/send_data/sesi_barang.php" method="POST" role="form" id="form-tambah-barang-penjualan">
			<div class="form-group">
				<label for="info_kd_barang">Masukan Satu Nama Barang</label>
				<select data-placeholder="Ketikan Nama Barang atau Kode Barang" name="info_kd_barang" multiple class="form-control chosen-select" tabindex="14">
		            <option value=""></option>
		          	<?php  
		          		$get_barang_on_add = $mysqli->query("SELECT * FROM tbl_stok_toko INNER JOIN tbl_barang ON tbl_barang.kd_barang=tbl_stok_toko.kd_barang WHERE kd_pelanggan='$kd_pelanggan'");
		          		while($data_barang_on_add = $get_barang_on_add->fetch_array()) {
		          	?>
					<option value="<?php echo $data_barang_on_add['kd_barang']; ?>"><b><?php echo $data_barang_on_add['kd_barang']; ?></b> | <?php echo $data_barang_on_add['nm_barang']; ?></option>
		          
		          	<?php } ?>
	          </select>	
			</div>
			<div id="product-info">
				
			</div>
			<div class="form-group">
				<label for="jml_terjual">Jumlah Terjual</label>
				<input type="text" class="form-control" name="pengadaan" id="pengadaan" disabled="disabled" placeholder="input jumlah terjual">
			</div>
			<button type="submit" class="btn btn-primary">Simpan</button>
		</form>
	</div>
</div>
<script>
	$(document).ready(function(){
		
		$('.chosen-select').chosen({
			max_selected_options: 1
		});
		$('select').change(function(){
			if($(this).val() != null) {
				var kd_barang = $(this).val();
				$.ajax({
					url: 'core/get_data/stok.php',
					type: 'POST',
					dataType: 'json',
					data: {kd_barang: kd_barang, kd_pelanggan: '<?php echo $kd_pelanggan; ?>'},
					success: function(stok){
						if(stok.stok != 0 && stok.status == 'ada') {
							var template_info = '<div class="form-group"><label for="kd_barang">Kode Barang </label><input type="text" class="form-control" name="kd_barang" value="'+kd_barang+'" readonly="readonly"></div><div class="form-group"><label for="harga">Harga + Biaya Expedisi</label><input type="text" class="form-control" name="harga" value="'+stok.harga+'" readonly="readonly"></div><div class="form-group"><label for="stok">Ready Stok </label><input type="text" class="form-control" name="stok" value="'+stok.stok+'" readonly="readonly"></div>';
							$('#product-info').html(template_info);
							$('input[name="pengadaan"]').removeAttr('disabled');
						}else if(stok.status == 'barang_tidak_ada'){
							alert('Barang tidak ditemukan');
						}else {
							alert('Barang dengan Kode Barang : '+kd_barang+' habis stok');
						}
					}
				});
				
				
			}else {
				$('#product-info').empty();
				$('input[name="pengadaan"]').attr('disabled','disabled');

			}
		});
		$('#form-tambah-barang-penjualan').submit(function(event){
			event.preventDefault();
			var kd_barang = $('select[name="info_kd_barang"]').val();
			var ready_stok = $('input[name="stok"]').val();

			var jumlah_pengadaan = $('#pengadaan').val();
			var harga = $('#harga').val();
			
			if(jumlah_pengadaan == 0) {
				alert('Maaf, Jumlah Pengadaan harus di tentukan');
				return false;
			}else if(jumlah_pengadaan > parseInt(ready_stok)){
				alert('Maaf, Jumlah Pengadaan terlalu banyak. Sedangkan Stok Barang '+ready_stok+' lagi');
			}else {
				
			
				$.ajax({
					url: 'core/send_data/sesi_barang.php?ref=add',
					type: 'POST',
					dataType: 'json',
					data: {kd_barang: kd_barang, jumlah_pengadaan: jumlah_pengadaan, harga: harga},
					success: function(data) {
						if(data.add_status == true) {
							window.location = 'toko.php?following=<?php echo $kd_pelanggan; ?>&mode=add';
						}else if(data.add_status == false) {
							$('.msg_tambah_barang').html('<div class="alert text-center alert-danger">Barang sudah ditambahkan sebelumnya</div>')
						}
					}
				});
			}
		});
	});
</script>