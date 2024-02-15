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
                <a href="<?= base_url('hrd/so') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-exclamation-triangle"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Toko Belum Update Aset</span>
                <span class="info-box-number">
                <?php if($t_toko_aset->total == 0){
                      echo "Kosong";
                    }else{
                      echo $t_toko_aset->total;
                    } ?></span>
                <a href="<?= base_url('hrd/so') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
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
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-exclamation-triangle"></i></span>
              
              <div class="info-box-content">
                <span class="info-box-text">Toko Belum Stok Opname (SO)</span>
                <span class="info-box-number">
                <?php if($t_toko_so->total == 0){
                      echo "Kosong";
                    }else{
                      echo $t_toko_so->total;
                    } ?>
                </span>
                <a href="<?= base_url('hrd/so');?>" class="text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
              
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total User</span>
                <span class="info-box-number">
                <?php if($t_user->total == 0){
                    echo "Kosong";
                  }else{
                    echo $t_user->total;
                  } ?>
                </span>
                <a href="<?= base_url('hrd/user') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
  <div class="row">
    <div class="col-md-8">
      <!-- isi konten sapa -->
      <div class="card card-danger card-outline">
              <div class="card-header">
                <h3 class="card-title">
                <i class="fas fa-bullhorn"></i>
                  Perhatian !
                </h3>
              </div>
              <div class="card-body">
               <h4> 
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

                  ?>, <strong> <?= $this->session->userdata('nama_user') ?> !</strong> </h4> <br>
                <strong>INI HALAMAN HRD/GA !</strong>
              </div>
              <div class="card-footer text-right">
              <a href="#" class=" text-success"><i class="fas fa-book"></i> Baca Peraturan</a>
              </div>
              <!-- /.card -->
      </div>
      <!-- end konten -->
    </div>
    <div class="col-md-4">
      <!-- toko teratas -->
      <!-- PRODUCT LIST -->
      <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-store"></i> List Toko Belum Stok Opname (SO)</h3>
                
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
                        <span class="badge badge-warning float-right">Belum SO !</span></a>
                      <span class="product-description">
                      <?=$dd->nama_user?> (SPG)
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
                <a href="<?= base_url('hrd/so') ?>" class="uppercase">Lihat Semua Toko</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
      <!-- end toko -->
    </div>
  </div>
</section>