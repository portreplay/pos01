<?php 
	include 'core/init.php';
	if(isset($_GET['ref']) and !empty($_GET['ref'])) {
		$ref = $_GET['ref'];
		if($ref == 'penjualan') {
			unset($_SESSION['sesi_barang']);
			echo json_encode(array('clear_status'=>true));
		}
	}
?>