<section class="content">
  <div class="container-fluid">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"><i class="nav-icon fas fa-box"></i> Form Permintaan Barang</h3>
        <div class="card-tools">
          <a href="<?= base_url('spg/Permintaan') ?>" type="button" class="btn btn-tool">
            <i class="fas fa-times"></i>
          </a>
        </div>
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col">
            <b>No. PO</b><br>
            <b>Toko</b><br>
            <b>Tanggal</b><br>
          </div>
          <div class="col">
            : <?= $no_permintaan ?><br>
            : <?= $toko_new->nama_toko ?><br>
            : <?= date('d-m-Y') ?><br>
            <input type="hidden" id="toko" value="<?= $toko_new->id ?>">
            <input type="hidden" id="status_toko" value="<?= $toko_new->status_ssr ?>">
          </div>
        </div>
        <hr>
        <h3>List Barang</h3>

        <table class="table table-bordered table-striped">
          <tr>
            <th>Kode #</th>
            <th>Qty</th>
            <th>Keterangan</th>
            <th>Action</th>
          </tr>
          <?php foreach ($data_cart as $d) { ?>
            <tr>
              <td><?= $d['options'] ?></td>
              <td><?= $d['qty'] ?></td>
              <td><?= $d['satuan'] ?></td>
              <td><a class="btn btn-danger btn-sm" href="<?= base_url('spg/permintaan/hapus_cart/') . $d['rowid'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
            </tr>
          <?php } ?>
          <tr>
            <td colspan="4">
              <button id="btn-tampil" class="btn btn-link btn-block" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <i class="fa fa-plus"></i>Tambah Barang
              </button>
              <div class="collapse" id="collapseExample">
                <form method="POST" action="<?= base_url('spg/Permintaan/tambah_cart'); ?>">
                  <div class="form-group">
                    <label>Pilih Barang</label>
                    <select name="id" class="form-control select2bs4" id="id_produk">
                      <option value="">Pilih Barang</option>
                      <?php foreach ($list_produk as $l) { ?>
                        <option value="<?= $l->id ?>"><?= $l->kode ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <?php  ?>
                  <div class="form-group">
                    <div class="card d-none" id="detail_produk">
                      <div class="card-header">
                        <h3 class="card-title">
                          <small id="nama_produk"></small>
                        </h3>
                      </div>
                      <div class="card-body pt-0">
                        <small>Stok : </small> <small id="stok_tersedia"></small> <br>
                        <small>Satuan :</small> <small id="satuan"></small> <br>
                        <small>Max Stok :</small> <small id="max_stok"></small>
                      </div>
                      <!-- /.card-body -->
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Qty</label>
                    <input class="form-control" id="qty_po" type="number" min="0" name="qty" required>
                    <input id="max_po" type="hidden">
                    <small class="text-danger d-none" id="artikel_blok">Barang di batasi, karena tidak terjual dalam 3 bulan terakhir.</small>
                  </div>
                  <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan" placeholder="Tambahkan keterangan jika ada.."></textarea>
                    <small>*opsional</small>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Tambahkan ke List</button>
                  </div>
                </form>
              </div>
            </td>
          </tr>
          <?php if (count($data_cart) > 0) { ?>
            <tr class="text-center">
              <td colspan="5" class="text-right"><a class="btn btn-primary" id="btn-kirim" href="#"><i class="fa fa-check-circle" aria-hidden="true"></i> Kirim</a></td>
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

  $('#btn-kirim').click(function(e) {
    e.preventDefault();
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
        location.href = "<?= base_url('spg/Permintaan/kirim_permintaan') ?>";
      }
    })
  })
</script>


<script type="text/javascript">
  $(document).ready(function() {
    $('#id_produk').on('change', function() {
      var id = $(this).val();
      var toko = $('#toko').val();
      var status_toko = $('#status_toko').val();
      $.ajax({
        url: '<?php echo base_url() ?>spg/permintaan/tampilkan_detail_produk/',
        method: "POST",
        data: {
          id: id,
          toko: toko
        },
        dataType: 'json',
        success: function(data) {
          $('#nama_produk').text(data.nama_produk);
          $('#stok_tersedia').text(data.qty);
          $('#satuan').text(data.satuan);
          $('#max_stok').text(data.ssr);
          $('#max_po').val(data.ssr);
          $('#detail_produk').removeClass('d-none');
          if (data.ssr == 0 && status_toko == 1) {
            $('#qty_po').prop('disabled', true);
            $('#qty_po').val('');
            $('#artikel_blok').removeClass('d-none');
          } else {
            $('#artikel_blok').addClass('d-none');
            $('#qty_po').prop('disabled', false);
          }

        }

      });
      // end detail permintaan

    });
    $("#qty_po").on("input", function() {
      var id = $(this).val();
      var max = $('#max_po').val();
      var status_toko = $('#status_toko').val();

      if ((parseInt(id) > parseInt(max)) && status_toko == 1) {
        alert("Jumlah tidak boleh melebihi Maximal stok");
        this.value = max;
      }
    });
  });
</script>