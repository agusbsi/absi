<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-9">
          <form action="<?= base_url('sup/Toko/proses_update')?>" method="post">
             <div class="card card-info">
              
                <div class="card-header">
                  <h3 class="card-title"> <li class="fas fa-store"></li> Update Toko</h3>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-two-tabContent">
                    <div class="tab-pane fade show active" id="supervisor" role="tabpanel" >
                        <div class="row">
                            <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Nama Toko</label>
                                    <input type="hidden" name="id_toko" class="form-control " value="<?= $detail->id ?>" readonly>
                                    <input type="text" name="nama_toko" class="form-control nama_toko" value="<?= $detail->nama_toko ?>" readonly>
                                  </div>
                                  <div class="form-group">
                                    <label>Jenis Toko</label>
                                    <select  class="form-control select2bs4" name ="jenis_toko">
                                      <option value="1"<?= ($detail->jenis_toko)== 1 ? 'selected' : '' ?>>Dept Store</option>
                                      <option value="2"<?= ($detail->jenis_toko)== 2 ? 'selected' : '' ?>>Supermarket</option>
                                      <option value="3"<?= ($detail->jenis_toko)== 3 ? 'selected' : '' ?>>Grosir</option>
                                      <option value="4"<?= ($detail->jenis_toko)== 4 ? 'selected' : '' ?>>Minimarket</option>
                                      <option value="5"<?= ($detail->jenis_toko)== 5 ? 'selected' : '' ?>>Lain-lain.</option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label >Nama PIC Toko</label>
                                    <input type="text" class="form-control pic" name="pic" value="<?= $detail->nama_pic ?>" required=""></input>
                                  </div>
                                  <div class="form-group">
                                    <label >No. Telp / Wa</label>
                                    <input type="number" class="form-control telp" name="no_telp" value="<?= $detail->telp ?>" required=""></input>
                                  </div>
                                  <div class="form-group">
                                    <label>Tanggal SO</label>
                                    <select  class="form-control tgl_so select2bs4" name ="tgl_so" required>
                                      <option value="">- Pilih tgl SO -</option>
                                        <option value="1"<?= ($detail->tgl_so)== 1 ? 'selected' : '' ?>>1</option>
                                        <option value="2"<?= ($detail->tgl_so)== 2 ? 'selected' : '' ?>>2</option>
                                        <option value="3"<?= ($detail->tgl_so)== 3 ? 'selected' : '' ?>>3</option>
                                        <option value="4"<?= ($detail->tgl_so)== 4 ? 'selected' : '' ?>>4</option>
                                        <option value="5"<?= ($detail->tgl_so)== 5 ? 'selected' : '' ?>>5</option>
                                        <option value="6"<?= ($detail->tgl_so)== 6 ? 'selected' : '' ?>>6</option>
                                        <option value="7"<?= ($detail->tgl_so)== 7 ? 'selected' : '' ?>>7</option>
                                        <option value="8"<?= ($detail->tgl_so)== 8 ? 'selected' : '' ?>>8</option>
                                        <option value="9"<?= ($detail->tgl_so)== 9 ? 'selected' : '' ?>>9</option>
                                        <option value="10"<?= ($detail->tgl_so)== 10 ? 'selected' : '' ?>>10</option>
                                        <option value="11"<?= ($detail->tgl_so)== 11 ? 'selected' : '' ?>>11</option>
                                        <option value="12"<?= ($detail->tgl_so)== 12 ? 'selected' : '' ?>>12</option>
                                        <option value="13"<?= ($detail->tgl_so)== 13 ? 'selected' : '' ?>>13</option>
                                        <option value="14"<?= ($detail->tgl_so)== 14 ? 'selected' : '' ?>>14</option>
                                        <option value="15"<?= ($detail->tgl_so)== 15 ? 'selected' : '' ?>>15</option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label >Tipe Harga</label>
                                    <br>
                                    <?= status_het($detail->het) ?>
                                  </div>
                                  <div class="form-group">
                                    <label >Diskon Toko</label>
                                    <div class="input-group my-colorpicker2">
                                      <input type="text" class="form-control" name="diskon" value="<?= $detail->diskon ?>" readonly>
                                      <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                      </div>
                                    </div>
                                  </div>
                            </div>
                            <div class="col-md-6">
                                  <div class="form-group">
                                    <label >Limit Toko</label>
                                    <input type="text" class="form-control " name="limit" value="<?= $detail->limit_toko ?>" readonly></input>
                                  </div>
                                <div class="form-group">
                                  <label>Provinsi</label>
                                  <select  class="form-control provinsi select2bs4" name ="provinsi" id ="provinsi" required>
                                  <option value=''>- Select Provinsi -</option>
                                  <?php foreach ($provinsi as $p) : ?>
                                        <option value="<?= $p->id ?>" <?= ($detail->provinsi)== $p->id ? 'selected' : '' ?>><?= $p->nama ?></option>
                                      <?php endforeach ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label>Kabupaten</label>
                                  <select  class="form-control kabupaten select2bs4" name ="kabupaten" id ="kabupaten" required>
                                  <?php foreach ($kabupaten as $p) : ?>
                                        <option value="<?= $p->id ?>" <?= ($detail->kabupaten)== $p->id ? 'selected' : '' ?>><?= $p->nama ?></option>
                                      <?php endforeach ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label>Kecamatan</label>
                                  <select  class="form-control kecamatan select2bs4" name ="kecamatan" id ="kecamatan" required>
                                  <?php foreach ($kecamatan as $p) : ?>
                                        <option value="<?= $p->id ?>" <?= ($detail->kecamatan)== $p->id ? 'selected' : '' ?>><?= $p->nama ?></option>
                                      <?php endforeach ?>
                                  </select>
                                </div>
                                <div class="form-group" >
                                  <label >Alamat</label> </br>
                                  <textarea class="form-control alamat" name="alamat"  required> <?= $detail->alamat ?></textarea>
                                </div>
                            </div>
                        </div> 
                        <!-- end row -->
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right"><i class="fas fa-edit"></i> Update Data</button>
                  <a href="<?= base_url('sup/toko/') ?>" class="btn btn-danger float-right mr-3"><i class="fas fa-times-circle"></i> Close</a>
                </div>
                </form>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h3 class="card-title">Foto Toko</h3>
              </div>
              <form id="updateFotoForm" method="post" enctype="multipart/form-data">
                <div class="card-body box-profile">
                  <img class="img-rounded " id ="foto_toko" style="width: 200px;" src="" alt="Foto Toko">
                    <div class="form-group">
                    <label for="foto">Ganti Foto :</label>
                    <input type="hidden" name="id_toko_foto" value="<?= $detail->id ?>">
                    <input type="hidden" id="nama_foto" name="nama_foto" value="<?= $detail->foto_toko ?>">
                    <input type="file" class="form-control" id="foto" name="foto" multiple accept="image/png, image/jpeg, image/jpg" required></input>
                    <small>noted: Jenis foto yang diperbolehkan : JPG|JPEG|PNG & size maksimal : 2 mb</small>
                  </div>
                </div>
                <div class="card-footer text-center">
                  <button  class="btn btn-outline-primary btn-sm btn-foto">Update Foto</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
