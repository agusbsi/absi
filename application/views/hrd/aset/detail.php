<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">
              <li class="fas fa-hospital"></li> Data Detail
            </h3>
            <div class="card-tools">
              <a href="<?= base_url('hrd/Aset/list_aset') ?>" type="button" class="btn btn-tool">
                <i class="fas fa-times"></i>
              </a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-3">
                <div class="callout callout-danger text-center">
                  <img src="<?= $toko ? base_url('assets/img/toko/' . $toko->foto_toko) : base_url('assets/img/toko/hicoop.png') ?>" class="img img-rounded " style="width: 70%;" alt="foto toko">
                  <br>
                  <strong><?= $toko ? $toko->nama_toko : 'Data toko tidak ditemukan.' ?></strong>
                </div>
              </div>
              <div class="col-md-9">
                <div class="card card-primary card-outline card-outline-tabs">
                  <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Alamat</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">SPV</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">TEAM LEADER</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">SPG</a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                      <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                        <address><?= $toko->alamat ?></address>
                      </div>
                      <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                        <?= $toko->spv ?>
                      </div>
                      <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                        <?= $toko->leader ?>
                      </div>
                      <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                        <?= $toko->spg ?>
                      </div>
                    </div>
                  </div>
                  <!-- /.card -->
                </div>
              </div>
            </div>
            <!-- data toko -->
            <hr>
            <div class="card-default">
              <div class="card-header">
                <h3 class="card-title">
                  <li class="fas fa-store"></li> List Toko aset dari GA
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i>
                    Tambah Aset di toko
                  </button>
                </div>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-striped table-responsive">
                  <thead>
                    <tr class="text-center">
                      <th style="width: 2%">No</th>
                      <th>ID</th>
                      <th>No Aset</th>
                      <th>Nama Aset</th>
                      <th>Keterangan</th>
                      <th>Jumlah</th>
                      <th>Menu</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 0;
                    $total = 0;
                    foreach ($list as $l) :
                      $no++;
                    ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= $l->id_aset ?></td>
                        <td><?= $l->no_aset ?></td>
                        <td><?= $l->nama_aset ?></td>
                        <td><?= $l->keterangan ?></td>
                        <td class="text-center"><?= $l->qty ?></td>
                        <td class="text-center">
                          <button onclick="getUpdate('<?php echo $l->id; ?>')" data-toggle="modal" data-target="#modalUpdate" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                          <a href="<?= base_url('hrd/Aset/hapus_asetToko/' . $l->id) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                        </td>
                      </tr>
                    <?php
                      $total += $l->qty;
                    endforeach ?>
                    <tr>
                      <td colspan="5" class="text-right">Total :</td>
                      <td class="text-center"><?= $total ?></td>
                      <td></td>
                    </tr>
                  </tbody>

                </table>
              </div>
            </div>
            <hr>
            <div class="card-default">
              <div class="card-header">
                <h3 class="card-title">
                  <li class="fas fa-store"></li> List Toko aset dari SO SPG
                </h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-striped table-responsive">
                  <thead>
                    <tr class="text-center">
                      <th style="width: 2%">No</th>
                      <th>ID</th>
                      <th>No Aset</th>
                      <th>Nama Aset</th>
                      <th>Keterangan</th>
                      <th>jumlah</th>
                      <th>Menu</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 0;
                    $total = 0;
                    foreach ($aset_spg as $l) :
                      $no++;
                    ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= $l->id_aset ?></td>
                        <td><?= $l->no_aset ?></td>
                        <td><?= $l->nama_aset ?></td>
                        <td><?= $l->keterangan ?></td>
                        <td class="text-center"><?= $l->qty_updated ?></td>
                        <td>
                          <a href="<?= base_url('hrd/Aset/hapus_asetToko/' . $l->id) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                          <button class="btn btn-primary btn-sm" onclick="getDetail('<?php echo $l->foto_aset; ?>')" data-toggle="modal" data-target="#modalFoto"><i class="fa fa-eye"></i></button>
                        </td>
                      </tr>
                    <?php
                      $total += $l->qty_updated;
                    endforeach ?>
                    <tr>
                      <td colspan="5" class="text-right">Total :</td>
                      <td class="text-center"><?= $total ?></td>
                      <td></td>
                    </tr>
                  </tbody>

                </table>
              </div>
            </div>


          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- modal tambah data -->
