<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="card-header">
              <div class="text-center">
                <?php if ($profil->foto_diri == null) { ?>
                <img class="profile-user-img img-fluid img-circle" style="width: 50%" src="<?= base_url('assets/img/user.png') ?>" alt="User profile picture">
              <?php }else{ ?>
                <img class="profile-user-img img-fluid img-circle" style="width: 50%" src="<?= base_url('assets/img/user/') .$profil->foto_diri ?>" alt="User profile picture">                
              <?php } ?>
              </div>
              <h3 class="text-center"><?= $profil->nama_user ?></h3>
              <p class="text-center"><?= $profil->last_login ?></p>
             
            </div>
          </div>
        </div>
      </div>
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-cog"></li> Setting</h3>
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

            <div class="card-body ">
              <div class="post">
              <form method="POST" action="<?= base_url('profile/ganti_password') ?>">
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
                  <input class="form-control" type="password" name="pass_lama" required="">
                </div>
                <div class="form-group">
                  <label>Password Baru</label>
                  <input class="form-control" type="password" name="pass_baru" required="">
                </div>
                <div class="form-group">
                  <label>Konfirmasi Password</label>
                  <input class="form-control" type="password" name="konfirm" required="">
                </div>
                <div class="row justify-content-between">
                  <div class="col-auto mr-auto">
                    <a href="button" href="<?= base_url('sup/dashboard') ?>" class="btn btn-danger"><i class="fa fa-step-backward" aria-hidden="true"></i> Cancel</a>
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
