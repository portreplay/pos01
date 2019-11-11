<?php 
	include '../config.php';
	if(isset($_POST['password']) and !empty($_POST['password'])) {
		$password = $_POST['password'];
		$kd_pegawai = $_SESSION['kd_pegawai'];

		$cek_password = $mysqli->query("SELECT password FROM tbl_pegawai WHERE password='".md5($password)."' AND kd_pegawai='$kd_pegawai'");

		if($cek_password->num_rows == 1) {
			$isAvailable  = true;
		}else {
			$isAvailable  = false;
		}
		echo json_encode(array(
		    'valid' => $isAvailable,
		));
	}
?>