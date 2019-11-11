<?php
    error_reporting(0); 
    include 'config.php'; 
    $info_file = file_get_contents('info.json');
    $info_app = json_decode($info_file);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Start</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <!-- Theme style -->
        <link href="vendor/adminlte/css/AdminLTE.min.css" rel="stylesheet" type="text/css">
  </head>
    <body class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="index.php"><b>Port </b>Replay</a>
            </div><!--.login-logo -->
            <div class="login-box-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4>Silahkan Login berdasarkan Jodesk Anda</h4>
                        <div class="col-md-6">
                            <a href="gudang/" class="btn btn-lg btn-success" <?php if($db_status=== false) { ?> disabled="disabled" <?php } ?>>Gudang</a>
                        </div>
                        <div class="col-md-6">
                            <a href="cabang/" class="btn btn-lg btn-primary" <?php if($db_status=== false) { ?> disabled="disabled" <?php } ?>>Toko</a>
                        </div>
                    </div>
                </div>
            </div><!--.login-box -->
            <br>
            <div class="row">
                <div class="col-md-12 text-center">
                    <?php if($db_status === true) { ?>
                        Database Status : <span class="label label-success">Ok!</span>    
                    <?php }else { ?>
                        Database Status : <span class="label label-danger">Port Replay Database is Off</span>
                    <?php } ?>
                </div>
                <div class="col-md-12 text-center">
                    <p>
                        <b>Versi Software :</b> <?php echo $info_app->version; ?></a>
                    </p>
                </div>
            </div>
        </div>
    <!-- jQuery 2.1.3 -->
    <script src="vendor/jQuery/jQuery-2.1.3.min.js"></script>
    </body>
</html>