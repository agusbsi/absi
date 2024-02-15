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
                  $hour = date("G",$b);
                  if ($hour>=0 && $hour<=11)
                  {
                  echo "Selamat Pagi :)";
                  }
                  elseif ($hour >=12 && $hour<=14)
                  {
                  echo "Selamat Siang :) ";
                  }
                  elseif ($hour >=15 && $hour<=17)
                  {
                  echo "Selamat Sore :) ";
                  }
                  elseif ($hour >=17 && $hour<=18)
                  {
                  echo "Selamat Petang :) ";
                  }
                  elseif ($hour >=19 && $hour<=23)
                  {
                  echo "Selamat Malam :) ";
                  }

                  ?>
                </h3>
              </div>
              <div class="card-body">
               <h4> 
                <strong> <?= $this->session->userdata('nama_user') ?> !</strong> </h4> <br>
               ini merupakan Halaman Manager Verifikasi .

              </div>
              <div class="card-footer text-right">
              <a href="#" class=" text-success"><i class="fas fa-book"></i> Baca Peraturan</a>
              </div>
              <!-- /.card -->
      </div>

        <!-- permintaan terbaru -->
            <div class="card card-danger">
              <div class="card-header border-transparent">
                <h3 class="card-title"> <li class="fas fa-file-alt"></li> List Permintaan Terbaru.</h3>
                <div class="card-tools">
                Ada <?= count($permintaan)?> Permintaan
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th style="width:20%">ID Permintaan</th>
                      <th style="width:20%">Nama Toko</th>
                      <th>SPG</th>
                      <th>Tanggal</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php if(is_array($permintaan)){ ?>
                      <?php 
                      foreach($permintaan as $dd):
                       ?>
                      <tr>
                        <td><a href="<?= base_url('sup/permintaan/detail/'.$dd->id); ?>"><?=$dd->id?></a></td>
                        <td><?=$dd->nama_toko?></td>
                        <td><address><?=$dd->nama_user?></address></td>
                        <td><span class="badge badge-success"><?=$dd->created_at?></span></td>
                      </tr>
                      <?php endforeach;?>
                  <?php  }else { ?>
                      <td colspan="5" align="center"><strong>Data Kosong</strong></td>
                  <?php } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="<?= base_url('sup/permintaan'); ?>" class="btn btn-sm btn-danger float-right">Lihat Semua</a>
              </div>
              <!-- /.card-footer -->
            </div>
        <!-- end permintaan -->
      
        <!-- selisih terbaru -->
        <div class="card card-warning">
              <div class="card-header border-transparent">
                <h3 class="card-title"> <li class="fas fa-exclamation-triangle"></li> List selisih Terbaru.</h3>
                <div class="card-tools">
                Ada <?= count($selisih)?> selisih
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th style="width:20%">ID Pengiriman</th>
                      <th style="width:20%">Nama Toko</th>
                      <th>SPG</th>
                      <th>Tanggal</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php if(is_array($selisih)){ ?>
                      <?php 
                      foreach($selisih as $dd):
                       ?>
                      <tr>
                        <td><a href="<?= base_url('sup/selisih/detail/'.$dd->id); ?>"><?=$dd->id?></a></td>
                        <td><?=$dd->nama_toko?></td>
                        <td><address><?=$dd->nama_user?></address></td>
                        <td><span class="badge badge-success"><?=$dd->created_at?></span></td>
                      </tr>
                      <?php endforeach;?>
                  <?php  }else { ?>
                      <td colspan="5" align="center"><strong>Data Kosong</strong></td>
                  <?php } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <!--<a href="<?= base_url('sup/selisih'); ?>" class="btn btn-sm btn-warning float-right">Lihat Semua</a>-->
              </div>
              <!-- /.card-footer -->
            </div>
        <!-- end selisih -->
        <!-- retur terbaru -->
        <div class="card card-danger">
              <div class="card-header border-transparent">
                <h3 class="card-title"> <li class="fas fa-exchange-alt"></li> List retur Terbaru.</h3>
                <div class="card-tools">
                Ada <?= count($retur)?> retur
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th style="width:20%">ID retur</th>
                      <th style="width:20%">Nama Toko</th>
                      <th>SPG</th>
                      <th>Tanggal</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php if(is_array($retur)){ ?>
                      <?php 
                      foreach($retur as $dd):
                       ?>
                      <tr>
                        <td><a href="<?= base_url('sup/retur/detail/'.$dd->id); ?>"><?=$dd->id?></a></td>
                        <td><?=$dd->nama_toko?></td>
                        <td><address><?=$dd->nama_user?></address></td>
                        <td><span class="badge badge-success"><?=$dd->created_at?></span></td>
                      </tr>
                      <?php endforeach;?>
                  <?php  }else { ?>
                      <td colspan="5" align="center"><strong>Data Kosong</strong></td>
                  <?php } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="<?= base_url('sup/retur'); ?>" class="btn btn-sm btn-danger float-right">Lihat Semua</a>
              </div>
              <!-- /.card-footer -->
            </div>
        <!-- end retur -->
    </div>
    <div class="col-md-4">
      <!-- menu sebelah kanan -->
      <!-- <div class="info-box mb-3 bg-success">
          <span class="info-box-icon"><i class="fas fa-cart-plus"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Penjualan</span>
            <span class="info-box-number">
              <?php if($jual == 0){
                      echo "Kosong";
                    }else{
                      echo $jual;
                    } ?>
            </span>
          </div>
          <a href="<?= base_url('sup/permintaan') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div> -->
      <div class="info-box mb-3 bg-danger">
          <span class="info-box-icon"><i class="fas fa-file-alt"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Permintaan Barang</span>
            <span class="info-box-number">
              <?php if($jumlah_permintaan == 0){
                      echo "Kosong";
                    }else{
                      echo $jumlah_permintaan;
                    } ?>
            </span>
          </div>
          <a href="<?= base_url('sup/permintaan') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      <div class="info-box mb-3 bg-info">
          <span class="info-box-icon"><i class="fas fa-box"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Artikel</span>
            <span class="info-box-number">
            <?php if($jumlah_produk == null or $jumlah_produk== 0)
              {
                echo "kosong";
              }else{
                echo $jumlah_produk;
              } 
            ?>
            </span>
          </div>
          <a href="<?= base_url('sup/barang')?>" class="text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      <div class="info-box mb-3 bg-primary">
          <span class="info-box-icon"><i class="fas fa-store"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Toko</span>
            <span class="info-box-number">
            <?php if($toko == null or $toko== 0)
              {
                echo "kosong";
              }else{
                echo $toko;
              } 
            ?>
            </span>
          </div>
          <a href="<?= base_url('sup/toko') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      
      <div class="info-box mb-3 bg-danger">
          <span class="info-box-icon"><i class="fas fa-exchange-alt"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Retur!</span>
            <span class="info-box-number">
              <?php if($jumlah_retur == 0){
                    echo "Kosong";
                  }else{
                    echo $jumlah_retur;
                  } ?>
            </span>
          </div>
          <a href="<?= base_url('sup/retur') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      
      <div class="info-box mb-3 bg-warning">
          <span class="info-box-icon"><i class="fas fa-exclamation-triangle"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Selisih Penerimaan Barang diSPG</span>
            <span class="info-box-number">
              <?php if($jumlah_selisih == 0){
                echo "Kosong";
              }else{
                echo $jumlah_selisih;
              } ?>
            </span>
          </div>
          <!--<a href="<?= base_url('sup/selisih') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>-->
      </div>
      
      <!-- end -->
    </div>
  </div>
</section>