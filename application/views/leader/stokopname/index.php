     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
    
            <!-- /.card -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-file-alt"></li> Data Stok Opname Toko</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               
                <table id ="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr class="text-center">
                      <th style="width:2% ">No</th>
                      <th style="width:20%">Nama Toko</th>
                      <th style="width: 30%">Alamat</th>
                      <th>status</th>
                      <th>Tgl. SO</th>
                      <th>Menu</th>       
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php if(is_array($list_data)){ ?>
                      <?php $no = 1;?>
                      <?php foreach($list_data as $dd): ?>
                        <td><?=$no?></td>
                        <td><?=$dd->nama_toko?> 
                        <br>
                        <small> spg :
                      <?php if ($dd->nama_user == "")
                        {
                          echo "<span class='badge badge-danger'> ( Belum dikaitkan )</span>";
                        }else 
                        {
                          echo "<span class='badge badge-warning'> ("; echo $dd->nama_user; echo " )</span>";
                        } 
                        ?>
                      </small>
                        </td>
                        <td><?=$dd->alamat?></td>
                        <td class="text-center">
                          <?php if ($dd->status_so == 0)
                          {
                            echo "<span class='badge badge-danger'> Belum SO </span>";
                          }else if (($dd->status_so == 1)) {
                            echo "<span class='badge badge-success'> Sudah SO </span>";
                          } 
                          ?>
                        </td>
                        <td class="text-center">
                        <?php if ($dd->tgl_so == null){ ?>
                          - Kosong -
                      <?php } else { ?>
                        <?= $dd->tgl_so ?>
                        <?php } ?>
                        </td>
                        <td>
                          <a href="<?= base_url('leader/so/pdf/'.$dd->id) ?>" target = "_blank" class="btn btn-warning btn-sm <?= ($dd->nama_user == "") ? 'd-none' : ''; ?> <?= ($dd->status_so == "1") ? 'd-none' : ''; ?>"><i class="fas fa-file-pdf"></i> Format SO</a>
                          <a href="<?= base_url('leader/so/hasil_so/'.$dd->id) ?>" target = "_blank" class="btn btn-success btn-sm <?= ($dd->nama_user == "") ? 'd-none' : ''; ?> <?= ($dd->status_so == "0") ? 'd-none' : ''; ?>"><i class="fas fa-file-pdf"></i> Hasil SO</a>
                        </td>
                    </tr>
                      <?php $no++; ?>
                      <?php endforeach;?>
                      <?php }else { ?>
                            <td colspan="7" align="center"><strong>Data Kosong</strong></td>
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
  
<!-- jQuery -->
<script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
