<?php 
	include '../init.php';

	$kd_penjualan = $_POST['kd_penjualan'];
	$data_penjualan = $_POST['data_penjualan'];
	$tanggal = $_POST['tanggal'];
	$kd_pelanggan = $_POST['pelanggan'];
	$total_harga = $_POST['original_total'];
	$kd_pegawai = $_SESSION['kd_pegawai'];
	//penambahan data penjualan ke table penjualan header
	$add_penjualan_header_sql = "INSERT INTO tbl_penjualan_header (kd_penjualan,kd_pelanggan,total_harga,tanggal_penjualan,kd_pegawai) VALUES ('$kd_penjualan','$kd_pelanggan','$total_harga','$tanggal','$kd_pegawai')";
	$add_penjualan_header = $mysqli->query($add_penjualan_header_sql);
	//jika penambahan data ke penjualan header berhasil
	if($add_penjualan_header) {
		//looping data barang
		foreach($data_penjualan as $penjualan_header) {
			$kd_barang = $penjualan_header['kd_barang'];
			$nama_barang = $penjualan_header['data_barang']['nama_barang'];
			$qty = $penjualan_header['data_barang']['penjualan'];
			$harga = $penjualan_header['data_barang']['harga'];
			$subtotal = $penjualan_header['data_barang']['subtotal'];
			$diskon = $penjualan_header['data_barang']['diskon'];
			//penambahan data ke table penjualan detail
			$add_penjualan_detail_sql = "INSERT INTO tbl_penjualan_detail (kd_penjualan, kd_barang, qty, harga, diskon) VALUES ('$kd_penjualan','$kd_barang','$qty', '$harga','$diskon')";
			$add_penjualan_detail = $mysqli->query($add_penjualan_detail_sql);

			//jika penambahan penjualan ke tabel penjualan detail berhasil
			if($add_penjualan_detail) {
				//mengurangi stok barang di tabel barang berdasarkan qty dari penjualan
				$get_latest_stok = $mysqli->query("SELECT stok FROM tbl_barang WHERE kd_barang='$kd_barang'");
				$data_latest_stok = $get_latest_stok->fetch_array();

				$latest_stok = $data_latest_stok['stok'];
				$kurangi_stok = $latest_stok - $qty;
				$update_stok = $mysqli->query("UPDATE tbl_barang SET stok=$kurangi_stok WHERE kd_barang='$kd_barang'");

				/* penambahan data stok barang ke toko bersangkutan */

				//jika ditoko blm ada kode barang, jika kode barang sudah ada maka aksi adalah hanya tambah stok. jika blm ada maka aksi tambah data ditable
				if(cek_kd_barang_toko($kd_barang, $kd_pelanggan)===true) {
					$get_latest_stok_toko = $mysqli->query("SELECT stok FROM tbl_stok_toko WHERE kd_barang='$kd_barang' AND kd_pelanggan='$kd_pelanggan'");
					$data_latest_stok_toko = $get_latest_stok_toko->fetch_array();
					$latest_stok_toko = $data_latest_stok_toko['stok'];
					
					$tambah_stok = $latest_stok_toko + $qty;
					$add_stok_toko_sql = "UPDATE tbl_stok_toko SET harga='$harga', stok=$tambah_stok  WHERE kd_pelanggan='$kd_pelanggan' AND kd_barang='$kd_barang'";
					$add_stok_toko = $mysqli->query($add_stok_toko_sql);
				}else {
					$add_stok_toko_sql = "INSERT INTO tbl_stok_toko (kd_pelanggan, kd_barang, stok, harga, biaya_expedisi) VALUES('$kd_pelanggan','$kd_barang','$qty','$harga',0)";
					$insert_stok_toko = $mysqli->query($add_stok_toko_sql);
				}
				
			}
		}
		
	}
	echo json_encode(array('add_status'=>true));
	
?>