<section class="content">
 <div class="row">
   <div class="col-md-12">
     <div class="card card-info">
       <div class="card-header">
         <h3 class="card-title">
           <i class="fas fa-file-alt">
             Hasil Pencarian Penjualan
           </i>
         </h3>
       </div>
       <div class="form-group row">
         <div class="col-md-2">
           <label>Nama Toko</label>
         </div>
         <div class="col-md-4">
           <label>: <?= $penjualan->nama_toko ; ?></label>
         </div>
       </div>
       <div class="form-group row">
         <div class="col-md-2">
           <label>Periode</label>
         </div>
         <div class="col-md-4">
          <label>: <?= format_tanggal2($tgl_awal) . " S/D " . format_tanggal2($tgl_akhir) ?></label>
           <!-- <label>: 01-Maret-2023 s/d 31 Maret 2023</label> -->
         </div>
       </div>
       <form method="POST" >
         <table class="table table-striped table-bordered" id="">
           <thead>
             <tr>
               <th style="width: 2%">No.</th>
               <th style="width: 10%">Tgl Penjualan</th>
               <th>Kode Artikel</th>
               <th>Qty</th>
               <th>Harga Satuan</th>
               <th style="width: 8%">Diskon (%)</th>
               <th>Total</th>
             </tr>
           </thead>
           <tbody>
            <?php 
            $no = 0;
            $subtotal = 0;
            $grandtotal =0;
              foreach ($penjualan_detail as $pd) { ?> 
             <tr>
               <td><?= ++$no; ?></td>
               <td><?= format_tanggal2($pd->tanggal_penjualan); ?></td>
               <td><?= $pd->kode; ?></td>
               <td><?= $pd->qty; ?></td>
               <td><?= format_rupiah($pd->harga); ?></td>
              <?php 
                if ($pd->diskon_promo != NULL)
                    { ?>
                <td><?= $pd->diskon_promo; ?></td>
              <?php }else{ ?>
                <td>0</td>
              <?php } ?>
               <?php 
                $hrg_produk = $pd->harga;
                $qty = $pd->qty;
                $diskon_array = explode(",", $pd->diskon_promo);
                $hrg_diskon = 0;
                foreach ($diskon_array as $diskon) {
                  $nilai_diskon = (float)trim($diskon);
                  $hrg_diskon += ($hrg_produk * ($nilai_diskon/100));
                }
                $total_hrg = (($hrg_produk-$hrg_diskon)*$qty);
                ?>
               <td><?= format_rupiah($total_hrg); ?></td>
             </tr>
           <?php 
              $subtotal += $total_hrg;
              $diskon = $penjualan->diskon;
              $diskon_toko = (($subtotal*$diskon)/100);
              $grandtotal = ($subtotal-$diskon_toko);
            } ?>
           </tbody>
           <tfoot>
            <tr>
              <td colspan="6" align="right"><strong>Subtotal : </strong></td>
              <td class="text-center">
                <b><?= format_rupiah($subtotal); ?></b>
              </td>
            </tr>
            <tr>
              <td colspan="6" align="right"><strong>Diskon ( <?= $penjualan->diskon; ?>% ) : </strong></td>
              <td class="text-center" style="color: red;">
                <b><?= format_rupiah(-$diskon_toko); ?></b>
              </td>
            </tr>
            <tr>
              <td colspan="6" align="right"><strong>Total Faktur : </strong></td>
              <td class="text-center">
                <b><?= format_rupiah($grandtotal); ?></b>
              </td>
            </tr>
            <tr>
              <td colspan="7" align="right">
                <button class="btn btn-primary"><i class="fas fa-file-alt"></i>
                   Export
                </button>
              </td>
            </tr>
           </tfoot>
         </table>
       </form>
       </div>
     </div>
   </div>
 </div>
</section>

 