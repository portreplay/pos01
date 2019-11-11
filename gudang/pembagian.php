<?php 
  include 'core/init.php';
  if(sudah_login()===false) {
    alihkan('login.php');
  }else if(cek_gudang_access()===false) {
    alihkan('../error.php?type=access_denie');
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Port Replay | Gudang - Pembagian</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php include 'component/head.php'; ?>
        <link rel="stylesheet" href="../vendor/openjs/grid.css">
        <link rel="stylesheet" href="../vendor/bootstrap-dialog/css/bootstrap-dialog.min.css">
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
                            <button class="btn btn-sm btn-primary" id="tambah-pembagian">Tambah Pembagian Barang</button>
                            <br><br>
                            <table class="pembagian" action="core/get_data/pembagian.php">
                                <tr>
                                    <th col="kd_pembagian">Kode pembagian</th>
                                    <th col="nm_pembagian">Nama pembagian</th>
                                    <th col="stok" type="text">Stok</th>
                                    <th col="harga_beli" type="text">Harga Beli</th>
                                    <th col="harga" type="text">Harga</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </section>
            </div><!-- /.content-wrapper -->
        </div><!-- ./wrapper -->
        <?php include 'component/javas.php'; ?>
        <script src="../vendor/bootstrap-dialog/js/bootstrap-dialog.min.js"></script>
        <script src="../vendor/formvalidation/js/formValidation.min.js"></script>
        <script src="../vendor/formvalidation/js/framework/bootstrap.js"></script>
        <script src="../vendor/openjs/root.js"></script>
        <script src="../vendor/openjs/grid.js"></script>
        <script src="app/pembagian.js"></script>
    </body>
</html>