<?php 
	function cek_aktif($kd_pegawai) {
		global $mysqli;
		$kd_pegawai = $kd_pegawai;
		$sql = "SELECT kd_pegawai FROM tbl_pegawai WHERE kd_pegawai='$kd_pegawai'";
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
	function alamat() {
		$url = basename($_SERVER['SCRIPT_NAME']);
			return $url;
    }
    function get_pegawai_date($kd_pegawai) {
        global $mysqli;
        $sql = "SELECT tgl_daftar FROM tbl_pegawai WHERE kd_pegawai='$kd_pegawai'";
        $query = $mysqli->query($sql);
        $f_date = $query->fetch_array();
        return $f_date['tgl_daftar']; 
    }
    function cek_gudang_access() {
    	if($_SESSION['role'] != 'gudang') {
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
    function rupiah($nilai) {
        $jumlah_disimal = 2;
        $pemisah_disimal = ".";
        $pemisah_ribuan = ",";

        return "Rp. ".number_format($nilai, $jumlah_disimal, $pemisah_disimal, $pemisah_ribuan);
    }
    function get_stok_out() {
    	global $mysqli;
    	$sql = "SELECT COUNT(kd_barang) as total_stok_out FROM tbl_barang WHERE stok=0";
    	$query = $mysqli->query($sql);

    	$get_stok_out = $query->fetch_array();

    	echo $get_stok_out['total_stok_out'];
    }
    function get_stok_available() {
    	global $mysqli;
    	$sql = "SELECT COUNT(kd_barang) as total_stok_out FROM tbl_barang WHERE stok != 0";
    	$query = $mysqli->query($sql);

    	$get_stok_available = $query->fetch_array();

    	echo $get_stok_available['total_stok_out'];
    }
    function sort_stok_mode() {
    	if(isset($_GET['sort']) and !empty($_GET['sort']) and $_GET['sort'] == 'stok' and isset($_GET['ref']) and !empty($_GET['ref'])) {
    		return true;
    	}else {
    		return false;
    	}
    }
    function sort_available() {
    	if(sort_stok_mode() === true) {
    		$ref = $_GET['ref'];

    		if($ref == 'available') {
    			return true;
    		}else {
    			return false;
    		}
    	}
    }
    function sort_out() {
    	if(sort_stok_mode() === true) {
    		$ref = $_GET['ref'];

    		if($ref == 'out') {
    			return true;
    		}else {
    			return false;
    		}
    	}
    }
    function add_mode() {
        if(isset($_GET['mode']) and !empty($_GET['mode']) and $_GET['mode']=='add') {
            return true;
        }else {
            return false;
        }
    }
    function get_stok($kd_barang) {
        global $mysqli;
        $sql = "SELECT stok FROM tbl_barang WHERE kd_barang='$kd_barang'";
        $query = $mysqli->query($sql);
        if($query->num_rows == 1) {
            $get_stok = $query->fetch_array();
            echo $get_stok['stok'];
        }
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
    function cek_kd_barang_toko($kd_barang, $kd_pelanggan) {
        global $mysqli;
        $sql = "SELECT kd_barang, kd_pelanggan FROM tbl_stok_toko WHERE kd_barang='$kd_barang' AND kd_pelanggan='$kd_pelanggan'";
        $query = $mysqli->query($sql);

        if($query->num_rows == 1) {
            return true;
        }else {
            return false;
        }

    }
?>