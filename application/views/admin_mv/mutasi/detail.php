<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
             <!-- Master -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title"><li class="fas fa-box"></li> <strong>Data Mutasi</strong> </h3>
                
            </div>
            <!-- /.card-header -->

            <div class="card-body">                         
                <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>No Mutasi :</label>
                    <input type="text" class="form-control id_mutasi" name="id_mutasi"  value="<?= $mutasi->id ?>" readonly>
                    </div>
                    <div class="form-group">
                    <label>Tanggal :</label>
                    <input type="text" class="form-control" name="tgl_mutasi"  value="<?= $mutasi->created_at ?>" readonly>
                  </div>
                    <!-- /.form-group -->
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Toko Asal :</label>
                    <input type="text" class="form-control" name="no_mutasi"  value="<?= $mutasi->asal ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Toko tujuan :</label>
                    <input type="text" class="form-control" name="no_mutasi"  value="<?= $mutasi->tujuan ?>" readonly>
                  </div>
                    <!-- /.form-group -->
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Diajukan Oleh :</label>
                    <br>
                    [ <?= $mutasi->leader ?> ]
                    </div>
                    <br>
                    <div class="form-group">
                    <label>Status :</label>
                    <br>
                    <?= status_mutasi($mutasi->status) ?>
                    </div>
                    <!-- /.form-group -->
                  </div>
            
                </div>
                <!-- /.row -->
                
            </div>
            <!-- /.card-body -->

        </div>
        <!-- end master -->
            <!-- print area -->
            <div id="printableArea">
            <!-- Main content -->
           

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr >
                      <th class="text-center">Pilih</th>
                      <th>Kode Artikel #</th>
                      <th>Nama Artikel</th>
                      <th>Satuan</th>
                      <th>QTY</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                            $no = 0;
                            $total = 0;
                            foreach ($detail_mutasi as $d) {
                            $no++; 
                        ?>
                            <tr>
                            <td class="text-center">
                              <div class="icheck-success">
                                <input type="checkbox" class="centang"  value="<?= $d->id ?>" name="check[]">
                              </div>
                            </td>
                                <td><?= $d->kode ?> </td>
                                <td><?= $d->nama_produk ?></td>
                                <td>
                                <?= $d->satuan ?>
                                </td>
                                <td ><?= $d->qty ?></td>
                            </tr>
                        <?php 
                        $total += $d->qty;
                            } 
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="text-center">
                            <input type="checkbox" id="check-all" class="flat check_btn">
                            </td>
                            <td><strong>Pilih Semua</strong></td>
                            <td colspan="2" align="right"> <strong>Total</strong> </td>
                            <td><?= $total ; ?></td>
                         
                        </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->


              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <?php if($mutasi->status == 0) { ?>
                    <div class="col-12">
                    <a href="<?= base_url('adm_mv/Mutasi/reject/'.$mutasi->id) ?>" class="btn btn-danger float-right"><i class="fas fa-times-circle"></i> Tolak All</a>
                    -
                    <button type="button" class="btn btn-success float-right btn_terima" style="margin-right: 5px;"><i class="fas fa-check"></i> Approve </button>
                    </div>
                  <?php } else { ?>
                  <a type="button" onclick="printDiv('printableArea')" target="_blank" class="btn btn-default float-right" style="margin-right: 5px;">
                    <i class="fas fa-print"></i> Print 
                  </a> 
                   <a href="<?=base_url('adm_mv/Mutasi')?>" class="btn btn-danger float-right" style="margin-right: 5px;"><i class="fas fa-times-circle"></i> Close </a>
                   <?php } ?>
                </div>
              </div>
            </div>
            </div>
            <!-- end print area -->
           
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <script>
      function printDiv(divName) {
          var printContents = document.getElementById(divName).innerHTML;
          var originalContents = document.body.innerHTML;
          document.body.innerHTML = printContents;
          window.print();
          document.body.innerHTML = originalContents;
      }
    </script>
    <script>
    $(document).ready(function(){
      // centang semua
      $(".check_btn").change(function(){
        $('.centang').prop('checked', $(this).prop('checked'));
      });
      // fungsi btn approve
      $('.btn_terima').click(function(){
        var id = [];
        var id_mutasi = $('.id_mutasi').val();
        $('.centang').each(function(){
          if ($(this).is(":checked")) 
          {
           id.push($(this).val());
          }
        });
       
        if (id == 0) {
          Swal.fire({
                        title: 'Peringatan',
                        text: "Harap Pilih artikel terlebih dahulu !",
                        type: 'info',
                        icon: "info",
                      })
        }else {
        // proses update ke controller
        $.ajax({
                    url: "<?= base_url('adm_mv/Mutasi/approve') ?>",
                    dataType: 'text',
                    data: {id:id,id_mutasi:id_mutasi},
                    success: function(){
                      // Swal.fire('Berhasil','Stok Artikel Berhasil di Approve !','success');
                      Swal.fire({
                        title: 'Berhasil',
                        text: "Mutasi Artikel Berhasil di Approve !",
                        type: 'success',
                        icon: "success",
                      }).then((result) => {
                        if(result){
                          // Do Stuff here for success
                          location.href="<?php echo base_url('adm_mv/Mutasi') ?>";
                        }else{
                          // something other stuff
                        }

                      })
                  // end sweetalert
                    }
                });
          // end proses
        }
        // end if 
      });
      // end btn terima

     
    })
  </script>



