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
                <a href="<?= base_url('sup/selisih') ?>" class="btn btn-danger"><i class="fas fa-times"></i></a>
            </div>
          </div>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <h5>No. Pengiriman : <strong><?= $permintaan->id_kirim ?></strong></h5>
                    <address>
                        Nama SPG : <strong><?= $permintaan->nama_user ?></strong> <br>
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
             <!-- Modal Edit Product-->
            <form action="<?= base_url('sup/selisih/proses_update')?>" method="POST">
              <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> <li class="fas fa-edit"></li> Update Selisih</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>No. Pengiriman</label>
                        <input type="text" name="id_kirim" class="form-control id" readonly="">
                      </div>  
                      <div class="form-group">
                        <label>No. Permintaan</label>
                        <input type="text" name="id_permintaan" class="form-control id_permintaan" readonly="">
                      </div>
                      <div class="form-group">
                        <label>Nama User</label>
                        <input type="text" class="form-control nama_user" name="nama_produk" readonly="">
                      </div>       
<!--                       <div class="form-group">
                        <label>Deskripsi</label>
                        <input type="text" class="form-control deskripsi" name="deskripsi" readonly="">
                      </div> -->
                      <div class="form-group">
                          <label>Catatan Selisih</label>
                          <textarea class="form-control" name="catatan" required=""></textarea>
                      </div>
                    </div>
                      <div class="modal-footer justify-content-between">
                        <button
                          type="button"
                          class="btn btn-danger"
                          data-dismiss="modal">
                          <li class="fas fa-times-circle"></li> Cancel
                        </button>
                        <input type="hidden" name="id" class="id">
                        <button type="submit" class="btn btn-primary">
                          <li class="fas fa-edit"></li> Update
                        </button>
                      </div>
                   
                    </div>
                </div>
                </div>
            </form>
            <!-- END EDIT MODAL -->
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width:1%" class="text text-center">No</th>
                      <th style="width:5%" class="text text-center">Kode</th>
                      <th style="width:10%" class="text text-center">Nama Barang</th>
                      <th style="width:4%" class="text text-center">Size</th>
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
                              <input name="size" style="border: 0px; background-color: transparent;" readonly="" disabled="" value="<?= $d->size?>">
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
            <form method="POST" action="<?= base_url('sup/permintaan/approve') ?>">
              <input type="hidden" name="id_permintaan" value="<?= $permintaan->id_kirim ?>">
              <?php 
              date_default_timezone_set('Asia/Jakarta');
              ?>
              <input type="hidden" name="updated" class="form-control"  readonly="readonly" value="<?php echo date('Y-m-d H:i:s'); ?>">     
            <div class="row no-print">
              <div class="col-12">
                <a href="" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                <div class="float-right">
                  <a href='#' class='btn btn-success btn-edit'  
                        data-id='<?= $permintaan->id_kirim ?>'
                        data-id_permintaan='<?= $permintaan->id_permintaan ?>'
                        data-nama_user='<?= $permintaan->nama_user ?>' 
                        data-deskripsi='<?= $permintaan->keterangan ?>' >
                        <i class='fas fa-check'></i> Approve</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>    
  </div>
</section>
<!-- jQuery -->
    <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
<script>
       $(document).ready(function(){
        // get Edit Product
        $('.btn-edit').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            const id_permintaan = $(this).data('id_permintaan');
            const nama_user = $(this).data('nama_user');
            const deskripsi = $(this).data('deskripsi');
            // Set data to Form Edit
            $('.id').val(id);
            $('.id_permintaan').val(id_permintaan);
            $('.nama_user').val(nama_user);
            $('.deskripsi').val(deskripsi);
            // Call Modal Edit
            $('#editModal').modal('show');
        });
       })
    </script>