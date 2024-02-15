<section class="content">
  <div class="container-fluid">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"><i class="nav-icon fas fa-box"></i> <?= $title ?></h3>
      </div>
      <div class="card-body">
      <h3>Detail Penjualan Barang</h3>
        <div class="row">
          <div class="col">
            <b>No. Penjualan</b><br>
            <b>Toko</b><br>
            <b>Tanggal Penjualan</b><br>
          </div>
          <div class="col">
            : <?= $no_permintaan ?><br>
            : <?= $nama_toko." ($nama)" ?><br>
            : <?= format_tanggal1($tanggal) ?><br>
          </div>
        </div>
        <hr>
        <table class="table table-bordered table-striped">
          <tr>
            <th>Kode Artikel</th>
            <th>Nama Artikel</th>
            <th>Qty</th>
          </tr>
          <?php foreach ($detail_penjualan as $d) { ?>
          <tr>
            <td><?= $d->kode ?></td>
            <td><?= $d->nama_produk ?></td>
            <td><?= $d->qty ?></td>
          </tr>
          <?php } ?>
        </table>
    </div>
  </div>
  <a href="<?= base_url('spg/Penjualan') ?>" class="btn btn-link"><i class="fa fa-arrow-left"></i> Kembali ke halaman depan</a>
</div>
</section>