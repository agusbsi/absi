<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-info ">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-store"></i> List Toko Baru</b> </h3>
          </div>
            <div class="card-body">
          
              <table id="table_toko" class="table table-bordered table-striped">
                <thead>
                <tr class="text-center">
                  <th style="width:5%">No</th>
                  <th style="width:20%">Nama Toko</th>
                  <th style="width:30%">Alamat</th>
                  <th style="width:10%">Supervisor</th>
                  <th>Tgl Pengajuan</th>
                  <th>Menu</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 0;
                    foreach($toko as $t):
                      $no++
                  ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $t->nama_toko ?></td>
                    <td><?= $t->alamat ?></td>
                    <td class="text-center">
                    <?php
                        if ($t->nama_user == ""){
                          echo "<span class='badge badge-warning'> Belum dikaitkan</span>";
                        }else{
                          echo $t->nama_user ;
                        }
                      ?>
                     
                    </td>
                   
                    <td class="text-center">
                    <?= $t->created_at ?>
                    </td>
                    <td>
                      <a href ="<?= base_url('audit/Toko/profil_baru/'.$t->id) ?>" class="btn btn-warning"> <i class="fas fa-cog"></i> Proses</a>
                    </td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
            <div class="card-footer text-center ">
          
            </div>
            
          </div>
        </div>
     
      </div>
    </div>
  </div>
</section>
  <!-- jQuery -->
  <script src="<?php echo base_url()?>/assets/plugins/jquery/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
    
      $('#table_toko').DataTable({
          order: [[0, 'asc']],
          responsive: true,
          lengthChange: false,
          autoWidth: false,
      });

    
    })
  </script>


