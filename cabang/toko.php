<?php 
  include 'core/init.php';
  if(sudah_login()===false) {
    alihkan('login.php');
  }else if(cek_cabang_access()===false and is_admin($_SESSION['kd_pegawai'])===false) {
    alihkan('../error.php?type=access_denie&ref=cabang');
  }elseif(!isset($_GET['following']) and empty($_GET['following']) and cek_pelanggan($_GET['following'])) {
    alihkan('../error.php?type=access_denie&ref=cabang');
  }
  $kd_pelanggan = $_GET['following'];
  $get_info_toko = $mysqli->query("SELECT * FROM tbl_pelanggan WHERE kd_pelanggan=$kd_pelanggan");
  $data_toko = $get_info_toko->fetch_array();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Port Replay | Toko - Stok Barang</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php include 'component/head.php'; ?>
    </head>
    <body class="skin-purple">
        <div class="wrapper">
        <?php include 'component/header.php'; ?>
            <div class="not_print">
                <?php include 'component/left-menu.php'; ?>
            </div>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Page header -->
                <section class="content-header not_print">
                  <h1>
                    <?php echo $data_toko['nm_pelanggan']; ?>
                    <small>Kode Toko : <?php echo $kd_pelanggan; ?></small>
                  </h1>
                  <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="active">Toko : <?php echo $kd_pelanggan; ?> </li>
                  </ol>
                </section>
                <!-- Main content -->
                <?php 
                    if(add_mode()==true) {
                        include 'add_penjualan.php';
                    }else {
                ?>
                <section class="content">
                    <input type="hidden" name="kd_pelanggan" value="<?php echo $_GET['following']; ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-7 left-reset">
                                <form action="" method="POST" role="form" class="form-inline">
                                    <div class="form-group">
                                        <label for="">Laporan Penjualan Bulanan</label>
                                        <select name="lap_penjualan" id="lap_penjualan" class="form-control" required="required">
                                            <option value="">Pilih Bulan</option>
                                            <?php 
                                               
                                                $get_lap_terjual = $mysqli->query("SELECT  DISTINCT DATE_FORMAT(tanggal, '%Y-%m') as tanggal FROM tbl_terjual_toko WHERE kd_pelanggan=$kd_pelanggan");
                                                while($tanggal_lap = $get_lap_terjual->fetch_array()) { 
                                                    $time = strtotime($tanggal_lap['tanggal']);
                                                    $get_date = getDate($time);
                                                    

                                                    
                                            ?>
                                            <option value="<?php echo $tanggal_lap['tanggal']; ?>"><?php echo bulan_indo($get_date['mon']).' - '.$get_date['year']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </form>

                            </div>
                            <div class="col-md-5 right-reset text-right">
                                <a href="?following=<?php echo $kd_pelanggan; ?>&mode=add" class="btn btn-primary" id="add_penjualan">Tambah Data Penjualan</a>
                                <div class="msg_update"></div>
                            </div>
                            <br><br>
                            <div id="stok_toko"></div>
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
    <?php if(add_mode() === false) { ?>
    <script src="app/stok_barang.js"></script>
    <?php } ?>
    <script>
        $('#lap_penjualan').change(function(){
           // alert($(this).val());
            var report_date = $(this).val();
            if(report_date != '') {
                window.location='print_lap.php?following=<?php echo $kd_pelanggan ?>&mode=report&ref_date='+report_date;
            }
        });
        <?php if(add_mode() ===true) { ?>
        $('#tanggal').datepicker({
            format: 'yyyy-mm-dd'
        });

        /* Tambah Barang */ 
        $('#tambah_barang').click(function(){
            var kd_pelanggan = $(this).attr('data-id');
            BootstrapDialog.show({
                title: '<i class="fa fa-plus"></i> Tambah Barang Data Penjualan',
                message: $('<div></div>').load('popup/form-tambah-barang-penjualan.php?follow=<?php echo $kd_pelanggan; ?>'),
                animate: false,
                type:  BootstrapDialog.TYPE_SUCCESS,
                onhide: function() {
                    
                }
            });
        });
        <?php } ?>
    </script>
    </body>
</html>