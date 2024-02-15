<section class="content">
  <div class="container-fluid">
    <?php
    if ($cek_status->status == 2) { ?>
      <div class="overlay-wrapper">
        <div class="overlay">
          <i class="fas fa-3x fa-sync-alt fa-spin"></i>
          <div class="text-bold pt-2">Data Toko Menunggu Approve Manager Marketing !</div>
        </div>
      </div>
    <?php } else if ($cek_status->status == 0) { ?>
      <div class="overlay-wrapper">
        <div class="overlay">
          <i class="fas fa-3x fa-sync-alt fa-spin"></i>
          <div class="text-bold pt-2">TOKO NON-AKTIF !</div>
        </div>
      </div>
    <?php } else if ($cek_status->status == 3) { ?>
      <div class="overlay-wrapper">
        <div class="overlay">
          <i class="fas fa-3x fa-sync-alt fa-spin"></i>
          <div class="text-bold pt-2">Data Toko Menunggu Approve Audit !</div>
        </div>
      </div>
    <?php } ?>
    <?php
    if ($cek_status->status == 4 || $cek_status->status == 5) { ?>
      <div class="callout callout-danger">
        <div class="row">
          <div class="col-md-6">
            <h5><i class="fas fa-info "></i> Status Toko : <span class="badge badge-danger"> Toko Belum Aktif </span></h5>
            Rekomendasi dari Audit : <span class="badge badge-<?= ($cek_status->status) == "4" ? 'success' : 'warning' ?> badge-sm">" <?= ($cek_status->status) == "4" ? 'DI SETUJUI' : 'DI TOLAK' ?> "</span> <br>
            Catatan :
            <div class="form-group">
              <textarea name="" class="form-control" id="" cols="1" rows="3" readonly><?= $toko->catatan_audit ?></textarea>
            </div>
          </div>
          <div class="col-md-6 text-right">
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <button id="btn-reject" class="btn btn-danger mr-3">
              <li class="fas fa-times-circle"></li> Tolak
            </button>
            <button id="btn-approve" class="btn btn-success mr-3">
              <li class="fas fa-check-circle"></li> Setujui
            </button>

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
                  <td><b>Jenis Harga</b></td>
                  <td>
                    : <?= status_het($toko->het) ?>
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
        <a href="<?= base_url('adm/Toko/templateStok/' . $toko->id) ?>" class="btn btn-warning btn-sm <?= ($cek_status->status == 2) ? 'd-none' : '' ?>"><i class="fa fa-download"></i> Unduh Template</a>
        <button type="button" class="btn btn-primary btn-sm btn_tambah <?= ($cek_status->status == 2) ? 'd-none' : '' ?>" data-id_toko="<?= $toko->id ?>" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-upload"></i> Import Stok</button>
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
                <th>Kode #</th>
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
  </div>
</section>
<div class="modal fade" id="modal-tambah-produk">
  <div class="modal-dialog">
    <form action="<?= base_url('adm/toko/tambah_produk') ?>" role="form" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-supervisor">Tambah Artikel</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label>Nama Artikel</label>
            <select name="id_produk" class="form-control select2bs4" required>
              <option value="">- Pilih Artikel -</option>
              <?php foreach ($list_produk as $pr) { ?>
                <option value="<?= $pr->id ?>"><?= $pr->kode . " | " . $pr->nama_produk ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label>Harga</label>
            <p>
              * Artikel ini berlaku untuk harga : <strong> <?= status_het($toko->het) ?></strong>
            </p>
            <input class="form-control" type="hidden" name="id_toko" value="<?= $toko->id ?>">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Tambah</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="lihat-foto">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title judul">
          <li class="fas fa-box"></li> Berkas : <a href="#" class="pic"></a>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h4 class="modal-title">
          <li class="fa fa-excel"></li> Import Excel
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- isi konten -->
        <form method="post" enctype="multipart/form-data" action="<?php echo base_url('adm/Toko/importStok'); ?>">
          <span class="badge badge-danger">Perhatian :</span> <br> - Fitur ini akan memperbarui stok pada toko <b><?= $toko->nama_toko ?>,</b>.
          <br>
          - Pastikan file excel diambil dari template toko <b><?= $toko->nama_toko ?>.</b>
          <br>
          - pastikan data di input dengan benar.</b>
          <hr>
          <div class="form-group">
            <label for="file">File Upload</label>
            <input type="file" name="file" class="form-control" id="exampleInputFile" accept=".xlsx,.xls" required>
          </div>
          <!-- end konten -->
      </div>
      <div class="modal-footer right">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
          <li class="fas fa-times-circle"></li> Cancel
        </button>
        <button type="submit" class="btn btn-sm btn-success">
          <li class="fas fa-save"></li> Import
        </button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
  $(function() {
    $('.btn-foto').on('click', function() {
      $('.image').attr('src', $(this).attr('src'));
      $('.pic').html($(this).data('pic'));
      $('#lihat-foto').modal('show');
    });
  });
</script>
<script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
<script>
  $(document).ready(function() {

    $('#table_stok').DataTable({
      order: [
        [3, 'Desc']
      ],
      responsive: true,
      lengthChange: false,
      autoWidth: false,
    });


  })
</script>
<script>
  $(function() {
    $('#btn-approve').on('click', function() {
      $('#modal-approve').modal('show');
    });
  });
</script>
<script>
  $('#btn-approve').click(function(e) {
    e.preventDefault();
    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Toko ini akan menjadi Aktif dan bisa melakukan transaksi",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Batal',
      confirmButtonText: 'Approve'
    }).then((result) => {
      if (result.isConfirmed) {
        location.href = "<?= base_url('adm/Toko/approve/' . $toko->id) ?>";
      }
    })
  })
</script>
<script>
  $('#btn-reject').click(function(e) {
    e.preventDefault();
    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Toko ini akan Dinonaktifkan",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Batal',
      confirmButtonText: 'Reject'
    }).then((result) => {
      if (result.isConfirmed) {
        location.href = "<?= base_url('adm/Toko/reject/' . $toko->id) ?>";
      }
    })
  })
</script>