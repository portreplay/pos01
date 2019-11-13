<div class="msg"></div>
<form action="" method="POST" role="form" id="form-tambah-barang">
	<div class="form-group">
		<label for="kd_barang">Kode Barang</label>
		<input type="text" class="form-control kd_barang" name="kd_barang" id="kd_barang" placeholder="Masukan Kode Barang">
	</div>
	
	<div class="form-group">
		<label for="nm_barang">Nama Barang</label>
		<input type="text" class="form-control" name="nm_barang" id="nm_barang" placeholder="Masukan Nama Barang">
	</div>

	<div class="form-group">
		<label for="stok">Stok</label>
		<input type="text" class="form-control" name="stok" id="stok" placeholder="Jumlah Stok Barang" value="0" readonly>
	</div>

	<div class="form-group">
		<label for="harga_beli">Harga Beli</label>
		<input type="text" class="form-control" name="harga_beli" id="harga_beli" placeholder="Masukan Harga Beli Barang">
	</div>

	<div class="form-group">
		<label for="harga">Harga</label>
		<input type="text" class="form-control" name="harga" id="harga" placeholder="Masukan Harga dari Barang">
	</div>

	<div class="form-group">
		<label for="harga"></label>
		<p class="text-right">Semua field/data <b>wajib di isi</b></p>
	</div>
	
	<button type="submit" class="btn btn-primary">Simpan Data Barang</button>
</form>
<script>
	$('#form-tambah-barang').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            kd_barang: {
                validators: {
                    notEmpty: {
                        message: 'Kode Barang harus di isi'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'Panjang karakter Min: 2 dan Max: 10'
                    },
                    remote: {
                        url: 'core/send_data/cek_kd_barang.php',
                        type: 'POST',
                        message: 'Maaf, Kode Barang tidak boleh sama'
                    }
                }
            },
            nm_barang: {
                validators: {
                    notEmpty: {
                        message: 'Nama Barang harus di isi'
                    },
                    stringLength: {
                        min: 4,
                        max: 30,
                        message: 'Panjang karakter Min: 4 dan Max: 20'
                    }
                }
            },
            stok: {
                validators: {
                    notEmpty: {
                        message: 'Stok Barang harus di tentukan'
                    },
                    integer: {
                    	message: 'Stok bukan berupa huruf tapi angka/nomor !'
                    }
                }
            },
            harga_beli: {
                validators: {
                    notEmpty: {
                        message: 'Harga beli Barang harus di tentukan'
                    },
                    integer: {
                    	message: 'Harga beli bukan berupa huruf tapi angka/nomor !'
                    }
                }
            },
            harga: {
                validators: {
                    notEmpty: {
                        message: 'Harga Barang harus di tentukan'
                    },
                    integer: {
                    	message: 'Harga Barang bukan berupa huruf tapi angka/nomor !'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {
    	e.preventDefault();
    	$.ajax({
    			url: 'core/send_data/tambah_barang.php',
    			type: 'post',
    			dataType: 'json',
    			data: $(this).serialize(),
    			success: function (data) {
    				if(data.add_status == true) {
                        $('.kd_barang').attr('autofocus','autofocus');
    					$('form').data('formValidation').resetForm();
    					$('input').val('');
    					$('.msg').slideDown().html('<div class="alert alert-success text-center">Pembuatan Data Barang Baru Berhasil. Silahkan isi lagi jika ingin menambahkan barang baru lagi</div>');
    				    setTimeout(function(){
                            $('.msg').slideUp();
                        },6000);
                    }
    			}
    		});
    });
</script>