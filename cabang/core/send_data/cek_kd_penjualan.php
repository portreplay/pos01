<?php 
	include '../init.php';
	if(isset($_POST['kd_penjualan']) and !empty($_POST['kd_penjualan'])) {
		$kd_penjualan = $_POST['kd_penjualan'];
		$cek_kd_penjualan = $mysqli->query("SELECT kd_penjualan FROM tbl_penjualan_header WHERE kd_penjualan='$kd_penjualan'");
		if($cek_kd_penjualan->num_rows == 1) {
			echo json_encode(array('cek_status'=>false)); 
		}else {
			echo json_encode(array('cek_status'=>true)); 
		}
	}
?>