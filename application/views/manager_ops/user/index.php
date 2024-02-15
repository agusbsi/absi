     <!-- Main content -->
     <section class="content">
       <div class="container-fluid">
         <div class="row">
           <div class="col-12">
             <div class="card card-info">
               <div class="card-header">
                 <h3 class="card-title">
                   <li class="fas fa-users"></li> List Team Leader dan SPG
                 </h3>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                   <thead>
                     <tr class="text-center">
                       <th style="width:5%">No</th>
                       <th>Nama Lengkap</th>
                       <th>Telp</th>
                       <th>Role</th>
                       <th>status</th>
                       <th>Last Login</th>
                     </tr>
                   </thead>
                   <tbody>
                     <tr>
                       <?php if (is_array($list_users)) { ?>
                         <?php
                          $no = 0;
                          foreach ($list_users as $dd) :
                            $no++; ?>
                           <td class="text-center"><?= $no ?></td>
                           <td>
                             <div class="user-block">
                               <?php if ($dd->foto_diri == null) { ?>
                                 <img class="img-circle img-bordered-sm" src="<?= base_url('assets/img/user.png') ?>">
                               <?php } else { ?>
                                 <img class="img-circle img-bordered-sm" src="<?= base_url('assets/img/user/') . $dd->foto_diri ?>">
                               <?php } ?>
                               <span class="username">
                                 <a href="#"><?= $dd->nama_user ?></a>
                               </span>
                               <span class="description">
                                 <?php
                                  date_default_timezone_set('Asia/Jakarta');
                                  $login = strtotime($dd->last_online);
                                  $waktu = strtotime(date("Y-m-d h:i:sa"));
                                  $hasil = $waktu - $login;
                                  $menit = floor($hasil / 60);
                                  if (($menit > 5) or ($dd->last_online == null)) {
                                    echo "<i class='fas fa-circle text-secondary text-sm'></i> Offline";
                                  } else {
                                    echo "<i class='fas fa-circle text-success text-sm'></i>&nbsp; Online";
                                  }

                                  ?>
                               </span>
                             </div>
                           </td>
                           <td class="text-center"><?= $dd->no_telp; ?></td>
                           <td class="text-center"><?= role($dd->role) ?></td>
                           <td class="text-center"><?= status_user($dd->status) ?></td>
                           <td class="text-center"><?= format_tanggal1($dd->last_login) ?></td>
                     </tr>
                   <?php endforeach; ?>
                 <?php } ?>

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
             <h4 class="modal-title">
               <li class="fas fa-plus-circle"></li> Form Tambah User
             </h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body">
             <div class="row">
               <div class="col-md-5">
                 <!-- isi konten -->
                 <?php echo form_open_multipart('hrd/user/proses_tambah_baru'); ?>
                 <div class="form-group">
                   <label for="nama">
                     <li class="fas fa-user"></li> Nama Lengkap
                   </label> </br>
                   <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap" required="">
                 </div>
                 <div class="form-group ">
                   <label for="telp">
                     <li class="fas fa-phone"></li> No. Telp
                   </label> </br>
                   <input type="number" name="telp" class="form-control" id="telp" placeholder="No telp / wa" required="">
                 </div>
                 <div class="form-group">
                   <label for="nik">
                     <li class="fas fa-id-card"></li> NIK KTP
                   </label>
                   <input type="number" name="nik_ktp" class="form-control" id="nik" placeholder="NIK KTP" required>
                 </div>
                 <div class="form-group">
                   <label for="alamat">
                     <li class="fas fa-at"></li> Email
                   </label> </br>
                   <input type="email" name="email" class="form-control" id="email" placeholder="exampleuser@gmail.com" required="">
                 </div>
                 <div class="form-group">
                   <label for="alamat">
                     <li class="fas fa-map"></li> Alamat
                   </label> </br>
                   <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat" required=""></textarea>
                 </div>
                 <div class="row">
                   <div class="form-group col-md-5">
                     <label id="id_bank">Jenis Bank</label>
                     <select name="id_bank" class="form-control select2bs4" id="id_bank">
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
                 <div class="form-group">
                   <label for="id_role">Role User</label> </br>
                   <select name="id_role" class="form-control select2bs4" id="id_role" required>
                     <option value="">Pilih Role</option>
                     <?php foreach ($list_role as $l) { ?>
                       <option value="<?= $l->id ?>"><?= $l->nama ?></option>
                     <?php } ?>
                   </select>
                 </div>
                 <div class="form-group foto_selfie d-none">
                   <label for="foto">
                     <li class="fas fa-image"></li> Foto Selfie
                   </label> </br>
                   <input type="file" name="selfi" class="form-control" id="selfie" placeholder="Foto User" accept="image/png, image/jpeg, image/jpg">
                   <small>* jenis foto yang di perbolehkan : JPEG,JPG,PNG & Ukuran maksimal : 2mb</small>
                   <br>
                   <label for="foto">
                     <li class="fas fa-image"></li> Foto KTP
                   </label> </br>
                   <input type="file" name="ktp" class="form-control" id="ktp" placeholder="Foto ktp" accept="image/png, image/jpeg, image/jpg">
                   <small>* jenis foto yang di perbolehkan : JPEG,JPG,PNG & Ukuran maksimal : 2mb</small>
                 </div>

                 <hr>
                 <div class="form-group">
                   <label>Username</label>
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
             <button type="button" class="btn btn-danger" data-dismiss="modal">
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