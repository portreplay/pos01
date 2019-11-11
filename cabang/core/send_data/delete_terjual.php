<?php 
	include '../init.php';
	if(isset($_POST['kd_penjualan']) and !empty($_POST['kd_penjualan'])) {
		$kd_penjualan = $_POST['kd_penjualan'];
		$delete_terjual_toko = $mysqli->query("DELETE FROM tbl_terjual_toko WHERE kd_penjualan='$kd_penjualan'");
		if($delete_terjual_toko) {
			$delete_terjual_toko_detail = $mysqli->query("DELETE FROM tbl_terjual_toko_detail WHERE kd_penjualan='$kd_penjualan'");
			if($delete_terjual_toko_detail) {
				echo 'ok';
			} 
		}else {
			echo 'error';
		}
	}
?>