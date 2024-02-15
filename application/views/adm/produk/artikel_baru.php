     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
    
            <!-- /.card -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <i class="fas fa-cube"></i> Data Artikel Baru</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <i class="fas fa-info"></i> Info : <br>
                <address>* Artikel Baru yang belum di Approve secara default = "Belum Aktif" dan tidak bisa untuk transaksi.</address>
                <table id ="table_artikel" class="table table-bordered table-striped">
                  <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th style="width:20%">Kode Artikel#</th>
                        <th style="width:30%">Nama Artikel</th>
                        <th>Satuan</th>
                        <th>Status</th>
                        <th>Menu</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <?php if(is_array($list_data)){ ?>
                    <?php 
                    $no = 0;
                    foreach($list_data as $dd):
                    $no++; ?>
                        <td><?=$no?></td>
                        <td><?=$dd->kode?></td>
                        <td><?=$dd->nama_produk?></td>
                        <td class="text-center"><?=$dd->satuan?></td>
                        <td class="text-center"><?= status_artikel($dd->status) ?></td>
                        <td>
                        <a href="<?= base_url('adm/Produk/reject/'.$dd->id) ?>" class="btn btn-danger"><li class="fas fa-times-circle"></li> reject</a>
                        <a href="<?= base_url('adm/Produk/approve/'.$dd->id) ?>"  class="btn btn-success"><li class="fas fa-check-circle"></li> Approve</a>
                        </td>
                        </tr>
                    <?php endforeach;?>
                    <?php }?>
                     
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
                    <h4 class="modal-title"> <i class="fas fa-cube"></i> Form Tambah Artikel</h4>
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
                    <form method="POST" action="<?= base_url('adm/produk/proses_tambah')?>">
                      <div class="form-group">
                        <label for="kode" >Kode Artikel#</label>
                        <input type="text" name="kode" class="form-control" autocomplete="off" placeholder="Kode Artikel" required="">
                      </div>
                      <div class="form-group">
                        <label for="nama" >Nama Artikel</label>
                        <input type="text" name="nama" class="form-control" autocomplete="off" id="nama" placeholder="Nama Artikel" required>
                      </div>
                      <div class="form-group" >
                        <label for="satuan">Satuan</label> </br>
                        <select class="form-control" name="satuan" required>
                        <option value="">-- PIlih Satuan --</option>
                        <option value="BND">BND</option>
                        <option value="BOX">BOX</option>
                        <option value="PCS">PCS</option>
                        <option value="PCK">PCK</option>
                        <option value="PSG">PSG</option>
                        </select>
                      </div>
                      <div class="form-group" >
                        <label for="deskripsi">Deskripsi</label> </br>
                      <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Deskripsi"></textarea>
                      </div>
                      
                    
                    <!-- end konten -->
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button
                      type="button"
                      class="btn btn-danger"
                      data-dismiss="modal"
                    >
                    <i class="fas fa-times-circle"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan
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
    <form action="<?= base_url('adm/produk/proses_update')?>" method="POST">
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-edit"></i> Update Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kode Produk</label>
                    <input type="text" class="form-control kode" name="kode" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" class="form-control nama_produk" name="nama_produk" placeholder=" Name">
                </div>
                <div class="form-group" >
                  <label for="satuan">Satuan</label> </br>
                  <select class="form-control" name="satuan" required>
                  <option value="">-- PIlih Satuan --</option>
                  <option value="BND">BND</option>
                  <option value="BOX">BOX</option>
                  <option value="PCS">PCS</option>
                  <option value="PCK">PCK</option>
                  </select>
                </div>
                 
                <div class="form-group">
                    <label>Deskripsi</label>
                    <input type="text" class="form-control deskripsi" name="deskripsi" placeholder="Deskripsi">
                </div>
 
                
             
            </div>
              <div class="modal-footer justify-content-between">
                <button
                  type="button"
                  class="btn btn-danger"
                  data-dismiss="modal">
                  <i class="fas fa-times-circle"></i> Cancel
                </button>
                <input type="hidden" name="id" class="id">
                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-edit"></i> Update
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
    
      $('#table_artikel').DataTable({
          order: [[0, 'asc']],
          responsive: true,
          lengthChange: false,
          autoWidth: false,
      });
    })
  </script>
