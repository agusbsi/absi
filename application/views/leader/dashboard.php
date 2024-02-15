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
                  echo "Selamat Pagi";
                  }
                  elseif ($hour >=12 && $hour<=14)
                  {
                  echo "Selamat Siang ";
                  }
                  elseif ($hour >=15 && $hour<=17)
                  { 
                  echo "Selamat Sore ";
                  }
                  elseif ($hour >=17 && $hour<=18)
                  {
                  echo "Selamat Petang ";
                  }
                  elseif ($hour >=19 && $hour<=23)
                  {
                  echo "Selamat Malam ";
                  }

                  ?>,<strong> <?= $this->session->userdata('nama_user') ?> !</strong>
                </h3>
              </div>
              <div class="card-body">
               <strong>INI HALAMAN TEAM LEADER.</strong>
              </div>
              <div class="card-footer text-right">
              <a href="#" class=" text-success"><i class="fas fa-book"></i> Baca Peraturan</a>
              </div>
              <!-- /.card -->
      </div>
      <!-- end konten -->
       <!-- Penjualan Terakhir -->
       <!-- TABLE: LATEST ORDERS -->
       <div class="card card-success">
              <div class="card-header border-transparent">
                <h3 class="card-title"> <li class="fas fa-cart-plus"></li> Penjualan Terbaru bulan ini.</h3>

               
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>ID Penjualan</th>
                      <th>Toko</th>
                      <th>Tanggal</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php if(is_array($list_jual)){ ?>
                      <?php 
                      foreach($list_jual as $dd):
                       ?>
                      <tr>
                        <td><a href="<?= base_url('leader/penjualan/detail_p/'.$dd->id); ?>"><?=$dd->id?></a></td>
                        <td><?=$dd->nama_toko?></td>
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
                <a href="<?= base_url('leader/penjualan'); ?>" class="btn btn-sm btn-success float-right">Lihat Semua</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
      <!-- end Penjualan -->
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
                      <th >ID Permintaan</th>
                      <th >Nama Toko</th>
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
                        <td><a href="<?= base_url('leader/permintaan/detail_p/'.$dd->id); ?>"><?=$dd->id?></a></td>
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
                <a href="<?= base_url('leader/permintaan'); ?>" class="btn btn-sm btn-danger float-right">Lihat Semua</a>
              </div>
              <!-- /.card-footer -->
            </div>
        <!-- end permintaan -->
      <!-- retur terbaru -->
      <div class="card card-warning">
              <div class="card-header border-transparent">
                <h3 class="card-title"> <li class="fas fa-exchange-alt"></li> List Retur Terbaru.</h3>
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
                      <th >ID retur</th>
                      <th >Nama Toko</th>
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
                        <td><a href="<?= base_url('leader/retur/detail_p/'.$dd->id); ?>"><?=$dd->id?></a></td>
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
                <a href="<?= base_url('leader/retur'); ?>" class="btn btn-sm btn-warning float-right">Lihat Semua</a>
              </div>
              <!-- /.card-footer -->
            </div>
        <!-- end retur -->
    
      
    </div>
    <div class="col-md-4">
    
      <!-- menu sebelah kanan -->
      <div class="info-box mb-3 bg-info">
          <span class="info-box-icon"><i class="fas fa-store"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Toko</span>
            <span class="info-box-number">
              <?php if($t_toko->total == 0){
                      echo "Kosong";
                    }else{
                      echo $t_toko->total;
                    } ?>
            </span>
          </div>
          <a href="<?= base_url('leader/Toko') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      <div class="info-box mb-3 bg-success">
          <span class="info-box-icon"><i class="fas fa-cart-plus"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Penjualan</span>
            <span class="info-box-number">
            <?php if($t_jual->total == 0){
                      echo "Kosong";
                    }else{
                      echo $t_jual->total;
                    } ?>
            </span>
          </div>
          <a href="<?= base_url('leader/Penjualan') ?>" class="text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      
      <div class="info-box mb-3 bg-danger">
          <span class="info-box-icon"><i class="fas fa-file-alt"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Permintaan</span>
            <span class="info-box-number">
            <?php if($t_minta->total == 0){
                      echo "Kosong";
                    }else{
                      echo $t_minta->total;
                    } ?>
            </span>
            </span>
          </div>
          <a href="<?= base_url('leader/permintaan') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      <div class="info-box mb-3 bg-warning">
          <span class="info-box-icon"><i class="fas fa-exchange-alt"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Retur</span>
            <span class="info-box-number">
            <?php if($t_retur->total == 0){
                      echo "Kosong";
                    }else{
                      echo $t_retur->total;
                    } ?>
            </span>
          </div>
          <a href="<?= base_url('leader/Retur') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      
      <div class="info-box mb-3 bg-primary">
          <span class="info-box-icon"><i class="fas fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total SPG</span>
            <span class="info-box-number">
              <?php if($t_user == 0){
                echo "Kosong";
              }else{
                echo $t_user;
              } ?>
            </span>
          </div>
          <a href="<?= base_url('leader/Spg') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      
      <!-- end -->
    </div>
  </div>
</section>