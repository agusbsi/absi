<?php 
  $id = $this->session->userdata('id');
  $Penerimaan = $this->db->query("SELECT * FROM tb_pengiriman JOIN tb_toko ON tb_pengiriman.id_toko = tb_toko.id JOIN tb_user ON tb_user.id = tb_toko.id_spg WHERE tb_pengiriman.status = '1' AND tb_toko.id_spg ='$id'")->num_rows();
  $Mutasi = $this->db->query("SELECT * FROM tb_mutasi JOIN tb_toko ON tb_mutasi.id_toko_tujuan = tb_toko.id JOIN tb_user ON tb_user.id = tb_toko.id_spg WHERE tb_mutasi.status = '1' AND tb_toko.id_spg ='$id'")->num_rows();
  $retur = $this->db->query("SELECT * FROM tb_retur JOIN tb_toko ON tb_retur.id_toko = tb_toko.id JOIN tb_user ON tb_user.id = tb_toko.id_spg WHERE tb_retur.status = '2' AND tb_toko.id_spg ='$id'")->num_rows();
?>
 <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Menu Utama</li>
        <li class="nav-item">
          <a href="<?= base_url('spg/dashboard') ?>" class="nav-link <?= ($title == 'Dashboard') ? "active" : "" ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('spg/Dashboard/toko_spg') ?>" class="nav-link <?= ($title == 'Toko spg') ? "active" : "" ?>">
            <i class="nav-icon fas fa-store"></i>
            <p>
              Toko Anda
            </p>
          </a>
        </li>
        <li class="nav-header">Transaksi</li>
        <li class="nav-item">
          <a href="<?= base_url('spg/permintaan') ?>" class="nav-link <?= ($title == 'Permintaan Barang') ? "active" : "" ?>">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Permintaan Artikel
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('spg/Penerimaan') ?>" class="nav-link <?= ($title == 'Penerimaan Barang') ? "active" : "" ?>">
            <i class="nav-icon fas fa-check-circle"></i>
            <p>
              Penerimaan Artikel
              <?php if ($Penerimaan == 0) { ?>
              <?php }else{ ?>
              <span class="right badge badge-danger"><?= $Penerimaan ?></span>
              <?php } ?>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('spg/penjualan') ?>" class="nav-link <?= ($title == 'Penjualan') ? "active" : "" ?>">
            <i class="nav-icon fas fa-cart-plus"></i>
            <p>
              Penjualan
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('spg/retur') ?>" class="nav-link <?= ($title == 'Retur Barang') ? "active" : "" ?>">
            <i class="nav-icon fas fa-exchange-alt"></i>
            <p>
              Retur 
                <?php if ($retur == 0) { ?>
            <?php } else { ?>
              <span class="right badge badge-danger"><?= $retur ?></span>
            <?php } ?>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('spg/Mutasi') ?>" class="nav-link <?= ($title == 'Mutasi Barang') ? "active" : "" ?>">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Terima Mutasi
              <?php if ($Mutasi == 0) { ?>
              <?php }else{ ?>
              <span class="right badge badge-danger"><?= $Mutasi ?></span>
              <?php } ?>
            </p>
          </a>
        </li>
        <li class="nav-header">Kelola</li>
        <li class="nav-item">
          <a href="<?= base_url('spg/Aset') ?>" class="nav-link <?= ($title == 'Aset') ? "active" : "" ?>">
            <i class="nav-icon fas fa-clinic-medical"></i>
            <p>
              Update Aset
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('spg/Stok_opname') ?>" class="nav-link <?= ($title == 'Stok Opname') ? "active" : "" ?>">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Stok Opname
            </p>
          </a>
        </li>
        <li class="nav-header">Akun</li>
        <li class="nav-item">
          <a href="<?= base_url('profile') ?>" class="nav-link <?= ($title == 'Profile') ? "active" : "" ?>">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Profil
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('faq') ?>" class="nav-link <?= ($title == 'FAQ') ? "active" : "" ?>">
            <i class="nav-icon fas fa-question-circle"></i>
            <p>
              FAQ
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
