<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12"> 
           <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              <div class="row">
                <div class="col-md-6">
                 Berita Acara Penerimaan
                </div>
                <div class="col-md-6">
                  Status : <?= status_bap($bap->status) ?>
                </div>
              </div>
           </div>

            <!-- print area -->
            <div id="printableArea">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
              <h4><li class="fas fa-file-alt"></li> DETAIL B.A.P</h4>
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  Dari :
                  <address>
                    <strong><?= $bap->nama_toko; ?></strong><br>
                    <?= $bap->alamat; ?> <br>
                    Phone: ( <?= $bap->telp; ?> )<br>
                 
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  No KIRIM:
                  <address>
                    <strong><?= $bap->id_kirim ?> </strong><br>
                    <strong></strong>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Spg :<br>
                
                  <b>[ <?= $bap->spg ?> ] </b> <br>
                 <br>
                  Tanggal: <b> <?= $bap->created_at; ?></b> 
                </div>
                <!-- /.col -->
                
              </div>
              <!-- /.row -->
              <hr>
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
                      <th>QTY (Awal)</th>
                      <th>QTY (Update)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                            $no = 0;
                            $total = 0;
                            foreach ($detail_bap as $d) {
                            $no++; 
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $d->kode_produk ?></td>
                                <td><?= $d->nama_produk ?></td>
                                <td><?= $d->satuan ?></td>
                                <td ><?= $d->qty_awal ?></td>
                                <td><?= $d->qty_update ?></td>
                            </tr>
                        <?php 
                            } 
                        ?>
                    </tbody>
                   
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-md-6">
                  <p class="lead">Catatan SPG:</p>
                    <textarea col="1" row="3" class="form-control" readonly><?= $bap->catatan ?></textarea>
                </div>
                <div class="col-md-6">
                </div>
              </div>
              <hr>
              <div class="row">
              
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="Catatan Leader:">Catatan Leader:</label>
                    <?php if ($bap->status == 0) { ?>
                    <textarea name="catatan_leader" col="1" row="3" class="form-control cat_leader" placeholder="Masukan catatan ....." required></textarea>
                    <?php }else {?>
                      <textarea  col="1" row="3" class="form-control "  readonly><?= $bap->catatan_leader ?></textarea>
                    <?php } ?>
                  </div>
                </div>
                
                <div class="col-md-6">
                </div>
              </div>
                <hr>
              <!-- this row will not appear when printing -->
              <?php if ($bap->status == 0) { ?>
              <div class="row no-print">
             
                <div class="col-12">
                <a type="button" onclick="printDiv('printableArea')" target="_blank" class="btn btn-default float-right" style="margin-right: 5px;">
                <i class="fas fa-print"></i> Print </a> 
              
                <a  data-id="<?= $bap->id?>" class="btn btn-danger float-right btn_tolak" style="margin-right: 5px;"><i class="fas fa-times-circle"></i> Tolak </a>
                
                <a data-id="<?= $bap->id?>" class="btn btn-success float-right btn_approve" style="margin-right: 5px;"><i class="fas fa-check"></i> Approve </a>
                </div>
              </div>
            <?php }else{ ?>
              <div class="row no-print">
                <div class="col-12">
                <a href="<?= base_url('leader/Bap') ?>" class="btn btn-danger float-right"> <i class="fas fa-times-circle"></i> Close</a> 
                
                <a type="button" onclick="printDiv('printableArea')" target="_blank" class="btn btn-default float-right" style="margin-right: 5px;">
                <i class="fas fa-print"></i> Print </a>
                </div>
              </div>
            <?php } ?>
            </div>
            </div>
            <!-- end print area -->
          
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <script>
      // fungsi btn reject
      $('.btn_approve').click(function(){
        var id = $(this).data('id');
        var cat_leader = $('.cat_leader').val();
        if (cat_leader == '') {
          Swal.fire({
                        title: 'Peringatan',
                        text: "Harap masukan catatan terlebih dahulu !",
                        icon: "info",
                      })
        }else {
        // proses update ke controller
        $.ajax({
                    url: "<?=base_url('leader/Bap/approve/')?>",
                    dataType: 'text',
                    type  : 'get',
                    data: {id:id,cat_leader:cat_leader},
                    success: function(){
                      // 
                      Swal.fire({
                        title: 'Berhasil',
                        text: "Pengajuan B.A.P telah disetujui dan menunggu approve MV",
                        icon: "success",
                      }).then((result) => {
                        if(result){
                          // Do Stuff here for success
                          location.reload();
                        }else{
                          // something other stuff
                        }

                      })
                  // end sweetalert
                    }
                });
          // end proses
        }
        // end if 
      });
      // end btn reject
      // fungsi btn reject
      $('.btn_tolak').click(function(){
        var id = $(this).data('id');
        var cat_leader = $('.cat_leader').val();
        if (cat_leader == '') {
          Swal.fire({
                        title: 'Peringatan',
                        text: "Harap masukan catatan terlebih dahulu !",
                        icon: "info",
                      })
        }else {
        // proses update ke controller
        $.ajax({
                    url: "<?=base_url('leader/Bap/tolak/')?>",
                    dataType: 'text',
                    type  : 'get',
                    data: {id:id,cat_leader:cat_leader},
                    success: function(){
                      // 
                      Swal.fire({
                        title: 'Berhasil',
                        text: "Pengajuan B.A.P telah ditolak",
                        icon: "success",
                      }).then((result) => {
                        if(result){
                          // Do Stuff here for success
                          location.reload();
                        }else{
                          // something other stuff
                        }

                      })
                  // end sweetalert
                    }
                });
          // end proses
        }
        // end if 
      });
      // end btn reject
      function printDiv(divName) {
          var printContents = document.getElementById(divName).innerHTML;
          var originalContents = document.body.innerHTML;
          document.body.innerHTML = printContents;
          window.print();
          document.body.innerHTML = originalContents;
      }
    </script>

