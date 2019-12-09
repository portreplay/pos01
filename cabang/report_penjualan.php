<?php 
  include 'core/init.php';
  if(sudah_login()===false) {
    alihkan('login.php');
  }else if(cek_cabang_access()===false and is_admin($_SESSION['kd_pegawai'])===false) {
    alihkan('../error.php?type=access_denie&ref=cabang');
  }
  if(isset($_GET['follow']) and !empty($_GET['follow'])) {
        $kd_penjualan = $_GET['follow'];
        $field_list_keterangan = "tbl_pegawai.username, tbl_terjual_toko.tanggal,tbl_pegawai.nama, tbl_pelanggan.nm_pelanggan, tbl_pelanggan.alamat, tbl_pelanggan.email";
        //echo "SELECT $field_list_keterangan FROM tbl_terjual_toko INNER JOIN tbl_pelanggan ON tbl_terjual_toko.kd_pelanggan=tbl_pelanggan.kd_pelanggan INNER JOIN tbl_pegawai ON tbl_pegawai.kd_pegawai=tbl_terjual_toko.kd_pegawai WHERE tbl_terjual_toko.kd_penjualan='$kd_penjualan'";
        $get_keterangan = $mysqli->query("SELECT $field_list_keterangan FROM tbl_terjual_toko INNER JOIN tbl_pelanggan ON tbl_terjual_toko.kd_pelanggan=tbl_pelanggan.kd_pelanggan INNER JOIN tbl_pegawai ON tbl_pegawai.kd_pegawai=tbl_terjual_toko.kd_pegawai WHERE tbl_terjual_toko.kd_penjualan='$kd_penjualan'");
        $data_keterangan = $get_keterangan->fetch_array();

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
        <div class="container">
            <div class="row">
                <div class="col-xs-12 left-reset">
                <h2><img src="images/logo.png">Port Replay</h2>
                    <h4 class="report-sub-sub-title">Your Daily Casual Outfits With Affordable Price</h4>
                </div>
                <div class="clearfix"></div>
                <hr>
                <div class="col-xs-12 left-reset">
                    <div class="col-xs-7 left-reset">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><b>Alamat </b></td>
                                    <td>:</td>
                                    <td><?php //echo $data_keterangan['alamat']; ?>Jln. Rancamalang No.99</td>
                                </tr>
                                <tr>
                                    <td><b>Phone</b> </td>
                                    <td>:</td>
                                    <td>081322328888</td>
                                </tr>
                                <tr>
                                    <td><b>Operator</b></td>
                                    <td>:</td>
                                    <td><?php echo $data_keterangan['username']; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Date</b></td>
                                    <td>:</td>
                                    <td><?php echo date('Y-m-d'); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xs-12 left-reset report_heading">
                        <h2 class="text-center title-box">Report Penjualan Barang</h2>
                    </div>
                    <div class="col-xs-12 left-reset">
                        <div class="col-xs-10 left-reset">
                            <div class="col-xs-6 left-reset">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><b>Kode Penjualan</b></td>
                                            <td>:</td>
                                            <td><?php echo $kd_penjualan; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Tanggal Penjualan</b></td>
                                            <td>:</td>
                                            <td><?php echo $data_keterangan['tanggal'];?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Pegawai</b></td>
                                            <td>:</td>
                                            <td><?php echo $data_keterangan['nama']; ?></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-xs-6 left-reset">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><b>Pelanggan </b></td>
                                            <td>:</td>
                                            <td><?php echo $data_keterangan['nm_pelanggan']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Alamat</b></td>
                                            <td>:</td>
                                            <td><?php echo $data_keterangan['alamat'];?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Email</b></td>
                                            <td>:</td>
                                            <td><?php echo $data_keterangan['email']; ?></td>
                                        </tr>
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12 left-reset">
                        <table class="table table-bordered table-striped" id="list_barang">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Quantity</th>
                                    <th>Diskon</th>
                                    <th>Harga + Biaya Expedisi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 0;
                                    $field_list = "tbl_terjual_toko_detail.kd_barang, tbl_terjual_toko_detail.kd_penjualan, tbl_terjual_toko_detail.qty, tbl_terjual_toko_detail.kd_barang.harga, tbl_terjual_toko_detail.kd_barang.diskon, tbl_barang.nm_barang";
                                    //echo "SELECT $field_list FROM tbl_terjual_toko_detail, tbl_barang WHERE tbl_terjual_toko_detail.kd_barang=tbl_barang.kd_barang AND tbl_terjual_toko_detail.kd_penjualan='$kd_penjualan'";
                                    $get_daftar_barang = $mysqli->query("SELECT tbl_terjual_toko_detail.kd_barang, tbl_terjual_toko_detail.kd_penjualan, tbl_terjual_toko_detail.qty, tbl_terjual_toko_detail.harga, tbl_terjual_toko_detail.diskon, tbl_barang.nm_barang FROM tbl_terjual_toko_detail, tbl_barang WHERE tbl_terjual_toko_detail.kd_barang=tbl_barang.kd_barang AND tbl_terjual_toko_detail.kd_penjualan='$kd_penjualan'");
                                    while($data_daftar_barang = $get_daftar_barang->fetch_array()) {
                                        $no++;
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $data_daftar_barang['kd_barang']; ?></td>
                                    <td><?php echo $data_daftar_barang['nm_barang']; ?></td>
                                    <td><?php echo $data_daftar_barang['qty']; ?></td>
                                    <td><?php echo rupiah($data_daftar_barang['diskon']); ?></td>
                                    <td><?php echo rupiah($data_daftar_barang['harga']); ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
		<script>
			window.print();
		</script>
    <?php include 'component/javas.php'; ?>
    </body>
</html>
<?php } ?>