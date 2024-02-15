<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-info card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
              <?php if($detail->foto_aset=="") { 
                ?>
                <img style="width: 100%;" class="profile-user-img img-responsive img-rounded" src="<?php echo base_url('assets/img/user.png')?>" alt="User profile picture">
                <?php
                }else{ ?>
                <img style="width: 100%;" class="profile-user-img img-responsive img-rounded" src="<?php echo base_url('assets/img/aset/'.$detail->foto_aset)?>" alt="User profile picture">
              <?php } ?> 
                </div>
                <br>
                <h3 class="profile-username text-center"><strong><?=$detail->nama_aset?></strong></h3>
                <h4 class="text-center"><?= status_user($detail->status) ?></h4>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <!-- isi konten manajement user -->
             <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-user"></li> Data User</h3>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                  <div class="tab-pane fade show active" id="supervisor" role="tabpanel" >
                    <form class="form-horizontal"  method="post" action="<?= base_url('hrd/aset') ?>">                 
                      <table  class="table table-bordered table-striped">
                        <thead>                      
                        </thead>
                        <tbody>
                          <tr>
                            <th style="width: 10%">NIK KTP</th>
                            <th style="width: 5%"> : </th>
                            <th style="width: 60%"><?= $detail->id ?></th>
                          </tr>
                          <tr>
                            <th style="width: 10%">Nama User</th>
                            <th style="width: 5%"> : </th>
                            <th style="width: 60%"><?= $detail->nama_aset ?></th>
                          </tr>
                          </tr>   
                        </tbody>
                      </table>
                      <div class="row no-print">
                        <div class="col-12">
                          <?php 
                          date_default_timezone_set('Asia/Jakarta');
                          ?>
                        <input type="hidden" name="updated" class="form-control"  readonly="readonly" value="<?php echo date('Y-m-d H:i:s'); ?>"> 
                        <input type="hidden" name="id_user" value="<?= $detail->id ?>">  
                        <button class="btn btn-danger float-right"><i class="fas fa-arrow-left"></i> Kembali</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
            <!-- end manajement user -->
            <hr>
            <!-- manajement stok -->
            </div>
        <!-- /.card -->
            <!-- end stok -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->



<!-- jQuery -->
<script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
  <script>
    $(document).ready(function(){
    
      $('#table_stok').DataTable({
       
          responsive: true,
          lengthChange: false,
          autoWidth: false,
      });
      
    
    })
  </script>
