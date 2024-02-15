<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="invoice p-3 mb-3">
          <div class="row">
            <div class="col-11">
                <h4>Selisih Penerimaan Barang</h4>
            </div>
            
            <div class="col-1 pull-right">
                <a href="<?= base_url('audit/selisih') ?>" class="btn btn-danger"><i class="fas fa-times"></i></a>
            </div>
          </div>
          <h5>No. Pengiriman : <strong><?= $permintaan->id_kirim ?></strong></h5>
          <hr>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    
                    <address>
                        Pengirim : <strong><?= $permintaan->nama_user ?></strong> <br>
                        Tgl. Pengiriman : <?= format_tanggal1($permintaan->tgl_kirim) ?><br>
                        Keterangan :<br><?= $permintaan->keterangan ?>
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
                    <h4>Status :
                        <strong>
                            <?php 
                                status_pengiriman($permintaan->status);
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
                      <th style="width:1%" class="text text-center">No</th>
                      <th style="width:5%" class="text text-center">Kode</th>
                      <th style="width:10%" class="text text-center">Nama Barang</th>
                      <th style="width:4%" class="text text-center">Satuan</th>
                      <th style="width:4%" class="text text-center">Qty Dikirim</th>
                      <th style="width:4%" class="text text-center">Qty Diterima</th>                  
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php
                        $no = 0;
                        $total_qty = 0;
                        foreach ($detail_selisih as $d) {
                        $no++;
                        $total = 0;
                    ?>
                        <tr>
                            <td class="text text-center"><?= $no ?></td>
                            <td>
                              <input type="hidden" name="id">
                              <input name="kode" style="border: 0px; background-color: transparent;" readonly="" disabled="" value="<?= $d->kode ?>">
                            </td>
                            <td>
                              <input name="nama_produk" style="border: 0px; background-color: transparent;" readonly="" disabled="" value="<?= $d->nama_produk?>">
                            </td>
                            <td>
                              <input name="satuan" style="border: 0px; background-color: transparent;" readonly="" disabled="" value="<?= $d->satuan?>">
                            </td>
                            
                            <td>
                              <input name="qty" style="border: 0px; background-color: transparent;" readonly="" disabled="" value="<?= $d->qty?>">
                            </td>
                            <td>
                              <input name="qty" style="border: 0px; background-color: transparent;" readonly="" disabled="" value="<?= $d->qty_diterima?>">
                            </td>  
                        </tr>
                    <?php 
                        } 
                    ?>                        
                    </tr>  
                  </tbody>
                </table>
              </div>
            </div>
            
        </div>
      </div>
    </div>    
  </div>
</section>