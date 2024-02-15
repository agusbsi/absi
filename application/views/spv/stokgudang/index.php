     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
    
            <!-- /.card -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-warehouse"></li> Data Stok Gudang</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
           
                <hr>
                <table id ="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr class="text-center">
                      <th style="width:3%">No.</th>
                      <th style="width:15%">Kode Artikel #</th>
                      <th>Satuan</th>
                      <th>Stok</th>
                      <th>Terakhir diperbarui</th>      
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php if(is_array($list_data)){ ?>
                      <?php $no = 1;?>
                      <?php foreach($list_data as $dd): ?>
                        <td><?=$no?></td>
                        <td><?=$dd->kode?></td>
                        <td class="text-center"><?=$dd->satuan?></td>
                        <td class="text-center"><?=$dd->stok?></td>
                        <td class="text-center"><?=$dd->updated_at?></td>
                       
                    </tr>
                      <?php $no++; ?>
                      <?php endforeach;?>
                      <?php }else { ?>
                            <td colspan="5" align="center"><strong>Data Kosong</strong></td>
                      <?php } ?>

              
                     
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
