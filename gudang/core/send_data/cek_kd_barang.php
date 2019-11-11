<?php 
	include '../init.php';
	if(isset($_POST['kd_barang']) and !empty($_POST['kd_barang'])) {
		$kd_barang = $_POST['kd_barang'];

		$cek_kd_barang = $mysqli->query("SELECT kd_barang FROM tbl_barang WHERE kd_barang='$kd_barang'");

		if($cek_kd_barang->num_rows == 1) {
			$isAvailable = false;
		}else {
			$isAvailable = true;
		}
		echo json_encode(array(
			   'valid' => $isAvailable
		));
	}
?>