<section class="content">
    <div class="container-fluid">
    <div id="printableArea">
        <div class="row">
          <div class="col-md-12"> 
           <div class="callout callout-info">
              <h5><i class="fas fa-store"></i> Nama Toko:</h5>
              <div class="row">
                <div class="col-md-3">
                <strong><?= $SO->nama_toko; ?></strong>
                </div>
                <div class="col-md-3">
                  Periode : <strong><?= date('F Y', strtotime('-0 month', strtotime($SO->created_at))) ?></strong>
                </div>
                <div class="col-md-3">
                  No. Stok Opname : <strong><?= $SO->id; ?></strong>
                </div>
                <div class="col-md-3">
                Tanggal SO: <strong><?= date('d F Y', strtotime($SO->created_at)) ?></strong>
                </div>
              </div>
           </div>

            <!-- print area -->
            
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
              <h4><li class="fas fa-file-alt"></li> Hasil Stok Opname</h4>
              </div>
             
              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Artikel #</th>
                      <th>Qty Awal</th>
                      <th>T. terima</th>
                      <th>T. retur</th>
                      <th>T. jual</th>
                      <th>T. mutasi</th>
                      <th>Qty Akhir</th>
                      <th>Hasil SO</th>
                      <th>Selisih</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                            $no = 0;
                            $total_awal = 0;
                            $t_terima = 0;
                            $t_retur = 0;
                            $t_jual = 0;
                            $t_mutasi = 0;
                            $t_qtyakhir = 0;
                            $t_hasilso = 0;
                            $t_selisih = 0;
                            foreach ($detail_so as $d) {
                            $no++; 
                        ?>
                            <tr>
                                <td class="text-center"><?= $no ?></td>
                                <td ><?= $d->kode ?></td>
                                <td class="text-center"><?= $d->qty_awal ?></td>
                                <td class="text-center"><?= $d->total_terima ?></td>
                                <td class="text-center"><?= $d->total_retur ?></td>
                                <td class="text-center"><?= $d->total_jual ?></td>
                                <td class="text-center"><?= $d->total_mutasi ?></td>
                                <td class="text-center"><?= $d->qty_akhir ?></td>
                                <td class="text-center"><?= $d->hasil_so ?></td>
                                <td class="text-center"> <span class="btn btn-sm btn-<?= ($d->selisih < 0) ? 'danger' : '' ?>"><?= $d->selisih ?></span></td>
                            </tr>
                        <?php 
                        $total_awal += $d->qty_awal;
                        $t_terima += $d->total_terima;
                        $t_retur += $d->total_retur;
                        $t_jual += $d->total_jual;
                        $t_mutasi += $d->total_mutasi;
                        $t_qtyakhir += $d->qty_akhir;
                        $t_hasilso += $d->hasil_so;
                        $t_selisih += $d->selisih;
                            } 
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                      
                            <td colspan="2" align="right"> <strong>Total :</strong> </td>
                            <td class="text-center"><strong><?= number_format($total_awal) ; ?></strong></td>
                            <td class="text-center"><strong><?= number_format($t_terima) ; ?></strong></td>
                            <td class="text-center"><strong><?= number_format($t_retur) ; ?></strong></td>
                            <td class="text-center"><strong><?= number_format($t_jual) ; ?></strong></td>
                            <td class="text-center"><strong><?= number_format($t_mutasi) ; ?></strong></td>
                            <td class="text-center"><strong><?= number_format($t_qtyakhir) ; ?></strong></td>
                            <td class="text-center"><strong><?= number_format($t_hasilso) ; ?></strong></td>
                            <td class="text-center"><strong><span class="btn btn-sm btn-<?= ($t_selisih < 0) ? 'danger' : '' ?>"><?= number_format($t_selisih) ; ?></span></strong></td>
                         
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
                  <p class="lead">Catatan SPG:</p>
                    <textarea class="form-control" readonly>
                      <?= $SO->catatan ?>
                    </textarea>
                </div>
                <!-- /.col -->
                <div class="col-8">
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
<div class="row no-print">
              <div class="col-12">
                <a href="<?= base_url('sup/So/detail/' . $SO->id_toko) ?>" class="btn btn-warning btn-sm <?= $this->session->userdata('role') != 1 ? "d-none" : "" ?> float-right" style="margin-right: 5px;"><i class="fas fa-edit"></i> Edit </a>
                <button onclick="goBack()" class="btn btn-danger btn-sm float-right mr-2"> <i class="fas fa-times-circle"></i> Kembali</button>
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

