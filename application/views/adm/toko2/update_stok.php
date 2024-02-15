

<!-- Main content -->

<section class="content">
  <div class="row">
    <!-- left column -->
      <div class="col-lg-12">
        <div class="container">
          
            <div class="col-md-6">
              <div class="box box-primary"  >
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-archive" aria-hidden="true"></i> Update Data Stok</h3>
                  <div class="pull-right">
				</div>
                </div>
                
                <!-- /.box-header -->
                <!-- form start -->
                <div class="container">
                  <form action="<?=base_url('toko/proses_update_stok')?>" role="form" method="post">

                    <?php if($this->session->flashdata('msg_berhasil')){ ?>
                      <div class="alert alert-success alert-dismissible" >
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Success!</strong><br> <?php echo $this->session->flashdata('msg_berhasil');?>
                    </div>
                    <?php } ?>

                    <?php if(validation_errors()){ ?>
                    <div class="alert alert-warning alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Warning!</strong><br> <?php echo validation_errors(); ?>
                  </div>
                    <?php } ?>

                    <!-- ambil data untuk di update -->
                    <?php foreach($stok as $s){ ?>

                    <div class="box-body">
                      <div class="row">
                        <div class="col-md-5">
                          <div class="form-group">
                            <label for="id_produk" >ID Stok</label>
                            <input type="text" name="id_stok" class="form-control" id="id_stok" readonly="readonly" value="<?=$s->id_stok?>">
                            <?php 
                            date_default_timezone_set('Asia/Jakarta');
                            ?>
                            <input type="hidden" name="updated" class="form-control"  readonly="readonly" value="<?php echo date('Y-m-d H:i:s'); ?>">
                            </div>
                        </div>
                      </div>
                    
                      <div class="row">
                        <div class="col-md-5">
                          <div class="form-group">
                            <label for="nama" >Nama Toko</label>
                            <input type="text" name="toko" class="form-control" id="toko" value="<?=$s->toko?>" readonly>
                            <input type="hidden" name="id_toko" class="form-control" id="toko" value="<?=$s->id_toko?>" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-5">
                          <div class="form-group">
                            <label for="nama" >Nama Produk</label>
                            <input type="text" name="produk" class="form-control" id="produk" value="<?=$s->produk?>" readonly>
                            <input type="hidden" name="id_produk" class="form-control" id="id_produk" value="<?=$s->id_produk?>" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-5">
                          <div class="form-group">
                            <label for="nama" >Qty Stok</label>
                            <input type="text" name="qty" class="form-control" id="qty" value="<?=$s->qty?>">
                          </div>
                        </div>
                      </div>
                      
                      <?php } ?>
                      
                    <!-- /.box-body -->
                    <div class="row">
                      <div class="col-md-4">
                      <div class="box-footer align-middle">
                      <button type="button" onclick="history.back(-1)" class="btn btn-danger"><i class="fa fa-step-backward" aria-hidden="true"></i> Cancel</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i>Update</button>  
                      </div>
                      </div>
                    </div>
                      
                  </form>
                </div>
              </div>
              <!-- end box primary -->
            </div>
          
            <!-- general form elements -->

        </div>
        <!-- end container -->
      </div>
  </div>
</section>
<!-- /.content -->