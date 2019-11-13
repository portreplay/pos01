<?php 
	include '../init.php';

	$kd_penerimaan_barang = $_POST['kd_penerimaan_barang'];
	$data_penerimaan_barang = $_POST['data_penerimaan_barang'];
	$tanggal = $_POST['tanggal'];
	$kd_supplier = $_POST['supplier'];
	$total_harga = $_POST['original_total'];
	$kd_pegawai = $_SESSION['kd_pegawai'];
	//penambahan data penerimaan_barang ke table penerimaan_barang header
	$add_penerimaan_barang_header_sql = "INSERT INTO tbl_penerimaan_barang_header (kd_penerimaan_barang,kd_supplier,total_harga,tanggal_penerimaan_barang,kd_pegawai) VALUES ('$kd_penerimaan_barang','$kd_supplier','$total_harga','$tanggal','$kd_pegawai')";
	$add_penerimaan_barang_header = $mysqli->query($add_penerimaan_barang_header_sql);
	//jika penambahan data ke penerimaan_barang header berhasil
	if($add_penerimaan_barang_header) {
		//looping data barang
		foreach($data_penerimaan_barang as $penerimaan_barang_header) {
			$kd_barang = $penerimaan_barang_header['kd_barang'];
			$nama_barang = $penerimaan_barang_header['data_barang']['nama_barang'];
			$qty = $penerimaan_barang_header['data_barang']['penerimaan_barang'];
			$harga = $penerimaan_barang_header['data_barang']['harga'];
			$subtotal = $penerimaan_barang_header['data_barang']['subtotal'];
			$diskon = $penerimaan_barang_header['data_barang']['diskon'];
			//penambahan data ke table penerimaan_barang detail
			$add_penerimaan_barang_detail_sql = "INSERT INTO tbl_penerimaan_barang_detail (kd_penerimaan_barang, kd_barang, qty, harga, diskon) VALUES ('$kd_penerimaan_barang','$kd_barang','$qty', '$harga','$diskon')";
			$add_penerimaan_barang_detail = $mysqli->query($add_penerimaan_barang_detail_sql);

			//jika penambahan penerimaan_barang ke tabel penerimaan_barang detail berhasil
			if($add_penerimaan_barang_detail) {
				//mengurangi stok barang di tabel barang berdasarkan qty dari penerimaan_barang
				$get_latest_stok = $mysqli->query("SELECT stok FROM tbl_barang WHERE kd_barang='$kd_barang'");
				$data_latest_stok = $get_latest_stok->fetch_array();

				$latest_stok = $data_latest_stok['stok'];
				$tambah_stok = $latest_stok + $qty;
				$update_stok = $mysqli->query("UPDATE tbl_barang SET stok=$tambah_stok WHERE kd_barang='$kd_barang'");
				
			}
		}
		
	}
	echo json_encode(array('add_status'=>true));
	
?>