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
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-right">
                      <div class="btn-group">
                        <button type="button" class="btn btn-outline-success"> <i class="fas fa-plus"></i> Tambah Promo</button>
                        <button type="button" class="btn btn-success dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" href="<?= base_url('mng_mkt/promo/tambah_promo_reguler') ?>">Promo Khusus</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="<?= base_url('mng_mkt/promo/tambah_promo_nasional') ?>">Promo Nasional</a>
                        </div>
                      </div>                 
                    </div>
                </div>
                <hr>
                <table id ="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width:2% ">No</th>
                      <th style="width:15% ">No. Promo</th>
                      <th style="width:15%">Judul Promo</th>
                      <th>Status</th>
                      <th>Tgl. Mulai</th>
                      <th>Tgl. Selesai</th>
                      <th>Menu</th>       
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php if(is_array($list_data)){ ?>
                      <?php $no = 1;?>
                      <?php foreach($list_data as $dd): ?>
                        <td><?=$no?></td>
                        <td><?= $dd->id; ?></td>
                        <td><?=$dd->judul?></td>
                        <td><?= status_promo($dd->status); ?></td>
                        <td><?= format_tanggal1($dd->tgl_mulai)?></td>
                        <td><?= format_tanggal1($dd->tgl_selesai)?></td>
                        <td>
                          <a href="<?= base_url('mng_mkt/promo/detail/'.$dd->id) ?>" class="btn btn-primary"><i class="fas fa-eye"> Detail</i></a>
                        </td>
                    </tr>
                      <?php $no++; ?>
                      <?php endforeach;?>
                      <?php }else { ?>
                            <td colspan="9" align="center"><strong>Data Kosong</strong></td>
                      <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                  <th colspan="9"></th>
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