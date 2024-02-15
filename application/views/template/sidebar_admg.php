<?php 
  $Permintaan = $this->db->query("SELECT id FROM tb_permintaan WHERE status = '2'")->num_rows();
  $Selisih = $this->db->query("SELECT id FROM tb_pengiriman WHERE status = '3'")->num_rows();
  $Pengiriman = $this->db->query("SELECT id FROM tb_pengiriman WHERE status = '1'")->num_rows();
  $Retur = $this->db->query("SELECT id FROM tb_retur WHERE status = '3' OR status = '6' OR status = '13' OR status = '14'")->num_rows();
  $Mutasi = $this->db->query("SELECT id FROM tb_mutasi WHERE status = '0'")->num_rows();
?>
 <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Menu Utama</li>
        <li class="nav-item">
          <a href="<?=base_url('adm_gudang/Dashboard')?>" class="nav-link <?= ($title == 'Dashboard') ? "active" : "" ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-header">Transaksi</li>
        <li class="nav-item">
          <a href="<?=base_url('adm_gudang/Permintaan')?>" class="nav-link <?= ($title == 'Permintaan Barang') ? "active" : "" ?>">
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
          <a href="<?=base_url('adm_gudang/Pengiriman')?>" class="nav-link <?= ($title == 'Pengiriman Barang') ? "active" : "" ?>">
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
        <li class="nav-item">
          <a href="<?=base_url('adm_gudang/Retur')?>" class="nav-link <?= ($title == 'Retur') ? "active" : "" ?>">
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
          <a href="<?=base_url('adm_gudang/Laporan')?>" class="nav-link <?= ($title == 'Laporan') ? "active" : "" ?>">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Laporan
            </p>
          </a>
        </li>
        
        
        <li class="nav-header">Akun</li>
        <li class="nav-item">
          <a href="<?=base_url('profile')?>" class="nav-link <?= ($title == 'Profile') ? "active" : "" ?>">
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
