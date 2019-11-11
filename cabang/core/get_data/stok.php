<?php 
	include '../init.php';
	if(isset($_POST['kd_barang']) and !empty($_POST['kd_barang'])) {
		$kd_barang = implode("",$kd_barang = $_POST['kd_barang']);
		$kd_pelanggan = $_POST['kd_pelanggan'];
		//echo "SELECT * FROM tbl_stok_toko WHERE kd_barang='$kd_barang' AND kd_pelanggan='$kd_pelanggan'";
		$get_stok = $mysqli->query("SELECT * FROM tbl_stok_toko WHERE kd_barang='$kd_barang' AND kd_pelanggan='$kd_pelanggan'");
		if($get_stok->num_rows == 1 ) {
			$stok_barang = $get_stok->fetch_array();
			$callback = array('status'=>'ada','stok'=>$stok_barang['stok'], 'harga'=>($stok_barang['harga'] + $stok_barang['biaya_expedisi']));
			echo json_encode($callback);
		}else {
			echo json_encode(array('status'=>'barang_tidak_ada'));
		}

	}
?>
