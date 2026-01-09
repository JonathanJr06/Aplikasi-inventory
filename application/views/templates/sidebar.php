  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url('assets') ?>/profil/<?= $this->session->userdata('foto') ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $this->session->userdata('nama') ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li <?= $this->uri->segment(2) == 'dashboard' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>>
          <a href="<?= base_url('index.php/home_dashboard/dashboard') ?>">
            <i class="fa fa-home"></i> <span>Dashboard</span>
          </a>

        </li>
        <?php if ($this->session->userdata('level') == 'Administrator') { ?>
          <li class="treeview  <?= $this->uri->segment(2) == 'user' ||
                                  $this->uri->segment(2) == 'aplikasi' ||
                                  $this->uri->segment(2) == 'log' ||
                                  $this->uri->segment(2) == 'backupdb' || $this->uri->segment(2) == '' ? "active" : '' ?> ">
            <a href="#">
              <i class="fa fa-cogs"></i> <span>Pengaturan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li <?= $this->uri->segment(2) == 'user' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>><a href="<?= base_url('index.php/admin/user') ?>"><i class="fa fa-circle-o"></i> Manajemen User</a></li>
              <li <?= $this->uri->segment(2) == 'aplikasi' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>><a href="<?= base_url('index.php/admin/aplikasi') ?>"><i class="fa fa-circle-o"></i> Tentang Aplikasi</a></li>
              <li <?= $this->uri->segment(2) == 'log' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>><a href="<?= base_url('index.php/admin/log') ?>"><i class="fa fa-circle-o"></i> Log Status</a></li>
              <li <?= $this->uri->segment(2) == 'backupdb' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>><a href="<?= base_url('index.php/admin/backupdb') ?>"><i class="fa fa-circle-o"></i> Backup Database</a></li>
            </ul>
          </li>
        <?php } ?>

        <?php if ($this->session->userdata('level') == 'Operator') { ?>
          <li class="treeview <?= $this->uri->segment(2) == 'kategori' ||
                                $this->uri->segment(2) == 'brand' ||
                                $this->uri->segment(2) == 'uom' || $this->uri->segment(2) == '' ? "active" : '' ?> ">
            <a href="#">
              <i class="fa fa-archive"></i> <span>Master Data</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li <?= $this->uri->segment(2) == 'kategori' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>><a href="<?= base_url('index.php/operator/kategori') ?>"><i class="fa fa-circle-o"></i> Kategori</a></li>
              <!--               
              <li <?= $this->uri->segment(2) == 'brand' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>><a href="<?= base_url('index.php/operator/brand') ?>"><i class="fa fa-circle-o"></i> Brand</a></li>
               -->
              <li <?= $this->uri->segment(2) == 'uom' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>><a href="<?= base_url('index.php/operator/uom') ?>"><i class="fa fa-circle-o"></i> UoM</a></li>
            </ul>
          </li>
          <li <?= $this->uri->segment(2) == 'master_data_barang' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>>
            <a href="<?= base_url('index.php/operator/master_data_barang') ?>">
              <i class="fa fa-shopping-bag"></i> <span>Stock Barang</span>
            </a>
          </li>
          <li <?= $this->uri->segment(2) == 'receiving' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>>
            <a href="<?= base_url('index.php/operator/receiving') ?>">
              <i class="fa fa-cart-arrow-down"></i> <span>Barang Masuk</span>
            </a>
          </li>
          <li <?= $this->uri->segment(2) == 'issuing' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>>
            <a href="<?= base_url('index.php/operator/issuing') ?>">
              <i class="fa fa-truck"></i> <span>Barang Keluar</span>
            </a>
          </li>
          <li <?= $this->uri->segment(2) == 'request' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>>
            <a href="<?= base_url('index.php/operator/request') ?>">
              <i class="fa fa-rocket"></i> <span>Request Barang</span>
            </a>
          </li>
        <?php } ?>
        <?php if (($this->session->userdata('level') == 'Operator') or ($this->session->userdata('level') == 'Manager')) { ?>
          <li class="treeview <?= $this->uri->segment(2) == 'report_stock' ||
                                $this->uri->segment(2) == 'report_receiving' ||
                                $this->uri->segment(2) == 'report_issuing' || $this->uri->segment(2) == '' ? "active" : '' ?>">
            <a href="#">
              <i class="fa fa-file-archive-o"></i> <span>Laporan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li <?= $this->uri->segment(2) == 'report_stock' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>><a href="<?= base_url('index.php/report/report_stock') ?>"><i class="fa fa-circle-o"></i>Laporan Barang</a></li>
               <li <?= $this->uri->segment(2) == 'report_receiving' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>><a href="<?= base_url('index.php/report/report_receiving') ?>"><i class="fa fa-circle-o"></i> Laporan Barang Masuk</a></li>
              <li <?= $this->uri->segment(2) == 'report_issuing' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>><a href="<?= base_url('index.php/report/report_issuing') ?>"><i class="fa fa-circle-o"></i> Laporan Barang Keluar</a></li> 
            </ul>
          </li>
        <?php } ?>

        <!-- <?php if ($this->session->userdata('level') == 'Manager') { ?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-cogs"></i> <span>Report</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?= base_url('index.php/admin/user') ?>"><i class="fa fa-circle-o"></i> Manajemen User</a></li>
              <li><a href="<?= base_url('index.php/admin/aplikasi') ?>"><i class="fa fa-circle-o"></i> Tentang Aplikasi</a></li>
              <li><a href="<?= base_url('index.php/admin/log') ?>"><i class="fa fa-circle-o"></i> Log Status</a></li>
            </ul>
          </li>
        <?php } ?> -->
        <li>
          <a href="<?= base_url('index.php/home/logout') ?>" class="tombol-yakin" data-isidata="Ingin keluar dari sistem ini?">
            <i class="fa fa-sign-out"></i> <span>Sign Out</span>
          </a>
        </li>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->