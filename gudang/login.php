<?php
    include 'core/init.php';
    if(sudah_login()===true) {
        alihkan('index.php');
    } 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Port Replay | Login</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Theme style -->
        <link href="../vendor/adminlte/css/AdminLTE.min.css" rel="stylesheet">
        <link href="css/login.css" rel="stylesheet">
  </head>
    <body class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="../../index2.html"><b>Port</b>Replay</a>
                <h3>Gudang Area</h3>
            </div><!--.login-logo -->
            <div class="login-box-body">
               <form action="" id="form-login-gudang" method="post">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="username" placeholder="Masukan Username atau Email"/>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="password" placeholder="Masukan Password Anda"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">    
                            <a href="../cabang" class="btn btn-block btn-flat btn-success">Ke Toko</a>
                        </div><!-- /.col -->
                        <div class="col-xs-6">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
                        </div><!-- /.col -->
                    </div>
                </form>
            </div><!--.login-box -->
        </div>
        <!-- jQuery 2.1.3 -->
        <script src="../vendor/jQuery/jQuery-2.1.3.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="../vendor/formvalidation/js/formValidation.min.js"></script>
        <script src="../vendor/formvalidation/js/framework/bootstrap.js"></script>
        <script src="app/login.js"></script>
    </body>
</html>