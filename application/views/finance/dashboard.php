<!-- Small boxes (Stat box) --> 
<section class="content">
  <!-- isi konten sapa -->
    <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                <i class="fas fa-bullhorn"></i>
                  Hallo !
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
                <strong>INI HALAMAN FINANCE GLOBALINDO GROUP !</strong>
              </div>
              <div class="card-footer text-right">
              <a href="#" class=" text-success"><i class="fas fa-book"></i> Baca Peraturan</a>
              </div>
              <!-- /.card -->
      </div>
      <!-- end konten -->
   <!-- Small boxes (Stat box) -->
      <div class="row col-12">
        <div class="col-3">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php if($t_toko->total == 0){
                    echo "Kosong";
                  }else{
                    echo $t_toko->total;
                  } ?></h3>

              <p>Total Toko</p>
            </div>
            <div class="icon">
            <i class="fas fa-store"></i>
            </div>
            <a href="<?= base_url('finance/Toko') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-3">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php if($t_artikel->total == 0){
                    echo "Kosong";
                  }else{
                    echo $t_artikel->total;
                  } ?></h3>

              <p>Total Jenis Artikel</p>
            </div>
            <div class="icon">
            <i class="fas fa-cube"></i>
            </div>
            <a href="<?= base_url('finance/Artikel') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-3">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>
              <?php if($t_jual->total == 0){
                    echo "Kosong";
                  }else{
                    echo $t_jual->total;
                  } ?>
              </h3>
              <p>Total artikel terjual</p>
            </div>
            <div class="icon">
            <i class="fas fa-hospital"></i>
            </div>
            <a href="<?= base_url('finance/penjualan') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col --> 
        <!-- ./col -->
        <div class="col-3">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>
              <?php if($t_stok->total == 0){
                    echo "Kosong";
                  }else{
                    echo $t_stok->total;
                  } ?>
              </h3>
              <p>Total Stok</p>
            </div>
            <div class="icon">
            <i class="fas fa-box"></i>
            </div>
            <a href="<?= base_url('finance/Stok') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col --> 
      </div>
        <!-- /.row -->
   <!-- Info boxes -->
</section>