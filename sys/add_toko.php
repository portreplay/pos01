<?php 
	include '../config.php';
	if(isset($_POST['kd_pelanggan']) and !empty($_POST['kd_pelanggan'])) {
		$kd_pelanggan = $_POST['kd_pelanggan'];
		$nm_pelanggan = $_POST['nm_pelanggan'];
		$alamat = $_POST['alamat'];
		$email = $_POST['email'];

		$telepon = $_POST['telepon'];
		$handphone = $_POST['handphone'];

		// echo "INSERT INTO tbl_pegawai (kd_pegawai, kd_pelanggan, password, nama, email, level, login, tgl_daftar,active,role) VALUES ('$kd_pegawai','$kd_pelanggan','".md5($password)."','$nama','$email','$level',0,NOW(),1, '$role'";
		// exit();

		$add_pelanggan = $mysqli->query("INSERT INTO tbl_pelanggan (kd_pelanggan, nm_pelanggan, alamat, email, telepon, handphone) VALUES ('$kd_pelanggan','$nm_pelanggan','$alamat','$email','$telepon','$handphone')");
		if($add_pelanggan) {
			echo 'ok';
		}else {
			echo 'error';
		}
	}
?>