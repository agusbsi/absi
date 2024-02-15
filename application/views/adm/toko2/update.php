

<!-- Main content -->

<section class="content">
  <div class="row">
    <!-- left column -->
      <div class="col-lg-12">
        <div class="container">
          
            <div class="col-md-6">
              <div class="box box-primary"  >
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-archive" aria-hidden="true"></i> Update Data Toko</h3>
                  <div class="pull-right">
						<?php
						echo anchor('toko', 'Kembali', array('class' => 'btn btn-secondary fa fa-reply'))
						?>
				</div>
                </div>
                
                <!-- /.box-header -->
                <!-- form start -->
                <div class="container">
                  <form action="<?=base_url('toko/proses_update')?>" role="form" method="post">

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
                    <?php foreach($data_update as $d){ ?>

                    <div class="box-body">
                      <div class="row">
                        <div class="col-md-5">
                          <div class="form-group">
                            <label for="id_produk" >SKU</label>
                            <input type="text" name="id_toko" class="form-control" id="id_toko" readonly="readonly" value="<?=$d->id?>">
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
                            <input type="text" name="nama" class="form-control" id="nama" value="<?=$d->nama_toko?>">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-5">
                          <div class="form-group" >
                            <label for="satuan" >Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control" required><?=$d->alamat?></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-5">
                          <div class="form-group" >
                            <label for="satuan" >Deskripsi</label>
                            <textarea name="deskripsi" id="deksripsi" class="form-control" required><?=$d->deskripsi?></textarea>
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