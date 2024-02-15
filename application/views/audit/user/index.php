     <!-- Main content -->
     <meta http-equiv="refresh" content="60">
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-users"></li> List User</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
            
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-right">
                    </div>
                </div>
                <table id ="table_user" class="table table-bordered table-striped">
                  <thead>
                    <tr class="text-center">
                        <th style="width:5%">No</th>
                        <th>Nama Lengkap</th>
                        <th>status</th>
                        <th>Role</th>
                        <th>Last Login</th>
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
                        <td class="text-center">
                        <?php
                        date_default_timezone_set('Asia/Jakarta');
                        $login = strtotime($dd->last_online);
                        $waktu = strtotime(date("Y-m-d h:i:sa"));
                        $hasil = $waktu - $login;
                        $menit = floor($hasil / 60);
                        if (($menit > 5) or ($dd->last_online == null) )
                        {
                          echo "<i class='fas fa-circle text-secondary text-sm'></i> Offline";
                        }else 
                        {
                          echo "<i class='fas fa-circle text-success text-sm'></i> Online";
                        }
                     
                        ?>
                        </td>
                        <td class="text-center"><?=role($dd->role)?></td>
                        <td class="text-center"><?= format_tanggal1($dd->last_login)?></td>
                        </tr>
                    <?php endforeach;?>
                    <?php }?>
                     
                  </tbody>
                  <tfoot>
                  <tr>
                  <th colspan="5"></th>
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
        $('#table_user').DataTable({
            order: [[0, 'asc']],
            responsive: true,
            lengthChange: false,
            autoWidth: false,
        });
      })
  </script>

