<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="invoice p-3 mb-3">
          <div class="row">
            <div class="col-11">
                <h4>Penjualan Barang</h4>
            </div>
            <div class="col-1 pull-right">
                <a href="<?= base_url('adm_mv/penjualan') ?>" class="btn btn-danger"><i class="fas fa-times"></i></a>
            </div>
          </div>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <h5>No. Penjualan : <strong><?= $permintaan->id_penjualan ?></strong></h5>
                    <address>
                        Nama SPG : <strong><?= $permintaan->username ?></strong> <br>
                        Tgl. Penjualan : <?= format_tanggal1($permintaan->tgl_penjualan) ?><br>
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    <h5> Nama Toko   : <strong><?= $permintaan->nama_toko ?></strong></h5>
                    <address>
                        Alamat Toko : <br>
                        <?= $permintaan->alamat ?>
                        <br>
                        No. Telp : <?= $permintaan->telp ?>
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                </div>
            </div>
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width:2%" class="text text-center">No</th>
                      <th style="width:5%" class="text text-center">Kode</th>
                      <th style="width:20%" class="text text-center">Nama Barang</th>
                      <th style="width:2%" class="text text-center">Satuan</th>
                      <th style="width:2%" class="text text-center">Qty</th>                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php
                        $no = 0;
                        $total_qty = 0;
                        foreach ($detail_permintaan as $d) {
                        $no++;
                        $total = 0;
                    ?>
                        <tr>
                            <td class="text text-center"><?= $no ?></td>
                            <td><?= $d->kode ?></td>
                            <td><?= $d->nama_produk?></td>
                            <td><?= $d->satuan?></td>
                            <td><?= $d->qty?></td>
                        </tr>
                    <?php 
                        } 
                    ?>                        
                    </tr>  
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row no-print">
              <div class="col-12">
                <a href="" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                <a href='javascript:history.go(-1)' type='button' class='btn btn-primary float-right'><i class='fa fa-step-backward' aria-hidden='true'></i> Kembali</a>
              </div>
            </div>
        </div>
      </div>
    </div>    
  </div>
</section>