<?php 
  $id = $this->session->userdata('id');
  $Artikel = $this->db->query("SELECT id FROM tb_stok WHERE status = '2'")->num_rows();
  $Toko = $this->db->query("SELECT id FROM tb_toko WHERE status = '2'")->num_rows();
  $TokoTutup = $this->db->query("SELECT id FROM tb_retur WHERE status = '11'")->num_rows();
?>
 <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Menu Utama</li>
        <li class="nav-item">
          <a href="<?= base_url('mng_mkt/Dashboard') ?>" class="nav-link <?= ($title == 'Dashboard') ? "active" : "" ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
       <li class="nav-item menu-open">
        <a href="#" class="nav-link <?= ($title == 'Kelola Toko' || $title == 'List Toko Tutup') ? "active" : "" ?>">
          <i class="nav-icon fas fa-store"></i>
          <p>
            Toko / Cabang
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="<?= base_url('mng_mkt/toko') ?>" class="nav-link <?= ($title == 'Kelola Toko') ? "active" : "" ?>">
              <i class="far fa-circle nav-icon"></i>
              <p>Toko Aktif</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('mng_mkt/Toko/toko_tutup') ?>" class="nav-link <?= ($title == 'List Toko Tutup') ? "active" : "" ?>">
              <i class="far fa-circle nav-icon"></i>
              <p>Toko Tutup
                <?php if ($TokoTutup == 0) { ?>
                <?php } else { ?>
                  <span class="right badge badge-danger"><?= $TokoTutup ?></span>
                <?php } ?>
              </p>
            </a>
          </li>
        </ul>
      </li>
        <li class="nav-item">
          <a href="<?= base_url('mng_mkt/Customer') ?>" class="nav-link <?= ($title == 'Kelola Customer') ? "active" : "" ?>">
            <i class="nav-icon fas fa-hotel"></i>
            <p>
              Customer
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('mng_mkt/user') ?>" class="nav-link <?= ($title == 'User') ? "active" : "" ?>">
            <i class="nav-icon fas fa-user"></i>
            <p>
              User
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('mng_mkt/promo') ?>" class="nav-link <?= ($title == 'Management Promo') ? "active" : "" ?>">
            <i class="nav-icon fas fa-percent"></i>
            <p>
              Promo
            </p>
          </a>
        </li>
        <li class="nav-header">Transaksi</li>
        <li class="nav-item">
          <a href="<?= base_url('mng_mkt/Artikel') ?>" class="nav-link <?= ($title == 'Artikel Baru') ? "active" : "" ?>">
            <i class="nav-icon fas fa-box"></i>
            <p>
              Stok Artikel Baru
              <?php if ($Artikel == 0) { ?>
              <?php }else{ ?>
              <span class="right badge badge-danger"><?= $Artikel ?></span>
              <?php } ?>
            </p>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="<?= base_url('mng_mkt/group/group') ?>" class="nav-link <?= ($title == 'Management Aset') ? "active" : "" ?>">
            <i class="nav-icon fas fa-object-group"></i>
            <p>
              Management Harga Nasional
            </p>
          </a>
        </li> -->
        <li class="nav-item">
          <a href="<?= base_url('sup/So') ?>" class="nav-link <?= ($title == 'Management Stock Opname') ? "active" : "" ?>">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Management SO Toko
            </p>
          </a>
        </li>
      <!--  <i class="nav-item">-->
      <!--  <a href="<?= base_url('finance/Stok') ?>" class="nav-link <?= ($title == 'Kelola Stok') ? "active" : "" ?>">-->
      <!--    <i class="nav-icon fas fa-box"></i>-->
      <!--    <p>-->
      <!--      Nominal Stok-->
      <!--      <span class="right badge badge-danger">New</span>-->
      <!--    </p>-->
      <!--  </a>-->
      <!--</i>-->
        <li class="nav-header">Laporan</li>
        <li class="nav-item">
          <a href="<?= base_url('mng_mkt/Penjualan') ?>" class="nav-link <?= ($title == 'Penjualan') ? "active" : "" ?>">
            <i class="nav-icon fas fa-cart-plus"></i>
            <p>
              Penjualan
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('mng_mkt/Permintaan') ?>" class="nav-link <?= ($title == 'Permintaan') ? "active" : "" ?>">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Permintaan
              <span class="right badge badge-warning">Cooming soon</span>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('mng_mkt/Retur') ?>" class="nav-link <?= ($title == 'Retur') ? "active" : "" ?>">
            <i class="nav-icon fas fa-exchange-alt"></i>
            <p>
              Retur
              <span class="right badge badge-warning">Cooming soon</span>
            </p>
          </a>
        </li>
        <li class="nav-header">Akun</li>
        <li class="nav-item">
          <a href="<?= base_url('Profile') ?>" class="nav-link <?= ($title == 'Profil') ? "active" : "" ?>">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Profil
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="javascript:void(0)" class="nav-link" onclick="logout()">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Logout
            </p>
          </a>
        </li>
        <br>
        <br>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
<!-- /.sidebar -->
