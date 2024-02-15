     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
    
            <!-- /.card -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-cube"></li> Data Aset</h3>
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
                      <th style="width:30%">Kode Aset</th>
                      <th style="width:50%">Nama Aset</th>
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
                        <td>
                         <a href="#" class="btn btn-warning btn-edit" 
                        data-id="<?= $dd->id;?>" 
                        data-nama_produk="<?= $dd->nama_aset;?>" >
                        <i class="fas fa-edit"></i></a>
                        - 
                        <a type="button" class="btn btn-danger btn-hapus"  href="<?=base_url('sup/aset/hapus/'.$dd->id)?>" title="Hapus Data"  ><i class="fa fa-trash" aria-hidden="true"></i></a>
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
                  <th colspan="4"></th>
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
                    <h4 class="modal-title"> <li class="fas fa-cube"></li> Form Tambah Produk</h4>
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
                    <form method="POST" action="<?= base_url('sup/aset/proses_tambah')?>">
                      <div class="form-group">
                        <label>Kode Aset</label>
                        <input class="form-control" type="text" name="id" readonly="" value="<?= $id_aset ?>">
                      </div>
                      <div class="form-group">
                        <label for="nama" >Nama Aset</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Artikel" required="">
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
    <form action="<?= base_url('sup/aset/proses_update')?>" method="POST">
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <li class="fas fa-edit"></li> Update Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
             
                <div class="form-group">
                    <label>Kode Aset</label>
                    <input type="text" name="id" class="form-control id" readonly="">
                </div>
                <div class="form-group">
                    <label>Nama Aset</label>
                    <input type="text" class="form-control nama_produk" name="nama_produk" placeholder="Name" required="">
                    <input type="hidden" name="updated" class="form-control"  readonly="readonly" value="<?php echo date('Y-m-d H:i:s'); ?>">
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
            const kode = $(this).data('kode');
            const nama_produk = $(this).data('nama_produk');
            const deskripsi = $(this).data('deskripsi');
            const size = $(this).data('size');
            const satuan = $(this).data('satuan');
            // Set data to Form Edit
            $('.id').val(id);
            $('.nama_produk').val(nama_produk);
            $('.kode').val(kode);
            $('.size').val(size);
            $('.satuan').val(satuan);
            $('.deskripsi').val(deskripsi);
            // Call Modal Edit
            $('#editModal').modal('show');
        });
       })
    </script>
<!-- Main content -->
