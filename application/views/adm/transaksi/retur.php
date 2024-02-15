<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-exchange-alt"></i> <?= $title ?></h3>
          </div>
            <div class="card-body">
              <h3>Data Retur Barang</h3>
              <form action="<?= base_url('adm/Retur') ?>" method="get">
                <small class="text-red">Silahkan pilih tanggal terlebih dahulu untuk menampilkan data berdasarkan tanggal.</small>
                <div class="form-group">
                  <label>Dari</label>
                  <input class="form-control col-md-3" type="date" name="tgl_awal" value="<?= $this->input->get('tgl_awal') ?>">
                </div>
                <div class="form-group">
                  <label>Sampai</label>
                  <input class="form-control col-md-3" type="date" name="tgl_akhir" value="<?= $this->input->get('tgl_akhir') ?>">
                </div>
                <div class="form-group">
                  <input class="btn btn-success" type="submit" value="Tampilkan Data">
                </div>
              </form>
              <div class="row">
              </div>
              <hr>
              <div class="<?= ($list_retur) ? '' : 'd-none' ?>">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Tanggal Permintaan</th>
                    <th>No. Permintaan</th>
                    <th>Nama Toko</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($list_retur as $row){ ?>
                  <tr>
                      <td><?= format_tanggal1($row->created_at) ?></td>
                      <td><?=$row->id?></td>
                      <td><?=$row->nama_toko?></td>
                      <td><a class="btn btn-primary btn-sm" href="<?= base_url('adm/Retur/detail/').$row->id ?>"><i class="fa fa-eye" aria-hidden="true"></i> Detail</a></td>
                  </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


