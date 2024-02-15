<section class="content">
  <div class="container-fluid">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"><i class="nav-icon fas fa-box"></i> Detail Retur Barang</h3>
        <div class="card-tools">
          <a href="<?= base_url('spg/retur') ?>" type="button" class="btn btn-tool">
            <i class="fas fa-times"></i>
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group mb-1">
              <label>No Retur :</label>
              <label style="float: right;"><?= format_tanggal1($tanggal) ?></label>
              <input type="text" class="form-control form-control-sm" value="<?= $no_retur ?>" readonly>
            </div>
            <div class="form-group mb-1">
              <label>Toko :</label>
              <input type="text" class="form-control form-control-sm" value="<?= $nama_toko ?>" readonly>
            </div>
            <div class="form-group mb-1">
              <label>Status :</label> <br>
              <?= status_retur($status) ?>
            </div>
          </div>
        </div>
        <hr>

        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr class="text-center">
              <th>No.</th>
              <th>Kode Artikel</th>
              <th>No Pengiriman</th>
              <th>Qty</th>
              <th>Foto</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 0;
            $total = 0;
            foreach ($detail_retur as $d) {
              $no++ ?>
              <tr>
                <td><?= $no ?></td>
                <td><?= $d->kode ?></td>
                <td class="text-center"><?= $d->id_pengiriman ?></td>
                <td class="text-center"><?= $d->qty ?></td>
                <td>
                  <img class="img img-rounded " style="height: 50px;" src="<?= base_url('assets/img/retur/' . $d->foto) ?>" alt="User Image">
                </td>
                <td><?= $d->keterangan ?></td>
              </tr>
            <?php
              $total += $d->qty;
            } ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3" align="right"> <strong>Total :</strong> </td>
              <td class="text-center"><b><?= $total; ?></b></td>
              <td></td>
              <td></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="card-footer">
        <div class="row no-print">
          <div class="col-12">
            <button type="button" class="btn btn-success btn-resi btn-sm float-right <?= ($status == 2 ? '' : 'd-none') ?>" data-toggle="modal" data-target="#modal-resi" data-kode="<?= $d->id_retur ?>"><i class="fas fa-arrow-circle-right"></i> Kirim</button>

            <a href="<?= base_url('spg/retur') ?>" class="btn btn-danger btn-sm float-right" style="margin-right: 5px;"> <i class="fas fa-arrow-left"></i> close</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title judul">
            <li class="fas fa-cube"></li>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <img class="img-rounded" style="width: 100%" src="<?= base_url('assets/img/retur/' . $d->foto) ?>" alt="User Image">
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>
  <div class="modal fade" id="modal-resi">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title judul">
            <li class="fas fa-cube"></li>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="<?= base_url('spg/retur/resi') ?>" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <input type="hidden" name="no_retur" class="form-control retur">
              <label>Ekspedisi</label>
              <select name="ekspedisi" class="form-control" id="ekspedisi" required>
                <option value="">- Pilih Ekspedisi -</option>
                <option value="gudang">Tim Gudang Pusat</option>
                <option value="jne">JNE</option>
                <option value="j&t">J&T Ekspress</option>
                <option value="sicepat">Sicepat</option>
                <option value="wahana">Wahana</option>
                <option value="tiki">Tiki</option>
              </select>
            </div>
            <div class="form-group d-none gudang">
              <label>Tanggal Maximum Penjemputan</label>
              <input type="date" name="tgl_penjemputan" class="form-control" value="<?= date('Y-m-d', strtotime('+5 days')) ?>" readonly="">
            </div>
            <div class="d-none resi">
              <div class="form-group">
                <label>Nomor Resi</label>
                <input type="text" name="resi" class="form-control" placeholder="Input Nomor Resi">
              </div>

            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal">
              <li class="fas fa-times-circle"></li> Cancel
            </button>
            <button type="submit" class="btn btn-success">
              <li class="fas fa-save"></li> Simpan
            </button>
          </div>
        </form>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>
</section>
<script>
  $(document).ready(function() {
    // get Edit Product
    $('.btn-foto').on('click', function() {
      // get data from button edit
      var kode = $(this).data('kode');
      // Set data to Form Edit
      $('.judul').text(kode);
      // Call Modal Edit
      $('#editModal').modal('show');
    });
    // pilih ekspedisi
    $('select[name="ekspedisi"]').on('change', function() {
      if (($(this).val() == "gudang") || ($(this).val() == "")) {
        $('.resi').addClass("d-none");
        $('.gudang').removeClass("d-none");
      } else {
        $('.resi').removeClass("d-none");
        $('.gudang').addClass("d-none");
      }
    });
  })
</script>
<script>
  $(document).ready(function() {
    // get Edit Product
    $('.btn-resi').on('click', function() {
      // get data from button edit
      var kode = $(this).data('kode');
      // Set data to Form Edit
      $('.judul').text(kode);
      $('.retur').val(kode);
      // Call Modal Edit
      $('#editModal').modal('show');
    });
  })
</script>