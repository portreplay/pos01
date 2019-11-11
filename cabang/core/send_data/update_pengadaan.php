<?php 
	include '../init.php';
	if(isset($_GET['toko']) and !empty($_GET['toko'])) {
		$kd_pelanggan = $_GET['toko'];
		if(isset($_GET['ref']) and !empty($_GET['ref']) and $_GET['ref'] == 'penjualan') {
			if(isset($_GET['follow']) and !empty($_GET['follow'])) {
				$kd_barang = $_GET['follow'];
				if(isset($_POST['jumlah_pengadaan']) and !empty($_POST['jumlah_pengadaan'])) {
					$jumlah_pengadaan = $_POST['jumlah_pengadaan'];
					$_SESSION['sesi_barang'][$kd_barang]['jumlah_pengadaan'] = $jumlah_pengadaan; 
					alihkan('../../toko.php?following='.$kd_pelanggan.'&mode=add');
				}
			}
		}
	}
?>