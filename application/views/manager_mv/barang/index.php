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
                   
                    <div class="col-md-4 text-right">
                    <button type="button" class="btn btn-success" data-toggle="modal"  data-target="#modal-tambah" ><i class="fas fa-plus"></i>
                      Tambah Artikel
                    </button>
                    
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
                        <td class="text-right">
                        Rp <?=number_format($dd->harga_jawa)?>
                        </td>
                        <td class="text-right">
                          Rp <?=number_format($dd->harga_indobarat)?>
                        </td>
                        <td class="text-center"><?= status_artikel($dd->status)?></td>
                       
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
              <form method="POST" action="<?= base_url('sup/barang/proses_tambah')?>">
                <div class="form-group">
                  <label for="kode" >Kode Artikel</label>
                  <input type="hidden" name="id" id="id">
                  <input type="text" name="kode" class="form-control" id="kode" autocomplete="off" placeholder="Kode Artikel" required="">
                </div>
                <div class="form-group">
                  <label for="nama" >Nama Artikel</label>
                  <input type="text" name="nama" class="form-control" id="nama" autocomplete="off" placeholder="Nama Artikel" required="">
                </div>
                <div class="form-group" >
                  <label for="satuan">Satuan</label> </br>
                  <select class="form-control" name="satuan" required="">
                  <option value="">-- PIlih Satuan --</option>
                  <option value="BND">BND</option>
                  <option value="BOX">BOX</option>
                  <option value="PCS">PCS</option>
                  <option value="PCK">PCK</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Harga HET Jawa</label>
                  <input type="text" class="form-control" name="harga_jawa" placeholder="Harga HET Jawa" required="">
                </div>
                <div class="form-group">
                  <label>Harga Indonesia Barat</label>
                  <input type="text" class="form-control" name="harga_indo" placeholder="Harga Indonesia Barat" required="">
                </div>
                <hr>
                <span class="badge badge-warning">Catatan :</span> <br>
                * Menambahkan Artikel baru memerlukan Approval dari direksi agar bisa aktif.
              
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
    <form action="<?= base_url('sup/barang/proses_update')?>" method="POST">
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
                    <label>Kode Produk</label>
                    <input type="hidden" name="id" class="form-control id" readonly="">
                    <input type="text" class="form-control kode" name="kode" readonly="">
                </div>
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" class="form-control nama_produk" name="nama_produk" placeholder="Name" required="">
                </div>
                <div class="form-group" >
                  <label for="satuan">Satuan</label> </br>
                  <select class="form-control satuan" name="satuan" required="">
                  <option value="satuan">-- PIlih Size --</option>
                  <option value="BND">BND</option>
                  <option value="BOX">BOX</option>
                  <option value="PCS">PCS</option>
                  <option value="PCK">PCK</option>
                  </select>
                </div>
                 
                <div class="form-group">
                    <label>Deskripsi</label>
                    <input type="text" class="form-control deskripsi" name="deskripsi" placeholder="Deskripsi">
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
            const satuan = $(this).data('satuan');
            // Set data to Form Edit
            $('.id').val(id);
            $('.nama_produk').val(nama_produk);
            $('.kode').val(kode);
            $('.satuan').val(satuan);
            $('.deskripsi').val(deskripsi);
            // Call Modal Edit
            $('#editModal').modal('show');
        });
       })
    </script>
<!-- Main content -->