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
                        <a href ="<?= base_url('adm_mv/toko/profil/'.$dd->id) ?>" class="btn btn-info"> <i class="fas fa-eye"></i> Detail</a>
                        </td>
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
    
  
<!-- jQuery -->
<script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
<script>
   $(document).ready(function(){
    // get Edit Product
    $('.btn-edit').on('click',function(){
        // get data from button edit
        const id = $(this).data('id');
        const id_user = $(this).data('id_user');
        const nama_toko = $(this).data('nama_toko');
        const nama_user = $(this).data('nama_user');
        const alamat = $(this).data('alamat');
        const telp = $(this).data('telp');
        // const tgl_so = $(this).data('tgl_so');

        // Set data to Form Edit
        $('.id').val(id);
        $('.nama_toko').val(nama_toko);
        $('.nama_user').val(nama_user);
        // $('.tgl_so').val(tgl_so);
        $('.id_user').val(id_user);
        $('.alamat').val(alamat);
        $('.telp').val(telp);
        // Call Modal Edit
        $('#editModal').modal('show');
    });
   })
</script>
