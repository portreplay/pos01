<?php 
	include '../init.php';
	
	$kd_penjualan = $_POST['kd_penjualan'];
	$data_penjualan = $_POST['data_penjualan'];
	$tanggal = $_POST['tanggal'];
	$kd_pelanggan = $_POST['pelanggan'];
	$total_harga = $_POST['original_total'];
	$kd_pegawai = $_SESSION['kd_pegawai'];
	$add_terjual_toko_sql = "INSERT INTO tbl_terjual_toko (kd_penjualan,kd_pelanggan,total_harga,tanggal,kd_pegawai) VALUES ('$kd_penjualan','$kd_pelanggan','$total_harga','$tanggal','$kd_pegawai')";
	$add_terjual_toko = $mysqli->query($add_terjual_toko_sql);
	
	if($add_terjual_toko) {

		foreach($data_penjualan as $terjual_toko) {
			$kd_barang = $terjual_toko['kd_barang'];
			$nama_barang = $terjual_toko['data_barang']['nama_barang'];
			$qty = $terjual_toko['data_barang']['penjualan'];
			$harga = $terjual_toko['data_barang']['harga'];
			$subtotal = $terjual_toko['data_barang']['subtotal'];
			$diskon = $terjual_toko['data_barang']['diskon'];
			$add_terjual_toko_detail_sql = "INSERT INTO tbl_terjual_toko_detail (kd_penjualan, kd_barang, qty, harga, diskon) VALUES ('$kd_penjualan','$kd_barang','$qty', '$harga','$diskon')";
			$add_terjual_toko_detail = $mysqli->query($add_terjual_toko_detail_sql);
		
			$get_latest_stok = $mysqli->query("SELECT stok FROM tbl_stok_toko WHERE kd_barang='$kd_barang' AND kd_pelanggan='$kd_pelanggan'");
			$data_latest_stok = $get_latest_stok->fetch_array();

			$latest_stok = $data_latest_stok['stok'];
			if($qty > $latest_stok) {
				echo json_encode(array('add_status'=>false));
				break;
			}
			$kurangi_stok = $latest_stok - $qty;

			$update_stok = $mysqli->query("UPDATE tbl_stok_toko SET stok=$kurangi_stok WHERE kd_barang='$kd_barang' AND kd_pelanggan='$kd_pelanggan'");
		}
		
	}
	echo json_encode(array('add_status'=>true));
	
?>