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
        <title>Port Replay | Gudang - Retur Barang</title>
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
                    Return
                    <small>Retur Barang</small>
                  </h1>
                  <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="active">Retur </li>
                  </ol>
                </section>
                <!-- Main content -->
                <?php 
                    if(add_mode()==true) {
                        include 'add_retur.php';
                    }else {
                ?>
                <section class="content">
                    <div class="row">
                        <div class="col-md-12 left-reset">
                            <div class="col-md-7">
                                <button class="btn btn-sm btn-primary" type="button" id="tambah_retur">Tambah Retur Baru</button>
                            </div>
                        </div>
                        <br><br>
                        <div class="col-md-12">
                            <div id="retur-barang"></div>
                        </div>
                    </div>
                </section>
                <?php } ?>
            </div><!-- /.content-wrapper -->
        </div><!-- ./wrapper -->
    <?php include 'component/javas.php'; ?>
    <script src="app/retur.js"></script>
    <script>
         var t_tambah_retur = $('#tambah_retur');
         t_tambah_retur.click(function() {
            BootstrapDialog.show({
                title: '<i class="fa fa-refresh"></i> Pembuatan Retur Barang',
                message: $('<div></div>').load('modal/form-tambah-retur-barang.php'),
                animate: false,
                type:  BootstrapDialog.TYPE_WARNING,
                onhide: function() {
                    
                }
            });
         });
    </script>
    </body>
</html>