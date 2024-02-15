<?php
$tahun  = date("Y");
$bulan  = date("m");
$so_toko = $toko_new->tgl_so;
// set tanggal so disetiap bulan
$tanggal = $tahun."-".$bulan."-".$so_toko;
// Mengubah tanggal menjadi format waktu dengan strtotime()
$waktu = strtotime($tanggal); 
// cek tgl yg akan so
$tanggalSO = date("Y-m-d", strtotime("+1 month", $waktu));
// waktu sekarang
$waktu_now = strtotime("now");
$waktu_so = strtotime($tanggalSO); 
$hitung = intval(($waktu_so - $waktu_now) / 86400);

// Menampilkan peringatan jika selisih kurang dari atau sama dengan 3 hari
if ($hitung <= 3 && $hitung >= 0 && $toko_new->status_so != 1) {
    echo "<script>
    Swal.fire(
      'Peringatan !',
      'Batas maksimal Stok Opname Anda dalam <b>". $hitung ."</b> Hari lagi !',
      'info'
    );</script>";
 
}
?>
<!-- Small boxes (Stat box) -->
<section class="content">
  <div class="row">
    <div class="col-md-8">
      <!-- isi konten sapa -->
      <div class="card card-success card-outline">
        <div class="card-header">
          <h3 class="card-title">
          <i class="fas fa-bullhorn"></i>
          <?php
              date_default_timezone_set("Asia/Jakarta");
              $b = time();
              $hour = date("G",$b);
              if ($hour>=0 && $hour<=11)
              {
              echo "Selamat Pagi :)";
              }
              elseif ($hour >=12 && $hour<=14)
              {
              echo "Selamat Siang :) ";
              }
              elseif ($hour >=15 && $hour<=17)
              { 
              echo "Selamat Sore :) ";
              }
              elseif ($hour >=17 && $hour<=18)
              {
              echo "Selamat Petang :) ";
              }
              elseif ($hour >=19 && $hour<=23)
              {
              echo "Selamat Malam :) ";
              }

            ?>, 
          </h3>
        </div>
        <div class="card-body">
         <h4> 
            <strong> <?= $this->session->userdata('nama_user') ?> !</strong> 
          </h4>
           <br>
         ini merupakan aplikasi konsinyasi berbasis online dari Globalindo Group.
        </div>
        <div class="card-footer text-right">
        <a href="#" class=" text-success"><i class="fas fa-book"></i> Baca Peraturan</a>
        </div>
        <!-- /.card -->
      </div>
      <!-- end konten -->
      <!-- promo new -->
      <div class="card card-danger">
          <div class="card-header border-transparent">
            <h3 class="card-title"> <i class="fas fa-bullhorn"></i> Promo yang berlaku </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                <tr>
                  <th>Nama Promo</th>
                  <th class="text-center">Periode</th>
                  <th class="text-center">Menu</th>
                </tr>
                </thead>
                <tbody>
                  <?php if(is_array($promo)){ ?>
                  <?php 
                  foreach($promo as $dd):
                   ?>
                  <tr>
                    <td><a href="#"><?=$dd->judul?></a></td>
                    <td class="text-center">
                    <?= format_tanggal1($dd->tgl_mulai).' - '.format_tanggal1($dd->tgl_selesai) ?>
                    </td>
                    <td class="text-center">
                    <button class="btn btn-outline-success btn-sm btn-promo" type="button" data-toggle="modal" data-target="#lihat-promo" data-judul="<?= $dd->judul; ?>" data-produk="<?= $dd->id_produk; ?>" data-periode="<?= format_tanggal1($dd->tgl_mulai).'-'.format_tanggal1($dd->tgl_selesai); ?>">
                      <i class="fas fa-book"> Lihat Detail</i>
                    </button>
                    </td>
                  </tr>
                  <?php endforeach;?>
                  <?php  }else { ?>
                      <tr>
                      <td colspan="3" align="center"><strong>Promo Kosong</strong></td>
                      </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
          </div>
          <!-- /.card-footer -->
        </div>
      <!-- end promo new -->
    </div>
    <div class="col-md-4">
       <!-- isi konten sapa -->
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">
            
                  Toko yang sedang anda kelola :
          </h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <?php if (count(array($toko_new)) != null){ 
                   
              ?>
              <h4><b><i class="fas fa-store"></i> <?= $toko_new->nama_toko ?></b></h4>
              <address>
              <?= $toko_new->alamat ?>
              </address>
              <i class="fas fa-calendar"></i> Tanggal SO : <span class="badge badge-danger"><?= $toko_new->tgl_so ?></span>
              <br>
              <small>* Pastikan anda melakukan SO (Stok Opname) tidak melebihi tanggal diatas..</small>
              <?php
              
              }else{ ?>
              <i class="fas fa-exclamation-triangle text-danger"></i> Oops! Anda Belum di kaitkan Toko Manapun.
                <span class="badge badge-danger"> segera hubungi team Leader</span>
              <?php } ?>
            </div>
           
          </div>
        </div>
        <div class="card-footer text-right">
          <a href="<?= base_url('spg/Dashboard/toko_spg/'.$this->session->userdata('id_toko')) ?>" class="btn btn-info <?= (is_array($toko_new) != null) ? 'd-none' : ''; ?>">Lihat Toko anda <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- end konten -->
      <!-- menu sebelah kanan -->
      <div class="info-box mb-3 bg-success">
          <span class="info-box-icon"><i class="fas fa-cart-plus"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Penjualan</span>
            <span class="info-box-number">
              <?php if($total_penjualan == 0){
                      echo "Kosong";
                    }else{
                      echo $total_penjualan;
                    } ?>
            </span>
          </div>
          <a href="<?= base_url('spg/penjualan') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      <div class="info-box mb-3 bg-info">
          <span class="info-box-icon"><i class="fas fa-box"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Stok keseluruhan</span>
            <span class="info-box-number">
            <?php if($total_stok == null or $total_stok== 0)
              {
                echo "kosong";
              }else{
                echo $total_stok;
              } 
            ?>
            </span>
          </div>
          <a href="<?= base_url('spg/Dashboard/toko_spg/'.$this->session->userdata('id_toko')) ?>" class="text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      
      <div class="info-box mb-3 bg-danger">
          <span class="info-box-icon"><i class="fas fa-file-alt"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Permintaan Barang</span>
            <span class="info-box-number">
              <?php if($total_permintaan == 0){
                    echo "Kosong";
                  }else{
                    echo $total_permintaan;
                  } ?>
            </span>
          </div>
          <a href="<?= base_url('spg/permintaan') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      <div class="info-box mb-3 bg-primary">
          <span class="info-box-icon"><i class="fas fa-check-circle"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Penerimaan Barang</span>
            <span class="info-box-number">
              <?php if($total_penerimaan == 0){
                  echo "Kosong";
                }else{
                  echo $total_penerimaan;
                } ?>
            </span>
          </div>
          <a href="<?= base_url('spg/Penerimaan') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      
      <div class="info-box mb-3 bg-warning">
          <span class="info-box-icon"><i class="fas fa-exchange-alt"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Retur Barang</span>
            <span class="info-box-number">
              <?php if($total_retur == 0){
                echo "Kosong";
              }else{
                echo $total_retur;
              } ?>
            </span>
          </div>
          <a href="<?= base_url('spg/retur') ?>" class=" text-right">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
      <!-- end -->
      <!-- Modal Promo -->
      <div class="modal fade" id="lihat-promo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="judul"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <b>
                <i class="fas fa-info-circle"></i>
                Periode : 
              </b>
              <p id="periode"></p>
              <b>
                <i class="fas fa-file"></i>
                Deskripsi
              </b>
              <p>Hanya berlaku untuk artikel yang tertera di bawah ini</p>
              <hr>
                
              <b>
                <i class="fas fa-info-circle"> Daftar Produk Promo</i>
              </b>
              <ul id="daftar-produk"></ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Modal Promo -->
    </div>
  </div>
</section>
<script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    // get promo detail
    $('.btn-promo').on('click', function()
    {
      // get data from button promo
      const judul = $(this).data('judul');
      const produk = $(this).data('produk');
      const periode = $(this).data('periode');
      $('#judul').html(judul);
      $('#periode').html(periode);
      $('#produk_id').val(produk);

      if (!produk)
      {
        var html = '<h3><u>All Produk</u></h3>';
        $('#daftar-produk').html(html);
      }else{
      $.ajax({
        url: '<?= base_url('spg/dashboard/get_produk_detail'); ?>',
        type: 'POST',
        dataType: 'JSON',
        data: {id_produk:produk},
        success: function(data){
          var html = '';
          $.each(data, function(index, value){
            html += '<li>' + value.kode + ' (' + value.nama_produk + ')</li>';
          });
          $('#daftar-produk').html(html);
        }
        });

      }
    })
  })
</script>