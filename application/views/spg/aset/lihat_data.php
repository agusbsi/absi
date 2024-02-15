<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <?php if (($toko->status_aset) == 1) { ?>
          <!-- jika toko belum so -->
          <!-- eror page -->
          <div class="error-page">
            <h2 class="headline text-success"> <i class="fas fa-check-circle"></i></h2>

            <div class="error-content">
              <h3><i class="fas fa-file-alt text-success"></i> UPDATE ASET BERHASIL !</h3>

              <p>
                Terimakasih, Anda telah melakukan Update Aset Toko di bulan ini ! Data akan di proses oleh Admin Support Hicoop.
              </p>

              <form class="search-form">
                <div class="input-group text-center">
                  <a href="<?php echo base_url('spg/Stok_opname') ?>" class="btn btn-success"> Lanjut Stok Opname</a>
                </div>
                <!-- /.input-group -->
              </form>
            </div>
            <!-- /.error-content -->
          </div>
          <!-- end eror page -->
          <!-- end toko so -->

        <?php } else { ?>
          <div class="callout callout-info">
            <h5><i class="fas fa-info"></i> Note :</h5>
            Jika aset tidak tersedia di toko, silahkan isi Jumlah dengan nilai = 0 (NOL).
          </div>
          <form action="<?= base_url('spg/Aset/simpan'); ?>" method="post" id="form_aset" enctype="multipart/form-data">
            <?php
            $no = 0;
            foreach ($list_aset as $row) :
              $no++ ?>
              <div class="card card-info card-outline ">
                <div class="card-header">
                  <h6 class="card-title"><?= $no ?>). <?= $row->nama_aset ?></h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group mb-0">
                        <label style="font-size: small; margin-bottom:0px;">Jumlah :</label>
                        <input type="hidden" name="id_aset[]" class="form-control" value="<?= $row->id ?>">
                        <input type="number" name="qty_input[]" class="form-control form-control-sm" min='0' value="0">
                      </div>

                    </div>
                    <div class="col-6">
                      <div class="form-group mb-0">
                        <label style="font-size: small; margin-bottom:0px;">Kondisi :</label>
                        <select name="kondisi[]" class="form-control form-control-sm">
                          <option value="Baik">Baik</option>
                          <option value="Kurang Baik">Kurang Baik</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group mb-0">
                    <label style="font-size: small; margin-bottom:0px;">Foto Aset :</label>
                    <input type="file" name="foto_aset[]" class="form-control form-control-sm" id="foto_aset" accept="image/png, image/jpeg, image/jpg">
                    <small class="text-secondary">* Foto aset terbaru</small>
                  </div>
                  <div class="form-group mb-0">
                    <label style="font-size: small; margin-bottom:0px;">Keterangan :</label>
                    <textarea name="keterangan[]" class="form-control form-control-sm" rows="1" placeholder="Keterangan..."></textarea>
                  </div>
                </div>
              </div>
            <?php endforeach ?>
            <hr>
            <button type="submit" name="btn-simpan" class="btn btn-sm btn-success mb-2 float-right" id="btn_aset"> <i class="fas fa-save"></i> Update Aset</button>
            <a href="<?= base_url('spg/Dashboard') ?>" class="btn btn-sm btn-danger mb-2 float-right mr-2"> <i class="fas fa-times"></i> Cancel</a>

          </form>
      </div>
    <?php } ?>
    </div>
  </div>
  </div>
</section>
<script>
  $('#btn_aset').click(function(e) {
    e.preventDefault();
    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Data aset Toko akan di update !",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Batal',
      confirmButtonText: 'Yakin'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById("form_aset").submit();

      }
    })
  })
  $(document).ready(function() {

    $('#table_retur').DataTable({
      order: [
        [0, 'asc']
      ],
      responsive: true,
      lengthChange: false,
      autoWidth: false,
    });


  })
</script>