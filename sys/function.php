<?php 
	function login_status() {
		global $mysqli;
		if(isset($_SESSION['username']) and !empty($_SESSION['username']) and isset($_SESSION['kd_pegawai']) and !empty($_SESSION['kd_pegawai'])) {
			$cek_admin = $mysqli->query("SELECT kd_pegawai FROM tbl_pegawai WHERE kd_pegawai='".$_SESSION['kd_pegawai']."' AND level='admin'");

			if($cek_admin->num_rows == 1) {
				return true;
			}else {
				return false;
			}
		}else {
			return false;
		}
	}
	function file_on() {
		$url = basename($_SERVER['SCRIPT_NAME']);
		return $url;
	}
	function update_mode() {
		if(isset($_GET['router']) and !empty($_GET['router']) and isset($_GET['follow']) and !empty($_GET['follow']) and $_GET['router'] == 'update') {
			return true;
		}else {
			return false;
		}
	}
	function add_mode() {
		if(isset($_GET['router']) and !empty($_GET['router']) and $_GET['router'] == 'new') {
			return true;
		}else {
			return false;
		}
	}
	function search_mode() {
		if(isset($_GET['q']) and !empty($_GET['q'])) {
			return true;
		}else {
			return false;
		}
	}
	function cek_username_exist($username) {
		global $mysqli;
		$sql = "SELECT username FROM tbl_pegawai WHERE username='$username'";
		$query = $mysqli->query($sql);

		if($query->num_rows == 1) {
			return true;
		}else {
			return false;
		}
	}
	function cek_toko($kd_pelanggan) {
		global $mysqli;
		$sql = "SELECT kd_pelanggan FROM tbl_pelanggan WHERE kd_pelanggan='$kd_pelanggan'";
		$query = $mysqli->query($sql);

		if($query->num_rows == 1) {
			return true;
		}else {
			return false;
		}
	}
?>