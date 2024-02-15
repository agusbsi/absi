     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
    
            <!-- /.card -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-store"></li> Data Toko</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
             
                <!-- <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-right">
                    <button type="button" class="btn btn-success" data-toggle="modal"  data-target="#modal-tambah" ><li class="fas fa-plus"></li>
                      Tambah Toko
                    </button>
                    
                    </div>
                </div> -->
                <hr>
                <table id ="table_toko" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Toko</th>
                        <th>Supervisor</th>
                        <th>Status</th>
                        <th>Keterangan</th>
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
                        <td><?=$dd->nama_toko?></td>
                        <td><?=$dd->nama_user?></td>
                        <td>
                          <?php if ($dd->status == 1){
                            echo "<span class='badge badge-success'> Aktif </span>";
                          }else{
                            echo "<span class='badge badge-default'> Non Aktif </span>";
                          } ?>
                        </td>
                        <td>
                          <?php if (($dd->id_leader == 0) and ($dd->id_spg == 0)){
                              echo "<span class='badge badge-danger'> Tim leader & spg belum dikaitkan !</span>";
                            }else if ($dd->id_spg == 0){
                              echo "<span class='badge badge-warning'> SPG Belum dikaitkan ! </span>";
                            }else{
                              echo "<span class='badge badge-success'> Berhasil dikaitkan ! </span>";
                            } ?>
                        </td>
                        <td>
                    <a type="button" class="btn btn-warning"  href="<?=base_url('adm/toko/profil/'.$dd->id)?>" name="btn_detail" ><i class="fa fa-cog" aria-hidden="true"></i> Configurasi</a> 
                    
                    <!-- - <a type="button" class="btn btn-danger btn-hapus"  href="<?=base_url('adm/toko/delete/'.$dd->id)?>" name="btn_delete" ><i class="fa fa-trash" aria-hidden="true"></i></a> -->
                  </td>
                        </tr>
                    <?php endforeach;?>
                    <?php }?>
                     
                  </tbody>
                  <tfoot>
                  <tr>
                  <th colspan="6"></th>
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
              <h4 class="modal-title"> <li class="fas fa-plus-circle"></li> Form Tambah Toko</h4>
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
              <form method="POST" action="<?= base_url('adm/Toko/proses_tambah')?>" role="form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="nama" > <li class="fas fa-store"></li> Nama Toko</label>
                  <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Toko" required>
                </div>
                <div class="form-group" >
                   <label for="satuan" > <li class="fas fa-map"></li> Alamat</label> </br>
                   <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat"  required></textarea>
                </div>
                <div class="form-group" >
                  <label for="satuan" > <li class="fas fa-phone"></li> telepon</label> </br>
                  <input type="number" name="telp" class="form-control" id="telp" placeholder="NO Telepon" required>
                </div>
                <div class="form-group" >
                  <label for="satuan" > <li class="fas fa-list"></li> Deskripsi</label> </br>
                  <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Deskripsi Toko"></textarea>
                </div>
                <div class="form-group" >
                  <label for="id_spv">Supervisor</label> </br>
                  <select class="form-control" name="id_spv" required="">
                  <option value="">-- PIlih Supervisor --</option>
                  <?php                       
                    foreach($list_spv as $spv):
                     ?>
                  <option value="<?=$spv->id ?>"><?=$spv->nama_user?></option>
                  <?php endforeach;?>
                  </select>
                </div>
                <div class="form-group" >
                  <label for="satuan" > <li class="fas fa-image"></li> Foto Toko</label> </br>
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

    
    <!-- jQuery -->
    <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
  <script>
    $(document).ready(function(){
    
      $('#table_toko').DataTable({
       
          responsive: true,
          lengthChange: false,
          autoWidth: false,
      });
      
    
    })
  </script>
  