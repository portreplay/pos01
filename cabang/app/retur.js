 $(function() {

   
    //alert(kd_pelanggan);

     /* initial Stok Toko */
    var source = {
        datatype: "json",
        
        datafields: [{ name: 'kd_retur'}, { name: 'tgl_retur'}, { name: 'kd_penjualan'}, { name: 'kd_barang'}, { name: 'replace_kd_barang'}, { name: 'jenis_retur'},  { name: 'biaya'}],
        url: 'core/get_data/retur.php',
        filter: function() {
            // update the grid and send a request to the server.
            $("#retur-barang").jqxGrid('updatebounddata');
        },
        sort: function() {
            // update the grid and send a request to the server.
            $("#retur-barang").jqxGrid('updatebounddata', 'sort');
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
    $("#retur-barang").jqxGrid({
        source: dataadapter,
        theme: 'web',
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
                    text: 'Kode Retur',
                    datafield: 'kd_retur',
                    editable: false
                }, {
                    text: 'Tanggal Retur',
                    datafield: 'tgl_retur',
                    editable: false
                }, {
                    text: 'Kode Penjualan',
                    datafield: 'kd_penjualan',
                    cellsalign: 'center', 
                    align: 'center',
                    editable: false
                }, {
                    text: 'Kode Barang',
                    datafield: 'kd_barang',
                    editable: false
                    
                }, {
                    text: 'Kode Barang Peganti',
                    datafield: 'replace_kd_barang',
                    editable: false
                    
                }, {
                    text: 'Jenis Retur',
                    datafield: 'jenis_retur',
                    
                }, {
                    text: 'Biaya',
                    datafield: 'biaya',
                    
                }, {
                    text: 'Hapus',
                    datafield: 'Hapus',
                    align: 'center',
                    columntype: 'button',
                    cellsrenderer: function() {
                        return "Hapus";
                    },
                    buttonclick: function(row) {
                        var editrow = row;
                        var data_barang = $("#retur-barang").jqxGrid('getrowdata', editrow);
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
                                            $("#retur-barang").jqxGrid('updatebounddata');
                                        }

                                    }
                            });
                        });
                    }
                }]
    });//End inital stok barang
});