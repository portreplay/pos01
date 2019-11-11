<?php 
	include '../config.php';
	if(isset($_POST['kd_pelanggan']) and !empty($_POST['kd_pelanggan'])) {
		$kd_pelanggan = $_POST['kd_pelanggan'];

		$delete_pelanggan = $mysqli->query("DELETE FROM tbl_pelanggan WHERE kd_pelanggan='$kd_pelanggan'");

		if($delete_pelanggan) {
			echo 'ok';
		}else {
			echo 'error';
		}
	}
?>