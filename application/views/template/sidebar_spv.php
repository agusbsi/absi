 <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Menu Utama</li>
        <li class="nav-item">
          <a href="<?= base_url('spv/Dashboard') ?>" class="nav-link <?= ($title == 'Dashboard') ? "active" : "" ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-header">Master</li>
        <li class="nav-item <?= ($title == 'Kelola Toko' || $title == 'List Toko Tutup') ? "menu-open" : "" ?>">
         <a href="#" class="nav-link <?= ($title == 'Kelola Toko' || $title == 'List Toko Tutup') ? "active" : "" ?>">
           <i class="nav-icon fas fa-store"></i>
           <p>
             Toko / Cabang
             <i class="right fas fa-angle-left"></i>
           </p>
         </a>
         <ul class="nav nav-treeview">
           <li class="nav-item">
             <a href="<?= base_url('spv/Toko') ?>" class="nav-link <?= ($title == 'Kelola Toko') ? "active" : "" ?>">
               <i class="far fa-circle nav-icon"></i>
               <p>Toko Aktif</p>
             </a>
           </li>
           <li class="nav-item">
             <a href="<?= base_url('spv/Toko/toko_tutup') ?>" class="nav-link <?= ($title == 'List Toko Tutup') ? "active" : "" ?>">
               <i class="far fa-circle nav-icon"></i>
               <p>Toko Tutup</p>
             </a>
           </li>
         </ul>
       </li>
        <li class="nav-item">
          <a href="<?= base_url('spv/Customer') ?>" class="nav-link <?= ($title == 'Kelola Customer') ? "active" : "" ?>">
            <i class="nav-icon fas fa-hotel"></i>
            <p>
              Customer
            </p>
          </a>
        </li>
         <li class="nav-item">
          <a href="<?= base_url('spv/Stokgudang') ?>" class="nav-link <?= ($title == 'Stokgudang') ? "active" : "" ?>">
            <i class="nav-icon fas fa-warehouse"></i>
            <p>
              Stok Gudang
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('spv/User') ?>" class="nav-link <?= ($title == 'Kelola User') ? "active" : "" ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Team Leader
            </p>
          </a>
        </li>
        
        <li class="nav-header">Laporan</li>
        <li class="nav-item">
          <a href="<?= base_url('sup/So') ?>" class="nav-link <?= ($title == 'Management Stock Opname') ? "active" : "" ?>">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Management SO Toko
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('mng_mkt/Penjualan') ?>" class="nav-link <?= ($title == 'Penjualan') ? "active" : "" ?>">
            <i class="nav-icon fas fa-cart-plus"></i>
            <p>
              Penjualan
              <span class="right badge badge-danger">New</span>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('spv/Permintaan') ?>" class="nav-link <?= ($title == 'Permintaan') ? "active" : "" ?>">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Permintaan
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('spv/Retur') ?>" class="nav-link <?= ($title == 'Retur') ? "active" : "" ?>">
            <i class="nav-icon fas fa-exchange-alt"></i>
            <p>
              Retur
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
