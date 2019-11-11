<?php 
	if(update_mode()===true and cek_toko($_GET['follow'])===true) {
		$kd_pelanggan = $_GET['follow'];
		$get_pelanggan = $mysqli->query("SELECT * FROM tbl_pelanggan WHERE kd_pelanggan='$kd_pelanggan'");
		$data_toko = $get_pelanggan->fetch_array();
?>
<div class="row">
	<div class="col-md-12 text-center">
		<div class="msg"></div>
	</div>
	<div class="col-md-6">
		<form action="" method="POST" role="form" id="form-update-toko">
			<legend>Form Pembaharuan Toko/Pelanggan</legend>
			<div class="form-group">
				<label for="kd_pelanggan">Kode Pelanggan *</label>
				<input type="text" class="form-control" id="kd_pelanggan" name="kd_pelanggan"value="<?php echo $data_toko['kd_pelanggan']; ?>">
				<input type="hidden" name="kd_pelanggan_current" value="<?php echo $kd_pelanggan; ?>">
			</div>
			<div class="form-group">
				<label for="nm_pelanggan">Nama Pelaggan</label>
				<input type="text" class="form-control" id="nm_pelanggan" name="nm_pelanggan" value="<?php echo $data_toko['nm_pelanggan']; ?>">
			</div>	
			<div class="form-group">
				<label for="alamat">Alamat Toko *</label>
				<textarea class="form-control" name="alamat"><?php echo $data_toko['alamat']; ?></textarea>
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" class="form-control" id="email" name="email" value="<?php echo $data_toko['email']; ?>">
			</div>	
			<div class="form-group">
				<label for="telepon">Telepon Pelanggan</label>
				<input type="text" class="form-control" id="telepon" name="telepon" value="<?php echo $data_toko['telepon']; ?>">
			</div>
			<div class="form-group">
				<label for="handphone">Handphone Pelanggan</label>
				<input type="text" class="form-control" id="handphone" name="handphone" value="<?php echo $data_toko['handphone']; ?>">
			</div>	
			<button type="submit" class="btn btn-primary">Update</button>
			<button type="button" class="btn btn-info" onclick="window.location='toko.php'">Kembali</button>
		</form>
	</div>
	<div class="col-md-6">
		<legend>Petunjuk Pembaharuan Form</legend>
		<ul>
			<li>Kode Pelanggan tidak boleh sama dengan Kode Pelanggan  lain</li>
			<li>Tanda (*) menandakan harus di isi / tidak boleh kosong</li>
		</ul>
	</div>
	<div class="alert alert-info" id="notice-form">
			Jika terdapat error atau sistem tidak bisa memproses pembaharuan Toko/Pelanggan<br> Segera hubungi developer atau yang berhak.
	</div>
</div>
<script>
	$(document).ready(function(){
	    $('#form-update-toko').formValidation({
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
	            url: 'sys/update_toko.php',
	            type: 'POST',
	            data: $(this).serialize(),
	            beforeSend: function() {
	            	$('button[type="submit"]').html('<i class="fa fa-spinner fa-spin"></i> Memproses..');
	            },
	            success: function(hasil) {
	            	if(hasil.trim() == 'ok') {
		            	
		            		window.location = 'toko.php';
		            
	            	}else if(hasil.trim() == 'kd_pelanggan_sudah_ada') {
	            		
	            			$('.msg').html('<div class="alert alert-danger">Maaf, Kode Pelanggan sudah ada yang menggunakan</div>');
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
<?php }else {header('location: toko.php');} ?>