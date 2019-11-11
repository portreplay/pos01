<?php 
	include '../core/init.php';
	$get_user_detail = $mysqli->query("SELECT * FROM tbl_pegawai WHERE kd_pegawai='".$_SESSION['kd_pegawai']."'");
	$data_pegawai = $get_user_detail->fetch_array();
?>
<div class="col-md-12 text-center">
	<div class="msg_update"></div>
</div>
<div class="clearfix"></div>
<form action="" method="POST" role="form" id="form-update-profile">
	<div class="form-group">
		<label for="nama">Nama Lengkap</label>
		<input type="text" class="form-control" name="nama" id="nama" value="<?php echo $data_pegawai['nama']; ?>">
	</div>
	<div class="form-group">
		<label for="password">Ubah password</label>
		<input type="password" class="form-control" name="password" id="password" placeholder="Password baru">
	</div>
	<div class="form-group">
		<label for="c_password">Konfirmasi Ubah password</label>
		<input type="password" class="form-control" name="c_password" id="c_password" placeholder="Konfirmasi Password Baru">
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" name="email" id="email" value="<?php echo $data_pegawai['email']; ?>">
	</div>
	<button type="submit" class="btn btn-primary">Update</button>
</form>
<script src="../vendor/formvalidation/js/formValidation.min.js"></script>
<script src="../vendor/formvalidation/js/framework/bootstrap.js"></script>
<script>
	$('#form-update-profile').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nama: {
                validators: {
                    notEmpty: {
                        message: 'Nama Lengkap tidak boleh kosong'
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'Karakter Nama Min 3 dan Mak 30 Karakter'
                    }
                }
            },
            c_password: {
                validators: {
                    identical: {
                    	field: 'password',
                        message: 'Konfirmasi ubah password harus sama dengan password'
                    }
                }
            }

        }
    }).on('success.form.fv', function(e) {
    	e.preventDefault();
    	$.ajax({
    			url: 'core/send_data/update_profile.php',
    			type: 'post',
    			dataType: 'json',
    			data: $(this).serialize(),
    			success: function (data) {
    				if(data.update_status == true) {
    					$('.msg_update').html('<span class="label label-success">Update Profile berhasil</span>');
    				}
    			}
    		});
    });
</script>