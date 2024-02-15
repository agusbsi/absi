<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="card-header">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" style="width: 50%" src="<?= base_url('assets/img/user.png') ?>" alt="User profile picture">
              </div>
              <h3 class="text-center"><?= $profil->username ?></h3>
              <p class="text-center"><?= $profil->last_login ?></p>
             
            </div>
          </div>
        </div>
      </div>
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item">
                  <a class="nav-link active" href="#activity" data-toggle="tab">Settings</a>
                </li>
              </ul>
            </div>
            <script type="text/javascript">
            <?php if ($this->session->flashdata('msg_tidak')) { ?>
              swal.fire({
                Title: 'Warning!',
                text: '<?= $this->session->flashdata('msg_tidak') ?>',
                icon: 'warning',
                confirmButtonColor : '#3085d6',
                confirmButtonText: 'Ok' 
              })  
            <?php } ?>  
          </script>
          <script type="text/javascript">
            <?php if ($this->session->flashdata('tidak_sama')) { ?>
              swal.fire({
                Title: 'Warning!',
                text: '<?= $this->session->flashdata('tidak_sama') ?>',
                icon: 'warning',
                confirmButtonColor : '#3085d6',
                confirmButtonText: 'Ok' 
              })  
            <?php } ?>  
          </script>
          <script type="text/javascript">
            <?php if ($this->session->flashdata('upload_profil')) { ?>
              swal.fire({
                Title: 'Success!',
                text: '<?= $this->session->flashdata('upload_profil') ?>',
                icon: 'success',
                confirmButtonColor : '#3085d6',
                confirmButtonText: 'Ok' 
              })  
            <?php } ?>  
          </script>

          <div class="modal fade" id="ModalUploadProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title judul"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body card-primary card-outline">
                 <form action="<?= base_url('adm_gudang/profile/upload_profil') ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label>Foto Profil</label>
                      <input type="hidden" name="id" class="form-control">
                      <input type="file" name="foto_profil" class="form-control">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary" name="simpan">simpan</button> -->
                    <input class="btn btn-primary" type="submit" name="submit" value="Simpan">
                  </div>
                 </form>
                </div>
            </div> 
          </div>
            <div class="card-body ">
              <div class="post">
              <form method="POST" action="<?= base_url('adm_gudang/profile/ganti_password') ?>">
                <div class="form-group">
                  <label>Username</label>
                  <input class="form-control" type="hidden" name="id_user" value="<?= $profil->id ?>">
                  <input class="form-control" type="text" name="username" disabled="" value="<?= $profil->username ?>">
                </div>
                <div class="form-group">
                  <label>Role</label>
                  <?php  ?>
                  <input class="form-control" type="text" name="role" disabled="" value="<?= $lihat_role->nama ?>">
                </div>
                <div class="form-group">
                  <label>Password Lama</label>
                  <input type="password" class="form-control" type="text" name="pass_lama" required="">
                </div>
                <div class="form-group">
                  <label>Password Baru</label>
                  <input type="password" class="form-control" type="text" name="pass_baru" required="">
                </div>
                <div class="form-group">
                  <label>Konfirmasi Password</label>
                  <input type="password" class="form-control" type="text" name="konfirm" required="">
                </div>
                <div class="row justify-content-between">
                  <div class="col-auto mr-auto">
                    <a href="button" href="<?= base_url('adm_gudang/dashboard') ?>" class="btn btn-danger"><i class="fa fa-step-backward" aria-hidden="true"></i> Cancel</a>
                  </div>
                  <div class="col-auto">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Ganti Password</button>
                  </div>
                </div>
              </form> 
              </div> 
            </div>
          </div>
        </div>
    </div>
  </div>
</section>
