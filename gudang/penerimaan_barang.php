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
        <title>Port Replay | Gudang - penerimaan_barang</title>
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
                <?php 
                    if(add_mode()===true) {
                        include 'new_penerimaan_barang.php';
                    } else {
                ?>
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-7 left-reset">
                                <a href="?mode=add" class="btn btn-sm btn-primary">Tambah Data penerimaan_barang</a>                        
                            </div>
                            <div class="col-md-5 text-right">
                               
                            </div>
                            
                            <br><br>
                            <div id="penerimaan_barang"></div>
                        </div>
                    </div>
                </section>
                <?php } ?>
            </div><!-- /.content-wrapper -->
        </div><!-- ./wrapper -->
        <?php include 'component/javas.php'; ?>
        <script src="../vendor/bootstrap-dialog/js/bootstrap-dialog.min.js"></script>
        <script src="../vendor/formvalidation/js/formValidation.min.js"></script>
        <script src="../vendor/formvalidation/js/framework/bootstrap.js"></script>
        <script src="../vendor/accounting/accounting.min.js"></script>
        <?php if(add_mode()===false) { ?>
        <script src="app/penerimaan_barang.js"></script>
        <?php }else { ?>
        <script>
            var tombol_tambah_penerimaan_barang = $('#tambah-penerimaan_barang');
            tombol_tambah_penerimaan_barang.click(function(){
                BootstrapDialog.show({
                    title: '<i class="fa fa-plus"></i> Tambah Barang Untuk penerimaan_barang',
                    message: $('<div></div>').load('modal/form-tambah-barang-penerimaan_barang.php'),
                    animate: false,
                    type:  BootstrapDialog.TYPE_SUCCESS,
                });
            });
            $('#tanggal').datepicker({
                
                format: 'yyyy-mm-dd'
            
            }).on('changeDate', function(e) {
                    // Revalidate the date field
                    $('#form-tambah-penerimaan_barang').formValidation('revalidateField', 'tanggal');
                });
        </script>
        <?php } ?>
    </body>
</html>