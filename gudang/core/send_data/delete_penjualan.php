<?php 
	include '../init.php';
	if(isset($_POST['kd_penjualan']) and !empty($_POST['kd_penjualan'])) {
		$kd_penjualan = $_POST['kd_penjualan'];
		$delete_penjualan_header = $mysqli->query("DELETE FROM tbl_penjualan_header WHERE kd_penjualan='$kd_penjualan'");
		if($delete_penjualan_header) {
			$delete_penjualan_detail = $mysqli->query("DELETE FROM tbl_penjualan_detail WHERE kd_penjualan='$kd_penjualan'");
			if($delete_penjualan_detail) {
				echo 'ok';
			} 
		}else {
			echo 'error';
		}
	}
?>