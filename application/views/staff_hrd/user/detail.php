<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-info card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
              <?php if($foto->foto_diri=="") { 
                ?>
                <img style="width: 100%;" class="profile-user-img img-responsive img-rounded" src="<?php echo base_url()?>assets/img/user.png" alt="User profile picture">
                <?php
                }else{ ?>
                <img style="width: 100%;" class="profile-user-img img-responsive img-rounded" src="<?php echo base_url('assets/img/user/'.$foto->foto_diri)?>" alt="User profile picture">
              <?php } ?> 
                </div>
                <br>
                <h3 class="profile-username text-center"><strong><?=$detail->nama_user?></strong></h3>
                <h4 class="text-center"><?= status_user($detail->status) ?></h4>
                <p class="text-center">
                  <?php
                    date_default_timezone_set('Asia/Jakarta');
                    $login = strtotime($detail->last_online);
                    $waktu = strtotime(date("Y-m-d h:i:sa"));
                    $hasil = $waktu - $login;
                    $menit = floor($hasil / 60);
                    if (($menit > 5) or ($detail->last_online == null) )
                      {
                        echo"<i class='fas fa-circle text-secondary text-sm'></i> Offline";
                      }else{
                        echo "<i class='fas fa-circle text-success text-sm'></i>&nbsp; Online";
                      }
                  ?>
                </p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <!-- isi konten manajement user -->
             <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-user"></li> Detail User</h3>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                  <div class="tab-pane fade show active" id="supervisor" role="tabpanel" >
                    <form class="form-horizontal"  method="post" action="<?= base_url('hrd/user/proses_approve') ?>">                 
                      <table  class="table ">
                        <thead>                      
                        </thead>
                        <tbody>
                          <tr>
                            <th># Biodata</th>
                          </tr>
                          <tr>
                            <td style="width: 15%">Nama Lengkap</td>
                            <td style="width: 3%"> : </td>
                            <td style="width: 60%"><?= $detail->nama_user ?></td>
                          </tr>
                          <tr>
                            <td style="width: 15%">Nomor Telepon</td>
                            <td style="width: 3%"> : </td>
                            <td style="width: 60%"><?= $detail->no_telp ?></td>
                          </tr>
                          <tr>
                            <td style="width: 15%">Email</td>
                            <td style="width: 3%"> : </td>
                            <td style="width: 60%"><?= $detail->email ?></td>
                          </tr>
                          <tr>
                            <td style="width: 15%">Alamat</td>
                            <td style="width: 3%"> : </td>
                            <td style="width: 60%"><?= $detail->alamat ?></td>
                          </tr>
                          
                          <tr>
                            <th># Data Bank</th>
                          </tr>
                          <tr>
                            <td style="width: 15%">Type Bank</td>
                            <td style="width: 3%"> : </td>
                            <td style="width: 60%"><?= $detail->nama_bank ?></td>
                          </tr>
                          <tr>
                            <td style="width: 15%">Nomor Rekening</td>
                            <td style="width: 3%"> : </td>
                            <td style="width: 60%"><?= $detail->rek_bank ?></td>
                          </tr>
                          <tr>
                            <th># Lampiran</th>
                          </tr>
                          <tr>
                            <td style="width: 15%">NIK KTP</td>
                            <td style="width: 3%"> : </td>
                            <td style="width: 60%"><?= $detail->nik_ktp ?></td>
                          </tr>
                          <tr>
                            <td style="width: 15%">FOTO KTP</td>
                            <td style="width: 3%"> : </td>
                            <td style="width: 60%">
                              <?php if($detail->foto_ktp=="") { 
                              ?>
                              <img style="width:40%;" class="card-img-top" src="<?php echo base_url()?>assets/img/user.png" alt="foto ktp">
                              <?php
                              }else{ ?>
                              <img style="width:40%;" class="card-img-top" src="<?php echo base_url('assets/img/user/'.$detail->foto_ktp)?>" alt="foto ktp">
                            <?php } ?> 
                            </td>
                          </tr>
                          <tr>
                            <td style="width: 15%">FOTO SELFI</td>
                            <td style="width: 3%"> : </td>
                            <td style="width: 60%">
                              <?php if($detail->foto_diri=="") { 
                              ?>
                              <img style="width:40%;" class="card-img-top" src="<?php echo base_url()?>assets/img/user.png" alt="foto ktp">
                              <?php
                              }else{ ?>
                              <img style="width:40%;" class="card-img-top" src="<?php echo base_url('assets/img/user/'.$detail->foto_diri)?>" alt="foto ktp">
                            <?php } ?> 
                            </td>
                          </tr>
                          <tr>
                            <th># Akses Aplikasi</th>
                          </tr>
                          <tr>
                            <td style="width: 15%">Role Akses</td>
                            <td style="width: 3%"> : </td>
                            <td style="width: 60%"><?= $detail->role_akses ?></td>
                          </tr>
                          <tr>
                            <td style="width: 15%">Nama User</td>
                            <td style="width: 3%"> : </td>
                            <td style="width: 60%"><?= $detail->username ?></td>
                          </tr>
                          <tr>
                            <td style="width: 15%">Password</td>
                            <td style="width: 3%"> : </td>
                            <td style="width: 60%">****************</td>
                          </tr>
                          <tr>
                            <td style="width: 15%">Dibuat pada</td>
                            <td style="width: 3%"> : </td>
                            <td style="width: 60%"><?= $detail->created_at ?></td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="row no-print">
                        <div class="col-12">
                          <?php 
                          date_default_timezone_set('Asia/Jakarta');
                          ?>
                        <input type="hidden" name="updated" class="form-control"  readonly="readonly" value="<?php echo date('Y-m-d H:i:s'); ?>"> 
                        <input type="hidden" name="id_user" value="<?= $detail->id ?>">  
                      
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
            <!-- end manajement user -->
            <hr>
            <!-- manajement stok -->
            </div>
        <!-- /.card -->
            <!-- end stok -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->



<!-- jQuery -->
<script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
  <script>
    $(document).ready(function(){
    
      $('#table_stok').DataTable({
       
          responsive: true,
          lengthChange: false,
          autoWidth: false,
      });
      
    
    })
  </script>

  <script>
    // aksi edit produk
      $('.btn_update').click(function(){
        var id = $(this).data("id");
        var produk = $(this).data("produk");
        var kode = $(this).data("kode");
        var qty = $(this).data("qty");

        $("#id_produk").val(id);
        $("#produk").val(produk);
        $("#kode").val(kode);
        $("#qty_sebelum").val(qty);
      })



  </script>

