<?php 
	include '../config.php';
	if(isset($_POST['kd_pegawai']) and !empty($_POST['kd_pegawai'])) {
		$kd_pegawai = $_POST['kd_pegawai'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$nama = $_POST['nama'];
		$email = $_POST['email'];

		$level = $_POST['level'];
		$role = $_POST['role'];

		$get_current_username = $mysqli->query("SELECT username FROM tbl_pegawai WHERE kd_pegawai='$kd_pegawai'");

		$f_current_username = $get_current_username->fetch_array();

		$username_on_table = $f_current_username['username'];

		if($username != $username_on_table) {
			if(cek_username_exist($username)===true) {
				echo 'username_sudah_ada';
				exit();
			}
		}else {

			if(!empty($password)) {
				
				$sql_update_user = "UPDATE tbl_pegawai SET username='$username', password='".md5($password)."', nama='$nama', email='$email', level='$level', role='$role' WHERE kd_pegawai='$kd_pegawai'";
			
			}else {

				$sql_update_user = "UPDATE tbl_pegawai SET username='$username', nama='$nama', email='$email', level='$level', role='$role' WHERE kd_pegawai='$kd_pegawai'";
			}

			$update_user = $mysqli->query($sql_update_user);
			if($update_user) {
				echo 'ok';
			}else {
				echo 'error';
			}
		}
	}
?>