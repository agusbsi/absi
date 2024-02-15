     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-file-alt"></li> Riwayat Stok Opname Toko</h3>
                <div class="card-tools">
                  <a href="<?= base_url('sup/So')?>"  class="btn btn-tool" >
                    <i class="fas fa-times"></i>
                  </a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Pilih Periode</label>
                      <select name="periode" class="form-control select2bs4" id="periode" required>
                        <option value="" selected>Pilih Periode</option>
                        <?php 
                        foreach ($list_so as $s):
                        ?>
                        <option value="<?= $s->created_at ?>"><?= date('F Y', strtotime('-1 month', strtotime($s->period))) ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4"></div>
                   <div class="col-md-4">
                     <div class="form-group">
                       <label for="">Download Data SO Artikel semua toko</label>
                       <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-import"><i class="fas fa-download"></i>
                         Download
                       </button>
                     </div>
                   </div>
                </div>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr class="text-center">
                      <th style="width: 20px;">No</th>
                      <th style="width: 40%;">Nama Toko</th>
                      <th>Tgl Stok Opname</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="show_data" >
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
         <!-- modal tambah data -->
     <div class="modal fade" id="modal-import">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h4 class="modal-title">
               <li class="fa fa-excel"></li> Download Hasil So Artikel
             </h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <form method="post" enctype="multipart/form-data" action="<?php echo base_url('sup/So/download_so'); ?>">
             <div class="modal-body">
               <!-- isi konten -->
               <div class="form-group">
                 <label>Pilih Periode</label>
                 <select name="periode" class="form-control select2bs4" required>
                   <option value="" selected>Pilih Periode</option>
                   <?php
                    foreach ($list_so as $s) :
                    ?>
                     <option value="<?= $s->created_at ?>"><?= date('F Y', strtotime($s->created_at)) ?></option>
                   <?php endforeach ?>
                 </select>
               </div>
               <!-- end konten -->
             </div>
             <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                 <li class="fas fa-times-circle"></li> Cancel
               </button>
               <button type="submit" class="btn btn-primary btn-sm">
                 <li class="fas fa-save "></li> Download
               </button>
             </div>
           </form>
         </div>
         <!-- /.modal-content -->
       </div>
       <!-- /.modal-dialog -->
     </div>
     <!-- /.modal -->
  
<!-- jQuery -->
<script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
<script> 
    $(document).ready(function()
    {
      // ketika periode di pilih
      $('#periode').on('change', function()
      {
        // menampilkan detail permintaan
        var id = $(this).val();
        // mengambil data setelah tanda penghubung
        const splittedData = id.split("-");
        const tahun = splittedData[0];
        const bulan = splittedData[1];
        if (id=="")
        {
          $('#show_data').html('');
        }else
        {
          $.ajax({
                type  : 'POST',
                url   : '<?= base_url()?>sup/So/list_toko',
                async : true,
                dataType : 'json',
                data : {no_so:bulan,tahun:tahun},
                success : function(data){
                    var html = '';
                    var i;
                    var a = 0;
                    for(i=0; i<data.length; i++){
                        a++
                        html += '<tr>'+
                                  '<td>'+a+'</td>'+
                                  '<td>'+data[i].nama_toko+'</td>'+
                                  '<td class="text-center">'+data[i].tgl_so+'</td>'+
                                  '<td class="text-center"><a href="<?= base_url()?>sup/So/riwayat_so_toko/'+data[i].id_toko+'/'+data[i].id+'" class="btn btn-sm btn-info mr-3">Lihat detail</a></td>'+
                                '</tr>';
                        }   
                    $('#show_data').html(html);
                                
                    }

            });
        }
            
      });
    });
</script>
