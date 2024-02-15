 <!-- Main content -->
 <section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

        <!-- /.card -->

        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"> <li class="fas fa-chart-pie"></li> Data Stok Opname Toko</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
          
         
            <table id ="table_so" class="table table-bordered table-striped">
              <thead>
                <tr class="text-center">
                  <th style="width: 1%">No</th>
                  <th style="width:25%">Toko</th>
                  <th>Nama Supervisor</th>
                  <th>Nama SPG</th>
                  <th>Status Aset</th>
                  <th>Status SO</th>
                  <th>Tgl max SO</th>
                </tr>
              </thead>
              <tbody>
              <tr>
                <?php if(is_array($list_toko)){ ?>
                  <?php $no = 0;?>
                  <?php foreach ($list_toko as $data) :
                    $no++; ?>
                  
                    <td><?=$no?></td>
                    <td><?=$data->nama_toko?></td>
                    <?php $id = $data->id_spv ?>
                    <?php $query = $this->db->query("SELECT * FROM tb_user WHERE id = '$id'")->result() ?>
                    <?php foreach ($query as $spv) : ?>
                    <td><?=$spv->nama_user ?></td>
                    <?php endforeach; ?>
                    <td><?=$data->nama_user?></td>
                    <td class="text-center">
                      <?php if ($data->status_aset == 0){ ?>
                          <span class='badge badge-danger'>Belum Update Aset !</span>
                      <?php } else { ?>
                        <span class='badge badge-success'>Sudah Update Aset !</span>
                        <?php } ?>
                    </td>
                    <td class="text-center">
                      <?php if ($data->status_so == 0){ ?>
                          <span class='badge badge-danger'>Belum SO !</span>
                      <?php } else { ?>
                        <span class='badge badge-success'>Sudah SO !</span>
                        <?php } ?>
                    </td>
                    <td class="text-center">
                      <?php if ($data->tgl_so == null){ ?>
                          - Kosong -
                      <?php } else { ?>
                        <?= $data->tgl_so ?>
                        <?php } ?>
                    </td>
                  </tr>
                    <?php endforeach; ?>
                  
                  <?php }else { ?>
                        <td colspan="6" align="center"><strong>Data Kosong</strong></td>
                  <?php } ?>
                </tr>
                 
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
    
      $('#table_so').DataTable({
          order: [[0, 'asc']],
          responsive: true,
          lengthChange: false,
          autoWidth: false,
      });
      
    
    })
  </script>
<!-- /.content -->