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
            <?php
                foreach ($pengiriman as $p) {
            ?>    
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
                      <table class="table" style="border: 2px solid;" >
                        <tr>
                          <th style="border: 2px solid;" class="text-center">Dikirim dari :</th>
                        </tr>
                        <tr>
                          <td style="border: 2px solid; height: 167px;">
                            <strong>Gudang Garm Pusat</strong><br>
                            <address>
                            Jl. merdeka jakarta barat
                            </address>
                          </td>
                        </tr>
                      </table>
                    </div>
                    <div class="col-md-6">
                      <table class="table " style="border: 2px solid;" >
                          <tr>
                            <th style="border: 2px solid;" class="text-center">Tujuan :</th>
                          </tr>
                          <tr>
                            <td style="border: 2px solid; height: 167px;">
                            <strong><?= $p->nama_toko; ?></strong><br>
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
                      <table class="table   text-center" style="border: 2px solid" >
                        
                        <tr>
                            <th> No Permintaan</th>
                          </tr>
                          <tr>
                            <th ><strong><?= $p->id_permintaan ?> </strong></th>
                          </tr>
                      </table>
                     </div>
                     <div class="col-md-6">
                      <table class="table   text-center" style="border: 2px solid" >
                          <tr>
                            <th >No Surat Jalan #</th>
                          </tr>
                          <tr>
                            <th ><strong><?= $p->id ?> </strong></th>
                          </tr>
                          
                        </table>
                     </div>
                    </div>
                    <table class="table" style="border: 2px solid">
                      <tr>
                          <th >Nama SPG </th>
                          <th > : <?= $p->spg ?></th>
                      </tr> 
                      <tr>
                          <th >Tanggal</th>
                          <th > : <?= $p->created_at; ?></th>
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
                  <table class="table  " style="border: 2px solid;" >
                    <thead>
                    <tr class="text-center" >
                      <th style="border: 2px solid; width: 5%;">No</th>
                      <th style="border: 2px solid; width: 20%;">Kode #</th>
                      <th style="border: 2px solid; width: 40%;">Artikel</th>
                      <th style="border: 2px solid; width: 10%;">Satuan</th>
                      
                      
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                            $no = 0;
                            $total = 0;
                            foreach ($detail as $d) {
                            $no++; 
                        ?>
                            <tr>
                                <td style="border: 2px solid"><?= $no ?></td>
                                <td style="border: 2px solid"><?= $d->kode ?></td>
                                <td style="border: 2px solid"><?= $d->nama_produk ?></td>
                                <td style="border: 2px solid" class="text-center"><?= $d->satuan ?> </td>
                            
                            </tr>
                        <?php 
                       
                            } 
                        ?>
                    </tbody>
                   
                  </table>
                </div>
              </div>
              <!-- /.end table list isi -->

              <!-- footer untuk TTD  -->
              <hr style="border: 2px solid;">
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
                      Disiapkan oleh, <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <hr>
                      Bagian Pengiriman
                    </div>
                    <div class="col-md-3">
                      Disetujui oleh, <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <hr>
                      ( Kepala Gudang )
                    </div>
                    <div class="col-md-3">
                      Diterima oleh, <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <hr>
                      ( <?= $p->spg ?> )
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
    

    
    
   


