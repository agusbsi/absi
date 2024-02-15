<section class="content">
  <div class="row">
    <div class="col-md-12">
    <div class="card card-info card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                  <li class="pt-2 px-3"><h3 class="card-title"> <li class="fas fa-book"></li> Laporan </h3></li>
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#permintaan" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true"> Permintaan</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#pengiriman" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false"> Pengiriman</a>
                  </li>
                </ul>
              </div>
              <!-- card -->
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                  <!-- permintann -->
                  <div class="tab-pane fade show active" id="permintaan" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                    <div class="card card-info">
                      <form action="<?=base_url('adm_gudang/laporan/cari_permintaan')?>" method="POST">
                        <div class="card-body ">
                          <div class="row">
                            <div class="col-md-5">
                              <!-- berdasarkan Id Permintaan -->
                              <div class="form-group">
                                <label><li class="fas fa-file-alt"></li> ID Permintaan :</label>
                                <select name="id_minta" class="form-control select2bs4" style="width: 100%;">
                                  <option selected="selected" value="all">-Semua-</option>
                                  <?php foreach ($list_permintaan as $l) { ?>
                                  <option value="<?= $l->kode ?>"><?= $l->kode." ( ".$l->nama_toko." )" ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <!-- berdasarkan toko -->
                              <div class="form-group">
                                <label><li class="fas fa-store"></li> Toko :</label>
                                <select class="form-control select2bs4" name="toko" style="width: 100%;">
                                  <option selected="selected" value="all"> -Semua- </option>
                                  <?php foreach ($toko as $t) { ?>
                                  <option value="<?= $t->id ?>"><?= $t->nama_toko?> - <?= $t->id ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5">
                              <!-- Date range -->
                              <div class="form-group">
                                <label>Range Tanggal:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      <i class="far fa-calendar-alt"></i>
                                    </span>
                                  </div>
                                    <input type="text" name="tanggal" class="form-control float-right"  value="" placeholder="-Semua-" autocomplete="off">
                                </div>
                              </div>
                                <!-- berdasarkan status -->
                              <div class="form-group">
                                <label><li class="fas fa-link"></li> Status :</label>
                                  <select name="status" class="form-control select2bs4" style="width: 100%;">
                                    <option selected="selected" value="all">-Semua-</option>
                                    <option value="1">Permintaan Baru</option>
                                    <option value="4">Pending</option>
                                    <option value="2">Di kirim</option>
                                    <option value="3">Selesai</option>
                                  </select>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-5"></div>
                            <div class="col-md-2">
                              <button type="submit" name="btn_minta" class="btn btn-info" ><li class="fas fa-search"></li> Cari Permintaan</button>
                            </div>
                            <div class="col-md-5"></div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- /.card -->
                  </div>
                  <!-- end permintaan -->
                  <!-- pengiriman -->
                  <div class="tab-pane fade" id="pengiriman" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                      <div class="card card-primary">
                          <form action="<?=base_url('adm_gudang/laporan/cari_pengiriman')?>" method="POST">
                            <div class="card-body ">
                              <div class="row">
                                <div class="col-md-5">
                                  <!-- berdasarkan Id Permintaan -->
                                  <div class="form-group">
                                    <label><li class="fas fa-truck"></li> ID Pengiriman :</label>
                                    <select name="id_kirim" class="form-control select2bs4" style="width: 100%;">
                                      <option selected="selected" value="all">-Semua-</option>
                                      <?php foreach ($list_kirim as $l) { ?>
                                      <option value="<?= $l->kode ?>"><?= $l->kode." ( ".$l->nama_toko." )" ?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                  <!-- berdasarkan toko -->
                                  <div class="form-group">
                                    <label><li class="fas fa-store"></li> Toko :</label>
                                    <select class="form-control select2bs4" name="toko" style="width: 100%;">
                                      <option selected="selected" value="all"> -Semua- </option>
                                      <?php foreach ($toko as $t) { ?>
                                      <option value="<?= $t->id ?>"><?= $t->nama_toko?> - <?= $t->id ?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-5">
                                  <!-- Date range -->
                                  <div class="form-group">
                                    <label>Range Tanggal:</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="far fa-calendar-alt"></i>
                                        </span>
                                      </div>
                                        <input type="text" name="tanggal" class="form-control float-right"  value="" placeholder="-Semua-" autocomplete="off">
                                    </div>
                                  </div>
                                    <!-- berdasarkan status -->
                                  <div class="form-group">
                                    <label><li class="fas fa-link"></li> Status :</label>
                                      <select name="status" class="form-control select2bs4" style="width: 100%;">
                                        <option selected="selected" value="all">-Semua-</option>
                                        <option value="0">Di kirim</option>
                                        <option value="1">Selesai</option>
                                      </select>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-5"></div>
                                <div class="col-md-2">
                                  <button type="submit" name="btn_kirim" class="btn btn-info" ><li class="fas fa-search"></li> Cari Pengiriman</button>
                                </div>
                                <div class="col-md-5"></div>
                              </div>
                            </div>
                          </form>
                      </div>
                  </div>
                  <!-- end pengiriman -->
                </div>
              </div>
              <!-- /.card -->
            </div>
     
    </div>
  </div>
</section>
<!-- daterangepicker -->

<!-- jQuery -->
<script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url()?>/assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url()?>/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- daterange picker -->
<link rel="stylesheet" href="<?php echo base_url()?>/assets/plugins/daterangepicker/daterangepicker.css">
<!-- Select2 -->
<script src="<?php echo base_url()?>/assets/plugins/select2/js/select2.full.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>/assets/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?php echo base_url()?>/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<script type="text/javascript">
$(function() {
  $('.select2').select2()
  $('input[name="tanggal"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });

  $('input[name="tanggal"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
  });

  $('input[name="tanggal"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

});
</script>
