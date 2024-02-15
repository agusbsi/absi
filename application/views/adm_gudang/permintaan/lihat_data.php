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
                <table id="table_minta" class="table table-bordered table-striped">
                  <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th style="width: 18%;">Kode Permintaan</th>
                    <th>Status</th>
                    <th style="width: 25%;">Nama Toko</th>
                    <th>Catatan MV</th>
                    <th style="width: 21%;">Menu</th>
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
                   
                    <td><address><?=$dd->keterangan?></address></td>
                    <td>
                      <?php if(($dd->status == 2)){?>
                      <a type="button" class="btn btn-success btn-sm"  href="<?=base_url('adm_gudang/permintaan/detail/'.$dd->id)?>" name="btn_proses" ><i class="fas fa-edit" aria-hidden="true"></i> proses</a>
                      <a type="button" href="<?=base_url('adm_gudang/permintaan/packing_list/'.$dd->id)?>" target="_blank" class="btn btn-warning float-right btn-sm" style="margin-right: 2px;">
                    <i class="fas fa-print"></i> Packing List </a>
                      <?php }else{ ?>
                      <a type="button" class="btn btn-primary"  href="<?=base_url('adm_gudang/permintaan/detail_p/'.$dd->id)?>" name="btn_detail" ><i class="fa fa-eye" aria-hidden="true"></i> Detail</a>
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
   
    <!-- jQuery -->
    <script src="<?php echo base_url()?>/assets/plugins/jquery/jquery.min.js"></script>
    <script>
      $(document).ready(function(){

        // fungsi pilih id permintaan
        function selectValue() {
          var targetWindow = window.open("target-page-url", "_blank");
          targetWindow.addEventListener("load", function() {
            var selectBox = targetWindow.document.getElementById("mySelect");
            selectBox.value = "2";
            ajaxFunction();
          });
        }

        // tabel
        $('#table_minta').DataTable({
            order: [[0, 'asc']],
            responsive: true,
            lengthChange: false,
            autoWidth: false,
        });
        // get Edit Product
       $('.btn-edit').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            const nama_toko = $(this).data('nama_toko');
           
            // Set data to Form Edit
            $('.id').val(id);
            $('.nama_toko').val(nama_toko);
            // Call Modal Edit
            $('#editModal').modal('show');
        });
       
      
    
      })
    </script>

    
    <script type="text/javascript">
      const role = "<?= $this->session->userdata('role') ?>";
      if (role != 5) {
        $(".btn").addClass('disabled');
      }
    </script>