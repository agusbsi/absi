<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-file-alt"></i> <?= $title ?></h3>
          </div>
            <div class="card-body">
              <h3>Data Aset Toko</h3>
              <form action="<?= base_url('adm_mv/aset/list_aset') ?>" method="get">
                <small class="text-red">Silahkan ketikkan nama toko</small>
                <div class="form-group">
                  <select class="form-control select2bs4" style="width: 100%;" id="id_toko" name="id_toko" >
                    <option selected="selected" value="">Pilih Toko</option>
                    <?php foreach ($list_toko as $l) { ?>
                    <option value="<?= $l->id ?>"><?= $l->nama_toko?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <input class="btn btn-success" type="submit" value="Tampilkan Data">
                </div>
              </form>
              <hr>
              <?php 
                $id_toko = $this->input->get('id_toko');
                $query = $this->db->query("SELECT tb_toko.nama_toko, tb_toko.alamat, tb_toko.telp, tb_toko.status, tb_aset.nama_aset, tb_aset.id, tb_aset_toko.qty, tb_aset_toko.kondisi, tb_aset_toko.keterangan FROM tb_aset_toko JOIN tb_toko ON tb_toko.id = tb_aset_toko.id_toko JOIN tb_aset ON tb_aset.id = tb_aset_toko.id_aset WHERE tb_aset_toko.id_toko = '$id_toko'")->result();
                  if ($query == null) { ?>
                <div class="<?= ($id_toko) ? '' : 'd-none' ?>">
                  <div class="card-body">
                    <table>
                      <tr>
                        <td><h4>Nama Group</h4></td>
                        <td><h4>&nbsp; : &nbsp;</h4></td>
                        <td><h4><?=$toko->nama_toko ?></h4></td>
                        <td><h4><?=$toko->deskripsi ?></h4></td>
                        <div class="float-right">
                          <button type="button" class="btn btn-primary btn-aset" data-toggle="modal" data-target="#Modal_toko" data-id="<?= $toko->id ?>"><i class="nav-icon fas fa-clinic-medical"></i> Tambah Aset</button>
                        </div>
                      </tr>
                    </table>
                  </div>
                </div>
                <?php }else if($query != null){ ?>
                  <div class="<?= ($list_aset_toko) ? '' : 'd-none' ?>">
                  <div class="card-body">
                    <table>
                      <tr>
                        <td><h4>Nama Aset</h4></td>
                        <td><h4>&nbsp; : &nbsp;</h4></td>
                        <td><h4><?=$toko->nama_toko ?></h4></td>
                        <td><h4><?=$toko->deskripsi ?></h4></td>
                        <div class="float-right">
                          <button type="button" class="btn btn-primary btn-aset" data-toggle="modal" data-target="#Modal_toko" data-id="<?= $toko->id ?>"><i class="nav-icon fas fa-clinic-medical"></i> Tambah Aset</button>
                        </div>
                      </tr>
                    </table>
                  </div>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th style="width: 35%">Nama Aset</th>
                      <th style="width: 35%">Kondisi</th>
                      <th style="width: 20%">Keterangan</th>
                      <th style="width: 20%">Qty</th>
                      <th>Menu</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list_aset_toko as $row){ ?>
                    <tr>
                      <td>
                        <input type="hidden" name="id_aset" value="<?= $row->id ?>">
                        <?= $row->nama_aset ?>
                      </td>
                      <td>
                        <?=$row->kondisi?>
                      </td>
                      <td>
                        <?=$row->keterangan?>
                      </td>
                      <td>
                        <?= $row->qty ?>
                      </td>
                      <td>
                        <a type="button" class="btn btn-danger btn-hapus"  href="<?=base_url('adm_mv/aset/hapus/'.$row->id)?>" title="Hapus Data"><i class="fa fa-trash" aria-hidden="true"></i></a>
                      </td>                      
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                  </div>
                <?php }else{ ?>
                  <div class="<?= ($list_aset_toko) ? '' : 'd-none' ?>"></div>
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
                          <form action="<?= base_url('adm_mv/aset/tambah_aset_toko') ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                              <label>List Nama Aset</label>
                              <input class="form-control" type="hidden" name="id_toko">
                              <select class="form-control select2bs4" required="" style="width: 100%;" id="id_aset" name="daftar_aset" >
                                <option selected="selected" value="">Pilih Aset</option>
                                <?php foreach ($aset as $l) { ?>
                                <option value="<?= $l->id ?>"><?= $l->nama_aset?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Kondisi</label>
                              <select class="form-control" required="" name="kondisi">
                                <option selected="selected" value="">-- Pilih Aset --</option>
                                <option value="Baik">Baik</option>
                                <option value="Kurang Baik">Kurang Baik</option>
                                <option value="Rusak">Rusak</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Keterangan</label>
                              <input class="form-control" type="text" name="keterangan" required="">
                            </div>
                            <div>
                              <label>Qty</label>
                              <input class="form-control" type="number" name="qty" required="">
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
                        <a type="button" class="btn btn-danger btn-hapus"  href="<?=base_url('adm_mv/group/hapus/'.$grup->id)?>" title="Hapus Data"  ><i class="fa fa-trash" aria-hidden="true"></i></a>
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
                        <form action="<?= base_url('adm_mv/group/tambah_grup') ?>" method="post" enctype="multipart/form-data">
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
                        <form action="<?= base_url('adm_mv/group/edit_grup') ?>" method="post" enctype="multipart/form-data">
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
    $('[name=id_toko]').val(id);
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
