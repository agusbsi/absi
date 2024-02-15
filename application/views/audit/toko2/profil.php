<!-- Main content -->
<section class="content">
      <div class="container-fluid">
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
    <!-- tambah user -->
     <!-- modal tambah data -->
     <div class="modal fade" id="modal-tambah">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"> <li class="fas fa-users"></li> Form Tambah Team Leader</h4>
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
                    <!-- isi konten -->
                    <form method="POST" action="<?= base_url('spv/Toko/proses_tambah')?>">
                      <div class="form-group">
                        <label for="user" >Username</label>
                        <input type="text" name="username" class="form-control" id="user" placeholder="Username" required="">
                      </div>
                      <div class="form-group">
                        <label for="pass" >Password</label>
                        <input type="password" name="pass" class="form-control" id="pass" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                        <label for="konfirm" >Konfirmasi Password</label>
                        <input type="password" name="konfirm" class="form-control" id="konfirm" placeholder="Konfirmasi Password" required>
                      </div>
                      <div class="form-group">
                        <label for="nama_user" >Nama User</label>
                        <input type="text" name="nama_user" class="form-control" id="nama_user" placeholder="Nama User" required>
                      </div>
                      <div class="form-group">
                        <label for="no_telp" >No. Telp</label>
                        <input type="text" name="no_telp" class="form-control" id="no_telp" placeholder="No. Telp" required>
                      </div>
                      <div class="form-group">
                        <label for="no_telp" >Role</label>
                        <input type="text" class="form-control"  value="Team Leader"  readonly>
                        <input type="hidden" name="id_toko" class="form-control"  value="<?=$toko->id?>"  readonly>
                      </div>
                  
                    <!-- end konten -->
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button
                      type="button"
                      class="btn btn-danger"
                      data-dismiss="modal"
                    >
                    <li class="fas fa-times-circle"></li> Cancel
                    </button>
                    <button type="submit" class="btn btn-success">
                    <li class="fas fa-save"></li> Simpan
                    </button>
                  </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    <!-- end user -->


<!-- modal tim leader -->
<div class="modal fade" id="modal-leader" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-supervisor">Kaitkan Tim Leader di toko ini</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <form action="<?=base_url('spv/Toko/add_leader')?>" role="form" method="post">

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="nama" >Nama Tim Leader</label>
                <select class="form-control" name="leader" required>
                            <option value="">-- PIlih Tim Leader --</option>
                            <?php foreach ($list_leader as $rl) : ?>
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
        <button type="submit" class="btn btn-primary">Tambah Data</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end modal -->


<!-- Modal Tambah Produk -->
<div class="modal fade" id="modal-tambah-produk" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-supervisor">Tambah Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <form action="<?=base_url('adm/toko/tambah_produk')?>" role="form" method="post">
        <div class="form-group">
          <label>Nama Produk</label>
          <select name="id_produk" class="form-control select2bs4">
            <option value="">-- Pilih Produk --</option>
            <?php foreach ($list_produk as $pr) { ?>
            <option value="<?= $pr->id ?>"><?= $pr->kode." | ".$pr->nama_produk ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
            <label>Qty Awal</label>
            <input class="form-control" type="number" name="qty" required>
            <input class="form-control" type="hidden" name="id_toko" value="<?= $detail->id ?>" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Tambah Data</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end modal tambah produk -->

<!-- Modal Edit Produk -->
<div class="modal fade" id="modal-produk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-supervisor">Ubah Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <form action="<?=base_url('adm/toko/edit_stok')?>" role="form" method="post">
        <div class="form-group">
          <label>Kode</label>
          <input id="kode" class="form-control" type="text" name="kode" required readonly>
        </div>
        <div class="form-group">
          <label>Nama Produk</label>
          <input id="produk" class="form-control" type="text" name="produk" required readonly>
          <input id="id_produk" class="form-control" type="hidden" name="id_produk" required>
          <input id="id_toko" value="<?= $detail->id ?>" class="form-control" type="hidden" name="id_toko" required>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-6">
              <label>Qty Sebelum</label>
              <input id="qty_sebelum" class="form-control" type="text" name="qty_sebelum" required readonly>
            </div>
            <div class="col-6">
              <label>Qty Ubah</label>
              <input class="form-control" type="number" name="qty_sesudah" required>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Tambah Data</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end modal edit produk -->


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

