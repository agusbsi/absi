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
                  <strong><i class="fa fa-map"></i> Alamat</strong>
                  <p class="text-muted"><?=$toko->alamat?></p>
                  <hr>
                  <strong><i class="fa fa-phone"></i> Telp</strong>
                  <p class="text-muted"><?=$toko->telp?></p>
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
                    <a class="nav-link active" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#spg" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">SPG</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-profile-tab">
                  <!-- spg -->
                  <div class="tab-pane fade show active" id="spg" role="tabpanel">
                    
                    <form class="form-horizontal" method="post">
                    <div class="form-group">
                            <div class="text-right">
                             
                              <button type="button" class="btn btn-success <?= (count($spg) > 0) ? 'd-none' : ''; ?>" data-toggle="modal"  data-target="#modal-spg" ><li class="fas fa-plus-circle"></li>
                                Tambah SPG
                              </button>
                            </div> 
                      </div>
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
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-box"></li> Data Stok Artikel</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                <?php 
                      if ($cek_status->status == 2){ ?>
                      <div class="overlay-wrapper">
                          <div class="overlay">
                            <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                            <div class="text-bold pt-2">Menunggu Approve ...</div>
                          </div>
                      </div>
                  <?php } ?>
                  <button type="button" class="btn btn-default btn-sm">Toko ini berlaku untuk harga : <?= status_het($toko->het) ?></button>
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
                            <td colspan="6"></td>
                          </tr>
                        <tr>
                          <td  colspan="6" class="text-center"> <strong>Total :</strong> <b><?= $total ; ?></b></td>
                        
                   
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


<!-- modal tim leader -->
<div class="modal fade" id="modal-spg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-supervisor"><i class="fas fa-check-circle"></i> Kaitkan SPG di toko ini</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <form action="<?=base_url('leader/Toko/add_spg')?>" role="form" method="post">

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="nama" ><i class="fas fa-user"></i> Nama SPG</label>
                <select class="form-control" name="spg" required>
                            <option value="">-- PIlih SPG --</option>
                            <?php foreach ($list_spg as $rl) : ?>
                            <option value="<?= $rl->id ?>"><?= $rl->nama_user ?></option>
                            <?php endforeach; ?>
                </select>
                <input type="hidden" name="id_toko"  value="<?=$toko->id?>" readonly required>
                      
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

  <script>
    // aksi edit produk
      $('.btn_update').click(function(){
        var id = $(this).data("id");
        var produk = $(this).data("produk");
        var kode = $(this).data("kode");
        var qty = $(this).data("qty");

        $("#id_produk").val(id);
        $("#produk").val(produk);
        $("#kode").val(kode);
        $("#qty_sebelum").val(qty);
      })



  </script>

