<?php 
    include '../core/init.php';
?>
<div class="msg"></div>
<form action="" method="POST" role="form" id="form-tambah-diskon">
	<div class="form-group">
        <label for="info_kd_barang">Masukan Satu atau Beberapa Nama Barang</label>
        <select data-placeholder="Ketikan Nama Barang atau Kode Barang" name="info_kd_barang" multiple class="form-control chosen-select" tabindex="14">
            <option value=""></option>
            <?php  
                $get_barang_on_add = $mysqli->query("SELECT * FROM tbl_barang");
                while($data_barang_on_add = $get_barang_on_add->fetch_array()) {
            ?>
            <option value="<?php echo $data_barang_on_add['kd_barang']; ?>"><b><?php echo $data_barang_on_add['kd_barang']; ?></b> | <?php echo $data_barang_on_add['nm_barang']; ?></option>
                  
            <?php } ?>
        </select> 
    </div>
	
	<div class="form-group">
		<label for="tanggal_diskon">Tanggal Mulai Diskon</label>
		<input type="text" class="form-control" name="tanggal_diskon" id="tanggal_diskon">
	</div>

	<div class="form-group">
		<label for="expire_diskon">Expire/Batas Tanggal Diskon</label>
		<input type="text" class="form-control" name="expire_diskon" id="expire_diskon">
	</div>

	<div class="form-group">
		<label for="jml_potongan">Jumlah Potongan harga</label>
		<input type="text" class="form-control" name="jml_potongan" id="jml_potongan" placeholder="Masukan Jumlah Diskon Anda">
	</div>
	
	<button type="submit" class="btn btn-primary">Simpan Diskon</button>
</form>
<script>
$(function(){
    var kd_barang  = $('.chosen-select').val();
    $('.chosen-select').chosen();
    //alert($('.chosen-select').val());
    $('#tanggal_diskon').datepicker({
        
        format: 'yyyy-mm-dd'
    
    }).on('changeDate', function(e) {
            // Revalidate the date field
            $('#form-tambah-diskon').formValidation('revalidateField', 'tanggal_diskon');
        });

    $('#expire_diskon').datepicker({
        
        format: 'yyyy-mm-dd'
    
    }).on('changeDate', function(e) {
            // Revalidate the date field
            $('#form-tambah-diskon').formValidation('revalidateField', 'expire_diskon');
        });

	$('#form-tambah-diskon').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            info_kd_barang: {
                validators: {
                    notEmpty: {
                        message: 'Barang yang dipilih minimal 1 tidak boleh kosong'
                    }
                }
            },
            tanggal_diskon: {
                validators: {
                    notEmpty: {
                        message: 'Tanggal Diskon harus ditentukan'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'Aduh, Format Tanggal anda tidak valid(salah)'
                    }
                },
            },
            expire_diskon: {
                validators: {
                    notEmpty: {
                        message: 'Expire Diskon harus ditentukan'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'Aduh, Format Tanggal anda tidak valid(salah)'
                    }
                }
            },
            jml_potongan: {
                validators: {
                    notEmpty: {
                        message: 'Jumlah Potongan harga/diskon harus di isi'
                    },
                    integer: {
                    	message: 'Maaf, Jumlah potongan berupa angka bukan huruf'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {
    	e.preventDefault();
        if($('.chosen-select').val() == null) {
            alert('Maaf, Barang belum anda pilih');
        }else {
            var list_barang = $('.chosen-select').val();
            var tanggal_diskon = $('#tanggal_diskon').val();
            var expire_diskon = $('#expire_diskon').val();

            var jml_potongan = $('#jml_potongan').val();
            // alert(list_barang);
            // return false;
        	$.ajax({
        			url: 'core/send_data/tambah_diskon.php',
        			type: 'post',
                    dataType: 'json',
        			data: {kd_barang: list_barang, tanggal_diskon: tanggal_diskon, expire_diskon: expire_diskon, jml_potongan: jml_potongan},
        			success: function (data) {
        				if(data.add_status == true) {
                            $('input[name="info_kd_barang"]').attr('autofocus','autofocus');
        					$('form').data('formValidation').resetForm();
        					$('input').val('');
        					$('.msg').slideDown().html('<div class="alert alert-success text-center">Penambahan Diskon Berhasil. Silahkan isi lagi jika ingin menambahkan  diskon barang lagi</div>');
        				    setTimeout(function(){
                                $('.msg').slideUp();
                            },6000);
                        }else {
                            alert('Terjadi kesalahan dalam program, silahkan hubungi bagian teknis');
                        }
        			}
        	});
        }
    });
});
</script>