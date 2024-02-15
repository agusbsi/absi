<!-- Main content -->
<section class="content">
      <div class="container-fluid">
          <?php 
            if ($cek_status->status == 3){ ?>
              <div class="overlay-wrapper">
                <div class="overlay">
                  <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                    <div class="text-bold pt-2">Data Toko Dalam Pengecekan Audit. !</div>
                </div>
              </div>
            <?php }else if ($cek_status->status == 0){ ?>
              <div class="overlay-wrapper">
                <div class="overlay">
                  <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                    <div class="text-bold pt-2">TOKO NON-AKTIF !</div>
                </div>
              </div>
            <?php }else if ($cek_status->status == 4){ ?>
              <div class="overlay-wrapper">
                <div class="overlay">
                  <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                    <div class="text-bold pt-2">Data Toko Menunggu Approve Direksi !</div>
                </div>
              </div>
          <?php } ?>
          <?php 
            if ($cek_status->status == 2){ ?>
            <div class="callout callout-danger">
              <div class="row">
              <div class="col-md-6">
              <h5><i class="fas fa-info "></i> Status Toko : <span class="badge badge-danger"> Toko Belum Aktif </span></h5>
                    Toko ini dalam proses Analisa, : <?= status_toko($cek_status->status) ?>
              </div>
              <div class="col-md-6 text-right">
                <br>
                <button id="btn-reject" class="btn btn-danger mr-3"><li class="fas fa-times-circle"></li> Tolak</button>
                <button id="btn-approve" class="btn btn-success mr-3"><li class="fas fa-check-circle"></li> Setujui</button>
                
              </div>
              </div>
                
            </div>
            <?php } ?>
          <div class="row">
      <div class="col-md-5">
        <!-- Profile Image -->
        <div class="card card-info">
          <div class="card-header">
            Toko
          </div>
          <div class="card-body">
            <div class="text-center">
              <?php if ($toko->foto_toko == "") {
              ?>
                <img style="width: 150px;" class="img-responsive img-rounded" src="<?php echo base_url() ?>assets/img/toko/hicoop.png" alt="User profile picture">
              <?php
              } else { ?>
                <img style="width: 150px;" class=" img-responsive img-rounded" src="<?php echo base_url('assets/img/toko/' . $toko->foto_toko) ?>" alt="User profile picture">
              <?php } ?>
            </div>
            <h3 class="profile-username text-center"><strong><?= $toko->nama_toko ?></strong></h3>
            <p class="text-muted text-center">[ ID : <?= $toko->id ?> ]</p>
            <table class="table table-sm">
              <tbody>
                <tr>
                  <td><b>Provinsi</b></td>
                  <td>
                    : <?= $toko->provinsi ?>
                  </td>
                </tr>
                <tr>
                  <td><b>Kabupaten</b></td>
                  <td>
                    : <?= $toko->kabupaten ?>
                  </td>
                </tr>
                <tr>
                  <td><b>Kecamatan</b></td>
                  <td>
                    : <?= $toko->kecamatan ?>
                  </td>
                </tr>
                <tr>
                  <td><b>Alamat</b></td>
                  <td>
                    : <?= $toko->alamat ?>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col -->
      <div class="col-md-7">
        <!-- Profile Image -->
        <div class="card card-info">
          <div class="card-header">
            Detail
          </div>
          <div class="card-body">
            <table class="table table-sm">
              <tbody>
                <tr>
                  <td><b>Jenis Toko</b></td>
                  <td>
                    : <?= jenis_toko($toko->jenis_toko) ?>
                  </td>
                </tr>
                <tr>
                  <td><b>PIC & Telp</b></td>
                  <td>
                    : <?= $toko->nama_pic ?> | <?= $toko->telp ?>
                  </td>
                </tr>
                <tr>
                  <td><b>Margin</b></td>
                  <td>
                    : <?= $toko->diskon ?> %
                  </td>
                </tr>
                <tr>
                  <td><b>Jenis Harga</b></td>
                  <td>
                    : <?= status_het($toko->jenis_toko) ?>
                  </td>
                </tr>
                 <tr>
                  <td><b>SSR</b></td>
                  <td>
                    : <?= $toko->ssr ?> x rata-rata penjualan 3 bulan terakhir.
                  </td>
                </tr>
                  <tr>
                  <td><b>Batas PO</b></td>
                  <td>
                    : <?= $toko->status_ssr == 1 ? '<span class = "badge badge-success"> Aktif </span>  <small> ( PO barang di batasi dengan SSR ) </small>' : '<span class = "badge badge-danger"> Tidak Aktif </span> <small> ( PO barang Tidak di batasi ) </samll>' ?>
                  </td>
                </tr>
                <tr>
                  <td><b>Di buat</b></td>
                  <td>
                    : <?= $toko->created_at ?>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <div class="card card-info">
          <div class="card-header">
            Pengguna Sistem
          </div>
          <div class="card-body">
            <table class="table table-sm">
              <tbody>
                <tr>
                  <td><b>Supervisor</b></td>
                  <td>
                    : <?= $spv->id_spv == "0" ? "Belum di kaitkan " : $spv->nama_user ?>
                  </td>
                </tr>
                <tr>
                  <td><b>Team Leader</b></td>
                  <td>
                    : <?= $leader_toko->id_leader == "0" ? "Belum di kaitkan " : $leader_toko->nama_user ?>
                  </td>
                </tr>
                <tr>
                  <td><b>Spg</b></td>
                  <td>
                    : <?= $spg->id_spg == "0" ? "Belum di kaitkan " : $spg->nama_user ?>
                  </td>
                </tr>

              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- Stok-->
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">
          <li class="fas fa-box"></li> Data Stok Artikel
        </h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <button type="button" class="btn btn-success btn-sm btn_tambah <?= ($cek_status->status == 2) ? 'd-none' : '' ?>" data-id_toko="<?= $toko->id ?>" data-toggle="modal" data-target="#modal-tambah-produk"><i class="fa fa-plus"></i> Tambah Produk</button>
        <div class="tab-content">
          <?php
          if ($cek_status->status == 2) { ?>
            <div class="overlay-wrapper">
              <div class="overlay">
                <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                <div class="text-bold pt-2">Menunggu Approve ...</div>
              </div>
            </div>
          <?php } ?>
          <hr>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr class="text-center">
                <th>Kode#</th>
                <th>Nama Artikel</th>
                <th>Satuan</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Max Stok</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php
                $no = 0;
                $total = 0;
                foreach ($stok_produk as $stok) {
                  $no++
                ?>

                  <td><?= $stok->kode ?></td>
                  <td><?= $stok->nama_produk ?></td>
                  <td class="text-center"><?= $stok->satuan ?></td>
                  <td class="text-center">
                    <?php
                    if ($stok->status == 2) {
                      echo "<span class='badge badge-warning' >belum di approve </span>";
                    } else {
                      echo $stok->qty;
                    }
                    ?>
                  </td>
                  <td class="text-right">
                    <?php
                    if ($stok->status == 2) {
                      echo "<span class='badge badge-warning' >belum di approve </span>";
                    } else {
                      if ($toko->het == 1) {
                        echo "Rp. ";
                        echo number_format($stok->harga_jawa);
                        echo " ,-";
                      } else {
                        echo "Rp. ";
                        echo number_format($stok->harga_indobarat);
                        echo " ,-";
                      }
                    }
                    ?>
                  </td>
                  <td class="text-center">
                    <?= $stok->ssr ?>
                  </td>
              </tr>
            <?php
                  $total += $stok->qty;
                } ?>

            </tbody>
            <tfoot>
              <tr>
                <td colspan="3" class="text-right"> <strong>Total :</strong> </td>
                <td class="text-center"><b><?php
                                            if ($cek_status_stok > 0) {
                                              echo "<span class='badge badge-warning' >belum di approve </span>";
                                            } else {
                                              echo $total;
                                            }
                                            ?></b></td>
                <td></td>
                <td></td>
              </tr>

            </tfoot>
          </table>
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <i class="fas fa-bullhorn"></i> Data ini merupakan jumlah stok yang dimiliki toko : <b><?= $toko->nama_toko ?></b> .
      </div>
    </div>
    <!-- end stok -->
        <!-- /.row -->
      </div><!-- /.container-fluid -->
