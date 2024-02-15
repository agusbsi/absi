   <!-- Main content -->
 <section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

        <!-- /.card -->

        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"> <li class="fas fa-truck"></li> Data Pengiriman</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id ="example1" class="table table-bordered table-striped">
              <thead>
                <tr class="text-center">
                  <th style="width: 1%">No</th>
                  <th style="width:20%">Kode Kirim</th>
                  <th>Status</th>
                  <th>Nama Toko</th>
                  <th>Nama Pengirim</th>
                  <th>Tgl</th>
                  <th>Menu</th>          
                </tr> 
              </thead>
              <tbody>
              <tr>
                  <?php if(is_array($list_data)){ ?>
                    <?php $no = 1;?>
                    <?php foreach ($list_data as $data) : ?>
                      <td><?=$no?></td>
                      <td><?=$data->id?></td>
                      <td>
                      <?php 
                      status_pengiriman($data->status);
                      ?>
                     </td>
                      <td><?=$data->nama_toko?></td>
                      <td><?=$data->nama_user?></td>
                      <td><?= format_tanggal1($data->created_at) ?></td>
                      <td>                  
                      <?php
                      if($data->status==0){
                       ?>
                       <a type="button" class="btn btn-success"  href="<?=base_url('adm_mv/Pengiriman/detail/'.$data->id)?>" name="btn_proses" ><i class="fas fa-link" aria-hidden="true"></i> Proses</a>
                      <?php
                      } else{
                      ?>
                      <a type="button" class="btn btn-primary"  href="<?=base_url('adm_mv/Pengiriman/detail/'.$data->id)?>" name="btn_detail" ><i class="fas fa-eye" aria-hidden="true"></i> Detail</a>
                    <?php }
                    ?>
                    </td>
                    </tr>
                  <?php endforeach; ?>
                  <?php $no++; ?>
                  <?php }else { ?>
                        <td colspan="7" align="center"><strong>Data Kosong</strong></td>
                  <?php } ?>
                </tr>
                 
              </tbody>
              <tfoot>
              <tr>
              <th colspan="7"></th>
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
  </div>
  <!-- /.container-fluid -->
</section>

<!-- jQuery -->
<script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
