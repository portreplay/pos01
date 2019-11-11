<?php 
	include '../init.php';
	if(isset($_GET['ref']) and !empty($_GET['ref']) and $_GET['ref'] == 'add') {
		if(isset($_POST['kd_barang']) and !empty($_POST['kd_barang'])) {
			
			$kode_barang =  $_POST['kd_barang'];
			foreach ($kode_barang as $kd_barang) {
				
				$jumlah_pengadaan = $_POST['jumlah_pengadaan'];
				$get_info_barang = $mysqli->query("SELECT * FROM tbl_barang WHERE kd_barang='$kd_barang'");
				$data_info_barang = $get_info_barang->fetch_array();

				$nama_barang = $data_info_barang['nm_barang'];
				$harga = $data_info_barang['harga'];
				$stok = $data_info_barang['stok'];

				if(!isset($_SESSION['sesi_barang'])) {
					$_SESSION['sesi_barang'] = array();
				}
				if(array_key_exists($kd_barang, $_SESSION['sesi_barang'])) {
					echo json_encode(array('add_status'=>false));
					//echo $_SESSION['sesi_barang'][$kd_barang]['nm_barang'];
				}else {
					$_SESSION['sesi_barang'][$kd_barang]['nm_barang'] = $nama_barang;  
					$_SESSION['sesi_barang'][$kd_barang]['jumlah_pengadaan'] = $jumlah_pengadaan; 
					$_SESSION['sesi_barang'][$kd_barang]['harga'] = $harga;
					$_SESSION['sesi_barang'][$kd_barang]['stok'] = $stok;
					echo json_encode(array('add_status'=>true, 'kd_barang'=>$kd_barang, 'nm_barang'=>$nama_barang, 'jumlah_pengadaan'=>$jumlah_pengadaan, 'harga'=>$harga)); 
				}
			}
		}
	}elseif(isset($_GET['ref']) and !empty($_GET['ref']) and $_GET['ref'] == 'remove') {
		if(isset($_POST['follow']) and !empty($_POST['follow'])) {
			$kd_barang = $_POST['follow'];
			unset($_SESSION['sesi_barang'][$kd_barang]);
			unset($_SESSION['sesi_barang'][$kd_barang]['nm_barang']);
			unset($_SESSION['sesi_barang'][$kd_barang]['jumlah_pengadaan']);
			unset($_SESSION['sesi_barang'][$kd_barang]['harga']);
			unset($_SESSION['sesi_barang'][$kd_barang]['stok']);
			unset($_SESSION['sesi_barang'][$kd_barang]['diskon']);
			echo json_encode(array('remove_status'=>true));
		}
	}else {
		echo 'tidak ada aksi';
	}
?>