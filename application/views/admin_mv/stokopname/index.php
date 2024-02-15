     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
    
            <!-- /.card -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-cube"></li> Data Promo</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <script type="text/javascript">
                <?php if ($this->session->flashdata('msg_error')) { ?>
                  swal.fire({
                    Title: 'Warning!',
                    text: '<?= $this->session->flashdata('msg_error') ?>',
                    icon: 'Error',
                    confirmButtonColor : '#3085d6',
                    confirmButtonText: 'Ok' 
                  })  
                <?php } ?>  
              </script>
              <script type="text/javascript">
                <?php if ($this->session->flashdata('msg_berhasil')) { ?>
                  swal.fire({
                    Title: 'Success!',
                    text: '<?= $this->session->flashdata('msg_berhasil') ?>',
                    icon: 'success',
                    confirmButtonColor : '#3085d6',
                    confirmButtonText: 'Ok' 
                  })  
                <?php } ?>  
              </script>
              
                <table id ="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width:2% ">No</th>
                      <th style="width:20%">Nama Toko</th>
                      <th style="width:20%">Nama User</th>
                      <th style="width: 20%">Alamat</th>
                      <th style="width: 15%">No. Hp</th>
                      <th>Tgl. SO</th>
                      <th>Menu</th>       
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php if(is_array($list_data)){ ?>
                      <?php $no = 1;?>
                      <?php foreach($list_data as $dd): ?>
                        <td><?=$no?></td>
                        <td><?=$dd->nama_toko?></td>
                        <td><?=$dd->nama_user?></td>
                        <td><?=$dd->alamat?></td>
                        <td><?=$dd->telp?></td>
                        <td>
                          <?= format_tanggal1($dd->tgl_so)?>
                          <input type="hidden" name="id_toko" value="<?=$dd->id ?>">
                        </td>
                        <td>
                          <form method="GET" action="<?= base_url('adm_mv/so/detail')?>">
                          <input type="hidden" name="id_toko" value="<?= $dd->id ?>">
                          <button type="submit" name="btn_detail" class="btn btn-primary">Detail</button>
                          </form>
                        </td>
                    </tr>
                      <?php $no++; ?>
                      <?php endforeach;?>
                      <?php }else { ?>
                            <td colspan="7" align="center"><strong>Data Kosong</strong></td>
                      <?php } ?>
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
