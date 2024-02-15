     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
    
            <!-- /.card -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-warehouse"></li> Data Stok Gudang</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
           
                <div class="row">
                  <div class="col-md-8"></div>
                    <div class="col-md-4 text-right">
                    <a href="<?= base_url('assets/excel/template_stok.xlsx') ?>"  class="btn btn-warning btn-sm"  ><i class="fas fa-download"></i>
                      Download template
                    </a>
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal"  data-target="#modal-tambah" ><i class="fas fa-upload"></i>
                      Upload Stok
                    </button>
                    
                    </div>
                </div>
                <hr>
                <table id ="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr class="text-center">
                      <th style="width:3%">No.</th>
                      <th style="width:15%">Kode Artikel #</th>
                      <th>Satuan</th>
                      <th>Stok</th>
                      <th>Terakhir diperbarui</th>      
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php if(is_array($list_data)){ ?>
                      <?php $no = 1;?>
                      <?php foreach($list_data as $dd): ?>
                        <td><?=$no?></td>
                        <td><?=$dd->kode?></td>
                        <td class="text-center"><?=$dd->satuan?></td>
                        <td class="text-center"><?=$dd->stok?></td>
                        <td class="text-center"><?=$dd->updated_at?></td>
                       
                    </tr>
                      <?php $no++; ?>
                      <?php endforeach;?>
                      <?php }else { ?>
                            <td colspan="5" align="center"><strong>Data Kosong</strong></td>
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
      <!-- modal tambah data -->
      <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> <li class="fa fa-excel"></li> Import Excel</h4>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- isi konten -->
              <form method="post" enctype="multipart/form-data" action="<?php echo base_url('sup/Stokgudang/update_stok'); ?>">
                        <div class="form-group">
                            <label for="file">File Upload</label>
                            <input type="file" name="file" class="form-control" id="exampleInputFile" accept=".xlsx,.xls" required>
                        </div>
              <!-- end konten -->
            </div>
            <div class="modal-footer justify-content-between">
              <button
                type="button"
                class="btn btn-danger"
                data-dismiss="modal"
              >
              <li class="fas fa-times-circle"></li> Cancel
              </button>
              <button type="submit" class="btn btn-primary">
              <li class="fas fa-save"></li> Simpan
              </button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
