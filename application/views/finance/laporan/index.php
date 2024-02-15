<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-info card-tabs">
        <div class="card-header p-0 pt-1">
          <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
            <li class="pt-2 px-3">
              <h3 class="card-title">
            <li class="fas fa-book"></li> Laporan </h3>
            </li>
            <li class="nav-item">
              <a class="nav-link active" id="rekap-tab" data-toggle="pill" href="#rekap" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true"> Penjualan</a>
            </li>
          </ul>
        </div>
        <!-- card -->
        <div class="card-body">
          <div class="tab-content" id="custom-tabs-two-tabContent">
            <!-- rekap penjualan -->
            <div class="tab-pane fade show active" id="cari" role="tabpanel" aria-labelledby="rekap-tab">
              <div class="card card-info">
                <div class="card-body ">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-group">
                        <label>
                          <li class="fas fa-store"></li> Nama Toko :
                        </label>
                        <select class="form-control select2bs4" name="toko" id="id_toko" style="width: 100%;">
                          <option selected="selected" value=""> - Pilih - </option>
                          <option value="all"> Semua Toko </option>
                          <?php
                          foreach ($list_toko as $t) { ?>
                            <option value="<?= $t->id ?>"><?= $t->nama_toko ?></option>
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
                          <input type="text" name="tanggal" id="tanggal" class="form-control float-right" value="" placeholder="-Semua-" autocomplete="off">
                        </div>
                      </div>
                      <!-- berdasarkan status -->
                    </div>
                  </div>

                </div>
                <div class="card-footer">
                  <button type="button" id="btn_rekap" class="btn btn-info">
                    <li class="fas fa-search"></li> Rekap Penjualan
                  </button>
                  <button type="button" id="btn_detail" class="btn btn-success">
                    <li class="fas fa-search"></li> Detail Penjualan
                  </button>
                </div>
              </div>
              <!-- /.card -->
            </div>
            <!-- end rekap -->
          </div>
          <hr>
          <!-- hasil cari -->
          <div id="printableArea">
            <!-- /.card -->
            <div class="card card-info d-none" id="card_detail">
              <div class="card-header">
                <h3 class="card-title">
                  <li class="fas fa-file-alt"></li> Detail Penjualan
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool " data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
                  <a href="<?= base_url('finance/Laporan') ?>" class="btn btn-tool">
                    <i class="fas fa-times"></i></a>

                </div>
              </div>
              <div class="card-body">
                <!-- print area -->

                <h4 class="text-center">Laporan Penjualan </h4>
                <p class="text-center" id="toko_detail"></p>
                <div class="text-center"><label id="lap_awal_detail" class="mr-2 text-center"></label> s/d <label class="text-center ml-2" id="lap_akhir_detail"></label>
                </div>
              </div>
              <hr>
              <table class="table table-bordered table-striped ">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">No Penjualan</th>
                    <th class="text-center">QTY</th>
                    <th class="text-center">Total</th>
                    <th class="text-center">Status</th>
                  </tr>
                </thead>
                <tbody id="body_hasil_detail">
                </tbody>
              </table>
              <hr>
              <div class="row no-print">
                <div class="col-md-10"></div>
                <div class="col-md-2">
                  <a type="button" onclick="printDiv('printableArea')" target="_blank" class="btn btn-default btn-sm float-right mr-3 ml-2">
                    <i class="fas fa-print"></i> Print </a>
                  <a href="<?= base_url('finance/Laporan') ?>" class="btn btn-danger btn-sm float-right  mb-4">close</a>
                </div>
              </div>
            </div>
            <!-- /.card -->
            <div class="card card-info d-none" id="hasil_rekap">
              <div class="card-header">
                <h3 class="card-title">
                  <li class="fas fa-file-alt"></li> Rekap Penjualan
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool " data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
                  <a href="<?= base_url('finance/Laporan') ?>" class="btn btn-tool">
                    <i class="fas fa-times"></i></a>

                </div>
              </div>
              <div class="card-body">
                <!-- print area -->

                <h4 class="text-center">Rekap Penjualan </h4>
                <div class="text-center"><label id="lap_awal_rekap" class="mr-2 text-center"></label> s/d <label class="text-center ml-2" id="lap_akhir_rekap"></label>
                </div>
              </div>
              <hr>
              <table class="table table-bordered table-striped ">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nama Toko</th>
                    <th class="text-center">Total QTY</th>
                  </tr>
                </thead>
                <tbody id="body_hasil_rekap">
                </tbody>
              </table>
              <hr>
              <div class="row no-print">
                <div class="col-md-10"></div>
                <div class="col-md-2">
                  <a type="button" onclick="printPage('printableArea')" target="_blank" class="btn btn-default btn-sm float-right mr-3 ml-2">
                    <i class="fas fa-print"></i> Print </a>
                  <a href="<?= base_url('finance/Laporan') ?>" class="btn btn-danger btn-sm float-right  mb-4">close</a>
                </div>
              </div>
            </div>
          </div>
          <!-- end hasil -->
        </div>
        <!-- end print area -->
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
<script src="<?php echo base_url() ?>/assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url() ?>/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- daterange picker -->
<link rel="stylesheet" href="<?php echo base_url() ?>/assets/plugins/daterangepicker/daterangepicker.css">
<!-- Select2 -->
<script src="<?php echo base_url() ?>/assets/plugins/select2/js/select2.full.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>/assets/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<script type="text/javascript">
  function printPage() {
    window.print();
  }
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
  // proses cari data rekap
  $("#btn_detail").click(function() {
    var id_toko = $('#id_toko').val();
    var tgl = $('#tanggal').val();
    var tglArray = tgl.split(" - ");
    var tgl_awal = tglArray[0];
    var tgl_akhir = tglArray[1];
    if (tgl == "" || id_toko == "" || id_toko == "all") {
      Swal.fire(
        'oops',
        'Silahkan pilih Toko  & range tanggal dulu ya !',
        'info'
      );
    } else {
      $.ajax({
        url: "<?php echo base_url('finance/Laporan/detail'); ?>",
        type: "GET",
        dataType: "json",
        data: {
          id_toko: id_toko,
          tgl: tgl,
          tgl_awal: tgl_awal,
          tgl_akhir: tgl_akhir
        },
        success: function(data) {
          var html = '';
          var toko_nama = '';
          $.each(data, function(i, item) {
            if (item.status == 1) {
              var piutang = "TERVERIFIKASI";
            } else {
              var piutang = "<p class='text-danger'>Belum Verifikasi</p>";
            }
            html += '<tr>';
            html += '<td>' + (i + 1) + '</td>';
            html += '<td>' + item.tanggal_penjualan + '</td>';
            html += '<td>' + item.id + '</td>';
            html += '<td class="qty text-center">' + item.qty_artikel + '</td>';
            html += '<td class="total text-right">' + formatRupiah(parseInt(item.total_jual)) + '</td>';
            html += '<td class=" text-center">' + piutang + '</td>';
            html += '</tr>';
            toko_nama = item.nama_toko;
          });
          html += '<tr>';
          html += '<td colspan="3" class="text-right">Total :</td>';
          html += '<td class="text-center" id="totalQty"></td>';
          html += '<td class="text-right" id="subtotal"></td>';
          html += '<td></td>';
          html += '</tr>';
          $("#body_hasil_detail").html(html);

          const qtyCells = document.getElementsByClassName("qty");
          const harga = document.getElementsByClassName("total");
          let totalQty = 0;
          let subtotal = 0;
          for (let i = 0; i < qtyCells.length; i++) {
            totalQty += parseInt(qtyCells[i].textContent);
            subtotal += parseInt((harga[i].textContent).replace(/\D/g, ''));
          }
          document.getElementById("totalQty").textContent = totalQty;
          document.getElementById("subtotal").textContent = formatRupiah(subtotal);
          if (data != "") {
            $('#toko_detail').html(toko_nama);
            $('#lap_awal_detail').html(tgl_awal);
            $('#lap_akhir_detail').html(tgl_akhir);
            $('#cari').addClass('d-none');
            $('#card_detail').removeClass('d-none');
          } else {
            // menampilkan pesan eror
            Swal.fire(
              'TIDAK ADA DATA',
              'Data tidak ditemukan, silahkan cari kembali',
              'info'
            );
          }

        }

      });
    }

  });
  // proses cari data detail
  $("#btn_rekap").click(function() {
    var id_toko = $('#id_toko').val();
    var tgl = $('#tanggal').val();
    var tglArray = tgl.split(" - ");
    var tgl_awal = tglArray[0];
    var tgl_akhir = tglArray[1];

    if (tgl == "" || id_toko == "") {
      Swal.fire(
        'Oops',
        'Silahkan pilih Toko & range tanggal dulu ya!',
        'info'
      );
      return;
    }

    var url = "<?php echo base_url('finance/Laporan/rekap'); ?>";
    var data = {
      id_toko: id_toko,
      tgl: tgl,
      tgl_awal: tgl_awal,
      tgl_akhir: tgl_akhir
    };
    $.ajax({
      url: "<?php echo base_url('finance/Laporan/rekap'); ?>",
      type: "GET",
      dataType: "json",
      data: data,
      success: function(data) {
        var html = '';
        var toko_nama = '';

        $.each(data, function(i, item) {
          html += '<tr>';
          html += '<td class=" text-center">' + (i + 1) + '</td>';
          html += '<td>' + item.nama_toko + '</td>';
          if (item.qty_artikel == 0) {
            html += '<td class="qty text-center"><span class="badge badge-sm badge-danger">' + item.qty_artikel + '</span></td>';
          } else {
            html += '<td class="qty text-center"><span class="badge badge-sm badge-success">' + item.qty_artikel + '</span></td>';
          }
          html += '</tr>';
          toko_nama = item.nama_toko;
        });

        $("#body_hasil_rekap").html(html);
        if (data != "") {
          $('#lap_awal_rekap').html(tgl_awal);
          $('#lap_akhir_rekap').html(tgl_akhir);
          $('#cari').addClass('d-none');
          $('#hasil_rekap').removeClass('d-none');
        } else {
          // menampilkan pesan eror
          Swal.fire(
            'TIDAK ADA DATA',
            'Data tidak ditemukan, silahkan cari kembali',
            'info'
          );
        }
      }
    });
  });


  // Fungsi untuk mengubah angka menjadi format rupiah
  function formatRupiah(angka) {
    var numberString = angka.toString();
    var split = numberString.split(',');
    var sisa = split[0].length % 3;
    var rupiah = split[0].substr(0, sisa);
    var ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return 'Rp ' + rupiah;
  }
</script>