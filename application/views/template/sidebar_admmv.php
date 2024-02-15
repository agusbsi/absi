<?php
$Permintaan = $this->db->query("SELECT id FROM tb_permintaan WHERE status = '1'")->num_rows();
$Selisih = $this->db->query("SELECT id FROM tb_pengiriman WHERE status = '3'")->num_rows();
// $Pengiriman = $this->db->query("SELECT id FROM tb_pengiriman WHERE status = '0'")->num_rows();
$Retur = $this->db->query("SELECT id FROM tb_retur WHERE status = '1'")->num_rows();
$Mutasi = $this->db->query("SELECT id FROM tb_mutasi WHERE status = '0'")->num_rows();
?>
<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-header">Menu Utama</li>
      <li class="nav-item">
        <a href="<?= base_url('adm_mv/dashboard') ?>" class="nav-link <?= ($title == 'Dashboard') ? "active" : "" ?>">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>
      <li class="nav-header">Master</li>
      <li class="nav-item">
        <a href="<?= base_url('adm_mv/barang') ?>" class="nav-link <?= ($title == 'Master Barang') ? "active" : "" ?>">
          <i class="nav-icon fas fa-boxes"></i>
          <p>
            Data Artikel
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?= base_url('adm_mv/toko') ?>" class="nav-link <?= ($title == 'Master Toko') ? "active" : "" ?>">
          <i class="nav-icon fas fa-store"></i>
          <p>
            Data Toko / Cabang
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?= base_url('adm_mv/Customer') ?>" class="nav-link <?= ($title == 'Kelola Customer') ? "active" : "" ?>">
          <i class="nav-icon fas fa-hotel"></i>
          <p>
            Customer
          </p>
        </a>
      </li>
      <li class="nav-header">Transaksi</li>

      <li class="nav-item">
        <a href="<?= base_url('adm_mv/permintaan') ?>" class="nav-link <?= ($title == 'Permintaan Barang') ? "active" : "" ?>">
          <i class="nav-icon fas fa-file-alt"></i>
          <p>
            Permintaan
            <?php if ($Permintaan == 0) { ?>
            <?php } else { ?>
              <span class="right badge badge-danger"><?= $Permintaan ?></span>
            <?php } ?>
          </p>
        </a>
      </li>
      </li>
      <li class="nav-item">
        <a href="<?= base_url('mng_mkt/penjualan') ?>" class="nav-link <?= ($title == 'Penjualan') ? "active" : "" ?>">
          <i class="nav-icon fas fa-money-bill"></i>
          <p>
            Penjualan
          </p>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a href="<?= base_url('adm_mv/pengiriman') ?>" class="nav-link <?= ($title == 'Pengiriman Barang') ? "active" : "" ?>">
          <i class="nav-icon fas fa-truck"></i>
          <p>
            Pengiriman
            <?php if ($Pengiriman == 0) { ?>
            <?php } else { ?>
              <span class="right badge badge-danger"><?= $Pengiriman ?></span>
            <?php } ?>
          </p>
        </a>
      </li> -->
      <!-- <li class="nav-item">
          <a href="<?= base_url('adm_mv/selisih') ?>" class="nav-link <?= ($title == 'Selisih Penerimaan') ? "active" : "" ?>">
            <i class="nav-icon fas fa-exclamation-circle"></i>
            <p>
              Selisih Penerimaan
              <?php if ($Selisih == 0) { ?>
              <?php } else { ?>
              <span class="right badge badge-danger"><?= $Selisih ?></span>
              <?php } ?>               
            </p>
          </a> -->
      <li class="nav-item">
        <a href="<?= base_url('adm_mv/retur') ?>" class="nav-link <?= ($title == 'Retur Barang') ? "active" : "" ?>">
          <i class="nav-icon fas fa-exchange-alt"></i>
          <p>
            Retur
            <?php if ($Retur == 0) { ?>
            <?php } else { ?>
              <span class="right badge badge-danger"><?= $Retur ?></span>
            <?php } ?>
          </p>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a href="<?= base_url('adm_mv/Mutasi') ?>" class="nav-link <?= ($title == 'Mutasi Barang') ? "active" : "" ?>">
          <i class="nav-icon fas fa-copy"></i>
          <p>
            Mutasi Barang
            <?php if ($Mutasi == 0) { ?>
            <?php } else { ?>
              <span class="right badge badge-danger"><?= $Mutasi ?></span>
            <?php } ?>
          </p>
        </a>
      </li> -->
      <li class="nav-item">
        <a href="<?= base_url('sup/so') ?>" class="nav-link <?= ($title == 'Management Stock Opname') ? "active" : "" ?>">
          <i class="nav-icon fas fa-file-alt"></i>
          <p>
            Management SO Toko
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