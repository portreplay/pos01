<?php 
	include '../init.php';
	if(isset($_POST['kd_barang']) and !empty($_POST['kd_barang'])) {
		$kd_barang = $_POST['kd_barang'];
		$nm_barang = $_POST['nm_barang'];
		$stok = $_POST['stok'];
		$harga = $_POST['harga'];
		$harga_beli = $_POST['harga_beli'];

		$update_barang = $mysqli->query("UPDATE tbl_barang SET nm_barang='$nm_barang', stok=$stok, harga_beli='$harga_beli', harga='$harga' WHERE kd_barang='$kd_barang'");
		if($update_barang) {
			echo 'ok';
		}else {
			echo 'error';
		}
	}
?>