<!-- Small boxes (Stat box) -->
<section class="content">
  <!-- isi konten sapa -->
  <div class="card card-warning card-outline">
    <div class="card-header">
      <h3 class="card-title">
        <i class="fas fa-bullhorn"></i>
        <?php
        date_default_timezone_set("Asia/Jakarta");
        $b = time();
        $hour = date("G", $b);
        if ($hour >= 0 && $hour <= 11) {
          echo "Selamat Pagi :)";
        } elseif ($hour >= 12 && $hour <= 14) {
          echo "Selamat Siang :) ";
        } elseif ($hour >= 15 && $hour <= 17) {
          echo "Selamat Sore :) ";
        } elseif ($hour >= 17 && $hour <= 18) {
          echo "Selamat Petang :) ";
        } elseif ($hour >= 19 && $hour <= 23) {
          echo "Selamat Malam :) ";
        }

        ?>,
      </h3>
    </div>
    <div class="card-body">
      <h4>
        <strong> <?= $this->session->userdata('nama_user') ?> !</strong>
      </h4> <br>
      <strong>INI HALAMAN AUDIT GLOBAL INDO GROUP !</strong>
    </div>
    <div class="card-footer text-right">
      <a href="#" class=" text-success"><i class="fas fa-book"></i> Baca Peraturan</a>
    </div>
    <!-- /.card -->
  </div>
  <!-- end konten -->
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3><?php if ($t_toko->total == 0) {
                echo "Kosong";
              } else {
                echo $t_toko->total;
              } ?></h3>

          <p>Total Toko</p>
        </div>
        <div class="icon">
          <i class="fas fa-store"></i>
        </div>
        <a href="<?= base_url('audit/Toko') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3><?php if ($t_artikel->total == 0) {
                echo "Kosong";
              } else {
                echo $t_artikel->total;
              } ?></h3>

          <p>Total Artikel</p>
        </div>
        <div class="icon">
          <i class="fas fa-cube"></i>
        </div>
        <a href="<?= base_url('audit/Artikel') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>
            <?php if ($t_aset->total == 0) {
              echo "Kosong";
            } else {
              echo $t_aset->total;
            } ?>
          </h3>

          <p>Total Aset</p>
        </div>
        <div class="icon">
          <i class="fas fa-hospital"></i>
        </div>
        <a href="<?= base_url('audit/Aset') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>
            <?php if ($t_customer->total == 0) {
              echo "Kosong";
            } else {
              echo $t_customer->total;
            } ?>
          </h3>

          <p>Total Customer</p>
        </div>
        <div class="icon">
          <i class="fas fa-hotel"></i>
        </div>
        <a href="<?= base_url('audit/Customer') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <!-- /.row -->
  <!-- Info boxes -->
  <div class="row">
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-tag"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Promo</span>
          <span class="info-box-number">
            <?php if ($t_promo->total == 0) {
              echo "Kosong";
            } else {
              echo $t_promo->total;
            } ?>
          </span>
          <a href="<?= base_url('audit/Promo') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-file-alt"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Permintaan</span>
          <span class="info-box-number">
            <?php if ($t_minta->total == 0) {
              echo "Kosong";
            } else {
              echo $t_minta->total;
            } ?></span>
          <a href="<?= base_url('audit/permintaan') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cart-plus"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Penjualan</span>
          <span class="info-box-number">
            <?php if ($t_jual->total == 0) {
              echo "Kosong";
            } else {
              echo $t_jual->total;
            } ?>
          </span>
          <a href="<?= base_url('audit/Penjualan'); ?>" class="text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>

        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-exchange-alt"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Retur</span>
          <span class="info-box-number">
            <?php if ($t_retur->total == 0) {
              echo "Kosong";
            } else {
              echo $t_retur->total;
            } ?>
          </span>
          <a href="<?= base_url('audit/Retur') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-md-8">
      <!-- Penjualan Terakhir -->
      <!-- TABLE: LATEST ORDERS -->
      <div class="card card-warning">
        <div class="card-header border-transparent">
          <h3 class="card-title">
            <li class="fas fa-store"></li> List Toko baru yang belum di approve.
          </h3>
          <div class="card-tools">
            Ada <?= count($list_toko_baru) ?> Toko Baru
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table m-0">
              <thead>
                <tr>
                  <th style="width:20%">Nama Toko</th>
                  <th style="width:20%">Pemohon</th>
                  <th>Alamat</th>
                  <th>Tanggal</th>
                </tr>
              </thead>
              <tbody>
                <?php if (is_array($list_toko_baru)) { ?>
                  <?php
                  foreach ($list_toko_baru as $dd) :
                  ?>
                    <tr>
                      <td><a href="<?= base_url('audit/Toko/profil/' . $dd->id); ?>"><?= $dd->nama_toko ?></a></td>
                      <td><?= $dd->nama_user ?></td>
                      <td>
                        <address><?= $dd->alamat ?></address>
                      </td>
                      <td><span class="badge badge-success"><?= $dd->created_at ?></span></td>
                    </tr>
                  <?php endforeach; ?>
                <?php  } else { ?>
                  <td colspan="5" align="center"><strong>Data Kosong</strong></td>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
          <a href="<?= base_url('audit/Toko'); ?>" class="btn btn-sm btn-warning float-right">Lihat Semua</a>
        </div>
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->
      <!-- end Penjualan -->
      <div class="row">
        <div class="col-md-12">
          <!-- toko teratas -->
          <!-- PRODUCT LIST -->
          <div class="card card-info">
            <div class="card-header">
              <h4 class="card-title"><i class="fas fa-store"></i> List Toko Belum SO</h4>
              <div class="card-tools">
                <?= count($so_toko) ?>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <ul class="products-list product-list-in-card pl-2 pr-2">
                <?php if (is_array($so_toko)) { ?>
                  <?php
                  foreach ($so_toko as $dd) :
                  ?>
                    <li class="item">
                      <div class="product-img">
                        <i class="fas fa-store"></i>
                      </div>
                      <div class="product-info">
                        <a href="<?= base_url('audit/toko/profil/' . $dd->id) ?>" class="product-title"><?= $dd->nama_toko ?>
                          <span class="badge badge-danger float-right">Belum SO</span></a>
                        <span class="product-description">
                          <?= $dd->nama_user ?>
                        </span>
                      </div>
                    </li>
                    <!-- /.item -->
                  <?php endforeach; ?>
                <?php  } else { ?>
                  <span> Data Kosong</span>
                <?php } ?>
              </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
              <a href="<?= base_url('sup/So/list_so') ?>" class="uppercase">Lihat Semua</a>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
          <!-- end toko -->
        </div>
      </div>
    </div>
    <div class="col-md-4">

      <!-- menu sebelah kanan -->
      <!-- Users -->
      <div class="info-box mb-3 bg-primary">
        <span class="info-box-icon"><i class="fas fa-users"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Users</span>
          <span class="info-box-number">
            <?php if ($t_user_all->total == 0) {
              echo "Kosong";
            } else {
              echo $t_user_all->total;
            } ?>
          </span>
        </div>
        <a href="<?= base_url('audit/User') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      <!-- end users -->
      <!-- spv -->
      <div class="info-box mb-3 bg-default">
        <span class="info-box-icon"><i class="fas fa-user"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Supervisor</span>
          <span class="info-box-number">
            <?php if ($t_user_spv->total == 0) {
              echo "Kosong";
            } else {
              echo $t_user_spv->total;
            } ?>
          </span>
        </div>
        <a href="<?= base_url('audit/User') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      <!-- end spv -->
      <!-- leader -->
      <div class="info-box mb-3 bg-default">
        <span class="info-box-icon"><i class="fas fa-user"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Leader</span>
          <span class="info-box-number">
            <?php if ($t_user_leader->total == 0) {
              echo "Kosong";
            } else {
              echo $t_user_leader->total;
            } ?>
          </span>
        </div>
        <a href="<?= base_url('audit/User') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      <!-- end leader -->
      <!-- spg -->
      <div class="info-box mb-3 bg-default">
        <span class="info-box-icon"><i class="fas fa-user"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total SPG</span>
          <span class="info-box-number">
            <?php if ($t_user_spg->total == 0) {
              echo "Kosong";
            } else {
              echo $t_user_spg->total;
            } ?>
          </span>
        </div>
        <a href="<?= base_url('audit/User') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      <!-- end spg -->
      <!-- end -->

    </div>
  </div>
</section>