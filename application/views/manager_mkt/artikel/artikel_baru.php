     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
    
            <!-- /.card -->
         
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <i class="fas fa-cube"></i> Data Artikel Baru</h3>
                <div class="card-tools">
              <a href="<?= base_url('mng_mkt/Dashboard') ?>" type="button" class="btn btn-tool" >
                <i class="fas fa-times"></i>
              </a>
            </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <i class="fas fa-info"></i> Info : <br>
                <address>* Artikel Baru yang belum di Approve secara default = <span class="badge badge-danger">"Belum Aktif"</span> dan tidak bisa untuk transaksi. 
                  <br>
                  <span class="badge badge-success">Approve</span> = Menambahkan Artikel terbaru untuk toko yang bersangkutan. <br>
                  <span class="badge badge-danger">Reject</span> = Menolak Artikel terbaru.
                </address>
                <hr>
                <?php if(!empty($list_data)){ ?>
                <table id ="table_artikel" class="table table-bordered table-striped mailbox-messages">
                
                  <thead>
                    <tr class="text-center">
                        <th>
                          Pilih
                        </th>
                        <th>Toko</th>
                        <th style="width:15%">Kode Artikel#</th>
                        <th style="width:25%">Nama Artikel</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr>
                    
                    <?php 
                    $no = 0;
                    foreach($list_data as $dd):
                    $no++; ?>
                        <td class="text-center">
                        <div class="icheck-success">
                          <input type="checkbox" class="centang"  value="<?= $dd->id ?>" name="check[]">
                        </div>
                        </td>
                        <td><a href="<?= base_url('mng_mkt/Toko/profil/'.$dd->id_toko) ?>"><?= $dd->nama_toko ?></a> </td>
                        <td><?=$dd->kode?></td>
                        <td><?=$dd->nama_produk?></td>
                        <td class="text-center"><?=$dd->qty?></td>
                        <td class="text-right">
                          <?php
                          if($dd->het == 1){
                            echo "Rp. "; echo number_format($dd->harga_jawa) ; echo " ,-";
                          }else {
                            echo "Rp. "; echo number_format($dd->harga_indobarat) ; echo " ,-";
                          }
                          ?>
                        </td>
                        <td class="text-center"><?= status_artikel($dd->status) ?></td>
                        </tr>
                    <?php endforeach;?>
                    
                     
                  </tbody>
                  <tfoot>
                  <tr>
                    <th class="text-center">
                    <input type="checkbox" id="check-all" class="flat check_btn">
                    </th>
                    <th colspan="6"> Pilih Semua
                    </th>
                  </tr>
                  </tfoot>
                  
                </table>
                <?php } else {?>
                    <div class="text-center">
                    <span class="badge badge-danger"><strong>DATA KOSONG</strong></span>
                    </div>
                    <?php } ?>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
              <button type="button" class='btn btn-success float-right btn_terima <?= (empty($list_data)) ? 'd-none' : '' ?>'><i class='fa fa-save' aria-hidden='true'></i> Approve</button>
              <button type="button" class='btn btn-danger float-right mr-3 btn_reject <?= (empty($list_data)) ? 'd-none' : '' ?>'><i class='fa fa-times-circle' aria-hidden='true'></i> Reject </a>
              </div>
            </div>
          
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

  
    <!-- jQuery -->
    <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>

 
      <script>
    $(document).ready(function(){
    
      $('#table_artikel').DataTable({
          order: [[0, 'asc']],
          responsive: true,
          lengthChange: false,
          autoWidth: false,
      });

      // centang semua
      $(".check_btn").change(function(){
        $('.centang').prop('checked', $(this).prop('checked'));
      });

 
      // fungsi btn approve
      $('.btn_terima').click(function(){
        var id = [];
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
                    url: "<?= base_url('mng_mkt/Artikel/approve') ?>",
                    dataType: 'text',
                    data: {id:id},
                    success: function(){
                      // Swal.fire('Berhasil','Stok Artikel Berhasil di Approve !','success');
                      Swal.fire({
                        title: 'Berhasil',
                        text: "Stok Artikel Berhasil di Approve !",
                        type: 'success',
                        icon: "success",
                      }).then((result) => {
                        if(result){
                          // Do Stuff here for success
                          location.reload();
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

      // fungsi btn reject
      $('.btn_reject').click(function(){
        var id = [];
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
                    url: "<?= base_url('mng_mkt/Artikel/reject') ?>",
                    dataType: 'text',
                    data: {id:id},
                    success: function(){
                      // Swal.fire('Berhasil','Stok Artikel Berhasil di Approve !','success');
                      Swal.fire({
                        title: 'Berhasil',
                        text: "Artikel Berhasil di Tolak !",
                        type: 'success',
                        icon: "success",
                      }).then((result) => {
                        if(result){
                          // Do Stuff here for success
                          location.reload();
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
  <!-- fungsi check all -->
 