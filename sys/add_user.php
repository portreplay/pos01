<?php 
	include '../config.php';
	if(isset($_POST['username']) and !empty($_POST['username'])) {
		$kd_pegawai = $_POST['kd_pegawai'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$nama = $_POST['nama'];
		$email = $_POST['email'];

		$level = $_POST['level'];
		$role = $_POST['role'];
		$kd_pelanggan = $_POST['kd_pelanggan'];

		// echo "INSERT INTO tbl_pegawai (kd_pegawai, username, password, nama, email, level, login, tgl_daftar,active,role) VALUES ('$kd_pegawai','$username','".md5($password)."','$nama','$email','$level',0,NOW(),1, '$role'";
		// exit();

		$add_user = $mysqli->query("INSERT INTO tbl_pegawai (kd_pegawai, username, password, nama, email, level, login, tgl_daftar,active,role,kd_pelanggan) VALUES ('$kd_pegawai','$username','".md5($password)."','$nama','$email','$level',0,NOW(),1, '$role','$kd_pelanggan')");
		if($add_user) {
			echo 'ok';
		}else {
			echo 'error';
		}
	}
?>