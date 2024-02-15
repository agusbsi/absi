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
            <li class="fas fa-exchange-alt"></li> Data Retur Barang
          </h3>
          <div class="card-tools">
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body p-1">

          <!-- isi konten -->
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th style="width: 15%;">Kode Retur #</th>
                <th>Status</th>
                <th style="width: 23%;">Nama Toko</th>
                <th>Catatan MV</th>
                <th>Tanggal</th>
                <th style="width: 9%;">Menu</th>
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
                      <?= status_retur($dd->status) ?>
                    </td>
                    <td><?= $dd->nama_toko ?></td>
                    <td><?= $dd->catatan_mv ?></td>
                    <td><?= $dd->created_at ?></td>

                    <td>
                      <?php
                      if ($dd->status == 13 or $dd->status == 14) {
                      ?>
                        <div class="btn-group">
                          <button type="button" class="btn btn-outline-success btn-sm"> <i class="fas fa-edit"></i> Proses</button>
                          <button type="button" class="btn btn-success btn-sm dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="#" onclick="getjadwal('<?php echo $dd->id; ?>')" data-toggle="modal" data-target="#jadwal">Jadwal Ambil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" target="_blank" href="<?= base_url('adm_gudang/Retur/sppr_toko/' . $dd->id) ?>">Cetak SPPR</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" onclick="getterima('<?php echo $dd->id; ?>','<?php echo $dd->nama_toko; ?>')" data-toggle="modal" data-target="#terima">Terima Barang</a>

                          </div>
                        </div>
                      <?php } else if ($dd->status == 15) { ?>
                        <button data-toggle="modal" data-target="#terima" onclick="getterima('<?php echo $dd->id; ?>','<?php echo $dd->nama_toko; ?>')" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Detail</button>
                      <?php } else { ?>
                        <a type="button" class="btn btn-success btnHide btn-sm <?= ($dd->status) != 4 ? '' : 'd-none'; ?>" href="<?= base_url('adm_gudang/Retur/detail/' . $dd->id) ?>"><i class="fa fa-edit" aria-hidden="true"></i> </a>
                        <a type="button" class="btn btn-default btnHide btn-sm <?= ($dd->status) != 4 ? '' : 'd-none'; ?> <?= ($dd->status) == 3 ? 'd-none' : ''; ?>" target="_blank" href="<?= base_url('adm_gudang/Retur/sppr/' . $dd->id) ?>"><i class="fa fa-print" aria-hidden="true"></i> </a>
                        <button data-toggle="modal" data-target="#modalDetail" onclick="getdetail('<?php echo $dd->id; ?>','<?php echo $dd->nama_toko; ?>')" class="btn btn-info btn-sm <?= ($dd->status) != 4 ? 'd-none' : ''; ?>"><i class="fas fa-eye"></i> Detail</button>
                      <?php } ?>
                    </td>

              </tr>
              <?php $no++; ?>
            <?php endforeach; ?>
          <?php } else { ?>
            <td colspan="7" align="center">Data Kosong</td>
          <?php } ?>

            </tbody>
            <tfoot>
              <tr>
                <th colspan="7"></th>
              </tr>
            </tfoot>
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

<!-- Modal -->
<div class="modal fade" id="jadwal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <form action="<?= base_url('adm_gudang/Retur/confirm') ?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Jadwal Penarikan Barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for=""> No Retur </label>
            <input type="text" class="form-control form-control-sm" id="id_retur" name="id_retur" readonly>
          </div>
          <div class="form-group">
            <label for=""> Tgl Penarikan </label>
            <input type="text" class="form-control form-control-sm" id="tgl" name="tgl" readonly>
          </div>
          <div class="form-group">
            <label for=""> Update Tgl Penarikan </label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
              </div>
              <input type="text" id="tgl_tarik" name="tgl_tarik" class="form-control form-control-sm" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" inputmode="numeric" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="btn_confirm"><i class="fas fa-save"></i> Confirm</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- modal terima -->
