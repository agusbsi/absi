<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-info ">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-store"></i> Data Piutang</b> </h3>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr class="text-center">
                  <th rowspan="3">No</th>
                  <th rowspan="3" style="width:15%">Nama Toko</th>
                  <th rowspan="3" style="width:18%">Customer</th>
                  <th colspan="4">Piutang</th>
                  <th rowspan="3">Action</th>
                </tr>
                <tr class="text-center">
                  <th colspan="2">Terverifikasi</th>
                  <th rowspan="2">Belum Verifikasi</th>
                  <th rowspan="2">Total</th>
                </tr>
                <tr>
                  <th class="text-center">Lunas</th>
                  <th class="text-center">Blm Lunas</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 0;
                foreach ($piutang as $t) :
                  $no++
                ?>

                  <tr>
                    <td class="text-center"><?= $no ?></td>
                    <td><?= mb_strlen($t->nama_toko) > 14 ? mb_substr($t->nama_toko, 0, 12) . '...' : $t->nama_toko ?></td>
                    <td><?= mb_strlen($t->customer) > 20 ? mb_substr($t->customer, 0, 17) . '...' : $t->customer ?></td>
                    <td class="text-right">Rp. <?= number_format($t->lunas) ?></td>
                    <td class="text-right text-danger">Rp. <?= number_format($t->verifikasi) ?></td>
                    <td class="text-right text-danger">
                      Rp. <?= number_format($t->belum) ?>
                    </td>
                    <td class="text-right">
                      <b>Rp. <?= number_format($t->belum + $t->verifikasi + $t->lunas) ?></b>
                    </td>
                    <td class="text-center">
                      <button class="btn btn-info btn-sm" title="Detail" onclick="getdetail('<?php echo $t->id; ?>','<?php echo $t->nama_toko; ?>')" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-eye"></i></button>
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
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">
          Toko : <span id="title"></span>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <table class="table responsive">
          <thead>
            <tr>
              <th>#</th>
              <th>Kode Artikel</th>
              <th>Deskripsi</th>
              <th>Harga @</th>
              <th>Margin @</th>
              <th>QTY</th>
              <th>Nilai</th>
              <th>Status Piutang</th>
            </tr>
          </thead>
          <tbody id="artikelList"></tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
  function getdetail(id, toko) {
    $("#title").html(toko);
    // Menggunakan Ajax untuk mengambil data artikel dari server
    $.ajax({
      url: '<?= base_url('finance/Piutang/getdata') ?>', // Ganti dengan URL ke fungsi controller yang mengambil data artikel
      type: 'GET',
      data: {
        id_toko: id
      },
      success: function(response) {
        // Menampilkan data artikel ke dalam modal
        var artikelList = $('#artikelList');
        artikelList.empty(); // Menghapus konten sebelumnya (jika ada)

        // Mengisi tabel dengan data artikel
        if (response.length > 0) {
          $.each(response, function(index, artikel) {
            if (artikel.piutang == 1) {
              var st_piutang = "TERVERIFIKASI";
            } else if (artikel.piutang == 2) {
              var st_piutang = "<p class='text-success'>LUNAS</p>";
            } else if (artikel.piutang == 3) {
              var st_piutang = "TERVERIFIKASI";
            } else {
              var st_piutang = "<p class='text-danger'>Belum Verifikasi</p>";
            }
            var row = '<tr>' +
              '<td>' + (index + 1) + '</td>' +
              '<td>' + artikel.id_penjualan + '</td>' +
              '<td>' + artikel.kode + '</td>' +
              '<td>' + formatRupiah(artikel.harga) + '</td>' +
              '<td>' + formatRupiah(parseFloat(artikel.harga * artikel.diskon_toko / 100)) + '</td>' +
              '<td>' + artikel.qty + '</td>' +
              '<td>' + formatRupiah(artikel.qty * parseFloat(artikel.harga - parseFloat(artikel.harga * artikel.diskon_toko / 100))) + '</td>' +
              '<td>' + st_piutang + '</td>' +
              '</tr>';
            artikelList.append(row);
          });
        } else {
          var emptyRow = '<tr><td colspan="5">Tidak ada artikel yang ditemukan.</td></tr>';
          artikelList.append(emptyRow);
        }
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
  }
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