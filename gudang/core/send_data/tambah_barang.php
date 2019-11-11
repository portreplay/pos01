<?php 
	include '../init.php';
	if(isset($_POST['kd_barang']) and !empty($_POST['kd_barang'])) {
		
		$kd_barang = $_POST['kd_barang'];
		$nm_barang = $_POST['nm_barang'];
		$stok = $_POST['stok'];
		$harga_beli = $_POST['harga_beli'];
		$harga = $_POST['harga'];

		$sql_add_barang = "INSERT INTO tbl_barang (kd_barang,nm_barang,stok,harga_beli,harga) VALUES ('$kd_barang','$nm_barang', $stok, $harga_beli, $harga)";
		$add_barang = $mysqli->query($sql_add_barang);
		
		if($add_barang) {
			$callback_info = array('add_status'=> true);
		}else {
			$callback_info  = array('add_barang'=> false);
		}
		echo json_encode($callback_info);
	}
?>