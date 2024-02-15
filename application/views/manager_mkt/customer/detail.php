     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
    
            <!-- /.card -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-hospital"></li> Data Detail</h3>
                  <div class="card-tools">
                    <a href="<?= base_url('mng_mkt/Customer') ?>" type="button" class="btn btn-tool" >
                      <i class="fas fa-times"></i>
                    </a>
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <div class="row">
                <div class="col-md-3">
                  <div class="callout callout-danger text-center">
                    <strong><?= $customer->nama_cust?></strong>
                    <br>
                    [ ID : <?= $customer->id ?> ]
                  </div>
                </div>
                <div class="col-md-9">
                <div class="card card-primary card-outline card-outline-tabs">
                  <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Alamat</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">PIC & Telp</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">T.O.P & Tagihan</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Berkas</a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                      <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                      <form action="<?=base_url('mng_mkt/Customer/update_alamat') ?>" method="POST">  
                      <div class="form-group">
                          <textarea name="c" class="form-control" readonly id="alamat_read" cols="1" rows="3"><?= $customer->alamat_cust ?></textarea>
                          <textarea name="alamat" class="form-control d-none" id="alamat" cols="1" rows="3"><?= $customer->alamat_cust ?></textarea>
                          <input type="hidden" name="id_cust" value="<?= $customer->id ?>">
                        </div>
                        
                          <hr>
                          <button type="submit" class="btn btn-warning btn-sm btn-save d-none float-right"><i class="fas fa-save"></i> Simpan</button>
                          <a class="btn btn-outline-warning btn-sm btn-edit float-right"><i class="fas fa-edit"></i> Update</a>
                          </form>
                      </div>
                      <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                      <form action="<?=base_url('mng_mkt/Customer/update_pic') ?>" method="POST"> 
                      <div class="forn-group">
                        <label for="">Nama PIC :</label>
                        <input type="text" class="form-control pic_read" value="<?= $customer->nama_pic ?>" readonly>
                        <input type="text" class="form-control pic d-none" name="pic" value="<?= $customer->nama_pic ?>" >
                        <input type="hidden" name="id_cust" value="<?= $customer->id ?>">
                      </div> 
                      <div class="forn-group">
                        <label for="">Telp :</label>
                        <input type="number" class="form-control telp_read" value="<?= $customer->telp ?>" readonly>
                        <input type="number" class="form-control telp d-none" name="telp" value="<?= $customer->telp ?>" >
                      </div> 
                      
                      <hr>
                       <button type="submit" class="btn btn-warning btn-sm btn-save_pic d-none float-right"><i class="fas fa-save"></i> Simpan</button>
                        <a class="btn btn-outline-warning btn-sm btn-edit_pic float-right"><i class="fas fa-edit"></i> Update</a>
                        </form>
                      </div>
                      <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                        <form action="<?=base_url('mng_mkt/Customer/update_top') ?>" method="POST"> 
                          <div class="forn-group">
                            <label for="">T.O.P :</label>
                            <input type="hidden" name="id_cust" value="<?= $customer->id ?>">
                            <input type="number" class="form-control top_read" value="<?= $customer->top ?>" readonly>
                            <input type="number" class="form-control top d-none" name="top" value="<?= $customer->top ?>">
                          </div> 
                          <div class="forn-group">
                            <label for="">Dari :</label>
                            <input type="text" class="form-control tagihan_read" value="<?= $customer->tagihan ?>" readonly>
                            <select name="tagihan" class="form-control tagihan d-none" id="" required>
                              <option value="Tanggal Invoice"<?= ($customer->tagihan)=="Tanggal Invoice" ? 'selected' : ''?>>Tanggal Invoice</option>
                              <option value="Tanggal LPT"<?= ($customer->tagihan)=="Tanggal LPT" ? 'selected' : ''?>>Tanggal LPT</option>
                            </select>
                          </div> 
                          <hr>
                        <button type="submit" class="btn btn-warning btn-sm btn-save_top d-none float-right"><i class="fas fa-save"></i> Simpan</button>
                        <a class="btn btn-outline-warning btn-sm btn-edit_top float-right"><i class="fas fa-edit"></i> Update</a>
                        </form>
                      </div>
                      <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                       <div class="row">
                        <div class="col-md-5">
                          <form id="updatektp" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                              <label for="">Foto KTP:</label> <br>
                              <img class="img-rounded " id ="foto_ktp" style="width: 70%;" class="img img-rounded " src="" alt="Foto ktp">
                              <input type="hidden" name="id_cust" value="<?= $customer->id ?>">
                              <input type="hidden" id="nama_foto" name="nama_foto" value="<?= $customer->foto_ktp ?>">
                              <input type="file" class="form-control" id="foto" name="foto_ktp" multiple accept="image/png, image/jpeg, image/jpg" required></input>
                              <small>noted: Jenis foto yang diperbolehkan : JPG|JPEG|PNG & size maksimal : 2 mb</small>
                            </div>
                            <hr>
                            <button  class="btn btn-outline-warning btn-sm btn-foto_ktp float-right">Update Foto</button>
                          </form>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-5">
                          <form id="updatenpwp" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                              <label for="">Foto NPWP:</label> <br>
                              <img class="img-rounded " id ="foto_npwp" style="width: 70%;" class="img img-rounded " src="" alt="Foto npwp">
                              <input type="hidden" name="id_cust" value="<?= $customer->id ?>">
                              <input type="hidden" id="nama_foto_npwp" name="nama_foto_npwp" value="<?= $customer->foto_npwp ?>">
                              <input type="file" class="form-control" name="foto_npwp" multiple accept="image/png, image/jpeg, image/jpg" required></input>
                              <small>noted: Jenis foto yang diperbolehkan : JPG|JPEG|PNG & size maksimal : 2 mb</small>
                            </div>
                            <hr>
                            <button  class="btn btn-outline-warning btn-sm btn-foto_npwp float-right">Update Foto</button>
                          </form>
                        </div>
                       </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card -->
                </div>
                </div>
               </div>
               <!-- data toko -->
               <hr>
               <div class="card-default">
                <div class="card-header">
                  <h3 class="card-title"> <li class="fas fa-store"></li> List Toko</h3>
                </div>
                <div class="card-body">
                <table  class="table table-bordered table-striped table-responsive">
                  <thead>
                    <tr>
                      <th style="width: 2%">No</th>
                      <th>Nama Toko</th>
                      <th >Alamat</th>
                      <th >Telephone</th>
                      <th >Supervisor</th>      
                      <th >Leader</th>      
                      <th >SPG</th>      
                      <th >Status</th>      
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no =0;
                    foreach ($list_toko as $toko) :
                      $no++;
                    ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><a href="<?=base_url('mng_mkt/toko/profil/'.$toko->id)?>"><?= $toko->nama_toko ?></a></td>
                      <td>
                        <address>
                        <?= $toko->alamat ?>
                        </address>
                      </td>
                      <td>
                      <?= $toko->telp ?>
                      </td>
                      <td>
                      <?= $toko->spv ?>
                      </td>
                      <td>
                      <?= $toko->leader ?>
                      </td>
                      <td>
                      <?= $toko->spg ?>
                      </td>
                      <td>
                        <?= status_toko( $toko->status) ?>
                      </td>
                    </tr>
                    <?php endforeach ?>
                  </tbody>
                 
                </table>
                </div>
               </div>
                

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
    <script>
      $(document).ready(function() {
        // load default foto ktp
        var image = document.getElementById('foto_ktp');
        var ftoko = $('#nama_foto').val();
        image.src = '<?= base_url('assets/img/customer/')?>'+ ftoko;
        // load default foto NPWP
        var image2 = document.getElementById('foto_npwp');
        var ftoko2 = $('#nama_foto_npwp').val();
        image2.src = '<?= base_url('assets/img/customer/')?>'+ ftoko2;
        // tombol update alamat
        $('.btn-edit').on('click',function(){
          $('#alamat').removeClass('d-none');
          $('.btn-save').removeClass('d-none');
          $('#alamat_read').addClass('d-none');
          $(this).addClass('d-none');
        });
        // tombol update pic
        $('.btn-edit_pic').on('click',function(){
          $('.pic').removeClass('d-none');
          $('.telp').removeClass('d-none');
          $('.btn-save_pic').removeClass('d-none');
          $('.pic_read').addClass('d-none');
          $('.telp_read').addClass('d-none');
          $(this).addClass('d-none');
        });
        // tombol update top
        $('.btn-edit_top').on('click',function(){
          $('.top').removeClass('d-none');
          $('.tagihan').removeClass('d-none');
          $('.btn-save_top').removeClass('d-none');
          $('.top_read').addClass('d-none');
          $('.tagihan_read').addClass('d-none');
          $(this).addClass('d-none');
        });
        // tombol update foto ktp
        $('#updatektp').submit(function(e) {
          e.preventDefault();
          $.ajax({
            url: '<?php echo base_url("mng_mkt/Customer/update_foto_ktp"); ?>',
            type: 'post',
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType : 'json',
            success: function(data) {
                // Tampilkan pesan sukses
                Swal.fire(
                'Berhasil Update Foto KTP',
                'Foto KTP berhasil di perbaharui!',
                'success'
              )
                $('#foto_ktp').attr({src: "<?= base_url('assets/img/customer/')?>" + data.toko.foto_ktp});
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
        // tombol update foto NPWP
        $('#updatenpwp').submit(function(e) {
          e.preventDefault();
          $.ajax({
            url: '<?php echo base_url("mng_mkt/Customer/update_foto_npwp"); ?>',
            type: 'post',
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType : 'json',
            success: function(data) {
                // Tampilkan pesan sukses
                Swal.fire(
                'Berhasil Update Foto NPWP',
                'Foto KTP berhasil di perbaharui!',
                'success'
              )
                $('#foto_npwp').attr({src: "<?= base_url('assets/img/customer/')?>" + data.toko.foto_npwp});
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
      });
    </script>
   
