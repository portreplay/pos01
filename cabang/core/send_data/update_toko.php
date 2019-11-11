<?php 
	include '../init.php';
	if(isset($_POST['id_stok_barang']) and !empty($_POST['id_stok_barang'])) {
		$id_stok_barang = $_POST['id_stok_barang'];
		$kd_barang = $_POST['kd_barang'];
		$stok = $_POST['stok'];
		$harga = $_POST['harga'];
		$biaya_expedisi = $_POST['biaya_expedisi'];

		$update_toko = $mysqli->query("UPDATE tbl_stok_toko SET biaya_expedisi='$biaya_expedisi', harga='$harga' WHERE id_stok_barang=$id_stok_barang");
		if($update_toko) {
			echo 'ok';
		}else {
			echo 'error';
		}
	}
?>