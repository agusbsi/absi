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
            <li class="fas fa-truck"></li> Data Pengiriman
          </h3>
          <div class="card-tools">
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body p-1">
          <div class="row">
            <div class="col-md-12">
              <a href="<?= base_url('adm_gudang/Pengiriman/add') ?>" class="btn btn-success float-right mb-1 btn-sm">
                <li class="fa fa-plus"></li> Buat Pengiriman
              </a>
            </div>
          </div>
          <hr>
          <!-- isi konten -->
          <table id="table_kirim" class="table table-bordered table-striped">
            <thead>
              <tr class="text-center">
                <th>No.</th>
                <th style="width: 15%;">Nomor</th>
                <th>Status</th>
                <th style="width: 30%;">Nama Toko</th>
                <th>Tanggal</th>
                <th>Menu</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php if (is_array($list_data)) { ?>

                  <?php
                  $no = 1;
                  foreach ($list_data as $dd) :
                    $no + 1
                  ?>
                    <td><?= $no ?></td>
                    <td><?= $dd->id ?></td>
                    <td>
                      <?= status_pengiriman($dd->status) ?>
                    </td>
                    <td>
                      <b style="font-size:small"><?= $dd->nama_toko ?> </b><br>
                      <small><b>Leader :</b> <?= $dd->leader ?> </small>
                    </td>
                    <td><?= $dd->created_at ?></td>

                    <td>

                      <a type="button" class="btn btn-primary btn-sm" href="<?= base_url('adm_gudang/pengiriman/detail_p/' . $dd->id) ?>" name="btn_detail"><i class="fa fa-eye" aria-hidden="true"></i> </a>
                      <a type="button" class="btn btn-default btn-sm <?= ($dd->status != "1") ? 'd-none' : ''; ?>" target="_blank" href="<?= base_url('adm_gudang/Pengiriman/detail_print/' . $dd->id) ?>" name="btn_detail"><i class="fa fa-print" aria-hidden="true"></i> Surat Jalan</a>

                    </td>

              </tr>
              <?php $no++; ?>
            <?php endforeach; ?>
          <?php } else { ?>
            <td colspan="6" align="center">Data Kosong</td>
          <?php } ?>

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