<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title>ABSI | Konsinyasi</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/dist/css/adminlte.min.css">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="hold-transition login-page">
  <?php
  if ($this->session->flashdata('type')) { ?>
    <script>
    var type = "<?= $this->session->flashdata('type'); ?>"
    var title = "<?= $this->session->flashdata('title'); ?>"
    var text = "<?= $this->session->flashdata('text'); ?>"
    Swal.fire(title,text,type)
    </script>
  <?php } ?>
  <div class="container py-5">
    <div class="card p-5">
      <h3>Hai, <?= ucwords($nama_spg) ?></h3>
      <p>Anda memiliki <b><?= $jumlah_toko ?></b> toko yang bisa dikelola, silahkan pilih toko terlebih dahulu !</p>
      <hr>
      <div class="row">
        <?php foreach ($list_toko as $row) { ?>
        <div class="col-md-3">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"><?= $row->nama_toko ?></h3>
            </div>
            <div class="card-body">
              <p><small><?= $row->alamat ?></small></p>
              <p><small><?= $row->telp ?></small></p>
            </div>
            <a href="<?= base_url('login/pilih_toko_act/').$row->id_toko ?>">
            <div class="card-footer text-center">
              Pilih Toko
            </div>
            </a>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
<!-- jQuery -->
<script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>/assets/dist/js/adminlte.min.js"></script>
</body>
</html>
