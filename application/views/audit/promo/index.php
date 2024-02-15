     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
    
            <!-- /.card -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-cube"></li> Data Promo</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id ="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr class="text-center">
                      <th style="width:2% ">No</th>
                      <th style="width:15% ">No. Promo</th>
                      <th style="width:15%">Judul Promo</th>
                      <th>Status</th>
                      <th>Tgl. Mulai</th>
                      <th>Tgl. Selesai</th>
                      <th>Menu</th> 
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php if(is_array($list_data)){ ?>
                      <?php $no = 1;?>
                      <?php foreach($list_data as $dd): ?>
                        <td><?=$no?></td>
                        <td><?= $dd->id; ?></td>
                        <td><?=$dd->judul?></td>
                        <td><?= status_promo($dd->status); ?></td>
                        <td><?= format_tanggal1($dd->tgl_mulai)?></td>
                        <td><?= format_tanggal1($dd->tgl_selesai)?></td>
                        <td>
                        <a href="<?= base_url('audit/promo/detail/'.$dd->id) ?>"  class="btn btn-primary"><li class="fas fa-eye"></li> Detail</a>
                        </td>
                    </tr>
                      <?php $no++; ?>
                      <?php endforeach;?>
                      <?php }else { ?>
                            <td colspan="7" align="center"><strong>Data Kosong</strong></td>
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
