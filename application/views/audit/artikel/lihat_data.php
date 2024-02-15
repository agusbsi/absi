     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
    
            <!-- /.card -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <i class="fas fa-cube"></i> Data Artikel</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              
                
                <table id ="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>No</th>
                        <th style="width:15%">Kode Artikel#</th>
                        <th style="width:25%">Nama Artikel</th>
                        <th>Satuan</th>
                        <th>HET JAWA</th>
                        <th>HET INDOBARAT</th>
                        <th>SP</th>
                        <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <?php if(is_array($list_data)){ ?>
                    <?php 
                    $no = 0;
                    foreach($list_data as $dd):
                    $no++; ?>
                        <td><?=$no?></td>
                        <td><?=$dd->kode?></td>
                        <td><?=$dd->nama_produk?></td>
                        <td><?=$dd->satuan?></td>
                        <td>Rp <?= number_format($dd->harga_jawa)?></td>
                        <td>Rp <?= number_format($dd->harga_indobarat)?></td>
                        <td>Rp <?= number_format($dd->sp)?></td>
                        <td><?= status_artikel($dd->status) ?></td>
                        </tr>
                    <?php endforeach;?>
                    <?php }?>
                     
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
  
  
    <!-- jQuery -->
    <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
    <script>
    $(document).ready(function(){
    
      $('#artikel').DataTable({
          order: [[0, 'asc']],
          responsive: true,
          lengthChange: false,
          autoWidth: false,
      });

    
    })
  </script>
 