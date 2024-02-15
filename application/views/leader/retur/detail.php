<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="callout callout-info">
          <h5><i class="fas fa-info"></i> No: <?= $retur->id ?></h5>
          <div class="row">
            <div class="col-md-6">
              Status : <?= status_retur($retur->status) ?>
            </div>
          </div>
        </div>
        <div id="printableArea">
          <div class="invoice p-3 mb-3">
            <div class="row">
              <h4>
                <li class="fas fa-file-alt"></li> Detail retur
              </h4>
            </div>
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                Dari :
                <address>
                  <strong><?= $retur->nama_toko; ?></strong><br>
                  <?= $retur->alamat; ?>
                </address>
              </div>
              <div class="col-sm-4 invoice-col">
                Spg :<br>

                <b>[ <?= $retur->spg ?> ] </b> <br>
                Tanggal: <b> <?= $retur->created_at; ?></b>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Artikel #</th>
                      <th>Nama Artikel</th>
                      <th>Satuan</th>
                      <th>QTY</th>
                      <th>Berkas</th>
                      <th>Keterangan</th>
                      <th>Catatan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 0;
                    $total = 0;
                    foreach ($detail_permintaan as $d) {
                      $no++;
                    ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= $d->kode_produk ?></td>
                        <td><?= $d->nama_produk ?></td>
                        <td><?= $d->satuan ?></td>
                        <td><?= $d->qty ?></td>
                        <td>
                          <button type="button" class="btn btn-outline-primary btn-foto btn-sm" data-id_produk="<?= $d->kode_produk ?>" src="<?= base_url('assets/img/retur/' . $d->foto) ?>"><i class="fas fa-eye"></i> Lihat</button>
                        </td>
                        <td><?= $d->keterangan ?></td>
                        <td><?= $d->catatan ?></td>
                      </tr>
                    <?php
                      $total += $d->qty;
                    }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="4" align="right"> <strong>Total</strong> </td>
                      <td><?= $total; ?></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <br>
                <a href="<?= base_url('assets/img/retur/lampiran/' . $retur->lampiran) ?>" target="_blank" class="btn btn-sm btn-warning <?= empty($retur->lampiran) ? 'd-none' : '' ?>"><i class="fas fa-download"></i> Lampiran </a>
                <a href="<?= base_url('assets/img/retur/lampiran/' . $retur->foto_packing) ?>" target="_blank" class="btn btn-sm btn-warning <?= empty($retur->foto_packing) ? 'd-none' : '' ?>"><i class="fas fa-download"></i> Foto packing </a>
              </div>
              <div class="col-md-3"></div>
               <div class="col-md-6">
                <p class="lead">Catatan leader:</p>
                <?php if ($retur->status == 0) { ?>
                  <textarea name="catatan_leader" id="catatan-leader" rows="3" class="form-control form-control-sm" required></textarea>
                  <input type="hidden" id="id_retur" value="<?= $retur->id ?>">
                  <small>* harus di isi.</small>
                <?php } else {
                  echo $retur->catatan_leader;
                } ?>
              </div>

            </div>
            <hr>
            <?php if ($retur->status == 0) { ?>
              <div class="row no-print">
                <div class="col-12">
                  <a type="button" onclick="printDiv('printableArea')" target="_blank" class="btn btn-sm btn-default float-right" style="margin-right: 5px;">
                    <i class="fas fa-print"></i> Print </a>
                  <a href="javascript:void(0);" onclick="validateCatatanAndAction('approve')" class="btn btn-sm btn-success float-right" style="margin-right: 2px;">
                    <i class="fas fa-check"></i> Approve
                  </a>
                  <a href="javascript:void(0);" onclick="validateCatatanAndAction('tolak')" class="btn btn-sm btn-danger float-right" style="margin-right: 2px;">
                    <i class="fas fa-times-circle"></i> Tolak
                  </a>
                </div>
              </div>
            <?php } else { ?>
              <div class="row no-print">
                <div class="col-12">
                  <a href="<?= base_url('leader/retur') ?>" class="btn btn-sm btn-danger float-right"> <i class="fas fa-arrow-left"></i>Kembali</a>
                  <a type="button" onclick="printDiv('printableArea')" target="_blank" class="btn btn-sm btn-default float-right" style="margin-right: 5px;">
                    <i class="fas fa-print"></i> Print </a>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
        <!-- /.invoice -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<!-- modal lihat foto -->
<div class="modal fade" id="lihat-foto">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title judul">
          <li class="fas fa-box"></li> Berkas Produk : <a href="#" class="id_produk"></a>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <img class="img-rounded image" id="image" style="width: 100%" src="" alt="User Image">
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
<!-- end modal -->
<script>
  $(function() {
    $('.btn-foto').on('click', function() {
      $('.image').attr('src', $(this).attr('src'));
      $('.id_produk').html($(this).data('id_produk'));
      $('#lihat-foto').modal('show');
    });
  });
</script>

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
  function validateCatatanAndAction(action) {
    var catatan = document.getElementById('catatan-leader').value.trim();

    if (catatan === '') {
      Swal.fire({
        title: 'Belum Lengkap',
        text: 'Catatan leader tidak boleh kosong.!',
        icon: 'warning'
      });
    } else {
      saveCatatanAndPerformAction(catatan, action);
    }
  }

  function saveCatatanAndPerformAction(catatan, action) {
    var id_retur = $('#id_retur').val();
    $.ajax({
      url: '<?= base_url('leader/Retur/tindakan') ?>',
      type: 'POST',
      data: {
        catatan: catatan,
        action: action,
        id_retur: id_retur,
      },
      success: function(response) {
        if (response === 'setuju') {
          Swal.fire({
            title: 'Berhasil',
            text: 'Data retur berhasil di approve.',
            icon: 'success',
            confirmButtonText: 'OK'
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload(); // Reload halaman jika tombol "OK" ditekan
            }
          });
        } else {
          Swal.fire({
            title: 'Di Tolak',
            text: 'Data retur telah di tolak.',
            icon: 'success',
            confirmButtonText: 'OK'
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload(); // Reload halaman jika tombol "OK" ditekan
            }
          });
        }
      },
      error: function() {
        alert('Terjadi kesalahan saat menyimpan catatan atau melakukan tindakan.');
      }
    });
  }
</script>

