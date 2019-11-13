<?php 
	include '../config.php';
	if(isset($_POST['kd_supplier']) and !empty($_POST['kd_supplier'])) {
		$kd_supplier = $_POST['kd_supplier'];
		$nm_supplier = $_POST['nm_supplier'];
		$alamat = $_POST['alamat'];
		$email = $_POST['email'];

		$telepon = $_POST['telepon'];
		$handphone = $_POST['handphone'];

		// echo "INSERT INTO tbl_pegawai (kd_pegawai, kd_supplier, password, nama, email, level, login, tgl_daftar,active,role) VALUES ('$kd_pegawai','$kd_supplier','".md5($password)."','$nama','$email','$level',0,NOW(),1, '$role'";
		// exit();

		$add_supplier = $mysqli->query("INSERT INTO tbl_supplier (kd_supplier, nm_supplier, alamat, email, telepon, handphone) VALUES ('$kd_supplier','$nm_supplier','$alamat','$email','$telepon','$handphone')");
		if($add_supplier) {
			echo 'ok';
		}else {
			echo 'error';
		}
	}
?>