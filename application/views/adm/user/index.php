     <!-- Main content -->
     <meta http-equiv="refresh" content="60">
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
    
            <!-- /.card -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-cube"></li> Data User</h3>
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
                        <th>No</th>
                        <th>Nama User</th>
                        <th class="text-center">Role</th>
                        <th class="text-center">username</th>
                        <th>status</th>
                        <th>Last Login</th>
                        <th class="text-center">Menu</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <?php if(is_array($list_users)){ ?>
                    <?php 
                    $no = 0;
                    foreach($list_users as $dd):
                    $no++; ?>
                        <td><?=$no?></td>
                        <td>
                          <div class="user-block">
                            <?php if ($dd->foto_diri == null) { ?>
                              <img class="img-circle img-bordered-sm" src="<?= base_url('assets/img/user.png') ?>">
                            <?php }else{ ?>
                              <img class="img-circle img-bordered-sm" src="<?= base_url('assets/img/user/') .$dd->foto_diri ?>">                
                            <?php } ?>
                              <span class="username">
                                <a href="#"><?=$dd->nama_user?></a>
                              </span>
                              <span class="description">Telp : <?= $dd->no_telp;?></span>
                              <span class="description">
                                <?php
                                  date_default_timezone_set('Asia/Jakarta');
                                  $login = strtotime($dd->last_online);
                                  $waktu = strtotime(date("Y-m-d h:i:sa"));
                                  $hasil = $waktu - $login;
                                  $menit = floor($hasil / 60);
                                  if (($menit > 5) or ($dd->last_online == null) )
                                  {
                                    echo"<i class='fas fa-circle text-secondary text-sm'></i> Offline";
                                  }else{
                                    echo "<i class='fas fa-circle text-success text-sm'></i>&nbsp; Online";
                                  }
                              
                                ?>
                              </span>
                          </div>
                        </td>
                        <td class="text-center"><?=role($dd->role)?></td>
                        <td class="text-center"><?=$dd->username?></td>
                        <td class="text-center">
                            <?= status_user($dd->status) ?>
                        </td>
                        <td class="text-center"><?= format_tanggal1($dd->last_login)?></td>
                        <td>
                        <a href="<?= base_url('adm/User/detail/'.$dd->id) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Detail</a>
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
                    <h4 class="modal-title"> <li class="fas fa-cube"></li> Form Tambah User</h4>
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
                    <form method="POST" action="<?= base_url('adm/user/proses_tambah')?>">
                      <div class="form-group">
                        <label for="user" >Username</label>
                        <input type="text" name="username" class="form-control" id="user" placeholder="Username" required="">
                      </div>
                      <div class="form-group">
                        <label for="pass" >Password</label>
                        <input type="password" name="pass" class="form-control" id="pass" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                        <label for="konfirm" >Konfirmasi Password</label>
                        <input type="password" name="konfirm" class="form-control" id="konfirm" placeholder="Konfirmasi Password" required>
                      </div>
                      <div class="form-group">
                        <label for="nama_user" >Nama User</label>
                        <input type="text" name="nama_user" class="form-control" id="nama_user" placeholder="Nama User" required>
                      </div>
                      <div class="form-group">
                        <label for="no_telp" >No. Telp</label>
                        <input type="number" name="no_telp" class="form-control" id="no_telp" placeholder="No. Telp" required>
                      </div>
                      
                      <div class="form-group" >
                        <label for="satuan">Role</label> </br>
                        <select class="form-control" name="role" required="">
                        <option value="">-- PIlih Role --</option>
                          <?php                       
                            foreach($list_role as $roles):
                          ?>
                        <option value="<?=$roles->id ?>"><?=$roles->nama?></option>
                        <?php endforeach;?>
                        </select>
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
    <form action="<?= base_url('adm/user/proses_update')?>" method="POST">
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <li class="fas fa-edit"></li> Update Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Username</label>
                    
                    <input type="text" class="form-control username" name="username" readonly="">
                </div>
                <div class="form-group">
                    <label>Nama User</label>
                    <input type="text" class="form-control nama_user" name="nama_user" placeholder=" Nama User">
                </div>
                <div class="form-group">
                    <label>No. Telp</label>
                    <input type="text" class="form-control no_telp" name="no_telp" placeholder="Deskripsi">
                </div>
                <div class="form-group" >
                  <label for="satuan">Role</label> </br>
                  <select class="form-control role" name="role">
                  <option value="">-- PIlih Role --</option>
                  <?php                       
                    foreach($list_role as $roles):
                     ?>
                  <option value="<?=$roles->id ?>"><?=$roles->nama?></option>
                  <?php endforeach;?>
                  </select>
                </div>
                
                
                
                
             
            </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                  <li class="fas fa-times-circle"></li> Cancel
                </button>
                  <div class="form-group">
                    <input type="hidden" name="id" class="id">
                    <a type="btn" class="btn btn-warning btn-reset"><i class="fas fa-sync-alt"></i> Reset Password</a>
                  </div>
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
            const role = $(this).data('nama');
            const no_telp = $(this).data('no_telp');
            const username = $(this).data('username');
            const nama_user = $(this).data('nama_user');
            // Set data to Form Edit
            $('.id').val(id);
            $('#reset_password').val(id);
            $('.role').val(role);
            $('.no_telp').val(no_telp);
            $('.username').val(username);
            $('.nama_user').val(nama_user);
            // Call Modal Edit
            $('#editModal').modal('show');
        });
        $('.btn-reset').on('click',function(){
            // get data from button edit
            Swal.fire({
              title: 'Apakah anda yakin',
              text: "Ingin Mereset Password?",
              icon: 'Warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Batal',
              confirmButtonText: 'Yakin'              
            }).then((result) => {
            const id = $('.id').val();
            window.location.href = "<?= base_url('adm/user/reset_password/') ?>"+id;
          })
        });

       })
    </script>

