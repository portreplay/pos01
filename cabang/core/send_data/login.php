<?php 
	include '../init.php';
	if(isset($_POST['username']) and !empty($_POST['username'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$sql = "SELECT * FROM tbl_pegawai WHERE (username='$username' OR email='$username') AND password='".md5($password)."'";
		$cek_id = $mysqli->query($sql);

		if($cek_id->num_rows == 1) {
					
			$data_pegawai = $cek_id->fetch_array();

			if(cek_aktif($data_pegawai['kd_pegawai'])===true) {
				if($data_pegawai['role'] == 'cabang' or $data_pegawai['level'] == 'admin') {
					$_SESSION['kd_pegawai'] = $data_pegawai['kd_pegawai'];
					$_SESSION['username'] = $data_pegawai['username'];
					$_SESSION['role'] = $data_pegawai['role'];
					echo 'ok';
				}
			
			}else {
				echo 'tidak_aktif';
			}
		}else {
			echo 'error';
		}
	}
?>