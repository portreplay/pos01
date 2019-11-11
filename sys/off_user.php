<?php 
	include '../config.php';
	if(isset($_POST['kd_pegawai']) and !empty($_POST['kd_pegawai'])) {
		$kd_pegawai = $_POST['kd_pegawai'];

		$off_user = $mysqli->query("UPDATE tbl_pegawai SET active=0 WHERE kd_pegawai='$kd_pegawai'");

		if($off_user) {
			echo 'ok';
		}else {
			echo 'error';
		}
	}
?>