</section>



<!-- jQuery -->
<script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
  <script>
    $(document).ready(function(){
      var image = document.getElementById('foto_toko');
      var ftoko = $('#nama_foto').val();
      image.src = '<?= base_url('assets/img/toko/')?>'+ ftoko;

      // get lokasi
      $("#provinsi").change(function (){
	       var url = "<?php echo base_url('sup/Toko/add_ajax_kab');?>/"+$(this).val();
	      $('#kabupaten').load(url);
	       return false;
	    })
	   
      $("#kabupaten").change(function (){
        var url = "<?php echo base_url('sup/Toko/add_ajax_kec');?>/"+$(this).val();
         $('#kecamatan').load(url);
         return false;
      })
     
      // update foto
      $('#updateFotoForm').submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: '<?php echo base_url("sup/Toko/update_foto"); ?>',
        type: 'post',
        data: new FormData(this),
        processData: false,
        contentType: false,
        dataType : 'json',
        success: function(data) {
          // Tampilkan pesan sukses
          Swal.fire(
          'Berhasil Update Foto',
           'Foto Toko berhasil di perbaharui!',
           'success'
        )
          $('#foto_toko').attr({src: "<?= base_url('assets/img/toko/')?>" + data.toko.foto_toko});
        },
        error: function(data) {
           // menampilkan pesan eror
         Swal.fire(
          'Gagal Update Foto',
           'Silahkan cek kembali jenis & ukuran foto !',
           'error'
        )
        }
      });
    });
    
    })
  </script>
