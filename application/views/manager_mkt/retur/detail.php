<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <?php
                foreach ($permintaan as $p) :
            ?>    
           <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              <div class="row">
                <div class="col-md-6">
                 Retur Barang
                </div>
                <div class="col-md-6">
                  Status : <?= status_retur($p->status) ?>
                </div>
              </div>
           </div>

            <!-- print area -->
            <div id="printableArea">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
              <h4><li class="fas fa-file-alt"></li> DETAIL RETUR</h4>
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  Dari :
                  <address>
                    <strong><?= $p->nama_toko; ?></strong><br>
                    <?= $p->alamat; ?> <br>
                    Phone: ( <?= $p->telp; ?> )<br>
                 
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  No Retur:
                  <address>
                    <strong><?= $p->id ?> </strong><br>
                  
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Spg :<br>
                
                  <b>[ <?= $p->spg ?> ] </b> <br>
                 <br>
                  Tanggal: <b> <?= $p->created_at; ?></b> 
                </div>
                <!-- /.col -->
                
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                <table id="table_detail" class="table table-bordered table-striped">
                  <thead>
                  <tr class="text-center">
                    <th>No.</th>
                    <th>Nama Artikel</th>
                    <th>Surat Jalan</th>
                    <th>Qty</th>
                    <th>Foto</th>
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
                    <td><?= $d->nama_produk ?> ( <small class="badge badge-warning "><?= $d->kode_produk ?></small> )</td>
                    <td class="text-center"><?= $d->id_pengiriman ?></td>
                    <td class="text-center"><?= $d->qty ?></td>
                    <td>
                  <button type="button" class="btn btn-outline-primary btn-foto" data-id_produk ="<?= $d->kode_produk ?>" src="<?= base_url('assets/img/retur/'.$d->foto) ?>"><i class="fas fa-eye"></i>  Lihat</button>
                     </td>
                  </tr>
                  <?php 
                $total += $d->qty;
                } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                  <td  colspan="3" align="right"> <strong>Total :</strong> </td>
                  <td  class="text-right"><b><?= $total ; ?></b></td>
                  <td></td>
                </tr>
                  </tfoot>
                </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

           

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                <a type="button" onclick="printDiv('printableArea')" target="_blank" class="btn btn-default float-right" style="margin-right: 5px;">
                <i class="fas fa-print"></i> Print </a> 
                <a href="<?=base_url('mng_mkt/Retur')?>" class="btn btn-danger float-right" style="margin-right: 5px;"><i class="fas fa-times-circle"></i> Close </a>
                </div>
              </div>
            </div>
            </div>
            <!-- end print area -->
            <?php
            endforeach
            ?>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
     <!-- modal lihat foto -->
<div class="modal fade" id="lihat-foto">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title judul"> <li class="fas fa-box"></li> Berkas Produk : <a href="#" class="id_produk"></a></h4>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
             <img class="img-rounded image" id="image" style="width: 100%" src="" alt="User Image">
          </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
<!-- end modal -->
<script>
   $(function() {
     $('.btn-foto').on('click', function() {
       $('.image').attr('src',$(this).attr('src'));
       $('.id_produk').html($(this).data('id_produk'));
       $('#lihat-foto').modal('show');   
       });		
   });
</script>
    <script>
      function printDiv(divName) {
          var printContents = document.getElementById(divName).innerHTML;
          var originalContents = document.body.innerHTML;
          document.body.innerHTML = printContents;
          window.print();
          document.body.innerHTML = originalContents;
      }
    </script>


