     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
    
            <!-- /.card -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-hospital"></li> Data Grup</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-right">
                    <button type="button" class="btn btn-success" data-toggle="modal"  data-target="#modal-tambah" ><i class="fas fa-plus"></i>
                      Tambah
                    </button>
                    
                    </div>
                </div>
                <hr>
                <table id ="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width: 2%">No</th>
                      <th>Nama Group</th>
                      <th>Deskripsi</th>
                      <th>Tipe Harga</th>
                      <th style="width: 20%">Menu</th>       
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php if(is_array($list_group)){ ?>
                      <?php $no = 1;?>
                      <?php foreach($list_group as $dd): ?>
                        <td><?=$no?></td>
                        <td><?=$dd->nama_grup?></td>
                        <td><?=$dd->deskripsi?></td>
                        <td></td>
                        <td>
                         <a href="#" class="btn btn-warning btn-edit" 
                        data-id="<?= $dd->id;?>" 
                        data-nama_produk="<?= $dd->nama_grup;?>" 
                        data-deskripsi="<?= $dd->deskripsi;?>" >
                        <i class="fas fa-edit"></i></a>
                        - 
                        <a type="button" class="btn btn-danger btn-hapus"  href="<?=base_url('mng_mkt/group/hapus/'.$dd->id)?>" title="Hapus Data"  ><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                      <?php $no++; ?>
                      <?php endforeach;?>
                      <?php }else { ?>
                            <td colspan="4" align="center"><strong>Data Kosong</strong></td>
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
                    <h4 class="modal-title"> <li class="fas fa-hospital"></li> Form Tambah Group</h4>
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
                    <form method="POST" action="<?= base_url('mng_mkt/group/tambah_grup')?>">
                      <div class="form-group">
                        <label for="nama" >Nama Grup</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Grup" required="" autocomplete ="off">
                      </div>
                      <div class="form-group">
                        <label for="deskripsi" >Deskripsi Grup</label>
                        <input type="text" name="deskripsi" class="form-control" id="deskripsi" placeholder="Nama Grup" autocomplete ="off">
                      </div>
                      <div class="form-group">
                    <label>Tipe Harga</label>
                    <select name="het" class="form-control" required >
                      <option value="1"> HET JAWA </option>
                      <option value="2"> HET INDOBARAT </option>
                    </select>
                    <small>Harga ini akan berlaku untuk semua toko yang tergabung dalam Group ini !</small>
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

      <!-- modal edit data -->
      <!-- Modal Edit Product-->
    <form action="<?= base_url('mng_mkt/group/edit_grup')?>" method="POST">
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <li class="fas fa-edit"></li> Update Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Grup</label>
                    <input type="text" class="form-control nama_produk" name="nama_produk" placeholder="Name"  autocomplete ="off">
                    <input type="hidden" name="updated" class="form-control"  readonly="readonly" value="<?php echo date('Y-m-d H:i:s'); ?>">
                </div>
                <div class="form-group">
                    <label>Deskripsi Grup</label>
                    <input type="text" class="form-control deskripsi" name="deskripsi" placeholder="Deskripsi">
                </div>
                <div class="form-group">
                    <label>Tipe Harga</label>
                    <select name="het" class="form-control" required >
                      <option value="1"> HET JAWA </option>
                      <option value="2"> HET INDOBARAT </option>
                    </select>
                    <small>Harga ini akan berlaku untuk semua toko yang tergabung dalam Group ini !</small>
                </div>
            </div>
              <div class="modal-footer justify-content-between">
                <button
                  type="button"
                  class="btn btn-danger"
                  data-dismiss="modal">
                  <li class="fas fa-times-circle"></li> Cancel
                </button>
                <input type="hidden" name="id" class="id">
                <button type="submit" class="btn btn-primary">
                  <li class="fas fa-edit"></li> Update
                </button>
              </div>
           
            </div>
        </div>
        </div>
    </form>
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
            const nama_produk = $(this).data('nama_produk');
            const deskripsi = $(this).data('deskripsi');
            // Set data to Form Edit
            $('.id').val(id);
            $('.nama_produk').val(nama_produk);
            $('.deskripsi').val(deskripsi);
            // Call Modal Edit
            $('#editModal').modal('show');
        });
       })
    </script>
<!-- Main content -->
