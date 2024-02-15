<section class="content">
  <div class="container-fluid">
    <div id="printableArea">
      <div class="row">
        <div class="col-md-12">
          <div class="callout callout-info">
            <h5><i class="fas fa-store"></i> Nama Toko:</h5>
            <div class="row">
              <div class="col-md-4">
                <strong><?= $kirim->nama_toko; ?></strong>
                <br>
                <small><b>spg : </b><?= ($kirim->status <= 1) ? '<small>Belum diterima</small>' : $kirim->spg; ?></small>
              </div>
              <div class="col-md-4">
                No. Pengiriman : <strong><?= $kirim->id; ?></strong> <br>
                No. Permintaan : <strong><?= $kirim->id_permintaan; ?></strong>
              </div>
              <div class="col-md-4">
                Tgl : <strong><?= date('d F Y', strtotime($kirim->created_at)) ?></strong> <br>
                <strong><?= status_pengiriman($kirim->status) ?></strong>

              </div>
            </div>
          </div>

          <!-- print area -->

          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <h4>
                <li class="fas fa-file-alt"></li> Detail Artikel
              </h4>
            </div>

            <!-- Table row -->
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Artikel #</th>
                      <th>Deskripsi</th>
                      <th class="text-center">Jml Kirim</th>
                      <th class="text-center">Jml Terima </th>
                      <th class="text-center">Selisih </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $total = $total_t = $total_s = 0;
                    foreach ($list_data as $no => $d) :
                    ?>
                      <tr>
                        <td class="text-center"><?= ++$no ?></td>
                        <td><?= $d->kode ?></td>
                        <td><small><?= $d->nama_produk ?></small></td>
                        <td class="text-center"><?= $d->qty ?></td>
                        <td class="text-center"><?= ($kirim->status <= 1) ? '<small>Belum diterima</small>' : $d->qty_diterima ?></td>
                        <td class="text-center <?= ($d->qty != $d->qty_diterima && $kirim->status > 1) ? 'bg-warning' : '' ?>"><?= ($kirim->status <= 1) ? '<small>Belum diterima</small>' : $d->qty_diterima - $d->qty ?></td>
                      </tr>
                    <?php
                      $total += $d->qty;
                      $total_t += $d->qty_diterima;
                      $total_s += ($kirim->status <= 1) ? 0 : $d->qty_diterima - $d->qty;
                    endforeach;
                    ?>
                  </tbody>

                  <tfoot>
                    <tr>

                      <td colspan="3" align="right"> <strong>Total :</strong> </td>
                      <td class="text-center"><strong><?= number_format($total); ?></strong></td>
                      <td class="text-center"><strong><?= ($kirim->status <= 1) ? '<small>Belum diterima</small>' : number_format($total_t); ?></strong></td>
                      <td class="text-center"><strong><?= ($kirim->status <= 1) ? '<small>Belum diterima</small>' : number_format($total_s); ?></strong></td>

                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <!-- accepted payments column -->
              <div class="col-4">

              </div>
              <!-- /.col -->
              <div class="col-8">
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            <hr>
            <div class="row no-print">
              <div class="col-12">
                <button onclick="goBack()" class="btn btn-danger btn-sm float-right"> <i class="fas fa-arrow-left"></i>Kembali</button>

                <a type="button" onclick="printDiv('printableArea')" target="_blank" class="btn btn-default btn-sm float-right" style="margin-right: 5px;">
                  <i class="fas fa-print"></i> Print </a>
              </div>
            </div>
          </div>
        </div>
        <!-- end print area -->

        <!-- /.invoice -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</section>


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
  function goBack() {
    window.history.back();
  }
</script>