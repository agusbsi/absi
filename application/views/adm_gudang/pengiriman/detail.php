
<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <?php
                foreach ($pengiriman as $p) {
            ?>                   
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              Status Data : <?= status_pengiriman($p->status); ?>
              <p>
              </p>
            </div> 
            <div id="printableArea">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <div class="row">
                <div class="col-md-5">
                <table  class="table table-bordered table-striped"   >
                  <thead>
                   <tr>
                    <th class="text-center "><h4><b>PT. VISTA MANDIRI GEMILANG</b></h4></th>
                   </tr>
                  </thead>
                </table>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-6">
                <table  class="table  table-striped" >
                  <thead>
                   <tr>
                    <th class="text-center"><h4><b>SURAT JALAN KONSINYASI</b></h4></th>
                   </tr>
                  </thead>
                </table>
                </div>
              </div>
              <!-- header form konsinyasi -->
              <div class="row">
                <div class="col-md-7">
                  <div class="row">
                    <div class="col-md-6 ">
                      <table class="table table-bordered table-striped" >
                        <tr>
                          <th  class="text-center">Dikirim dari :</th>
                        </tr>
                        <tr>
                          <td>
                            <strong>Gudang Garm Pusat</strong><br>
                            <address>
                            Jl. merdeka jakarta barat
                            </address>
                          </td>
                        </tr>
                      </table>
                    </div>
                    <div class="col-md-6">
                      <table class="table table-bordered table-striped "  >
                          <tr>
                            <th  class="text-center">Tujuan :</th>
                          </tr>
                          <tr>
                            <td >
                            <strong><?= $p->nama_toko; ?></strong><br>
                            Alamat :
                            <address>
                            <?= $p->alamat; ?>
                            </address>
                            </td>
                          </tr>
                        </table>
                    </div>
                  </div>
                </div>
                <div class="col-md-5">
                    <div class="row">
                     <div class="col-md-6">
                      <table class="table table-bordered table-striped  text-center"  >
                        
                        <tr>
                            <th> No Permintaan</th>
                          </tr>
                          <tr>
                            <th ><strong><?= $p->id_permintaan ?> </strong></th>
                          </tr>
                      </table>
                     </div>
                     <div class="col-md-6">
                      <table class="table table-bordered table-striped  text-center"  >
                          <tr>
                            <th >No Surat Jalan #</th>
                          </tr>
                          <tr>
                            <th ><strong><?= $p->id ?> </strong></th>
                          </tr>
                          
                        </table>
                     </div>
                    </div>
                    <table class="table table-bordered table-striped  text-center">
                      <tr>
                          <th >SPG :</th>
                          <th ><?= $p->spg ?></th>
                      </tr> 
                      <tr>
                          <th >Tanggal :</th>
                          <th ><?= $p->created_at; ?></th>
                      </tr> 
                    </table>
                </div>
              </div>
              <hr>
              <?php } ?>
              <!-- end header -->

              <!-- table list isi -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-bordered table-striped "  >
                    <thead>
                    <tr class="text-center" >
                      <th >No</th>
                      <th >Kode Artikel #</th>
                      <th >Deskripsi </th>
                      <th >Satuan</th>
                      <th >Qty Kirim</th>
                      <th >Qty Diterima</th>
                      
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                            $no = 0;
                            $total = 0;
                            $terima = 0;
                            foreach ($detail as $d) {
                            $no++; 
                        ?>
                            <tr>
                                <td ><?= $no ?></td>
                                <td><?= $d->kode ?></td>
                                <td><?= $d->nama_produk ?></td>
                                <td class="text-center"> <?= $d->satuan ?> </td>
                                <td class="text-right"><?= $d->qty ?></td>
                                <td class="text-right <?= ($d->qty != $d->qty_diterima && $p->status != 1) ? 'bg-danger' : '' ?>"><?= $d->qty_diterima ?></td>
                            </tr>
                        <?php 
                        $total += $d->qty;
                        $terima += $d->qty_diterima;
                            } 
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                      
                            <td  colspan="4" align="right"> <strong>Total</strong> </td>
                            <td  class="text-right"><b><?= $total ; ?></b></td>
                            <td  class="text-right"><b><?= $terima ; ?></b></td>
                            
                         
                        </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
              <!-- /.end table list isi -->
              <b>Noted:</b> Untuk Artikel yang jumlahnya = 0, maka secara otomatis tidak akan ditampilkan di list lagi.
              <!-- footer untuk TTD  -->
              <hr >
              <div class="row">
                <div class="col-md-3">
                  Catatan :
                <textarea name="" class="form-control"  readonly> <?= $p->keterangan ?></textarea>
                </div>
                <div class="col-md-9">
                  <div class="row text-center">
                    <div class="col-md-3">
                      Dibuat Oleh, <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <b><?= $p->nama_user ?></b>
                      <hr>
                      Bagian Gudang
                    </div>
                    <div class="col-md-3">
                      Disiapkan Oleh, <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <hr>
                      Bagian Pengiriman
                    </div>
                    <div class="col-md-3">
                      Disetujui Oleh, <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <hr>
                      (...........................)
                    </div>
                    <div class="col-md-3">
                      Diterima Oleh, <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <hr>
                      (...........................)
                    </div>
                  </div>
                </div>
              </div>
              <!-- end footer ttd -->
              <!-- this row will not appear when printing -->

                <div class="row no-print mt-5">
                  <div class="col-md-12">
                    <?php if(($p->status==0) or ($p->status==1)){ ?> 
                    <a href="<?=base_url('adm_gudang/pengiriman')?>" class="btn btn-danger float-right"><i class="fas fa-times-circle"></i> Close </a>
                    <a type="button" class="btn btn-default float-right <?= ($p->status != "1") ? 'd-none' : ''; ?>" target="_blank"  href="<?=base_url('adm_gudang/Pengiriman/detail_print/'.$p->id)?>" style="margin-right: 5px;"><i class="fa fa-print" aria-hidden="true"></i> </a>
                    <?php } else { ?>
                    <a href="<?=base_url('adm_gudang/pengiriman')?>" class="btn btn-danger float-right"><i class="fas fa-times-circle"></i> Close </a>
                      <?php } ?>
                  </div>
                </div>
           
            </div>
            <!-- /.invoice -->
            </div>
            <!-- end print area -->
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
   
    
    
    



