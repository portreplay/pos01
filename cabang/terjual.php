<?php 
  include 'core/init.php';
  if(sudah_login()===false) {
    alihkan('login.php');
  }else if(cek_cabang_access()===false and is_admin($_SESSION['kd_pegawai'])===false) {
    alihkan('../error.php?type=access_denie&ref=cabang');
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Port Replay | Toko - Retur Barang</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php include 'component/head.php'; ?>

    </head>
    <body class="skin-purple">
        <div class="wrapper">
        <?php include 'component/header.php'; ?>
            <?php include 'component/left-menu.php'; ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Page header -->
                <section class="content-header">
                  <h1>
                    Terjual
                    <small>Penjualan Barang</small>
                  </h1>
                  <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="active">Terjual </li>
                  </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="terjual"></div>
                        </div>
                    </div>
                </section>
            
            </div><!-- /.content-wrapper -->
        </div><!-- ./wrapper -->
    <?php include 'component/javas.php'; ?>
    <script src="app/terjual.js"></script>
    </body>
</html>