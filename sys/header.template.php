        <nav class="navbar navbar-inverse" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                
                    <a href="index.php" class="logo navbar-brand"><b>Port</b>Replay</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li <?php if(file_on()=='sys_control.php') { ?>class="active"<?php } ?>><a href="sys_control.php">Statistik</a></li>
                        <li <?php if(file_on()=='users.php') { ?>class="active"<?php } ?>><a href="users.php">Pegawai</a></li>
                        <li <?php if(file_on()=='toko.php') { ?>class="active"<?php } ?>><a href="toko.php">Pelanggan/Toko</a></li>
                        <li <?php if(file_on()=='supplier.php') { ?>class="active"<?php } ?>><a href="supplier.php">Supplier</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="gudang/">Ke Gudang</a></li>
                        <li><a href="cabang/">Ke Toko</a></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </nav>