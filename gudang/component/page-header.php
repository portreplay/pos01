        <!-- Page header -->
        <section class="content-header">
          <?php if(alamat()=='index.php') { ?>
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
          <?php } ?>

          <?php if(alamat()=='barang.php') { ?>
          <h1>
            Barang
            <small>Ketersedian Barang</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Barang</li>
          </ol>
          <?php } ?>

          <?php if(alamat()=='export.php') { ?>
          <h1>
            Export Barang
            <small>Download Data Barang</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Export</li>
          </ol>
          <?php } ?>

          <?php if(alamat()=='import.php') { ?>
          <h1>
            Import Barang
            <small>Upload Data Barang</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Import</li>
          </ol>
          <?php } ?>

          <?php if(alamat()=='penjualan.php') { ?>
          <h1>
            Penjualan
            <small>Data Penjualan Barang</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Penjualan</li>
          </ol>
          <?php } ?>
        </section>