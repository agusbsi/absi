<section>
  <div class="container-fluid">
    <div class="card card-info">
      <form method="POST" action="<?= base_url('sup/permintaan/approve') ?>">
        <div class="card-header">
          <h3 class="card-title"><i class="nav-icon fas fa-box"></i> Detail Permintaan</h3>
          <div class="card-tools">
            <a href="<?= base_url('sup/Permintaan') ?>" type="button" class="btn btn-tool">
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
                <input type="text" class="form-control" name="tgl_mutasi" value="<?= format_tanggal1($permintaan->created_at) ?>" readonly>
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
                    <th>No</th>
                    <th style="width: 27%;">Artikel #</th>
                    <th>Stok</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">Qty Acc</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">Total</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center">Menu</th>
                  </tr>
                </thead>

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
                      $qty_barang = $d->qty;
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
                      <b><?= $d->kode ?></b> <br>
                      <small><?= $d->nama_produk ?></small>
                      <input type="hidden" name="id_produk[]" value="<?= $d->id_produk ?>">
                      <input type="hidden" name="id_detail[]" value="<?= $d->id ?>">
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
                      <?= $stok ?>
                    </td>
                    <td class="text-center">
                      <?= $d->qty ?>
                    </td>
                    <td>
                      <?php
                      if ($permintaan->status == 1) { ?>
                        <input type="number" name="qty_acc[]" class="form-control form-control-sm" min="0" id="qty_acc" value="<?= $d->qty ?>">
                      <?php } else { ?>
                        <input type="text" class="form-control form-control-sm" value="<?= $d->qty_acc ?>" readonly>
                      <?php } ?>
                    </td>
                    <td>
                      <input type="text" name="hrg_produk[]" class="form-control form-control-sm" readonly="" value="<?= $hrg_produk; ?>">
                    </td>
                    <td class="total">
                      <?php
                      if ($permintaan->status == 1) { ?>
                        <input type="text" name="total[]" readonly="" class="form-control form-control-sm" value="<?= $hrg_produk * $d->qty ?>">
                      <?php } else { ?>
                        <input type="text" name="total_acc[]" readonly="" class="form-control form-control-sm" value="<?= $hrg_produk * $d->qty_acc ?>">
                      <?php } ?>
                    </td>
                    <td>
                      <small><?= $d->keterangan ?></small>
                    </td>
                    <td>
                      <button class="btn btn-danger btn-sm btn-delete <?= $permintaan->status == 1 ? '' : 'd-none' ?>" type="button" data-id="<?= $d->id ?>"><i class="fas fa-trash"></i></button>
                    </td>
                  </tr>
                <?php
                    }
                ?>
                </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="5"><button type="button" class="btn btn-primary btn-sm <?= $permintaan->status == 1 ? '' : 'd-none' ?>" data-toggle="modal" data-target="#formTambah"><i class="fas fa-plus"></i> Tambah Artikel</button></td>
                    <td class="text-right">GrandTotal :</td>
                    <td>
                        <div id="grandTotal" class="<?= $permintaan->status == 1 ? '' : 'd-none' ?>"></div>
                      <div id="grandTotalacc" class="<?= $permintaan->status == 1 ? 'd-none' : '' ?>"></div>
                    </td>
                    <td></td>
                    <td></td>
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
              <hr>

            </div>
          </div>
          <input type="hidden" name="id_permintaan" value="<?= $permintaan->id ?>">
          <?php date_default_timezone_set('Asia/Jakarta'); ?>
          <input type="hidden" name="updated" class="form-control" readonly="readonly" value="<?php echo date('Y-m-d H:i:s'); ?>">

        </div>
        <div class="card-footer">
          <?php
          if ($permintaan->status == 1) {
            echo "<button type='submit' class='btn btn-success btn-sm float-right'><i class='fa fa-check-circle' aria-hidden='true'></i> Approve</button>";
            echo "<button type='button' class='btn btn-danger btn-sm float-right btn_reject' style='margin-right: 5px;'><i class='fas fa-times-circle'></i> Tolak </button>";
            echo "<a href=" . base_url('sup/Permintaan') . " class='btn btn-secondary btn-sm float-right ' style='margin-right: 5px;'><i class='fas fa-times-circle'></i> Close </a>";
          } else {
            echo "<a href=" . base_url('sup/Permintaan') . " class='btn btn-secondary btn-sm float-right'><i class='fa fa-step-backward' aria-hidden='true'></i> Kembali</a>";
          }
          ?>
        </div>
      </form>
    </div>
  </div>
