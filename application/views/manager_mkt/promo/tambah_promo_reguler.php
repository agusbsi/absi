<section class="content">
  <div class="container-fluid">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"><i class="nav-icon fas fa-percent"></i> Form Pengajuan Promo Reguler</h3>
        <div class="card-tools">
          <a href="<?= base_url('mng_mkt/promo'); ?>" type="button" class="btn btn-tool"><i class="fas fa-times"></i></a>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-2">
            <label>No. Promo</label>
          </div>
          <div class="col-md-4">
            <label><?= $kode_promo; ?></label>
          </div>
          <div class="col-md-2">
            <label>Tanggal Pengajuan</label>
          </div>
          <div class="col-md-4">
            <label><?= date('d-M-Y') ?></label>
          </div>
        </div>
        <form method="POST" action="<?= base_url('mng_mkt/promo/proses_reguler'); ?>">
          <div class="row">
            <div class="col-md-2">
              <label>Nama Toko/Cabang</label>
            </div>
            <div class="col-md-4">
              <select name="id_toko" class="form-control select2bs4" id="id_toko" required="">
                <option value="">Pilih Toko</option>
                <?php foreach ($list_toko as $lt) { ?>
                  <option value="<?= $lt->id; ?>"><?= $lt->nama_toko; ?></option>
                <?php } ?>
              </select>
              <input type="hidden" name="type_promo" value="1">
              <input type="hidden" name="id_promo" value="<?= $kode_promo; ?>">
            </div>
            <div class="col-md-2">
              <label>Judul Promo</label>
            </div>
            <div class="col-md-4">
              <input type="text" name="judul_promo" class="form-control" placeholder="Masukkan Judul Promo" required="">
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <label>Type Diskon</label>
            </div>
            <div class="col-md-4">
              <select name="type_diskon" class="form-control select2bs4" id="type_diskon">
                <option value="" selected=""> Pilih Type Diskon</option>
                <option value="Single Margin">Single Margin</option>
                <option value="Margin Bertingkat">Margin Bertingkat</option>
              </select>
            </div>
            <div class="col-md-2">
              <label>Jumlah Diskon</label>
            </div>
            <div class="col-md-4">
              <input type="number" name="diskon" id="diskon" class="form-control" min="0">
            </div>
          </div>
          <div class="row">
            <div class="col-md-2 diskon-single d-none">
              <label>Diskon Partisipasi Hicoop</label>
            </div>
            <div class="col-md-4 diskon-single d-none">
              <input type="number" name="diskon_hicoop" placeholder="Input Hanya Angka Tanpa %" class="form-control" id="d_hicoop" min="0">
            </div>
            <div class="col-md-2 diskon-tingkat d-none">
              <label>Diskon Partisipasi Toko</label>
            </div>
            <div class="col-md-4 diskon-tingkat d-none">
              <input type="number" name="diskon_toko" id="d_toko" min="0" value="0" class="form-control" readonly="">
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <label>Tanggal Dimulai</label>
            </div>
            <div class="col-md-4">
              <input type="date" name="tgl_mulai" class="form-control">
            </div>
            <div class="col-md-2">
              Tanggal Selesai
            </div>
            <div class="col-md-4">
              <input type="date" name="tgl_selesai" class="form-control">
            </div>
          </div>
          <hr>
          <div class="card card-default">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Pilih Artikel</label>
                    <select multiple="" class="form-control select2bs4" id="id_produk" disabled="">
                    </select>
                    <input type="hidden" name="id_artikel" id="id_artikel">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row float-right">
            
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Proses Promo</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
  $(document).ready(function(){
    $("#type_diskon").change(function(){
      if ($(this).val() == "Single Margin"){
        $('.diskon-single').removeClass('d-none');
        $('.diskon-tingkat').addClass('d-none');
        document.getElementById("id_produk").disabled = false;
      }else{
        $('.diskon-single').removeClass('d-none');
        $('.diskon-tingkat').removeClass('d-none');
        document.getElementById("id_produk").disabled = false;
      }
    });

    $('#id_toko').on('change', function()
        {
          reset()
          $('#id_produk').html('').val([]);
          if ($(this).val() != "")
          {
          // list produk
          var url = "<?php echo base_url('mng_mkt/Promo/list_produk');?>/"+$(this).val();
                $('#id_produk').load(url);
                return false;
          }else{
          }
        })
    function reset()
    {
      $('#id_artikel').val('')
    }
    $('#id_produk').change(function(){
      var id_produk = $(this).val();
      $('#id_artikel').val(id_produk.join(','));
    });
    $('input[name="diskon_hicoop"]').change(function(){
      input = $(this).val();
      max = $('#diskon').val();
      partisipasi_toko = '';
      if (input > max) {
        Swal.fire({
          title: 'Peringatan !',
          text: 'Diskon yang anda inputkan melebihi dari jumlah diskon pengajuan!',
          icon: 'warning',
          })
        $('input[name="diskon_hicoop"]').val('');
        return
      }else{
        partisipasi_toko = max - input
      }
      $('#d_toko').val(partisipasi_toko);
    })
  })
</script>