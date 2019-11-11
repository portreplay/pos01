<?php 
	include '../config.php';
	if(isset($_POST['kd_pelanggan']) and !empty($_POST['kd_pelanggan'])) {
		$kd_pelanggan = $_POST['kd_pelanggan'];
		$kd_pelanggan_current = $_POST['kd_pelanggan_current'];
		$nm_pelanggan = $_POST['nm_pelanggan'];
		$alamat = $_POST['alamat'];
		$email = $_POST['email'];

		$telepon = $_POST['telepon'];
		$handphone = $_POST['handphone'];
		
		// echo "SELECT kd_pelanggan FROM tbl_pelanggan WHERE kd_pelanggan='$kd_pelanggan_current'";
		// exit();
		
		$get_current_kd_pelanggan = $mysqli->query("SELECT kd_pelanggan FROM tbl_pelanggan WHERE kd_pelanggan='$kd_pelanggan_current'");

		$f_current_kd_pelanggan = $get_current_kd_pelanggan->fetch_array();

		$kd_pelanggan_on_table = $f_current_kd_pelanggan['kd_pelanggan'];

		//if kd pelanggan post not equal kd pelanggan on tbl_pelanggan
		if($kd_pelanggan != $kd_pelanggan_on_table) {
			if(cek_toko($kd_pelanggan)===true) {
				echo 'kd_pelanggan_sudah_ada';
				exit();
			}else {
				$sql_update_toko = "UPDATE tbl_pelanggan SET kd_pelanggan='$kd_pelanggan', nm_pelanggan='$nm_pelanggan', alamat='$alamat', email='$email', telepon='$telepon', handphone='$handphone' WHERE kd_pelanggan='$kd_pelanggan_current'";	
				$update_toko = $mysqli->query($sql_update_toko);
				if($update_toko) {
					echo 'ok';
				}else {
					echo 'error';
				}
			}
		}else {

			$sql_update_toko = "UPDATE tbl_pelanggan SET nm_pelanggan='$nm_pelanggan', alamat='$alamat', email='$email', telepon='$telepon', handphone='$handphone' WHERE kd_pelanggan='$kd_pelanggan'";	
			$update_toko = $mysqli->query($sql_update_toko);
			if($update_toko) {
				echo 'ok';
			}else {
				echo 'error';
			}
		}
	}else {
		echo 'can\'t find kd_pelanggan ';
	}
?>