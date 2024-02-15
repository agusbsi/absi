<!-- Main content -->

    <section class="content">
      <div class="row">
        <!-- left column -->
          <div class="col-lg-12">
            <div class="container">
              
                <div class="col-md-6">
                  <div class="box box-primary"  >
                    <div class="box-header with-border">
                      <h3 class="box-title"><i class="fa fa-archive" aria-hidden="true"></i> Tambah Data Toko</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="container">
                      <form action="<?=base_url('toko/proses_tambah')?>" role="form" method="post" enctype="multipart/form-data">

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
                       
                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-group">
                                <label for="nama" >Nama Toko</label>
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Toko" required>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-group" >
                                <label for="satuan" >Alamat</label> </br>
                               <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat"  required></textarea>
                              </div>
                            </div>
                          </div> 
                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-group" >
                                <label for="satuan" >telepon</label> </br>
                                <input type="number" name="telp" class="form-control" id="telp" placeholder="NO Telepon" required>
                              </div>
                            </div>
                          </div> 
                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-group" >
                                <label for="satuan" >Deskripsi</label> </br>
                               <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Deskripsi Toko"></textarea>
                              </div>
                            </div>
                          </div> 
                          <div class="row">
                            <div class="col-md-5">
                              <div class="form-group" >
                                <label for="satuan" >Foto Toko</label> </br>
                                <input type="file" name="foto" class="form-control" id="foto" placeholder="Foto Toko" accept="image/png, image/jpeg, image/jpg, image/gif">
                              </div>
                            </div>
                          </div> 
                        <!-- /.box-body -->
                        <div class="row">
                          <div class="col-md-4">
                          <div class="box-footer align-middle">
                          <button type="button" onclick="history.back(-1)" class="btn btn-danger"><i class="fa fa-step-backward" aria-hidden="true"></i> Cancel</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Tambah</button>  
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