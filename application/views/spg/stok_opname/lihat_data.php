<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <?php if (($toko->status_so)== 1)
        { ?>
          <!-- jika toko belum so -->
          <!-- eror page -->
          <div class="error-page">
          <h2 class="headline text-success"> <i class="fas fa-check-circle"></i></h2>

          <div class="error-content">
            <h3><i class="fas fa-file-alt text-success"></i> STOK OPNAME BERHASIL !</h3>

            <p>
              Terimaksih, Anda telah melakukan Stok Opname di bulan ini ! Data sedang di proses oleh Admin Support Hicoop.
            </p>

            <form class="search-form">
              <div class="input-group text-center"> 
                <a href="<?php echo base_url('spg/dashboard')?>" class="btn btn-success"> Oke Thanks!</a>
              </div>
              <!-- /.input-group -->
            </form>
          </div>
          <!-- /.error-content -->
        </div>
       <!-- end eror page -->
          <!-- end toko so -->
       
        <?php }else{ ?>
          <form action="<?= base_url('spg/stok_opname/simpan_so') ?>" method="post" id="form-so">
        <div class="card card-info ">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-chart-pie"></i> Stok Opname</b> </h3>
          </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <table>
                     
                      <tr>
                        <th>Toko </th>
                        <td>: <?= $toko->nama_toko ?>
                        <input type="hidden" name="id_toko" value="<?= $toko->id ?>">
                        </td>
                      </tr>
                      <tr>
                        <th> SPG</th>
                        <td>: <?= $this->session->userdata('nama_user') ?></td>
                      </tr>
                  </table>
                </div>
                <div class="col-md-8">
                  <table >
                    <tr>
                        <th>No SO</th>
                        <td>: <?= $kode_so ?>
                        <input type="hidden" name="kode_so" value="<?= $kode_so ?>">
                        </td>
                    </tr>
                    <tr>
                    <th>  Tgl SO</th>
                    <td>: <span id="clock"></span>
                    
                    <input type="hidden" name="tgl_so" value="<?= date('Y-m-d') ?>">
                    </td>
                    </tr>
                    
                  </table>
              
                 
                </div>
              </div>
              <hr>
              <i class="fas fa-info text-info"> Info :</i> 
              <p><b>HASIL SO</b> = Jumlah Fisik artikel <b>+</b> artikel terjual di tgl : <b>01 s/d <?= date('d-m-Y') ?> (hari ini)</b></p>
              <!-- list data produk di toko -->
             <table id="table_stok" class="table table-bordered table-striped">
                        <thead>
                        <tr class="text-center">
                          <th style="width:5%">No</th>
                        
                          <th># Kode Artikel</th>
                          <th>Hasil SO</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        <?php
                        $no = 0;
                        $total = 0;
                        $awal = 0;
                        foreach($stok_produk as $stok){
                          $no++
                          ?>
                          <?php 
                            $t_terima = $stok->total_terima + $stok->mutasi_masuk;
                            ?>
                            <td><?= $no ?></td>
                            <td>
                              <?= $stok->kode ?>
                              <input type="hidden" name="id_produk[]" value = "<?= $stok->id_produk ?>">
                              <input type="hidden" name="qty[]" 
                              value = "<?php if(empty($stok->qty)){
                                echo $stok->qty = 0;
                              }else{
                                echo $stok->qty;
                              } ?>">
                              <input type="hidden" name="qty_awal[]" 
                              value = "<?php if(empty($stok->qty_awal)){
                                echo $stok->qty_awal = 0;
                              }else{
                                echo $stok->qty_awal;
                              } ?>">
                              <input type="hidden" name="t_terima[]" 
                              value = "<?php if(empty($t_terima)){
                                echo $t_terima = 0;
                              }else{
                                echo $t_terima;
                              } ?>">
                              <input type="hidden" name="t_jual[]" 
                              value = "<?php if(empty($stok->total_jual)){
                                echo $stok->total_jual = 0;
                              }else{
                                echo $stok->total_jual;
                              } ?>">
                              <input type="hidden" name="t_retur[]" 
                              value = "<?php if(empty($stok->total_retur)){
                                echo $stok->total_retur = 0;
                              }else{
                                echo $stok->total_retur;
                              } ?>">
                              <input type="hidden" name="t_mutasi[]" 
                              value = "<?php if(empty($stok->mutasi_keluar)){
                                echo $stok->mutasi_keluar = 0;
                              }else{
                                echo $stok->mutasi_keluar;
                              } ?>">
                              
                            </td>
                            <td style="width:30%"> <input type="number" data-qty="<?= $stok->qty ?>" name="qty_input[]" value="0" min="0" class="form-control qty_input" required></td>
                        </tr>
                          <?php
                          } ?>
                   
                        </tbody>
                      </table>
              <!-- end produk -->
              <hr>
              <div class="row">
                <div class="col-md-9">
                  <textarea name="keterangan" class="form-control" placeholder="Silahkan tambahkan keterangan jika ada"></textarea>
                </div>
                <div class="col-md-3 mt-3">
                  <button type="submit" class="btn btn-success" id="btn-kirim"><i class="fa fa-save"></i> Proses Data</button>
                  <button type="reset" class="btn btn-danger"><li class="fa fa-times-circle"></li> Reset</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        </form>
          <?php } ?>
      </div>
    </div>
  </div>
</section>
  <!-- jQuery -->
  <script src="<?php echo base_url()?>/assets/plugins/jquery/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
    // table
      $('#tablestok').DataTable({
          order: [[1, 'asc']],
          responsive: true,
          lengthChange: false,
          autoWidth: false,
      });
      // end tabel
      })
  </script>
  <script type="text/javascript">

  $('#btn-kirim').click(function(e){
    e.preventDefault();
    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Data Stok Opname akan di proses. !",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Batal',
      confirmButtonText: 'Yakin'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById("form-so").submit();
      }
    })
  })
</script>
<script type="text/javascript">
	
		function showTime() {
		    var a_p = "";
		    var today = new Date();
		    var curr_hour = today.getHours();
		    var curr_minute = today.getMinutes();
		    var curr_second = today.getSeconds();
		    if (curr_hour < 12) {
		        a_p = "AM";
		    } else {
		        a_p = "PM";
		    }
		    if (curr_hour == 0) {
		        curr_hour = 12;
		    }
		    if (curr_hour > 12) {
		        curr_hour = curr_hour - 12;
		    }
		    curr_hour = checkTime(curr_hour);
		    curr_minute = checkTime(curr_minute);
		    curr_second = checkTime(curr_second);

      var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
			var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
			var date = new Date();
			var day = date.getDate();
			var month = date.getMonth();
			var thisDay = date.getDay(),
			    thisDay = myDays[thisDay];
			var yy = date.getYear();
			var year = (yy < 1000) ? yy + 1900 : yy;

		 document.getElementById('clock').innerHTML=thisDay + ", " + day + " " + months[month] + " " + year + "  " + curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
		    }

		function checkTime(i) {
		    if (i < 10) {
		        i = "0" + i;
		    }
		    return i;
		}
		setInterval(showTime, 500);

		</script>
    <script type="text/javascript">
      $('.qty_input').change(function(){
        var qty = $(this).data("qty");
        var qty_input = $(this).val();
        if (qty != qty_input) {
            $(this).closest("tr").addClass("bg-danger",true) 
        } else {
           $(this).closest("tr").removeClass("bg-danger")
        }
      })
    </script>