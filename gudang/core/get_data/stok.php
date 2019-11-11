<?php 
	include '../init.php';
	if(isset($_POST['kd_barang']) and !empty($_POST['kd_barang'])) {
		$kd_barang = implode("",$kd_barang = $_POST['kd_barang']);
		$get_stok = $mysqli->query("SELECT * FROM tbl_barang WHERE kd_barang='$kd_barang'");
		if($get_stok->num_rows == 1) {
			$stok_barang = $get_stok->fetch_array();
			$callback = array('status'=>'ada','stok'=>$stok_barang['stok'], 'harga'=>$stok_barang['harga']);
			echo json_encode($callback);
		}else {
			echo json_encode(array('status'=>'barang_tidak_ada'));
		}

	}
?>
