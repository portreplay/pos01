<?php
    $kd_pelanggan = $_GET['following'];
?>
<section class="content box-white">
    <div class="row">
        <div class="col-md-12 left-reset">
            <div class="col-md-12 left-reset">
                <div class="col-md-4 left-reset">
                    <label for="kd_penjualan">Kode Penjualan</label>
					<!-- //-- PERBAIKAN | Tambah required untuk mencegah peluang data barang lolos tanpa kode -->
                    <input type="text" name="kd_penjualan" id="kd_penjualan" class="form-control" required>
                </div>
                <div class="col-md-8 text-right right-reset">
                    <a href="javascript:void(0)" class="btn btn-sm btn-info" id="tambah_barang">Tambah Barang</a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-warning" id="kembali">Kembali / Batal</a>
                </div>
            </div>
        </div>
        <br><br>
        <div class="col-md-12 left-reset">
            
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Penjualan</th>
                            <th>Harga</th>
                            <th>Diskon</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="penjualan-data">
                        
                        <?php 
                            $kd_barang = "";
                            $no = 0;
                            if(isset($_SESSION['sesi_barang'])) {
                                $sesi_barang = $_SESSION['sesi_barang'];
                                foreach ($sesi_barang as $kd_barang_penjualan => $value) {
                                    $no++;
                                    //echo print_r($value);
                        ?>
                        <tr>
                            <td class="no"><?php echo $no; ?></td>
                            <td><?php echo $kd_barang_penjualan; ?></td>
                            <td>
                                <?php echo $value['nm_barang']; ?>
                                <br>
                                <span class="label label-success">Stok : <?php get_stok($kd_barang_penjualan, $kd_pelanggan); ?>
                                </span>
                            </td>
                            <td data-kd-barang="<?php echo $kd_barang_penjualan; ?>" class="row_kd_barang">
                                <form action="core/send_data/update_pengadaan.php?ref=penjualan&follow=<?php echo $kd_barang_penjualan; ?>&toko=<?php echo $kd_pelanggan ?>" method="post" class="form-update-pengadaan">
                                    <div class="form-group">
                                        <input type="text" name="jumlah_pengadaan" value="<?php echo $value['jumlah_pengadaan']; ?>" class="jumlah_pengadaan">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-refresh"></i></button>
                                    </div>
                                </form>           
                            </td>
                            <td class="harga" data-harga="<?php echo $value['harga']; ?>"><?php echo rupiah($value['harga']); ?></td>
                            <td>
                                <?php 
                                    if(!isset($value['diskon'])) {
                                        $diskon = 0;
                                    }else {
                                        $diskon = $value['diskon'];
                                    }
                                ?>
                                <form action="core/send_data/update_diskon.php?ref=penjualan&follow=<?php echo $kd_barang_penjualan; ?>&toko=<?php echo $kd_pelanggan ?>" method="post" class="form-update-diskon">
                                    <div class="form-group">
                                        <input type="text" name="diskon" value="<?php echo $diskon; ?>" class="diskon">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-refresh"></i></button>
                                    </div>
                                </form>
                            </td>
                            <td class="subtotal" data-static ="<?php echo ($value['jumlah_pengadaan'])*($value['harga']); ?>" data-value="<?php echo ($value['jumlah_pengadaan'])*($value['harga']) - $diskon; ?>">
                                <?php
                                    if($diskon != 0) { 
                                        echo '<del>'.rupiah(($value['jumlah_pengadaan'])*($value['harga'])).'</del><br>'; 
                                    }
                                ?>
                                <?php echo rupiah(($value['jumlah_pengadaan'])*($value['harga'])-$diskon); ?>
                            </td>
                            <td>
                                <a href="javascript:void(0)" data-code="<?php echo $kd_barang_penjualan; ?>" class="delete-barang-penjualan btn btn-sm btn-danger">Hapus Dari Daftar</a>  
                               
                            </td>
                        </tr>
                        <?php } } ?>
                    </tbody>
                </table>
               <div class="alert alert-warning text-center">
                    Jika tidak ingin menambahkan diskon silahkan isi dengan angka 0(nol)
                </div>
            </div>
        </div>
        <div class="col-md-12 left-reset">
            <form action="" method="POST" role="form" id="form-tambah-penjualan">
                <div class="col-md-3 left-reset">
                    <div class="form-group">
                        <label for="tanggal">Tanggal Penjualan</label>
                        <div class="input-append date" id="tanggal">
                            <input class="form-control" name="tanggal" id="tanggal_penjualan" value="<?php echo date('Y-m-d')  ?>">
                            <span class="add-on"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Daftar Pelanggan</label>
                        <select name="list_pelanggan" id="list_pelanggan" class="form-control" required="required">
                            <option value="">Pilih Pelanggan</option>
                                <?php 
                                $get_list_pelanggan = $mysqli->query("SELECT * FROM tbl_pelanggan WHERE kd_pelanggan='$kd_pelanggan'");
                                while($data_pelanggan = $get_list_pelanggan->fetch_array()) {
                            ?>
                            <option value="<?php echo $data_pelanggan['kd_pelanggan']; ?>"><?php echo $data_pelanggan['nm_pelanggan']; ?> - <b><?php echo $data_pelanggan['alamat']; ?></b></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="box-total text-center pull-right"> 
                        <label>Total Harga</label>
                        <br>
                        <input type="text" name="total" value="" id="total" class="text-center  form-control" readonly="readonly">
                        <input type="hidden" id="original_total" name="original_total" value="">
                    </div>
                </div>
                <div class="col-md-12 left-reset  text-left">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div> 
</section>
<script>
    $(function(){
        var options = {
            symbol : "Rp. ",
            decimal : ".",
            thousand: ",",
            precision : 2,
            format: "%s%v"
        };
        //var subtotal_init = accounting.formatMoney($('.subtotal').val(), options);
        var list_penjualan_data = [];
        var penjualan_data = document.getElementById('penjualan-data');
        var rowlength = penjualan_data.rows.length;
        var kembali = $('#kembali');

        kembali.click(function(){
            swal({
                    title: "Konfirmasi dari anda diperlukan",   
                    text: "Dengan klik kembali semua data barang dalam pembuatan penjualan akan di clear/hapus",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Tetap disini",   
                    cancelButtonText: "Kembali",   
                    closeOnConfirm: true,   
                    closeOnCancel: true 
                },
                function(isConfirm) {   
                    if (isConfirm) {     
                            
                    }else {     
                        $.ajax({
                            url: 'clear.php?ref=penjualan',
                            type: 'POST',
                            dataType: 'json',
                            success: function(data) {
                                if(data.clear_status ==true) {
                                     window.location = 'toko.php?following=<?php echo $kd_pelanggan; ?>';
                                }
                            }
                        });
                    } 
                });       
        });
        $('.form-update-diskon').formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    diskon: {
                        validators: {
                            notEmpty: {
                                message: 'Diskon tidak boleh kosong, jika tidak ingin menambahkan diskon silahkan isi 0(nol)'
                            },
                            integer: {
                                message: 'Diskon harus berupa integer/angka'
                           }
                        }
                    },
                }
        });
        $('.form-update-pengadaan').formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    jumlah_pengadaan: {
                        validators: {
                            notEmpty: {
                                message: 'Jumlah Penjualan/Pengadaan tidak boleh kosong'
                            },
                            integer: {
                                message: 'Penjualan/Pengadaan harus berupa integer/angka'
                            }
                        }
                    },
                }
        }).on('success.form.fv', function(e) {

            var $form = $(e.target),
            fv  = $(e.target).data('formValidation');
            var kd_barang = $(this).parent().attr('data-kd-barang');
            var jumlah_pengadaan = $(this).find('input').val();
            
            $.ajax({
                url: 'core/send_data/cek_stok.php',
                type: 'POST',
                dataType: 'json',
                data: {kd_pelanggan: '<?php echo $kd_pelanggan; ?>', kd_barang: kd_barang, jumlah_pengadaan: jumlah_pengadaan},
                success: function(data) {
                    if(data.cek_status == true) {
                         fv.defaultSubmit();
                    }else {
                        
                        swal("Terdapat Kesalahan", "Jumlah Penjualan/Pengadaan Barang Melampaui Stok Barang", "error");
                        return false;
                    
                    }
                }
            });
            e.preventDefault();
        });
        if(rowlength != 0) {

            var subtotal = 0;
            
            $('.subtotal').each(function(){

                subtotal += parseInt($(this).attr('data-value')); 
                $('#total').css('color','red');
                $('#original_total').val(subtotal);
                $('#total').val(accounting.formatMoney(subtotal, options));
            
            });
            
        }
        $('#form-tambah-penjualan').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                tanggal: {
                    validators: {
                        notEmpty: {
                            message: 'Tanggal tidak boleh kosong'
                        },
                        date: {
                            format: 'YYYY-MM-DD',
                            message: 'Maaf, format tanggal anda tidak valid'
                        }
                    }
                },
            }
        }).on('success.form.fv', function(e) {
            e.preventDefault();

            //alert(rowlength);
            for(var i=0; i<rowlength; i++) {
                var penjualan_cell = penjualan_data.rows.item(i).cells;
                var harga = $('.harga:nth('+i+')').attr('data-harga');
                var diskon = $('.diskon:nth('+i+')').val();
                var jumlah_pengadaan = $('.jumlah_pengadaan:nth('+i+')').val();
                var cellLength = penjualan_cell.length;
                var kd_barang = penjualan_cell.item(1).innerHTML;
                list_penjualan_data.push(
                                        {kd_barang: kd_barang, 
                                            data_barang: {
                                                nama_barang: penjualan_cell.item(2).innerHTML,
                                                penjualan : jumlah_pengadaan,
                                                harga: harga,
                                                diskon: diskon,
                                                subtotal: penjualan_cell.item(6).innerHTML
                                            }}
                                        );
            }

            var c_string = list_penjualan_data;
            var pelanggan = $('#list_pelanggan').val();
            var tanggal = $('#tanggal_penjualan').val();
            var total = $('#original_total').val();
            var kd_penjualan = $('#kd_penjualan').val();
            
            if(kd_penjualan == '') {
                swal("Terdapat Kesalahan", "Kode Penjualan masih kosong", "error");
                
				//-- PERBAIKAN | Menghilangkan duplikasi data barang
				list_penjualan_data = [];
				
            }else {
                 $.ajax({
                    url: 'core/send_data/cek_stok.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {kd_pelanggan: '<?php echo $kd_pelanggan; ?>', kd_barang: kd_barang, jumlah_pengadaan: jumlah_pengadaan},
                    success: function(data) {
                        if(data.cek_status == true) {
                             $.ajax({
                                url: 'core/send_data/cek_kd_penjualan.php',
                                type: 'POST',
                                dataType: 'json',
                                data: {kd_penjualan: kd_penjualan},
                                success: function(data) {
                                    if(data.cek_status == true) {

                                        if(rowlength != 0) {
                                            $.ajax({
                                                url: 'core/send_data/cek_stok_barang.php',
                                                type: 'POST',
                                                dataType: 'json',
                                                data: {kd_pelanggan: '<?php echo $kd_pelanggan; ?>', kd_barang: kd_barang},
                                                success: function(data) {
                                                    if(data.stok_ada == true) {
                                                        //penambahan data penjualan 
                                                        $.ajax({
                                                            url: 'core/send_data/tambah_penjualan.php',
                                                            type: 'post',
                                                            dataType: 'json',
                                                            data: {kd_penjualan: kd_penjualan, tanggal: tanggal, pelanggan: pelanggan, original_total: total,  data_penjualan: c_string},
                                                            success: function (data) {
                                                                if(data.add_status == true) {
                                                                    swal({
                                                                            title: "Sukses",   
                                                                            text: "Penambahan Penjualan Baru berhasil, Apakah anda ingin membuat penjualan baru lagi ?",   
                                                                            type: "success",   
                                                                            showCancelButton: true,   
                                                                            confirmButtonColor: "#DD6B55",   
                                                                            confirmButtonText: "Ya, Tambah Lagi",   
                                                                            cancelButtonText: "Tidak, Lihat Data Penjualan",   
                                                                            closeOnConfirm: true,   
                                                                            closeOnCancel: false 
                                                                        }, 
                                                                        function(isConfirm) {   
                                                                            if (isConfirm) {     
                                                                                window.location = 'toko.php?following=<?php echo $kd_pelanggan; ?>&mode=add';
                                                                            } else {     
                                                                                $.ajax({
                                                                                    url: 'clear.php?ref=penjualan',
                                                                                    type: 'POST',
                                                                                    dataType: 'json',
                                                                                    success: function(data) {
                                                                                        if(data.clear_status ==true) {
                                                                                            window.location = 'toko.php?following=<?php echo $kd_pelanggan; ?>&mode=add';
                                                                                        }
                                                                                    }
                                                                                });
                                                                            } 
                                                                        });
                                                                }else {
                                                                     swal("Terdapat Kesalahan", "Jumlah Penjualan melebihi stok barang, sepertinya jumlah pnejualan belum anda update", "error");
                                                                }
                                                            }
                                                        });
                                                    
                                                    }else {
                                                        
                                                        swal("Terdapat Kesalahan", "Stok Barang dengan kode barang: "+kd_barang+" sudah habis", "error");
                                                        return false;
                                                    }
                                                }
                                            });
                                            
                                        }else {
                                            swal("Terdapat Kesalahan", "Data Penjualan masih kosong, Silahkan Klik tambah Barang", "error");
                                        }
                                    }else {
                                        swal("Terdapat Kesalahan", "Kode Penjualan yang anda inputkan sudah ada di database, silahkan inputkan kode penjualan yg berbeda", "error");
                                        return false;
                                    }
                                }
                            });
                        }else {
                            
                            swal("Terdapat Kesalahan", "Jumlah Penjualan/Pengadaan Barang Melampaui Stok Barang", "error");
                            return false;
                        
                        }
                    }
                });
                
            }
        });
        <?php 
            if(isset($_SESSION['sesi_barang'])) {
        ?>
        var remove_barang = $('.delete-barang-penjualan');
        remove_barang.click(function(){
            if(confirm('Apakah anda yakin ?')) {
                var kd_barang = $(this).attr('data-code');
                //alert(kd_barang);
                $.ajax({
                    url: 'core/send_data/sesi_barang.php?ref=remove',
                    type: 'POST',
                    dataType: 'json',
                    data: {follow: kd_barang},
                    success: function(data){
                        if(data.remove_status == true) {
                            location.reload();
                        }else {
                            alert('Ada Kesalahan program');
                        }
                    }
                });
            }
        });
        <?php } ?>
    });
</script>

