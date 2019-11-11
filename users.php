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
        <title>Pengguna Aplikasi</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
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
                    include 'update_users.php';
                }elseif(add_mode()===true) {
                    include 'add_users.php';
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
                        <a href="?router=new"id="add-user" class="btn btn-sm btn-success"><i class="fa fa-user-plus"></i> Tambah Pengguna</a>
                    </div>
                </div>
            </div>
            <?php }else { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-10 reset-col">
                        <b>Hasil Pencarian anda Dengan Nama Pengguna : 
                            <font color="blue"><?php echo $_GET['q']; ?></font> 
                        </b>
                    </div>
                    <div class="col-md-2 reset-col text-right">
                        <button class="btn btn-sm btn-info" onclick="window.location='users.php'">Muat Ulang</button>
                    </div>
                </div>
            </div>
            <?php } ?>
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Kode Pegawai</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Role</th>
                        <th>Status Aktif</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $no = 0;
                        if(search_mode()===true) {
                            $keyword = $_GET['q'];
                            $get_pegawai = $mysqli->query("SELECT * FROM tbl_pegawai WHERE nama LIKE '%{$keyword}%' ORDER BY tgl_daftar DESC");
                        }else {
                            $get_pegawai = $mysqli->query("SELECT * FROM tbl_pegawai ORDER BY tgl_daftar DESC");
                        }
                        while($data_pegawai = $get_pegawai->fetch_array()) {
                            $no++;
                    ?>
                    <tr class="row_<?php echo $data_pegawai['kd_pegawai']; ?>">
                        <td class="text-center"><?php echo $no; ?></td>
                        <td><?php echo $data_pegawai['kd_pegawai']; ?></td>
                        <td><?php echo $data_pegawai['username']; ?></td>
                        <td><?php echo $data_pegawai['nama']; ?></td>
                        <td><?php echo $data_pegawai['email']; ?></td>
                        <td><?php echo $data_pegawai['level']; ?></td>
                        <td><?php echo $data_pegawai['role']; ?></td>
                        <td >
                            <?php
                                if($data_pegawai['active']==1) {
                                    echo '<a href="javascript:void(0)" class="active-user" data-toggle="tooltip" title="klik untuk mengnon-aktifkan user ini" data-action="off" data-kd="'.$data_pegawai   ['kd_pegawai'].'">
                                            <span class="label label-success">On</span>
                                          </a>';
                                }else {
                                    echo '<a href="javascript:void(0)" class="active-user" data-toggle="tooltip" data-toggle="tooltip" title="klik untuk mengaktifkan user ini" data-action="on" data-kd="'.$data_pegawai[  'kd_pegawai'].'">
                                            <span class="label label-danger">Off</span>
                                          </a>
                                        ';
                                }
                            ?>
                        </td>
                        <td>
                            <a href="javascript:void(0);" data-toggle="tooltip" class="remove-user" data-kd="<?php echo $data_pegawai['kd_pegawai']; ?>" title="Hapus Pengguna">
                                <i class="fa fa-trash-o"></i>
                            </a>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="?router=update&follow=<?php echo $data_pegawai['kd_pegawai']; ?>" data-toggle="tooltip" class="edit-user" data-kd="<?php echo $data_pegawai['kd_pegawai']; ?>" title="Edit/Update Pengguna">
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
                var remove_user_button = $('.remove-user');
                var active_user = $('.active-user');

                $('[data-toggle="tooltip"]').tooltip({
                    animation: true,
                    container: 'body',
                    placement: 'top',
                    trigger: 'hover',

                });

                remove_user_button.click(function(){
                    var kd_pegawai = $(this).attr('data-kd');
                    var row_code = $('.row_'+kd_pegawai);

                    if(confirm('Apakah Anda Yakin Untuk Menghapus Pengguna Yang Anda Pilih ?')) {
                        $.ajax({
                            url: 'sys/remove_user.php',
                            type: 'POST',
                            data: {kd_pegawai: kd_pegawai},
                            success: function(data) {
                                if(data.trim() == 'ok') {
                                    row_code.addClass('blink_me');
                                    row_code.fadeOut(3000);
                                }
                            }
                        });
                    }
                });
                 active_user.click(function(){
                    var kd_pegawai = $(this).attr('data-kd');
                    var action = $(this).attr('data-action');
                    var row_code = $('.row_'+kd_pegawai);
                    if(action == 'off') {
                        if(confirm('Apakah anda yakin untuk mengnon-aktifkan user ini  ?')) {
                            $.ajax({
                                url: 'sys/off_user.php',
                                type: 'POST',
                                data: {kd_pegawai: kd_pegawai},
                                success: function(data) {
                                    if(data.trim() == 'ok') {
                                        row_code.addClass('warning');
                                        $('.msg').html('<span class="label label-success">Pengguna Berhasil di Non-Aktifkan</span>').slide(6000);
                                    }
                                }
                            });
                        }
                    }
                    if(action == 'on') {
                        if(confirm('Apakah anda yakin untuk mengaktifkan user ini  ?')) {
                            $.ajax({
                                url: 'sys/on_user.php',
                                type: 'POST',
                                data: {kd_pegawai: kd_pegawai},
                                success: function(data) {
                                    if(data.trim() == 'ok') {
                                        row_code.addClass('warning');
                                        $('.msg').html('<span class="label label-success">Pengguna Berhasil Mengaktifkan</span>').slide(6000);
                                    }
                                }
                            });
                        }
                    }
                });
            });
 
        </script>
    </body>
</html>