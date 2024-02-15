<?php 
  $Toko = $this->db->query("SELECT id FROM tb_toko WHERE status = '3'")->num_rows();
?>
 <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Menu Utama</li>
        <li class="nav-item">
          <a href="<?= base_url('audit/Dashboard') ?>" class="nav-link <?= ($title == 'Dashboard') ? "active" : "" ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('audit/Toko') ?>" class="nav-link <?= ($title == 'Master Toko') ? "active" : "" ?>">
            <i class="nav-icon fas fa-store"></i>
            <p>
              Toko / Cabang
              <?php if ($Toko == 0) { ?>
              <?php }else{ ?>
              <span class="right badge badge-danger"><?= $Toko ?></span>
              <?php } ?>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('audit/Customer') ?>" class="nav-link <?= ($title == 'Kelola Customer') ? "active" : "" ?>">
            <i class="nav-icon fas fa-hotel"></i>
            <p>
              Customer
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('audit/Artikel') ?>" class="nav-link <?= ($title == 'Master Artikel') ? "active" : "" ?>">
            <i class="nav-icon fas fa-cube"></i>
            <p>
              Artikel
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('audit/Aset') ?>" class="nav-link <?= ($title == 'Master Aset') ? "active" : "" ?>">
            <i class="nav-icon fas fa-hospital"></i>
            <p>
              Aset
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('audit/User') ?>" class="nav-link <?= ($title == 'Kelola User') ? "active" : "" ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>
              User
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
          <a href="<?= base_url('audit/Toko/list_adjust') ?>" class="nav-link <?= ($title == 'Adjust SO') ? "active" : "" ?>">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Adjust Stok Opname
            </p>
          </a>
        </li>
        <li class="nav-header">Transaksi</li>
       
        <li class="nav-item">
          <a href="<?= base_url('audit/Promo') ?>" class="nav-link <?= ($title == 'Kelola Promo') ? "active" : "" ?>">
            <i class="nav-icon fas fa-tag"></i>
            <p>
              Promo
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('audit/Permintaan') ?>" class="nav-link <?= ($title == 'Kelola Permintaan') ? "active" : "" ?>">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Permintaan
            </p>
          </a>
        </li>
        <li class="nav-item">
        <a href="<?= base_url('mng_ops/Dashboard/Pengiriman') ?>" class="nav-link <?= ($title == 'pengiriman') ? "active" : "" ?>">
          <i class="nav-icon fas fa-truck"></i>
          <p>
            Pengiriman
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
          <a href="<?= base_url('audit/Retur') ?>" class="nav-link <?= ($title == 'Kelola Retur') ? "active" : "" ?>">
            <i class="nav-icon fas fa-exchange-alt"></i>
            <p>
              Retur
            </p>
          </a>
        </li>
        <!--<li class="nav-item">-->
        <!--  <a href="<?= base_url('audit/selisih') ?>" class="nav-link <?= ($title == 'Kelola Selisih') ? "active" : "" ?>">-->
        <!--    <i class="nav-icon fas fa-info-circle"></i>-->
        <!--    <p>-->
        <!--      Selisih Penerimaan-->
        <!--    </p>-->
        <!--  </a>-->
        <!--</li>-->
        
        <!-- <li class="nav-item">
          <a href="<?= base_url('audit/Laporan') ?>" class="nav-link <?= ($title == 'Laporan') ? "active" : "" ?>">
            <i class="nav-icon fas fa-info-circle"></i>
            <p>
              Laporan
            </p>
          </a>
        </li> -->
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
 