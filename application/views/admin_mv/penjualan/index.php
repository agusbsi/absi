   <!-- Main content -->
 <section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

        <!-- /.card -->

        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"> <i class="fas fa-cube"></i> Data Penjualan</h3>
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
                  <th style="width: 1%">No</th>
                  <th style="width:20%">Kode Penjualan</th>
                  <th>Nama Toko</th>
                  <th>Alamat</th>
                  <th>Nama SPG</th>
                  <th>Tgl. Penjualan</th>
                  <th>Menu</th>          
                </tr>
              </thead>
              <tbody>
              <tr>
                <?php if(is_array($list_data)){ ?>
                <?php $no = 1;?>
                <?php foreach ($list_data as $data) : ?>
                  <td><?=$no?></td>
                  <td><?=$data->id_penjualan?></td>
                  <td><?=$data->nama_toko?></td>
                  <td><?=$data->alamat?></td>
                  <td><?=$data->nama_user?></td>
                  <td><?= format_tanggal1($data->tgl_penjualan) ?></td>
                  <td>                  
                  <a type="button" class="btn btn-primary"  href="<?=base_url('adm_mv/penjualan/detail/'.$data->id_penjualan)?>" name="btn_detail" ><i class="fa fa-eye" aria-hidden="true"></i> Detail</a>
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
