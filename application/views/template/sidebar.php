<?php
$id = $this->session->userdata('id');
$Artikel = $this->db->query("SELECT id FROM tb_produk WHERE status = '2'")->num_rows();
$Toko = $this->db->query("SELECT id FROM tb_toko WHERE status = '4' or status = '5'")->num_rows();
$Retur = $this->db->query("SELECT id FROM tb_retur WHERE status = '1'")->num_rows();
$TokoTutup = $this->db->query("SELECT id FROM tb_retur WHERE status = '12'")->num_rows();
?>
<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <a href="<?= base_url('adm/Dashboard') ?>" class="nav-link <?= ($title == 'Dashboard') ? "active" : "" ?>">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>
      <li class="nav-header">Master Data</li>
      <li class="nav-item">
        <a href="<?= base_url('adm/Produk') ?>" class="nav-link <?= ($title == 'Produk') ? "active" : "" ?>">
          <i class="nav-icon fas fa-box"></i>
          <p>
            Artikel
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?= base_url('adm/Customer') ?>" class="nav-link <?= ($title == 'Kelola Customer') ? "active" : "" ?>">
          <i class="nav-icon fas fa-hotel"></i>
          <p>
            Customer
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link <?= ($title == 'Toko' || $title == 'List Toko Tutup') ? "active" : "" ?>">
          <i class="nav-icon fas fa-store"></i>
          <p>
            Toko / Cabang
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="<?= base_url('adm/toko') ?>" class="nav-link <?= ($title == 'Toko') ? "active" : "" ?>">
              <i class="far fa-circle nav-icon"></i>
              <p>Toko Aktif</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('adm/Toko/toko_tutup') ?>" class="nav-link <?= ($title == 'List Toko Tutup') ? "active" : "" ?>">
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
        <a href="<?= base_url('hrd/Aset') ?>" class="nav-link <?= ($title == 'Kelola Aset') ? "active" : "" ?>">
          <i class="nav-icon fas fa-hospital"></i>
          <p>
            Aset
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?= base_url('hrd/User') ?>" class="nav-link <?= ($title == 'Kelola User') ? "active" : "" ?>">
          <i class="nav-icon fas fa-users"></i>
          <p>
            User
          </p>
        </a>
      </li>
      <li class="nav-header">Menu Utama</li>
      <li class="nav-item">
        <a href="<?= base_url('adm/produk/produk_baru') ?>" class="nav-link <?= ($title == 'Management Produk') ? "active" : "" ?>">
          <i class="nav-icon fas fa-box"></i>
          <p>
            Management Artikel
            <?php if ($Artikel == 0) { ?>
            <?php } else { ?>
              <span class="right badge badge-danger"><?= $Artikel ?></span>
            <?php } ?>
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?= base_url('adm/Stok') ?>" class="nav-link <?= ($title == 'Stok Artikel') ? "active" : "" ?>">
          <i class="nav-icon fas fa-cubes"></i>
          <p>
            Management Stok Toko
          </p>
        </a>
      </li>
      <!--<li class="nav-item">-->
      <!--  <a href="<?= base_url('adm/promo/index') ?>" class="nav-link <?= ($title == 'Management Promo') ? "active" : "" ?>">-->
      <!--    <i class="nav-icon fas fa-percent"></i>-->
      <!--    <p>-->
      <!--      Management Promo-->
      <!--    </p>-->
      <!--  </a>-->
      <!--</li>-->
      <li class="nav-item">
        <a href="<?= base_url('hrd/Aset/list_aset') ?>" class="nav-link <?= ($title == 'Management Aset') ? "active" : "" ?>">
          <i class="nav-icon fas fa-cog"></i>
          <p>
            Management Aset Toko
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
      <li class="nav-item">
        <a href="<?= base_url('sup/Penjualan') ?>" class="nav-link <?= ($title == 'Penjualan Toko') ? "active" : "" ?>">
          <i class="nav-icon fas fa-shopping-cart"></i>
          <p>
            Transaksi Penjualan
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?= base_url('sup/retur') ?>" class="nav-link <?= ($title == 'Retur Barang') ? "active" : "" ?>">
          <i class="nav-icon fas fa-exchange-alt"></i>
          <p>
            Transaksi Retur
            <?php if ($Retur == 0) { ?>
            <?php } else { ?>
              <span class="right badge badge-danger"><?= $Retur ?></span>
            <?php } ?>
          </p>
        </a>
      </li>
      <li class="nav-header">Laporan</li>
      <i class="nav-item">
        <a href="<?= base_url('finance/Stok') ?>" class="nav-link <?= ($title == 'Kelola Stok') ? "active" : "" ?>">
          <i class="nav-icon fas fa-box"></i>
          <p>
            Nominal Stok
          </p>
        </a>
      </i>
      <li class="nav-item">
        <a href="<?= base_url('adm/Permintaan') ?>" class="nav-link <?= ($title == 'Permintaan Barang') ? "active" : "" ?>">
          <i class="nav-icon fas fa-file-alt"></i>
          <p>
            Permintaan
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?= base_url('adm/Pengiriman') ?>" class="nav-link <?= ($title == 'Pengiriman Barang') ? "active" : "" ?>">
          <i class="nav-icon fas fa-truck"></i>
          <p>
            Pengiriman
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?= base_url('mng_mkt/Penjualan') ?>" class="nav-link <?= ($title == 'Penjualan') ? "active" : "" ?>">
          <i class="nav-icon fas fa-cart-plus"></i>
          <p>
            Penjualan
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
</div>