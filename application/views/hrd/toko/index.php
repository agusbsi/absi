<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

        <!-- /.card -->

        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">
              <li class="fas fa-chart-pie"></li> Data Akses Toko
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">


            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr class="text-center">
                  <th style="width: 1%">No</th>
                  <th style="width:25%">Toko</th>
                  <th>SUPERVISOR</th>
                  <th>LEADER</th>
                  <th>SPG</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php if (is_array($list_toko)) { ?>
                    <?php $no = 0; ?>
                    <?php foreach ($list_toko as $data):
                      $no++; ?>

                      <td>
                        <?= $no ?>
                      </td>
                      <td>
                        <?= $data->nama_toko ?>
                      </td>
                      <td class="text-center">
                        <?= $data->spv ?>
                      </td>
                      <td class="text-center">
                        <?php if (empty($data->leader)) {
                          echo "<span class='badge badge-danger badge-sm'>- kosong - </span>";
                        } else {
                          echo $data->leader;
                        }
                        ?>
                      </td>
                      <td class="text-center">
                        <?php if (empty($data->spg)) {
                          echo "<span class='badge badge-danger badge-sm'>- kosong - </span>";
                        } else {
                          echo $data->spg;
                        }
                        ?>
                      </td>
                      <td class="text-center">
                        <a class="btn btn-warning btn-sm btn-edit" data-id="<?= $data->id; ?>"
                          data-toko="<?= $data->nama_toko; ?>" data-spv="<?= $data->id_spv; ?>"
                          data-leader="<?= $data->id_leader; ?>" data-spg="<?= $data->id_spg; ?>"><i
                            class="fas fa-edit"></i>
                          Ganti Akses</a>
                      </td>
                    </tr>
                  <?php endforeach; ?>

                <?php } else { ?>
                  <td colspan="6" align="center"><strong>Data Kosong</strong></td>
                <?php } ?>
                </tr>

              </tbody>

            </table>
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
<!-- modal update akses -->
<div class="modal fade" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
          <li class="fas fa-plus-circle"></li> Ganti Akses di Toko
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- isi konten -->
        <form method="POST" action="<?= base_url('hrd/Toko/ganti_akses') ?>" role="form" method="post"
          enctype="multipart/form-data">
          <div class="form-group">
            <label for="nama">
              <li class="fas fa-store"></li> Nama Toko
            </label> </br>
            <input type="text" name="toko" class="form-control " id="toko" readonly>
            <input type="hidden" name="id_toko" class="form-control " id="id_toko" readonly>
          </div>
          <div class="form-group">
            <label for="nama">
              <li class="fas fa-user"></li> Supervisor
            </label> </br>
            <select name="spv" class="form-control select2bs4" id="spv" required>
              <option value="">- Pilih SPV -</option>
              <?php foreach ($spv as $spv): ?>
                <option value="<?= $spv->id ?>"><?= $spv->nama_user ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label for="nama">
              <li class="fas fa-user"></li> Leader
            </label> </br>
            <select name="leader" class="form-control select2bs4" id="leader" required>
              <option value="">- Pilih Leader -</option>
              <?php foreach ($leader as $leader): ?>
                <option value="<?= $leader->id ?>"><?= $leader->nama_user ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label for="nama">
              <li class="fas fa-user"></li> SPG
            </label> </br>
            <select name="spg" class="form-control select2bs4" id="spg" required>
              <option value="">- Pilih SPG -</option>
              <?php foreach ($spg as $spg): ?>
                <option value="<?= $spg->id ?>"><?= $spg->nama_user ?></option>
              <?php endforeach ?>
            </select>
          </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">
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
<!-- end modal -->

<!-- jQuery -->
<script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
<script>
  $(document).ready(function () {

    // btn edit
    $('.btn-edit').on('click', function () {
      // get data from button edit
      const id = $(this).data('id');
      const toko = $(this).data('toko');
      const spv = $(this).data('spv');
      const leader = $(this).data('leader');
      const spg = $(this).data('spg');
      // Set data to Form Edit
      $('#id_toko').val(id);
      $('#toko').val(toko);
      $('#spv').val(spv).trigger('change');
      $('#leader').val(leader).trigger('change');
      $('#spg').val(spg).trigger('change');
      // Call Modal Edit
      $('#editModal').modal('show');
    });

  })
</script>
<!-- /.content -->