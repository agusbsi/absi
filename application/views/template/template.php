<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

  <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
  <title><?= $title ?></title>
  <link href="<?= base_url() ?>/assets/img/app/icon_absi.png" rel="icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/dist/css/adminlte.min.css">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- tambahan untuk plugin -->
  <!-- sweetalert2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
   <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/plugins/daterangepicker/daterangepicker.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  
  <?php
  if ($this->session->flashdata('type')) { ?>
    <script>
    var type = "<?= $this->session->flashdata('type'); ?>"
    var title = "<?= $this->session->flashdata('title'); ?>"
    var text = "<?= $this->session->flashdata('text'); ?>"
    Swal.fire(title,text,type)
    </script>
  <?php } ?>

  <?php
  if ($this->session->userdata('id')) {
    set_online($this->session->userdata('id'));
  } ?>

  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light  fixed-top no-print">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4 no-print">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="<?= base_url() ?>assets/img/app/logo_a.png" alt="ABSI" class="brand-image">
        <span class="brand-text font-weight-light"><img src="<?= base_url() ?>assets/img/app/logo_b.png" class="brand-logo" style="width:40%;" alt="ABSI" ></span>
      </a>
      
      <?php $this->load->view($sidebar) ?>
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header mt-5 no-print">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <!-- <h1>Fixed Layout</h1> -->
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= base_url().$this->uri->segment('1')."/".$this->uri->segment('2') ?>"><?= ucwords(str_replace("_", " ", $this->uri->segment('2'))); ?></a></li>
                <?php if ($this->uri->segment('3')) { ?>
                  <li class="breadcrumb-item active"><?= ucwords(str_replace("_", " ", $this->uri->segment('3'))); ?></li>
                <?php } ?>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <?= $contents ?>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer no-print">
      <div class="row">
        <div class="col-12 mt-3 text-center">
          <p class="lead">
            Jika ada pertanyaan <a class="btn btn-outline-info btn-sm" href="#" data-toggle="modal" data-target="#modal-contact"><i class="fas fa-phone-square-alt"></i> Hubungi Kami</a> 
          </p>
        </div>
      </div>
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.2
      </div>
      <strong>Copyright &copy; 2023 <a href="#">Globalindo Group</a>.</strong> All rights reserved.
    </footer>
  </div>
  <div class="modal fade" id="modal-contact">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="far fa-address-book"></i> Contact Us</h4>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- isi konten -->
          <div class="row">
          <div class="card-body card-primary card-outline">
            <div class="form-group">
              <label for="nik" > Ada yang ingin ditanyakan terkait absensi dan gaji?</label>
              <div class="float-left">
              <a href="https://api.whatsapp.com/send?phone=6282181525235" class="btn btn-success rounded float-right"><i class="fab fa-whatsapp"></i>HRD(1)</a>
              </div>
              <a href="https://api.whatsapp.com/send?phone=6287816712142" class="btn btn-success rounded float-right"><i class="fab fa-whatsapp"></i> HRD(2)</a>
            </div>
          </div>                  
          </div>
          <div class="row">
          <div class="card-body card-warning card-outline">
            <div class="form-group">
              <label for="nik" > Ada yang ingin ditanyakan terkait pekerjaan atau ada permasalahan toko?</label>
              <a href="https://api.whatsapp.com/send?phone=6282112452250" class="btn btn-success rounded float-right"><i class="fab fa-whatsapp"></i> Hubungi Marketing Verification!</a>
            </div>
          </div>                  
          </div>
          <div class="row">
          <div class="card-body card-danger card-outline">
            <div class="form-group">
              <label for="nik" > Ada kesulitan dalam penggunaan aplikasi web?</label>
              <a href="https://api.whatsapp.com/send?phone=6281398470053" class="btn btn-success rounded float-right"><i class="fab fa-whatsapp"></i> Hubungi IT Support!</a>
            </div>
          </div>                  
          </div>
            
          <!-- end konten -->
        </div>
        <div class="modal-footer justify-content-between">
          <button
            type="button"
            class="btn btn-danger"
            data-dismiss="modal"
          >
          <i class="fas fa-times-circle"></i> Kembali
          </button>
          
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- ./wrapper -->
<!-- jQuery -->

<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url() ?>/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>/assets/dist/js/adminlte.min.js"></script>


<!-- Sweet alert -->
<script src="<?= base_url(); ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>


<!-- Sweet alert -->
<script src="<?= base_url(); ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>

<!-- tambahan untuk pluggin -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- InputMask -->
<script src="<?php echo base_url()?>/assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url()?>/assets/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url()?>/assets/plugins/select2/js/select2.full.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url()?>/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url()?>/assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url()?>/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url()?>/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo base_url()?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url()?>/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url()?>/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url()?>/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url()?>/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url()?>/assets/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url()?>/assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url()?>/assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url()?>/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url()?>/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url()?>/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- table -->

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, 
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
<!-- untuk dashboard -->
<script>
    // The Calender
    $('#calendar').datetimepicker({
    format: 'L',
    inline: true
   }) 
</script>
<!-- untuk laporan -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Date range picker
    $('#reservation').daterangepicker({
      format: 'L'
    })
  })

</script>




<script>
  function logout(){
    let timerInterval;
    Swal.fire({
      title: 'Konfirmasi',
      text: 'Apakah anda yakin ingin keluar aplikasi?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yakin',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.value) {
        Swal.fire({
          title: 'Berhasil!',
          text: 'Berhasil Logout!',
          icon: 'success',
          showConfirmButton: false,
          timer: 1500,
        }).then(() => {
          window.location.href = '<?= base_url('profile/logout') ?>';

        })
      }
    })
  }
</script>


<script type="text/javascript">
  $('.btn-upload').click(function(){
    var id = $(this).data('id');
    $('[name=id]').val(id);
  })
</script>

</body>
</html>
