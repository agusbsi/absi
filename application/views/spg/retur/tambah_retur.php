<section class="content">
  <div class="container-fluid">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"><i class="nav-icon fas fa-plus-circle"></i> Form Pengajuan Retur</h3>
        <div class="card-tools">
          <a href="<?= base_url('spg/retur') ?>" type="button" class="btn btn-tool">
            <i class="fas fa-times"></i>
          </a>
        </div>
      </div>
      <div class="card-body">

        <!-- Master -->
        <div class="card card-default">

          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>No Retur :</label>
                  <label for="" style="float: right;"><?= date('d-m-Y') ?></label>
                  <input type="text" class="form-control" name="kode_retur" value="<?= $kode_retur ?>" readonly>
                </div>

              </div>
              <div class="col-md-1"></div>
              <!-- /.col -->
              <div class="col-md-5">
                <div class="form-group">
                  <label>Toko :</label> <br>
                  [ <?= $toko_new->nama_toko ?> ]
                </div>
              </div>
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
        </div>
        <hr>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Kode Artikel</th>
              <th>Qty</th>
              <th>No Pengiriman</th>
              <th>Foto</th>
              <th>Keterangan</th>
              <th>Catatan</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($this->cart->contents() as $d) { ?>
              <tr>
                <td><?= $d['options'] ?></td>
                <td><?= $d['qty'] ?></td>
                <td><?= $d['sj'] ?></td>
                <td>
                  <img class="img img-rounded " style="height: 50px;" src="<?= base_url('assets/img/retur/' . $d['foto_retur']) ?>" alt="User Image">
                </td>
                <td><?= $d['keterangan']['status'] ?></td>
                <td><?= $d['keterangan']['catatan']; ?></td>
                <td><a class="btn btn-danger btn-sm" href="<?= base_url('spg/retur/hapus_cart/') . $d['rowid'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
              </tr>
            <?php } ?>
          </tbody>
          <tr>
            <td colspan="7">
              <button id="btn-tampil" class="btn btn-link btn-block" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <i class="fa fa-plus"></i>Tambah Item
              </button>
              <div class="collapse" id="collapseExample">
                <form method="POST" action="<?= base_url('spg/Retur/tambah_cart'); ?>" enctype="multipart/form-data">
                  <div class="form-group">
                    <select name="id" class="form-control select2bs4" id="id_produk" required>
                      <option value="">Pilih Produk</option>
                      <?php foreach ($list_produk as $l) { ?>
                        <option value="<?= $l->id_produk ?>"><?= $l->kode ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <?php  ?>
                  <div class="form-group" id="show_data">
                    <label> Stok :</label>
                    <input type="text" class="form-control" name="stok" readonly="" id="stok">
                  </div>
                  <div class="form-group">
                    <label> Pengiriman :</label>
                    <input type="text" class="form-control" name="no_kirim" placeholder=" No Pengiriman jika ada....">
                  </div>
                  <div class="form-group">
                    <label> Jumlah :</label>
                    <input class="form-control" type="number" min="0" name="qty" required="" placeholder="Jumlah" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <input type="file" name="foto_retur" class="form-control" id="foto_retur" accept="image/png, image/jpeg, image/jpg" required>
                    <small class="text-danger">*Wajib melampirkan foto Produk yang akan di retur ! ( Format : JPG,PNG,JPEG ) pastikan, Max foto. 1 mb</small>

                  </div>
                  <div class="form-group">
                    <select name="keterangan" class="form-control" required>
                      <option value="">- Pilih Keterangan -</option>
                      <option value="kehilangan">kehilangan <span>(Isi tidak lengkap)</span></option>
                      <option value="cacat">Produk Cacat</option>
                      <option value="lain">Lainnya..</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <textarea name="catatan" class="form-control" placeholder="Tambahkan catatan jika ada.."></textarea>
                    <small>*opsional</small>
                  </div>
                  <div class="form-group text-center">
                    <button type="submit" class="btn btn-success"><i class="fa fa-cart-plus"></i> Add List</button>
                  </div>
                </form>
              </div>
            </td>
          </tr>
          <?php if (count($data_cart) > 0) { ?>
            <form action="<?= base_url('spg/Retur/kirim_retur') ?>" enctype="multipart/form-data" method="post" id="form_retur">
              <tr>
                <td colspan="7">
                  <div class="form-group">
                    <label> Lampiran :</label>
                    <input class="form-control form-control-sm" name="lampiran" id="lampiran" type="file" accept="image/png, image/jpeg, image/jpg">
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="7">
                  <div class="form-group">
                    <label> Foto Packing :</label>
                    <input class="form-control form-control-sm" name="foto_packing" id="packing" type="file" accept="image/png, image/jpeg, image/jpg">
                  </div>
                </td>
              </tr>
            </form>
            <tr>
              <td colspan="7" class="text-right">
                <a class="btn btn-success btn-sm" id="btn-kirim" href="#">
                  <li class="fa fa-save "></li> Proses retur
                </a>
              </td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
  $(document).ready(function() {
    $('#btn-tampil').click(function() {
      $('#btn-kirim').toggle();
    })
  });
</script>
<script>
  document.getElementById("btn-kirim").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent the default behavior of the link

    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Data permintaan akan dikirim",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Batal',
      confirmButtonText: 'Yakin'
    }).then((result) => {
      if (result.isConfirmed) {
        var lampiran = $('#lampiran').val();
        var packing = $('#packing').val();
        if (lampiran === "" || packing === "") {
          Swal.fire({
            title: 'Belum lengkap',
            text: "Lampiran & foto packing harus di isi",
            icon: 'info',
          });
        } else {
          document.getElementById("form_retur").submit(); // Submit the form
        }

      }
    })
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#id_produk').on('change', function() {
      // menampilkan detail permintaan
      var id = $(this).val();
      const kirim = $('#id_produk option:selected').data('kirim');
      $.ajax({
        type: 'get',
        url: '<?php echo base_url() ?>spg/Retur/tampilkan_detail_produk/' + id,
        async: true,
        data: {
          id: id,
          id_kirim: kirim
        },
        dataType: 'json',
        success: function(data) {
          $('#stok').val(data.stok);
        }

      });
      // end detail permintaan

    });

    // jumlah di isi
    // $('input[name="qty"]').on('keydown keyup change', function() {
    //   var input = $(this).val();
    //   var stok = $('input[name="stok"]').val();
    //   var terima = $('input[name="qty_terima"]').val();
    //   if (parseInt(input) > parseInt(stok)) {
    //     Swal.fire(
    //       'Peringatan !',
    //       'Pastikan jumlah yang di retur tidak melebihi jumlah Stok.',
    //       'info'
    //     )
    //     $(this).val(stok);
    //   } else if (parseInt(input) > parseInt(terima)) {
    //     Swal.fire(
    //       'Peringatan !',
    //       'Pastikan jumlah yang di retur tidak melebihi jumlah Penerimaan.',
    //       'info'
    //     )
    //     $(this).val(terima);
    //   }
    // });

  });
</script>
<script>
  $(document).ready(function() {

    $('#table_retur').DataTable({
      order: [
        [0, 'asc']
      ],
      responsive: true,
      lengthChange: false,
      autoWidth: false,
    });


  })
</script>