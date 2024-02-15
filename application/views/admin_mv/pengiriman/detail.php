<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="invoice p-3 mb-3">
          <div class="row">
            <div class="col-11">
                <h4>Pengiriman Barang</h4>
            </div>
            <div class="col-1 pull-right">
                <a href="<?= base_url('adm_mv/Pengiriman') ?>" class="btn btn-danger"><i class="fas fa-times"></i></a>
            </div>
            
          </div>
          <hr>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <h5>No. Pengiriman : <strong><?= $Pengiriman->id ?></strong></h5> 
                    <h5>No. Permintaan : <strong><a href="<?= base_url('adm_mv/permintaan/detail/'.$Pengiriman->id_permintaan) ?>"> <?= $Pengiriman->id_permintaan ?> </a></strong></h5>
                    <address>
                        Nama Pengirim : <strong><?= $Pengiriman->nama_user ?></strong> <br>
                        Tgl. Permintaan : <?= format_tanggal1($Pengiriman->created_at) ?><br>

                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    <h5> Nama Toko   : <strong><?= $Pengiriman->nama_toko ?></strong></h5>
                    <address>
                        Alamat : <br>
                        <?= $Pengiriman->alamat ?>
                        <br>
                        No. Telp : <?= $Pengiriman->telp ?>
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    <h4>Status :
                        <strong>
                            <?php 
                                status_pengiriman($Pengiriman->status);
                            ?>
                        </strong>
                    </h4>
                </div>
            </div>
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-bordered table-striped" id="myTable">
                  <thead>
                    <tr>
                      <th style="width:1%" >No</th>
                      <th style="width: 15%">Kode Artikel #</th>
                      <th>Nama Artikel</th>
                      <th style="width: 8%">Satuan</th>
                      <th style="width: 8%" class="text-center">Qty Kirim</th>
                      <th style="width: 12%" class="text-center">Harga</th>
                      <th style="width: 15%" class="text-center">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php
                        $no = 0;
                        $total_qty = 0;
                        $grandtotal = 0;
                        foreach ($detail_kirim as $d) {
                        $no++;
                        $total = 0;
                        $hrg_produk = 0;
                        $qty_barang = $d->qty;
                        if ($d->het != 1) {
                          $hrg_produk = $d->het_indobarat;
                        }else{
                          $hrg_produk = $d->het_jawa;
                        }
                        $total = $hrg_produk*$qty_barang;
                        $total_qty += $qty_barang;
                        $grandtotal += $total;
                    ?>
                        <tr>
                            <td class="text text-center"><?= $no ?></td>
                            <td><?= $d->kode ?></td>
                            <td><?= $d->nama_produk?></td>
                            <td class="text-center"><?= $d->satuan?></td>
                            <td class="text-center"><?= $d->qty; ?></td>
                            <td class="text-center">
                              <?= format_rupiah($hrg_produk); ?>
                            </td>
                            <td class="text-center">
                              <?= format_rupiah($total); ?>
                            </td>
                        </tr>
                    <?php 
                    $total_qty += $d->qty; 
                        } 
                    ?>                        
                    </tr>  
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="4" class="text-right"><strong>Total Qty :</strong></td>
                      <td class="text-center"><?= $total_qty; ?></td>
                      <td class="text-right"><strong>Grandtotal</strong></td>
                      <td class="text-center"><strong><?= format_rupiah($grandtotal); ?></strong></td>
                    </tr>
                  </tfoot>
                </table>
                <b>Noted:</b> Untuk Artikel yang jumlahnya = 0, maka secara otomatis tidak akan ditampilkan di list lagi.
                <hr>
              </div>
            </div>
            <form method="POST" action="<?= base_url('adm_mv/Pengiriman/approve') ?>">
              <input type="hidden" name="id_kirim" value="<?= $Pengiriman->id ?>">
              <?php 
              date_default_timezone_set('Asia/Jakarta');
              ?>
              <input type="hidden" name="updated" class="form-control"  readonly="readonly" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <div class="row no-print">
              <div class="col-12">
                
                <?php 
                  if($Pengiriman->status==0){
                    echo "<button type='submit' class='btn btn-success float-right'><i class='fa fa-check' aria-hidden='true'></i>Approve</button>";
                  }else if($Pengiriman->status==1){
                    echo "<a href='javascript:history.go(-1)' type='button' class='btn btn-primary float-right'><i class='fa fa-step-backward' aria-hidden='true'></i> Kembali</a>";
                  }else if($Pengiriman->status==2){
                    echo "<a href='javascript:history.go(-1)' type='button' class='btn btn-primary float-right'><i class='fa fa-step-backward' aria-hidden='true'></i> Kembali</a>"; 
                  }else{
                    echo "<s<a href='javascript:history.go(-1)' type='button' class='btn btn-primary float-right'><i class='fa fa-step-backward' aria-hidden='true'></i> Kembali</a>"; 
                }
                ?>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>    
  </div>
</section>