<div class="modal fade" id="terima" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form id="terima-form" action="<?= base_url('adm_gudang/Retur/terimBarang') ?>" method="post">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="exampleModalLabel">Detail Terima Barang Retur</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body" style="max-height: 450px; overflow-y: auto;">
          <div class="row">
            <div class="col-md-3">
              No Retur : <strong><span class="text-danger" id="no_pengajuan"></span></strong>
            </div>
            <div class="col-md-3">
              Nama Toko : <strong><span class="text-danger" id="toko"></span></strong>
            </div>
          </div>
          <hr>
          <b># List Aset :</b>
          <table class="table responsive">
            <thead>
              <tr>
                <th class="text-center">No</th>
                <th>Kode Aset</th>
                <th>Aset</th>
                <th>Qty Retur</th>
                <th>Kondisi</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody id="list_aset"></tbody>
          </table>
          <hr>
          <b># List Artikel :</b>
          <table class="table responsive">
            <thead>
              <tr>
                <th class="text-center">No</th>
                <th>Kode Artikel</th>
                <th>Deskripsi</th>
               <th style="width: 15%;">Qty Retur</th>
                <th style="width: 15%;">Qty Input</th>
                <th style="width: 15%;">Qty Terima</th>
              </tr>
            </thead>
            <tbody id="list_artikel"></tbody>
          </table>
          <hr>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Catatan SPV:</label><br />
                <textarea name="catatan" id="hasil_catatan" class="form-control" rows="3" cols="100%" readonly></textarea>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Catatan MV:</label><br />
                <textarea name="catatan" id="catatan_mv" class="form-control" rows="3" cols="100%" readonly></textarea>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Catatan MM:</label><br />
                <input type="hidden" name="id_retur" id="no_retur">
                <input type="hidden" name="id_toko" id="id_toko">
                <textarea name="catatan_mm" id="catatan_mm" class="form-control" rows="3" cols="100%" readonly></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success btn-sm d-none" id="btn_approve">Simpan Penerimaan</button>
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Detail Terima Barang Retur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body" style="max-height: 450px; overflow-y: auto;">
        <div class="row">
          <div class="col-md-3">
            No Retur : <strong><span class="text-danger" id="no_pengajuanDetail"></span></strong>
          </div>
          <div class="col-md-3">
            Nama Toko : <strong><span class="text-danger" id="tokoDetail"></span></strong>
          </div>
        </div>
        <hr>
        <b># List Artikel :</b>
        <table class="table responsive">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th>Kode Artikel</th>
              <th>Deskripsi</th>
              <th style="width: 15%;">Qty Retur</th>
              <th style="width: 15%;">Qty Terima</th>
            </tr>
          </thead>
          <tbody id="list_artikelDetail"></tbody>
        </table>
        <hr>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Catatan SPV:</label><br />
              <textarea name="catatan" id="hasil_catatanDetail" class="form-control" rows="3" cols="100%" readonly></textarea>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Catatan MV:</label><br />
              <textarea name="catatan" id="catatan_mvDetail" class="form-control" rows="3" cols="100%" readonly></textarea>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Catatan MM:</label><br />
              <textarea name="catatan_mm" id="catatan_mmDetail" class="form-control" rows="3" cols="100%" readonly></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- jQuery -->
