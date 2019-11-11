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
        <title>Port Replay | Gudang - Diskon</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php include 'component/head.php'; ?>
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
                    <div id="stok-sort" data-sort="<?php if(sort_available()===true) { echo "available"; }elseif(sort_out()===true) {echo "out";}else {echo"all";} ?>"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-7 left-reset">
                                <button class="btn btn-sm btn-primary" id="tambah-diskon">Tambah Diskon</button>                        
                            </div>
                            <div class="col-md-5 text-right">
                               
                            </div>
                            
                            <br><br>
                            <div id="diskon-barang"></div>
                        </div>
                    </div>
                </section>
            </div><!-- /.content-wrapper -->
        </div><!-- ./wrapper -->
        <?php include 'component/javas.php'; ?>
        <script src="../vendor/bootstrap-dialog/js/bootstrap-dialog.min.js"></script>
        <script src="../vendor/formvalidation/js/formValidation.min.js"></script>
        <script src="../vendor/formvalidation/js/framework/bootstrap.js"></script>
        <script src="app/diskon.js"></script>
    </body>
</html>