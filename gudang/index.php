<?php 
    include 'core/init.php';
    if(sudah_login()===false) {
        alihkan('login.php');
    }else if(cek_gudang_access()===false and is_admin($_SESSION['kd_pegawai'])===false) {
        alihkan('../error.php?type=access_denie&ref=gudang');
    }
    if(isset($_GET['view_year']) and !empty($_GET['view_year'])) {
        $year = $_GET['view_year'];
    }else {
        $year = date('Y');
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Port Replay | Dashboard Gudang</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <?php include 'component/head.php'; ?>
    <script src="../vendor/amcharts/amcharts.js"></script>
    <script src="../vendor/amcharts/serial.js"></script>
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
            <div class="box-header text-center">
                <h3 class="box-title text-center">Statistik Penjualan Tahun <?php echo $year; ?></h3>
                <form action="" method="get" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="view_year" id="view_year" class="form-control input-sm" placeholder="Ubah Tahun">
                        <button type="submit" class="btn btn-sm btn-success">Tampilkan</button>
                        <button type="button" class="btn btn-sm btn-warning" onclick="window.location='index.php?view_year=<?php echo date('Y'); ?>';">Tahun Sekarang</button>
                    </div>
                 </form>
            </div>
            <div class="col-md-12">
              <div id="statistik" style="width: 100%; height: 450px;"></div>
            </div>
          </div>
        </section>
      </div><!-- /.content-wrapper -->
    </div><!-- ./wrapper -->
    <?php include 'component/javas.dashboard.php'; ?>
    <script>
         var chart = AmCharts.makeChart("statistik", {
            "theme": "light",
            "type": "serial",
            "path": "../vendor/amchart/",
            "legend": {
                "align": "center",
                "equalWidths": false,
                "valueAlign": "left",
                "valueText": "[[category]]",
                "valueWidth": 100
            },
            "dataProvider": [
                                <?php for($i=1; $i<=12; $i++) { 
                                    $get_terjual = $mysqli->query("SELECT COUNT(kd_penjualan) AS jumlah_terjual FROM tbl_penjualan_header WHERE YEAR(tanggal_penjualan)='$year' AND MONTH(tanggal_penjualan)=$i");
                                    $get_total_perbulan = $get_terjual->fetch_array();
                                ?>
                                    {"bulan": "<?php echo bulan_indo($i); ?>","penjualan": <?php echo $get_total_perbulan['jumlah_terjual']; ?>},
                                <?php } ?>
                            ],
            "valueAxes": [{
                "stackType": "3d",
                "position": "left",
                "integersOnly": true,
                "title": "Jumlah",
            }],
            "startDuration": 1,
            "graphs": [{
                "balloonText": "Jumlah Penjualan [[category]] (<?php echo $year; ?>) : <b>[[value]]</b>",
                "fillAlphas": 0.9,
                "lineAlpha": 0.2,
                "title": "Penjualan",
                "type": "column",
                "valueField": "penjualan"
            }],
            "plotAreaFillAlphas": 0.1,
            "depth3D": 60,
            "angle": 30,
            "categoryField": "bulan",
            "categoryAxis": {
                "gridPosition": "start"
            },
            "export": {
                "enabled": true
             }
        });
        jQuery('.chart-input').off().on('input change',function() {
            var property    = jQuery(this).data('property');
            var target      = chart;
            chart.startDuration = 0;

            if ( property == 'topRadius') {
                target = chart.graphs[0];
                if ( this.value == 0 ) {
                  this.value = undefined;
                }
            }

            target[property] = this.value;
            chart.validateNow();
        });
    </script>
    </body>
</html>