<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="callout callout-danger">
          <div class="row">
          <div class="col-md-6">
          <h5><i class="fas fa-info "></i> Status Toko : <span class="badge badge-danger"> Toko Belum Aktif </span></h5>
                Toko ini dalam proses Analisa Tim Audit, Menunggu Approval.
          </div>
          <div class="col-md-6 text-right">
            <br>
            <button id="btn-reject" class="btn btn-danger mr-3"><li class="fas fa-times-circle"></li> reject</button>
            <button id="btn-approve" class="btn btn-success mr-3"><li class="fas fa-check-circle"></li> Approve</button>
            
          </div>
          </div>
            
        </div>
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-info card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
              <?php if($toko->foto=="") { 
                ?>
                <img style="width: 100%;" class="profile-user-img img-responsive img-rounded" src="<?php echo base_url()?>assets/img/toko/hicoop.png" alt="User profile picture">
                <?php
                }else{ ?>
                <img style="width: 100%;" class="profile-user-img img-responsive img-rounded" src="<?php echo base_url('assets/img/user.png')?>" alt="User profile picture">
              <?php } ?> 
                </div>

                <h3 class="profile-username text-center"><strong><?=$toko->nama_toko?></strong></h3>

                <p class="text-muted text-center">[ ID : <?=$toko->id?> ]</p>

                <div class="card-body">
                  <strong><i class="fa fa-map"></i> Alamat</strong>
                  <p class="text-muted"><?=$toko->alamat?></p>
                  <hr>
                  <strong><i class="fa fa-phone"></i> Telp</strong>
                  <p class="text-muted"><?=$toko->telp?></p>
                  <hr>
                  <strong><i class="fa fa-list"></i> Deskripsi</strong>
                  <p class="text-muted"><?=$toko->deskripsi?></p>
                  <hr>
                  
                    <div class="text-center">
                    
                    </div>
                </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <!-- isi konten manajement user -->
            <div class="card card-info card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                  <li class="pt-2 px-3"><h3 class="card-title"><li class="fas fa-users"></li> Manajement User</h3></li>
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#spv" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Supervisor</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link  " id="custom-tabs-two-profile-tab" data-toggle="pill" href="#team_leader" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Team Leader</a>
                  </li>
                  
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#spg" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">SPG</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-profile-tab">
                  <div class="tab-pane fade show active" id="spv" role="tabpanel">
                    <form class="form-horizontal" method="post">
                    
                     <?php
                     if ($spv->id_spv == "0"){?>
                     <span class="badge badge-danger"> Supervisor Belum dikaitkan</span>
                     <?php }else { ?>
                      <table  class="table  table-striped" >
                        <thead>
                          <tr>
                              <th style="width:60%">Nama Supervisor</th>
                         
                          </tr>
                        </thead>
                        <tbody>
                        
                          <tr>
                            <td>
                                  <div class="user-block">
                                    <img class="img-circle" src="<?php echo base_url()?>assets/img/user.png?>" alt="User Image">
                                    <span class="username"><a href="#"><?=$spv->nama_user?></a></span>
                                    </div>
                            </td>
                           
                          </tr>
                       <?php } ?>
                        </tbody>
                        <tfoot>
                        </tfoot>
                      </table>
                    </form>
                  </div>
                  <div class="tab-pane fade " id="team_leader" role="tabpanel">
                    <form class="form-horizontal" method="post">
                    
                     <?php
                     if ($leader_toko->id_leader == "0"){?>
                     <span class="badge badge-danger"> Tim Leader Belum dikaitkan</span>
                     <?php }else { ?>
                      <table  class="table  table-striped" >
                        <thead>
                          <tr>
                              <th style="width:60%">Nama Tim Leader</th>
                         
                          </tr>
                        </thead>
                        <tbody>
                        
                          <tr>
                            <td>
                                  <div class="user-block">
                                    <img class="img-circle" src="<?php echo base_url()?>assets/img/user.png?>" alt="User Image">
                                    <span class="username"><a href="#"><?=$leader_toko->nama_user?></a></span>
                                    </div>
                            </td>
                           
                          </tr>
                       <?php } ?>
                        </tbody>
                        <tfoot>
                        </tfoot>
                      </table>
                    </form>
                  </div>
                  <!-- spg -->
                  <div class="tab-pane fade" id="spg" role="tabpanel">
                    
                    <form class="form-horizontal" method="post">
                    <?php
                     if ($spg->id_spg == "0"){?>
                     <span class="badge badge-danger"> Tim Leader Belum dikaitkan</span>
                     <?php }else { ?>
                          <table  class="table  table-striped" >
                            <thead>
                              <tr>
                                  <th style="width:60%">Nama SPG</th>
                              
                              </tr>
                            </thead>
                            <tbody>
                            
                              <tr>
                                <td>
                                      <div class="user-block">
                                        <img class="img-circle" src="<?php echo base_url()?>assets/img/user.png?>" alt="User Image">
                                        <span class="username"><a href="#"><?=$spg->nama_user?></a></span>
                                        </div>
                                </td>
                              
                              </tr>
                          
                            </tbody>
                            <tfoot>
                            </tfoot>
                          </table>
                      <?php } ?>
                   
                        
                     
                    </form>
                  </div>
                  <!-- end spg -->
                </div>
              </div>
              <!-- /.card -->
            </div>
            <!-- end manajement user -->
            <hr>
            <!-- manajement stok -->
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-box"></li> Data Stok Artikel</h3>

                <div class="card-tools">
                  <li class="fas fa-clock"></li> Update data terakhir : 12-01-2023
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <table id="table_stok" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                         
                          <th style="width:20%">Kode Artikel #</th>
                          <th style="width:40%">Nama Artikel</th>
                       
                          <th>Satuan</th>
                          <th>Stok</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        <?php
                        $no = 0;
                        $total = 0;
                        foreach($stok_produk as $stok){
                          $no++
                          ?>
                            
                            <td><?= $stok->id_produk ?></td>
                            <td><?= $stok->nama_produk ?></td>
                         
                            <td><?= $stok->satuan ?></td>
                            <td class="text-center"><?= $stok->qty ?></td>
                        </tr>
                          <?php 
                          $total += $stok->qty;
                          } ?>
                          
                        </tbody>
                        <tfoot>
                        <tr>
                            <td  colspan="3" class="text-right"> <strong>Total :</strong> </td>
                            <td  class="text-center"><b><?= $total ; ?></b></td>
                          </tr>
                       
                        </tfoot>
                      </table>

                  </div>
                  <!-- /.tab-content -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
              <i class="fas fa-bullhorn"></i> Data ini merupakan jumlah stok yang dimiliki toko : <b><?= $toko->nama_toko ?></b> .
              </div>
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
<!-- fungsi approve -->
  <script>
     $('#btn-approve').click(function(e){
    e.preventDefault();
    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Toko ini akan menjadi Aktif dan bisa melakukan transaksi",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Batal',
      confirmButtonText: 'Approve'
    }).then((result) => {
      if (result.isConfirmed) {
        location.href = "<?= base_url('audit/Toko/approve/'.$toko->id) ?>";
      }
    })
  })
  </script>
<!-- fungsi approve -->
  <script>
     $('#btn-reject').click(function(e){
    e.preventDefault();
    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Toko ini akan Dinonaktifkan",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Batal',
      confirmButtonText: 'Reject'
    }).then((result) => {
      if (result.isConfirmed) {
        location.href = "<?= base_url('audit/Toko/reject/'.$toko->id) ?>";
      }
    })
  })
  </script>

