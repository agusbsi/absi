<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-store"></i> Pilih Toko</h3>
            </div>
            <div class="card-body">
              <form action="<?= base_url('mng_mkt/group/group') ?>" method="get">
                  <small class="text-red">Silahkan Ketikkan Nama Grup</small>
                  <div class="form-group">
                    <select class="form-control select2bs4" style="width: 100%;" id="id_toko" name="id_grup" >
                      <option selected="selected" value="">Pilih Grup</option>
                      <?php foreach ($list_group as $l) { ?>
                      <option value="<?= $l->id ?>"><?= $l->nama_grup?></option>
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
          <?php if($grup != ""){ ?>
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-cog"></i> List Toko di : <?=$grup->nama_grup ?></h3>
              <div class="card-tools">
              <div class="float-right">
                <button type="button" class="btn btn-success btn-aset" data-toggle="modal" data-target="#Modal_Aset" data-id="<?= $grup->id ?>" data-nama="<?= $grup->nama_grup ?>"><i class="fas fa-plus"></i> Tambah Toko</button>
              </div>
              </div>
            </div>
              <div class="card-body">         
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Nama Toko</th>
                      <th>Alamat Toko</th>
                      <th>Telp</th>
                      <th>Tanggal SO</th>
                      <th>Menu</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list_group_toko as $row){ ?>
                    <tr>
                        <td><?=$row->nama_toko?></td>
                        <td><?=$row->alamat?></td>
                        <td><?=$row->telp?></td>
                        <td><?= format_tanggal1($row->tgl_so)?></td>
                        <td>
                          <a type="button" class="btn btn-danger btn-hapus"  href="<?=base_url('mng_mkt/group/hapustoko/'.$row->id)?>" title="Hapus Data"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>                     
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
              </div>
              <!-- end card body -->
              <?php } else {?>
                
                <div class="card-body text-center">
                <span class="text-center text-danger "> <i class="fas fa-store text-danger"></i> Data Toko Kosong, Pilih Grup terlebih dahulu !</span>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
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
                       <form action="<?= base_url('mng_mkt/group/tambah_toko') ?>" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                            <label>List Nama Toko</label>
                            <input class="form-control" type="hidden" name="id">
                            <input type="hidden" name="nama_toko">
                            <select class="form-control select2bs4" style="width: 100%;" id="id_aset" name="daftar_aset" >
                              <option selected="selected" value="">Pilih Toko</option>
                              <?php foreach ($toko as $l) { ?>
                              <option value="<?= $l->id ?>"><?= $l->nama_toko?></option>
                              <?php } ?>
                            </select>
                            <br>
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

<script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>

<script type="text/javascript">
  $('.btn-aset').click(function(){
    var id = $(this).data('id');
    var nama = $(this).data('nama');
    $('[name=id]').val(id);
    $('[name=nama_grup]').val(nama);
    $('.judul').text(nama);
  })
</script>


