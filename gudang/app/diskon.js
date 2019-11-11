 $(function() {
    var tombol_tambah_diskon = $('#tambah-diskon');
    //var sort_stok = $('#stok-sort').attr('data-sort');

    tombol_tambah_diskon.click(function(){
        BootstrapDialog.show({
            title: '<i class="fa fa-plus"></i> Tambah Diskon Barang',
            message: $('<div></div>').load('modal/form-tambah-diskon.php'),
            animate: false,
            type:  BootstrapDialog.TYPE_SUCCESS,
            onhide: function() {
                $("#diskon-barang").jqxGrid('updatebounddata');
            }
        });
    });

    /* initial master data */
    var source = {
        datatype: "json",
        
        datafields: [{ name: 'id_diskon'}, { name: 'kd_barang'}, { name: 'tanggal_diskon'}, { name: 'expire_diskon'}, { name: 'jml_potongan'}],
        updaterow: function (rowid, rowdata, commit) {
            // synchronize with the server - send update command
            // call commit with parameter true if the synchronization with the server is successful 
            // and with parameter false if the synchronization failder.
            // $.ajax({
            //     url: 'core/send_data/update_barang.php',
            //     type: 'POST',
            //     data: {kd_barang: rowdata.kd_barang, nm_barang: rowdata.nm_barang, stok: rowdata.stok, harga_beli: rowdata.harga_beli, harga: rowdata.harga},
            //     success: function(data) {
            //         if(data.trim() == 'ok') {
            //             commit(true);
            //             $('.msg_update').html('<span class="label label-success">Kode Barang : '+rowdata.kd_barang+' berhasil di Update</span>');
            //         }else {
            //             alert(data);
            //             commit(false);
            //         }        
            //     },
            //     error: function() {
            //         alert('file not found');
            //     }
            // });
            
        },
        url: 'core/get_data/diskon.php',
        filter: function() {
            // update the grid and send a request to the server.
            $("#diskon-barang").jqxGrid('updatebounddata');
        },
        sort: function() {
            // update the grid and send a request to the server.
            $("#diskon-barang").jqxGrid('updatebounddata', 'sort');
        },
        root: 'Rows',
        beforeprocessing: function(data) {
            source.totalrecords = data[0].TotalRows;
        }
    };
    var slrenderer = function(value) {
        value = value + 1; // default numbering starts at 0
        return '<div style="text-align: center; margin-top: 5px;">' + value + '</div>';
    }
    var dataadapter = new $.jqx.dataAdapter(source, {
        loadError: function(xhr, status, error) {
            alert(error);
        }
    });
    $("#diskon-barang").jqxGrid({
        source: dataadapter,
        theme: 'darkblue',
        width: '100%',
        sortable: true,
        sorttogglestates: 1,
        filterable: true,
        autoheight: true,
        pageable: true,
        editable: true,
        virtualmode: true,
        pagesize: 15,
        rendergridrows: function() {
            return dataadapter.records;
        },
        columns:[{
                    text: 'No',
                    dataField: '',
                    columntype: 'number',
                    cellsalign: 'center', 
                    align: 'center',
                    cellsrenderer: slrenderer
                }, {
                    text: 'Kode Barang',
                    datafield: 'kd_barang',
                    editable: false
                }, {
                    text: 'Tanggal Diskon',
                    datafield: 'tanggal_diskon',
                    cellsalign: 'center', 
                    align: 'center',
                    columntype: 'datetimeinput',
                    cellsformat: 'yyyy-MM-dd'
                }, {
                    text: 'Expire Diskon',
                    datafield: 'expire_diskon',
                    cellsalign: 'center', 
                    align: 'center',
                    columntype: 'datetimeinput',
                    cellsformat: 'yyyy-MM-dd'
                }, {
                    text: 'Jumlah Potongan Harga',
                    datafield: 'jml_potongan',
                    width: '20%'
                }, {
                    text: 'Hapus',
                    datafield: 'Hapus',
                    align: 'center',
                    columntype: 'button',
                    filterable: false,
                    sortable: false, 
                    menu: false,
                    cellsrenderer: function() {
                        return "Hapus";
                    },
                    buttonclick: function(row) {
                        var editrow = row;
                        var data_diskon = $("#diskon-barang").jqxGrid('getrowdata', editrow);
                        var id_diskon = data_diskon.id_diskon;
                        /* Delete Master Data */
                        swal({
                            title: "Konfirmasi dari anda diperlukan",   
                            text: "Anda yakin ingin menghapus Diskon yang anda pilih ?",   
                            type: "warning",   
                            showCancelButton: true,   
                            confirmButtonColor: "#E84E40",   
                            cancelButtonText: 'Batal',
                            confirmButtonText: "Ya, Hapus Sekarang!",   
                            closeOnConfirm: false 
                        }, 
                        function(){   
                            $.ajax({
                                    url: 'core/send_data/delete_diskon.php',
                                    type: 'post',
                                    data: {id_diskon: id_diskon},
                                    success: function (data) {
                                        if(data.trim() == 'ok') {
                                            swal({   
                                                title: 'Sukses',
                                                type: 'success',
                                                text: "Diskon berhasil dihapus dari Database",   
                                                timer: 4000
                                            });
                                            $("#diskon-barang").jqxGrid('updatebounddata');
                                        }

                                    }
                            });
                        });
                    }
                }]
    });//End inital master data

    
});