<script src="<?php echo base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
<script>
  function getjadwal(id) {
    $("#id_retur").val(id);
    // Menggunakan Ajax untuk mengambil data artikel dari server
    $.ajax({
      url: '<?= base_url('adm_gudang/Retur/getdatajadwal') ?>', // Ganti dengan URL ke fungsi controller yang mengambil data artikel
      type: 'GET',
      data: {
        id_retur: id
      },
      success: function(data) {
        // Mengupdate nilai-nlai pada modal
        $("#tgl").val(data.tgl_tarik);
        $("#tgl_tarik").val(data.tgl_tarik);
        if (data.status == 13) {
          $("#btn_confirm").removeClass('d-none');
        } else {
          $("#btn_confirm").addClass('d-none');
        }

      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('yyyy-mm-dd', {});
    $('[data-mask]').inputmask();
  }

  function getterima(id, toko) {
    // Menggunakan Ajax untuk mengambil data artikel dari server
    $.ajax({
      url: '<?= base_url('adm_gudang/Retur/getdataRetur') ?>', // Ganti dengan URL ke fungsi controller yang mengambil data artikel
      type: 'GET',
      data: {
        id_retur: id
      },
      success: function(data) {
        // Mengupdate nilai-nilai pada modal
        $("#hasil_catatan").val(data.catatan);
        $("#catatan_mv").val(data.catatan_mv);
        $("#catatan_mm").val(data.catatan_mm);
        $("#no_retur").val(id);
        $("#id_toko").val(data.id_toko);
        $("#no_pengajuan").text(id);
        $("#toko").text(toko);
        $("#tgl_tarik").text(data.tgl_tarik);

        // Dapatkan elemen textarea
        var catatan_mm = document.getElementById('catatan_mm');

        if (data.status == 13 || data.status == 14) {
          $("#btn_approve").removeClass('d-none');
        } else {
          $("#btn_approve").addClass('d-none');
        }

        if (data.artikel.length > 0) {
          var artikelHtml = '';
          var totalQty = 0; // Variabel untuk menyimpan total qty
          var terimaQty = 0; // Variabel untuk menyimpan total qty_terima

          $.each(data.artikel, function(i, item) {
            artikelHtml += '<tr>';
            artikelHtml += '<td class="text-center">' + (i + 1) + '</td>';
            artikelHtml += '<td>' + item.kode + '</td>';
            artikelHtml += '<td>' + item.nama_produk + '</td>';
            artikelHtml += '<td>' + item.qty + '</td>';
            artikelHtml += '<td> <input type="number" name="qty_terima[]" class="form-control form-control-sm qty-input" value="' + item.qty_terima + '" required></td>';
            artikelHtml += '<td> <input type="number"  class="form-control form-control-sm " value="' + item.qty_terima + '" readonly></td>';
            artikelHtml += '<td><input type="hidden" name="id_produk[]" value="' + item.id_produk + '" required></td>';
            artikelHtml += '</tr>';

            var itemQty = parseInt(item.qty); // Ambil qty dari item saat ini
            var itemTerima = parseInt(item.qty_terima); // Ambil qty dari item saat ini
            totalQty += itemQty; // Menambahkan qty ke totalQty
            terimaQty += itemTerima;
          });

          // Tambahkan event listener pada input qty_terima
          $(document).on('input', '.qty-input', function() {
            terimaQty = 0;

            // Loop melalui setiap input qty_terima
            $('.qty-input').each(function() {
              var qty = parseInt($(this).val());
              var itemQty = isNaN(qty) ? 0 : qty; // Menggunakan 0 jika qty bukan angka

              terimaQty += itemQty;
            });

            // Tampilkan totalQty di dalam elemen dengan id "totalQty"
            $("#totalQty").text(totalQty);
            $("#terimaQty").text(terimaQty);
          });

          // Menambahkan baris total qty
          artikelHtml += '<tr>';
          artikelHtml += '<td colspan="3" class="text-right"><strong>Total Qty:</strong></td>';
          artikelHtml += '<td><strong><span id="totalQty">' + totalQty + '</span></strong></td>';
          artikelHtml += '<td><strong><span ></span></strong></td>';
          artikelHtml += '<td><strong><span id="terimaQty">' + terimaQty + '</span></strong></td>';
          artikelHtml += '</tr>';

          $("#list_artikel").html(artikelHtml);
        } else {
          $("#list_artikel").html('<tr><td colspan="4" class="text-center"><strong>Artikel Kosong</strong></td></tr>');
        }

        // list aset
        if (data.aset.length > 0) {
          var asetHtml = '';

          $.each(data.aset, function(i, item) {
            asetHtml += '<tr>';
            asetHtml += '<td class="text-center">' + (i + 1) + '</td>';
            asetHtml += '<td>' + item.id_aset + '</td>';
            asetHtml += '<td>' + item.nama_aset + '</td>';
            asetHtml += '<td>' + item.qty + '</td>';
            asetHtml += '<td>' + item.kondisi + '</td>';
            asetHtml += '<td>' + item.keterangan + '</td>';
            asetHtml += '</tr>';
          });

          $("#list_aset").html(asetHtml);
        } else {
          $("#list_aset").html('<tr><td colspan="6" class="text-center"><strong>Aset Kosong</strong></td></tr>');
        }
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });

  }
   function getdetail(id, toko) {
    // Menggunakan Ajax untuk mengambil data artikel dari server
    $.ajax({
      url: '<?= base_url('adm_gudang/Retur/getdataRetur') ?>',
      type: 'GET',
      data: {
        id_retur: id
      },
      success: function(data) {
        // Mengupdate nilai-nilai pada modal
        $("#hasil_catatanDetail").val(data.catatan);
        $("#catatan_mvDetail").val(data.catatan_mv);
        $("#catatan_mmDetail").val(data.catatan_mm);
        $("#no_pengajuanDetail").text(id);
        $("#tokoDetail").text(toko);
        var catatan_mm = document.getElementById('catatan_mmDetail');
        if (data.artikel.length > 0) {
          var artikelHtml = '';
          var totalQty = 0;
          var terimaQty = 0;
          $.each(data.artikel, function(i, item) {
            artikelHtml += '<tr>';
            artikelHtml += '<td class="text-center">' + (i + 1) + '</td>';
            artikelHtml += '<td>' + item.kode + '</td>';
            artikelHtml += '<td>' + item.nama_produk + '</td>';
            artikelHtml += '<td>' + item.qty + '</td>';
            artikelHtml += '<td> <input type="number"  class="form-control form-control-sm " value="' + item.qty_terima + '" readonly></td>';
            artikelHtml += '<td><input type="hidden" name="id_produk[]" value="' + item.id_produk + '" required></td>';
            artikelHtml += '</tr>';
            var itemQty = parseInt(item.qty);
            var itemTerima = parseInt(item.qty_terima);
            totalQty += itemQty;
            terimaQty += itemTerima;
          });
          $(document).on('input', '.qty-input', function() {
            terimaQty = 0;
            $('.qty-input').each(function() {
              var qty = parseInt($(this).val());
              var itemQty = isNaN(qty) ? 0 : qty;
              terimaQty += itemQty;
            });
            $("#totalQty").text(totalQty);
            $("#terimaQty").text(terimaQty);
          });
          artikelHtml += '<tr>';
          artikelHtml += '<td colspan="3" class="text-right"><strong>Total Qty:</strong></td>';
          artikelHtml += '<td><strong><span id="totalQty">' + totalQty + '</span></strong></td>';
          artikelHtml += '<td><strong><span id="terimaQty">' + terimaQty + '</span></strong></td>';
          artikelHtml += '</tr>';

          $("#list_artikelDetail").html(artikelHtml);
        } else {
          $("#list_artikelDetail").html('<tr><td colspan="4" class="text-center"><strong>Artikel Kosong</strong></td></tr>');
        }
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });

  }
</script>
 
<script type="text/javascript">
const role = "<?= $this->session->userdata('role') ?>";
if (role != 5) {
  $(".btnHide").addClass('disabled');
}
</script>