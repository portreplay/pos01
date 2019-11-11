 $(function() {
    var tombol_tambah_barang = $('#tambah-barang');
    var sort_stok = $('#stok-sort').attr('data-sort');

    tombol_tambah_barang.click(function(){
        BootstrapDialog.show({
            title: '<i class="fa fa-plus"></i> Tambah Barang',
            message: $('<div></div>').load('modal/form-tambah-barang.php'),
            animate: false,
            type:  BootstrapDialog.TYPE_SUCCESS,
            onhide: function() {
                $("#master-data").jqxGrid('updatebounddata');
            }
        });
    });

    /* initial master data */
    var source = {
        datatype: "json",
        
        datafields: [{ name: 'kd_barang'}, { name: 'nm_barang'}, { name: 'stok'}, { name: 'harga_beli'}, { name: 'harga'}],
        updaterow: function (rowid, rowdata, commit) {
            // synchronize with the server - send update command
            // call commit with parameter true if the synchronization with the server is successful 
            // and with parameter false if the synchronization failder.
            $.ajax({
                url: 'core/send_data/update_barang.php',
                type: 'POST',
                data: {kd_barang: rowdata.kd_barang, nm_barang: rowdata.nm_barang, stok: rowdata.stok, harga_beli: rowdata.harga_beli, harga: rowdata.harga},
                success: function(data) {
                    if(data.trim() == 'ok') {
                        commit(true);
                        $('.msg_update').html('<span class="label label-success">Kode Barang : '+rowdata.kd_barang+' berhasil di Update</span>');
                    }else {
                        alert(data);
                        commit(false);
                    }        
                },
                error: function() {
                    alert('file not found');
                }
            });
            
        },
        url: 'core/get_data/barang.php?stok_sort='+sort_stok,
        filter: function() {
            // update the grid and send a request to the server.
            $("#master-data").jqxGrid('updatebounddata');
        },
        sort: function() {
            // update the grid and send a request to the server.
            $("#master-data").jqxGrid('updatebounddata', 'sort');
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
    $("#master-data").jqxGrid({
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
                    cellsrenderer: slrenderer,
                    filterable: false,
                    sortable: false, 
                }, {
                    text: 'Kode Barang',
                    datafield: 'kd_barang',
                    editable: false
                }, {
                    text: 'Nama Barang',
                    datafield: 'nm_barang'
                }, {
                    text: 'Stok',
                    datafield: 'stok',
                    cellsalign: 'center', 
                    align: 'center',
                }, {
                    text: 'Harga Beli',
                    datafield: 'harga_beli',
                    width: '20%'
                }, {
                    text: 'Harga Jual',
                    datafield: 'harga',
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
                        var data_barang = $("#master-data").jqxGrid('getrowdata', editrow);
                        var kd_barang = data_barang.kd_barang;
                        /* Delete Master Data */
                        swal({
                            title: "Konfirmasi dari anda diperlukan",   
                            text: "Anda yakin ingin menghapus Barang yang anda pilih ?",   
                            type: "warning",   
                            showCancelButton: true,   
                            confirmButtonColor: "#E84E40",   
                            cancelButtonText: 'Batal',
                            confirmButtonText: "Ya, Hapus Sekarang!",   
                            closeOnConfirm: false 
                        }, 
                        function(){   
                            $.ajax({
                                    url: 'core/send_data/delete_barang.php',
                                    type: 'post',
                                    data: {kd_barang: kd_barang},
                                    success: function (data) {
                                        if(data.trim() == 'ok') {
                                            swal({   
                                                title: 'Sukses',
                                                type: 'success',
                                                text: "Barang berhasil dihapus dari Database",   
                                                timer: 4000
                                            });
                                            $("#master-data").jqxGrid('updatebounddata');
                                        }

                                    }
                            });
                        });
                    }
                }]
    });//End inital master data

});