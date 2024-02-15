<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-info ">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-cube"></i> List Stok Opname</b> </h3>
          </div>
            <div class="card-body">
            <div class="row">
              <div class="col-md-9"></div>
              <div class="col-md-3 text-right">
              <a href="<?= base_url('audit/Toko/adjust_so')?>" class="btn btn-success btn-sm" > <i class="fas fa-plus-circle"></i> Adjust SO </a>
              </div>
            </div>
            <hr>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr class="text-center">
                  <th style="width:5%">No</th>
                  <th >No SO</th>
                  <th>Nama Toko</th>
                  <th >Tanggal</th>
                  <th>Catatan</th>
                  <th>Menu</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 0;
                    foreach($so as $t):
                      $no++
                  ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $t->id ?></td>
                    <td><?= $t->nama_toko ?></td>
                    <td><?= $t->created_at ?></td>
                    <td><?= $t->catatan ?></td>
                    <td>
                      <button class="btn btn-info btn-sm" onclick="getdetail('<?php echo $t->id; ?>')" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-eye"></i> Detail</button>
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
<div class="modal fade bd-example-modal-lg" id="printModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Detail Artikel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <table class="table tabel-responsive">
          <thead>
            <tr>
              <th>#</th>
              <th>Artikel</th>
              <th>Stok</th>
              <th>QTY SO</th>
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
    url: '<?= base_url('audit/Toko/getdata') ?>', // Ganti dengan URL ke fungsi controller yang mengambil data artikel
    type: 'GET',
    data: { id_penjualan: id },
    success: function (response) {
      // Menampilkan data artikel ke dalam modal
      var artikelList = $('#artikelList');
      var totalQtySistem = 0;
      var totalQtyInput = 0;

      artikelList.empty(); // Menghapus konten sebelumnya (jika ada)

      // Mengisi tabel dengan data artikel
      if (response.length > 0) {
        $.each(response, function (index, artikel) {
          var row = '<tr>' +
            '<td>' + (index + 1) + '</td>' +
            '<td>' + artikel.kode + '</td>' +
            '<td>' + artikel.qty_sistem + '</td>' +
            '<td>' + artikel.qty_input + '</td>' +
            '</tr>';

          artikelList.append(row);

          // Calculate totals
          totalQtySistem += parseInt(artikel.qty_sistem);
          totalQtyInput += parseInt(artikel.qty_input);
        });

        // Append the total rows after processing all articles
        var totalRow = '<tr>' +
          '<td colspan="2" class="text-right">Total :</td>' +
          '<td><strong id="totalQtySistem">' + totalQtySistem + '</strong></td>' +
          '<td><strong id="totalQtyInput">' + totalQtyInput + '</strong></td>' +
          '</tr>';
        artikelList.append(totalRow);
      } else {
        var emptyRow = '<tr><td colspan="4">Tidak ada artikel yang ditemukan.</td></tr>';
        artikelList.append(emptyRow);
      }
    },
    error: function (xhr, status, error) {
      console.log(error);
    }
  });
}


</script>

