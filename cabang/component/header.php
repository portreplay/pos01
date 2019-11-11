      <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo"><b>Port</b>Replay</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <?php if(is_admin($_SESSION['kd_pegawai'])===true) { ?>
              <li><a href="../sys_control.php"><i class="fa fa-user-secret"></i> Administrator</a></li>
              <?php } ?>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs"><?php echo get_nama($_SESSION['kd_pegawai']); ?></span>  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../media/images/avatar.png" class="img-circle" alt="User Image" />
                    <p>
                     <?php get_nama($_SESSION['kd_pegawai']);  ?>
                      <small>Tanggal Terdaftar : <?php echo get_pegawai_date($_SESSION['kd_pegawai']); ?></small>
                    </p>
                  </li>
              
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" id="update_profile" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>