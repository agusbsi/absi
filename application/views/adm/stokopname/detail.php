<section>
  <div class="container-fluid">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"><i class="nav-icon fas fa-box"></i> Detail Stok Opname</h3>
        <div class="card-tools">
          <a href="<?= base_url('adm/So') ?>" type="button" class="btn btn-tool" >
            <i class="fas fa-times"></i>
          </a>
        </div>
      </div>
      <div class="card-body">
      <form method="POST" action="<?= base_url('adm/So/approve') ?>">   
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>No SO :</label>
              <input type="text" class="form-control" name="id_so"  value="<?= $so->id ?>" readonly>
            </div>
            <div class="form-group">
              <label>Tanggal SO :</label>
              <input type="text" class="form-control" name="tgl_so"  value="<?= $so->created_at?>" readonly>
            </div>
          </div>
          <div class="col-md-4">
              <div class="form-group">
                <label>Nama Toko :</label>
                <input type="text" class="form-control" name="toko"  value="<?= $so->nama_toko ?>" readonly>
                <input type="hidden" class="form-control" name="id_toko"  value="<?= $so->id_toko ?>" readonly>
              </div>
              <div class="form-group">
                <label>Alamat Toko :</label> <br>
                <address>
                <?= $so->alamat ?>
                </address>
              </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Nama SPG :</label>
              <input type="text" class="form-control" name="spg"  value="<?= $so->nama_user ?>" readonly>
            </div>
            <div class="form-group">
              <label>Status :</label> <br>
              
            </div>
          </div>
        </div>
        <hr>
            <div class="row">
              <div class="col-md-12 table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width:1%" >#</th>
                      <th style="width:20%" >Kode Artikel #</th>
                      <th >Nama Artikel</th>
                      <th style="width:4%" >Satuan</th>
                      <th style="width:10%" >Stok Akhir</th>
                      <th style="width:10%" >SO SPG</th>
                      <th>Adjust</th>
                    </tr>
                  </thead>
                                 
                  <tbody>
                    <tr>
                    <?php
                        $no = 0;
                        $total_qty = 0;
                        $total_so = 0;
                        foreach ($list_data as $d) {
                        $no++;
                        $total = 0;
                    ?>
                        <tr>
                            <td class="text text-center"><?= $no ?></td>
                            <td>
                              <?= $d->kode ?>
                              <input type="hidden" name="id_produk[]" value="<?= $d->id_produk ?>">
                              <input type="hidden" name="id_detail[]" value="<?= $d->id ?>">
                            </td>
                            <td>
                              <?= $d->nama_produk?>
                            </td>
                            <td>
                              <?= $d->satuan?>
                            </td>
                            <td class="text-center">
                            <?= $d->qty?>
                            </td>
                            <td class="text-center">
                            <?= $d->qty_awal?>
                            </td>
                            <td class="text-center">
                              <input type="number" name="hasil_so[]" class="form-control hasil_so"  required>
                            </td>
                          
                        </tr>
                    <?php 
                     $total_qty += $d->qty;
                     $total_so += $d->qty_awal;
                        } 
                    ?>                        
                    </tr>  
                     <tr>
                         <td colspan="4" align="right"> <strong>Total :</strong> </td>
                         <td class="text-center"><strong><?= $total_qty ?></strong></td>
                         <td class="text-center"><strong><?= $total_so ?></strong></td>
                         <td></td>
                     </tr>
                  </tbody>
                </table>
                <hr>
                
              </div>
            </div>
              <?php date_default_timezone_set('Asia/Jakarta'); ?>
              <input type="hidden" name="updated" class="form-control"  readonly="readonly" value="<?php echo date('Y-m-d H:i:s'); ?>">     
          
      </div>
      <div class="card-footer">
                <?php 
                  if($so->status==0){
                    echo "<button type='submit' class='btn btn-success float-right'><i class='fa fa-check-circle' aria-hidden='true'></i> Adjust</button>";
                    echo "<a href=".base_url('adm/So')." class='btn btn-danger float-right mr-3'><i class='fa fa-step-backward' aria-hidden='true'></i> Cancel</a>";
                  }else{
                    echo "<a href=".base_url('adm/So')." class='btn btn-primary float-right'><i class='fa fa-step-backward' aria-hidden='true'></i> Kembali</a>"; 
                }
                ?>
      </div>
      </form>
    </div>   
  </div>
</section>

