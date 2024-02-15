<section>
  <div class="container-fluid">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"><i class="nav-icon fas fa-box"></i> Detail Permintaan</h3>
        <div class="card-tools">
          <a href="<?= base_url('adm_mv/Permintaan') ?>" type="button" class="btn btn-tool">
            <i class="fas fa-times"></i>
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>No Permintaan :</label>
              <input type="text" class="form-control" name="permintaan" value="<?= $permintaan->id ?>" readonly>
            </div>
            <div class="form-group">
              <label>Tgl Permintaan :</label>
              <input type="text" class="form-control" name="tgl_mutasi" value="<?= $permintaan->created_at ?>" readonly>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Nama Toko :</label>
              <input type="text" class="form-control" name="toko" value="<?= $permintaan->nama_toko ?>" readonly>
            </div>
            <div class="form-group">
              <label>Alamat Toko :</label> <br>
              <address>
                <?= $permintaan->alamat ?>
              </address>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Nama SPG :</label>
              <input type="text" class="form-control" name="spg" value="<?= $permintaan->spg ?>" readonly>
            </div>
            <div class="form-group">
              <label>Status :</label> <br>
              <?= status_permintaan($permintaan->status); ?>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-12 table-responsive">
            <table class="table table-bordered table-striped" id="myTable">
              <thead>
                <tr>
                  <th style="width:1%">No</th>
                  <th style="width: 15%">Kode Artikel #</th>
                  <th>Nama Artikel</th>
                  <th>Satuan</th>
                  <th style="width: 8%">Stok</th>
                  <th style="width: 8%" class="text-center">Qty Permintaan</th>
                  <th style="width: 5%" class="text-center">Qty Disetujui</th>
                  <th class="text-center">Harga</th>
                  <th style="width: 15%" class="text-center">Total</th>
                </tr>
              </thead>
              <form method="POST" action="<?= base_url('adm_mv/permintaan/approve') ?>">
                <tbody>
                  <tr>
                    <?php
                    $no = 0;
                    $total_qty = 0;
                    foreach ($detail_permintaan as $d) {
                      $no++;
                      $total = 0;
                      $grandtotal = 0;
                      $hrg_produk = 0;
                      $qty_barang = $d->qty_permintaan;
                      if ($d->het != 1) {
                        $hrg_produk = $d->het_indobarat;
                      } else {
                        $hrg_produk = $d->het_jawa;
                      }
                      $total = $hrg_produk * $qty_barang;
                      $total_qty += $qty_barang;
                      $grandtotal += $total;
                    ?>
                  <tr>
                    <td class="text text-center"><?= $no ?></td>
                    <td>
                      <?= $d->kode ?>
                      <input type="hidden" name="id_produk[]" value="<?= $d->id_produk ?>">
                      <input type="hidden" name="id_detail[]" value="<?= $d->id_detail ?>">
                    </td>
                    <td>
                      <?= $d->nama_produk ?>
                    </td>
                    <td>
                      <?= $d->satuan ?>
                    </td>
                    <td>
                      <?php
                      $id_toko = $permintaan->id_toko;
                      $id_produk = $d->id_produk;

                      $query = $this->db->query("SELECT tb_stok.qty as stok FROM tb_stok JOIN tb_permintaan ON tb_permintaan.id_toko = tb_stok.id_toko JOIN tb_permintaan_detail ON tb_permintaan_detail.id_produk = tb_stok.id_produk WHERE tb_stok.id_produk = $id_produk AND tb_stok.id_toko = $id_toko ");

                      if ($query->num_rows() > 0) {
                        $query = $query->row();
                        $stok = $query->stok;
                      } else {
                        $stok = 0;
                      }
                      ?>
                      <input type="text" name="stok" class="form-control" readonly="" value="<?= $stok ?>">
                    </td>
                    <td class="text-center">
                      <input type="text" name="qty_permintaan[]" class="form-control " readonly="" value="<?= $d->qty_permintaan ?>">
                    </td>
                    <td>
                      <?php
                      if ($permintaan->status == 1) { ?>
                        <input type="number" name="qty_acc[]" class="form-control" min="0" id="qty_acc" value="<?= $d->qty_permintaan ?>">
                      <?php } else { ?>
                        <input type="text" name="qty_acc[]" class="form-control" value="<?= $d->qty_acc ?>" readonly>
                      <?php } ?>
                    </td>
                    <td>
                      <input type="text" name="hrg_produk[]" class="form-control" readonly="" value="<?= $hrg_produk; ?>">
                    </td>
                    <td class="total">
                      <input type="text" name="total2[]" readonly="" class="form-control" value="0">
                      <input type="hidden" name="total[]" readonly="" class="form-control" value="0">
                    </td>
                  </tr>
                <?php
                    }
                ?>
                </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="8" class="text-right"><strong>Grandtotal</strong></td>
                    <td>
                      <strong>
                        <input type="text" name="grandtotal" readonly="" class="form-control" id="grandtotal1" value="0"></strong>
                      <input type="hidden" name="grandtotal" readonly="" class="form-control" id="grandtotal" value="0"></strong>
                    </td>
                  </tr>
                </tfoot>
            </table>
            <hr>
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="Catatan Leader:">Catatan Leader:</label>
                    <textarea col="1" row="3" class="form-control " readonly><?= $permintaan->catatan_leader ?></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="Catatan Leader:">Catatan MV:</label>
                    <?php
                    if ($permintaan->status == 1) { ?>
                      <textarea name="catatan_mv" class="form-control" cols="1" rows="3" placeholder="Catatan MV...."></textarea>
                      <small>Optional : Tambahkan catatan jika ada.</small>
                    <?php } else { ?>
                      <address>
                        <?= $permintaan->keterangan ?>
                      </address>
                    <?php } ?>
                  </div>
                </div>
              </div>
            
          </div>
        </div>
        <input type="hidden" name="id_permintaan" value="<?= $permintaan->id ?>">
        <?php date_default_timezone_set('Asia/Jakarta'); ?>
        <input type="hidden" name="updated" class="form-control" readonly="readonly" value="<?php echo date('Y-m-d H:i:s'); ?>">

      </div>
      <div class="card-footer">
        <?php
        if ($permintaan->status == 1) {
          echo "<button type='submit' class='btn btn-sm btn-success float-right'><i class='fa fa-check-circle' aria-hidden='true'></i> Approve</button>";
        }
        echo "<a href=" . base_url('adm_mv/Permintaan') . " class='btn btn-sm btn-primary float-right mr-2'><i class='fa fa-step-backward' aria-hidden='true'></i> Kembali</a>";
        ?>
      </div>
      </form>
    </div>
  </div>
