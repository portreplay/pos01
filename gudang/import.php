<?php 
  include 'core/init.php';
  if(sudah_login()===false) {
    alihkan('login.php');
  }else if(cek_gudang_access()===false and is_admin($_SESSION['kd_pegawai'])===false) {
    alihkan('../error.php?type=access_denie&ref=gudang');
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Port Replay | Gudang - Barang</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <?php include 'component/head.php'; ?>
    <link rel="stylesheet" href="../vendor/openjs/grid.css">
  </head>
  <body class="skin-green">
    <div class="wrapper">
     <?php include 'component/header.php'; ?>
      <?php include 'component/left-menu.php'; ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <?php include 'component/page-header.php'; ?>
        <!-- Main content -->
        <section class="content">
         <div class="row">
            <div class="col-md-12">
              
            </div>
         </div>
        </section>
      </div><!-- /.content-wrapper -->
    </div><!-- ./wrapper -->
    <?php include 'component/javas.php'; ?>
    </body>
</html>