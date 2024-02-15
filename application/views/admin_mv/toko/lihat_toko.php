<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-info card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
              <?php if($detail->foto_toko=="") { 
                ?>
                <img style="width: 100%;" class="profile-user-img img-responsive img-rounded" src="<?php echo base_url()?>assets/img/toko/hicoop.png" alt="User profile picture">
                <?php
                }else{ ?>
                <img style="width: 100%;" class="profile-user-img img-responsive img-rounded" src="<?php echo base_url('assets/img/toko/'.$detail->foto_toko)?>" alt="User profile picture">
              <?php } ?> 
                </div>

                <h3 class="profile-username text-center"><strong><?=$detail->nama_toko?></strong></h3>

                <!-- <p class="text-muted text-center">[ ID : <?=$detail->id?> ]</p> -->

                <div class="card-body">
                  <strong>Jenis Toko :</strong>
                  <p class="text-muted"><?=jenis_toko($detail->jenis_toko)?></p>
                  <hr>
                  <strong><i class="fa fa-map"></i> Alamat</strong>
                  <p class="text-muted"><?=$detail->alamat?></p>
                  <hr>
                  <strong><i class="fa fa-phone"></i> Telp</strong>
                  <p class="text-muted"><?=$detail->telp?></p>
                  <hr>
                 
                  
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
                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#supervisor" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Supervisor</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#team_leader" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Team Leader</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#spg" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">SPG</a>
                  </li>
               
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                  <div class="tab-pane fade show active" id="supervisor" role="tabpanel" >
                    <form class="form-horizontal"  method="post">
                 
                      <table  class="table table-bordered table-striped">
                        <thead>
                          <tr>
                              
                              <th style="width:60%">Nama Supervisor</th>
                              
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                              <?php if(is_array($spv_toko)){ ?>
                              
                              <?php foreach($spv_toko as $dd): ?>
                                
                                <td> 
                                  <div class="user-block">
                                    <img class="img-circle" src="<?php echo base_url()?>assets/img/user.png?>" alt="User Image">
                                    <span class="username"><a href="#"><?=$dd->nama_user?></a></span>
                                    <span class="description">Telp :<?=$dd->no_telp?></span>
                                  </div>
                                </td>
                               
                          </tr>
                        
                          <?php endforeach;?>
                          <?php }else { ?>
                                <td align="center"><strong>Data Kosong</strong></td>
                          <?php } ?>
                        </tbody>
                       
                      </table>
                    </form>
                  </div>
                  <div class="tab-pane fade" id="team_leader" role="tabpanel">
                    <form class="form-horizontal" method="post">
                    <?php if(count($leader_toko) > 0){ ?>
                      <table  class="table table-bordered table-striped">
                        <thead>
                          <tr>
                          
                              <th style="width:60%">Nama Tim Leader</th>
                              
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                              
                              <?php foreach($leader_toko as $l): ?>
                                <td> 
                                  <div class="user-block">
                                  <img class="img-circle" src="<?php echo base_url()?>assets/img/user.png?>" alt="User Image">
                                  <span class="username"><a href="#"><?=$l->nama_user?></a></span>
                                  <span class="description">Telp :<?=$l->no_telp?></span>
                                  </div>
                                </td>
                               
                          </tr>
                      
                          <?php endforeach;?>
                         
                        </tbody>
                       
                      </table>
                      <?php }else { ?>
                                <span class="badge badge-danger"> Tim leader belum dikaitkan !</span>
                          <?php } ?>
                    </form>
                  </div>
                  <div class="tab-pane fade" id="spg" role="tabpanel" >
                    <form class="form-horizontal" method="post">
                    <?php if(count($spg_toko) > 0){ ?>
                      <table  class="table table-bordered table-striped">
                        <thead>
                          <tr>
                          
                              <th style="width:60%">Nama SPG</th>
                              
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                              
                              <?php foreach($spg_toko as $l): ?>
                                <td> 
                                  <div class="user-block">
                                  <img class="img-circle" src="<?php echo base_url()?>assets/img/user.png?>" alt="User Image">
                                  <span class="username"><a href="#"><?=$l->nama_user?></a></span>
                                  <span class="description">Telp :<?=$l->no_telp?></span>
                                  </div>
                                </td>
                               
                          </tr>
                      
                          <?php endforeach;?>
                         
                        </tbody>
                       
                      </table>
                      <?php }else { ?>
                                <span class="badge badge-danger"> SPG belum dikaitkan !</span>
                          <?php } ?>
                    </form>
                  </div>

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
                      if ($cek_status->status == 2){ ?>
                      <div class="overlay-wrapper">
                          <div class="overlay">
                            <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                            <div class="text-bold pt-2">Menunggu Approve ...</div>
                          </div>
                      </div>
                  <?php } ?>
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
                              <td  colspan="6" class="text-center"> <strong>Total Stok :</strong> <b><?php
                                if($cek_status_stok > 0){
                                  echo "<span class='badge badge-warning' >belum di approve </span>";
                                }else{
                                  echo $total;
                                }
                                ?></b></td>
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

