<?php 
	if(update_mode()===true and cek_supplier($_GET['follow'])===true) {
		$kd_supplier = $_GET['follow'];
		$get_supplier = $mysqli->query("SELECT * FROM tbl_supplier WHERE kd_supplier='$kd_supplier'");
		$data_supplier = $get_supplier->fetch_array();
?>
<div class="row">
	<div class="col-md-12 text-center">
		<div class="msg"></div>
	</div>
	<div class="col-md-6">
		<form action="" method="POST" role="form" id="form-update-supplier">
			<legend>Form Pembaharuan supplier</legend>
			<div class="form-group">
				<label for="kd_supplier">Kode supplier *</label>
				<input type="text" class="form-control" id="kd_supplier" name="kd_supplier"value="<?php echo $data_supplier['kd_supplier']; ?>">
				<input type="hidden" name="kd_supplier_current" value="<?php echo $kd_supplier; ?>">
			</div>
			<div class="form-group">
				<label for="nm_supplier">Nama Pelaggan</label>
				<input type="text" class="form-control" id="nm_supplier" name="nm_supplier" value="<?php echo $data_supplier['nm_supplier']; ?>">
			</div>	
			<div class="form-group">
				<label for="alamat">Alamat supplier *</label>
				<textarea class="form-control" name="alamat"><?php echo $data_supplier['alamat']; ?></textarea>
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" class="form-control" id="email" name="email" value="<?php echo $data_supplier['email']; ?>">
			</div>	
			<div class="form-group">
				<label for="telepon">Telepon supplier</label>
				<input type="text" class="form-control" id="telepon" name="telepon" value="<?php echo $data_supplier['telepon']; ?>">
			</div>
			<div class="form-group">
				<label for="handphone">Handphone supplier</label>
				<input type="text" class="form-control" id="handphone" name="handphone" value="<?php echo $data_supplier['handphone']; ?>">
			</div>	
			<button type="submit" class="btn btn-primary">Update</button>
			<button type="button" class="btn btn-info" onclick="window.location='supplier.php'">Kembali</button>
		</form>
	</div>
	<div class="col-md-6">
		<legend>Petunjuk Pembaharuan Form</legend>
		<ul>
			<li>Kode supplier tidak boleh sama dengan Kode supplier  lain</li>
			<li>Tanda (*) menandakan harus di isi / tidak boleh kosong</li>
		</ul>
	</div>
	<div class="alert alert-info" id="notice-form">
			Jika terdapat error atau sistem tidak bisa memproses pembaharuan supplier<br> Segera hubungi developer atau yang berhak.
	</div>
</div>
<script>
	$(document).ready(function(){
	    $('#form-update-supplier').formValidation({
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
	            url: 'sys/update_supplier.php',
	            type: 'POST',
	            data: $(this).serialize(),
	            beforeSend: function() {
	            	$('button[type="submit"]').html('<i class="fa fa-spinner fa-spin"></i> Memproses..');
	            },
	            success: function(hasil) {
	            	if(hasil.trim() == 'ok') {
		            	
		            		window.location = 'supplier.php';
		            
	            	}else if(hasil.trim() == 'kd_supplier_sudah_ada') {
	            		
	            			$('.msg').html('<div class="alert alert-danger">Maaf, Kode supplier sudah ada yang menggunakan</div>');
	            			$('button[type="submit"]').text('Update');

	            	}else {
	            		alert('system error');
	            	}
	            }
	        });
	    e.preventDefault();
	    });
	});
</script>
<?php }else {header('location: supplier.php');} ?>