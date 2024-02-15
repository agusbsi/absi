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
                    <a type="button" class="btn btn-primary"  href="<?=base_url('audit/permintaan/detail_p/'.$dd->id)?>" name="btn_detail" ><i class="fa fa-eye" aria-hidden="true"></i> Detail</a>
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
     
    
      })
    </script>
