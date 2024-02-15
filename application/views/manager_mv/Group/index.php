<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-info card-tabs">
          <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
              <li class="pt-2 px-3">
                <h3 class="card-title"><i class="far fa-object-group"></i> <?= $title ?></h3>
              </li>
              <div id="select"></div>
              <li class="nav-item">
                <a href="#kelola_grup" class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Kelola Grup</a>
              </li>
              <li class="nav-item">
                <a href="#tambah_grup" class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Tambah Grup</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="custom-tabs-two-tabContent">
              <!-- Tab Panel Kelola Grup -->
              <div class="tab-pane fade show active" id="kelola_grup" role="tabpanel">
                <form action="<?= base_url('sup/group') ?>" method="get" class="form-horizontal">
                  <small class="text-red">Silahkan ketikkan nama grup</small>
                  <div class="form-group">
                    <select class="form-control select2bs4" style="width: 100%;" id="id_grup" name="id_grup" >
                      <option selected="selected" value="">Pilih Grup</option>
                      <?php foreach ($list_group as $l) { ?>
                      <option value="<?= $l->id ?>"><?= $l->nama_grup?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <input class="btn btn-success" type="submit" value="Tampilkan Data">
                  </div>
                </form>
                <hr>
                <?php
                  $id_grup = $this->input->get('id_grup'); 
                  $query = $this->db->query("SELECT tb_info.id, tb_info.id_grup, tb_info.id_toko, tb_grup.nama_grup, tb_toko.nama_toko,tb_toko.alamat,tb_toko.telp FROM tb_info JOIN tb_grup ON tb_grup.id = tb_info.id_grup JOIN tb_toko ON tb_toko.id = tb_info.id_toko WHERE tb_info.id_grup = '$id_grup'")->result();
                  if ($query == null) { ?>
                <div class="<?= ($id_grup) ? '' : 'd-none' ?>">
                  <div class="card-body">
                    <table>
                      <tr>
                        <td><h4>Nama Group</h4></td>
                        <td><h4>&nbsp; : &nbsp;</h4></td>
                        <td><h4><?=$grup->nama_grup ?></h4></td>
                        <td><h4><?=$grup->deskripsi ?></h4></td>
                        <div class="float-right">
                          <button type="button" class="btn btn-primary btn-aset" data-toggle="modal" data-target="#Modal_toko" data-id="<?= $grup->id ?>"><i class="nav-icon fas fa-clinic-medical"></i> Tambah Toko</button>
                        </div>
                      </tr>
                    </table>
                  </div>
                </div>
                <?php }else if($query != null){ ?>
                  <div class="<?= ($list_group_toko) ? '' : 'd-none' ?>">
                  <div class="card-body">
                    <table>
                      <tr>
                        <td><h4>Nama Group</h4></td>
                        <td><h4>&nbsp; : &nbsp;</h4></td>
                        <td><h4><?=$grup->nama_grup ?></h4></td>
                        <td><h4><?=$grup->deskripsi ?></h4></td>
                        <div class="float-right">
                          <button type="button" class="btn btn-primary btn-aset" data-toggle="modal" data-target="#Modal_toko" data-id="<?= $grup->id ?>"><i class="nav-icon fas fa-clinic-medical"></i> Tambah Toko</button>
                        </div>
                      </tr>
                    </table>
                  </div>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th style="width: 35%">Nama Toko</th>
                      <th style="width: 35%">Alamat</th>
                      <th style="width: 20%">Telp</th>
                      <th>Menu</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list_group_toko as $row){ ?>
                    <tr>
                      <td>
                        <input type="hidden" name="id_grup" value="<?= $row->id_grup ?>">
                        <?= $row->nama_toko ?>
                      </td>
                      <td>
                        <?=$row->alamat?>
                      </td>
                      <td>
                        <?=$row->telp?>
                      </td>
                      <td>
                        <a type="button" class="btn btn-danger btn-hapus"  href="<?=base_url('sup/group/hapus/'.$row->id)?>" title="Hapus Data"><i class="fa fa-trash" aria-hidden="true"></i></a>
                      </td>                      
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                  </div>
                <?php }else{ ?>
                  <div class="<?= ($list_group_toko) ? '' : 'd-none' ?>"></div>
                <?php } ?>  
                  <!-- Modal Tambah  Aset Toko-->
                  <div class="modal fade" id="Modal_toko"  aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title judul"></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="<?= base_url('sup/group/tambah_toko') ?>" method="post" enctype="multipart/form-data">
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
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <input class="btn btn-primary" type="submit" name="submit" value="Simpan">
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <!-- End Tab Panel Kelola Grup -->

              <!-- Tab Panel Tambah Grup -->
              <div class="tab-pane fade" id="tambah_grup" role="tabpanel">
                <div class="row">
                  <div class="col-md-4"></div>
                  <div class="col-md-4"></div>
                  <div class="col-md-4 text-right">
                    <button type="button" class="btn btn-success btn-aset" data-toggle="modal" data-target="#modal-grup"><i class="fas fa-plus"></i> Tambah Grup</button>
                  </div>
                </div>
                <hr>
                <table id="example1" class="table table-bordered table-striped col-md-8 mx-auto">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Grup</th>
                      <th>Deskripsi</th>
                      <th>Menu</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php if (is_array($list_group)) { ?>
                      <?php $no = 1; ?>
                      <?php foreach ($list_group as $grup) : ?>
                        <td><?= $no ?></td>
                        <td><?= $grup->nama_grup ?></td>
                        <td><?= $grup->deskripsi ?></td>
                        <td>
                          <a href="#" class="btn btn-warning btn-edit-grup" data-toggle="modal" data-target="#Modal_Edit_Grup" data-id="<?= $grup->id;?>" data-nama_grup="<?= $grup->nama_grup;?>" data-deskripsi="<?= $grup->deskripsi; ?>" >
                        <i class="fas fa-edit"></i></a>
                        - 
                        <a type="button" class="btn btn-danger btn-hapus"  href="<?=base_url('sup/group/hapus/'.$grup->id)?>" title="Hapus Data"  ><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                      <?php $no++; ?>
                      <?php endforeach; ?>
                      <?php }else{ ?>
                        <td colspan="4" align="center"><strong>Data Kosong</strong></td>
                      <?php } ?>
                  </tbody>
                </table>
                <div class="modal fade" id="modal-grup" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title judul"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="<?= base_url('sup/group/tambah_grup') ?>" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                            <label>Nama Grup</label>
                            <input class="form-control" type="text" name="nama_grup">
                            <br>
                            <label>Deskripsi</label>
                            <input type="text" name="deskripsi" class="form-control">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input class="btn btn-primary" type="submit" name="submit" value="Simpan">
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal fade" id="Modal_Edit_Grup" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title judul"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="<?= base_url('sup/group/edit_grup') ?>" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                            <input type="hidden" name="id" class="form-control">
                            <label>Nama Grup</label>
                            <input class="form-control" type="text" name="nama_grup">
                            <br>
                            <label>Deskripsi</label>
                            <input type="text" name="deskripsi" class="form-control">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input class="btn btn-primary" type="submit" name="submit" value="Simpan">
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Tab Panel Tambah Grup -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

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
  $('.btn-edit-grup').click(function(){
    var id = $(this).data('id');
    var nama_grup = $(this).data('nama_grup');
    var deskripsi = $(this).data('deskripsi');
    $('[name=id]').val(id);
    $('[name=nama_grup').val(nama_grup);
    $('[name=deskripsi').val(deskripsi);
    $('.judul').text(nama_grup);
  })
</script>
