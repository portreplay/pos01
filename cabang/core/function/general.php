<?php

	function get_toko_id() {
    	if(isset($_GET['following']) and !empty($_GET['following'])) {
    		$toko_id = $_GET['following'];
    		return  $toko_id;
    	}
    }
	function cek_kd_pelanggan($kd_pelanggan){
		global $mysqli;
		$kd_pelanggan = $kd_pelanggan;
		$sql = "SELECT kd_pelanggan FROM tbl_pelanggan WHERE kd_pelanggan='$kd_pelanggan'";
		$query = $mysqli->query($sql);
		if($query->num_rows == 1) {
			return true;
		}else {
			return false;
		}
	}
	function cek_aktif($kd_pegawai) {
		global $mysqli;
		$kd_pegawai = $kd_pegawai;
		$sql = "SELECT kd_pegawai FROM tbl_pegawai WHERE kd_pegawai='$kd_pegawai' AND active=1";
		$query = $mysqli->query($sql);
		if($query->num_rows == 1) {
			return true;
		}else {
			return false;
		}
	}
	function cek_total_barang() {
		global $mysqli;
		$sql = "SELECT COUNT(kd_barang) as total_barang FROM tbl_barang";
		$query = $mysqli->query($sql);
		$f_total = $query->fetch_array();
		echo $f_total['total_barang'];
	}
	function sudah_login() {
		if(isset($_SESSION['username']) and !empty($_SESSION['username']) and isset($_SESSION['kd_pegawai']) and !empty($_SESSION['kd_pegawai'])) {
			return true;
		}else {
			return false;
		}
	}
	function alihkan($url) {
		return header('location: '.$url.'');
	}
	function get_nama($kd_pegawai) {
		global $mysqli;
		$sql = "SELECT nama FROM tbl_pegawai WHERE kd_pegawai='$kd_pegawai'";
		$query = $mysqli->query($sql);
		$f_nama = $query->fetch_array();
		return $f_nama['nama']; 
	}
    function get_pegawai_date($kd_pegawai) {
        global $mysqli;
        $sql = "SELECT tgl_daftar FROM tbl_pegawai WHERE kd_pegawai='$kd_pegawai'";
        $query = $mysqli->query($sql);
        $f_date = $query->fetch_array();
        return $f_date['tgl_daftar']; 
    }
	function alamat() {
		$url = basename($_SERVER['SCRIPT_NAME']);
			return $url;
    }
    function cek_cabang_access() {
    	if($_SESSION['role'] != 'cabang') {
    		return false;
    	}else {
    		return true;
    	}
    }
    function is_admin($kd_pegawai) {
    	global $mysqli;
    	$sql = "SELECT level FROM tbl_pegawai WHERE kd_pegawai='$kd_pegawai' AND level='admin'";
    	$query = $mysqli->query($sql);
    	if($query->num_rows == 1) {
    		return true;
    	}else {
    		return false;
    	}
    }
    function add_mode() {
    	if(isset($_GET['mode']) and !empty($_GET['mode']) and $_GET['mode']=='add') {
    		return true;
    	}else {
    		return false;
    	}
    }
    function report_mode() {
    	if(isset($_GET['mode']) and !empty($_GET['mode']) and $_GET['mode']=='report' and isset($_GET['ref_date']) and !empty($_GET['ref_date'])) {
    		return true;
    	}else {
    		return false;
    	}
    }
    function get_kode_penjualan($kd_pelanggan) {
    	global $mysqli;
    	$sql = "SELECT kd_penjualan FROM tbl_terjual_toko ORDER BY kd_penjualan DESC LIMIT 1";
    	$query = $mysqli->query($sql);

    	$get_kode = $query->fetch_array();
    	$kd_penjualan = $get_kode['kd_penjualan'];

    	$get_end_number_index = strlen($kd_penjualan);

    	$get_latest_number = substr($kd_penjualan, $get_end_number_index-1);

    	// T-kode pelanggan/toko - tanggal penjualan - kode pegawai - nomer terjual
    	echo "T-".$kd_pelanggan."-".date('Ymd')."-".$_SESSION['kd_pegawai']."-".($get_latest_number+1); 
    }
    function get_stok($kd_barang, $kd_pelanggan) {
        global $mysqli;
        $sql = "SELECT stok FROM tbl_stok_toko WHERE kd_barang='$kd_barang' AND kd_pelanggan='$kd_pelanggan'";
        $query = $mysqli->query($sql);
        if($query->num_rows == 1) {
            $get_stok = $query->fetch_array();
            echo $get_stok['stok'];
        }
    }
    function rupiah($nilai) {
        $jumlah_disimal = 2;
        $pemisah_disimal = ".";
        $pemisah_ribuan = ",";

        return "Rp. ".number_format($nilai, $jumlah_disimal, $pemisah_disimal, $pemisah_ribuan);
    }
    function bulan_indo($bulan) {
      Switch ($bulan){
        case 1 : $bulan="Januari";
            Break;
        case 2 : $bulan="Februari";
            Break;
        case 3 : $bulan="Maret";
            Break;
        case 4 : $bulan="April";
            Break;
        case 5 : $bulan="Mei";
            Break;
        case 6 : $bulan="Juni";
            Break;
        case 7 : $bulan="Juli";
            Break;
        case 8 : $bulan="Agustus";
            Break;
        case 9 : $bulan="September";
            Break;
        case 10 : $bulan="Oktober";
            Break;
        case 11 : $bulan="November";
            Break;
        case 12 : $bulan="Desember";
            Break;
        }
        return $bulan;

    }
    function get_total_pendapatan($kd_pelanggan, $bulan){
        global $mysqli;
        $total_pendapatan = 0;
        $sql = "SELECT * FROM tbl_terjual_toko WHERE kd_pelanggan='$kd_pelanggan' AND MONTH(tanggal)=$bulan";
        $get_pedapatan = $mysqli->query($sql);
        while($data_pendapatan = $get_pedapatan->fetch_array()) {
            $total_pendapatan += $data_pendapatan['total_harga'];
        }
        return $total_pendapatan;
    }

?>