<?php 
	include '../config.php';
	if(isset($_POST['username']) and !empty($_POST['username'])) {
		$username = $_POST['username'];

		$cek_username = $mysqli->query("SELECT username FROM tbl_pegawai WHERE username='$username'");

		if($cek_username->num_rows == 1) {
			$isAvailable  = false;
		}else {
			$isAvailable  = true;
		}
		echo json_encode(array(
		    'valid' => $isAvailable,
		));
	}
?>