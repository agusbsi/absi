     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
         
            <!-- /.card -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-list"></li> Data Permintaan Barang</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="table_minta" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th style="width: 18%;">ID Permintaan</th>
                    <th>Status</th>
                    <th style="width: 35%;">Nama Toko</th>
                    <th>Tanggal dibuat</th>
                    <th>Menu</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <?php if(is_array($list_data)){ ?>
                    <?php $no = 0;
                     foreach($list_data as $dd):
                     $no++ ?>
                    <td><?= $no ?></td>
                    <td><?=$dd->id?></td>
                    <td>
                      <?= status_permintaan($dd->status); ?>   
                    </td>
                    <td><?=$dd->nama_toko?></td>
                   
                    <td><?=$dd->created_at?></td>
                    <td>
                    <a type="button" class="btn btn-primary"  href="<?=base_url('spv/permintaan/detail_p/'.$dd->id)?>" name="btn_detail" ><i class="fa fa-eye" aria-hidden="true"></i> Detail</a>
                    </td>

                  </tr>
                
                  <?php endforeach;?>
                  <?php  }else { ?>
                      <td colspan="6" align="center"><strong>Data Kosong</strong></td>
                  <?php } ?>
                      
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
     <!-- Modal Edit Product-->
     <form action="<?= base_url('adm_gudang/Permintaan/proses_approve')?>" method="POST">
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"> <li class="fas fa-exclamation-triangle"></li> Konfirmasi Data Permintaan Terpending !</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>ID Permintaan # :</label>
                    <input type="text" class="form-control id" name="id" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Toko :</label>
                    <input type="text" class="form-control nama_toko" name="nama_toko" readonly>
                </div>
               
                <div class="form-group">
                    <label>Catatan :</label>
                    <textarea class="form-control" name="catatan"  cols="10" rows="5" placeholder=" Contoh : Stok Artikel 001 habis" required></textarea>
                    <span>* Anda perlu memberikan catatan untuk barang yang tidak bisa di kirim.</span>
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
                <button type="submit" class="btn btn-success">
                  <li class="fas fa-save"></li> Approve
                </button>
              </div>
           
            </div>
        </div>
        </div>
    </form>
    <!-- End Modal Edit Product-->
      <!-- end modal -->
    <!-- jQuery -->
    <script src="<?php echo base_url()?>/assets/plugins/jquery/jquery.min.js"></script>
    <script>
      $(document).ready(function(){
        // tabel
        $('#table_minta').DataTable({
            order: [[1, 'desc']],
            responsive: true,
            lengthChange: false,
            autoWidth: false,
        });
        // get Edit Product
       $('.btn-edit').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            const nama_toko = $(this).data('nama_toko');
           
            // Set data to Form Edit
            $('.id').val(id);
            $('.nama_toko').val(nama_toko);
            // Call Modal Edit
            $('#editModal').modal('show');
        });
       
      
    
      })
    </script>
