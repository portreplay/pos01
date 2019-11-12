<?php 
	if(update_mode()===true) {
		$kd_pegawai = $_GET['follow'];
		$get_pegawai = $mysqli->query("SELECT * FROM tbl_pegawai WHERE kd_pegawai='$kd_pegawai'");
		$data_pegawai = $get_pegawai->fetch_array();
?>
<div class="row">
	<div class="col-md-12 text-center">
		<div class="msg"></div>
	</div>
	<div class="col-md-6">
		<form action="" method="POST" role="form" id="form-update-user">
			<legend>Form Update Pengguna Aplikasi</legend>
			<div class="form-group">
				<label for="kd_pegawai">Kode Pegawai *</label>
				<input type="text" class="form-control" id="kd_pegawai" name="kd_pegawai" value="<?php echo $data_pegawai['kd_pegawai']; ?>" readonly>
			</div>
			<div class="form-group">
				<label for="username">Username (<i>Nama Login</i>) *</label>
				<input type="text" class="form-control" id="username" name="username" value="<?php echo $data_pegawai['username']; ?>">
			</div>	
			<div class="form-group">
				<label for="password">Ubah Password Pengguna (<i>Password untuk Login</i>) *</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Ubah Password">
			</div>
			<div class="form-group">
				<label for="con_password">Ketik Ulang Password *</label>
				<input type="password" class="form-control" id="con_password" name="con_password" placeholder="Ketikan Ulang Password Pengguna">
			</div>	
			<div class="form-group">
				<label for="nama">Nama Lengkap Pengguna *</label>
				<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data_pegawai['nama']; ?>">
			</div>	
			<div class="form-group">
				<label for="email">Email Pengguna</label>
				<input type="email" class="form-control" id="email" name="email" value="<?php echo $data_pegawai['email']; ?>">
			</div>	
			<div class="col-md-6 reset-col">
				<div class="form-group">
					<label for="level">Level *</label>
					<select name="level" id="level" class="form-control" required="required">
						<option value="pegawai" <?php if($data_pegawai['level'] == 'pegawai') { ?> selected <?php } ?>>Pegawai</option>
						<option value="admin" <?php if($data_pegawai['level'] == 'admin') { ?> selected <?php } ?>>Administrator</option>
					</select>
				</div>
			</div>
			<div class="col-md-6 reset-col">
				<div class="form-group">
					<label for="role">Role *</label>
					<select name="role" id="role" class="form-control" required="required">
						<option value="cabang" <?php if($data_pegawai['role'] == 'cabang') { ?> selected <?php } ?>>Cabang</option>
						<option value="gudang"  <?php if($data_pegawai['role'] == 'gudang') { ?> selected <?php } ?>>Gudang</option>
						<option value="multi"  <?php if($data_pegawai['role'] == 'multi') { ?> selected <?php } ?>>Multi Akses</option>
					</select>
				</div>
			</div>
			<div class="form-group pelanggan" style="display:none;">
				<label for="kd_pelanggan">Alamat Cabang *</label>
				<select name="kd_pelanggan" id="kd_pelanggan" class="form-control">
					<option value="000">-- Pilih Toko --</option>
					<?php 
					  $get_data_toko = $mysqli->query("SELECT * FROM tbl_pelanggan");
					  while($data_toko_pelanggan = $get_data_toko->fetch_array()) {
							$selected ='';
							if($data_pegawai['kd_pelanggan'] == $data_toko_pelanggan['kd_pelanggan']) {
								$selected = 'selected';
							}
					?>
						<option <?php echo $selected; ?> value="<?php echo $data_toko_pelanggan['kd_pelanggan']; ?>"><?php echo $data_toko_pelanggan['alamat']; ?></option>
					<?php } ?>
				</select>
			</div>
			<button type="submit" class="btn btn-primary">Update Pengguna</button>
			<button type="button" class="btn btn-info" onclick="window.location='users.php'">Batal</button>
		</form>
		<br><br>
	</div>
	<div class="col-md-6">
		<legend>Petunjuk Pengisian Form</legend>
		<ul>
			<li><b>Kode Pegawai</b> Tidak bisa di Edit</li>
			<li>Username tidak boleh sama dengan pengguna lain</li>
			<li>Tanda (*) menandakan harus di isi / tidak boleh kosong</li>
			<li>Ketik Ulang Password agar yang anda inputkan benar-benar password yang anda harapkan</li>
		</ul>
	</div>
	<div class="alert alert-info" id="notice-form">
			Jika terdapat error atau sistem tidak bisa memproses pembeharuan pengguna<br> Segera hubungi developer atau yang berhak.
	</div>
</div>
<script>
	$(document).ready(function(){
	    $('#form-update-user').formValidation({
	        framework: 'bootstrap',
	        icon: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },
	        fields: {
	        	kd_pegawai: {
	                validators: {
	                    notEmpty: {
	                        message: 'Kode Pegawai/Pengguna tidak boleh kosong'
	                    },
	                    stringLength: {
	                    	min: 4,
	                    	max: 30,
	                    	message: 'Karakter Kode Pegawai Minimal 4 Karakter dan Maksimal 30 Karakter'
	                    }

	                }
	            },
	            username: {
	                validators: {
	                    notEmpty: {
	                        message: 'Username tidak boleh kosong'
	                    },
	                    stringLength: {
	                    	min: 4,
	                    	max: 25,
	                    	message: 'Karakter Username Minimal 4 Karakter dan Maksimal 25 Karakter'
	                    }

	                }
	            },
	            con_password: {
	                validators: {
	                    identical: {
	                    	field: 'password',
	                        message: 'Ketik ulang password harus sama dengna password'
	                    }
	                }
	            }
	        }
	    }).on('success.form.fv', function(e) {
	        $.ajax({
	            url: 'sys/update_user.php',
	            type: 'POST',
	            data: $(this).serialize(),
	            beforeSend: function() {
	            	$('button[type="submit"]').html('<i class="fa fa-spinner fa-spin"></i> Memproses..');
	            },
	            success: function(hasil) {
	            	if(hasil.trim() == 'ok') {
		            	
		            		window.location = 'users.php';
		            
	            	}else if(hasil.trim() == 'username_sudah_ada') {
	            		
	            			$('.msg').html('<div class="alert alert-danger">Maaf, Username sudah ada yang menggunakan</div>');
	            			$('button[type="submit"]').text('Update Pengguna');

	            	}else {
	            		alert('system error');
	            	}
	            }
	        });
	    e.preventDefault();
	    });
		
		var edRole = $("select#role").val();
		if(edRole == 'cabang'){
			$( "div.pelanggan" ).show();
		}else{
			$("select#kd_pelanggan").val("000");
			$( "div.pelanggan" ).hide();
		}
		$('select#role').on('change', function() {
			var valRole = $(this).val();
			
			if(valRole == 'cabang'){
				$( "div.pelanggan" ).show();
			}else{
				$("select#kd_pelanggan").val("000");
				$( "div.pelanggan" ).hide();
			}
		});
	});
</script>
<?php } ?>