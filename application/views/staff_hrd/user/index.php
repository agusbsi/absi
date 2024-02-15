     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
    
            <!-- /.card -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-users"></li> Kelola Data User</h3>
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
                    <button type="button" class="btn btn-success" data-toggle="modal"  data-target="#modal-tambah" ><li class="fas fa-plus"></li>
                      Tambah User
                    </button>
                    
                    </div>
                </div>
                <hr>
                <table id ="table_user" class="table table-bordered table-striped">
                  <thead>
                    <tr class="text-center">
                        <th style="width:5%">No</th>
                        <th>Nama Lengkap</th>
                        <th>status</th>
                        <th>Role</th>
                        <th>Last Login</th>
                        <th>Menu</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <?php if(is_array($list_users)){ ?>
                    <?php 
                    $no = 0;
                    foreach($list_users as $dd):
                    $no++; ?>
                        <td class="text-center"><?=$no?></td>
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
                        <td class="text-center"><?= status_user($dd->status) ?></td>
                        <td class="text-center"><?=role($dd->role)?></td>
                        <td class="text-center"><?= format_tanggal1($dd->last_login)?></td>
                        <td class="text-center">
                        <a href="<?= base_url('staff_hrd/user/detail/'.$dd->id) ?>" class="btn btn-primary"><i class="fas fa-eye"></i> Detail</a>
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
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> <li class="fas fa-plus-circle"></li> Form Tambah User</h4>
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
              <div class="row">
                <div class="col-md-5">
                  <!-- isi konten -->
                  <?php echo form_open_multipart('staff_hrd/user/proses_tambah_baru'); ?>
                  <div class="form-group" >
                      <label for="nama" > <li class="fas fa-user"></li> Nama Lengkap</label> </br>
                      <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap" required="">
                  </div>
                  <div class="form-group " >
                        <label for="telp" > <li class="fas fa-phone"></li> No. Telp</label> </br>
                        <input type="number" name="telp" class="form-control" id="telp" placeholder="No telp / wa" required="">
                      </div>
                    <div class="form-group">
                      <label for="nik" > <li class="fas fa-id-card"></li> NIK KTP</label>
                      <input type="number" name="nik_ktp" class="form-control" id="nik" placeholder="NIK KTP" required>
                    </div>
                    <div class="form-group" >
                      <label for="alamat" > <li class="fas fa-at"></li> Email</label> </br>
                      <input type="email" name="email" class="form-control" id="email" placeholder="exampleuser@gmail.com" required="">
                    </div>
                    <div class="form-group" >
                      <label for="alamat" > <li class="fas fa-map"></li> Alamat</label> </br>
                      <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat" required=""></textarea>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-5">
                        <label id="id_bank">Jenis Bank</label>
                        <select name="id_bank" class="form-control select2bs4" id="id_bank" required>
                        <option value="">Pilih Bank</option>
                        <?php foreach ($list_bank as $l) { ?>
                          <option value="<?= $l->id ?>"><?= $l->nama_bank ?></option>
                        <?php } ?>
                      </select>
                      </div>
                      <div class="form-group col-md-7">
                        <label id="norek">No. Rekening</label>
                        <input type="text" name="no_rek" id="norek" placeholder="Nomor Rekening Bank" required="" class="form-control">
                      </div>
                    </div>
                  <!-- end konten -->
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-5">
                    <div class="form-group" >
                      <label for="id_role">Role User</label> </br>
                      <select name="id_role" class="form-control select2bs4" id="id_role" required>
                        <option value="">Pilih Role</option>
                        <?php foreach ($list_role as $l) { ?>
                          <option value="<?= $l->id ?>"><?= $l->nama ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group foto_selfie d-none" >
                      <label for="foto" > <li class="fas fa-image"></li> Foto Selfie</label> </br>
                      <input type="file" name="selfi" class="form-control" id="selfie" placeholder="Foto User" accept="image/png, image/jpeg, image/jpg" >
                      <small>* jenis foto yang di perbolehkan : JPEG,JPG,PNG  & Ukuran maksimal : 2mb</small>
                      <br>
                      <label for="foto" > <li class="fas fa-image"></li> Foto KTP</label> </br>
                      <input type="file" name="ktp" class="form-control" id="ktp" placeholder="Foto ktp" accept="image/png, image/jpeg, image/jpg" >
                      <small>* jenis foto yang di perbolehkan : JPEG,JPG,PNG  & Ukuran maksimal : 2mb</small>
                    </div>
                  
                    <hr>
                    <div class="form-group">
                      <label >Username</label>
                      <input type="text" name="username" class="form-control" id="username" required="" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <label id="pass">Password</label>
                      <input type="password" name="pass" class="form-control" id="pass" required="" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label id="konfirm">Konfirm Password</label>
                      <input type="password" name="konfirm" class="form-control" id="konfirm" required="" placeholder="Konfirmasi Password">
                    </div>
                </div>
                  </div>
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
                <?php echo form_close(); ?>
            <!-- </form> -->
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
         // cek nik di input lebih dari 15 karakter
          $('#nik').change(function(){
          const input_nik = $('#nik').val();
          const jml_input = input_nik.length;
          if (jml_input > 12)
          {
            // Ambil data dari form
              var nik = $(this).val();
              
              // Kirim data ke controller MyTable dengan AJAX
              $.ajax({
                url: "<?php echo base_url('staff_hrd/user/cek_nik') ?>",
                type: "POST",
                dataType: "JSON",
                data: {nik:nik},
                success: function(data) {
                  if (data == true) {
                    Swal.fire('NIK SUDAH ADA','NIK sudah di daftarkan, silahkan periksa kembali!','error');
                    $('#nik').val('');
                  } 
                }
              });
          }
          })

          // cek username
          $('#username').change(function(){
            var username = $(this).val()
            // Kirim data ke controller MyTable dengan AJAX
            $.ajax({
                url: "<?php echo base_url('staff_hrd/user/cek_username') ?>",
                type: "POST",
                dataType: "JSON",
                data: {username:username},
                success: function(data) {
                  if (data == true) {
                    Swal.fire('USERNAME SUDAH ADA','silahkan input dengan username yang lain!','error');
                    $('#username').val('');
                  } 
                }
              });
          })
        // get Edit Product
        $('.btn-edit').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            const nik = $(this).data('nik');
            const nama_user = $(this).data('nama_user');
            const no_telp = $(this).data('no_telp');
            const alamat = $(this).data('alamat');
            const jenis = $(this).data('jenis');
            const nama_bank = $(this).data('nama_bank');
            const rek_bank = $(this).data('rek_bank');
            const role_user = $(this).data('role_user');
            const username = $(this).data('username');
            const status = $(this).data('status');
            // Set data to Form Edit
            $('.id').val(id);
            $('#reset_password').val(id);
            $('.nik').val(nik);
            $('.nama_user').val(nama_user);
            $('.no_telp').val(no_telp);
            $('.alamat').val(alamat);
            $('.jenis').val(jenis);
            $('.nama_bank').val(nama_bank);
            $('.rek_bank').val(rek_bank);
            $('.role_user').val(role_user);
            $('.username').val(username);
            $('.status').val(status);
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
            window.location.href = "<?= base_url('staff_hrd/user/reset_password/') ?>"+id;
          })
        });

          // pilih role
        $('select[name="id_role"]').on('change', function()
        {
          if(($(this).val() == "4"))
          {
            $('.foto_selfie').removeClass("d-none");
            document.getElementById("selfie").required = true;
            document.getElementById("ktp").required = true;
          }else{
            $('.foto_selfie').addClass("d-none");
            document.getElementById("selfie").required = false;
            document.getElementById("ktp").required = false;
          }
        });

       })
    </script>
    <script>
    $(document).ready(function(){
    
      $('#table_user').DataTable({
          order: [[0, 'asc']],
          responsive: true,
          lengthChange: false,
          autoWidth: false,
      });
      
    
    })
  </script>

