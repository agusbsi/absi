<link rel="stylesheet" href="<?= base_url('') ?>assets/plugins/bs-stepper/css/bs-stepper.min.css">
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <form  method="post">
          <div class="card card-success ">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-cube"></i> Adjust Stok Opname</b> </h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">No Pengajuan :</label>
                    <input type="text" name="no_audit" id="no_audit" value="<?= $kode_retur ?>" class="form-control form-control-sm" readonly>
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
                    <label for="">Tgl SO :</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                      </div>
                      <input type="text" name="tgl_tarik" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>" readonly>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">Petugas:</label>
                    <input type="text" value="<?= $this->session->userdata('nama_user'); ?>" class="form-control form-control-sm" readonly>
                  </div>
                </div>
              </div>
              <hr>
              <strong># List Artikel</strong>
              <hr>
              <table class="table table-bordered table-striped table responsive">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Artikel</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center" style="width:30%">QTY SO</th>
                  </tr>
                </thead>
                <tbody id="body_hasil">
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="2" class="text-right">
                      Total :
                    </td>
                    <td class="text-center">
                      <strong id="total_stok"></strong>
                    </td>
                    <td>
                      <strong id="total_input"></strong>
                    </td>
                  </tr>
                </tfoot>
              </table>
              <div class="form-group">
                <label for="">Catatan:</label><br />
                <textarea name="catatan" id="catatan" class="form-control" rows="5" cols="100%" required></textarea>
              </div>
              <span><i class="fas fa-info"></i></span> Data adjust Stok opname ini akan di kirimkan ke level Direksi. 
              <hr>
              <button type="submit" class="btn btn-success btn-sm float-right" id="btnSimpan"> <i class="fas fa-save"></i> Simpan</button>
              <a href="<?= base_url('audit/Toko/list_adjust') ?>" class="btn btn-danger btn-sm float-right mr-2"> <i class="fas fa-times-circle"></i> Cancel</a>

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
          url: "<?php echo base_url('audit/Toko/artikelToko'); ?>",
          type: "GET",
          dataType: "json",
          data: {
            id_toko: id_toko
          },
          success: function(data) {
            var html = '';
            var totalStok = 0;
            var totalInput = 0;

            $.each(data, function(i, item) {
              html += '<tr>';
              html += '<td class="text-center">' + (i + 1) + '</td>';
              html += '<td>' + item.kode + '</td>';
              html += '<td class="text-center">' + item.qty + '</td>';
              html += '<td><input type="hidden" class="id_produk" name="id_produk[]" value="' + item.id_produk + '"><input type="hidden" class="qty_sistem" name="qty_sistem[]" value="' + item.qty + '"><input type="number" class="form-control form-control-sm qty_retur" name="qty_input[]" value="0" required></td>';
              html += '</tr>';

              totalStok += parseInt(item.qty);
              totalInput += 0; // Menghitung total yang diinput
            });

            $("#body_hasil").html(html);

            // Menampilkan total stok dan total yang diinput
            $("#total_stok").text(totalStok);
            $("#total_input").text(totalInput);

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

    // Event untuk menghitung total yang diinput saat nilai input diubah
    $(document).on('change', '.qty_retur', function() {
      var totalInput = 0;
      $('.qty_retur').each(function() {
        totalInput += parseInt($(this).val());
      });
      $("#total_input").text(totalInput);
    });

    // ketika button simpan di click
    $("#btnSimpan").click(function(event) {
      event.preventDefault(); // Mencegah submit form secara langsung
      var id_toko = $("#id_toko").val();
      var catatan = $("#catatan").val();

      if (id_toko === "") {
        alert("Pilih toko dulu ya..");
      } else if (catatan === "") {
        alert("Catatan harus di isi..");
      } else {
        // Panggil fungsi untuk menampilkan konfirmasi
        tampilkanKonfirmasi(); // Replace this with your confirmation function or code
      }
    });
  });

  // Fungsi untuk menampilkan SweetAlert konfirmasi
  function tampilkanKonfirmasi() {
    Swal.fire({
      title: 'Konfirmasi Simpan',
      text: 'Anda yakin ingin menyimpan data?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Ya',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.isConfirmed) {
        // Jika pengguna memilih "Ya", lanjutkan proses simpan di sini
        // Extract data from the form
        var id_produkArray = [];
        var qty_sistemArray = [];
        var qty_inputArray = [];
        var id_toko = $("#id_toko").val();
        var catatan = $("#catatan").val();
        var no_audit = $("#no_audit").val();

        $(".id_produk").each(function() {
          id_produkArray.push($(this).val());
        });

        $(".qty_retur").each(function() {
          qty_inputArray.push($(this).val());
        });
        $(".qty_sistem").each(function() {
          qty_sistemArray.push($(this).val());
        });

        // Send data to the server using AJAX for database insertion
        $.ajax({
          url: "<?php echo base_url('audit/Toko/simpan_so_audit'); ?>", // Replace this with the actual URL for saving data
          type: "POST", // Adjust the HTTP method as per your backend
          dataType: "json",
          data: {
            id_produk: id_produkArray,
            qty_sistem: qty_sistemArray,
            qty_input: qty_inputArray,
            id_toko : id_toko,
            catatan : catatan,
            no_audit : no_audit,
          },
          success: function(response) {
            Swal.fire(
                  'Berhasil',
                  'Data Stok Opname Berhasil di simpan.',
                  'success'
                );
                // menuju ke halaman invoice
                window.location = "<?php echo base_url('audit/Toko/list_adjust') ?>";
          },
          error: function(xhr, status, error) {
            console.log(xhr.responseText); // Log any error response from the server
          },
        });
      } else {
        // Jika pengguna memilih "Batal", tidak ada tindakan tambahan yang perlu dilakukan
        console.log('Batal menyimpan data.');
      }
    });
  }

</script>