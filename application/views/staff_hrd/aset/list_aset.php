<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-store"></i> Pilih Toko</h3>
            </div>
            <div class="card-body">
              <form action="<?= base_url('hrd/aset/list_aset') ?>" method="get">
                  <small class="text-red">Silahkan ketikkan nama toko</small>
                  <div class="form-group">
                    <select class="form-control select2bs4" style="width: 100%;" id="id_toko" name="id_toko" >
                      <option selected="selected" value="">Pilih Toko</option>
                      <?php foreach ($list_toko as $l) { ?>
                      <option value="<?= $l->id ?>"><?= $l->nama_toko?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group text-center">
                    <input class="btn btn-info" type="submit" value="Tampilkan Data">
                  </div>
                </form>
            </div>
        </div>
      </div>
      <div class="col-md-9">
        <div class="card card-info card-outline">
          <?php if($toko != ""){ ?>
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-cog"></i> List Aset di : <?=$toko->nama_toko ?></h3>
              <div class="card-tools">
              <div class="float-right">
                <button type="button" class="btn btn-success btn-aset" data-toggle="modal" data-target="#Modal_Aset" data-id="<?= $toko->id ?>" data-nama="<?= $toko->nama_toko ?>"><i class="fas fa-plus"></i> Tambah Aset Toko</button>
              </div>
              </div>
            </div>
              <div class="card-body">         
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>ID Aset</th>
                      <th>Nama Aset</th>
                      <th>Qty</th>
                      <th>Keterangan</th>
                      <th>Menu</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list_aset_toko as $row){ ?>
                    <tr>
                        <td><?= $row->id_asset ?></td>
                        <td><?=$row->nama_aset?></td>
                        <td><?=$row->qty?></td>
                        <td><?=$row->keterangan?></td>
                        <td><button type="button" class="btn btn-warning btn-edit-aset" data-toggle="modal" data-target="#Modal_Edit_Aset" data-id="<?= $row->id ?>" data-id_toko ="<?= $toko->id ?>" data-id_aset="<?= $row->id_asset ?>" data-nama_aset="<?= $row->nama_aset ?>" data-nama="<?= $toko->nama_toko ?>" data-qty="<?=$row->qty ?>"><i class="fas fa-edit"></i></button></td>                      
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
              </div>
              <!-- end card body -->
              <?php } else {?>
                
                <div class="card-body text-center">
                <span class="text-center text-danger "> <i class="fas fa-store text-danger"></i> Data Toko Kosong, Pilih Toko terlebih dahulu !</span>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row">
          
        </div>
      </div>
</section>
                <!-- Modal Tambah  Aset Toko-->
                <div class="modal fade" id="Modal_Aset"  aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title judul"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       <form action="<?= base_url('hrd/aset/tambah_aset_toko') ?>" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                            <label>List Nama Aset</label>
                            <input class="form-control" type="hidden" name="id">
                            <input type="hidden" name="nama_toko">
                            <select class="form-control select2bs4" style="width: 100%;" id="id_aset" name="daftar_aset" >
                              <option selected="selected" value="">Pilih Aset</option>
                              <?php foreach ($aset as $l) { ?>
                              <option value="<?= $l->id ?>"><?= $l->nama_aset?></option>
                              <?php } ?>
                            </select>
                            <br>
                            <input type="number" name="qty" class="form-control" placeholder="Masukkan Qty" autocomplete="off"><br>
                            <input type="text" name="keterangan" class="form-control" placeholder="Catatan" autocomplete="off">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button class="btn btn-success" type="submit" name="submit" > <i class="fas fa-save"></i> Simpan </button>
                        </div>
                       </form>
                    </div>
                  </div> 
                </div>
                <!-- End Modal Tambah-->

                <!-- Modal Edit Aset -->
                <div class="modal fade" id="Modal_Edit_Aset"  aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title judul"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       <form action="<?= base_url('hrd/aset/edit_aset_toko') ?>" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                            <label>List Nama Aset</label>
                            <input type="hidden" name="id">
                            <input type="hidden" name="nama_toko">
                            <input type="hidden" name="updated" class="form-control"  readonly="readonly" value="<?php echo date('Y-m-d H:i:s'); ?>">
                            <input type="hidden" name="id_toko" class="form-control">
                            <input type="text" name="id_aset" readonly="" class="form-control">
                            <br>
                            <input type="text" name="nama_aset" readonly="" class="form-control">
                            <br>
                            <label>QTY</label>
                            <input type="number" name="qty" class="form-control" placeholder="Masukkan Qty"> 
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button class="btn btn-success" type="submit" name="submit" > <i class="fas fa-save"></i> Simpan </button>
                        </div>
                       </form>
                    </div>
                  </div> 
                </div>
                <!-- End Edit Modal -->
<script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>

<script type="text/javascript">
  $('.btn-aset').click(function(){
    var id = $(this).data('id');
    var nama = $(this).data('nama');
    $('[name=id]').val(id);
    $('[name=nama_toko]').val(nama);
    $('.judul').text(nama);
  })
</script>

<script type="text/javascript">
  $('.btn-edit-aset').click(function(){
    var id = $(this).data('id');
    var id_toko = $(this).data('id_toko');
    var id_aset = $(this).data('id_aset');
    var nama = $(this).data('nama');
    var nama_aset = $(this).data('nama_aset');
    var qty = $(this).data('qty');
    $('[name=id]').val(id);
    $('[name=id_toko]').val(id_toko);
    $('[name=id_aset]').val(id_aset);
    $('[name=nama_toko').val(nama);
    $('[name=nama_aset').val(nama_aset);
    $('[name=qty').val(qty);
    $('.judul').text(nama);
  })
</script>
