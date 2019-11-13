<?php 
	include '../core/init.php';
	if(isset($_GET['follow']) and !empty($_GET['follow'])) {
		$kd_penerimaan_barang = $_GET['follow'];
		$field_list_keterangan = "tbl_pegawai.username, tbl_penerimaan_barang_header.tanggal_penerimaan_barang, tbl_penerimaan_barang_header.total_harga, tbl_pegawai.nama, tbl_supplier.nm_supplier, tbl_supplier.alamat, tbl_supplier.email";
		//echo "SELECT $field_list_keterangan FROM tbl_penerimaan_barang_header INNER JOIN tbl_supplier ON tbl_penerimaan_barang_header.kd_supplier=tbl_supplier.kd_supplier INNER JOIN tbl_pegawai ON tbl_pegawai.kd_pegawai=tbl_penerimaan_barang_header.kd_pegawai WHERE tbl_penerimaan_barang_header.kd_penerimaan_barang='$kd_penerimaan_barang'";
		$get_keterangan = $mysqli->query("SELECT $field_list_keterangan FROM tbl_penerimaan_barang_header INNER JOIN tbl_supplier ON tbl_penerimaan_barang_header.kd_supplier=tbl_supplier.kd_supplier INNER JOIN tbl_pegawai ON tbl_pegawai.kd_pegawai=tbl_penerimaan_barang_header.kd_pegawai WHERE tbl_penerimaan_barang_header.kd_penerimaan_barang='$kd_penerimaan_barang'");
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
				   					<td><b>Kode penerimaan_barang</b> </td>
				   					<td>:</td>
				   					<td><?php echo $kd_penerimaan_barang; ?></td>
				   				</tr>
				   				<tr>
				   					<td><b>Tanggal penerimaan_barang</b></td>
				   					<td>:</td>
				   					<td><?php echo $data_keterangan['tanggal_penerimaan_barang']; ?></td>
				   				</tr>
				   				<tr>
				   					<td><b>Total Harga</b></td>
				   					<td>:</td>
				   					<td><?php echo rupiah($data_keterangan['total_harga']); ?></td>
				   				</tr>
				   				<tr>
				   					<td><b>supplier</b></td>
				   					<td>:</td>
				   					<td><?php echo $data_keterangan['nm_supplier']; ?></td>
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
				   					<th>Harga</th>
				   				</tr>
				   			</thead>
				   			<tbody>
				   				<?php 
				   					$no = 0;
				   					$get_daftar_barang = $mysqli->query("SELECT * FROM  tbl_penerimaan_barang_detail INNER JOIN tbl_barang ON tbl_penerimaan_barang_detail.kd_barang=tbl_barang.kd_barang WHERE tbl_penerimaan_barang_detail.kd_penerimaan_barang='$kd_penerimaan_barang'");
				   					while($data_daftar_barang = $get_daftar_barang->fetch_array()) {
				   						$no++;
				   				?>
				   				<tr>
				   					<td><?php echo $no; ?></td>
				   					<td><?php echo $data_daftar_barang['kd_barang']; ?></td>
				   					<td><?php echo $data_daftar_barang['nm_barang']; ?></td>
				   					<td><?php echo $data_daftar_barang['qty']; ?></td>
				   					<td><?php echo $data_daftar_barang['diskon']; ?></td>
				   					<td><?php echo rupiah($data_daftar_barang['harga']); ?></td>
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