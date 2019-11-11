 $(function() {
    /* initial master data */
    var source = {
        datatype: "json",
        
        datafields: [{ name: 'kd_penjualan'}, { name: 'kd_pelanggan'}, { name: 'total_harga'}, { name: 'tanggal_penjualan'}, { name: 'total_harga'},{ name: 'total_item'}],
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
        url: 'core/get_data/penjualan.php',
        filter: function() {
            // update the grid and send a request to the server.
            $("#penjualan").jqxGrid('updatebounddata');
        },
        sort: function() {
            // update the grid and send a request to the server.
            $("#penjualan").jqxGrid('updatebounddata', 'sort');
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
    $("#penjualan").jqxGrid({
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
                    text: 'Tanggal',
                    datafield: 'tanggal_penjualan',
                    editable: false
                }, {
                    text: 'Kode Penjualan',
                    datafield: 'kd_penjualan',
                    editable: false
                }, {
                    text: 'Kode Toko',
                    datafield: 'kd_pelanggan',
                    editable: false
                 }, {
                    text: 'Jumlah',
                    datafield: 'total_item',
                    width: '20%',
                    editable: false,
                    filterable: false,
                    sortable: false
                }, {
                    text: 'Total Harga',
                    datafield: 'total_harga',
                    width: '20%',
                    editable: false
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
                        var data_penjualan = $("#penjualan").jqxGrid('getrowdata', editrow);
                        var kd_penjualan = data_penjualan.kd_penjualan;
                        
                         BootstrapDialog.show({
                            title: '<i class="fa fa-newspaper-o"></i> Detail Penjualan',
                            message: $('<div></div>').load('modal/view-detail-penjualan.php?follow='+kd_penjualan),
                            animate: false,
                            type: BootstrapDialog.TYPE_INFO,
                            size: BootstrapDialog.SIZE_WIDE
                        });

                    }
                }, {
                    text: 'Hapus',
                    datafield: 'hapus',
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
                        var data_penjualan = $("#penjualan").jqxGrid('getrowdata', editrow);
                        var kd_penjualan = data_penjualan.kd_penjualan;
                        /* Delete Master Data */
                        swal({
                            title: "Konfirmasi dari anda diperlukan",   
                            text: "Apakah anda yakin untuk menghapus data penjualan yang anda pilih ?",   
                            type: "warning",   
                            showCancelButton: true,   
                            confirmButtonColor: "#E84E40",   
                            cancelButtonText: 'Batal',
                            confirmButtonText: "Ya, Hapus Sekarang!",   
                            closeOnConfirm: false 
                        }, 
                        function(isConfirm){
                            if (isConfirm) {   
                                $.ajax({
                                        url: 'core/send_data/delete_penjualan.php',
                                        type: 'post',
                                        data: {kd_penjualan: kd_penjualan},
                                        success: function (data) {
                                            if(data.trim() == 'ok') {
                                                swal("Sukses", "Data Penjualan berhasil dihapus", "success");
                                                $("#penjualan").jqxGrid('updatebounddata');
                                            }else {
                                                alert('terjadi kesalahan diprogram');
                                            }

                                        }
                                });
                            }
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
                        var data_penjualan = $("#penjualan").jqxGrid('getrowdata', editrow);
                        var kd_penjualan = data_penjualan.kd_penjualan;
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
                        })
                      
                    }
                }]
    });//End inital master data
  

});