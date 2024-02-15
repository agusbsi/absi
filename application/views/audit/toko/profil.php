<!-- Main content -->
<section class="content">
      <div class="container-fluid">
      <?php 
        if ($cek_status->status == 2){ ?>
          <div class="overlay-wrapper">
            <div class="overlay">
              <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                <div class="text-bold pt-2">Data Toko Menunggu Approve Manager Marketing !</div>
            </div>
          </div>
        <?php }else if ($cek_status->status == 0){ ?>
          <div class="overlay-wrapper">
            <div class="overlay">
              <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                <div class="text-bold pt-2">TOKO NON-AKTIF !</div>
            </div>
          </div>
        <?php }else if ($cek_status->status == 4){ ?>
          <div class="overlay-wrapper">
            <div class="overlay">
              <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                <div class="text-bold pt-2">Data Toko Menunggu Approve Direksi !</div>
            </div>
          </div>
      <?php } ?>
      <?php 
        if ($cek_status->status == 3){ ?>
        <div class="callout callout-danger">
            <h5><i class="fas fa-info "></i> Status Toko : <span class="badge badge-danger"> Toko Belum Aktif </span></h5>
                Toko ini dalam proses Analisa, : <?= status_toko($cek_status->status) ?>
            <hr>
            <form method="POST" action="<?= base_url('audit/Toko/approve') ?>">
              <div class="form-group">
                <label>Rekomendasi Audit</label>
                <select name="approve" class="form-control" required>
                  <option value="">-- Pilih --</option>
                  <option value="1">Setuju</option>
                  <option value="0">Tidak Setuju</option>
                </select>
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" name="keterangan" placeholder="Tambahkan Catatan"></textarea>
                <input name="id_toko" type="hidden" value="<?= $toko->id ?>">
              </div>
              <div>
                <input class="btn btn-primary" type="submit" value="Kirim ke Direksi">
              </div>
            </form>
          </div>
            
        </div>
        <?php } ?>
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-info card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <?php if($toko->foto_toko=="") { 
                    ?>
                    <img style="width: 100%;" class="profile-user-img img-responsive img-rounded" src="<?php echo base_url()?>assets/img/toko/hicoop.png" alt="User profile picture">
                    <?php
                    }else{ ?>
                    <img style="width: 100%;" class="profile-user-img img-responsive img-rounded" src="<?php echo base_url('assets/img/toko/'.$toko->foto_toko)?>" alt="User profile picture">
                  <?php } ?> 
                </div>

                <h3 class="profile-username text-center"><strong><?=$toko->nama_toko?></strong></h3>

                <p class="text-muted text-center">[ ID : <?=$toko->id?> ]</p>

                <div class="card-body">
                  <strong>Jenis Toko :</strong>
                  <p class="text-muted"><?=jenis_toko($toko->jenis_toko)?></p>
                  <hr>
                  <strong> Provinsi :</strong>
                  <p class="text-muted"><?=$toko->provinsi?></p>
                  <hr>
                  <strong> Kabupaten :</strong>
                  <p class="text-muted"><?=$toko->kabupaten?></p>
                  <hr>
                  <strong> Kecamatan :</strong>
                  <p class="text-muted"><?=$toko->kecamatan?></p>
                  <hr>
                  <strong> Alamat :</strong>
                  <p class="text-muted"><?=$toko->alamat?></p>
                  <hr>
                  <strong> PIC / Penanggung Jawab :</strong>
                  <p class="text-muted"><?=$toko->nama_pic?></p>
                  <hr>
                  <strong> Telp / WhatsApp :</strong>
                  <p class="text-muted"><?=$toko->telp?></p>
                  <hr>
                  <strong><i class="fa fa-list"></i> Berkas :</strong>
                  <br>
                  <p>
                  <button type="button" class="btn btn-outline-primary btn-foto btn-sm" data-pic ="<?= $toko->nama_pic ?>" src="<?= base_url('assets/img/toko/'.$toko->foto_pic) ?>" ><i class="fas fa-image"></i>  PIC </button>
                 
                  </p>
                  
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
                    <li class="fas fa-clock"></li> Update data terakhir : <?= (isset($last_update)) ? $last_update : "" ?>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                  <?php 
                      if ($cek_status->status == 3){ ?>
                      <div class="overlay-wrapper">
                          <div class="overlay">
                            <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                            <div class="text-bold pt-2">Menunggu Approve ...</div>
                          </div>
                      </div>
                  <?php } ?>
                  <button type="button" class="btn btn-default btn-sm">Toko ini berlaku untuk harga : <?= status_het($toko->het) ?></button>
                      <table id="example1" class="table table-bordered table-striped">
                          <thead>
                          <tr class="text-center">
                          
                            <th style="width:20%">Kode Artikel #</th>
                            <th style="width:30%">Nama Artikel</th>
                            <th>Satuan</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th style="width:5px">Diskon (%)</th>
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
                              
                              <td><?= $stok->kode ?></td>
                              <td><?= $stok->nama_produk ?></td>
                              <td class="text-center"><?= $stok->satuan ?></td>
                              <td class="text-center">
                                <?php
                                if($stok->status == 2){
                                  echo "<span class='badge badge-warning' >belum di approve </span>";
                                }else{
                                 echo $stok->qty;
                                }
                                ?>
                                </td>
                                <td class="text-right">
                                <?php
                                if($stok->status == 2){
                                  echo "<span class='badge badge-warning' >belum di approve </span>";
                                }else{
                                  if($toko->het == 1){
                                    echo "Rp. "; echo number_format($stok->harga_jawa) ; echo " ,-";
                                  }else {
                                    echo "Rp. "; echo number_format($stok->harga_indobarat) ; echo " ,-";
                                  }
                                }
                                ?>
                            </td>
                            <td class="text-center">
                              <?= $stok->diskon ?>
                            </td>
                          </tr>
                            <?php 
                            $total += $stok->qty;
                            } ?>
                            
                          </tbody>
                          <tfoot>
                          <tr>
                              <td  colspan="3" class="text-right"> <strong>Total :</strong> </td>
                              <td  class="text-center"><b><?php
                                if($cek_status_stok > 0){
                                  echo "<span class='badge badge-warning' >belum di approve </span>";
                                }else{
                                  echo $total;
                                }
                                ?></b></td>
                                <td></td>
                                <td></td>
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

<!-- modal foto berkas -->
<div class="modal fade" id="lihat-foto">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title judul"> <li class="fas fa-box"></li> Berkas  : <a href="#" class="pic"></a></h4>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row ">
             <img class="img-rounded image" id="image" style="width: 100%" src="" alt="User Image">
          </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
<!-- end modal -->
<script>
   $(function() {
     $('.btn-foto').on('click', function() {
       $('.image').attr('src',$(this).attr('src'));
       $('.pic').html($(this).data('pic'));
       $('#lihat-foto').modal('show');   
       });		
   });
</script>
<!-- end modal foto berkas -->

<!-- jQuery -->
<script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
  <script>
    $(document).ready(function(){
    
      $('#table_stok').DataTable({
        order: [[3, 'Desc']],
          responsive: true,
          lengthChange: false,
          autoWidth: false,
      });
      
    
    })
  </script>
  <!-- fungsi approve -->
  <script>
   $(function() {
     $('#btn-approve').on('click', function() {
       $('#modal-approve').modal('show');   
       });		
   });
</script>
  <!-- fungsi approve -->
  <!-- fungsi approve -->


