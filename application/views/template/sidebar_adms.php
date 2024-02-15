<?php 
  $Permintaan = $this->db->query("SELECT id FROM tb_permintaan WHERE status = '1'")->num_rows();
  $Selisih = $this->db->query("SELECT id FROM tb_pengiriman WHERE status = '3'")->num_rows();
  $Pengiriman = $this->db->query("SELECT id FROM tb_pengiriman WHERE status = '0'")->num_rows();
  $Retur = $this->db->query("SELECT id FROM tb_retur WHERE status = '1'")->num_rows();
  $TokoTutup = $this->db->query("SELECT id FROM tb_retur WHERE status = '10'")->num_rows();
  $Mutasi = $this->db->query("SELECT id FROM tb_mutasi WHERE status = '0'")->num_rows();
  $Bap = $this->db->query("SELECT * FROM tb_bap 
  JOIN tb_toko ON tb_bap.id_toko = tb_toko.id 
  JOIN tb_user ON tb_user.id = tb_toko.id_leader 
  WHERE tb_bap.status = '1' ")->num_rows();
?>
 <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Menu Utama</li>
        <li class="nav-item">
          <a href="<?= base_url('sup/dashboard') ?>" class="nav-link <?= ($title == 'Dashboard') ? "active" : "" ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-header">Master</li>
        <li class="nav-item">
          <a href="<?= base_url('sup/barang') ?>" class="nav-link <?= ($title == 'Master Barang') ? "active" : "" ?>">
            <i class="nav-icon fas fa-boxes"></i>
            <p>
              Data Artikel
            </p>
          </a>
        </li>
        <!--  <li class="nav-item">-->
        <!--  <a href="<?= base_url('sup/Stokgudang') ?>" class="nav-link <?= ($title == 'Stokgudang') ? "active" : "" ?>">-->
        <!--    <i class="nav-icon fas fa-warehouse"></i>-->
        <!--    <p>-->
        <!--      Stok Gudang-->
        <!--    </p>-->
        <!--  </a>-->
        <!--</li>-->
        <li class="nav-item <?= ($title == 'Master Toko' || $title == 'List Toko Tutup') ? "menu-open" : "" ?>">
        <a href="#" class="nav-link <?= ($title == 'Master Toko' || $title == 'List Toko Tutup') ? "active" : "" ?>">
          <i class="nav-icon fas fa-store"></i>
          <p>
            Toko / Cabang
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="<?= base_url('sup/toko') ?>" class="nav-link <?= ($title == 'Master Toko') ? "active" : "" ?>">
              <i class="far fa-circle nav-icon"></i>
              <p>Toko Aktif</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('sup/Toko/toko_tutup') ?>" class="nav-link <?= ($title == 'List Toko Tutup') ? "active" : "" ?>">
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
          <a href="<?= base_url('sup/Customer') ?>" class="nav-link <?= ($title == 'Kelola Customer') ? "active" : "" ?>">
            <i class="nav-icon fas fa-hotel"></i>
            <p>
              Customer
            </p>
          </a>
        </li>
        <li class="nav-header">Transaksi</li>
        
        <li class="nav-item">
          <a href="<?= base_url('sup/permintaan') ?>" class="nav-link <?= ($title == 'Permintaan Barang') ? "active" : "" ?>">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Permintaan
              <?php if ($Permintaan == 0) { ?>
              <?php }else{ ?>
              <span class="right badge badge-danger"><?= $Permintaan ?></span>
              <?php } ?> 
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('sup/Penjualan') ?>" class="nav-link <?= ($title == 'Penjualan Toko') ? "active" : "" ?>">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>
              Penjualan 
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('sup/Pengiriman') ?>" class="nav-link <?= ($title == 'Pengiriman Barang') ? "active" : "" ?>">
            <i class="nav-icon fas fa-truck"></i>
            <p>
              Pengiriman 
              <?php if ($Pengiriman == 0) { ?>
              <?php }else{ ?>
              <span class="right badge badge-danger"><?= $Pengiriman ?></span>
              <?php } ?>
            </p>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="<?= base_url('sup/selisih') ?>" class="nav-link <?= ($title == 'Selisih Penerimaan') ? "active" : "" ?>">
            <i class="nav-icon fas fa-exclamation-circle"></i>
            <p>
              Selisih Penerimaan
              <?php if ($Selisih == 0) { ?>
              <?php }else{ ?>
              <span class="right badge badge-danger"><?= $Selisih ?></span>
              <?php } ?> 
            </p>
          </a>
        </li> -->
        <li class="nav-item">
          <a href="<?= base_url('sup/retur') ?>" class="nav-link <?= ($title == 'Retur Barang') ? "active" : "" ?>">
            <i class="nav-icon fas fa-exchange-alt"></i>
            <p>
              Retur
              <?php if ($Retur == 0) { ?>
              <?php }else{ ?>
              <span class="right badge badge-danger"><?= $Retur ?></span>
              <?php } ?> 
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('sup/Bap') ?>" class="nav-link <?= ($title == 'Bap') ? "active" : "" ?>">
            <i class="nav-icon fas fa-envelope"></i>
            <p>
              B.A.P
              <?php if ($Bap == 0) { ?>
              <?php }else{ ?>
              <span class="right badge badge-danger"><?= $Bap ?></span>
              <?php } ?>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('sup/Mutasi') ?>" class="nav-link <?= ($title == 'Mutasi Barang') ? "active" : "" ?>">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Mutasi Barang 
              <?php if ($Mutasi == 0) { ?>
              <?php }else{ ?>
              <span class="right badge badge-danger"><?= $Mutasi ?></span>
              <?php } ?> 
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('sup/So') ?>" class="nav-link <?= ($title == 'Management Stock Opname') ? "active" : "" ?>">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Management SO Toko
            </p>
          </a>
        </li>
        <li class="nav-header">Laporan</li>
        <li class="nav-item">
          <a href="<?= base_url('mng_mkt/Penjualan') ?>" class="nav-link <?= ($title == 'Penjualan') ? "active" : "" ?>">
            <i class="nav-icon fas fa-cart-plus"></i>
            <p>
              Penjualan
              <span class="right badge badge-danger">New</span>
            </p>
          </a>
        </li>
        <li class="nav-header">Template Easy Accounting</li>
        <li class="nav-item">
          <a href="<?= base_url('template/sales_order') ?>" class="nav-link <?= ($title == 'Sales Order') ? "active" : "" ?>">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>
              Sales Order 
            </p>
          </a>
        </li>
        <li class="nav-header">Akun</li>
        <li class="nav-item">
          <a href="<?= base_url('profile') ?>" class="nav-link">
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
