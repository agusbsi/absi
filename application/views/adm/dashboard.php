<!-- Small boxes (Stat box) -->
<section class="content">
<div class="container-fluid">
  <!-- box master -->
  <div class="row">
  <?php foreach ($box as $info_box) : ?>
				<div class="col-lg-3 col-6">
					<div class="small-box <?= $info_box->box ?>">
						<div class="inner">

							<h3 class="count">
                            <?php if(($info_box->total)==0){ 
                                echo "kosong"; 
                            }else{
                                echo $info_box->total;
                            }
                            ?>
                            </h3>
							<p><?= $info_box->title; ?></p>
						</div>
						<div class="icon">
							<i class="fa fa-<?= $info_box->icon ?>"></i>
						</div>
						<a href="<?= base_url() . strtolower($info_box->link); ?>" class="small-box-footer">
							Lihat Data
							<i class="fa fa-arrow-circle-right"></i>
						</a>
					</div>
				</div>
			<?php endforeach; ?>
        
  </div>
  <!-- box transaksi -->
  <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-gradient-info">
              <span class="info-box-icon"><i class="fas fa-list-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Data Permintaan</span>
                <span class="info-box-number">
                <?php if($t_minta->total == 0){
                      echo "Kosong";
                    }else{
                      echo $t_minta->total;
                    } ?>
                </span>

                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="progress-description">
                <a href="<?= base_url('adm/permintaan') ?>" class=" text-white text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-gradient-success">
              <span class="info-box-icon"><i class="fas fa-truck"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Data Pengiriman</span>
                <span class="info-box-number">
                <?php if($t_kirim->total == 0){
                      echo "Kosong";
                    }else{
                      echo $t_kirim->total;
                    } ?>
                </span>

                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="progress-description">
                <a href="<?= base_url('adm/pengiriman') ?>" class=" text-white text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-gradient-warning">
              <span class="info-box-icon"><i class="fas fa-cart-plus"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Data Penjualan</span>
                <span class="info-box-number">
                <?php if($t_jual->total == 0){
                      echo "Kosong";
                    }else{
                      echo $t_jual->total;
                    } ?>
                </span>

                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="progress-description">
                <a href="<?= base_url('adm/Penjualan') ?>" class=" text-white text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-gradient-danger">
              <span class="info-box-icon"><i class="fas fa-exchange-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Data Retur</span>
                <span class="info-box-number">
                <?php if($t_retur->total == 0){
                      echo "Kosong";
                    }else{
                      echo $t_retur->total;
                    } ?>
                </span>

                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="progress-description">
                <a href="<?= base_url('adm/Retur') ?>" class=" text-white text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
  </div>
  <div class="row">
    <div class="col-md-8">
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
                <a href="<?= base_url('adm/toko') ?>" class="uppercase">Lihat Semua Toko</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
      <!-- end toko -->
     
    </div>
    <div class="col-md-4">
      <!-- isi Calender -->
      <!-- Calendar -->
      <div class="card bg-gradient-success">
                <div class="card-header border-0">

                    <h3 class="card-title">
                    <i class="far fa-calendar-alt"></i>
                    Calendar
                    </h3>
                    <!-- tools card -->
                    <div class="card-tools">
                    <!-- button with a dropdown -->
                    <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body pt-0">
                    <!--The calendar -->
                    <div id="calendar" style="width: 100%"></div>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
    </div>
  </div>
  
</div>
</section>
<!-- jQuery -->
<script src="<?php echo base_url()?>/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url()?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>