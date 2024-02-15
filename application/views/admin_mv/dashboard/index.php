<!-- Small boxes (Stat box) -->
<section class="content">
  <div class="row">
    <div class="col-md-8">
      <!-- isi konten sapa -->
      <div class="card card-success card-outline">
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

            ?>,.
          </h3>
        </div>
        <div class="card-body">
          <h4>
            <strong> <?= $this->session->userdata('nama_user') ?> !</strong>
          </h4> <br>
          ini merupakan Halaman admin Marketing Verifikasi !
        </div>
        <div class="card-footer text-right">
          <a href="#" class=" text-success"><i class="fas fa-book"></i> Baca Peraturan</a>
        </div>
        <!-- /.card -->
      </div>
      <!-- permintaan Terakhir -->
      <div class="card card-success">
        <div class="card-header border-transparent">
          <h3 class="card-title">
            <li class="fas fa-file-alt"></li> List Permintaan belum di approve.
          </h3>


        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table m-0">
              <thead>
                <tr>
                  <th>ID Permintaan</th>
                  <th>Toko</th>
                  <th>Tanggal</th>
                </tr>
              </thead>
              <tbody>
                <?php if (is_array($list_minta)) { ?>
                  <?php
                  foreach ($list_minta as $dd) :
                  ?>
                    <tr>
                      <td><a href="#"><?= $dd->id ?></a></td>
                      <td><?= $dd->nama_toko ?></td>
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
          <a href="<?= base_url('adm_mv/Permintaan'); ?>" class="btn btn-sm btn-info float-right">View All Permintaan</a>
        </div>
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->
      <!-- end Penjualan -->
      <!-- Retur Terakhir -->
      <div class="card card-danger">
        <div class="card-header border-transparent">
          <h3 class="card-title">
            <li class="fas fa-exchange-alt"></li> List Retur belum di approve.
          </h3>


        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table m-0">
              <thead>
                <tr>
                  <th>ID Retur</th>
                  <th>Toko</th>
                  <th>Tanggal</th>
                </tr>
              </thead>
              <tbody>
                <?php if (is_array($list_retur)) { ?>
                  <?php
                  foreach ($list_retur as $dd) :
                  ?>
                    <tr>
                      <td><a href="#"><?= $dd->id ?></a></td>
                      <td><?= $dd->nama_toko ?></td>
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
          <a href="<?= base_url('adm_mv/Retur'); ?>" class="btn btn-sm btn-info float-right">View All Retur</a>
        </div>
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->
      <!-- end retur -->
      <!-- end retur -->
    </div>
    <div class="col-md-4">
      <!-- menu sebelah kanan -->
      <div class="info-box mb-3 bg-success">
        <span class="info-box-icon"><i class="fas fa-file-alt"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Permintaan Barang</span>
          <span class="info-box-number">
            <?php if ($jumlah_permintaan == 0) {
              echo "Kosong";
            } else {
              echo $jumlah_permintaan;
            } ?>
          </span>
        </div>
        <a href="<?= base_url('adm_mv/permintaan') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      <div class="info-box mb-3 bg-info">
        <span class="info-box-icon"><i class="fas fa-box"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Barang</span>
          <span class="info-box-number">
            <?php if ($jumlah_produk == null or $jumlah_produk == 0) {
              echo "kosong";
            } else {
              echo $jumlah_produk;
            }
            ?>
          </span>
        </div>
        <a href="<?= base_url('adm_mv/barang') ?>" class="text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      <div class="info-box mb-3 bg-primary">
        <span class="info-box-icon"><i class="fas fa-store"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Toko</span>
          <span class="info-box-number">
            <?php if ($t_toko->total == 0) {
              echo "Kosong";
            } else {
              echo $t_toko->total;
            } ?>
          </span>
        </div>
        <a href="<?= base_url('adm_mv/Toko') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>

      <div class="info-box mb-3 bg-danger">
        <span class="info-box-icon"><i class="fas fa-exchange-alt"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Retur</span>
          <span class="info-box-number">
            <?php if ($jumlah_retur == 0) {
              echo "Kosong";
            } else {
              echo $jumlah_retur;
            } ?>
          </span>
        </div>
        <a href="<?= base_url('adm_mv/retur') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>

      <!-- <div class="info-box mb-3 bg-warning">
          <span class="info-box-icon"><i class="fas fa-exclamation-triangle"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Selisih Penerimaan Barang diSPG</span>
            <span class="info-box-number">
            Cooming Soon
            </span>
          </div>
          <a href="#" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div> -->

      <!-- end -->
    </div>
  </div>
</section>