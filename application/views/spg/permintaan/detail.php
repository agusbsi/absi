<section class="content">
  <div class="container-fluid">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"><i class="nav-icon fas fa-box"></i> <?= $title ?></h3>
        <div class="card-tools">
          <a href="<?= base_url('spg/Permintaan') ?>" type="button" class="btn btn-tool" >
            <i class="fas fa-times"></i>
          </a>
        </div>
      </div>
      <div class="card-body">
      <h3>Detail Permintaan Barang</h3>
        <div class="row">
          <div class="col">
            <b>No. Permintaan</b><br>
            <b>Toko</b><br>
            <b>Tanggal Permintaan</b><br>
            <b>Status</b><br>
          </div>
          <div class="col">
            : <?= $no_permintaan ?><br>
            : <?= $nama_toko." ($nama)" ?><br>
            : <?= format_tanggal1($tanggal) ?><br>
            : <?= status_permintaan($status) ?><br>
          </div>
        </div>
        <hr>
        
        <table class="table table-bordered table-striped">
          <tr class="text-center">
            <th>Kode Artikel</th>
            <th>Nama Artikel</th>
            <th>Qty Awal</th>
            <!-- <th>Qty di Diterima</th> -->
          </tr>
          <?php 
          $total = 0;
          $akhir= 0;
          foreach ($detail_permintaan as $d) { ?>
          <tr>
            <td><?= $d->kode ?></td>
            <td><?= $d->nama_produk ?></td>
            <td class="text-center"><?= $d->qty ?></td>
           <!--  <td class="text-center"><?= $d->qty_diterima ?></td> -->
          </tr>
          <?php 
          $total += $d->qty;
          // $akhir += $d->qty_diterima;
          } ?>
          <tfoot>
            <tr>
              <td  colspan="2" align="right"> <strong>Total</strong> </td>
              <td  class="text-center"><b><?= $total ; ?></b></td><!-- 
              <td  class="text-center"><b><?= $akhir ; ?></b></td> -->
           </tr>
          </tfoot>
        </table>
    </div>
  </div>
 
</div>
</section>