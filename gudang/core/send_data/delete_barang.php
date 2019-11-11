<?php 
	include '../init.php';
	if(isset($_POST['kd_barang']) and !empty($_POST['kd_barang'])) {
		$kd_barang = $_POST['kd_barang'];

		$delete_barang = $mysqli->query("DELETE FROM tbl_barang WHERE kd_barang='$kd_barang'");

		if($delete_barang) {
			echo 'ok';
		}else {
			echo 'error';
		}
	}
?>