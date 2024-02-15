     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
    
            <!-- /.card -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-hospital"></li> Data Aset</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-right">
                    <button type="button" class="btn btn-success" data-toggle="modal"  data-target="#modal-tambah" ><i class="fas fa-plus"></i>
                      Tambah Aset
                    </button>
                    
                    </div>
                </div>
                <hr>
                <table id ="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width:2% ">No</th>
                      <th style="width:20%">Kode Aset #</th>
                      <th style="width:35%">Nama Aset</th>
                      <th style="width:15%">Status</th>
                      <th>Menu</th>       
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php if(is_array($list_data)){ ?>
                      <?php $no = 1;?>
                      <?php foreach($list_data as $dd): ?>
                        <td><?=$no?></td>
                        <td><?=$dd->id?></td>
                        <td><?=$dd->nama_aset?></td>
                        <td><?=status_aset($dd->status)?>
                        </td>
                        <td>
                            <?php if ($dd->status == 0){ ?>
                            <a href="<?= base_url('hrd/aset/approve/'.$dd->id) ?>" class="btn btn-success"><i class="fas fa-check"></i> Approve</a>
                          <?php }else{ ?>
                         <a href="#" class="btn btn-warning btn-edit" 
                        data-id="<?= $dd->id;?>" 
                        data-nama="<?= $dd->nama_aset;?>"data-status="<?= $dd->status;?>" >
                        <i class="fas fa-edit"></i></a>
                        - 
                        <a type="button" class="btn btn-danger btn-hapus"  href="<?=base_url('hrd/aset/hapus/'.$dd->id)?>" title="Hapus Data"  ><i class="fa fa-trash" aria-hidden="true"></i></a>
                        - 
                        <a type="button" class="btn btn-primary"  href="<?=base_url('hrd/aset/detail/'.$dd->id)?>" title="Hapus Data"  ><i class="fa fa-eye"></i> Detail</a>
                        <?php } ?>
                        </td>
                    </tr>
                      <?php $no++; ?>
                      <?php endforeach;?>
                      <?php }else { ?>
                            <td colspan="5" align="center"><strong>Data Kosong</strong></td>
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
      </div>
      <!-- /.container-fluid -->
    </section>
      <!-- modal tambah data -->
      <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> <li class="fas fa-plus-circle"></li> Form Tambah Aset</h4>
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
              <form method="POST" action="<?= base_url('hrd/aset/proses_tambah')?>" role="form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="nik" > <li class="fas fa-id-card"></li> ID Aset</label>
                  <input type="text" name="id" class="form-control" readonly="" id="nik" value="<?= $id_aset ?>">
                </div>
                <div class="form-group" >
                   <label for="nama" > <li class="fas fa-user"></li> Nama Aset</label> </br>
                   <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Aset" required="">
                </div>
                <div class="form-group" >
                  <label for="foto" > <li class="fas fa-image"></li> Foto Aset</label> </br>
                  <input type="file" name="foto" class="form-control" id="foto" placeholder="Foto Toko" accept="image/png, image/jpeg, image/jpg, image/gif" required="">
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
              <button type="submit" class="btn btn-success">
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

      <!-- modal edit data -->
      <!-- Modal Edit Product-->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> <li class="fas fa-plus-circle"></li> Form Edit Aset</h4>
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
              <form method="POST" action="<?= base_url('hrd/aset/proses_update')?>" role="form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="nik" > <li class="fas fa-id-card"></li> ID Aset</label>
                  <input type="text" name="id" class="form-control id" readonly="" id="nik"
                   <?php 
                    date_default_timezone_set('Asia/Jakarta');
                    ?>
                  <input type="hidden" name="updated" class="form-control"  readonly="" value="<?php echo date('Y-m-d H:i:s'); ?>">
                </div>
                <div class="form-group" >
                   <label for="nama" > <li class="fas fa-user"></li> Nama Aset</label> </br>
                   <input type="text" name="nama" class="form-control nama" id="nama" placeholder="Nama Aset" required="">
                </div>
                <div class="form-group">
                  <label for="status"><i class="fas fa-credit-card"></i> Status Aset</label>
                  <select name="status" class="form-control status">
                    <option value="1">Aktif</option>
                    <option value="2">Tidak Aktif</option>
                  </select>
                </div>
                <div class="form-group" >
                  <label for="foto" > <li class="fas fa-image"></li> Foto Aset</label> </br>
                  <input type="file" name="foto" class="form-control" id="foto" placeholder="Foto Toko" accept="image/png, image/jpeg, image/jpg, image/gif">
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
              <button type="submit" class="btn btn-success">
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
    <!-- End Modal Edit Product-->
      <!-- end modal -->
  
    <!-- jQuery -->
    <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
    <script>
       $(document).ready(function(){
        // get Edit Product
        $('.btn-edit').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            const status = $(this).data('status');
            // Set data to Form Edit
            $('.id').val(id);
            $('.nama').val(nama);
            $('.status').val(status);
            // Call Modal Edit
            $('#editModal').modal('show');
        });
       })
    </script>
<!-- Main content -->
