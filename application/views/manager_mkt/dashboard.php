<!-- Small boxes (Stat box) --> 
<section class="content">
   <!-- Info boxes -->
   <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-store"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Toko</span>
                <span class="info-box-number">
                <?php if($t_toko->total == 0){
                      echo "Kosong";
                    }else{
                      echo $t_toko->total;
                    } ?>
                </span>
                <a href="<?= base_url('mng_mkt/Toko') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                <?php if($t_minta->total == 0){
                      echo "Kosong";
                    }else{
                      echo $t_minta->total;
                    } ?></span>
                <a href="<?= base_url('mng_mkt/permintaan') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                <?php if($t_jual->total == 0){
                      echo "Kosong";
                    }else{
                      echo $t_jual->total;
                    } ?>
                </span>
                <a href="<?= base_url('mng_mkt/Penjualan');?>" class="text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                <?php if($t_retur->total == 0){
                      echo "Kosong";
                    }else{
                      echo $t_retur->total;
                    } ?>
                </span>
                <a href="<?= base_url('mng_mkt/Retur') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        
        </div>
        <!-- /.row -->
  <div class="row">
    <div class="col-md-8">
    
      <!-- isi konten sapa -->
      <div class="card card-danger card-outline">
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

                  ?>,
                </h3>
              </div>
              <div class="card-body">
               <h4> 
                 <strong> <?= $this->session->userdata('nama_user') ?> !</strong> </h4> <br>
                <strong>INI HALAMAN MANAGER MARKETING !</strong>
              </div>
              <div class="card-footer text-right">
              <a href="#" class=" text-success"><i class="fas fa-book"></i> Baca Peraturan</a>
              </div>
              <!-- /.card -->
      </div>
      <!-- end konten -->
          <!-- list Artikel baru dari spv -->
       <!-- TABLE: LATEST ORDERS -->
       <div class="card card-warning">
              <div class="card-header border-transparent">
                <h3 class="card-title"> <li class="fas fa-box"></li>  List Artikel baru yang belum di approve.</h3>
                <div class="card-tools">
                Ada <?= count($artikel_new)?> Artikel Baru
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th style="width:25%">Nama Toko</th>
                      <th style="width:20%">Kode Artikel</th>
                      <th style="width:35%">Nama Artikel</th>
                      <th>Harga</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php if(is_array($artikel_new)){ ?>
                      <?php 
                      foreach($artikel_new as $dd):
                       ?>
                      <tr>
                        <td><?=$dd->nama_toko?></td>
                        <td><?=$dd->kode?></td>
                        <td><address><?=$dd->nama_produk?></address></td>
                        <td> <?= status_het($dd->het) ?></td>
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
                <a href="<?= base_url('mng_mkt/Artikel'); ?>" class="btn btn-sm btn-warning float-right">Lihat Semua</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
      <!-- end Penjualan -->
      <!-- end list artikel -->
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
                        <td><a href="#"><?=$dd->id?></a></td>
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
                <a href="<?= base_url('mng_mkt/penjualan'); ?>" class="btn btn-sm btn-info float-right">View All Penjualan</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
      <!-- end Penjualan -->

    </div>
    <div class="col-md-4">
    
      <!-- menu sebelah kanan -->
      <!-- spv -->
      <div class="info-box mb-3 bg-info">
          <span class="info-box-icon"><i class="fas fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Supervisor</span>
            <span class="info-box-number">
            <?php if($t_user_spv->total == 0){
                    echo "Kosong";
                  }else{
                    echo $t_user_spv->total;
                  } ?>
            </span>
          </div>
          <a href="<?= base_url('mng_mkt/User') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      <!-- end spv -->
      <!-- leader -->
      <div class="info-box mb-3 bg-warning">
          <span class="info-box-icon"><i class="fas fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Leader</span>
            <span class="info-box-number">
            <?php if($t_user_leader->total == 0){
                    echo "Kosong";
                  }else{
                    echo $t_user_leader->total;
                  } ?>
            </span>
          </div>
          <a href="<?= base_url('mng_mkt/User') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      <!-- end leader -->
      <!-- spg -->
      <div class="info-box mb-3 bg-danger">
          <span class="info-box-icon"><i class="fas fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total SPG</span>
            <span class="info-box-number">
            <?php if($t_user_spg->total == 0){
                    echo "Kosong";
                  }else{
                    echo $t_user_spg->total;
                  } ?>
            </span>
          </div>
          <a href="<?= base_url('mng_mkt/User') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      <!-- end spg -->
      <!-- end -->
      <!-- toko teratas -->
      <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-store"></i> 5 TOP  - Toko teraktif</h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                <?php if(is_array($toko_aktif)){ ?>
                      <?php 
                      foreach($toko_aktif as $dd):
                       ?>
                  <li class="item">
                    <div class="product-img">
                      <i class="fas fa-store"></i>
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title"><?=$dd->nama_toko?>
                        <span class="badge badge-warning float-right"><?=$dd->total?> Transaksi</span></a>
                      <span class="product-description">
                      <?=$dd->nama_user?> 
                      </span>
                    </div>
                  </li>
                  <!-- /.item -->
                  <?php endforeach;?>
                  <?php  }else { ?>
                     <span> Data Kosong</span>
                  <?php } ?>
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="<?= base_url('mng_mkt/toko') ?>" class="uppercase">Lihat Semua Toko</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
      <!-- end toko -->
    </div>
  </div>
</section>