<div class="row">
	<div class="col-md-12 text-center">
		<div class="msg"></div>
	</div>
	<div class="col-md-6">
		<form action="" method="POST" role="form" id="form-add-user">
			<legend>Form Penambahan Pengguna Aplikasi</legend>
			<div class="form-group">
				<label for="kd_pegawai">Kode Pegawai *</label>
				<input type="text" class="form-control" id="kd_pegawai" name="kd_pegawai" placeholder="Ketikan Kode Pengguna">
			</div>
			<div class="form-group">
				<label for="username">Username (<i>Nama Login</i>) *</label>
				<input type="text" class="form-control" id="username" name="username" placeholder="Ketikan Username">
			</div>	
			<div class="form-group">
				<label for="password">Password Pengguna (<i>Password untuk Login</i>) *</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Ketikan Password Pengguna">
			</div>
			<div class="form-group">
				<label for="con_password">Ketik Ulang Password *</label>
				<input type="password" class="form-control" id="con_password" name="con_password" placeholder="Ketikan Ulang Password Pengguna">
			</div>	
			<div class="form-group">
				<label for="nama">Nama Lengkap Pengguna *</label>
				<input type="text" class="form-control" id="nama" name="nama" placeholder="Ketikan nama Pengguna">
			</div>	
			<div class="form-group">
				<label for="email">Email Pengguna</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Ketikan email Pengguna">
			</div>	
			<div class="col-md-6 reset-col">
				<div class="form-group">
					<label for="level">Level *</label>
					<select name="level" id="level" class="form-control" required="required">
						<option value="pegawai">Pegawai</option>
						<option value="admin">Administrator</option>
					</select>
				</div>
			</div>
			<div class="col-md-6 reset-col">
				<div class="form-group">
					<label for="role">Role *</label>
					<select name="role" id="role" class="form-control" required="required">
						<option value="cabang">Cabang</option>
						<option value="gudang">Gudang</option>
						<option value="multi">Multi Akses</option>
					</select>
				</div>
			</div>
			<button type="submit" class="btn btn-primary">Simpan</button>
			<button type="button" class="btn btn-info" onclick="window.location='users.php'">Kembali</button>
		</form>
	</div>
	<div class="col-md-6">
		<legend>Petunjuk Pengisian Form</legend>
		<ul>
			<li>Username tidak boleh sama dengan pengguna lain</li>
			<li>Tanda (*) menandakan harus di isi / tidak boleh kosong</li>
			<li>Ketik Ulang Password agar yang anda inputkan benar-benar password yang anda harapkan</li>
		</ul>
	</div>
	<div class="alert alert-info" id="notice-form">
			Jika terdapat error atau sistem tidak bisa memproses pembuatan pengguna baru<br> Segera hubungi developer atau yang berhak.
	</div>
</div>
<script>
	$(document).ready(function(){
	    $('#form-add-user').formValidation({
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
	                    },
	                    remote: {
	                    	url: 'sys/cek_username.php',
	                    	type: 'POST',
	                    	message: 'Maaf, Username sudah ada yang menggunakan'
	                    }

	                }
	            },
	            password: {
	                validators: {
	                    notEmpty: {
	                        message: 'Password tidak boleh kosong'
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
	            url: 'sys/add_user.php',
	            type: 'POST',
	            data: $(this).serialize(),
	            beforeSend: function() {
	            	$('button[type="submit"]').html('<i class="fa fa-spinner fa-spin"></i> Memproses..');
	            },
	            success: function(hasil) {
	            	if(hasil.trim() == 'ok') {
		            	$('.msg').html('<div class="alert alert-success">Penambahan Pengguna/Pegawai Berhasil. Silahkan isi form lagi jika ingin menambahkan Pengguna lagi</div>')
		            	$('input').val('');
		            	$('form').data('formValidation').resetForm();
		            	$('button[type="submit"]').text('Simpan');
	            	}else {
	            		alert('system error');
	            	}
	            }
	        });
	    e.preventDefault();
	    })
	});
</script>