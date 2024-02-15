<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="callout callout-info">
          <h5><i class="fas fa-info"></i> Note:</h5>
          Invoice ini hanya untuk pencocokan Data Tagihan dari Toko yang terdaftar di Aplikasi ABSI
        </div>


        <!-- Main content -->
        <div class="invoice p-3 mb-3">
          <!-- title row -->
          <div class="row">
            <div class="col-12">
              <h4>
                <i class="fas fa-file"></i> INVOICE
              </h4>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              To
              <table>
                <tr>
                  <td>Customer</td>
                  <td style="padding-left:15px;">: <b>
                      <?php
                      if ($invoice->id_cust != 0) {
                        $customer = $invoice->customer;
                        if (strlen($customer) > 20) {
                          $customer = substr($customer, 0, 20) . '...';
                        }
                        echo $customer;
                      } else {
                        echo $invoice->cust_toko;
                      }
                      ?>
                    </b></td>
                </tr>
                <tr>
                  <td>Toko</td>
                  <td style="padding-left:15px;">: <b>
                      <?php
                      if ($invoice->id_toko != 0) {
                        $toko = $invoice->toko;
                        if (strlen($toko) > 20) {
                          $toko = substr($toko, 0, 20) . '...';
                        }
                        echo $toko;
                      } else {
                        echo "SEMUA TOKO";
                      }
                      ?>
                    </b></td>
                </tr>
              </table>
            </div>
            <!-- /.col -->
            <div class="col-sm-5 invoice-col">
              <br>
              <table>
                <tr>
                  <td>NO INVOICE</td>
                  <td style="padding-left:15px;">: <b><?= $invoice->id ?></b></td>
                </tr>
                <tr>
                  <td>di buat oleh</td>
                  <td style="padding-left:15px;">: <b><?= $invoice->nama_user ?></b></td>
                </tr>
                <tr>

                  <td>Range Tgl Penjualan</td>
                  <td style="padding-left:15px;">: <b><?= $invoice->range_tgl ?></b></td>
                </tr>
              </table>

            </div>
            <div class="col-md-3">
              <br>
              <table>
                <tr>
                  <td>Jth Tempo </td>
                  <td style="padding-left:15px;">: <b><?= $invoice->jth_tempo ?></b></td>
                </tr>
                <tr>
                  <td>Tgl dibuat</td>
                  <td style="padding-left:15px;">: <b><?= $invoice->created_at ?></b></td>
                </tr>
                <tr>
                  <td>Status </td>
                  <td style="padding-left:15px;">: <?= ($invoice->status == 3) ? '<span class="badge badge-success badge-sm">LUNAS</span>' : '<span class="badge badge-danger badge-sm">BELUM LUNAS</span>' ?></td>
                </tr>

              </table>
            </div>
            <div class="ribbon-wrapper ribbon-xl">
              <div class="ribbon <?= ($invoice->status == 3) ? 'bg-success text-xl' : 'bg-danger text-lg' ?> ">
                <?= ($invoice->status == 3) ? "LUNAS" : "BELUM LUNAS" ?>
              </div>
            </div>
          </div>
          <!-- /.row -->
          <hr>
          <!-- Table row -->
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Deskripsi</th>
                    <th class="text-right">Harga</th>
                    <th class="text-right">Margin</th>
                    <th class="text-right">QTY</th>
                    <th class="text-right">Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 0;
                  $total = 0;
                  foreach ($detail as $d) :
                    $no++;
                  ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $d->kode ?></td>
                      <td><?= $d->nama_produk ?></td>
                      <td class="text-right">Rp <?= number_format($d->harga) ?></td>
                      <td class="text-right">Rp <?= number_format($d->margin) ?></td>
                      <td class="text-right"><?= $d->qty ?></td>
                      <td class="text-right">Rp <?= number_format($d->sub_total) ?></td>
                    </tr>
                  <?php
                    $total += $d->sub_total;
                  endforeach;
                  ?>
                </tbody>
              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">
              <p class="lead">Catatan :</p>

              <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                <?= $invoice->catatan ?>
              </p>
            </div>
            <!-- /.col -->
            <div class="col-6 text-right">
              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th style="width:50%">Subtotal:</th>
                    <td><b>Rp <?= number_format($total) ?></b></td>
                  </tr>

                </table>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <hr>
          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-12">
              <a href="#" onClick="getlunas('<?= $invoice->id; ?>')" class="btn btn-success btn-sm float-right ml-3 <?= ($invoice->status == 3) ? 'd-none' : '' ?>" data-toggle="modal" data-target="#lunas" title="Lunas">
                <i class="fas fa-check"></i> Lunas
              </a>
              <button rel="noopener" onclick="printPage()" class="btn btn-default btn-sm float-right"><i class="fas fa-print"></i> Print</button>
              <button class="btn btn-danger btn-sm mr-3 float-right" onclick="goBack()"><i class="fas fa-time-circle"></i> Close</button>
            </div>
          </div>
        </div>
        <!-- /.invoice -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- Modal -->
<div class="modal fade" id="lunas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="<?= base_url('finance/Invoice/bayar') ?>" method="post">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="exampleModalLabel">Pelunasan Tagihan <span id="judul"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Bayar</label>
                <input type="text" class="form-control" value="LUNAS" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">No Invoice</label>
                <input type="text" class="form-control" name="invoice" id="invoice" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="">No Voucher</label> <span>( dari Easy Accounting )</span>
            <input type="text" name="faktur" class="form-control" placeholder="Cnth : xxx/xxx/xx" required>
          </div>
          <div class="form-group">
            <label for="">Catatan :</label>
            <textarea name="catatan" cols="3" rows="3" class="form-control" placeholder="Masukan Catatan..."></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- /.content -->
<script>
  function printPage() {
    window.print();
  }
</script>
<style>
  @media print {
    .print-footer {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      text-align: center;
      font-size: 10pt;
    }
  }
</style>
<script>
  function goBack() {
    window.history.back();
  }

  function getlunas(id) {
    $("#invoice").val(id);
  }
</script>