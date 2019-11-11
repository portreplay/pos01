<?php 
	include '../init.php';
	if(isset($_GET['toko']) and !empty($_GET['toko'])) {
		$kd_pelanggan = $_GET['toko'];
		if(isset($_GET['ref']) and !empty($_GET['ref']) and $_GET['ref'] == 'penjualan') {
			if(isset($_GET['follow']) and !empty($_GET['follow'])) {
				$kd_barang = $_GET['follow'];
				if(isset($_POST['diskon']) and !empty($_POST['diskon'])) {
					$diskon = $_POST['diskon'];
					$_SESSION['sesi_barang'][$kd_barang]['diskon'] = $diskon; 
					alihkan('../../toko.php?following='.$kd_pelanggan.'&mode=add');
				}else {
					$_SESSION['sesi_barang'][$kd_barang]['diskon'] = 0; 
					alihkan('../../toko.php?following='.$kd_pelanggan.'&mode=add');
				}
			}
		}
	}
?>