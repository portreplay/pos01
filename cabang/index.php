<?php 
	include 'core/init.php';
	if(sudah_login()=== false) {
		alihkan('login.php');
	}elseif(cek_cabang_access()===false and is_admin($_SESSION['kd_pegawai']) === false) {
		alihkan('../error.php?type=access_denie&ref=cabang');
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
    <title>Port Replay | Dashboard Toko</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <?php include 'component/head.php'; ?>
    <script src="../vendor/amcharts/amcharts.js"></script>
     <script src="../vendor/amcharts/pie.js"></script>
    <script src="../vendor/amcharts/serial.js"></script>
  </head>
  <body class="skin-purple">
    <div class="wrapper">
      
      <?php include 'component/header.php'; ?>
      	<?php include 'component/left-menu.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
       <?php include 'component/page-header.php'; ?>

        <!-- Main content -->
        <section class="content">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-12">
                    <div class="box box-solid" style="position: relative;">
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
                        <div class="box-body border-radius-none">
                            <div id="statistik_terjual" style="width: 100%; height: 400px;"></div>
                        </div><!-- /.box-body -->    
                    </div>
                </div><!-- /.col -->
                <div class="col-md-12">
                    <div class="box box-solid" style="position: relative;">
                        <div class="box-header text-center">
                            <h3 class="box-title text-center">Retur Barang  Perbulan <?php echo $year; ?></h3>
                        </div>
                        <div class="box-body border-radius-none">
                            <div id="statistik_retur" style="width: 100%; height: 400px;"></div>
                        </div><!-- /.box-body -->    
                    </div>
                </div><!-- /.col -->
             
            </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
    </div><!-- ./wrapper -->
    <?php include 'component/javas.dashboard.php'; ?>
    <script>
      var chart = AmCharts.makeChart("statistik_terjual", {
            "type": "serial",
            "theme": "light",
            "path": "../vendor/amcharts/",
            "dataDateFormat": "YYYY-MM-DD",
            "valueAxes": [{
                "id": "v1",
                "axisAlpha": 0,
                "integersOnly": true,
                "position": "left"
            }],
            "balloon": {
                "borderThickness": 1,
                "shadowAlpha": 0
            },
            "graphs": [{
                "id": "g1",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "hideBulletsCount": 50,
                "lineThickness": 2,
                "title": "red line",
                "useLineColorForBulletBorder": true,
                "valueField": "value",
                "balloonText": "<div style='margin:5px; font-size:19px;'><span style='font-size:13px;'>[[category]]</span><br>Jumlah Terjual : [[value]]</div>"
            }],
            "chartScrollbar": {
                "graph": "g1",
                "scrollbarHeight": 80,
                "backgroundAlpha": 0,
                "selectedBackgroundAlpha": 0.1,
                "selectedBackgroundColor": "#888888",
                "graphFillAlpha": 0,
                "graphLineAlpha": 0.5,
                "selectedGraphFillAlpha": 0,
                "selectedGraphLineAlpha": 1,
                "autoGridCount":true,
                "color":"#AAAAAA"
            },
            "chartCursor": {
                "pan": true,
                "valueLineEnabled": true,
                "valueLineBalloonEnabled": true,
                "cursorAlpha":0,
                "valueLineAlpha":0.2
            },
            "categoryField": "bulan",
            "categoryAxis": {
                "parseDates": false,
                "dashLength": 1,
                "minorGridEnabled": true,
                "position": "top"
            },
        
            "export": {
                "enabled": true
            },
            "dataProvider":[
                            <?php 
                                for($i=1; $i<=12; $i++) {
                                    
                                    $get_terjual = $mysqli->query("SELECT COUNT(kd_penjualan) AS jumlah_terjual FROM tbl_terjual_toko WHERE YEAR(tanggal)='$year' AND MONTH(tanggal)=$i");
                                    $get_total_perbulan = $get_terjual->fetch_array();
                            ?>
                                {"bulan": "<?php echo bulan_indo($i); ?>","value": <?php echo $get_total_perbulan['jumlah_terjual']; ?>},
                            <?php } ?>
                            ]
        });

        chart.addListener("rendered", zoomChart);

        zoomChart();

        function zoomChart() {
            chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
        }

        //chart retur
        var chart_retur = AmCharts.makeChart( "statistik_retur", {
          "type": "pie",
          "theme": "light",
          "path": "../vendor/amcharts/",
          "legend": {
            "markerType": "circle",
            "position": "right",
            "marginRight": 80,
            "autoMargins": false
          },
          "dataProvider": [ 
                            <?php  
                                for($a = 1; $a<12;  $a++) {
                            ?>
                            {"bulan": "<?php echo bulan_indo($a); ?>", "litres": 256.9},
                            <?php } ?>
                          ],
          "valueField": "litres",
          "titleField": "bulan",
          "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
          "export": {
            "enabled": true
          }
        } );
    </script>
  </body>
</html>