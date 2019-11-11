<?php 
	include '../init.php';
	if(isset($_POST['kd_barang']) and !empty($_POST['kd_barang'])) {
		
		$kd_barang = $_POST['kd_barang'];
		foreach ($kd_barang as $list_barang) {

			$tanggal_diskon = $_POST['tanggal_diskon'];
			$expire_diskon = $_POST['expire_diskon'];
			$jml_potongan = $_POST['jml_potongan'];
		

			$sql_add_diskon = "INSERT INTO tbl_diskon (kd_barang,tanggal_diskon,expire_diskon,jml_potongan) VALUES ('$list_barang','$tanggal_diskon', '$expire_diskon','$jml_potongan')";
			$add_barang = $mysqli->query($sql_add_diskon);
		}
		$callback_info = array('add_status'=> true);
		echo json_encode($callback_info);
		
		// if($add_barang) {
		// 	$callback_info = array('add_status'=> true);
		// }else {
		// 	$callback_info  = array('add_barang'=> false);
		// }
		// echo json_encode($callback_info);
	}
?>