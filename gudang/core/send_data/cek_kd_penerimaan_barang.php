<?php 
	include '../init.php';
	if(isset($_POST['kd_penerimaan_barang']) and !empty($_POST['kd_penerimaan_barang'])) {
		$kd_penerimaan_barang = $_POST['kd_penerimaan_barang'];
		$cek_kd_penerimaan_barang = $mysqli->query("SELECT kd_penerimaan_barang FROM tbl_penerimaan_barang_header WHERE kd_penerimaan_barang='$kd_penerimaan_barang'");
		if($cek_kd_penerimaan_barang->num_rows == 1) {
			echo json_encode(array('cek_status'=>false)); 
		}else {
			echo json_encode(array('cek_status'=>true)); 
		}
	}
?>