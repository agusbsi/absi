<style>
  td {
    font-size: 12px;
    text-align: left;
  }

  tr {
    font-size: 14px;
  }
</style>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

        <!-- /.card -->

        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"> <i class="fas fa-cube"></i> Data Artikel</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <div class="row">
              <div class="col-md-6"></div>
              <div class="col-md-6 text-right">
                <a href="<?= base_url('') ?>/assets/excel/Template_artikel.xlsx" class="btn btn-warning btn-sm"><i class="fas fa-download"></i>
                  Download template
                </a>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-import"><i class="fas fa-upload"></i>
                  Import Artikel
                </button>
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i>
                  Tambah Artikel
                </button>

              </div>
            </div>
            <hr>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width:3%">No</th>
                  <th style="width:15%">Kode</th>
                  <th class="text-center">Nama Artikel</th>
                  <th>Satuan</th>
                  <th style="width:9%" class="text-center">HET Jawa</th>
                  <th style="width:9%" class="text-center">HET IndoBarat</th>
                  <th style="width:9%" class="text-center">SP</th>
                  <th class="text-center">Status</th>
                  <th style="width:10%" class="text-center">Menu</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php if (is_array($list_data)) { ?>
                    <?php
                    $no = 0;
                    foreach ($list_data as $dd) :
                      $no++; ?>
                      <td><?= $no ?></td>
                      <td><?= $dd->kode ?></td>
                      <td><?= $dd->nama_produk ?></td>
                      <td><?= $dd->satuan ?></td>
                      <td class="text-right">
                        Rp <?= number_format($dd->harga_jawa) ?>
                      </td>
                      <td class="text-right">
                        Rp <?= number_format($dd->harga_indobarat) ?>
                      </td>
                      <td class="text-right">
                        Rp <?= number_format($dd->sp) ?>
                      </td>
                      <td><?= status_artikel($dd->status) ?></td>
                      <td>
                        <?php if ($dd->status == 2) { ?>
                          <a href="<?= base_url('adm/Produk/reject/' . $dd->id) ?>" class="btn btn-danger btn-sm">
                            <li class="fas fa-times-circle"></li> reject
                          </a>
                          <a href="<?= base_url('adm/Produk/approve/' . $dd->id) ?>" class="btn btn-success btn-sm">
                            <li class="fas fa-check-circle"></li> Approve
                          </a>
                        <?php } else { ?>
                          <button class="btn btn-warning btn-edit btn-sm" data-toggle="modal" data-target="#editModal" data-id="<?= $dd->id; ?>" data-kode="<?= $dd->kode; ?>" data-status="<?= $dd->status; ?>" data-nama_produk="<?= $dd->nama_produk; ?>" data-harga1="<?= $dd->harga_jawa; ?>" data-harga2="<?= $dd->harga_indobarat; ?>" data-satuan="<?= $dd->satuan; ?>" data-sp="<?= $dd->sp; ?>">
                            <i class="fas fa-edit"></i></button>
                          <a type="button" class="btn btn-danger btn-hapus btn-sm" href="<?= base_url('adm/produk/hapus/' . $dd->id) ?>" title="Nonaktif artikel"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>
                        <?php } ?>
                      </td>
                </tr>
              <?php endforeach; ?>
            <?php } ?>

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
<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> <i class="fas fa-cube"></i> Form Tambah Artikel</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- isi konten -->
        <form method="POST" action="<?= base_url('adm/produk/proses_tambah') ?>">
          <div class="form-group mb-1">
            <label for="kode">Kode Artikel</label>
            <input type="text" name="kode" class="form-control form-control-sm" autocomplete="off" placeholder="Kode Artikel" required="">
          </div>
          <div class="form-group mb-1">
            <label for="nama">Deskripsi</label>
            <input type="text" name="nama" class="form-control form-control-sm" autocomplete="off" id="nama" placeholder="Nama Artikel" required>
          </div>
          <div class="form-group mb-1">
            <label for="satuan">Satuan</label> </br>
            <select class="form-control form-control-sm" name="satuan" required>
              <option value="">- PIlih Satuan -</option>
              <option value="BND">BND</option>
              <option value="BOX">BOX</option>
              <option value="PCS">PCS</option>
              <option value="PCK">PCK</option>
            </select>
          </div>
          <div class="form-group mb-1">
            <label>HET Jawa</label>
            <input type="text" class="form-control form-control-sm" id="jawa_add" name="harga_jawa" placeholder=" Rp 0..." required>
          </div>
          <div class="form-group mb-1">
            <label>HET Indobarat</label>
            <input type="text" class="form-control form-control-sm" id="indo_add" name="harga_indo" placeholder="Rp 0..." required>
          </div>
          <div class="form-group mb-1">
            <label>SP</label>
            <input type="text" class="form-control form-control-sm" id="sp_add" name="sp" placeholder="Rp 0..." required>
          </div>


          <!-- end konten -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
          <i class="fas fa-times-circle"></i> Cancel
        </button>
        <button type="submit" class="btn btn-success btn-sm">
          <i class="fas fa-save"></i> Simpan
        </button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- Modal Edit Product-->

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="<?= base_url('adm/produk/proses_update') ?>" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-edit"></i> Update Artikel</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-grou mb-1p">
            <label>Kode Artikel</label>
            <input type="text" class="form-control form-control-sm kode" name="kode" readonly>
          </div>
          <div class="form-group mb-1">
            <label>Nama Artikel</label>
            <input type="text" class="form-control form-control-sm nama_produk" name="nama_produk" required>
          </div>
          <div class="form-group mb-1">
            <label for="satuan">Satuan</label> </br>
            <select class="form-control form-control-sm" id="satuan_edit" name="satuan" required>
              <option value="">-- PIlih Satuan --</option>
              <option value="BND">BND</option>
              <option value="BOX">BOX</option>
              <option value="PCS">PCS</option>
              <option value="PCK">PCK</option>
            </select>
          </div>
          <div class="form-group mb-1">
            <label>HET Jawa</label>
            <input type="text" class="form-control form-control-sm harga1" id="jawa_edit" name="harga_jawa" required>
          </div>
          <div class="form-group mb-1">
            <label>HET Indobarat</label>
            <input type="text" class="form-control form-control-sm harga2" id="indo_edit" name="harga_indo" required>
          </div>
          <div class="form-group mb-1">
            <label>SP</label>
            <input type="text" class="form-control form-control-sm sp" id="sp_edit" name="sp" required>
          </div>

          <div class="form-group mb-1">
            <label>Status</label>
            <select class="form-control form-control-sm" name="status" id="status_edit" required>
              <option value="1">Aktif</option>
              <option value="0">Tidak Aktif</option>
            </select>
          </div>



        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
            <i class="fas fa-times-circle"></i> Cancel
          </button>
          <input type="hidden" name="id" class="id">
          <button type="submit" class="btn btn-primary btn-sm">
            <i class="fas fa-edit"></i> Update
          </button>
        </div>

      </div>
    </form>
  </div>
