<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
             <!-- Master -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title"><li class="fas fa-box"></li> <strong>Data Mutasi</strong> </h3>
                
            </div>
            <!-- /.card-header -->
          <form>
            <div class="card-body">                         
                <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>No Mutasi :</label>
                    <input type="text" class="form-control id_mutasi" name="id_mutasi"  value="<?= $mutasi->id ?>" readonly>
                    </div>
                    <div class="form-group">
                    <label>Tanggal :</label>
                    <input type="text" class="form-control" name="tgl_mutasi"  value="<?= $mutasi->created_at ?>" readonly>
                  </div>
                    <!-- /.form-group -->
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Toko Asal :</label>
                    <input type="text" class="form-control"   value="<?= $mutasi->asal ?>" readonly>
                    <input type="hidden" name="id_toko_asal" value ="<?= $mutasi->toko_asal ?>">
                  </div>
                  <div class="form-group">
                    <label>Toko tujuan :</label>
                    <input type="text" class="form-control"  value="<?= $mutasi->tujuan ?>" readonly>
                  </div>
                    <!-- /.form-group -->
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Diajukan Oleh :</label>
                    <br>
                    [ <?= $mutasi->leader ?> ]
                    </div>
                    <br>
                    <div class="form-group">
                    <label>Status :</label>
                    <br>
                    <?= status_mutasi($mutasi->status) ?>
                    </div>
                    <!-- /.form-group -->
                  </div>
            
                </div>
                <!-- /.row -->
                
            </div>
            <!-- /.card-body -->

        </div>
        <!-- end master -->
            <!-- print area -->
            <div id="printableArea">
            <!-- Main content -->
           

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr >
                      <th class="text-center">No</th>
                      <th>Kode Artikel #</th>
                      <th>Nama Artikel</th>
                      <th>Satuan</th>
                      <th>QTY</th>
                      <th style="width:10%">QTY Terima</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                            $no = 0;
                            $total = 0;
                            foreach ($detail_mutasi as $d) {
                            $no++; 
                        ?>
                            <tr>
                            <td class="text-center">
                              <?= $no ?>
                            </td>
                                <td><?= $d->kode ?>
                                <input type="hidden" name="id_produk[]" value="<?= $d->id_produk ?>">
                                </td>
                                <td><?= $d->nama_produk ?></td>
                                <td>
                                <?= $d->satuan ?>
                                </td>
                                <td >
                                  <?= $d->qty ?>
                                  <input type="hidden" name="qty[]" value="<?= $d->qty ?>">
                                </td>
                                <td>
                                  <input type="number" class="form-control" name="qty_terima[]"  min="0" max="<?= $d->qty ?>" value="<?= $d->qty ?>" required>
                                </td>
                            </tr>
                        <?php 
                        $total += $d->qty;
                            } 
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" >  </td>
                            <td ><strong>Total : </strong></td>
                            <td><strong><?= $total ; ?></strong></td>
                            <td>
                              <p id="total_terima"></p>
                            </td>
                         
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
                  <?php if($mutasi->status == 1) { ?>
                    <div class="col-12">
                    <a id="btn_terima" type="button" class='btn btn-success float-right'><i class='fa fa-save' aria-hidden='true'></i> Terima Barang</a>
                    </div>
                  <?php } else { ?>
                  <a type="button" onclick="printDiv('printableArea')" target="_blank" class="btn btn-default float-right" style="margin-right: 5px;">
                    <i class="fas fa-print"></i> Print 
                  </a> 
                   <a href="<?=base_url('spg/Mutasi')?>" class="btn btn-danger float-right" style="margin-right: 5px;"><i class="fas fa-times-circle"></i> Close </a>
                   <?php } ?>
                </div>
              </div>
            </div>
            </div>
            <!-- end print area -->
            </form>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <script>
      function printDiv(divName) {
          var printContents = document.getElementById(divName).innerHTML;
          var originalContents = document.body.innerHTML;
          document.body.innerHTML = printContents;
          window.print();
          document.body.innerHTML = originalContents;
      }
    </script>
    <script>
      $(document).ready(function()
      {
        $('#btn_terima').click(function(e){
          e.preventDefault();
          Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data Terima barang mutasi akan di simpan",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Yakin'
          }).then((result) => {
            if (result.isConfirmed) {
              // proses data terima
              var formData = $('form').serialize();
              $.ajax({
                url: '<?php echo base_url('spg/Mutasi/terima')?>',
                method: "POST",
                data: formData,
                dataType: "text",
                success: function(n){
                  Swal.fire('Berhasil','Data berhasil disimpan !','success');
                  location.href="<?php echo base_url('spg/Mutasi') ?>";
                }
              });
          // end proses
            }
          })
        });

        // ketika qty terima di ganti
        $('input[name="qty_terima[]"]').keyup(function()
        {
          var qty_terima = $(this).val();
          var qty_terima_max = $(this).attr('max');
          if( parseInt(qty_terima) > parseInt(qty_terima_max)){
            // menampilkan pesan eror
            Swal.fire(
            'Melebihi jumlah Mutasi',
              'Pastikan input jumlah yang sesuai dan tidak melebihi jumlah Mutasi',
              'info'
            )
            $(this).val(qty_terima_max);
            }
            // menjumlahkan semua qty_terima yang di input
            var qty_terima_sum = 0;
            $('input[name="qty_terima[]"]').each(function()
            {
              qty_terima_sum += parseInt($(this).val());
              });
              // menampilkan jumlah qty_terima ke id total_terima html
              $('#total_terima').html(qty_terima_sum);

        });
      });
    </script>



