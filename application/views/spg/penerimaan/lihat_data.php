<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
     
    </div>
  </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="card card-info ">
            <div class="card-header">
              <h3 class="card-title"> <li class="fas fa-check-circle"></li> Data Penerimaan</h3>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-1">
              
              <!-- isi konten -->
              <table id="table_kirim" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th style="width: 20%;">No Pengiriman</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Menu</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <?php if(is_array($list_data)){ ?>
                   
                    <?php 
                    $no = 1;
                    foreach($list_data as $dd):
                     $no+1
                     ?>
                    <td><?= $no ?></td>
                    <td><?=$dd->id?></td>
                    <td><?= status_pengiriman($dd->status) ?></td>
                    <td><?=$dd->created_at?></td>
                    
                    <td>
                      <?php
                        if($dd->status==1){
                         ?>
                         <a type="button" class="btn btn-success btn-sm"  href="<?=base_url('spg/penerimaan/detail/'.$dd->id)?>" ><i class="fas fa-arrow-circle-right" aria-hidden="true"></i> Proses</a>
                        <?php
                        } else{
                        ?> 
                        <a type="button" class="btn btn-primary btn-sm"  href="<?=base_url('spg/penerimaan/detail/'.$dd->id)?>" ><i class="fas fa-eye" aria-hidden="true"></i> Detail</a>
                      <?php }
                      ?>
                    </td>
                  </tr>
                  <?php $no++; ?>
                  <?php endforeach;?>
                  <?php }else { ?>
                      <td colspan="7" align="center">Data Kosong</td>
                  <?php } ?>
                      
                  </tbody>
                  <tfoot>
                  <tr>
                  <th colspan="5"></th>
                  </tr>
                  </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
          
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
</section>

   <!-- jQuery -->
   <script src="<?php echo base_url()?>/assets/plugins/jquery/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
    
      $('#table_kirim').DataTable({
          order: [[0, 'asc']],
          responsive: true,
          lengthChange: false,
          autoWidth: false,
      });
      
    
    })
  </script>
 