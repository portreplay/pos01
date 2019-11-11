<?php 
	include '../config.php';
	if(isset($_POST['kd_pegawai']) and !empty($_POST['kd_pegawai'])) {
		$kd_pegawai = $_POST['kd_pegawai'];

		$delete_user = $mysqli->query("DELETE FROM tbl_pegawai WHERE kd_pegawai='$kd_pegawai'");

		if($delete_user) {
			echo 'ok';
		}else {
			echo 'error';
		}
	}
?>