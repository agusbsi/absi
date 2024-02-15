<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <a href="<?= base_url('mng_ops/Dashboard') ?>" class="nav-link <?= ($title == 'Dashboard') ? "active" : "" ?>">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>
      <li class="nav-header">Master Data</li>
      <li class="nav-item">
        <a href="<?= base_url('mng_ops/Dashboard/artikel') ?>" class="nav-link <?= ($title == 'Artikel') ? "active" : "" ?>">
          <i class="nav-icon fas fa-box"></i>
          <p>
            Artikel
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?= base_url('mng_ops/Dashboard/customer') ?>" class="nav-link <?= ($title == 'Kelola Customer') ? "active" : "" ?>">
          <i class="nav-icon fas fa-hotel"></i>
          <p>
            Customer
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?= base_url('mng_ops/Dashboard/toko') ?>" class="nav-link <?= ($title == 'Toko') ? "active" : "" ?>">
          <i class="nav-icon fas fa-store"></i>
          <p>Toko </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?= base_url('mng_ops/Dashboard/user') ?>" class="nav-link <?= ($title == 'user') ? "active" : "" ?>">
          <i class="nav-icon fas fa-users"></i>
          <p>
            Leader & SPG
          </p>
        </a>
      </li>

      <li class="nav-header">Modul Utama</li>
      <li class="nav-item">
        <a href="<?= base_url('mng_ops/Dashboard/permintaan') ?>" class="nav-link <?= ($title == 'Permintaan') ? "active" : "" ?>">
          <i class="nav-icon fas fa-file-alt"></i>
          <p>
            Permintaan
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?= base_url('mng_ops/Dashboard/pengiriman') ?>" class="nav-link <?= ($title == 'pengiriman') ? "active" : "" ?>">
          <i class="nav-icon fas fa-truck"></i>
          <p>
            Pengiriman
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?= base_url('mng_ops/Dashboard/retur') ?>" class="nav-link <?= ($title == 'retur') ? "active" : "" ?>">
          <i class="nav-icon fas fa-exchange-alt"></i>
          <p>
            Retur
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
        <a href="<?= base_url('mng_mkt/Penjualan') ?>" class="nav-link <?= ($title == 'Penjualan') ? "active" : "" ?>">
          <i class="nav-icon fas fa-shopping-cart"></i>
          <p>
            Penjualan
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?= base_url('hrd/Aset/list_aset') ?>" class="nav-link <?= ($title == 'Management Aset') ? "active" : "" ?>">
          <i class="nav-icon fas fa-cog"></i>
          <p>
            Kelola Aset Toko
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?= base_url('sup/So') ?>" class="nav-link <?= ($title == 'Management Stock Opname') ? "active" : "" ?>">
          <i class="nav-icon fas fa-file-alt"></i>
          <p>
            Kelola SO Toko
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