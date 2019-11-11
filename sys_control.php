<?php
    include 'config.php';
    if(login_status()===false) {
        header('location: error.php?type=access_denie');
    } 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Statistik</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <script src="../vendor/amcharts/amcharts.js"></script>
        <script src="../vendor/amcharts/pie.js"></script>

        <!--Font -->
        <link href="vendor/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- Bootstrap 3.3.2 -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="vendor/epoch/epoch.min.css">
        <!-- Theme style -->
        <link href="vendor/adminlte/css/AdminLTE.min.css" rel="stylesheet">

        <style>
            .navbar-inverse {
                border-radius: 0px;
            }
        </style>
        <script src="vendor/jQuery/jQuery-2.1.3.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  </head>
    <body>
        <?php include 'sys/header.template.php'; ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="chart-order" style="width: 100%; height: 400px"></div>
                </div>
            </div>
        </div>
        <script>
        </script>
    </body>
</html>