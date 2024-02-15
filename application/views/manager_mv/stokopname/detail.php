<section>
  <div class="container-fluid">
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">Update Stok Opname</h3>
        <div class="card-tools">
          <a href="<?= base_url('sup/So/list_so') ?>" type="button" class="btn btn-tool">
            <i class="fas fa-times"></i>
          </a>
        </div>
      </div>
      <div class="card-body">
        <form method="POST" action="<?= base_url('sup/So/update_so') ?>">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Nama Toko :</label>
                <input type="text" class="form-control" value="<?= $so->nama_toko ?>" readonly>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>No SO :</label>
                <input type="text" class="form-control" name="id_so" value="<?= $so->id ?>" readonly>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Tanggal SO :</label>
                <input type="date" class="form-control" name="tgl_so" value="<?= date('Y-m-d', strtotime($so->created_at)); ?>" readonly>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Nama SPG :</label>
                <input type="text" class="form-control" value="<?= $so->nama_user ?>" readonly>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12 table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center" style="width:1%">#</th>
                    <th class="text-center">Kode Artikel</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center" style="width:4%">Satuan</th>
                    <th class="text-center" style="width:7%">Qty Akhir</th>
                    <th class="text-center" style="width:5%">SO SPG</th>
                    <th class="text-center" style="width:5%">Selisih</th>
                    <th class="text-center" style="width:10%">Update</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php
                    $no = 0;
                    $total_qty = 0;
                    $total_so = 0;
                    $total_selisih = 0;
                    foreach ($list_data as $d) {
                      $no++;
                      $total = 0;
                    ?>
                  <tr>
                    <td class="text text-center"><?= $no ?></td>
                    <td>
                      <?= $d->kode ?>
                      <input type="hidden" name="id_detail[]" value="<?= $d->id ?>">
                    </td>
                    <td>
                      <?= $d->nama_produk ?>
                    </td>
                    <td>
                      <?= $d->satuan ?>
                    </td>
                    <td class="text-center">
                      <?= $d->qty_akhir ?>
                    </td>
                    <td class="text-center">
                      <?= $d->hasil_so ?>
                    </td>
                    <td class="text-center">
                      <span class="btn btn-sm btn-<?= ($d->selisih < 0) ? 'danger' : '' ?>"><?= $d->selisih ?></span>
                    </td>
                    <td class="text-center">
                      <input type="number" name="qty_edit[]" min="0" class="form-control form-control-sm qty_edit" value="<?= $d->hasil_so ?>" required>
                    </td>
                  </tr>
                <?php
                      $total_qty += $d->qty_akhir;
                      $total_so += $d->hasil_so;
                      $total_selisih += $d->selisih;
                    }
                ?>
                </tr>
                <tr>
                  <td colspan="4" align="right"> <strong>Total :</strong> </td>
                  <td class="text-center"><strong><?= $total_qty ?></strong></td>
                  <td class="text-center"><strong><?= $total_so ?></strong></td>
                  <td class="text-center"><strong><?= $total_selisih ?></strong></td>
                  <td class="text-center"><strong class="subtotal"><?= $total_so ?></strong></td>
                </tr>
                </tbody>
              </table>
              <hr>
              <div class="form-group">
                <label for="">Catatan SPG :</label>
                <textarea class="form-control form-control-sm" rows="3" readonly><?= $so->catatan ?></textarea>
              </div>
            </div>
          </div>
          <?php date_default_timezone_set('Asia/Jakarta'); ?>
          <input type="hidden" name="updated" class="form-control" readonly="readonly" value="<?php echo date('Y-m-d H:i:s'); ?>">
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-success btn-sm float-right"><i class="fa fa-check-circle" aria-hidden="true"></i> Simpan</button>
        <a href="<?= base_url('sup/So/list_so') ?>" class="btn btn-danger btn-sm float-right mr-2"><i class="fa fa-times-circle" aria-hidden="true"></i> Cancel</a>
      </div>
      </form>
    </div>
  </div>
</section>
<script>
  $('.qty_edit').on('input', function() {
    updateTotal();
  });

  // Fungsi untuk menghitung total
  function updateTotal() {
    var total = 0;
    $('.qty_edit').each(function() {
      var qty = parseFloat($(this).val()); // Ambil nilai dan ubah ke tipe float
      if (!isNaN(qty)) {
        total += qty; // Tambahkan ke total jika nilai adalah angka
      }
    });
    $(".subtotal").text(total);
  }
</script>