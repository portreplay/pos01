<?php 
	include '../config.php';
	if(isset($_POST['kd_supplier']) and !empty($_POST['kd_supplier'])) {
		$kd_supplier = $_POST['kd_supplier'];
		$kd_supplier_current = $_POST['kd_supplier_current'];
		$nm_supplier = $_POST['nm_supplier'];
		$alamat = $_POST['alamat'];
		$email = $_POST['email'];

		$telepon = $_POST['telepon'];
		$handphone = $_POST['handphone'];
		
		// echo "SELECT kd_supplier FROM tbl_supplier WHERE kd_supplier='$kd_supplier_current'";
		// exit();
		
		$get_current_kd_supplier = $mysqli->query("SELECT kd_supplier FROM tbl_supplier WHERE kd_supplier='$kd_supplier_current'");

		$f_current_kd_supplier = $get_current_kd_supplier->fetch_array();

		$kd_supplier_on_table = $f_current_kd_supplier['kd_supplier'];

		//if kd supplier post not equal kd supplier on tbl_supplier
		if($kd_supplier != $kd_supplier_on_table) {
			if(cek_supplier($kd_supplier)===true) {
				echo 'kd_supplier_sudah_ada';
				exit();
			}else {
				$sql_update_supplier = "UPDATE tbl_supplier SET kd_supplier='$kd_supplier', nm_supplier='$nm_supplier', alamat='$alamat', email='$email', telepon='$telepon', handphone='$handphone' WHERE kd_supplier='$kd_supplier_current'";	
				$update_supplier = $mysqli->query($sql_update_supplier);
				if($update_supplier) {
					echo 'ok';
				}else {
					echo 'error';
				}
			}
		}else {

			$sql_update_supplier = "UPDATE tbl_supplier SET nm_supplier='$nm_supplier', alamat='$alamat', email='$email', telepon='$telepon', handphone='$handphone' WHERE kd_supplier='$kd_supplier'";	
			$update_supplier = $mysqli->query($sql_update_supplier);
			if($update_supplier) {
				echo 'ok';
			}else {
				echo 'error';
			}
		}
	}else {
		echo 'can\'t find kd_supplier ';
	}
?>