<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h4 class="modal-title">
          <li class="fas fa-plus-circle"></li> Form Tambah Aset di toko <?= $toko->nama_toko ?>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- isi konten -->
        <form method="POST" action="<?= base_url('hrd/Aset/tambah_aset_toko') ?>" role="form" method="post" enctype="multipart/form-data">
          <div class="form-group mb-1">
            <label for="nik">List aset
            </label>
            <select name="id_aset" class="form-control form-control-sm select2" required>
              <option value="">- Pilih aset -</option>
              <?php
              foreach ($aset as $s) : ?>
                <option value="<?= $s->id ?>"><?= $s->nama_aset ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group mb-1">
            <label for="nama"> No Aset
            </label> </br>
            <input type="text" name="no_aset" class="form-control form-control-sm" placeholder=".....">
          </div>
          <div class="form-group mb-1">
            <label for="nama"> Jumlah
            </label> </br>
            <input type="number" name="qty" class="form-control form-control-sm" placeholder="....." required>
            <input type="hidden" name="id_toko" class="form-control form-control-sm" readonly="" value="<?= $toko->id ?>">
          </div>
          <div class="form-group mb-1">
            <label for="foto"> Foto Aset
            </label> </br>
            <input type="file" name="foto" class="form-control form-control-sm" id="foto" placeholder="Foto Toko" accept="image/png, image/jpeg, image/jpg, image/gif" required="">
          </div>
          <div class="form-group mb-1">
            <label for="nama"> Keterangan
            </label> </br>
            <textarea name="keterangan" class="form-control form-control-sm" rows="2"></textarea>
          </div>

      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
          <li class="fas fa-times-circle"></li> Cancel
        </button>
        <button type="submit" class="btn btn-success btn-sm">
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
<div class="modal fade" id="modalUpdate">
  <div class="modal-dialog modal-lg">
    <form method="POST" action="<?= base_url('hrd/Aset/update_asetToko') ?>" method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h4 class="modal-title">
            Update Aset di Toko
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-4">
              <div class="position-relative">
                <img src="" alt="Photo 1" class="img-fluid">
                <div class="ribbon-wrapper ribbon-lg">
                  <div class="ribbon bg-success text-lg">
                    Aset
                  </div>
                </div>
              </div>
              <div class="form-group mb-1">
                <label for="foto"> Ganti Foto
                </label> </br>
                <input type="file" name="foto" class="form-control form-control-sm" id="foto_edit" accept="image/png, image/jpeg, image/jpg, image/gif">
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group mb-1">
                <label for="nik">ID
                </label>
                <input type="text" name="id" class="form-control form-control-sm" id="id_edit" readonly>
                <input type="hidden" name="id_asetToko" class="form-control form-control-sm" id="id_asetToko" readonly>
              </div>
              <div class="form-group mb-1">
                <label for="nama"> Nama Aset
                </label> </br>
                <input type="text" name="nama" class="form-control form-control-sm" id="nama_edit" readonly>
              </div>
              <div class="form-group mb-1">
                <label for="nama"> No Aset
                </label> </br>
                <input type="text" name="no_aset" class="form-control form-control-sm" id="no_aset_edit">
              </div>
              <div class="form-group mb-1">
                <label for="nama"> Jumlah
                </label> </br>
                <input type="number" name="qty" class="form-control form-control-sm" id="qty_edit">
              </div>
              <div class="form-group mb-1">
                <label for="nama"> Keterangan
                </label> </br>
                <textarea name="keterangan" class="form-control form-control-sm" rows="2" id="keterangan_edit"></textarea>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer ">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
            <li class="fas fa-times-circle"></li> close
          </button>
          <button type="submit" class="btn btn-primary btn-sm">
            <li class="fas fa-save"></li> Simpan
          </button>
        </div>
      </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- modal foto -->
<div class="modal fade" id="modalFoto">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h4 class="modal-title">
          Foto Aset
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="position-relative">
          <img src="" alt="Photo 1" class="img-fluid">
          <div class="ribbon-wrapper ribbon-lg">
            <div class="ribbon bg-success text-lg">
              Aset
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
          <li class="fas fa-times-circle"></li> close
        </button>
      </div>
    </div>
  </div>
</div>
<script>
  function getDetail(aset) {
    var fotoAset = aset ? "<?php echo base_url('assets/img/aset/toko/'); ?>" + aset : "<?php echo base_url('assets/img/default.png'); ?>";
    var imgElement = $("#modalFoto img");
    imgElement.attr("src", fotoAset);
  }

  function getUpdate(aset) {
    $.ajax({
      url: "<?php echo base_url('hrd/Aset/get_asetToko'); ?>",
      method: "POST",
      data: {
        aset: aset
      },
      dataType: "json", // Ubah ke dataType "json" jika data yang diambil dari server adalah JSON
      success: function(data) {
        var fotoAset = data.foto_aset ? "<?php echo base_url('assets/img/aset/toko/'); ?>" + data.foto_aset : "<?php echo base_url('assets/img/default.png'); ?>";
        var imgElement = $("#modalUpdate img");
        imgElement.attr("src", fotoAset);

        $("#id_edit").val(data.id_aset);
        $("#nama_edit").val(data.nama_aset);
        $("#qty_edit").val(data.qty);
        $("#keterangan_edit").val(data.keterangan);
        $("#no_aset_edit").val(data.no_aset);
        $("#id_asetToko").val(data.id);
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
      }
    });
  }
</script>