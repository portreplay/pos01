<?php 
	include '../config.php';
	if(isset($_POST['kd_supplier']) and !empty($_POST['kd_supplier'])) {
		$kd_supplier = $_POST['kd_supplier'];

		$cek_kd_supplier = $mysqli->query("SELECT kd_supplier FROM tbl_supplier WHERE kd_supplier='$kd_supplier'");

		if($cek_kd_supplier->num_rows == 1) {
			$isAvailable  = false;
		}else {
			$isAvailable  = true;
		}
		echo json_encode(array(
		    'valid' => $isAvailable,
		));
	}
?>