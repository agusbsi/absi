<!-- Main content -->
<section class="content">
<div id="content" >
    <div class="row">
        <div class="col-md-12">
            <div class="card card-row card-info">
                <div class="card-header">
                    <h3 class="card-title">
                    <li class="fa fa-list"></li> Tambah Data Pengiriman
                    </h3>
                    <div class="card-tools">
                        <a href="<?= base_url('adm_gudang/Permintaan') ?>" type="button" class="btn btn-tool" >
                        <i class="fas fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Master -->
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title"><li class="fas fa-truck"></li> <strong>Master Pengiriman</strong> </h3>
                            
                        </div>
                        <!-- /.card-header -->
                    
                        <div class="card-body">                         
                            <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                <label>No Pengiriman :</label>
                                <input type="text" class="form-control" name="kode_kirim"  value="<?= $kode_kirim ?>" readonly>
                                </div>
                                <div class="form-group">
                                <label>No Permintaan :</label>
                                <input type="text" class="form-control" name="no_permintaan"  value="<?= $permintaan->id ?>" readonly>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-1"></div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <div class="form-group">
                                <label>Tujuan :</label>
                                <input type="text" class="form-control" name="toko"  value="<?= $permintaan->nama_toko ?>" readonly>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                <label>Alamat :</label><br>
                                <address>
                                <?= $permintaan->alamat ?>
                                </address>
                                
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <label>Tgl Permintaan :</label> <br>
                                <?= $permintaan->created_at ?>
                                </div>
                                <div class="form-group">
                                <label >Catatan MV :</label> <br>
                                <address >
                                <?= $permintaan->keterangan ?>
                                </address>
                                </div>
                                <!-- /.form-group -->
                               
                            </div>
                            <!-- /.col -->
                            </div>
                            <!-- /.row -->
                             
                        </div>
                        <!-- /.card-body -->
                    
                    </div>
                    <!-- /.card -->
                    <!-- List -->
                    <!-- detail barang -->
                    <div id="rincian">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title"> <li class="fas fa-cube"></li> <strong>List Barang</strong> </h3>
                        </div>
                    <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                            <div class="col-md-12">
                                <!-- isi konten -->
                                <form id="form_qty">
                                    <table class="table table-bordered table-striped table-responsive">
                                    <thead>
                                    <tr class="text-center">
                                        <th style="width: 20px;">No</th>
                                        <th style="width: 20%;">Kode Artikel #</th>
                                        <th style="width: 40%;">Nama Barang</th>
                                        <th>Qty Permintaan</th>
                                        <th>Qty Sudah Dikirim</th>
                                        <th>Qty Akan Dikirim</th>
                                    
                                    </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $no = 0;
                                      foreach($detail as $d):
                                        $no++
                                      ?>
                                      <tr>
                                        <td><?= $no ?></td>
                                        <td><?=$d->kode ?></td>
                                        <td><?=$d->nama_produk ?></td>
                                        <td class="text-center"><?=$d->qty_acc ?></td>
                                        <td class="text-center"><?=$d->qty_dikirim ?></td>
                                        <td class="text-center">
                                          <input type="hidden" class="form-control" name="id_permintaan" value="<?= $d->id_permintaan ?>">
                                          <input type="hidden" class="form-control" name="id_toko" value="<?= $d->id_toko ?>">
                                          <input type="hidden" class="form-control" name="id_detail[]" value="<?= $d->id ?>">
                                          <input type="hidden" class="form-control" name="id_produk[]" value="<?= $d->id_produk ?>">
                                          <input type="number" class="form-control" name="qty_input[]" min="0" value="0"  required>
                                        </td>
                                      </tr>
                                      <?php endforeach ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                    <td colspan="6">
                                    <b>Noted:</b> Untuk Artikel yang jumlahnya = 0, maka secara otomatis tidak akan ditampilkan di list lagi.
                                    </td>
                                    </tr>
                                    </tfoot>
                                    </table>
                            
                            </div>
                        
                            </div>
                            <!-- /.row -->
                            <div class="row">
                               <div class="col-md-4">
                                Catatan : <br>
                                <textarea name="catatan" class="form-control"  cols="1" rows="3" placeholder="cth: ada 8 koli/box/karung" required></textarea>
                                <small>Wajib di isi | untuk keterangan jumlah packing</small>
                               </div>
                                
                                <div class="col-sm-8 ">
                                <div class="float-right form-group">
                                    <label>Admin Gudang :</label> 
                                    <br>
                                    <br>
                                    <br>
                                    <?= $this->session->userdata('nama_user'); ?>
                                </div>
                                </div>
                            </div>
                        </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    </div>
                    <!-- end rincian -->
                </div>
                <div class="card-footer " id="footer" >
                    <div class="float-right">
                    <a href="<?= base_url('adm_gudang/Permintaan') ?>" class="btn btn-danger"><li class="fa fa-times-circle"></li> Cancel</a>
                    <button type="button" class="btn btn-success" id="btn_simpan"><li class="fa fa-save"></li> Proses</button>
                    </div>
                    
                </div>
            </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
      <!-- /.row -->
      </form>
    <!-- end form -->
                         
</div>
</section>

<!-- /.content -->
<script>
  $(document).ready(function()
  {
     // fungsi qty input di ganti
                        
    //  $('input[name="qty_input[]"]').keyup(function(){
    //     // cek apakah ada nilai yang di kirim / tidak
    //   input = $(this).val();
    //   qty = $(this).attr('max');  
    //   if( parseInt(input) > parseInt(qty)){
    //     // menampilkan pesan eror
    //     Swal.fire(
    //     'Melebihi jumlah Permintaan',
    //     'Pastikan input jumlah yang sesuai dan tidak melebihi jumlah/sisa permintaan',
    //     'info'
    //     )
    //   $(this).val(qty);
    //     }
    //     });    
    
        // tombol proses ketika di klik
        $("#btn_simpan").click(function(e) {
                e.preventDefault();
                Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data Permintaan akan di proses Kirim",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Yakin'
                }).then((result) => {
                    if ($('textarea[name="catatan"]').val()==""){
                                Swal.fire(
                                        'Kolom Catatan Harus di isi',
                                        'Pastikan input Jumlah packing (koli/karung/box)',
                                        'info'
                                        )
                            }else{
                                // proses
                                var data_qty = $('#form_qty').serialize();
                                $.ajax({
                                url:'<?php echo base_url()?>adm_gudang/Pengiriman/proses_tambah2',
                                method:"POST",
                                dataType : 'text',
                                data : data_qty,
                                success:function(data){
                                    Swal.fire(
                                        'Berhasil',
                                        'Data Berhasil dibuat !',
                                        'success'
                                        )
                                        location.href="<?php echo base_url('adm_gudang/Pengiriman/') ?>";
                                }
                                })
                            }
                })
            })
            // end tombol proses
  });
</script>