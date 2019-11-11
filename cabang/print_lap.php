<?php 
  include 'core/init.php';
  if(sudah_login()===false) {
    alihkan('login.php');
  }else if(cek_cabang_access()===false and is_admin($_SESSION['kd_pegawai'])===false) {
    alihkan('../error.php?type=access_denie&ref=cabang');
  }
  if(report_mode()===true) {
    $kd_pelanggan = $_GET['following'];
    $get_info_toko = $mysqli->query("SELECT * FROM tbl_pelanggan WHERE kd_pelanggan=$kd_pelanggan");
    $data_toko = $get_info_toko->fetch_array();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Port Replay | Gudang - Report Penjualan</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php include 'component/head.php'; ?>
        <link rel="stylesheet" media="print" href="css/print_report.css">
        <style>
            .table th, .table td { 
                 border-top: none !important; 
             }
        </style>
    </head>
    <body class="print-body">
            <br>
        <div class="clearfix"></div>
        <?php 
            $ref_date = strtotime($_GET['ref_date']);
            $get_date = getDate($ref_date);
            $bulan = bulan_indo($get_date['mon']);
        
        ?>
        <div class="print_area">
            <div class="col-md-12">
                <div class="col-md-6">
                    <h2 class="report-title" style="margin-top: 0px;">Port Replay</h2>
                    <h4 class="report-sub-title">Fashion Pria</h4>
                    <p>
                        Jln. Rancamalang No.99<br>
                        P: 081322328888<br>
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center">Laporan Bulanan</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td><b>Pelanggan</b> </td>
                                        <td>:</td>
                                        <td><?php echo $data_toko['nm_pelanggan'];  ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Bulan Penjualan</b></td>
                                        <td>:</td>
                                        <td><?php echo $bulan; ?> - <?php echo $get_date['year']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Total Pendapatan</b></td>
                                        <td>:</td>
                                        <td><?php echo rupiah(get_total_pendapatan($kd_pelanggan, $get_date['mon']));  ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center">Daftar Barang</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Kode Penjualan</th>
                                        <th>Kode Barang</th>
                                        <th>Qty</th>
                                        <th>Diskon</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 0;
                                        $get_data_laporan = $mysqli->query("SELECT * FROM tbl_terjual_toko INNER JOIN tbl_terjual_toko_detail ON tbl_terjual_toko_detail.kd_penjualan=tbl_terjual_toko.kd_penjualan WHERE kd_pelanggan='$kd_pelanggan' AND MONTH(tanggal)=".$get_date['mon']."");
                                        while($data_laporan = $get_data_laporan->fetch_array()) {
                                            $no++;
                                    ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $data_laporan['tanggal']; ?></td>
                                        <td><?php echo $data_laporan['kd_penjualan']; ?></td>
                                        <td><?php echo $data_laporan['kd_barang']; ?></td>
                                        <td><?php echo $data_laporan['qty']; ?></td>
                                        <td><?php echo rupiah($data_laporan['diskon']); ?></td>
                                        <td><?php echo rupiah($data_laporan['harga']); ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 text-center no-print">
            <button type="button" id="print_lap" class="btn btn-success btn-lg" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
            <button type="button" onclick="window.location='toko.php?following=<?php echo $kd_pelanggan; ?>'"class="btn btn-info btn-lg">Kembali</button>
        </div>
    <?php include 'component/javas.php'; ?>
    </body>
</html>
<?php } ?>