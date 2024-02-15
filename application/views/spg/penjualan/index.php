<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-money-bill"></i> <?= $title ?></h3>
          </div>
            <div class="card-body">
            <h3>Data Penjualan Barang</h3>
              <div class="row">
                <a href="<?=base_url('spg/penjualan/tambah_penjualan')?>" class="btn btn-success ml-auto"><li class="fas fa-plus"></li> Input Penjualan</a>
              </div>
              <hr>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>No. Penjualan #</th>
                  <th>Tanggal Penjualan</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 0;
                 foreach($list_penjualan as $row){
                  $no++ ?>
                <tr>
                  <td><?= $no ?></td>
                    <td><?=$row->id?></td>
                    <td><?= format_tanggal1($row->tanggal_penjualan) ?></td>
                    <td><a class="btn btn-primary btn-sm" href="<?= base_url('spg/Penjualan/detail/').$row->id ?>"><i class="fa fa-eye" aria-hidden="true"></i> Detail</a></td>
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
</section>


