<div class="row">
	<div class="col-md-12 text-center">
		<div class="msg"></div>
	</div>
	<div class="col-md-6">
		<form action="" method="POST" role="form" id="form-add-toko">
			<legend>Form Penambahan Toko/Pelanggan</legend>
			<div class="form-group">
				<label for="kd_pelanggan">Kode Pelanggan *</label>
				<input type="text" class="form-control" id="kd_pelanggan" name="kd_pelanggan" placeholder="Ketikan Kode Pelanggan">
			</div>
			<div class="form-group">
				<label for="nm_pelanggan">Nama Pelaggan</label>
				<input type="text" class="form-control" id="nm_pelanggan" name="nm_pelanggan" placeholder="Ketikan Nama Pelanggan/Toko">
			</div>	
			<div class="form-group">
				<label for="alamat">Alamat Toko *</label>
				<textarea class="form-control" name="alamat"></textarea>
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Ketikan Email Pelanggan">
			</div>	
			<div class="form-group">
				<label for="telepon">Telepon Pelanggan</label>
				<input type="text" class="form-control" id="telepon" name="telepon" placeholder="Ketikan Telepon Pelanggan">
			</div>
			<div class="form-group">
				<label for="handphone">Handphone Pelanggan</label>
				<input type="text" class="form-control" id="handphone" name="handphone" placeholder="Ketikan handphone Pelanggan">
			</div>	
			<button type="submit" class="btn btn-primary">Simpan</button>
			<button type="button" class="btn btn-info" onclick="window.location='toko.php'">Kembali</button>
		</form>
	</div>
	<div class="col-md-6">
		<legend>Petunjuk Pengisian Form</legend>
		<ul>
			<li>Kode Pelanggan tidak boleh sama dengan Pelanggan lain</li>
			<li>Tanda (*) menandakan harus di isi / tidak boleh kosong</li>
		</ul>
	</div>
	<div class="alert alert-info" id="notice-form">
			Jika terdapat error atau sistem tidak bisa memproses pembuatan Toko baru<br> Segera hubungi developer atau yang berhak.
	</div>
</div>
<script>
	$(document).ready(function(){
	    $('#form-add-toko').formValidation({
	        framework: 'bootstrap',
	        icon: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },
	        fields: {
	        	kd_pelanggan: {
	                validators: {
	                    notEmpty: {
	                        message: 'Kode Pelanggan/Toko tidak boleh kosong'
	                    },
	                    stringLength: {
	                    	min: 3,
	                    	max: 5,
	                    	message: 'Karakter Kode Pelanggan Minimal 3 Karakter dan Maksimal 5 Karakter'
	                    },
	                    remote: {
	                    	url: 'sys/cek_pelanggan.php',
	                    	type: 'POST',
	                    	message: 'Maaf, Pelanggan sudah ada'
	                    }

	                }
	            },
	            nm_pelanggan: {
	                validators: {
	                    notEmpty: {
	                        message: 'Nama Pelanggan tidak boleh kosong'
	                    },
	                    stringLength: {
	                    	min: 4,
	                    	max: 30,
	                    	message: 'Karakter Username Minimal 4 Karakter dan Maksimal 30 Karakter'
	                    }
	                }
	            },
	            alamat: {
	                validators: {
	                    notEmpty: {
	                        message: 'Alamat Pelanggan tidak boleh kosong'
	                    },
	                    stringLength: {
	                    	min: 4,
	                    	max: 30,
	                    	message: 'Karakter Alamat Minimal 4 Karakter dan Maksimal 30 Karakter'
	                    }
	                }
	            }
	        }
	    }).on('success.form.fv', function(e) {
	        $.ajax({
	            url: 'sys/add_toko.php',
	            type: 'POST',
	            data: $(this).serialize(),
	            beforeSend: function() {
	            	$('button[type="submit"]').html('<i class="fa fa-spinner fa-spin"></i> Memproses..');
	            },
	            success: function(hasil) {
	            	if(hasil.trim() == 'ok') {
		            	$('.msg').html('<div class="alert alert-success">Penambahan Pelanggan/Toko Berhasil. Silahkan isi form lagi jika ingin menambahkan Pelanggan lagi</div>')
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