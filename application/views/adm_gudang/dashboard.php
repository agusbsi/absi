<!-- Small boxes (Stat box) -->
<section class="content">
    <div class="container-fluid">
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
        
            <!-- end kotak -->
        </div>
        <!-- End Row untuk box -->
        <div class="row">
            <section class="col-lg-7 connectedSortable">
                    <!-- isi konten sapa -->
                    <div class="card card-success card-outline">
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

                                ?>,. <strong> <?= $this->session->userdata('username') ?> !</strong> </h4> <br>
                            ini merupakan Halaman Admin Gudang Utama PT. Vista Mandiri Gemilang.
                            </div>
                            <div class="card-footer text-right">
                            <a href="#" class=" text-success"><i class="fas fa-book"></i> Baca Peraturan</a>
                            </div>
                            <!-- /.card -->
                    </div>
                    <!-- end konten -->
            </section>
            <section class="col-lg-5 connectedSortable">
                  <!-- PRODUCT LIST -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title"> <i class="fas fa-list"></i>  Permintaan Terbaru </h3>
                <div class="card-tools">
                 
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    <?php
                    foreach ($terbaru as $t):
                    ?>
                  <li class="item">
                    
                        <div class="product-info">
                        <a href="<?= base_url('adm_gudang/Permintaan') ?>" class="product-title">[ <?= $t->id ?> ]
                            <span class="float-right"><?= status_permintaan($t->status) ?></span></a>
                        <span class="product-description">
                          <b> <?= $t->nama_toko ?> </b> ,  <i class="fas fa-clock"></i> Tanggal : <?= $t->created_at ?>
                        </span>
                        </div>
                  </li>
                 <?php endforeach ?>
                  <!-- /.item -->
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="<?= base_url('adm_gudang/permintaan') ?>" class="uppercase">Lihat Semua</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
            </section>
        </div>
      
    </div>
</section>
<!-- end boxes -->



