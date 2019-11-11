 $(function() {

    /* initial Stok Toko */
    var source = {
        datatype: "json",
        
        datafields: [{ name: 'tanggal'}, { name: 'kd_penjualan'}, { name: 'kd_pelanggan'}, { name: 'kd_pegawai'}, { name: 'total_harga'}, { name: 'total_item'}],
        url: 'core/get_data/terjual.php',
        filter: function() {
            // update the grid and send a request to the server.
            $("#terjual").jqxGrid('updatebounddata');
        },
        sort: function() {
            // update the grid and send a request to the server.
            $("#terjual").jqxGrid('updatebounddata', 'sort');
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
    $("#terjual").jqxGrid({
        source: dataadapter,
        theme: 'fresh',
        width: '100%',
        sortable: true,
        sorttogglestates: 1,
        filterable: true,
        autoheight: true,
        pageable: true,
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
                    text: 'Tanggal',
                    datafield: 'tanggal',
                    editable: false
                }, {
                    text: 'Kode Penjualan',
                    datafield: 'kd_penjualan',
                    editable: false
                }, {
                    text: 'Kode Toko',
                    datafield: 'kd_pelanggan',
                    cellsalign: 'center', 
                    align: 'center',
                    editable: false
                }, {
                    text: 'Kode Pegawai',
                    datafield: 'kd_pegawai',
                    editable: false
                    
                }, {
                    text: 'Jumlah',
                    datafield: 'total_item',
                    filterable: false,
                    sortable: false,
                    menu: false,
                    
                }, {
                    text: 'View',
                    datafield: 'view',
                    align: 'center',
                    columntype: 'button',
                    filterable: false,
                    sortable: false,
                    menu: false,
                    cellsrenderer: function() {
                        return "View";
                    },
                    buttonclick: function(row) {
                        var editrow = row;
                        var data_terjual = $("#terjual").jqxGrid('getrowdata', editrow);
                        var kd_penjualan = data_terjual.kd_penjualan;
                        
                         BootstrapDialog.show({
                            title: '<i class="fa fa-newspaper-o"></i> Detail Penjualan',
                            message: $('<div></div>').load('popup/view-detail-terjual.php?follow='+kd_penjualan),
                            animate: false,
                            type: BootstrapDialog.TYPE_INFO,
                            size: BootstrapDialog.SIZE_WIDE
                        });
                    }
                    
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
                        var data_terjual = $("#terjual").jqxGrid('getrowdata', editrow);
                        var kd_penjualan = data_terjual.kd_penjualan;

                        swal({
                            title: "Konfirmasi dari anda diperlukan",   
                            text: "Anda yakin ingin menghapus data terjual yang anda pilih ?",   
                            type: "warning",   
                            showCancelButton: true,   
                            confirmButtonColor: "#E84E40",   
                            cancelButtonText: 'Batal',
                            confirmButtonText: "Ya, Hapus Sekarang!",   
                            closeOnConfirm: false 
                        }, 
                        function(){   
                            $.ajax({
                                    url: 'core/send_data/delete_terjual.php',
                                    type: 'post',
                                    data: {kd_penjualan: kd_penjualan},
                                    success: function (data) {
                                        if(data.trim() == 'ok') {
                                            swal({   
                                                title: 'Sukses',
                                                type: 'success',
                                                text: "Data terjual berhasil dihapus dari Database",   
                                                timer: 4000
                                            });
                                            $("#terjual").jqxGrid('updatebounddata');
                                        }

                                    }
                            });
                        });
                    }
                    
                }, {
                    text: 'Print',
                    datafield: 'print',
                    align: 'center',
                    columntype: 'button',
                    filterable: false,
                    sortable: false,
                    menu: false,
                    cellsrenderer: function() {
                        return "Print";
                    },
                    buttonclick: function(row) {
                        var editrow = row;
                        var data_terjual = $("#terjual").jqxGrid('getrowdata', editrow);
                        var kd_penjualan = data_terjual.kd_penjualan;
                        $.ajax({
                            url: 'report_penjualan.php?follow='+kd_penjualan,
                            type: 'GET',
                            dataType: 'html',
                            success: function(data) {
                                  
                                var WindowObject = window.open("", "PrintWindow", "width=1000,height=700,top=50,left=50,toolbars=no,scrollbars=yes,status=no,resizable=yes");
                                WindowObject.document.writeln(data);
                                WindowObject.document.close();
                                WindowObject.focus();
                                WindowObject.print();
                                WindowObject.close();
                            }
                        });
                        
                    }
                }]
    });//End inital stok barang
});