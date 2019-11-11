<?php 
	include '../init.php';
	if(isset($_POST['kd_barang']) and !empty($_POST['kd_barang'])) {
		$kd_barang = $_POST['kd_barang'];
		$cek_stok = $mysqli->query("SELECT stok FROM tbl_barang WHERE kd_barang='$kd_barang'");

		if($cek_stok->num_rows ==1) {
			$get_stok = $cek_stok->fetch_array();
			$stok = $get_stok['stok'];
			if($stok > 0) {
				echo json_encode(array('stok_ada'=>true));
			}else {
				echo json_encode(array('stok_ada'=>false));
			}
		}else {
			echo 'error';
		}
	}
?>