<link rel="stylesheet" href="<?= base_url('') ?>assets/plugins/bs-stepper/css/bs-stepper.min.css">
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <form action="<?= base_url('spv/Toko/saveTutup'); ?>" method="post">
          <div class="card card-success ">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-file"></i> Form Tutup Toko</b> </h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">No Pengajuan :</label>
                    <input type="text" name="no_retur" value="<?= $kode_retur ?>" class="form-control form-control-sm" readonly>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">Nama Toko :</label>
                    <select name="id_toko" id="id_toko" required class="form-control form-control-sm select2">
                      <option value="">- Pilih Toko -</option>
                      <?php foreach ($list_toko as $dt) : ?>
                        <option value="<?= $dt->id ?>"><?= $dt->nama_toko ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">Tgl Penarikan :</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                      </div>
                      <input type="text" name="tgl_tarik" class="form-control form-control-sm" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" inputmode="numeric" autocomplete="off" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">Di ajukan Oleh:</label>
                    <input type="text" value="<?= $this->session->userdata('nama_user'); ?>" class="form-control form-control-sm" readonly>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12">
                  <div class="card card-default" id="list_tutup">
                    <div class="card-header">
                      <h3 class="card-title">Langkah-langkah Tutup Toko</h3>
                    </div>
                    <div class="card-body p-0">
                      <div class="bs-stepper linear">
                        <div class="bs-stepper-header" role="tablist">
                          <!-- your steps here -->
                          <div class="step active" data-target="#Penjualan-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="Penjualan-part" id="Penjualan-part-trigger" aria-selected="true">
                              <span class="bs-stepper-circle">1</span>
                              <span class="bs-stepper-label">Update Penjualan</span>
                            </button>
                          </div>
                          <div class="line"></div>
                          <div class="step" data-target="#Aset-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="Aset-part" id="Aset-part-trigger" aria-selected="false" disabled="disabled">
                              <span class="bs-stepper-circle">2</span>
                              <span class="bs-stepper-label">Update Aset</span>
                            </button>
                          </div>
                          <div class="line"></div>
                          <div class="step" data-target="#Stok-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="Stok-part" id="Stok-part-trigger" aria-selected="false" disabled="disabled">
                              <span class="bs-stepper-circle">3</span>
                              <span class="bs-stepper-label">List Artikel</span>
                            </button>
                          </div>
                        </div>
                        <div class="bs-stepper-content">
                          <!-- your steps content here -->
                          <div id="Penjualan-part" class="content active dstepper-block" role="tabpanel" aria-labelledby="Penjualan-part-trigger">

                            <div class="card-body">
                              <div class="form-group mb-0">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                                  <label class="custom-control-label" for="exampleCheck1"> Saya pastikan bahwa <a href="#"> SPG sudah Update Data penjualan hingga tgl <?= date('d-m-Y') ?> </a>.</label>
                                </div>
                              </div>
                            </div>

                            <button class="btn btn-primary btn-sm" id="btn_jual">Next</button>
                          </div>
                          <div id="Aset-part" class="content " role="tabpanel" aria-labelledby="Aset-part-trigger">
                            <table id="table_retur" class="table table-bordered table-striped">
                              <thead>
                                <tr class="text-center">
                                  <th style="width:5%">No</th>
                                  <th style="width:20%">Id Aset #</th>
                                  <th style="width:30%">Nama Aset</th>
                                  <th style="width:10%">Qty</th>
                                  <th>Kondisi</th>
                                  <th>Keterangan</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $no = 0;
                                foreach ($list_aset as $row) :
                                  $no++ ?>

                                  <tr>
                                    <td><?= $no ?></td>
                                    <td>
                                      <?= $row->id ?>
                                      <input type="hidden" name="id_aset[]" class="form-control" value="<?= $row->id ?>">
                                    </td>
                                    <td><?= $row->nama_aset ?></td>
                                    <td>
                                      <input type="number" name="qty_input[]" class="form-control" min='0' value="0">
                                    </td>
                                    <td>
                                      <select name="kondisi[]" class="form-control">
                                        <option value="Baik">Baik</option>
                                        <option value="Kurang Baik">Kurang Baik</option>
                                      </select>
                                    </td>
                                    <td>
                                      <textarea name="keterangan[]" class="form-control" cols="25" rows="1" placeholder="Catatan..."></textarea>
                                    </td>
                                  </tr>
                                <?php endforeach ?>
                              </tbody>
                            </table>
                            <span>Noted :</span> Jika di toko tersebut tidak memiliki aset, silahkan isi kolom QTY dengan nilai = 0 (NOL).
                            <hr>
                            <button class="btn btn-danger btn-sm" onclick="stepper.previous()">Previous</button>
                            <button class="btn btn-primary btn-sm" onclick="stepper.next()">Next</button>
                          </div>
                          <div id="Stok-part" class="content" role="tabpanel" aria-labelledby="Stok-part-trigger">
                            <table class="table table-bordered table-striped ">
                              <thead>
                                <tr>
                                  <th class="text-center">No</th>
                                  <th class="text-center">Kode Artikel</th>
                                  <th class="text-center">Deskripsi</th>
                                  <th class="text-center">Stok Sistem</th>
                                  <th class="text-center">QTY Retur</th>
                                </tr>
                              </thead>
                              <tbody id="body_hasil">
                              </tbody>
                            </table>
                            <div class="form-group">
                              <label for="">Catatan:</label><br />
                              <textarea name="catatan" class="form-control" rows="5" cols="100%" required></textarea>
                            </div>
                            <button class="btn btn-danger btn-sm" onclick="stepper.previous()">Previous</button>
                            <button type="submit" class="btn btn-primary btn-sm">Kirim</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    </div>
                  </div>
                  <!-- /.card -->
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<script src="<?= base_url('') ?>assets/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<script src="<?= base_url('') ?>assets/plugins/inputmask/jquery.inputmask.min.js"></script>
<script>
  $(document).ready(function() {
    $("#id_toko").change(function() {
      var id_toko = $(this).val();
      if (id_toko === "") {
        $("#body_hasil").html('');
      } else {
        $.ajax({
          url: "<?php echo base_url('spv/Toko/artikelToko'); ?>",
          type: "GET",
          dataType: "json",
          data: {
            id_toko: id_toko
          },
          success: function(data) {
            var html = '';
            $.each(data, function(i, item) {
              html += '<tr>';
              html += '<td class="text-center">' + (i + 1) + '</td>';
              html += '<td>' + item.kode + '</td>';
              html += '<td>' + item.nama_produk + '</td>';
              html += '<td class="text-center">' + item.qty + '</td>';
              html += '<td><input type="hidden" class="id_produk" name="id_produk[]" value="' + item.id_produk + '"><input type="number" class="form-control form-control-sm" name="qty_retur[]" value="' + item.qty + '" required></td>';

              html += '</tr>';
            });
            $("#body_hasil").html(html);
            if (data.length === 0) {
              Swal.fire(
                'TIDAK ADA ARTIKEL',
                'Data tidak ditemukan',
                'info'
              );
            }
          },
          error: function(xhr, status, error) {
            console.log(xhr.responseText);
          }
        });
      }
    });
  });

  //Datemask dd/mm/yyyy
  $('#datemask').inputmask('yyyy-mm-dd', {
    'placeholder': 'yyyy-mm-dd'
  });
  $('[data-mask]').inputmask();
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function() {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'));
  });

  document.getElementById("btn_jual").addEventListener("click", function() {
    var checkbox = document.getElementById("exampleCheck1");
    if (!checkbox.checked) {
      alert("Anda harus menyetujui persyaratan layanan.");
      return;
    }

    // Lanjut ke langkah berikutnya
    stepper.next();
  });
</script>