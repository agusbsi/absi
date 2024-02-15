<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-info ">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-store"></i> List Toko</b> </h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6"></div>
              <div class="col-md-6">
                <button type="button" class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-store"></i> Tambah Toko</button>
              </div>
            </div>
            <hr>
            <table id="table_toko" class="table table-bordered table-striped">
              <thead>
                <tr class="text-center">
                  <th style="width:4%">No</th>
                  <th style="width:22%">Nama Toko</th>
                  <th>Alamat</th>
                  <th style="width:15%">spg</th>
                  <th>Status</th>
                  <th style="width:17%">Menu</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 0;
                foreach ($toko as $t) :
                  $no++
                ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td>
                      <?= $t->nama_toko ?>
                      <span class="right badge badge-danger <?= $t->status != 1 && $t->status != 0  ? '' : 'd-none' ?>">New</span>
                    </td>
                    <td>
                      <address><?= $t->alamat ?></address>
                    </td>
                    <td class="text-center">
                      <?php
                      if ($t->nama_user == "") {
                        echo "<span class='badge badge-warning'> Belum dikaitkan</span>";
                      } else {
                        echo $t->nama_user;
                      }
                      ?>

                    </td>
                    <td class="text-center">
                      <?= status_toko($t->status) ?>
                    </td>
                    <td>
                      <a href="<?= base_url('adm/Toko/profil/' . $t->id) ?>" class="btn btn-<?= ($t->status == "4" || $t->status == "5") ? 'warning' : 'info'; ?> btn-sm"> <i class="fas <?= ($t->status == "4" || $t->status == "5") ? 'fa-cog' : 'fa-eye'; ?>"></i></a>
                      <a href="<?= base_url('adm/Toko/update/' . $t->id) ?>" class="btn btn-warning btn-sm "><i class="fas fa-edit"></i> </a>
                      <a href="<?= base_url('adm/Toko/unduh_pdf/' . $t->id) ?>" target="_blank" class="btn btn-outline-danger  btn-sm"><i class="fas fa-file-pdf"></i></a>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer text-center ">

          </div>
        </div>
      </div>

    </div>
  </div>
  </div>
</section>
<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title">
          Tambah Toko
        </h5>
      </div>
      <form method="post" enctype="multipart/form-data" action="<?php echo base_url('adm/Toko/tambahToko'); ?>">
        <div class="modal-body">
          <!-- isi konten -->
          <span class="badge badge-danger">Perhatian :</span> <br> - Fitur ini hanya digunakan untuk penambahan toko dari Easy Accounting ke Absi bukan untuk pembukaan Toko baru.</b>
          <hr>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="file">Nama Toko</label>
                <input type="text" name="namaToko" class="form-control form-control-sm" placeholder="nama toko...." required>
              </div>
              <div class="form-group">
                <label for="file">Customer</label>
                <select name="id_customer" class="form-control form-control-sm select2bs4" id="customer" required>
                  <option value="">- Pilih customer -</option>
                  <?php foreach ($customer as $c) : ?>
                    <option value="<?= $c->id ?>"><?= $c->nama_cust ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label for="file">Jenis Toko</label>
                <select name="jenis_toko" class="form-control form-control-sm select2bs4" required="">
                  <option value="">-Pilih-</option>
                  <option value="1">Dept Store</option>
                  <option value="6">Hypermarket</option>
                  <option value="2">Supermarket</option>
                  <option value="3">Grosir</option>
                  <option value="4">Minimarket</option>
                  <option value="5">Lain-lain.</option>
                </select>
              </div>
              <div class="form-group">
                <label>Tipe Harga</label>
                <select class="form-control select2bs4" name="het" required>
                  <option value="">- Pilih Tipe Harga -</option>
                  <option value="1">HET JAWA</option>
                  <option value="2">HET INDOBARAT</option>
                </select>
              </div>
              <div class="form-group">
                <label for="file">Dibuat Oleh</label>
                <input type="text" class="form-control form-control-sm" value="<?= $this->session->userdata('nama_user') ?>" readonly>
              </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
              <div class="form-group">
                <label>Provinsi</label>
                <select class="form-control provinsi select2bs4" name="provinsi" id="provinsi" required>
                  <option value=''>- Select Provinsi -</option>
                  <?php foreach ($provinsi as $p) : ?>
                    <option value="<?= $p->id ?>"><?= $p->nama ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label>Kabupaten</label>
                <select class="form-control kabupaten select2bs4" name="kabupaten" id="kabupaten" required>

                </select>
              </div>
              <div class="form-group">
                <label>Kecamatan</label>
                <select class="form-control kecamatan select2bs4" name="kecamatan" id="kecamatan" required>

                </select>
              </div>
              <div class="form-group">
                <label>Alamat</label> </br>
                <textarea class="form-control alamat" name="alamat"> </textarea>
              </div>
            </div>

          </div>
          <!-- end konten -->
        </div>
        <div class="modal-footer right">
          <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
            <li class="fas fa-times-circle"></li> Cancel
          </button>
          <button type="submit" class="btn btn-sm btn-success">
            <li class="fas fa-save"></li> Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- jQuery -->
<script src="<?php echo base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
<script>
  $(document).ready(function() {

    $('#table_toko').DataTable({
      order: [
        [0, 'asc']
      ],
      responsive: true,
      lengthChange: false,
      autoWidth: false,
    });


  })
</script>
<script>
  $("#provinsi").change(function() {
    var selectedProvinsi = $(this).val();

    // Lakukan permintaan AJAX untuk mengambil data Kabupaten berdasarkan Provinsi yang dipilih
    $.ajax({
      url: "<?php echo base_url('adm/Toko/add_ajax_kab'); ?>/" + selectedProvinsi,
      dataType: 'json', // Tentukan bahwa Anda mengharapkan data JSON
      success: function(data) {
        // Bersihkan elemen select kabupaten
        $('#kabupaten').empty();
        $('#kecamatan').empty();
        $('#kecamatan').append('<option value="">- Select Kecamatan -</option>');
        // Tambahkan opsi kosong sebagai opsi default
        $('#kabupaten').append('<option value="">- Select Kabupaten -</option>');

        // Tambahkan opsi-opsi kabupaten yang diterima dari respons JSON
        $.each(data, function(index, item) {
          $('#kabupaten').append('<option value="' + item.id + '">' + item.nama + '</option>');
        });
      }
    });
  });


  $("#kabupaten").change(function() {
    var url = "<?php echo base_url('adm/Toko/add_ajax_kec'); ?>/" + $(this).val();
    $.ajax({
      url: url,
      dataType: 'json', // Tentukan bahwa Anda mengharapkan data JSON
      success: function(data) {
        $('#kecamatan').empty();
        $('#kecamatan').append('<option value="">- Select Kecamatan -</option>');
        $.each(data, function(index, item) {
          $('#kecamatan').append('<option value="' + item.id + '">' + item.nama + '</option>');
        });
      }
    });
  });
</script>