 $(function() {
    var kd_pelanggan = $('input[type="hidden"]').val();
    var t_tambah_barang = $('#tambah_barang');
    //alert(kd_pelanggan);

     /* initial Stok Toko */
    var source = {
        datatype: "json",
        
        datafields: [{ name: 'kd_barang'}, { name: 'id_stok_barang'}, { name: 'nm_barang'}, { name: 'stok'}, { name: 'harga'}, { name: 'biaya_expedisi'}, { name: 'total_harga'}],
        url: 'core/get_data/stok_barang.php?following='+kd_pelanggan,
        updaterow: function (rowid, rowdata, commit) {
            // synchronize with the server - send update command
            // call commit with parameter true if the synchronization with the server is successful 
            // and with parameter false if the synchronization failder.
            //alert(rowdata.biaya_expedisi);
            $.ajax({
                url: 'core/send_data/update_toko.php',
                type: 'POST',
                data: {kd_barang: rowdata.kd_barang, id_stok_barang: rowdata.id_stok_barang, stok: rowdata.stok, biaya_expedisi: rowdata.biaya_expedisi, harga: rowdata.harga},
                success: function(data) {
                    if(data.trim() == 'ok') {
                        commit(true);
                        $('.msg_update').html('<span class="label label-success">Kode Barang : '+rowdata.kd_barang+' berhasil di Update</span>');
                        $('#stok_toko').jqxGrid('updatebounddata');
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
        filter: function() {
            // update the grid and send a request to the server.
            $("#stok_toko").jqxGrid('updatebounddata');
        },
        sort: function() {
            // update the grid and send a request to the server.
            $("#stok_toko").jqxGrid('updatebounddata', 'sort');
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
    $("#stok_toko").jqxGrid({
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
                    menu: false,
                }, {
                    text: 'Kode Barang',
                    datafield: 'kd_barang',
                    editable: false
                }, {
                    text: 'Nama Barang',
                    datafield: 'nm_barang',
                    editable: false
                }, {
                    text: 'Stok',
                    datafield: 'stok',
                    cellsalign: 'center', 
                    align: 'center',
                    editable: false
                }, {
                    text: 'Harga',
                    datafield: 'harga',
                    cellsalign: 'center', 
                    align: 'center',
                    editable: true
                }, {
                    text: 'Biaya Expedisi',
                    datafield: 'biaya_expedisi',
                    width: '20%'
                }, {
                    text: 'Total Harga',
                    datafield: 'total_harga',
                    width: '20%',
                    sortable: false,
                    editable: false
                }]
    });//End inital stok barang
});