<!-- Modal -->
<!-- Modal Untuk upload Foto Toko -->
<div class="modal fade" id="Modal_Katalog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title judul"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="<?= base_url('sup/toko/upload_foto') ?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label>Foto Toko</label>
            <input class="form-control" type="hidden" name="id">
            <input class="form-control " type="file" name="foto_artikel">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <!-- <button type="button" class="btn btn-primary" name="simpan">simpan</button> -->
          <input class="btn btn-primary" type="submit" name="submit" value="Simpan">
        </div>
       </form>
    </div>
  </div> 
</div>
<!-- End Modal Upload Foto -->
<!-- modal untuk supervisor -->
<div class="modal fade" id="modal-supervisor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-supervisor"> <li class="fas fa-user-plus"></li> Tambah Data Supervisor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <form action="<?=base_url('adm/toko/add_spv')?>" role="form" method="post">

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="nama" >Nama Supervisor</label>
                <select class="form-control" name="spv" required>
                            <option value="">-- PIlih Supervisor --</option>
                            <?php foreach ($list_spv as $rl) : ?>
                            <option value="<?= $rl->id ?>"><?= $rl->username ?></option>
                            <?php endforeach; ?>
                </select>
                <input type="hidden" name="id_toko"  value="<?=$d->id?>" readonly required>
                      
              </div>
            </div>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success"> <li class="fas fa-save"></li> Tambah Data</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end modal -->

<!-- modal tim leader -->
<div class="modal fade" id="modal-leader" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-supervisor">Tambah Data Tim Leader</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <form action="<?=base_url('adm/toko/add_leader')?>" role="form" method="post">

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="nama" >Nama Tim Leader</label>
                <select class="form-control" name="leader" required>
                            <option value="">-- PIlih Tim Leader --</option>
                            <?php foreach ($list_leader as $rl) : ?>
                            <option value="<?= $rl->id ?>"><?= $rl->username ?></option>
                            <?php endforeach; ?>
                </select>
                <input type="hidden" name="id_toko"  value="<?=$d->id?>" readonly required>
                      
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

<!-- Modal SPG -->
<div class="modal fade" id="modal-spg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-supervisor">Tambah Data SPG</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <form action="<?=base_url('adm/toko/add_spg')?>" role="form" method="post">

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="nama" >Nama SPG</label>
                <select class="form-control" name="spg" required>
                            <option value="">-- PIlih SPG --</option>
                            <?php foreach ($list_spg as $rl) : ?>
                            <option value="<?= $rl->id ?>"><?= $rl->username ?></option>
                            <?php endforeach; ?>
                </select>
                <input type="hidden" name="id_toko"  value="<?=$detail->id?>" readonly required>
                      
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

<script type="text/javascript">
  $('.btn-upload').click(function(){
    var id = $(this).data('id');
    var kode = $(this).data('kode');
    $('[name=id]').val(id);
    $('[name=kode]').val(kode);
    $('.judul').text(kode);
  })
</script>
