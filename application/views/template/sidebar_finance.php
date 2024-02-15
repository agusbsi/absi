 <!-- Sidebar -->
 <div class="sidebar">
   <!-- Sidebar Menu -->
   <nav class="mt-2">
     <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
       <i class="nav-item">
         <a href="<?= base_url('finance/Dashboard') ?>" class="nav-link <?= ($title == 'Dashboard') ? "active" : "" ?>">
           <i class="nav-icon fas fa-tachometer-alt"></i>
           <p>
             Dashboard
           </p>
         </a>
       </i>
       <i class="nav-header">Master Data</i>

       <i class="nav-item">
         <a href="<?= base_url('finance/Customer') ?>" class="nav-link <?= ($title == 'Master Customer') ? "active" : "" ?>">
           <i class="nav-icon fas fa-hotel"></i>
           <p>
             Customer
           </p>
         </a>
       </i>
       <i class="nav-item">
         <a href="<?= base_url('finance/Toko') ?>" class="nav-link <?= ($title == 'Master Toko') ? "active" : "" ?>">
           <i class="nav-icon fas fa-store"></i>
           <p>
             Toko
           </p>
         </a>
       </i>
       <i class="nav-item">
         <a href="<?= base_url('finance/Artikel') ?>" class="nav-link <?= ($title == 'Master Artikel') ? "active" : "" ?>">
           <i class="nav-icon fas fa-cube"></i>
           <p>
             Artikel
           </p>
         </a>
       </i>
       <i class="nav-header">Modul Utama</i>
       <i class="nav-item">
         <a href="<?= base_url('finance/Stok') ?>" class="nav-link <?= ($title == 'Kelola Stok') ? "active" : "" ?>">
           <i class="nav-icon fas fa-box"></i>
           <p>
             Nominal Stok
           </p>
         </a>
       </i>
       <i class="nav-item">
         <a href="<?= base_url('finance/penjualan') ?>" class="nav-link <?= ($title == 'Kelola Penjualan') ? "active" : "" ?>">
           <i class="nav-icon fas fa-cart-plus"></i>
           <p>
             Penjualan
           </p>
         </a>
       </i>
       <i class="nav-item">
         <a href="<?= base_url('finance/Invoice') ?>" class="nav-link <?= ($title == 'Kelola Invoice') ? "active" : "" ?>">
           <i class="nav-icon fas fa-file-alt"></i>
           <p>
             Invoice
           </p>
         </a>
       </i>
       <i class="nav-item">
         <a href="<?= base_url('finance/Piutang') ?>" class="nav-link <?= ($title == 'Kelola Piutang') ? "active" : "" ?>">
           <i class="nav-icon fas fa-money-bill"></i>
           <p>
             Piutang
           </p>
         </a>
       </i>

       <i class="nav-header">Laporan</i>
       <i class="nav-item">
         <a href="<?= base_url('finance/Laporan/pengiriman') ?>" class="nav-link <?= ($title == 'Laporan Pengiriman') ? "active" : "" ?>">
           <i class="nav-icon fas fa-truck"></i>
           <p>
             Pengiriman
           </p>
         </a>
       </i>
       <i class="nav-item">
         <a href="<?= base_url('finance/Laporan') ?>" class="nav-link <?= ($title == 'Laporan Penjualan') ? "active" : "" ?>">
           <i class="nav-icon fas fa-cart-plus"></i>
           <p>
             Penjualan
           </p>
         </a>
       </i>



       <i class="nav-header">Akun</i>
       <i class="nav-item">
         <a href="<?= base_url('Profile') ?>" class="nav-link <?= ($title == 'Profil') ? "active" : "" ?>">
           <i class="nav-icon fas fa-user"></i>
           <p>
             Profil
           </p>
         </a>
       </i>
       <i class="nav-item">
         <a href="javascript:void(0)" class="nav-link" onclick="logout()">
           <i class="nav-icon fas fa-sign-out-alt"></i>
           <p>
             Logout
           </p>
         </a>
       </i>
       <br>
       <br>
     </ul>
   </nav>
   <!-- /.sidebar-menu -->
 </div>
 <!-- /.sidebar -->
 