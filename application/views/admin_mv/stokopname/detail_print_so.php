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
                foreach ($so as $p) {
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
                    <th class="text-center"><h4><b>LAPORAN STOCK OPNAME TOKO</b></h4></th>
                   </tr>
                  </thead>
                </table>
                </div>
              </div>
              <!-- header form konsinyasi -->
              <div class="row">
                <div class="col-6">
                  <table class="table" style="border: 2px solid;" >
                    <tr>
                      <th style="border: 2px solid;" class="text-center">Tgl. Stok Opname : <?= format_tanggal1($p->created_at) ?></th>
                    </tr>
                   </table>
                   <table class="table" style="border: 2px solid;">
                    <tr>
                      <th style="border: 2px solid">No. SO</th>
                      <th style="border: 2px solid"> : </th>
                      <th style="border: 2px solid"><?= $p->id ?></th>
                    </tr>
                    <tr>
                    	<th style="border: 2px solid">Periode</th>
                    	<th style="border: 2px solid"> : </th>
                    	<th style="border: 2px solid"><?= format_tanggal1($p->tgl_so) . ' S/D ' . format_tanggal1($p->created_at) ?></th>
                    </tr>
                  </table>
                </div>
                <div class="col-6">
                  <table class="table " style="border: 2px solid;" >
                      <tr>
                        <th style="border: 2px solid" class="text-center">Toko </th>
                      </tr>
                      <tr>
                        <td style="border: 2px solid">
                        <strong><?= $p->nama_toko; ?> [ <?= $p->nama_user ?> ]</strong><br>
                        <address>
                        <?= $p->alamat; ?>
                        <br>
                        <br>
                        <?= $p->telp ?>
                        </address>
                        </td>
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
                      <th style="border: 2px solid; width: 10%;">Stok Awal</th>
                      <th style="border: 2px solid; width: 10%;">Hasil SO</th>
                      
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
                                <td style="border: 2px solid" class="text-center"><?= $d->qty_akhir ?> </td>
                                <td style="border: 2px solid" class="text-center"><?= $d->hasil_so ?> </td>
                            </tr>
                        <?php 
                            } 
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                      
                            <td style="border: 2px solid" colspan="5" align="right"> </td>
                            
                         
                        </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
              <!-- /.end table list isi -->

              <!-- footer untuk TTD  -->
              <hr style="border: 2px solid;">
              <div class="row">
              	<div class="col-md-12">
              		<div class="row text-center">
              			<div class="col-md-3">
              				Prepared By
              			</div>
              			<div class="col-md-3">
              				Acknowledged
              			</div>
              			<div class="col-md-6">
              				Approved By
              			</div>
              		</div>
              	</div>
              </div>
              <br>
              <br>
              <br>
              <br>
              <div class="row">
              	<div class="col-md-12">
              		<div class="row text-center">
              			<div class="col-md-3">
              				<strong><?= $p->nama_user ?></strong>
              				<hr>
              				<strong>SPG</strong>
              			</div>
              			<div class="col-md-3">
              				<strong>(........................................)</strong>
              				<hr>
              				<strong>Team Leader / SPV</strong>
              			</div>
              			<div class="col-md-3">
              				<strong>(...........................................)</strong>
              				<hr>
              				<strong>KA. Marketing Verification</strong>
              			</div>
              			<div class="col-md-3">
              				<strong>(...........................................)</strong>
              				<hr>
              				<strong>KA. Marketing</strong>
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
    

    
    
   


