<!-- Main content -->
<section class="content">
      <div class="container-fluid">
      <?php if ($cek_status->status == 0){ ?>

          <div class="overlay-wrapper">
            <div class="overlay">
              <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                <div class="text-bold pt-2">TOKO NON-AKTIF !</div>
            </div>
          </div>
      <?php }else if ($cek_status->status == 2){ ?>
          <div class="overlay-wrapper">
            <div class="overlay">
              <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                <div class="text-bold pt-2">Data Toko Menunggu Approve Manager Marketing !</div>
            </div>
          </div>
        <?php }else if ($cek_status->status == 3){ ?>
          <div class="overlay-wrapper">
            <div class="overlay">
              <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                <div class="text-bold pt-2">Data Toko Menunggu Pemeriksaan Audit !</div>
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
      </div> 
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
                  <strong><i class="fa fa-list"></i> Foto PIC :</strong>
                  <br>
                  <p>
                  <button type="button" class="btn btn-outline-primary btn-foto " data-pic ="<?= $toko->nama_pic ?>" src="<?= base_url('assets/img/toko/'.$toko->foto_pic) ?>" ><i class="fas fa-image"></i> PIC</button>
                 
                  </p>
                  
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
                      <a class="nav-link active " id="custom-tabs-two-profile-tab" data-toggle="pill" href="#team_leader" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Team Leader</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#spg" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">SPG</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
      
                  <div class="tab-content" id="custom-tabs-two-profile-tab">
                    <div class="tab-pane fade show active" id="team_leader" role="tabpanel">
                      <form class="form-horizontal" method="post">
                        <div class="form-group">
                              <div class="text-right">
                              
                                <button type="button" class="btn btn-success <?= (count($leader_toko) > 0) ? 'd-none' : ''; ?>" data-toggle="modal"  data-target="#modal-leader" ><li class="fas fa-plus-circle"></li>
                                  Pilih Tim Leader
                                </button>
                              </div> 
                        </div>
                        <?= (count($leader_toko) > 0) ? '' : '<span class="badge badge-danger"> Tim Leader Belum dikaitkan</span>'; ?>
                        <table  class="table  table-striped" <?= (count($leader_toko) > 0) ? '' : 'hidden'; ?>>
                          <thead>
                            <tr>
                                <th style="width:60%">Nama Tim Leader</th>
                                <th style="width:25%">Menu</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            foreach($leader_toko as $lt): ?>
                            <tr>
                              <td>
                                    <div class="user-block">
                                      <img class="img-circle" src="<?php echo base_url()?>assets/img/user.png?>" alt="User Image">
                                      <span class="username"><a href="#"><?=$lt->nama_user?></a></span>
                                      </div>
                              </td>
                              <td>
                              
                              </td>
                            </tr>
                            <?php endforeach ?>
                          </tbody>
                          <tfoot>
                          </tfoot>
                        </table>
                      </form>
                    </div>
                    <!-- spg -->
                    <div class="tab-pane fade" id="spg" role="tabpanel">
                      
                      <form class="form-horizontal" method="post">

                          <?= (count($spg) > 0) ? '' : '<span class="badge badge-danger"> SPG Belum dikaitkan</span>'; ?>
                            <table  class="table  table-striped" <?= (count($spg) > 0) ? '' : 'hidden'; ?>>
                              <thead>
                                <tr>
                                    <th style="width:60%">Nama SPG</th>
                                
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                foreach($spg as $lt): ?>
                                <tr>
                                  <td>
                                        <div class="user-block">
                                          <img class="img-circle" src="<?php echo base_url()?>assets/img/user.png?>" alt="User Image">
                                          <span class="username"><a href="#"><?=$lt->nama_user?></a></span>
                                          </div>
                                  </td>
                                
                                </tr>
                                <?php endforeach ?>
                              </tbody>
                              <tfoot>
                              </tfoot>
                            </table>
                        
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
                <button type="button" class="btn btn-success float-right btn_tambah <?= ($cek_status->status == 2) ? 'd-none' : '' ?>" data-id_toko="<?= $toko->id ?>" data-toggle="modal" data-target="#modal-tambah-produk"><i class="fa fa-plus"></i> Tambah Produk</button>
                <button type="button" class="btn btn-default btn-sm">Toko ini berlaku untuk harga : <?= status_het($toko->het) ?></button> 
                <div class="tab-content">
                  
                      <table id="table_stok" class="table table-bordered table-striped">
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
    <!-- Modal Tambah Produk -->
<div class="modal fade" id="modal-tambah-produk" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-supervisor">Tambah Artikel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <form action="<?=base_url('spv/toko/tambah_artikel')?>" role="form" method="post">
        <div class="form-group">
          <label>Nama Artikel</label>
          <select name="id_produk" class="form-control select2bs4" required>
            <option value="">-- Pilih Artikel --</option>
            <?php foreach ($list_produk as $pr) { ?>
            <option value="<?= $pr->id ?>"><?= $pr->kode." | ".$pr->nama_produk ?></option>
            <?php } ?>
          </select>
        </div>
  
        <div class="form-group">
            <label>Harga</label>
            <p>
            * Artikel ini berlaku untuk harga : <strong> <?= status_het($toko->het) ?></strong>
            </p>
            <input class="form-control" type="hidden" name="id_toko" value="<?=$toko->id?>">
        </div>
        <span class="badge badge-warning">Catatan :</span>
        <address>
          Penambahan artikel ini akan aktif setelah di approve dari manager marketing.
        </address>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Tambah Data</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end modal tambah produk -->

<!-- modal tim leader -->
<div class="modal fade" id="modal-leader" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-supervisor"> <i class="fas fa-check-circle"></i> Kaitkan Tim Leader di toko ini</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <form action="<?=base_url('spv/Toko/add_leader')?>" role="form" method="post">

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="nama" > <i class="fas fa-user"></i> Nama Tim Leader</label>
                <select class="form-control" name="leader" required>
                            <option value="">-- PIlih Tim Leader --</option>
                            <?php foreach ($list_leader as $rl) : ?>
                            <option value="<?= $rl->id ?>"><?= $rl->nama_user ?></option>
                            <?php endforeach; ?>
                </select>
                <input type="hidden" name="id_toko"  value="<?=$toko->id?>" readonly>
                      
              </div>
            </div>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end modal -->
<!-- modal foto berkas -->
<div class="modal fade" id="lihat-foto">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title judul"> <li class="fas fa-box"></li> Foto  : <a href="#" class="pic"></a></h4>
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
        order: [[3, 'Asc']],
          responsive: true,
          lengthChange: false,
          autoWidth: false,
      });
      
    
    })
  </script>

  
