<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">
              <li class="fas fa-hospital"></li> Data aset toko
            </h3>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr class="text-center">
                  <th>No</th>
                  <th>Nama Toko</th>
                  <th style="width: 40%;">Alamat</th>
                  <th>Jenis Aset</th>
                  <th>Total QTY</th>
                  <th>Menu</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php if (is_array($list_data)) { ?>
                    <?php $no = 1; ?>
                    <?php foreach ($list_data as $dd) : ?>
                      <td class="text-center"><?= $no ?></td>
                      <td><?= $dd->nama_toko ?></td>
                      <td><small><?= $dd->alamat ?></small></td>
                      <td class="text-center"><?= $dd->total_aset ?></td>
                      <td class="text-center"><?= ($dd->total_qty) ? $dd->total_qty : 0 ?></td>
                      <td>
                        <a href="<?= base_url('hrd/Aset/detail/' . $dd->id_toko) ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Detail</a>
                      </td>
                </tr>
                <?php $no++; ?>
              <?php endforeach; ?>
            <?php } else { ?>
              <td colspan="6" align="center"><strong>Data Kosong</strong></td>
            <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