</section>
<!-- jQuery -->
<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
<script>
  $(document).ready(function() {
    // fungsi hitungTotal()
    function hitungTotal(tr) {
      var qty = tr.find('input[name="qty_acc[]"]').val();
      var qty_b = tr.find('input[name="qty_permintaan[]"]').val();
      var harga = tr.find('input[name="hrg_produk[]"]').val();
      var total = 0;
      var grandtotal = 0;
      if (qty != qty_b) {
        total = harga * qty;
      } else {
        total = harga * qty_b;
      }
      tr.find('input[name="total2[]"]').val('Rp. ' + total);
      tr.find('input[name="total[]"]').val(total);
      $('#myTable input[name="total[]"]').each(function() {
        grandtotal += parseInt($(this).val());
      });
      $('#grandtotal').val(grandtotal);
      $('#grandtotal1').val('Rp. ' + grandtotal);
    }

    // event change pada input [name="qty_acc[]"]
    $('#myTable').on('change', 'input[name="qty_acc[]"]', function() {
      var tr = $(this).closest('tr');
      var qty = $(this).val();
      var qty_b = tr.find('input[name="qty_permintaan[]"]').val();
      var harga = tr.find('input[name="hrg_produk[]"]').val();
      $.ajax({
        url: "<?= base_url() ?>adm_mv/Permintaan/proses_total",
        method: "POST",
        data: {
          qty: qty,
          harga: harga,
          qty_b: qty_b
        },
        success: function(data) {
          hitungTotal(tr); // memanggil fungsi hitungTotal()s
          console.log(data);
        }
      });
    });

    // trigger event change pada input [name="qty_acc[]"]
    $('#myTable input[name="qty_acc[]"]').trigger('change');

  });
</script>