</section>
    <!-- /.content -->
<!-- Modal Tambah Produk -->
<div class="modal fade" id="modal-tambah-produk" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-supervisor">Tambah Artikel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <form action="<?=base_url('mng_mkt/toko/tambah_artikel')?>" role="form" method="post">
        <div class="form-group">
          <label>Nama Artikel</label>
          <select name="id_produk" class="form-control select2bs4" required>
            <option value="">-- Pilih Artikel --</option>
            <?php foreach ($list_produk as $pr) { ?>
            <option value="<?= $pr->id ?>"><?= $pr->kode." | ".$pr->nama_produk ?></option>
            <?php } ?>
          </select>
        </div>
  
        <div class="form-group">
            <label>Harga</label>
            <p>
            * Artikel ini berlaku untuk harga : <strong> <?= status_het($toko->het) ?></strong>
            </p>
            <input class="form-control" type="hidden" name="id_toko" value="<?=$toko->id?>">
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Tambah Data</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end modal tambah produk -->
<!-- modal foto berkas -->
<div class="modal fade" id="lihat_foto">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title judul"> <li class="fas fa-box"></li> Berkas  : <a href="#" class="pic"></a></h4>
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
          <div class="row ">
             <img class="img-rounded image" id="image" style="width: 100%" src="" alt="User Image">
          </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
<!-- end modal -->
<!-- Modal Approve Toko -->
<div class="modal fade" id="approve" >
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Approve Toko : <strong><?=$toko->nama_toko?></strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <form action="<?=base_url('mng_mkt/toko/approve/'.$toko->id)?>" role="form" method="post">
        <div class="form-group">
          <label>Catatan :</label>
          <textarea class="form-control" name="catatan" id="catatan" cols="1" rows="3" required></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Approve Toko -->
<div class="modal fade" id="reject" >
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Tolak Toko : <strong><?=$toko->nama_toko?></strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <form action="<?=base_url('mng_mkt/toko/reject/'.$toko->id)?>" role="form" method="post">
        <div class="form-group">
          <label>Catatan :</label>
          <textarea class="form-control" name="catatan" id="catatan" cols="1" rows="3" required></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> Tolak</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/daterangepicker/daterangepicker.css">
<!-- end modal foto berkas -->
  <script>
    $(document).ready(function(){
      $('#table_stok').DataTable({
        order: [[3, 'Desc']],
          responsive: true,
          lengthChange: false,
          autoWidth: false,
      });
    })
  </script>
  <!-- fungsi approve -->
  <script>
   $(function() {
     $('#btn-approve').on('click', function() {
       $('#approve').modal('show');   
       });	
     $('#btn-reject').on('click', function() {
       $('#reject').modal('show');   
       });	
       //Date picker
    $('#reservationdate').datetimepicker({
        format: 'Y-M-D'
    });	
    // fungsi tombol foto
    $('.btn-foto').on('click', function() {
       $('.image').attr('src',$(this).attr('src'));
       $('.pic').html($(this).data('pic'));
       $('#lihat_foto').modal('show');   
       });	
   });
  </script>


