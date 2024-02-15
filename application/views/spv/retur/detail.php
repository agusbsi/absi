<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <?php
                foreach ($permintaan as $p) :
            ?>    
           <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              <div class="row">
                <div class="col-md-6">
                 Retur Barang
                </div>
                <div class="col-md-6">
                  Status : <?= status_retur($p->status) ?>
                </div>
              </div>
           </div>

            <!-- print area -->
            <div id="printableArea">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
              <h4><li class="fas fa-file-alt"></li> DETAIL RETUR</h4>
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  Dari :
                  <address>
                    <strong><?= $p->nama_toko; ?></strong><br>
                    <?= $p->alamat; ?> <br>
                    Phone: ( <?= $p->telp; ?> )<br>
                 
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  No Retur:
                  <address>
                    <strong><?= $p->id ?> </strong><br>
                  
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Spg :<br>
                
                  <b>[ <?= $p->spg ?> ] </b> <br>
                 <br>
                  Tanggal: <b> <?= $p->created_at; ?></b> 
                </div>
                <!-- /.col -->
                
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Artikel #</th>
                      <th>Nama Artikel</th>
                      <th>Satuan</th>
                      <th>QTY (pcs)</th>
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
                                <td ><?= $d->qty ?></td>
                            </tr>
                        <?php 
                        $total += $d->qty;
                            } 
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                      
                            <td colspan="4" align="right"> <strong>Total</strong> </td>
                            <td><?= $total ; ?></td>
                         
                        </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-9">
                  <p class="lead">Catatan :</p>
                    <textarea style="width: 300px; height:100px;" placeholder="" readonly> <?= $p->keterangan ?> </textarea>
                </div>
                <!-- /.col -->
                <div class="col-3">
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                <a type="button" onclick="printDiv('printableArea')" target="_blank" class="btn btn-default float-right" style="margin-right: 5px;">
                <i class="fas fa-print"></i> Print </a> 
                <a href="<?=base_url('spv/Retur')?>" class="btn btn-danger float-right" style="margin-right: 5px;"><i class="fas fa-times-circle"></i> Close </a>
                </div>
              </div>
            </div>
            </div>
            <!-- end print area -->
            <?php
            endforeach
            ?>
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


