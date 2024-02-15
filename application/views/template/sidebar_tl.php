<?php 
  $id = $this->session->userdata('id');
  $Permintaan = $this->db->query("SELECT * FROM tb_permintaan JOIN tb_toko ON tb_permintaan.id_toko = tb_toko.id JOIN tb_user ON tb_user.id = tb_toko.id_leader WHERE tb_permintaan.status = '0' AND tb_toko.id_leader ='$id'")->num_rows();
  $Retur = $this->db->query("SELECT * FROM tb_retur JOIN tb_toko ON tb_retur.id_toko = tb_toko.id JOIN tb_user ON tb_user.id = tb_toko.id_leader WHERE tb_retur.status = '0' AND tb_toko.id_leader ='$id'")->num_rows();
  $Bap = $this->db->query("SELECT * FROM tb_bap 
  JOIN tb_toko ON tb_bap.id_toko = tb_toko.id 
  JOIN tb_user ON tb_user.id = tb_toko.id_leader 
  WHERE tb_bap.status = '0' AND tb_toko.id_leader ='$id'")->num_rows();
?>
 <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Menu Utama</li>
        <li class="nav-item">
          <a href="<?= base_url('leader/Dashboard') ?>" class="nav-link <?= ($title == 'Dashboard') ? "active" : "" ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item <?= ($title == 'Kelola Toko' || $title == 'List Toko Tutup') ? "menu-open" : "" ?>">
        <a href="#" class="nav-link <?= ($title == 'Kelola Toko' || $title == 'List Toko Tutup') ? "active" : "" ?>">
          <i class="nav-icon fas fa-store"></i>
          <p>
            Toko
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="<?= base_url('leader/Toko') ?>" class="nav-link <?= ($title == 'Kelola Toko') ? "active" : "" ?>">
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
          <a href="<?= base_url('leader/spg') ?>" class="nav-link <?= ($title == 'Kelola User') ? "active" : "" ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Kelola SPG
            </p>
          </a>
        </li>
        
        <li class="nav-header">Transaksi</li>
        <li class="nav-item">
          <a href="<?= base_url('leader/So') ?>" class="nav-link <?= ($title == 'Management Stock Opname') ? "active" : "" ?>">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Management SO Toko
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('leader/Permintaan') ?>" class="nav-link <?= ($title == 'Permintaan') ? "active" : "" ?>">
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
          <a href="<?= base_url('leader/Mutasi') ?>" class="nav-link <?= ($title == 'Mutasi Barang') ? "active" : "" ?>">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Mutasi Barang
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('leader/Retur') ?>" class="nav-link <?= ($title == 'Retur') ? "active" : "" ?>">
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
          <a href="<?= base_url('leader/Bap') ?>" class="nav-link <?= ($title == 'Bap') ? "active" : "" ?>">
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
        <li class="nav-header">Laporan</li>
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
