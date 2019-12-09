      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header text-center">MAIN NAVIGATION</li>
            <li <?php if(alamat()=='index.php') { ?>class="active" <?php } ?>>
              <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
              </a>
            </li>
            <li <?php if(alamat()=='barang.php') { ?>class="active" <?php } ?>>
              <a href="barang.php"><i class="fa fa-database"></i> Master Data</a>
            </li>
			<li <?php if(alamat()=='penerimaan_barang.php') { ?>class="active" <?php } ?>>
              <a href="penerimaan_barang.php"><i class="fa fa-truck"></i>Penerimaan Barang</a>
            </li>
            <li <?php if(alamat()=='penjualan.php') { ?>class="active" <?php } ?>>
              <a href="penjualan.php"><i class="fa fa-bar-chart"></i> Penjualan</a>
            </li>
            <li>
              <a href="retur.php"><i class="fa fa-refresh"></i> Retur <small class="label pull-right bg-red">!</small></a>
            </li>
            <li>
              <a href="#"><i class="fa fa-money"></i> Laporan Keuangan <small class="label pull-right bg-red">!</small></a>
            </li>
        
            <li class="treeview <?php if(alamat()=='import.php' or alamat() == 'export.php') { ?>active<?php } ?>">
              <a href="#">
                <i class="fa fa-sellsy"></i> <span>Pemeliharaan</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="export.php"><i class="fa fa-cloud-download"></i> Export Barang</a></li>
               <li><a href="import.php"><i class="fa fa-cloud-upload"></i> Import Barang  <small class="label pull-right bg-red">!</small></a></li>
              </ul>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>