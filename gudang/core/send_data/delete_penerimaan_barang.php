<?php 
	include '../init.php';
	if(isset($_POST['kd_penerimaan_barang']) and !empty($_POST['kd_penerimaan_barang'])) {
		$kd_penerimaan_barang = $_POST['kd_penerimaan_barang'];
		$delete_penerimaan_barang_header = $mysqli->query("DELETE FROM tbl_penerimaan_barang_header WHERE kd_penerimaan_barang='$kd_penerimaan_barang'");
		if($delete_penerimaan_barang_header) {
			$delete_penerimaan_barang_detail = $mysqli->query("DELETE FROM tbl_penerimaan_barang_detail WHERE kd_penerimaan_barang='$kd_penerimaan_barang'");
			if($delete_penerimaan_barang_detail) {
				echo 'ok';
			} 
		}else {
			echo 'error';
		}
	}
?>