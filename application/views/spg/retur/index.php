<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-exchange-alt"></i> <?= $title ?></h3>
          </div>
          <div class="card-body">
            <div class="row">
              <a href="<?= base_url('spg/retur/tambah_retur') ?>" class="btn btn-success ml-auto btn-sm">
                <li class="fas fa-plus"></li> Buat Retur
              </a>
            </div>
            <hr>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No.Retur #</th>
                  <th>Tanggal</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 0;
                foreach ($list_retur as $row) {
                  $no++ ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->id ?></td>
                    <td><?= format_tanggal1($row->created_at) ?></td>
                    <td><?= status_retur($row->status) ?></td>
                    <td>
                      <?php if ($row->status == 2) { ?>
                        <a type="button" class="btn btn-success btn-sm" href="<?= base_url('spg/retur/detail/' . $row->id) ?>" name="btn_proses"><i class="fas fa-link" aria-hidden="true"></i> Proses kirim</a>
                      <?php } ?>
                      <a type="button" class="btn btn-primary btn-sm" href="<?= base_url('spg/retur/detail/' . $row->id) ?>"><i class="fas fa-eye" aria-hidden="true"></i> Detail</a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
<!-- jQuery -->
<script src="<?php echo base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
<script>
  $(document).ready(function() {

    $('#table_retur').DataTable({
      order: [
        [0, 'asc']
      ],
      responsive: true,
      lengthChange: false,
      autoWidth: false,
    });


  })
</script>


