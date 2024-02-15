     <!-- Main content -->
     <meta http-equiv="refresh" content="60">
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
    
            <!-- /.card -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-users"></li> List Team Leader yang dikelola</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              
                <table id ="table_user" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th style = "width: 5%">No</th>
                        <th>Nama User</th>
                        <th>username</th>
                        <th>status</th>
                        <th>Role</th>
                        <th>No. Telp</th>
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
                        <td><?=$dd->nama_user?></td>
                        <td><?=$dd->username?></td>
                        <td>
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
                        <td>
                        <?php 
                            if($dd->role==3){
                               echo " Team Leader "; 
                            }else{
                                echo ""; 
                            }
                            ?>
                          </td>
                        <td><?=$dd->no_telp?></td>
                        <td><?= format_tanggal1($dd->last_login)?></td>
                       
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
    <!-- jQuery -->
  <script src="<?php echo base_url()?>/assets/plugins/jquery/jquery.min.js"></script>
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