</section>
<div class="modal fade" id="formTambah" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Artikel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('sup/Permintaan/tambah_item') ?>" method="POST">
          <div class="form-group">
            <label>Pilih Artikel</label>
            <select name="id_produk" id="pilih_produk" class="form-control select2bs4" required>
              <option>-- Pilih Produk --</option>
              <?php foreach ($list_produk as $lp) { ?>
                <option value="<?= $lp->id_produk ?>" data-stok="<?= $lp->qty ?>" data-satuan="<?= $lp->satuan ?>"><?= $lp->kode ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Stok di toko</label>
            <input type="text" id="stok" class="form-control" disabled>
          </div>
          <div class="form-group">
            <label>Satuan</label>
            <input type="text" id="satuan" class="form-control" disabled>
          </div>
          <div class="form-group">
            <label>Qty</label>
            <input type="number" name="qty" class="form-control" required>
            <input type="hidden" name="id_permintaan" value="<?= $permintaan->id ?>" class="form-control">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
<!-- Tambahkan script ini di bagian head atau sebelum penutup tag body -->
<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Fungsi untuk memformat angka ke format Rupiah
    function formatRupiah(angka) {
      return `Rp ${angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}`;
    }

    // Fungsi untuk menghitung total dan memformat input
    function updateTotals(inputs, grandTotalElement) {
      var grandTotal = 0;

      inputs.forEach(function(input) {
        var value = parseInt(input.value.replace(/\D/g, ''), 10) || 0;
        grandTotal += value;
        input.value = formatRupiah(value);
      });

      grandTotalElement.textContent = formatRupiah(grandTotal);
    }

    // Ambil semua elemen input qty_acc dan terapkan event listener
    var qtyAccInputs = document.querySelectorAll('input[name="qty_acc[]"]');
    qtyAccInputs.forEach(function(input) {
      input.addEventListener("input", function() {
        var parentRow = input.closest("tr");
        var hrgProdukValue = parseInt(parentRow.querySelector('input[name="hrg_produk[]"]').value, 10) || 0;
        var totalInput = parentRow.querySelector('input[name="total[]"]');
        var total = parseInt(input.value, 10) * hrgProdukValue;
        totalInput.value = formatRupiah(total);
        updateTotals(document.querySelectorAll('input[name="total[]"]'), document.getElementById("grandTotal"));
        updateTotals(document.querySelectorAll('input[name="total_acc[]"]'), document.getElementById("grandTotalacc"));
      });
    });

    // Ambil semua elemen input total dan terapkan format Rupiah
    updateTotals(document.querySelectorAll('input[name="total[]"]'), document.getElementById("grandTotal"));
    updateTotals(document.querySelectorAll('input[name="total_acc[]"]'), document.getElementById("grandTotalacc"));
  });
</script>
<script>
  $(document).ready(function() {
    $('.btn_reject').click(function(e) {
      var no_permintaan = $('input[name="permintaan"]').val();
      e.preventDefault();
      Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Data yang permintaan akan di tolak?",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal',
        confirmButtonText: 'Yakin'
      }).then((result) => {
        if (result.isConfirmed) {
          location.href = "<?= base_url('sup/Permintaan/tolak/') ?>" + no_permintaan;
        }
      })
    })
  });

  $('.btn-delete').click(function(e) {
    var id = $(this).data('id');
    var tr = $(this).closest('tr');
    e.preventDefault();
    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Barang ini akan dihapus dari list?",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Batal',
      confirmButtonText: 'Yakin'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "<?= base_url() ?>sup/Permintaan/hapus_item",
          method: "POST",
          data: {
            id: id
          },
          success: function(data) {
            tr.find('td').fadeOut(1000, function() {
              tr.remove();
            });
          }
        });
      }
    })
  })

  $('#pilih_produk').change(function(e) {
    var stok = $(this).find(':selected').data('stok');
    var satuan = $(this).find(':selected').data('satuan');
    $('#stok').val(stok);
    $('#satuan').val(satuan);
  })
</script>