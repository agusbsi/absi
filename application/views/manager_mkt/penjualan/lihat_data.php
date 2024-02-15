 <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
            <div class="card card-info" id="cari">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-cart-plus"></li> Laporan Penjualan</h3>
                <div class="card-tools">
                            <button type="button" class="btn btn-tool " data-card-widget="maximize">
                                <i class="fas fa-expand"></i>
                            </button>
                            <button type="button" class="btn btn-tool remove" >
                    <i class="fas fa-times"></i>
                  </button>
                        </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Toko :</label>
                      <select name="toko" class="form-control select2bs4" id="id_toko" required>
                        <option value="">- Pilih Toko -</option>
                        <?php foreach($toko as $t): ?>
                          <option value="<?= $t->id ?>"><?= $t->nama_toko ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Tanggal Awal :</label>
                        <div class="input-group date" id="awal" data-target-input="nearest">
                            <input type="text" name="tgl_awal" id="tgl_awal" class="form-control datetimepicker-input" data-target="#awal" required>
                            <div class="input-group-append" data-target="#awal" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Tanggal Akhir :</label>
                        <div class="input-group date" id="akhir" data-target-input="nearest">
                            <input type="text" name="tgl_akhir" id="tgl_akhir" class="form-control datetimepicker-input" data-target="#akhir"/>
                            <div class="input-group-append" data-target="#akhir" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-5"></div>
                  <div class="col-md-2">
                  <button class="btn btn-info btn-sm btn-cari"><li class="fas fa-search"></li> Cari Data</button>
                  </div>
                  <div class="col-md-5"></div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
              </div>
            </div>
            <!-- hasil cari -->
            <div id="printableArea">
            <!-- /.card -->
            <div class="card card-info d-none" id="card_hasil">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-file-alt"></li> Hasil Pencarian</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool " data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
                  <a href="<?= base_url('mng_mkt/Penjualan')?>" class="btn btn-tool" >
                                <i class="fas fa-times"></i></a>
                  
                </div>
              </div>
              <div class="card-body">
                <!-- print area -->
                
                <h4 class="text-center">Laporan Penjualan </h4>
                    <p class="text-center" id ="toko"></p>
                    <div  class="text-center"><label id="lap_awal" class="mr-2 text-center"></label> s/d <label class="text-center ml-2" id="lap_akhir"></label>
                        </div>
                  </div>
                <hr>
                <table class="table table-bordered table-striped ">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">Kode #</th>
                      <th class="text-center">Deskripsi</th>
                      <th class="text-center">Terjual</th>
                    </tr>
                  </thead>
                  <tbody id="body_hasil">
                  </tbody>
                </table>
                <hr>
                <div class="row no-print">
                  <div class="col-md-10"></div>
                  <div class="col-md-2">
                  <a type="button" onclick="printDiv('printableArea')" target="_blank" class="btn btn-default btn-sm float-right mr-3 ml-2" >
                  <i class="fas fa-print"></i> Print </a> 
                  <a href="<?= base_url('mng_mkt/Penjualan')?>" class="btn btn-danger btn-sm float-right  mb-4">close</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- end hasil -->
            </div> 
                <!-- end print area -->
          
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
   
      <!-- end modal -->
    <!-- jQuery -->
    <script src="<?php echo base_url()?>/assets/plugins/jquery/jquery.min.js"></script>
    <script>
      $(document).ready(function(){
        //Date awal
        $('#awal').datetimepicker({
            format: 'L',
            format: 'YYYY-MM-DD',
        });
        //Date akhir
        $('#akhir').datetimepicker({
            format: 'L',
            format: 'YYYY-MM-DD',
        });
        // tabel
        $('#table_jual').DataTable({
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
       
        // proses cari data
        $(".btn-cari").click(function() {
          var id_toko = $('#id_toko').val();
          var tgl_awal = $('#tgl_awal').val();
          var tgl_akhir = $('#tgl_akhir').val();
          $.ajax({
            url: "<?php echo base_url('mng_mkt/Penjualan/cari'); ?>",
            type: "GET",
            dataType: "json",
            data:{id_toko:id_toko,tgl_awal:tgl_awal,tgl_akhir:tgl_akhir},
            success: function(data) {
              var html = '';
              var toko_nama = '';
              $.each(data, function(i, item) {
                html += '<tr>';
                html += '<td>' + (i+1) + '</td>';
                html += '<td>' + item.kode + '</td>';
                html += '<td>' + item.nama_produk + '</td>';
                html += '<td class="qty text-center">' + item.total_qty + '</td>';
                html += '</tr>';
                toko_nama = item.nama_toko;
              });
              html += '<tr>';
              html += '<td colspan="3" class="text-right">Total :</td>';
              html += '<td class="text-center" id="totalQty"></td>';
              html += '</tr>';
              $("#body_hasil").html(html);
              
              const qtyCells = document.getElementsByClassName("qty");
              let totalQty = 0;
              for (let i = 0; i < qtyCells.length; i++) {
                  totalQty += parseInt(qtyCells[i].textContent);
              }
              document.getElementById("totalQty").textContent = totalQty;
              if(data !="")
              {
              $('#toko').html(toko_nama);
              $('#lap_awal').html(tgl_awal);
              $('#lap_akhir').html(tgl_akhir);
                $('#cari').addClass('d-none');
                $('#card_hasil').removeClass('d-none');
              }else{
                 // menampilkan pesan eror
                Swal.fire(
                  'TIDAK ADA DATA',
                  'Data tidak ditemukan, silahkan cari kembali',
                  'info'
                );
              }
              
            }
           
          });
        });
       
        
      });
      function printDiv(divName) {
          var printContents = document.getElementById(divName).innerHTML;
          var originalContents = document.body.innerHTML;
          document.body.innerHTML = printContents;
          window.print();
          document.body.innerHTML = originalContents;
      }
    </script>

