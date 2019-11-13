<?php 
	include '../config.php';
	if(isset($_POST['kd_supplier']) and !empty($_POST['kd_supplier'])) {
		$kd_supplier = $_POST['kd_supplier'];

		$delete_supplier = $mysqli->query("DELETE FROM tbl_supplier WHERE kd_supplier='$kd_supplier'");

		if($delete_supplier) {
			echo 'ok';
		}else {
			echo 'error';
		}
	}
?>