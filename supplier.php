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
        <title>Daftar Supplier</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, supplier-scalable=no' name='viewport'>
        <!--Font -->
        <link href="vendor/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- Bootstrap 3.3.2 -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Theme style -->
        <link href="vendor/adminlte/css/AdminLTE.min.css" rel="stylesheet">
        <link href="media/css/style.css" rel="stylesheet">

         <!-- jQuery 2.1.3 -->
        <script src="vendor/jQuery/jQuery-2.1.3.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script> 
        <script src="vendor/formvalidation/js/formValidation.min.js"></script>
        <script src="vendor/formvalidation/js/framework/bootstrap.js"></script> 
  </head>
    <body>
        <?php include 'sys/header.template.php'; ?>
        <div class="container">
            <?php 
                if(update_mode()===true) {
                    include 'update_supplier.php';
                }elseif(add_mode()===true) {
                    include 'add_supplier.php';
                }else {
            ?>
            <?php if(search_mode()===false) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-9 reset-col">
                        <form action="" method="GET" role="form" class="form-inline">
                            <div class="form-group">
                                <input type="text" class="form-control input-sm" name="q" id="" placeholder="Ketikan Nama">
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Cari</button>
                            <div class="form-group">
                               <div class="msg"></div>
                            </div>
                        </form>
                        
                    </div>
                    <div class="col-md-3 reset-col text-right">
                        <a href="?router=new"id="add-supplier" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Supplier</a>
                    </div>
                </div>
            </div>
            <?php }else { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-10 reset-col">
                        <b>Hasil Pencarian anda Dengan Nama Supplier : 
                            <font color="blue"><?php echo $_GET['q']; ?></font> 
                        </b>
                    </div>
                    <div class="col-md-2 reset-col text-right">
                        <button class="btn btn-sm btn-info" onclick="window.location='supplier.php'">Muat Ulang</button>
                    </div>
                </div>
            </div>
            <?php } ?>
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Kode Supplier</th>
                        <th>Nama Supplier</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Handphone</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $no = 0;
                        if(search_mode()===true) {
                            $keyword = $_GET['q'];
                            $get_supplier = $mysqli->query("SELECT * FROM tbl_supplier WHERE nm_supplier LIKE '%{$keyword}%' ORDER BY id DESC");
                        }else {
                            $get_supplier = $mysqli->query("SELECT * FROM tbl_supplier ORDER BY id DESC");
                        }
                        while($data_supplier = $get_supplier->fetch_array()) {
                            $no++;
                    ?>
                    <tr class="row_<?php echo $data_supplier['kd_supplier']; ?>">
                        <td class="text-center"><?php echo $no; ?></td>
                        <td><?php echo $data_supplier['kd_supplier']; ?></td>
                        <td><?php echo $data_supplier['nm_supplier']; ?></td>
                        <td><?php echo $data_supplier['alamat']; ?></td>
                        <td><?php echo $data_supplier['email']; ?></td>
                        <td><?php echo $data_supplier['telepon']; ?></td>
                        <td><?php echo $data_supplier['handphone']; ?></td>
                        <td>
                            <a href="javascript:void(0);" data-toggle="tooltip" class="remove-supplier" data-kd="<?php echo $data_supplier['kd_supplier']; ?>" title="Hapus Supplier">
                                <i class="fa fa-trash-o"></i>
                            </a>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="?router=update&follow=<?php echo $data_supplier['kd_supplier']; ?>" data-toggle="tooltip" class="edit-supplier" data-kd="<?php echo $data_supplier['kd_supplier']; ?>" title="Edit/Update supplier">
                                <i class="fa fa-pencil-square-o"></i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } ?>
        </div>
        <script>
            $(function(){
                var remove_supplier_button = $('.remove-supplier');
                var active_supplier = $('.active-supplier');

                //tooltip action
                $('[data-toggle="tooltip"]').tooltip({
                    animation: true,
                    container: 'body',
                    placement: 'top',
                    trigger: 'hover',

                });
                //remove supplier
                remove_supplier_button.click(function(){
                    var kd_supplier = $(this).attr('data-kd');
                    var row_code = $('.row_'+kd_supplier);
                    //if user click ok on alert
                    if(confirm('Apakah Anda Yakin Untuk Menghapus supplier Yang Anda Pilih ?')) {
                        var pass = prompt('Masukan Password Anda Untuk Menghapus supplier yang dipilih')
                        if(pass) {
                            $.ajax({
                                url: 'sys/cek_password.php',
                                type: 'POST',
                                dataType: 'json',
                                data: {password: pass},
                                success: function(data) {
                                    if(data.valid == true) {
                                        $.ajax({
                                            url: 'sys/remove_supplier.php',
                                            type: 'POST',
                                            data: {kd_supplier: kd_supplier},
                                            success: function(data) {
                                                if(data.trim() == 'ok') {
                                                    row_code.addClass('blink_me');
                                                    row_code.fadeOut(3000);
                                                }
                                            }
                                        });
                                    }else {
                                        alert('Password Anda Salah!');
                                    }
                                }
                            });
                        }
                    }
                });
            }); // end load js
 
        </script>
    </body>
</html>
