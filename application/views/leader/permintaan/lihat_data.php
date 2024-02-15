     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
         
            <!-- /.card -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-list"></li> Data Permintaan Barang</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th style="width: 18%;">ID Permintaan</th>
                    <th>Status</th>
                    <th style="width: 25%;">Nama Toko</th>
                    <th>Tanggal dibuat</th>
                    <th>Menu</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <?php if(is_array($list_data)){ ?>
                    <?php $no = 0;
                     foreach($list_data as $dd):
                     $no++ ?>
                    <td><?= $no ?></td>
                    <td><?=$dd->id?></td>
                    <td>
                      <?= status_permintaan($dd->status); ?>   
                    </td>
                    <td><?=$dd->nama_toko?></td>
                   
                    <td><?=$dd->created_at?></td>
                    <td>
                      <?php
                      if($dd->status == 0)
                      { ?>
                        <a type="button" class="btn btn-success btn-sm"  href="<?=base_url('leader/permintaan/detail_p/'.$dd->id)?>" name="btn_detail" ><i class="fa fa-cog" aria-hidden="true"></i> Proses</a>
                      <?php }else { ?>
                        <a type="button" class="btn btn-primary btn-sm"  href="<?=base_url('leader/permintaan/detail_p/'.$dd->id)?>" name="btn_detail" ><i class="fa fa-eye" aria-hidden="true"></i> Detail</a>
                      <?php } ?>
                    </td>

                  </tr>
                
                  <?php endforeach;?>
                  <?php  }else { ?>
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
 