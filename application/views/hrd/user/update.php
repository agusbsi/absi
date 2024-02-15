<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-9">
        <form   method="post" action="<?= base_url('hrd/user/proses_update') ?>">
            <div class="card card-warning">
              
                <div class="card-header">
                  <h3 class="card-title"> <li class="fas fa-user-edit"></li> Update User</h3>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-two-tabContent">
                    <div class="tab-pane fade show active" id="supervisor" role="tabpanel" >
                                       
                        <div class="row">
                          <div class="col-md-6">
                          <label># Biodata</label>
                          <hr>
                            <div class="form-group">
                              <label>Nama Lengkap</label>
                              <input type="hidden" name="id_user" class="form-control " value="<?= $detail->id ?>" readonly>
                              <input type="text" name="nama_lengkap" class="form-control " value="<?= $detail->nama_user ?>" required>
                            </div>
                            <div class="form-group">
                              <label>NIK</label>
                              <input type="number" name="nik" class="form-control " value="<?= $detail->nik_ktp ?>" required>
                            </div>
                            <div class="form-group">
                              <label>Nomor Telepon / Wa</label>
                              <input type="number" name="no_telp" class="form-control " value="<?= $detail->no_telp ?>" required>
                            </div>
                            <div class="form-group">
                              <label>Email</label>
                              <input type="email" name="email" class="form-control " value="<?= $detail->email ?>" required>
                            </div>
                            <div class="form-group">
                              <label>Alamat</label>
                              <textarea name="alamat" class="form-control " required><?= $detail->alamat ?></textarea>
                            </div>
                            
                          </div>
                          <div class="col-md-6">
                            <label># Data Bank</label>
                              <hr>
                              <div class="form-group">
                                <label>Tipe bank</label>
                                <select name="type_bank" class="form-control" required>
                                  <option value="">- Tipe bank -</option>
                                  <?php foreach($tipe_bank as $tipe){ ?>
                                    <option value="<?= $tipe->id ?>" <?= ($tipe->id)== $detail->type_bank ? 'selected' : '' ?>><?= $tipe->nama_bank ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="form-group">
                              <label>Nomor Rekening</label>
                              <input type="number" name="no_rek" class="form-control " value="<?= $detail->rek_bank ?>" required>
                              </div>
                              <div class="form-group">
                                <label>Role Akses</label>
                                  <select name="role" class="form-control" required>
                                    <option value="">- Role Akses -</option>
                                    <?php foreach($role as $role){ ?>
                                      <option value="<?= $role->id ?>" <?= ($role->id)== $detail->role ? 'selected' : '' ?>><?= $role->nama ?></option>
                                    <?php } ?>
                                  </select>
                              </div>
                              <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control " value="<?= $detail->username ?>" readonly>
                              </div>
                              <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control " value="<?= $detail->password ?>" readonly>
                              </div>
                          </div>
                        </div>
                      
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right"><i class="fas fa-edit"></i> Update Data</button>
                  <a href="<?= base_url('hrd/User/') ?>" class="btn btn-danger float-right mr-3"><i class="fas fa-times-circle"></i> Close</a>
                </div>
                </form>
              </div>
          </div>
          <div class="col-md-3">
            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">Foto Selfi</h3>
              </div>
              <form id="updateFotoSelfi" method="post" enctype="multipart/form-data">
                <div class="card-body box-profile">
                  <img class="img-rounded " id ="foto_selfi" style="width: 200px;" src="" alt="Foto Ktp">
                    <div class="form-group">
                    <label for="foto">Ganti Foto :</label>
                    <input type="hidden" name="id_user_selfi" value="<?= $detail->id ?>">
                    <input type="hidden" name="nik_hidden" value="<?= $detail->nik_ktp ?>">
                    <input type="hidden" id="nama_foto_selfi" name="nama_foto_selfi" value="<?= $detail->foto_diri ?>">
                    <input type="file" class="form-control" id="foto_diri" name="foto_diri" multiple accept="image/png, image/jpeg, image/jpg" required></input>
                    <small>noted: Jenis foto yang diperbolehkan : JPG|JPEG|PNG & size maksimal : 2 mb</small>
                  </div>
                </div>
                <div class="card-footer text-center">
                  <button  class="btn btn-outline-primary btn-sm btn-foto">Update Foto</button>
                </div>
              </form>
            </div>
            <!-- kotak KTP -->
            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">Foto KTP</h3>
              </div>
              <form id="updateFotoForm" method="post" enctype="multipart/form-data">
                <div class="card-body box-profile">
                  <img class="img-rounded " id ="foto_ktp" style="width: 200px;" src="" alt="Foto Ktp">
                    <div class="form-group">
                    <label for="foto">Ganti Foto :</label>
                    <input type="hidden" name="id_user_ktp" value="<?= $detail->id ?>">
                    <input type="hidden" name="nik_h" value="<?= $detail->nik_ktp ?>">
                    <input type="hidden" id="nama_foto" name="nama_foto" value="<?= $detail->foto_ktp ?>">
                    <input type="file" class="form-control" id="foto" name="foto" multiple accept="image/png, image/jpeg, image/jpg" required></input>
                    <small>noted: Jenis foto yang diperbolehkan : JPG|JPEG|PNG & size maksimal : 2 mb</small>
                  </div>
                </div>
                <div class="card-footer text-center">
                  <button  class="btn btn-outline-primary btn-sm btn-foto">Update Foto</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>


<!-- jQuery -->
<script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
  <script>
    $(document).ready(function(){
      var image = document.getElementById('foto_ktp');
      var ftoko = $('#nama_foto').val();
      image.src = '<?= base_url('assets/img/user/')?>'+ ftoko;
      var selfi = document.getElementById('foto_selfi');
      var fselfi = $('#nama_foto_selfi').val();
      selfi.src = '<?= base_url('assets/img/user/')?>'+ fselfi;

       // update foto selfi
          $('#updateFotoSelfi').submit(function(e) {
          e.preventDefault();
          $.ajax({
            url: '<?php echo base_url("hrd/User/update_foto_selfi"); ?>',
            type: 'post',
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType : 'json',
            success: function(data) {
              // Tampilkan pesan sukses
              Swal.fire(
              'Berhasil Update Foto',
              'Foto Selfi berhasil di perbaharui!',
              'success'
            )
              $('#foto_selfi').attr({src: "<?= base_url('assets/img/user/')?>" + data.user.foto_diri});
            },
            error: function(data) {
              // menampilkan pesan eror
            Swal.fire(
              'Gagal Update Foto',
              'Silahkan cek kembali jenis & ukuran foto !',
              'error'
            )
            }
          });
        });
        // end foto
       // update foto ktp
          $('#updateFotoForm').submit(function(e) {
          e.preventDefault();
          $.ajax({
            url: '<?php echo base_url("hrd/User/update_foto"); ?>',
            type: 'post',
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType : 'json',
            success: function(data) {
              // Tampilkan pesan sukses
              Swal.fire(
              'Berhasil Update Foto',
              'Foto User berhasil di perbaharui!',
              'success'
            )
              $('#foto_ktp').attr({src: "<?= base_url('assets/img/user/')?>" + data.user.foto_ktp});
            },
            error: function(data) {
              // menampilkan pesan eror
            Swal.fire(
              'Gagal Update Foto',
              'Silahkan cek kembali jenis & ukuran foto !',
              'error'
            )
            }
          });
        });
        // end foto


      // tombol reject di klick
      $('.btn-nonaktif').click(function(e){
          e.preventDefault();
          Swal.fire({
            title: 'Apakah anda yakin?',
            text: "User ini akan di NONAKTIFKAN",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Yakin'
          }).then((result) => {
            if (result.isConfirmed) {
              const id = $(this).data('id');
              window.location.href = "<?= base_url('hrd/user/hapus/') ?>"+id;
            }
          })
        })
    
      $('#table_stok').DataTable({
       
          responsive: true,
          lengthChange: false,
          autoWidth: false,
      });
      
    
    })
  </script>
