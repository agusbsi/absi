<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-info ">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-store"></i> Data Penjualan</b> </h3>
          </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr class="text-center">
                  <th style="width:5%">No</th>
                  <th style="width:16%">Tanggal</th>
                  <th style="width:14%">No Penjualan</th>
                  <th style="width:25%">Nama Toko</th>
                  <th style="width:5%">QTY</th>
                  <th style="width:15%">Total</th>
                  <th>Status Piutang</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 0;
                    foreach($jual as $t):
                      $no++
                  ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $t->tanggal_penjualan ?></td>
                    <td><?= $t->id ?></td>
                    <td><?= $t->nama_toko ?></td>
                    <td class="text-center">
                    <?= $t->total_qty ?>
                    </td>
                    <td class="text-right">
                    Rp <?= number_format($t->total_jual) ?>
                    </td>
                    <td class="text-center"> <?= piutang($t->status)?></td>
                    <td class="text-center">
                    <button type="button" class="btn btn-info btn-sm" onclick="getdetail('<?php echo $t->id; ?>')" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-eye"></i></button>
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
        <h5 class="modal-title" id="exampleModalLabel">List Produk</h5>
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
  function getdetail(id) {
    // Menggunakan Ajax untuk mengambil data artikel dari server
    $.ajax({
      url: '<?= base_url('finance/Penjualan/getdata') ?>', // Ganti dengan URL ke fungsi controller yang mengambil data artikel
      type: 'GET',
      data: { id_penjualan : id },
      success: function(response) {
        // Menampilkan data artikel ke dalam modal
        var artikelList = $('#artikelList');
        artikelList.empty(); // Menghapus konten sebelumnya (jika ada)
        
        // Mengisi tabel dengan data artikel
        if (response.length > 0) {
          $.each(response, function(index, artikel) {
            
            var row = '<tr>' +
              '<td>' + (index + 1) + '</td>' +
              '<td>' + artikel.kode + '</td>' +
              '<td>' + artikel.nama_produk + '</td>' +
              '<td>' + formatRupiah(artikel.harga) + '</td>' +
              '<td>' + formatRupiah(parseFloat(artikel.harga * artikel.diskon_toko / 100)) + '</td>' +
              '<td>' + artikel.qty + '</td>' +
              '<td>' + formatRupiah(artikel.qty * (parseFloat(artikel.harga - (artikel.harga * artikel.diskon_toko / 100)))) + '</td>' +
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
  function formatRupiah(angka) 
    {
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
