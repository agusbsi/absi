<section class="content">
  <div class="container-fluid">
    <div id="printableArea">
      <div class="row">
        <div class="col-md-12">
          <div class="callout callout-info">
            <h5><i class="fas fa-store"></i> Nama Toko:</h5>
            <div class="row">
              <div class="col-md-3">
                <strong><?= $minta->nama_toko; ?></strong>
              </div>
              <div class="col-md-3">
                No. : <strong><?= $minta->id; ?></strong>
              </div>
              <div class="col-md-3">
                Tgl : <strong><?= date('d F Y', strtotime($minta->created_at)) ?></strong>
              </div>
              <div class="col-md-3">
                <strong><?= status_permintaan($minta->status) ?></strong>
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
                      <th class="text-center">Qty</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 0;
                    $total = 0;
                    foreach ($list_data as $d) {
                      $no++;
                    ?>
                      <tr>
                        <td class="text-center"><?= $no ?></td>
                        <td><?= $d->kode ?></td>
                        <td><?= $d->nama_produk ?></td>
                        <td class="text-center"><?= $d->qty ?></td>
                      </tr>
                    <?php
                      $total += $d->qty;
                    }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>

                      <td colspan="3" align="right"> <strong>Total :</strong> </td>
                      <td class="text-center"><strong><?= number_format($total); ?></strong></td>

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

            <div class="row no-print">
              <div class="col-12">
                <button onclick="goBack()" class="btn btn-danger float-right"> <i class="fas fa-arrow-left"></i>Kembali</button>

                <a type="button" onclick="printDiv('printableArea')" target="_blank" class="btn btn-default float-right" style="margin-right: 5px;">
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