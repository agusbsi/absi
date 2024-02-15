 <!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-info card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                <?php if($toko->foto_toko=="") { 
                  ?>
                  <img style="width: 100%;" class="profile-user-img img-responsive img-rounded" src="<?php echo base_url()?>assets/img/toko/hicoop.png" alt="User profile picture">
                  <?php
                  }else{ ?>
                  <img style="width: 100%;" class="profile-user-img img-responsive img-rounded" src="<?php echo base_url('assets/img/toko/'.$toko->foto_toko)?>" alt="User profile picture">
                <?php } ?> 
                  </div>
                <h3 class="profile-username text-center"><strong><?= $toko->nama_toko ?></strong></h3>

                <p class="text-muted text-center">[ ID : <?= $toko->id ?> ]</p>

                <div class="card-body">
                <strong><i class="fa fa-date"></i> Tanggal Maks SO :</strong>
                  <p class="text-muted text-center"> <span class="badge badge-danger badge-sm"><?= $toko->tgl_so ?></span>  /Bulan</p>
                  <hr>
                  <strong><i class="fa fa-phone"></i> Telp</strong>
                  <p class="text-muted"><?= $toko->telp ?></p>
                  <hr>
                  <strong><i class="fa fa-map"></i> Alamat</strong>
                  <p class="text-muted"><?= $toko->alamat ?></p>
                  <hr>
                  
                  <strong><i class="fa fa-info"></i> Status</strong>
                  <p class="text-muted"><?= status_toko($toko->status) ?></p>
                  <hr>
                  
                    <div class="text-center">
                   
                    </div>
                </div>
              </div>

              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          <div class="col-md-9">
           
            <!-- manajement stok -->
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-box"></li> Data Stok Artikel</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <table id="table_stok" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                         
                          <th style="width:20%">Kode Artikel #</th>
                          <th style="width:40%">Nama Artikel</th>
                          <th class="text-center">Satuan</th>
                          <th class="text-center">Stok</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        <?php
                        $no = 0;
                        $total = 0;
                        foreach($stok_produk as $stok){
                          $no++
                          ?>
                            
                            <td><?= $stok->kode ?></td>
                            <td><?= $stok->nama_produk ?></td>
                            <td class="text-center"><?= $stok->satuan ?></td>
                            <td class="text-center"><?= $stok->qty ?></td>
                        </tr>
                          <?php 
                          $total += $stok->qty;
                          } ?>
                   
                        </tbody>
                        <tfoot>
                        <tr>
                          <td colspan="4"></td>
                        </tr>
                        <tr>
                          <td  colspan="4" class="text-center"> <strong>Total :</strong> <b><?= $total ; ?></b></td>
                        </tr>
                        
                        </tfoot>
                      </table>

                  </div>
                  <!-- /.tab-content -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
              <i class="fas fa-bullhorn"></i> Data ini merupakan jumlah stok yang dimiliki toko : <b><?= $toko->nama_toko ?></b> .
              </div>
            </div>
          <!-- /.card -->
            <!-- end stok -->
          </div>
          <!-- /.col -->
        </div>
      
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

<!-- jQuery -->
<script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
  <script>
    $(document).ready(function(){
    
    
      $('#table_stok').DataTable({
          order: [[3, 'Desc']],
          responsive: true,
          lengthChange: false,
          autoWidth: false,
      });
      
    
    })
  </script>

