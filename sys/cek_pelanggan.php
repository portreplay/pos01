<?php 
	include '../config.php';
	if(isset($_POST['kd_pelanggan']) and !empty($_POST['kd_pelanggan'])) {
		$kd_pelanggan = $_POST['kd_pelanggan'];

		$cek_kd_pelanggan = $mysqli->query("SELECT kd_pelanggan FROM tbl_pelanggan WHERE kd_pelanggan='$kd_pelanggan'");

		if($cek_kd_pelanggan->num_rows == 1) {
			$isAvailable  = false;
		}else {
			$isAvailable  = true;
		}
		echo json_encode(array(
		    'valid' => $isAvailable,
		));
	}
?>