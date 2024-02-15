     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
    
            <!-- /.card -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-cube"></li> Data Artikel</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
           
                <div class="row">
                    <div class="col-md-8">
                      <i class="fas fa-info"></i> Info :<br>
                      <span class="badge badge-success">Aktif</span> : Artikel sudah bisa digunakan. <br>
                      <span class="badge badge-warning">belum diApprove</span> : Artikel belum aktif dan tidak bisa digunakan.

                    </div>
                </div>
                <hr>
                <table id ="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr class="text-center">
                      <th>No.</th>
                      <th style="width:15%">Kode Artikel#</th>
                      <th style="width:26%">Nama Artikel</th>
                      <th>Satuan</th>
                      <th>Harga Jawa</th>
                      <th>Harga Indo. Barat</th>
                      <th>Status</th>      
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php if(is_array($list_data)){ ?>
                      <?php $no = 1;?>
                      <?php foreach($list_data as $dd): ?>
                        <td><?=$no?></td>
                        <td><?=$dd->kode?></td>
                        <td><?=$dd->nama_produk?></td>
                        <td class="text-center"><?=$dd->satuan?></td>
                        <td>
                          <label class="float-left font-weight-normal">Rp.</label>
                          <label class="float-right font-weight-normal"><?=$dd->harga_jawa?></label>
                        </td>
                        <td>
                          <label class="float-left font-weight-normal">Rp.</label>
                          <label class="float-right font-weight-normal"><?=$dd->harga_indobarat?></label>
                        </td>
                        <td class="text-center"><?= status_artikel($dd->status)?>
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
