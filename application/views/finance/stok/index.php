<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-info ">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-store"></i> Data Stok</b> </h3>
          </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr class="text-center">
                  <th style="width:5%">No</th>
                  <th style="width:25%">Nama Toko</th>
                  <th style="width:25%">Customer</th>
                  <th style="width:15%">Stok Artikel</th>
                  
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 0;
                    foreach($stok as $t):
                      $no++
                  ?>
                  <tr>
                    <td class="text-center"><?= $no ?></td>
                    <td><?= $t->nama_toko ?></td>
                    <td class="text-center"><?= $t->customer ?></td>
                    <td class="text-center"><?= $t->stok ?></td>
                   
                    <td class="text-center">
                      <!-- Large modal -->
                      <button type="button" class="btn btn-info btn-sm" onclick="getdetail('<?php echo $t->id; ?>')" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-eye"></i> Detail</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Detail Stok Barang</h5>
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
              <th>Stok</th>
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
      url: '<?= base_url('finance/Stok/get_artikel') ?>', // Ganti dengan URL ke fungsi controller yang mengambil data artikel
      type: 'GET',
      data: { id_toko: id },
      success: function(response) {
        // Menampilkan data artikel ke dalam modal
        var artikelList = $('#artikelList');
        artikelList.empty(); // Menghapus konten sebelumnya (jika ada)
        
        // Mengisi tabel dengan data artikel
        if (response.length > 0) {
          var totalKeseluruhan = 0; // Langkah 1: Inisialisasi total keseluruhan
          var totalqty = 0; // Langkah 1: Inisialisasi total keseluruhan
          $.each(response, function(index, artikel) {
            if (artikel.het == 1) {
              var harga = parseInt(artikel.harga_jawa);
              var margin = parseInt(artikel.margin_jawa);
              var nilai = harga - margin;

            } else if (artikel.het == 2) {
              var harga = parseInt(artikel.harga_indobarat);
              var margin = parseInt(artikel.margin_indo);
              var nilai = harga - margin;
            } else {
              var harga = parseInt(artikel.sp);
              var margin = parseInt(artikel.margin_sp);
              var nilai = harga - margin;
            }
            var row = '<tr>' +
              '<td>' + (index + 1) + '</td>' +
              '<td>' + artikel.kode + '</td>' +
              '<td>' + artikel.nama_produk + '</td>' +
              '<td>' + formatRupiah(harga) + '</td>' +
              '<td>' + formatRupiah(margin) + '</td>' +
              '<td>' + artikel.qty + '</td>';
            var total = artikel.qty * nilai;
            var totalFormatted = formatRupiah(parseInt(total));
            var qtyFix = parseInt(artikel.qty);
            totalKeseluruhan += total;
            totalqty += qtyFix;

            if (total < 0) {
              row += '<td style="color: red;">' + totalFormatted + '</td>';
            } else {
              row += '<td>' + totalFormatted + '</td>';
            }
            row += '</tr>';
            artikelList.append(row);
          });
          // Tambahkan baris untuk menampilkan total keseluruhan
          var totalKeseluruhanFormatted = formatRupiah(parseInt(totalKeseluruhan));
          var totalRow = '<tr><td colspan="5" class="text-right"><b>Total :</b></td><td><b>' + totalqty + '</b></td><td><b>' + totalKeseluruhanFormatted + '</b></td></tr>';
          artikelList.append(totalRow);
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
  function formatRupiah(number) {
    var rupiah = number.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
  return rupiah.replace(',00', '');
}
</script>
