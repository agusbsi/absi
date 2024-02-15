     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
    
            <!-- /.card -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-hospital"></li> Data Grup</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              
                <table id ="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width: 2%">No</th>
                      <th>Nama Group</th>
                      <th>Deskripsi</th>
                      <th>Jumlah Toko</th>
                      <th>Menu</th>       
                    </tr>
                  </thead>
                  <tbody>
                      <?php if(is_array($list_group)){ ?>
                    <tr>
                      <?php $no = 1;?>
                      <?php foreach($list_group as $dd): ?>
                        <td><?=$no?></td>
                        <td><?=$dd->nama_grup?></td>
                        <td><?=$dd->deskripsi?></td>
                        <td><?=$dd->toko?></td>
                        <td>
                        <?php if ($dd->toko > 0) { ?>
                        <a href="<?= base_url('audit/Group/detail/'.$dd->id) ?>"class="btn btn-info btn_detail">
                         <li class="fas fa-eye"></li> Detail
                      </a>
                        <?php } ?>
                        </td>
                    </tr>
                      <?php $no++; ?>
                      <?php endforeach;?>
                      <?php }else { ?>
                            <td colspan="4" align="center"><strong>Data Kosong</strong></td>
                      <?php } ?>
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
     