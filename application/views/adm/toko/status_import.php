<section class="content">
  <div class="container-fluid">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">
          <li class="fas fa-upload"></li> Status Import
        </h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">

        <?php if (!empty($import_status)) : ?>
          <div class="text-center">
            <h3>Toko <?= $toko->nama_toko ?></h3>
          </div>
          <hr>
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Kode</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($import_status as $code => $status) : ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $code ?></td>
                  <td><?= $status ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php else : ?>
          "DATA IMPORT TIDAK DITEMUKAN."
        <?php endif; ?>

      </div>
      <div class="card-footer text-right">
        <a href="<?= base_url('adm/Toko/profil/' . $toko->id) ?>" class="btn btn-danger btn-sm "><i class="fa fa-times-circle"></i> Close</a>
      </div>
      <!-- /.tab-content -->
    </div>
  </div>
  </div>
</section>