<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-danger ">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-store"></i> List Toko Tutup</b> </h3>
          </div>
          <div class="card-body">
            <table id="table_toko" class="table table-bordered table-striped">
              <thead>
                <tr class="text-center">
                  <th>No Pengajuan</th>
                  <th style="width:20%">Nama Toko</th>
                  <th style="width:25%">Tgl Pengajuan</th>
                  <th>Status</th>
                  <th style="width:13%">Menu</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 0;
                foreach ($toko_tutup as $t) :
                  $no++
                ?>
                  <tr>
                    <td><?= $t->id_retur ?></td>
                    <td><?= $t->nama_toko ?></td>
                    <td><?= $t->created_at ?></td>
                    <td class="text-center">
                      <?= status_retur($t->status) ?>
                    </td>
                    <td>
                      <button type="button" class="btn btn-<?= ($t->status == 10 ? "success" : "info") ?> btn-sm" onclick="getdetail('<?php echo $t->id_retur; ?>','<?= $t->nama_toko ?>','<?= $t->created_at ?>')" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-eye"></i> <?= ($t->status == 10 ? "Proses" : "Detail") ?></button>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer text-center ">
          </div>
        </div>
      </div>

    </div>
  </div>
  </div>
</section>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form action="<?= base_url('sup/Toko/approveToko') ?>" method="POST">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="exampleModalLabel">Detail Pengajuan Tutup Toko</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body" style="max-height: 450px; overflow-y: auto;">
          <div class="row">
            <div class="col-md-3">
              No Pengajuan : <strong><span class="text-danger" id="no_pengajuan"></span></strong>
            </div>
            <div class="col-md-3">
              Nama Toko : <strong><span class="text-danger" id="toko"></span></strong>
            </div>
            <div class="col-md-3">
              Tgl Penarikan : <strong><span class="text-danger" id="tgl_tarik"></span></strong>
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
                <th>Qty Retur</th>
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
                <input type="hidden" name="id_retur" id="no_retur">
                <input type="hidden" name="id_toko" id="id_toko">
                <textarea name="catatan" id="catatan_mv" class="form-control" rows="3" cols="100%" required></textarea>
              </div>
            </div>
            <div class="col-md-4"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success btn-sm d-none" id="btn_approve">Approve</button>
          <button type="button" class="btn btn-danger btn-sm d-none" id="btn_tolak">Tolak</button>
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
  function getdetail(id, toko) {
    // Menggunakan Ajax untuk mengambil data artikel dari server
    $.ajax({
      url: '<?= base_url('sup/Toko/getdataRetur') ?>', // Ganti dengan URL ke fungsi controller yang mengambil data artikel
      type: 'GET',
      data: {
        id_retur: id
      },
      success: function(data) {
        // Mengupdate nilai-nlai pada modal
        $("#hasil_catatan").val(data.catatan);
        $("#catatan_mv").val(data.catatan_mv);
        $("#id_toko").val(data.id_toko);
        $("#no_retur").val(id);
        $("#no_pengajuan").text(id);
        $("#toko").text(toko);
        $("#tgl_tarik").text(data.tgl_tarik);
        // Dapatkan elemen textarea
        var catatan_mv = document.getElementById('catatan_mv');
        if (data.status == 10) {
          $("#btn_approve").removeClass('d-none');
          $("#btn_tolak").removeClass('d-none');
        } else {
          $("#btn_approve").addClass('d-none');
          $("#btn_tolak").addClass('d-none');
        }
        if (data.status != 10) {
          // Jika status bukan 10, atur atribut readonly pada textarea
          catatan_mv.setAttribute('readonly', 'readonly');
        } else {
          // Jika status adalah 10, hapus atribut readonly pada textarea
          catatan_mv.removeAttribute('readonly');
        }
        if (data.artikel.length > 0) {
          var artikelHtml = '';
          var totalQty = 0; // Variabel untuk menyimpan total qty

          $.each(data.artikel, function(i, item) {
            artikelHtml += '<tr>';
            artikelHtml += '<td class="text-center">' + (i + 1) + '</td>';
            artikelHtml += '<td>' + item.kode + '</td>';
            artikelHtml += '<td>' + item.nama_produk + '</td>';
            artikelHtml += '<td>' + item.qty + '</td>';
            artikelHtml += '</tr>';
            totalQty += parseInt(item.qty); // Menambahkan qty ke totalQty
          });

          // Menambahkan baris total qty
          artikelHtml += '<tr>';
          artikelHtml += '<td colspan="3" class="text-right"><strong>Total Qty:</strong></td>';
          artikelHtml += '<td><strong>' + totalQty + '</strong></td>';
          artikelHtml += '</tr>';

          $("#list_artikel").html(artikelHtml);
        } else {
          $("#list_artikel").html('');
          artikelHtml += '<tr>';
          artikelHtml += '<td colspan="4" class="text-center"> <strong>Artikel Kosong</strong> </td>';
          artikelHtml += '</tr>';
          $("#list_artikel").html(artikelHtml);
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
            // tambahkan kolom lainnya sesuai kebutuhan
            asetHtml += '</tr>';
          });
          // Tampilkan data aset di elemen HTML yang sesuai
          $("#list_aset").html(asetHtml);
        } else {
          asetHtml += '<tr>';
          asetHtml += '<td colspan="6" class="text-center"> <strong>Aset Kosong</strong> </td>';
          asetHtml += '</tr>';
          $("#list_aset").html(asetHtml);
        }
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
  }
  $('#btn_tolak').click(function(e) {
    var no_retur = $("#no_retur").val();
    var catatan = $("#catatan_mv").val();
    if (catatan == "") {
      alert('Catatan harus di isi');
    } else {
      e.preventDefault();
      Swal.fire({
        title: 'Data akan di tolak',
        text: "Apakah anda yakin untuk memprosesnya ?",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal',
        confirmButtonText: 'Yakin'
      }).then((result) => {
        if (result.isConfirmed) {
          location.href = "<?= base_url('sup/Toko/tolakToko/') ?>" + no_retur + '/' + catatan; // Perbaikan URL
        }
      })
    }
  });
</script>