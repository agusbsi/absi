 <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Menu Utama</li>
        <li class="nav-item">
          <a href="<?= base_url('staff_ga/Dashboard') ?>" class="nav-link <?= ($title == 'Dashboard') ? "active" : "" ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('staff_ga/Aset') ?>" class="nav-link <?= ($title == 'Kelola Aset') ? "active" : "" ?>">
            <i class="nav-icon fas fa-hospital"></i>
            <p>
              Aset
            </p>
          </a>
        </li>
        <li class="nav-header">Transaksi</li>
        <li class="nav-item">
          <a href="<?= base_url('staff_ga/Aset/list_aset') ?>" class="nav-link <?= ($title == 'Management Aset') ? "active" : "" ?>">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Management Aset
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
