<?php 
	include '../init.php';
	if(isset($_POST['kd_barang']) and !empty($_POST['kd_barang'])) {
		$kd_barang = $_POST['kd_barang'];
		$kd_pelanggan = $_POST['kd_pelanggan'];
		$jumlah_pengadaan = $_POST['jumlah_pengadaan'];
		$cek_stok = $mysqli->query("SELECT stok FROM tbl_stok_toko WHERE kd_barang='$kd_barang' AND kd_pelanggan='$kd_pelanggan'");

		if($cek_stok->num_rows ==1) {
			$get_stok = $cek_stok->fetch_array();
			$stok = $get_stok['stok'];
			if($jumlah_pengadaan > $stok) {
				echo json_encode(array('cek_status'=>false));
			}else {
				echo json_encode(array('cek_status'=>true));
			}
		}else {
			echo 'error';
		}
	}
?>