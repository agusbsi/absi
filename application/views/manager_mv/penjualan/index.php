<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-cube"></i>
              Data Penjualan
            </h3>
          </div>
          
          <div class="card-body">
            <?php if ($this->session->userdata('role') == 6) { ?>
            <h5>Filter penjualan berdasarkan tanggal penjualan</h5>
            <form method="GET" action="<?= base_url('sup/Penjualan') ?>">
                <div class="row">
                    <div class="form-group col-2">
                        <label>Tanggal Awal</label>
                        <input name="tgl_awal" class="form-control" type="date" required>
                    </div>
                    <div class="form-group col-2">
                        <label>Tanggal Akhir</label>
                        <input name="tgl_akhir" class="form-control" type="date" required>
                    </div>
                    <div class="form-group col">
                        <br>
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </div>
                </div>
            </form>
            <?php } ?>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width: 1%">
                    #
                  </th>
                  <th style="width: 20%">No. Penjualan</th>
                  <th>
                    Nama Toko
                  </th>
                  <th>Tgl. Penjualan</th>
                  <th>Tgl Buat</th>
                  <th style="width: 13%">Menu</th>
                </tr>
              </thead>
              <tbody>
                <?php if (is_array($list_data)) { ?>
                  <?php $no = 0; ?>
                  <?php foreach ($list_data as $data) {
                    $no++ ?>
                    <tr>
                      <td><?= $no; ?></td>
                      <td><?= $data->id; ?></td>
                      <td><?= $data->nama_toko; ?></td>
                      <td><?= format_tanggal2($data->tanggal_penjualan); ?></td>
                      <td><?= format_tanggal2($data->created_at); ?></td>
                      <td>
                        <a href="<?= base_url('sup/Penjualan/detail/' . $data->id) ?>" class="btn btn-primary btn-sm" title="Detail"><i class="fas fa-eye"></i> <?= ($akses == 1) ? "" : "Detail" ?></a>
                        <button onclick="exportSo('<?= $data->id; ?>','<?= $data->nama_toko; ?>','<?= $data->tanggal_penjualan; ?>')" data-toggle="modal" data-target=".edit_modal" class="btn btn-warning <?= ($akses == 1) ? "" : "d-none" ?> btn-sm" title="Edit tgl"><i class="fas fa-edit"></i></button>
                        <a href="#" class="btn btn-danger <?= ($akses == 1) ? "" : "d-none" ?> btn-sm btn_delete" data-id="<?= $data->id ?>" title="Hapus"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                  <?php } ?>
                <?php } else { ?>
                  <tr>
                    <td colspan="7" align="center"><strong>Data Kosong</strong></td>
                  </tr>
                <?php } ?>
              </tbody>

            </table>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="modal fade edit_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <form id="formExport" action="<?= base_url('sup/Penjualan/update_jual') ?>" method="post">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title" id="exampleModalLabel">Edit Penjualan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <label for="">No. Penjualan :</label>
          <input type="text" id="nomor" class="form-control form-control-sm" readonly>
          <div class="form-group">
            <label for="">Toko :</label>
            <input type="text" id="toko" class="form-control form-control-sm" readonly>
          </div>
          <div class="form-group">
            <label for="">Tgl Penjualan :</label>
            <input type="date" name="tanggal" id="tgl_jual" class="form-control form-control-sm" autocomplete="off" required>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id_jual" id="id_jual" />
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btn-sm" id="export-button"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
  function exportSo(id, toko, tgl) {
    var tanggal = tgl.split(' ')[0];
    $('#id_jual').val(id);
    $('#nomor').val(id);
    $('#toko').val(toko);
    $('#tgl_jual').val(tanggal);
  }
</script>
<script>
  $('.btn_delete').click(function(e) {
    const id = $(this).data('id');
    e.preventDefault();
    Swal.fire({
      title: 'Hapus Data',
      text: "Apakah anda yakin untuk Menghapusnya ?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Batal',
      confirmButtonText: 'Yakin'
    }).then((result) => {
      if (result.isConfirmed) {
        location.href = "<?php echo base_url('sup/Penjualan/hapus_data/') ?>" + id;
      }
    })
  })
</script>