<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="invoice p-3 mb-3">
          <div class="row">
            <div class="col-11">
              <h4>Retur Barang</h4>
            </div>
          </div>
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              <h5>No. Permintaan : <strong><?= $retur->id_retur ?></strong></h5>
              <address>
                Nama SPG : <strong><?= $retur->username ?></strong> <br>
                Tgl. Permintaan : <?= format_tanggal1($retur->tgl_retur) ?><br>

              </address>
            </div>
            <div class="col-sm-4 invoice-col">
              <h5> Nama Toko : <strong><?= $retur->nama_toko ?></strong></h5>
              <address>
                Alamat Toko : <br>
                <?= $retur->alamat ?>
                <br>
                No. Telp : <?= $retur->telp ?>
              </address>
            </div>
            <div class="col-sm-4 invoice-col">
              <h4>Status :
                <strong>
                  <?php
                  status_retur($retur->status);
                  ?>
                </strong>
              </h4>
            </div>
          </div>
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="width:2%" class="text text-center">No</th>
                    <th style="width:10%" class="text text-center">Kode</th>
                    <th style="width:20%" class="text text-center">Nama Barang</th>
                    <th style="width:2%" class="text text-center">Satuan</th>
                    <th style="width:2%" class="text text-center">Qty</th>
                    <th style="width:10%" class="text text-center">Foto</th>
                    <th style="width:10%" class="text text-center">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php
                    $no = 0;
                    $total_qty = 0;
                    foreach ($detail_retur as $d) {
                      $no++;
                      $total = 0;
                    ?>
                  <tr>
                    <td class="text text-center"><?= $no ?></td>
                    <td><?= $d->kode ?></td>
                    <td><?= $d->nama_produk ?></td>
                    <td><?= $d->satuan ?></td>
                    <td><?= $d->qty ?></td>
                    <td><img class="img-rounded" style="width: 20%" src="<?= base_url('assets/img/retur/' . $d->foto) ?>" alt="User Image"></td>
                    <td></td>
                  </tr>
                <?php
                    }
                ?>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
          <form method="POST" action="<?= base_url('adm_mv/retur/approve') ?>">
            <input type="hidden" name="id_retur" value="<?= $retur->id_retur ?>">
            <?php
            date_default_timezone_set('Asia/Jakarta');
            ?>
            <input type="hidden" name="updated" class="form-control" readonly="readonly" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <div class="row no-print">
              <div class="col-12">
                <a href="javascript:history.go(-1)" type="button" class="btn btn-sm btn-primary float-right"><i class="fa fa-step-backward"></i> Kembali</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>