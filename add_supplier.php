<div class="row">
	<div class="col-md-12 text-center">
		<div class="msg"></div>
	</div>
	<div class="col-md-6">
		<form action="" method="POST" role="form" id="form-add-supplier">
			<legend>Form Penambahan Supplier</legend>
			<div class="form-group">
				<label for="kd_supplier">Kode supplier *</label>
				<input type="text" class="form-control" id="kd_supplier" name="kd_supplier" placeholder="Ketikan Kode supplier">
			</div>
			<div class="form-group">
				<label for="nm_supplier">Nama Supplier</label>
				<input type="text" class="form-control" id="nm_supplier" name="nm_supplier" placeholder="Ketikan Nama Supplier">
			</div>	
			<div class="form-group">
				<label for="alamat">Alamat supplier *</label>
				<textarea class="form-control" name="alamat"></textarea>
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Ketikan Email supplier">
			</div>	
			<div class="form-group">
				<label for="telepon">Telepon supplier</label>
				<input type="text" class="form-control" id="telepon" name="telepon" placeholder="Ketikan Telepon supplier">
			</div>
			<div class="form-group">
				<label for="handphone">Handphone supplier</label>
				<input type="text" class="form-control" id="handphone" name="handphone" placeholder="Ketikan handphone supplier">
			</div>	
			<button type="submit" class="btn btn-primary">Simpan</button>
			<button type="button" class="btn btn-info" onclick="window.location='supplier.php'">Kembali</button>
		</form>
	</div>
	<div class="col-md-6">
		<legend>Petunjuk Pengisian Form</legend>
		<ul>
			<li>Kode supplier tidak boleh sama dengan supplier lain</li>
			<li>Tanda (*) menandakan harus di isi / tidak boleh kosong</li>
		</ul>
	</div>
	<div class="alert alert-info" id="notice-form">
			Jika terdapat error atau sistem tidak bisa memproses pembuatan supplier baru<br> Segera hubungi developer atau yang berhak.
	</div>
</div>
<script>
	$(document).ready(function(){
	    $('#form-add-supplier').formValidation({
	        framework: 'bootstrap',
	        icon: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },
	        fields: {
	        	kd_supplier: {
	                validators: {
	                    notEmpty: {
	                        message: 'Kode supplier tidak boleh kosong'
	                    },
	                    stringLength: {
	                    	min: 3,
	                    	max: 5,
	                    	message: 'Karakter Kode supplier Minimal 3 Karakter dan Maksimal 5 Karakter'
	                    },
	                    remote: {
	                    	url: 'sys/cek_supplier.php',
	                    	type: 'POST',
	                    	message: 'Maaf, supplier sudah ada'
	                    }

	                }
	            },
	            nm_supplier: {
	                validators: {
	                    notEmpty: {
	                        message: 'Nama supplier tidak boleh kosong'
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
	                        message: 'Alamat supplier tidak boleh kosong'
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
	            url: 'sys/add_supplier.php',
	            type: 'POST',
	            data: $(this).serialize(),
	            beforeSend: function() {
	            	$('button[type="submit"]').html('<i class="fa fa-spinner fa-spin"></i> Memproses..');
	            },
	            success: function(hasil) {
	            	if(hasil.trim() == 'ok') {
		            	$('.msg').html('<div class="alert alert-success">Penambahan supplier Berhasil. Silahkan isi form lagi jika ingin menambahkan supplier lagi</div>')
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