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
                            <div class="alert alert-warning text-center">
                                Dalam Proses Export Barang akan membutuhkan waktu yang cukup lama tergantung banyaknya jumlah data barang. Jika anda sedang mengelola(tambah barang), silahkan klik tombol <b>New Tab</b>
                                <br>
                                <a class="btn btn-info btn-sm" href="index.php" target="_blank">New Tab</a>
                            </div>             
                        </div>
                        <div class="col-md-12">
                            <div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                    <img src="images/excel.png">
                                    <div class="caption text-center">
                                        <h3>Excel Format</h3>
                                        <p>Export Data Barang ke format Microsoft Excel</p>
                                        <p><a href="excel.php?c=1" class="btn btn-primary" role="button"><i class="fa fa-cloud-download"></i> Mulai Export</a></p>            
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                    <img src="images/pdf.png">
                                    <div class="caption text-center">
                                        <h3>PDF Format</h3>
                                        <p>Export Data Barang ke format PDF</p>
                                        <p><a href="pdf.php?c=1" class="btn btn-primary" role="button"><i class="fa fa-cloud-download"></i> Mulai Export</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div><!-- /.content-wrapper -->
        </div><!-- ./wrapper -->
    <?php include 'component/javas.php'; ?>
    </body>
</html>