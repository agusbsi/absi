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
                          </div>
                        </td>
                        <td><?= status_user($dd->status) ?></td>
                        <td><?=role($dd->role)?></td>
                        <td><?= format_tanggal1($dd->last_login)?></td>
                        <td>
                        <a href="<?= base_url('hrd/user/detail/'.$dd->id) ?>" type="button" class="btn btn-warning"><i class="fas fa-cog"></i> Proses</a>
                        
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
  
    <!-- jQuery -->
    <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
    <script>
       $(document).ready(function(){
        // get Edit Product
        $('.btn-edit').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            const role_user = $(this).data('role_user');
            const no_telp = $(this).data('no_telp');
            const username = $(this).data('username');
            const nama_user = $(this).data('nama_user');
            // Set data to Form Edit
            $('.id').val(id);
            $('#reset_password').val(id);
            $('.role_user').val(role_user);
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
            window.location.href = "<?= base_url('hrd/user/reset_password/') ?>"+id;
          })
        });

       })
    </script>
    <script>
    $(document).ready(function(){
    
      $('#table_user').DataTable({
          order: [[2, 'asc']],
          responsive: true,
          lengthChange: false,
          autoWidth: false,
      });
      
    
    })
  </script>

