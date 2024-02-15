<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">

    </div>
  </div>
  <div class="row">
    <!-- /.col -->
    <div class="col-md-12">
      <div class="card card-info ">
        <div class="card-header">
          <h3 class="card-title">
            <li class="fas fa-box"></li> Data Mutasi Barang
          </h3>
          <div class="card-tools">
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body p-1">

          <table id="table_kirim" class="table table-bordered table-striped ">
            <thead>
              <tr class="text-center">
                <th>#</th>
                <th style="width: 15%;">Kode Mutasi</th>
                <th>Toko Asal</th>
                <th>Toko Tujuan</th>
                <th>Tgl dibuat</th>
                <th>Status</th>
                <th style="width: 9%;">Menu</th>
              </tr>
            </thead>
            <tbody>

              <?php
              $no = 0;
              foreach ($list_data as $data) :
                $no++;
              ?>
                <tr>
                  <td><?= $no ?></td>
                  <td class="text-center"><?= $data->id ?></td>
                  <td>
                    <small><b><?= $data->asal ?></b></small>
                  </td>
                  <td class="text-center"><small><b><?= $data->tujuan ?></b></small></td>
                  <td class="text-center"><?= $data->created_at ?></td>
                  <td class="text-center"><?= status_mutasi($data->status) ?></td>
                  <td>
                    <a href="<?= base_url('sup/Mutasi/detail/' . $data->id) ?>" class="btn btn-<?= $data->status == 0 ? 'success' : 'info' ?> btn-sm" title="<?= $data->status == 0 ? 'Proses' : 'Detail' ?>"><i class="fa fa-<?= $data->status == 0 ? 'pen' : 'eye' ?>"></i> </a>
                    <a type="button" class="btn btn-default <?= $data->status == 1 ? '' : 'd-none' ?>  btn-sm" target="_blank" href="<?= base_url('leader/Mutasi/mutasi_print/' . $data->id) ?>" title="Surat Jalan"><i class="fa fa-print"></i></a>
                  </td>
                </tr>
              <?php
              endforeach;
              ?>

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
</section>

<!-- jQuery -->
<script src="<?php echo base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
<script>
  $(document).ready(function() {

    $('#table_kirim').DataTable({
      order: [
        [0, 'asc']
      ],
      responsive: true,
      lengthChange: false,
      autoWidth: false,
    });


  })
</script>