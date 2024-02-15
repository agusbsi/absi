<section class="content">
  <div class="container-fluid">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"><i class="nav-icon fas fa-box"></i> <?= $title ?></h3>
      </div>
      <div class="card-body">
      <h3>Detail Pengiriman Barang</h3>
        <div class="row">
          <div class="col">
            <b>No. Pengiriman</b><br>
            <b>Toko</b><br>
            <b>Tanggal Pengiriman</b><br>
            <b>Status</b><br>
          </div>
          <div class="col">
            : <?= $no_pengiriman ?><br>
            : <?= $nama_toko ?><br>
            : <?= format_tanggal1($tanggal) ?><br>
            : <?= status_pengiriman($status) ?><br>
          </div>
        </div>
        <hr>
        
        <table class="table table-bordered table-striped">
          <tr>
            <th>Kode Artikel</th>
            <th>Nama Artikel</th>
            <th>Qty Permintaan</th>
            <th>Qty Diterima</th>
          </tr>
          <?php foreach ($detail_pengiriman as $d) { ?>
          <tr>
            <td><?= $d->kode ?></td>
            <td><?= $d->nama_produk ?></td>
            <td><?= $d->qty ?></td>
            <td><?= $d->qty_diterima ?></td>
          </tr>
          <?php } ?>
        </table>
    </div>
  </div>
  <a href="<?= base_url('adm/Pengiriman') ?>" class="btn btn-link"><i class="fa fa-arrow-left"></i> Kembali ke halaman depan</a>
</div>
</section>