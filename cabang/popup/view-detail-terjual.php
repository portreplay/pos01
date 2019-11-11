<?php 
	include '../core/init.php';
	if(isset($_GET['follow']) and !empty($_GET['follow'])) {
		$kd_penjualan = $_GET['follow'];
		$field_list_keterangan = "tbl_pegawai.username, tbl_terjual_toko.tanggal, tbl_terjual_toko.total_harga, tbl_pegawai.nama, tbl_pelanggan.nm_pelanggan, tbl_pelanggan.kd_pelanggan, tbl_pelanggan.alamat, tbl_pelanggan.email";
		//echo "SELECT $field_list_keterangan FROM tbl_terjual_toko INNER JOIN tbl_pelanggan ON tbl_terjual_toko.kd_pelanggan=tbl_pelanggan.kd_pelanggan INNER JOIN tbl_pegawai ON tbl_pegawai.kd_pegawai=tbl_terjual_toko.kd_pegawai WHERE tbl_terjual_toko.kd_penjualan='$kd_penjualan'";
		$get_keterangan = $mysqli->query("SELECT $field_list_keterangan FROM tbl_terjual_toko INNER JOIN tbl_pelanggan ON tbl_terjual_toko.kd_pelanggan=tbl_pelanggan.kd_pelanggan INNER JOIN tbl_pegawai ON tbl_pegawai.kd_pegawai=tbl_terjual_toko.kd_pegawai WHERE tbl_terjual_toko.kd_penjualan='$kd_penjualan'");
		$data_keterangan = $get_keterangan->fetch_array();
?>
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
				    	<h3 class="panel-title text-center">Keterangan</h3>
				  	</div>
				  	<div class="panel-body">
				   		<table class="table table-hover">
				   			<tbody>
				   				<tr>
				   					<td><b>Kode Penjualan</b> </td>
				   					<td>:</td>
				   					<td><?php echo $kd_penjualan; ?></td>
				   				</tr>
				   				<tr>
				   					<td><b>Tanggal Penjualan</b></td>
				   					<td>:</td>
				   					<td><?php echo $data_keterangan['tanggal']; ?></td>
				   				</tr>
				   				<tr>
				   					<td><b>Total Harga</b></td>
				   					<td>:</td>
				   					<td><?php echo rupiah($data_keterangan['total_harga']); ?></td>
				   				</tr>
				   				<tr>
				   					<td><b>Pelanggan</b></td>
				   					<td>:</td>
				   					<td><?php echo $data_keterangan['nm_pelanggan']; ?></td>
				   				</tr>
				   				<tr>
				   					<td><b>Alamat </b></td>
				   					<td>:</td>
				   					<td><?php echo $data_keterangan['alamat']; ?></td>
				   				</tr>
				   				<tr>
				   					<td><b>Email</b></td>
				   					<td>:</td>
				   					<td><?php echo $data_keterangan['email']; ?></td>
				   				</tr>
				   				<tr>
				   					<td><b>Pegawai</b></td>
				   					<td>:</td>
				   					<td><?php echo $data_keterangan['nama']; ?></td>
				   				</tr>
				   			</tbody>
				   		</table>
				  	</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
				    	<h3 class="panel-title text-center">Daftar Barang</h3>
				  	</div>
				  	<div class="panel-body">
				   		<table class="table table-striped">
				   			<thead>
				   				<tr>
				   					<th>No</th>
				   					<th>Kode Barang</th>
				   					<th>Nama Barang</th>
				   					<th>Quantity</th>
				   					<th>Diskon</th>
				   					<th>Harga + Biaya Expedisi</th>
				   				</tr>
				   			</thead>
				   			<tbody>
				   				<?php 
				   					$no = 0;
				   					$field_list_barang ="tbl_terjual_toko_detail.kd_barang, tbl_terjual_toko_detail.qty , tbl_terjual_toko_detail.diskon, tbl_terjual_toko_detail.harga, tbl_barang.nm_barang, tbl_stok_toko.biaya_expedisi, tbl_stok_toko.kd_pelanggan";
				   					//echo "SELECT $field_list_barang FROM tbl_terjual_toko_detail, tbl_barang, tbl_stok_toko WHERE tbl_terjual_toko_detail.kd_barang=tbl_barang.kd_barang AND tbl_terjual_toko_detail.kd_barang=tbl_stok_toko.kd_barang AND tbl_terjual_toko_detail.kd_penjualan='$kd_penjualan'";
				   					$get_daftar_barang = $mysqli->query("SELECT $field_list_barang FROM tbl_terjual_toko_detail, tbl_barang, tbl_stok_toko WHERE tbl_terjual_toko_detail.kd_barang=tbl_barang.kd_barang AND tbl_terjual_toko_detail.kd_barang=tbl_stok_toko.kd_barang AND tbl_terjual_toko_detail.kd_penjualan='$kd_penjualan' AND tbl_stok_toko.kd_pelanggan='".$data_keterangan['kd_pelanggan']."'");
				   					while($data_daftar_barang = $get_daftar_barang->fetch_array()) {
				   						$no++;
				   				?>
				   				<tr>
				   					<td><?php echo $no; ?></td>
				   					<td><?php echo $data_daftar_barang['kd_barang']; ?></td>
				   					<td><?php echo $data_daftar_barang['nm_barang']; ?></td>
				   					<td><?php echo $data_daftar_barang['qty']; ?></td>
				   					<td><?php echo rupiah($data_daftar_barang['diskon']); ?></td>
				   					<td><?php echo rupiah($data_daftar_barang['harga'] + $data_daftar_barang['biaya_expedisi']); ?></td>
				   				</tr>
				   				<?php } ?>
				   			</tbody>
				   		</table>
				  	</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>