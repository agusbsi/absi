<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-danger ">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-store"></i> List Toko Tutup</b> </h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4"></div>
              <div class="col-md-4"></div>
              <div class="col-md-4 text-right">
                <div class="btn-group">
                  <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-plus"></i> Toko Tutup</button>
                </div>
              </div>
            </div>
            <hr>
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
                      <button type="button" class="btn btn-info btn-sm" onclick="getdetail('<?php echo $t->id_retur; ?>','<?= $t->nama_toko ?>','<?= $t->created_at ?>')" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-eye"></i> Detail</button>
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
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title" id="exampleModalLongTitle">Pengajuan Tutup Toko</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span class="badge badge-info"><i class="fas fa-info"></i> Noted:</span>
        <br>
        Dalam pengajuan tutup toko ada beberapa point yang harus di diperhatikan, sebagai berikut :
        <br>
        1. Pastikan SPG sudah update data penjualan terbaru di toko tersebut hingga tgl : <?= date('d-m-Y') ?>. <br>
        2. Anda di haruskan Update ASET Toko (* jika ada aset di toko tersebut). <br>
        3. Anda di haruskan mengisi jumlah semua artikel yang akan di Retur. <br>
        4. Proses pengajuan ini akan diverifikasi oleh : Marketing Verifikasi, Manager Marketing, Direksi. <br>
        5. Proses Selesai apabila tim gudang telah menerima barang retur dan input data ke absi.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="<?= base_url('spv/Toko/form_tutup'); ?>" class="btn btn-success">Ya, Lanjutkan</a>
      </div>
    </div>
  </div>
</div>
<!-- end modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Detail Pengajuan</h5>
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
        <div class="form-group">
          <label for="">Catatan :</label><br />
          <textarea name="catatan" id="hasil_catatan" class="form-control" rows="3" cols="100%" readonly></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
  function getdetail(id, toko, tgl) {
    // Menggunakan Ajax untuk mengambil data artikel dari server
    $.ajax({
      url: '<?= base_url('spv/Toko/getdataRetur') ?>', // Ganti dengan URL ke fungsi controller yang mengambil data artikel
      type: 'GET',
      data: {
        id_retur: id
      },
      success: function(data) {
        // Mengupdate nilai-nlai pada modal
        $("#hasil_catatan").val(data.catatan);
        $("#no_pengajuan").text(id);
        $("#toko").text(toko);
        $("#tgl_tarik").text(data.tgl_tarik);
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
</script>