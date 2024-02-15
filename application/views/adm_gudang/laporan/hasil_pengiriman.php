<section class="content">
  <div class="row">
    <div class="col-md-12">
    <!-- iCheck -->
      <div class="card card-info">
        <div class="card-header ">
          <h3 class="card-title"><li class="fas fa-truck"></li> Hasil Pencarian  <li class="fas fa-check-circle"></li></h3>
        </div>
       <div class="card-body">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4"></div>
          <div class="col-md-4 text-right">
          
          <a href="<?=base_url('adm_gudang/laporan')?>" class="btn btn-danger" ><li class="far fa-times-circle"></li> Close</a>
          </div>
        </div>
        <hr>
      <div class="row">
        <div class="col-md-12">
        <table class="table table-striped table-bordered" id="example1">
          <thead>
            <tr>
              <th> No. </th>
              <th> Kode Pengiriman </th>
              <th> Toko</th>
              <th> Status </th>
              <th> Tanggal </th>
            </tr>
          </thead>
          <tbody>
          <?php $no = 0;
            foreach ($laporan as $row) { ?>
            <tr>
              <td><?php echo ++$no; ?></td>
              <td><?php echo $row->id; ?></td>
              <td><?php echo $row->nama_toko; ?></td>
              <td>
              <?= status_pengiriman($row->status) ?>
              </td>
              <td><?= $row->created_at ?></td>
             </tr>
          <?php } ?>
        </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>
</section>
