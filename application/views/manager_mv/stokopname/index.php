     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-5">
              <!-- Widget: user widget style 1 -->
              <div class="card card-widget widget-user shadow">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-info">
                  <h3 class="widget-user-username">STOK OPNAME</h3>
                  <h5 class="widget-user-desc">BULAN INI</h5>
                    
                </div>
                <div class="card-body">
                    <div class="row">
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header"><?= $t_toko ?></h5>
                          <span class="description-text">TOTAL TOKO</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header"><?= $t_so ?></h5>
                          <span class="description-text">SUDAH SO</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-4">
                        <div class="description-block">
                          <h5 class="description-header"><?= $t_bso ?></h5>
                          <span class="description-text">BELUM SO</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                    </div>
                </div>
                <div class="card-footer">
                <a href="<?= base_url('sup/So/list_so');?>"  class="btn btn-info btn-block"> Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- /.widget-user -->
          </div>
          <div class="col-md-2"></div>
          <div class="col-md-5">
              <!-- Widget: user widget style 1 -->
              <div class="card card-widget widget-user shadow">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-warning">
                  <h3 class="widget-user-username">RIWAYAT</h3>
                  <h5 class="widget-user-desc">STOK OPNAME</h5>
                    <div class="row">
                     
                    </div>
                </div>
                <div class="card-footer">
                <a href="<?= base_url('sup/So/riwayat_so');?>"  class="btn btn-warning btn-block"> Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- /.widget-user -->
          </div>
          
          
            <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
