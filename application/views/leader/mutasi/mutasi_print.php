<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Print detail Pengiriman</title>
   <!-- Theme style -->
   <link rel="stylesheet" href="<?= base_url() ?>/assets/dist/css/adminlte.min.css">
</head>
<body>
  <div class="container-fluid">
        <div class="row">
          <div class="col-12">  
              <div id="printableArea">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <div class="row">
                <div class="col-md-5">
                <table  class="table " style="border: 3px solid;"  >
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
                    <th class="text-center"><h4><b>Surat Jalan Mutasi Barang</b></h4></th>
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
                      <table class="table" style="border: 2px solid;" >
                        <tr>
                          <th style="border: 2px solid;" class="text-center">Toko Asal :</th>
                        </tr>
                        <tr>
                          <td>
                            <strong><?= $mutasi->asal ?></strong><br>
                            <address>
                            <?= $mutasi->alamat_asal ?>
                            </address>
                          </td>
                        </tr>
                      </table>
                    </div>
                    <div class="col-md-6">
                      <table class="table " style="border: 2px solid;" >
                          <tr>
                            <th style="border: 2px solid" class="text-center">Toko Tujuan :</th>
                          </tr>
                          <tr>
                            <td style="border: 2px solid">
                            <strong> <?= $mutasi->tujuan ?> </strong><br>
                            <address>
                            <?= $mutasi->alamat_tujuan ?>
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
                      <table class="table   text-center" style="border: 2px solid" >
                        
                        <tr>
                            <th> No Mutasi</th>
                          </tr>
                          <tr>
                            <th ><strong><?= $mutasi->id ?> </strong></th>
                          </tr>
                      </table>
                     </div>
                     <div class="col-md-6">
                      <table class="table   text-center" style="border: 2px solid" >
                          <tr>
                            <th >No Surat Jalan #</th>
                          </tr>
                          <tr>
                            <th ><strong><?= $mutasi->id ?> </strong></th>
                          </tr>
                          
                        </table>
                     </div>
                    </div>
                    <table class="table  text-center" style="border: 2px solid">
                      <tr>
                          <th >Tanggal :</th>
                          <th ><?= date('D,d-M-Y') ?></th>
                      </tr> 
                    </table>
                </div>
              </div>
              <hr>
              <!-- end header -->

              <!-- table list isi -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table  " style="border: 2px solid;" >
                    <thead>
                    <tr class="text-center" >
                      <th style="border: 2px solid; width: 5%;">No</th>
                      <th style="border: 2px solid; width: 20%;">Kode #</th>
                      <th style="border: 2px solid; width: 40%;">Artikel</th>
                      <th style="border: 2px solid; width: 10%;">Satuan</th>
                      <th style="border: 2px solid; width: 10%;">Qty</th>
                      
                      
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                            $no = 0;
                            $total = 0;
                            foreach ($detail_mutasi as $d) {
                            $no++; 
                        ?>
                            <tr>
                                <td style="border: 2px solid"><?= $no ?></td>
                                <td style="border: 2px solid"><?= $d->kode ?></td>
                                <td style="border: 2px solid"><?= $d->nama_produk ?></td>
                                <td style="border: 2px solid" class="text-center"><?= $d->satuan ?> </td>
                                <td style="border: 2px solid" class="text-right"><?= $d->qty ?></td>
                            </tr>
                        <?php 
                       $total += $d->qty;
                            } 
                        ?>
                        <tfoot>
                          <tr>
                            <td style="border: 2px solid" colspan="4" class="text-right">Total :</td>
                            <td style="border: 2px solid" class="text-right"><strong><?= $total ?></strong></td>
                          </tr>
                        </tfoot>
                    </tbody>
                   
                  </table>
                </div>
              </div>
              <!-- /.end table list isi -->

              <!-- footer untuk TTD  -->
              <hr style="border: 2px solid;">
              <div class="row">
                <div class="col-md-3">
                 
                </div>
                <div class="col-md-9">
                  <div class="row text-center">
                    <div class="col-md-3">
                      Dibuat Oleh, <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <b><?= $mutasi->leader ?></b>
                      <hr>
                      Tim Leader
                    </div>
                    <div class="col-md-3">
                      Disetujui oleh, <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <hr>
                      Marketing Verifikasi
                    </div>
                    <div class="col-md-3">
                      Dikirim oleh, <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <hr>
                      (Bagian Pengiriman)
                    </div>
                    <div class="col-md-3">
                      Diterima oleh, <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <hr>
                      ( .................... )
                    </div>
                  </div>
                </div>
              </div>

             
            </div>
            <!-- /.invoice -->
        </div>
        <!-- end print area -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
    <script>
      window.print();
    </script>
</body>
</html>
    

    
    
   


