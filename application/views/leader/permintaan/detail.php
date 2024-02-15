<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="callout callout-info">
          <h5> Permintaan Artikel:</h5>
          <div class="row">
            <div class="col-md-6">
              <strong><?= $permintaan->id ?></strong>
            </div>
            <div class="col-md-6">
              Status : <?= status_permintaan($permintaan->status) ?>
            </div>
          </div>
        </div>
        <!-- print area -->
        <div id="printableArea">
          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <div class="row invoice-info">
              <div class="col-sm-6 invoice-col">
                Dari :
                <address>
                  <strong><?= $permintaan->nama_toko; ?></strong><br>
                  <?= $permintaan->alamat; ?> <br>
                  Phone: ( <?= $permintaan->telp; ?> )<br>
                </address>
              </div>
              <div class="col-sm-6 invoice-col">
                Spg :<br>
                <b>[ <?= $permintaan->spg ?> ] </b> <br>
                <br>
                Tanggal: <b> <?= $permintaan->created_at; ?></b>
              </div>
            </div>
            <hr>
            <form action="<?= base_url('leader/Permintaan/approve') ?>" method="POST">
              <input type="hidden" name="id_minta" value="<?= $permintaan->id ?>">
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped tabel_po">
                    <thead>
                      <tr>
                        <?php if ($permintaan->status == 0) { ?>
                          <th>No</th>
                          <th>Kode #</th>
                          <th>Artikel</th>
                          <th>Stok</th>
                          <th class="text-center" style="width: 100px;">Qty</th>
                          <th class="text-center"> Keterangan</th>
                          <th class="text-center">Menu</th>
                        <?php } else { ?>
                          <th>No</th>
                          <th>Kode #</th>
                          <th>Artikel</th>
                          <th>Stok</th>
                          <th>Qty</th>
                          <th class="text-center"> Keterangan</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <?php if ($permintaan->status == 0) { ?>
                      <tbody>
                        <?php
                        $no = 0;
                        $total = 0;
                        foreach ($detail_permintaan as $d) {
                          $no++;
                        ?>
                          <tr>
                            <td><?= $no ?></td>
                            <td><?= $d->kode_produk; ?></td>
                            <td><?= $d->nama_produk; ?></td>
                            <td>
                              <?php
                              $id_toko = $permintaan->id_toko;
                              $id_produk = $d->id_produk;
                              $query = $this->db->query("SELECT tb_stok.qty AS stok FROM tb_stok JOIN tb_permintaan ON tb_permintaan.id_toko = tb_stok.id_toko JOIN tb_permintaan_detail ON tb_permintaan_detail.id_produk = tb_stok.id_produk WHERE tb_stok.id_produk = $id_produk AND tb_stok.id_toko = $id_toko");
                              if ($query->num_rows() > 0) {
                                $query = $query->row();
                                $stok = $query->stok;
                              } else {
                                $stok = 0;
                              }
                              ?>
                              <?= $stok; ?>
                            </td>
                            <td>
                              <input type="number" class="form-control form-control-sm" name="qty_acc[]" min="0" value="<?= $d->qty; ?>" required>
                              <input type="hidden" class="form-control form-control-sm" name="id_detail[]" value="<?= $d->id; ?>">
                            </td>
                            <td class="text-center"><?= $d->keterangan; ?></td>
                            <td class="text-center">
                              <button class="btn btn-danger btn-delete btn-sm" type="button" data-id="<?= $d->id ?>"><i class="far fa-trash-alt"></i></button>
                            </td>
                          </tr>
                        <?php
                          $total += $d->qty;
                        }
                        ?>
                      </tbody>

                    <?php } elseif ($permintaan->status == 5) { ?>
                      <tbody>
                        <?php
                        $no = 0;
                        $total = 0;
                        foreach ($detail_permintaan as $d) {
                          $no++;
                        ?>
                          <tr>
                            <td><?= $no ?></td>
                            <td><?= $d->kode_produk; ?></td>
                            <td><?= $d->nama_produk; ?></td>
                            <td>
                              <?php
                              $id_toko = $permintaan->id_toko;
                              $id_produk = $d->id_produk;
                              $query = $this->db->query("SELECT tb_stok.qty AS stok FROM tb_stok JOIN tb_permintaan ON tb_permintaan.id_toko = tb_stok.id_toko JOIN tb_permintaan_detail ON tb_permintaan_detail.id_produk = tb_stok.id_produk WHERE tb_stok.id_produk = $id_produk AND tb_stok.id_toko = $id_toko");
                              if ($query->num_rows() > 0) {
                                $query = $query->row();
                                $stok = $query->stok;
                              } else {
                                $stok = 0;
                              }
                              ?>
                              <?= $stok; ?>
                            </td>
                            <td><?= $d->qty; ?></td>
                            <td class="text-center"><?= $d->keterangan; ?></td>
                          </tr>
                        <?php
                          $total += $d->qty;
                        }
                        ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="3" align="right">
                            <strong>
                              Total
                            </strong>
                          </td>
                          <td>
                            <?= $total; ?>
                          </td>
                          <td></td>
                        </tr>
                      </tfoot>
                    <?php } else { ?>
                      <tbody>
                        <?php
                        $no = 0;
                        $total = 0;
                        foreach ($detail_approve as $d) {
                          $no++;
                        ?>
                          <tr>
                            <td><?= $no ?></td>
                            <td><?= $d->kode_produk; ?></td>
                            <td><?= $d->nama_produk; ?></td>
                            <td>
                              <?php
                              $id_toko = $permintaan->id_toko;
                              $id_produk = $d->id_produk;
                              $query = $this->db->query("SELECT tb_stok.qty AS stok FROM tb_stok JOIN tb_permintaan ON tb_permintaan.id_toko = tb_stok.id_toko JOIN tb_permintaan_detail ON tb_permintaan_detail.id_produk = tb_stok.id_produk WHERE tb_stok.id_produk = $id_produk AND tb_stok.id_toko = $id_toko");
                              if ($query->num_rows() > 0) {
                                $query = $query->row();
                                $stok = $query->stok;
                              } else {
                                $stok = 0;
                              }
                              ?>
                              <?= $stok; ?>
                            </td>
                            <td><?= $d->qty; ?></td>
                            <td class="text-center"><?= $d->keterangan; ?></td>
                          </tr>
                        <?php
                          $total += $d->qty;
                        }
                        ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="3" align="right">
                            <strong>
                              Total
                            </strong>
                          </td>
                          <td>
                            <?= $total; ?>
                          </td>
                          <td></td>
                        </tr>
                      </tfoot>
                    <?php } ?>
                  </table>
                  <hr>
                  <div class="form-group <?= $permintaan->status == 0 ? '' : 'd-none' ?>">
                    <label for="">Catatan Leader</label>
                    <textarea name="catatan_leader" class="form-control form-control-sm" rows="3" required placeholder="Data sudah di cek dengan benar..."></textarea>
                    <small>* Harus di isi</small>
                  </div>
                  <hr>
                </div>
              </div>
              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <?php if ($permintaan->status == 0) { ?>
                    <div class="col-12">
                      <a href="<?= base_url('') ?>/leader/permintaan" class="btn btn-danger float-right  btn-sm" style="margin-right: 5px;"><i class="fas fa-times"></i> Close</a>
                      <button type="button" class="btn btn-warning float-right btn_reject btn-sm" data-id="<?= $permintaan->id ?>" style="margin-right: 5px;"><i class="fas fa-times-circle"></i> Tolak Semua</button>
                      <button type="submit" class="btn btn-success float-right  btn-sm" style="margin-right: 5px;"><i class="fas fa-check-circle"></i> Setujui </button>
                    </div>
                  <?php } else { ?>
                    <a type="button" onclick="printDiv('printableArea')" target="_blank" class="btn btn-default float-right" style="margin-right: 5px;">
                      <i class="fas fa-print"></i> Print
                    </a>
                    <a href="<?= base_url('leader/Permintaan') ?>" class="btn btn-danger float-right" style="margin-right: 5px;"><i class="fas fa-times-circle"></i> Close </a>
                  <?php } ?>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- end print area -->

        <!-- /.invoice -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<script>
  function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
  }
</script>
<script>
  $(document).ready(function() {
    $('.btn_reject').click(function(e) {
      var id = $(this).data('id');
      e.preventDefault();
      Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Semua permintaan ini akan di tolak?",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal',
        confirmButtonText: 'Yakin'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "<?= base_url() ?>leader/Permintaan/tolak",
            method: "POST",
            data: {
              id: id
            },
            success: function(data) {
              location.reload();
            }
          });
        }
      })
    })
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
            url: "<?= base_url() ?>leader/Permintaan/hapus_item",
            method: "POST",
            data: {
              id: id
            },
            success: function(data) {
              location.reload();
            }
          });
        }
      })
    })
  })
</script>
<style>
  /* Style untuk perangkat seluler (lebar layar maksimal 767px) */
  @media (max-width: 767px) {

    table th:nth-child(1),
    table td:nth-child(1),
    table th:nth-child(3),
    table th:nth-child(6),
    table td:nth-child(3),
    table td:nth-child(6) {
      display: none;
    }
  }
</style>