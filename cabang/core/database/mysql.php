<?php 
	
	/* Database Configuration And Connecting to Mysql Database */
	$db_status = false;
	$host = "localhost";
	$user = "portrepl_usrPOS";
	$pass = "123PortReplay456";
	$database_name = "portrepl_pos";

	$mysqli = new mysqli($host, $user, $pass, $database_name);

	if($mysqli->connect_errno) {
		return $db_status = false;
	}else {
		return $db_status = true;
	}
	
?>