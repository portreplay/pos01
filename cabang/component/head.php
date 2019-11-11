    <!-- Open Sans -->
    <Link href="../vendor/open-sans/css/open-sans.css" rel="stylesheet">
    <!-- Bootstrap 3.3.2 -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/bootstrap-dialog/css/bootstrap-dialog.min.css" rel="stylesheet" >    
    <!-- FontAwesome 4.3.0 -->
    <link href="../vendor/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">
     
    <!-- Theme style -->
    <link href="../vendor/adminlte/css/AdminLTE.min.css" rel="stylesheet">
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="../vendor/adminlte/css/skins/_all-skins.min.css" rel="stylesheet">
    <?php 
        if(alamat() == 'toko.php') {
    ?>
    <link rel="stylesheet" href="../vendor/jqwidgets/styles/jqx.base.css">
    <link rel="stylesheet" href="../vendor/jqwidgets/styles/jqx.darkblue.css">
    <link rel="stylesheet" href="../vendor/sweetalert/sweet-alert.css">
    <link rel="stylesheet" href="../vendor/datepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="../vendor/choosen/chosen.min.css">
    <?php } ?>

    <?php 
        if(alamat() == 'retur.php') {
    ?>
    <link rel="stylesheet" href="../vendor/jqwidgets/styles/jqx.base.css">
    <link rel="stylesheet" href="../vendor/jqwidgets/styles/jqx.web.css">
    <link rel="stylesheet" href="../vendor/sweetalert/sweet-alert.css">
    <link rel="stylesheet" href="../vendor/datepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="../vendor/choosen/chosen.min.css">
    <?php } ?>

    <?php 
        if(alamat() == 'terjual.php') {
    ?>
    <link rel="stylesheet" href="../vendor/jqwidgets/styles/jqx.base.css">
    <link rel="stylesheet" href="../vendor/jqwidgets/styles/jqx.fresh.css">
    <link rel="stylesheet" href="../vendor/sweetalert/sweet-alert.css">
    <link rel="stylesheet" href="../vendor/datepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="../vendor/choosen/chosen.min.css">
    <?php } ?>
    
    <link href="css/style.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery 2.1.3 -->
    <script src="../vendor/jQuery/jQuery-2.1.3.min.js"></script>