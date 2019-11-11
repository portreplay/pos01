<?php 
	include '../init.php';
	if(isset($_POST['id_diskon']) and !empty($_POST['id_diskon'])) {
		$id_diskon = $_POST['id_diskon'];

		$delete_diskon = $mysqli->query("DELETE FROM tbl_diskon WHERE id_diskon='$id_diskon'");

		if($delete_diskon) {
			echo 'ok';
		}else {
			echo 'error';
		}
	}
?>