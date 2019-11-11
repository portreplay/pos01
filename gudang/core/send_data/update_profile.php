<?php 
	include '../init.php';
	if(isset($_POST['nama']) and !empty($_POST['nama'])) {
		$nama = $_POST['nama'];
		$password= $_POST['password'];
		$email = $_POST['email'];
		$kd_pegawai = $_SESSION['kd_pegawai'];
		if(!empty($password)) {
			$sql_update = "UPDATE tbl_pegawai SET nama='$nama', password='".md5($password)."', email='$email' WHERE kd_pegawai='$kd_pegawai'";
		}else {
			$sql_update = "UPDATE tbl_pegawai SET nama='$nama', email='$email' WHERE kd_pegawai='$kd_pegawai'";
		}
		if($update_pegawai = $mysqli->query($sql_update)) {
			echo json_encode(array('update_status'=>true));
		}else {
			echo json_encode(array('update_status'=>false));
		}


	}
?>