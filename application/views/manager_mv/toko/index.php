     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
    
            <!-- /.card -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-store"></li> Data Toko</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
          
                <table id ="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr class="text-center">
                      <th style="width:2% ">No</th>
                      <th style="width:20%">Nama Toko</th>
                      <th style="width:15%">Nama SPV</th>
                      <th style="width: 30%">Alamat</th>
                      <th >Status</th>
                      <th>Menu</th>       
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php if(is_array($list_data)){ ?>
                      <?php $no = 1;?>
                      <?php foreach($list_data as $dd): ?>
                        <td><?=$no?></td>
                        <td><?=$dd->nama_toko?></td>
                        <td class="text-center">
                          <?php
                            if ($dd->nama_user == ""){
                              echo "<span class='badge badge-warning'> Belum dikaitkan</span>";
                            }else{
                              echo $dd->nama_user ;
                            }
                          ?>
                        </td>
                        <td><?=$dd->alamat?></td>
                        <td class="text-center"> <?php
                        if ($dd->status == 1){
                          echo "<span class='badge badge-success'> Aktif </span>";
                        }else if ($dd->status == 2){
                          echo "<span class='badge badge-danger'> Belum di Approve </span>";
                        }else{
                          echo "<span class='badge badge-default'> Non Aktif </span>";
                        }
                      ?></td>
                        <td>
                        <a href ="<?= base_url('sup/toko/profil/'.$dd->id) ?>" class="btn btn-info btn-sm"> <i class="fas fa-eye"></i> Detail</a>
                        <a href ="<?= base_url('sup/toko/update/'.$dd->id) ?>" class="btn btn-warning btn-sm"> <i class="fas fa-edit"></i> Update</a>
                       
                    </tr>
                      <?php $no++; ?>
                      <?php endforeach;?>
                      <?php }else { ?>
                            <td colspan="6" align="center"><strong>Data Kosong</strong></td>
                      <?php } ?>

              
                     
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
  