<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form Packing List</title>
   <!-- Theme style -->
   <link rel="stylesheet" href="<?= base_url() ?>/assets/dist/css/adminlte.min.css">
</head>
<body>
  <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <?php
                foreach ($permintaan as $p) {
            ?>    
              <div id="printableArea">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <div class="row">
                <div class="col-md-12">
                  <table  class="table  table-striped" >
                    <thead>
                    <tr>
                      <th class="text-center"><h4><b> FORM PACKING LIST </b></h4></th>
                    </tr>
                    </thead>
                  </table>
                </div>
                <div class="col-md-2"></div>
              </div>
              <!-- header form konsinyasi -->
              <div class="row">
                <div class="col-md-6">
                  <table class="table" style="border: 1px solid;" >
                    <tr>
                      <td><strong>No Permintaan</strong></td>
                      <td>: <?= $p->id ?></td>
                    </tr>
                    <tr>
                      <td><strong>Tanggal PO</strong></td>
                      <td>: <?= $p->created_at ?></td>
                    </tr>
                  </table>
                </div>
                <div class="col-md-6">
                <table class="table" style="border: 1px solid;" >
                    <tr>
                      <td><strong>Tujuan</strong></td>
                      <td>: <?= $p->nama_toko ?></td>
                    </tr>
                    <tr>
                      <td><strong>Alamat</strong></td>
                      <td>: <?= $p->alamat ?></td>
                    </tr>
                  </table>
                </div>
              </div>
              <b>Note :</b> Jika ada barang yang jumlahnya tidak mencukupi dengan jumlah permintaan, segera koordinasi dengan Admin gudang dan ikuti petunjuknya.
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
                      <th style="border: 2px solid; width: 18%;">Kode Artikel#</th>
                      <th style="border: 2px solid; width: 25%;">Artikel</th>
                      <th style="border: 2px solid; width: 10%;">Satuan</th>
                      <th style="border: 2px solid; width: 10%;">Qty Permintaan</th>
                      <th style="border: 2px solid; width: 10%;">Qty</th>
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
                                <td style="border: 2px solid" class="text-center"><?= $d->qty_acc ?> </td>
                                <td style="border: 2px solid" class="text-center">....</td>
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
                <div class="col-md-4">
                  Catatan Jumlah Packing:
                  <textarea name="" class="form-control"  readonly></textarea>
                  <small>Wajib di isi !</small> <br>
                  <small>Contoh : Ada 8 karung</small>
                </div>
                <div class="col-md-8">
                  <div class="row text-center">
                    <div class="col-md-2">
                    
                    </div>
                    <div class="col-md-3">
                      Picker, <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <hr>
                      (............................)
                    </div>
                    <div class="col-md-4">
                      Disetujui oleh, <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <hr>
                      ( Penanggung Jawab Stok )
                    </div>
                    <div class="col-md-3">
                      Checker, <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <hr>
                      ( ......................... )
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
    

    
    
   