</div>

<!-- End Modal Edit Product-->
<!-- end modal -->
<!-- modal tambah data -->
<div class="modal fade" id="modal-import">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
          <li class="fa fa-excel"></li> Import Excel
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- isi konten -->
        <form method="post" enctype="multipart/form-data" action="<?php echo base_url('adm/Produk/import_artikel'); ?>">
          <div class="form-group">
            <label for="file">File Upload</label>
            <input type="file" name="file" class="form-control" id="exampleInputFile" accept=".xlsx,.xls" required>
          </div>
          <!-- end konten -->
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">
          <li class="fas fa-times-circle"></li> Cancel
        </button>
        <button type="submit" class="btn btn-primary">
          <li class="fas fa-save"></li> Simpan
        </button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
  $(document).ready(function() {
    $('#jawa_add, #indo_add, #sp_add,#jawa_edit, #indo_edit, #sp_edit').on('keyup', function() {
      var angka = $(this).val().replace(/[Rp.,]/g, ''); // Hilangkan karakter 'Rp', '.' dan ',' dari nilai input
      var rupiah = formatRupiah(angka); // Ubah nilai menjadi format rupiah
      $(this).val(rupiah); // Set nilai input menjadi format rupiah
    });
    // get Edit Product
    $('.btn-edit').on('click', function() {
      // get data from button edit
      const id = $(this).data('id');
      const kode = $(this).data('kode');
      const nama_produk = $(this).data('nama_produk');
      const deskripsi = $(this).data('deskripsi');
      const satuan = $(this).data('satuan');
      const harga1 = $(this).data('harga1');
      const harga2 = $(this).data('harga2');
      const status = $(this).data('status');
      const sp = $(this).data('sp');

      // Set data to Form Edit
      $('.id').val(id);
      $('.nama_produk').val(nama_produk);
      $('.kode').val(kode);
      $('#satuan_edit').val(satuan).trigger('change');
      $('#status_edit').val(status).trigger('change');
      $('.deskripsi').val(deskripsi);
      $('.harga1').val(harga1);
      $('.harga2').val(harga2);
      $('.sp').val(sp);
      // Call Modal Edit
      $('#editModal').modal('show');
    });
  })
</script>
<script>
  function formatRupiah(angka) {
    var number_string = angka.toString().replace(/[^,\d]/g, ""),
      split = number_string.split(","),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
      separator = sisa ? "." : "";
      rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return "Rp " + rupiah;
  }
</script>