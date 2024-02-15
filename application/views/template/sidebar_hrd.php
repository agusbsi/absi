<?php 
  $id = $this->session->userdata('id');
  $User = $this->db->query("SELECT id FROM tb_user WHERE status = 0")->num_rows();
  $Aset = $this->db->query("SELECT id FROM tb_aset WHERE status = 0 AND deleted_at is NULL")->num_rows();
?>
 <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Menu Utama</li>
        <li class="nav-item">
          <a href="<?= base_url('hrd/Dashboard') ?>" class="nav-link <?= ($title == 'Dashboard') ? "active" : "" ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
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
        <li class="nav-item">
          <a href="<?= base_url('hrd/Aset') ?>" class="nav-link <?= ($title == 'Kelola Aset') ? "active" : "" ?>">
            <i class="nav-icon fas fa-hospital"></i>
            <p>
              Aset
              <?php if ($Aset == 0) { ?>
              <?php }else{ ?>
              <span class="right badge badge-danger"><?= $Aset ?></span>
              <?php } ?>
            </p>
          </a>
        </li>
        <li class="nav-header">Transaksi</li>
        <li class="nav-item">
          <a href="<?= base_url('hrd/user/list_user') ?>" class="nav-link <?= ($title == 'Management User') ? "active" : "" ?>">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Management User
              <?php if ($User == 0) { ?>
              <?php }else{ ?>
              <span class="right badge badge-danger"><?= $User ?></span>
              <?php } ?>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('hrd/Aset/list_aset') ?>" class="nav-link <?= ($title == 'Management Aset') ? "active" : "" ?>">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Management Aset
              
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('hrd/so') ?>" class="nav-link <?= ($title == 'Stok Opname') ? "active" : "" ?>">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Stok Opname SPG
            </p>
          </a>
        </li>
        <li class="nav-item">
        <a href="<?= base_url('hrd/Toko') ?>" class="nav-link <?= ($title == 'Akses Toko') ? "active" : "" ?>">
          <i class="nav-icon fas fa-store"></i>
          <p>
            Akses Toko SPG
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
