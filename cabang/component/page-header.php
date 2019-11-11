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

          <?php if(alamat()=='stok_barang.php') { ?>
          <h1>
            Stok Barang
            <small>Ketersedian Stok Barang</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Stok Barang</li>
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
        </section>