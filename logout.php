<?php 
	include 'init.php';
    if(sudah_login()===true) {
    
  		session_unset();
        session_destroy();
        alihkan('login.php');
    
    }
?>