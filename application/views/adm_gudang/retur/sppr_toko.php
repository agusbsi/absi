<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SURAT PERINTAH PENGAMBILAN RETUR</title>
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/dist/css/adminlte.min.css">
  <style>
    table,
    td,
    th {
      border: 1px solid black;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th {
      height: 5px;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

        <div id="printableArea">
          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <table>
              <tr>
                <td rowspan="4" class="text-center" style="width:15%;">
                  <img style="width: 60%" src="<?= base_url('assets/img/vista.png') ?>" alt="User profile picture">
                </td>
                <td rowspan="2" class="text-center"><b>FORM</b></td>
                <td style="width:15%;">No Dok</td>
                <td style="width:20%;">: FM-12-01</td>
              </tr>
              <tr>
                <td style="width:15%;">Tgl Efektif</td>
                <td style="width:20%;">: 01/09/2020</td>
              </tr>

              <tr>
                <td rowspan="2" class="text-center"><b>SURAT PERINTAH PENGAMBILAN RETUR</b></td>
                <td style="width:15%;">Revisi</td>
                <td style="width:20%;">: 0</td>
              </tr>
              <tr>
                <td style="width:15%;">Hal</td>
                <td style="width:20%;">: page of </td>
              </tr>
            </table>
            <br>
            <br>
            <!-- header form konsinyasi -->
            <div class="row">
              <div class="col-md-7">
                <div class="row">
                  <div class="col-md-3">
                    Tanggal
                  </div>
                  <div class="col-md-9">
                    <label for="">: <?= $retur->created_at ?></label>
                  </div>
                  <div class="col-md-3">
                    Dari Toko
                  </div>
                  <div class="col-md-9">
                    <label for="">: <?= $retur->nama_toko ?></label>
                  </div>
                </div>
              </div>
              <div class="col-md-5">
                <div class="row">
                  <div class="col-md-6">
                    Target Date
                  </div>
                  <div class="col-md-6">
                    <label for=""><u>: <?= $retur->tgl_jemput ?></u></label>
                  </div>
                  <div class="col-md-6">
                    SPG Toko
                  </div>
                  <div class="col-md-6">
                    <label for="">: <?= $retur->spg ?></label>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-7">
                <div class="row">
                  <div class="col-md-3">
                    Ke Toko / DC
                  </div>
                  <div class="col-md-9">
                    <label for="">: GUDANG PREPEDAN</label>
                  </div>
                  <div class="col-md-3">
                    No Retur
                  </div>
                  <div class="col-md-9">
                    <label for="">: <?= $retur->id ?></label>
                  </div>
                </div>
              </div>
              <div class="col-md-5">
                <div class="row">
                  <div class="col-md-6">
                    Leader
                  </div>
                  <div class="col-md-6">
                    <label for="">: <?= $retur->leader ?></label>
                  </div>
                  <div class="col-md-6">
                    No telp. <br>
                    <p><b>Tanggal Penarikan</b></p>
                  </div>
                  <div class="col-md-6">
                    : <br>
                    <b>: ..........................</b>
                  </div>
                </div>
              </div>
            </div>

            <hr>

            <!-- end header -->

            <!-- table list isi -->
            <div class="row">
              <div class="col-12 table-responsive">
                <table style="border: 2px solid;">

                  <tbody>
                    <tr>
                      <td colspan="6" class="text-center"><b>LIST ASET</b></td>
                    </tr>
                    <tr class="text-center">
                      <th style="border: 2px solid; width: 4%;">No</th>
                      <th style="border: 2px solid; width: 17%;">Kode Aset#</th>
                      <th style="border: 2px solid; width: 35%;">Nama Aset</th>
                      <th style="border: 2px solid; width: 4%;">jumlah</th>
                      <th style="border: 2px solid;">Kondisi</th>
                      <th style="border: 2px solid;">Keterangan</th>
                    </tr>
                    <?php
                    $no = 0;
                    $total = 0;
                    foreach ($aset as $d) {
                      $no++;
                    ?>
                      <tr>
                        <td style="border: 2px solid" class="text-center"><?= $no ?></td>
                        <td style="border: 2px solid"><?= $d->id_aset ?></td>
                        <td style="border: 2px solid"><?= $d->nama_aset ?></td>
                        <td style="border: 2px solid" class="text-center"><?= $d->qty ?> </td>
                        <td style="border: 2px solid" class="text-center"><?= $d->kondisi ?> </td>
                        <td style="border: 2px solid">
                          <address><?= $d->keterangan ?></address>
                        </td>
                      </tr>
                    <?php
                      $total += $d->qty;
                    }
                    ?>
                    <tr>
                      <td colspan="3" class="text-right"><b>Total :</b></td>
                      <td class="text-center"><b><?= $total; ?></b></td>
                    </tr>
                  </tbody>

                </table>
              </div>
            </div>
            <!-- /.end table list isi -->
            <hr>
            <!-- table list isi -->
            <div class="row">
              <div class="col-12 table-responsive">
                <table style="border: 2px solid;">

                  <tbody>
                    <tr>
                      <td colspan="6" class="text-center"><b>LIST ARTIKEL</b></td>
                    </tr>
                    <tr class="text-center">
                      <th style="border: 2px solid; width: 4%;">No</th>
                      <th style="border: 2px solid; width: 17%;">Kode Artikel#</th>
                      <th style="border: 2px solid; width: 35%;">Artikel</th>
                      <th style="border: 2px solid; width: 4%;">Satuan</th>
                      <th style="border: 2px solid; width: 4%;">Jumlah</th>
                      <th style="border: 2px solid;">Keterangan</th>
                    </tr>
                    <?php
                    $no = 0;
                    $total = 0;
                    foreach ($artikel as $d) {
                      $no++;
                    ?>
                      <tr>
                        <td style="border: 2px solid" class="text-center"><?= $no ?></td>
                        <td style="border: 2px solid"><?= $d->kode ?></td>
                        <td style="border: 2px solid"><?= $d->nama_produk ?></td>
                        <td style="border: 2px solid" class="text-center"><?= $d->satuan ?> </td>
                        <td style="border: 2px solid" class="text-center"><?= $d->qty ?> </td>
                        <td style="border: 2px solid">
                          <address><?= $d->keterangan ?></address>
                        </td>
                      </tr>
                    <?php
                      $total += $d->qty;
                    }
                    ?>
                    <tr>
                      <td colspan="4" class="text-right"><b>Total :</b></td>
                      <td class="text-center"><b><?= $total; ?></b></td>
                    </tr>
                  </tbody>

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
                    Dibuat Oleh, <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <hr>
                    ( Marketing Verifikasi )
                  </div>
                  <div class="col-md-3">
                    Mengetahui, <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <hr>
                    ( Manager Marketing)
                  </div>
                  <div class="col-md-3">
                    Mengetahui, <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <hr>
                    ( Kepala Gudang )
                  </div>
                  <div class="col-md-3">
                    Diambil Oleh, <br>
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
          <span style="align:center">*) Form SPPR ini dibuat oleh : Aplikasi ABSI.</span>
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