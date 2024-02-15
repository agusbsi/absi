<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-info ">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-store"></i> Data Invoice</b> </h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-10">
                <p class="badge badge-danger badge-sm">merah</p> : Jatuh tempo terlewat
                <p class="badge badge-warning badge-sm">kuning</p> : Jatuh tempo H-7 hari
                <p class="badge badge-success badge-sm">Hijau</p> : Lunas
              </div>
              <div class="col-md-2 text-right">
                <button class="btn btn-success btn-sm" data-toggle="modal" data-target=".buat_invoice"><i class="fas fa-plus-circle"></i> Buat Invoice</button>
              </div>
            </div>
            <hr>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr class="text-center">
                  <th style="width:3%">No</th>
                  <th style="width:14%">No Invoice</th>
                  <th style="width:27%">Customer</th>
                  <th style="width:3%">QTY</th>
                  <th style="width:12%">Total</th>
                  <th style="width:12%">Jth Tempo</th>
                  <th style="width:10%">Status</th>
                  <th style="width:10%">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 0;
                foreach ($invoice as $t) :
                  $no++
                ?>
                  <tr>
                    <td class="text-center"><?= $no ?></td>
                    <td><?= $t->id ?></td>
                    <td>
                      <strong>
                        <?php
                        if ($t->id_cust != 0) {
                          $customer = $t->customer;
                          if (strlen($customer) > 20) {
                            $customer = substr($customer, 0, 20) . '...';
                          }
                          echo $customer;
                        } else {
                          $cust_toko = $t->cust_toko;
                          if (strlen($cust_toko) > 20) {
                            $cust_toko = substr($cust_toko, 0, 20) . '...';
                          }
                          echo $cust_toko;
                        }
                        ?>
                      </strong>
                      <p class="text-muted mb-0">
                        Toko :
                        <?php
                        if ($t->id_toko != 0) {
                          $namatoko = $t->toko;
                          if (strlen($namatoko) > 20) {
                            $namatoko = substr($toko, 0, 20) . '...';
                          }
                          echo $namatoko;
                        } else {
                          echo "SEMUA TOKO";
                        }
                        ?></p>
                    </td>
                    <td class="text-center"><?= $t->total_qty ?></td>
                    <td class="text-right">Rp <?= number_format($t->total) ?></td>
                    <?php
                    // Ubah format tanggal menjadi 'Y-m-d' agar dapat dibandingkan dengan strtotime()
                    $tanggal_formatted = date('Y-m-d', strtotime(str_replace('-', '/', $t->jth_tempo)));

                    // Perbandingan tanggal dengan tanggal saat ini
                    if (strtotime($tanggal_formatted) < strtotime('today')) {
                      $warna = 'danger'; // Jika tanggal sudah terlewat, warna merah
                    } else if (strtotime($tanggal_formatted) < strtotime('-7 days')) {
                      $warna = 'warning'; // Jika tanggal terlewati 7 hari, warna kuning
                    } else {
                      $warna = ''; // Tidak ada warna tambahan
                    }
                    ?>
                    <td class="text-center">
                      <?php if ($t->status == 3) { ?>
                        <span class="badge text-success badge-sm"><?= date('j F Y', strtotime($t->jth_tempo)); ?></span>
                      <?php } else { ?>
                        <span class="badge badge-<?= $warna ?> badge-sm"><?= date('j F Y', strtotime($t->jth_tempo)); ?></span>
                      <?php } ?>
                    </td>
                    <td class="text-center"><?= ($t->status == 3) ? '<span class="badge badge-success badge-sm">LUNAS</span>' : '<span class="badge badge-danger badge-sm">BELUM LUNAS</span>' ?></td>

                    <td class="text-center">
                      <a href="<?= base_url('finance/Invoice/invoice/' . $t->id) ?>" class="btn btn-info btn-sm " title="Detail"><i class="fa fa-eye"></i> </a>
                      <a href="#" onClick="getlunas('<?= $t->id; ?>')" class="btn btn-success btn-sm <?= ($t->status == 3) ? 'd-none' : '' ?>" data-toggle="modal" data-target="#lunas" title="Lunas">
                        <i class="fas fa-check"> </i>
                      </a>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer text-center ">

          </div>
        </div>
      </div>

    </div>
  </div>
  </div>
</section>
<!-- modal buat invoice -->
<div class="modal fade buat_invoice" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5><i class="fas fa-plus-circle"></i> Buat Invoice Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <label for="">No Invoice</label>
              <input type="text" name="no_invoice" id="no_invoice" value="<?= $no_invoice; ?>" class="form-control form-control-sm" readonly>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="">Berdasarkan</label>
              <select name="pilihan" id="parameter" class="form-control form-control-sm" required>
                <option value="">- Pilih Parameter -</option>
                <option value="customer"> Customer </option>
                <option value="toko"> Toko </option>
              </select>
            </div>
          </div>
          <div id="group_big" class="col-md-3 d-none">
            <div class="form-group d-none" id="group_cust">
              <label for="">Nama Customer</label>
              <select name="id_cust" id="id_cust" class="form-control form-control-sm" required>
                <option value="">- Pilih Customer -</option>
                <?php
                foreach ($cust as $t) :
                ?>
                  <option value="<?= $t->id ?>"><?= $t->nama_cust ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group d-none" id="group_toko">
              <label for="">Nama Toko</label>
              <select name="id_toko" id="id_toko" class="form-control form-control-sm" required>
                <option value="">- Pilih Toko -</option>
                <?php
                foreach ($list_toko as $tk) :
                ?>
                  <option value="<?= $tk->id ?>"><?= $tk->nama_toko ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="">Range Tanggal Penjualan</label>
              <input type="text" name="tanggal" id="tanggal" class="form-control form-control-sm" autocomplete="off" required>
            </div>
          </div>
          <div class="col-md-2">
            <br>
            <button class="btn btn-info btn-sm mt-2 " id="btn_cari"><i class="fas fa-search"></i> Cari Data</button>
          </div>
        </div>
        <hr>
        <table class="table table-bordered table-striped ">
          <thead>
            <tr>
              <th class="text-center"><input type="checkbox" id="checkAll"></th>
              <th class="text-center">Tanggal</th>
              <th class="text-center">No Penjualan</th>
              <th class="text-center">Artikel #</th>
              <th class="text-center">Qty</th>
              <th class="text-right">Harga</th>
              <th class="text-right">Margin Toko</th>
              <th class="text-right">Sub Total</th>
            </tr>
          </thead>
          <tbody id="body_hasil">
          </tbody>
        </table>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Catatan :</label>
              <textarea name="catatan" id="catatan" class="form-control" cols="3" rows="3" placeholder="Catatan jika ada...."></textarea>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Jatuh Tempo:</label>
              <input type="text" name="jth_tempo" id="jth_tempo" class="form-control" readonly>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-time-circle"></i> Close</button>
        <button type="button" id="btn_simpan" class="btn btn-success btn-sm"> <i class="fas fa-save"></i> Simpan </button>
      </div>
    </div>
  </div>
</div>
<!-- end modal -->
<!-- modal lunas -->

<!-- Modal -->
<div class="modal fade" id="lunas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="<?= base_url('finance/Invoice/bayar') ?>" method="post">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="exampleModalLabel">Pelunasan Tagihan <span id="judul"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Bayar</label>
                <input type="text" class="form-control" value="LUNAS" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">No Invoice</label>
                <input type="text" class="form-control" name="invoice" id="invoice" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="">No Voucher</label> <span>( dari Easy Accounting )</span>
            <input type="text" name="faktur" class="form-control" placeholder="Cnth : xxx/xxx/xx" required>
          </div>
          <div class="form-group">
            <label for="">Catatan :</label>
            <textarea name="catatan" cols="3" rows="3" class="form-control" placeholder="Masukan Catatan..."></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('input[name="tanggal"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
        cancelLabel: 'Clear'
      }
    });

    $('input[name="tanggal"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
    });

    $('input[name="tanggal"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
    });

    $("#btn_cari").click(function() {
      var parameter = $("#parameter").val();
      var id_cust = $("#id_cust").val();
      var id_toko = $("#id_toko").val();
      var tgl = $("#tanggal").val();
      var tglArray = tgl.split(" - ");
      var tgl_awal = tglArray[0];
      var tgl_akhir = tglArray[1];

      if (parameter == "") {
        Swal.fire(
          'oops',
          'Silahkan pilih pencarian berdasarkan Customer / toko .',
          'info'
        );
      } else if (parameter == "customer") {
        if (tgl == "" || id_cust == "") {
          Swal.fire(
            'oops',
            'Silahkan pilih Customer  & range tanggal penjualan !',
            'info'
          );
        } else {
          $.ajax({
            url: "<?php echo base_url('finance/Invoice/list_jual_cust'); ?>",
            type: "GET",
            dataType: "json",
            data: {
              id_cust: id_cust,
              tgl: tgl,
              tgl_awal: tgl_awal,
              tgl_akhir: tgl_akhir
            },
            success: function(data) {
              var html = '';
              var jth_tempo = '';
              var totalQty = 0;
              var totalMargin = 0;
              var totalSubTotal = 0;
              $.each(data, function(i, item) {
                html += '<tr>';
                html += '<td class="text-center"><input type="checkbox" class="checkItem"></td>';
                html += '<td>' + item.tanggal_penjualan + '</td>';
                html += '<td>' + item.id_penjualan + '</td>';
                html += '<td>' + item.kode + '</td>';
                html += '<td class="qty text-center">' + item.qty + '</td>';
                html += '<td class="harga text-right">' + formatRupiah(item.harga) + '</td>';
                html += '<td class="margin text-right">' + formatRupiah(parseInt(item.margin)) + '</td>';
                html += '<td class="sub_total text-right">' + formatRupiah(parseInt(item.sub_total)) + '</td>';
                html += '<td><input type="hidden" class="id_produk" name="id_produk[]" value="' + item.id_produk + '"><input type="hidden" class="id_detail" name="id_detail[]" value="' + item.id_detail + '"></td>';

                html += '</tr>';
                totalQty += parseInt(item.qty);
                totalMargin += parseInt(item.margin);
                totalSubTotal += parseInt(item.sub_total);
                jth_tempo = item.tgl_tempo;
              });
              html += '<tr>';
              html += '<td colspan="4" class="text-right">Total :</td>';
              html += '<td class="text-center totalQty">' + totalQty + '</td>';
              html += '<td class="text-center "></td>';
              html += '<td class="text-right totalMargin">' + formatRupiah(totalMargin) + '</td>';
              html += '<td class="text-right totalSubTotal">' + formatRupiah(totalSubTotal) + '</td>';
              html += '</tr>';
              $("#body_hasil").html(html);
              $("#jth_tempo").val(jth_tempo);


              if (data.length === 0) {
                Swal.fire(
                  'TIDAK ADA TRANSAKSI',
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

      } else {
        if (tgl == "" || id_toko == "") {
          Swal.fire(
            'oops',
            'Silahkan pilih Customer  & range tanggal penjualan !',
            'info'
          );
        } else {
          $.ajax({
            url: "<?php echo base_url('finance/Invoice/list_jual'); ?>",
            type: "GET",
            dataType: "json",
            data: {
              id_toko: id_toko,
              tgl: tgl,
              tgl_awal: tgl_awal,
              tgl_akhir: tgl_akhir
            },
            success: function(data) {
              var html = '';
              var jth_tempo = '';
              var totalQty = 0;
              var totalMargin = 0;
              var totalSubTotal = 0;
              $.each(data, function(i, item) {
                html += '<tr>';
                html += '<td class="text-center"><input type="checkbox" class="checkItem"></td>';
                html += '<td>' + item.tanggal_penjualan + '</td>';
                html += '<td>' + item.id_penjualan + '</td>';
                html += '<td>' + item.kode + '</td>';
                html += '<td class="qty text-center">' + item.qty + '</td>';
                html += '<td class="harga text-right">' + formatRupiah(item.harga) + '</td>';
                html += '<td class="margin text-right">' + formatRupiah(parseInt(item.margin)) + '</td>';
                html += '<td class="sub_total text-right">' + formatRupiah(parseInt(item.sub_total)) + '</td>';
                html += '<td><input type="hidden" class="id_produk" name="id_produk[]" value="' + item.id_produk + '"><input type="hidden" class="id_detail" name="id_detail[]" value="' + item.id_detail + '"></td>';

                html += '</tr>';
                totalQty += parseInt(item.qty);
                totalMargin += parseInt(item.margin);
                totalSubTotal += parseInt(item.sub_total);
                jth_tempo = item.tgl_tempo;
              });
              html += '<tr>';
              html += '<td colspan="4" class="text-right">Total :</td>';
              html += '<td class="text-center totalQty">' + totalQty + '</td>';
              html += '<td class="text-center "></td>';
              html += '<td class="text-right totalMargin">' + formatRupiah(totalMargin) + '</td>';
              html += '<td class="text-right totalSubTotal">' + formatRupiah(totalSubTotal) + '</td>';
              html += '</tr>';
              $("#body_hasil").html(html);
              $("#jth_tempo").val(jth_tempo);

              if (data.length === 0) {
                Swal.fire(
                  'TIDAK ADA TRANSAKSI',
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

      }
    });
    // Fungsi untuk mengubah angka menjadi format rupiah
    function formatRupiah(angka) {
      var numberString = angka.toString();
      var split = numberString.split(',');
      var sisa = split[0].length % 3;
      var rupiah = split[0].substr(0, sisa);
      var ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return 'Rp ' + rupiah;
    }
    // Menghitung subtotal saat checkbox item dicentang atau dicentang ulang
    function calculateSubtotal() {
      var totalQty = 0;
      var totalMargin = 0;
      var totalSubTotal = 0;

      // Iterasi melalui semua checkbox item yang dicentang
      $(".checkItem:checked").each(function() {
        var row = $(this).closest("tr");
        var qty = parseInt(row.find(".qty").text());
        var harga = parseInt(row.find(".harga").text().replace(/\D/g, '')); // Menghilangkan karakter non-digit
        var margin = parseInt(row.find(".margin").text().replace(/\D/g, '')); // Menghilangkan karakter non-digit

        // Hitung subtotal untuk item yang dicentang
        var subTotal = qty * (harga - margin);

        // Perbarui subtotal pada tampilan HTML
        row.find(".sub_total").text(formatRupiah(subTotal));

        totalQty += qty;
        totalMargin += margin;
        totalSubTotal += subTotal;
      });

      $(".totalQty").text(totalQty);
      $(".totalMargin").text(formatRupiah(totalMargin));
      $(".totalSubTotal").text(formatRupiah(totalSubTotal));
    }
    // Centang semua item ketika checkbox di header di klik
    $("#checkAll").click(function() {
      $(".checkItem").prop("checked", $(this).prop("checked"));
      calculateSubtotal();
    });
    // Menghitung subtotal saat checkbox item dicentang atau dicentang ulang
    $(document).on('change', '.checkItem', function() {
      calculateSubtotal();
    });

    // proses simpan
    $("#btn_simpan").click(function() {
      var parameter = $("#parameter").val();
      var id_cust = $("#id_cust").val();
      var no_invoice = $("#no_invoice").val();
      var jth_tempo = $("#jth_tempo").val();
      var id_toko = $("#id_toko").val();
      var tgl = $("#tanggal").val();
      var catatan = $("#catatan").val();

      if (parameter == "") {
        Swal.fire(
          'oops',
          'Silahkan pilih pencarian berdasarkan Customer / toko .',
          'info'
        );
      } else if (parameter == "customer") {
        if (tgl == "" || id_cust == "") {
          Swal.fire(
            'oops',
            'Customer & range tanggal tidak boleh kosong!',
            'info'
          );
        } else {
          var selectedItems = []; // Array untuk menyimpan data barang yang dicentang
          var totalQty = 0;
          var totalSubTotal = 0;
          var totalMargin = 0;
          $(".checkItem:checked").each(function() {
            var row = $(this).closest("tr");
            var item = {
              id_penjualan: row.find("td:eq(2)").text(),
              id_produk: parseInt(row.find(".id_produk").val()),
              id_detail: parseInt(row.find(".id_detail").val()),
              qty: parseInt(row.find(".qty").text()),
              harga: parseInt(row.find(".harga").text().replace(/\D/g, '')), // Menghilangkan karakter non-digit
              margin: parseInt(row.find(".margin").text().replace(/\D/g, '')), // Menghilangkan karakter non-digit
              sub_total: parseInt(row.find(".sub_total").text().replace(/\D/g, '')) // Menghilangkan karakter non-digit
            };
            selectedItems.push(item);
            totalQty += item.qty;
            totalMargin += item.margin;
            totalSubTotal += item.sub_total;
          });

          if (selectedItems.length === 0) {
            Swal.fire(
              'Tidak ada barang yang dipilih',
              'Harap pilih setidaknya satu barang untuk disimpan.',
              'info'
            );
          } else {
            $.ajax({
              url: "<?php echo base_url('finance/Invoice/simpan_invoice_cust'); ?>",
              type: "POST",
              dataType: "json",
              data: {
                no_invoice: no_invoice,
                id_cust: id_cust,
                items: selectedItems,
                totalQty: totalQty,
                totalMargin: totalMargin,
                totalSubTotal: totalSubTotal,
                catatan: catatan,
                tgl: tgl,
                jth_tempo: jth_tempo,
              },
              success: function(data) {
                Swal.fire(
                  'Berhasil',
                  'Data barang berhasil disimpan ke dalam tabel invoice.',
                  'success'
                );
                // menuju ke halaman invoice
                window.location = "<?php echo base_url('finance/Invoice') ?>";
              },
              error: function(xhr, status, error) {
                console.log(xhr.responseText);
              }
            });
          }
        }
      } else if (parameter == "toko") {
        if (tgl == "" || id_toko == "") {
          Swal.fire(
            'oops',
            'Toko & range tanggal tidak boleh kosong!',
            'info'
          );
        } else {
          var selectedItems = []; // Array untuk menyimpan data barang yang dicentang
          var totalQty = 0;
          var totalSubTotal = 0;
          var totalMargin = 0;
          $(".checkItem:checked").each(function() {
            var row = $(this).closest("tr");
            var item = {
              id_penjualan: row.find("td:eq(2)").text(),
              id_produk: parseInt(row.find(".id_produk").val()),
              id_detail: parseInt(row.find(".id_detail").val()),
              qty: parseInt(row.find(".qty").text()),
              harga: parseInt(row.find(".harga").text().replace(/\D/g, '')), // Menghilangkan karakter non-digit
              margin: parseInt(row.find(".margin").text().replace(/\D/g, '')), // Menghilangkan karakter non-digit
              sub_total: parseInt(row.find(".sub_total").text().replace(/\D/g, '')) // Menghilangkan karakter non-digit
            };
            selectedItems.push(item);
            totalQty += item.qty;
            totalMargin += item.margin;
            totalSubTotal += item.sub_total;
          });

          if (selectedItems.length === 0) {
            Swal.fire(
              'Tidak ada barang yang dipilih',
              'Harap pilih setidaknya satu barang untuk disimpan.',
              'info'
            );
          } else {
            $.ajax({
              url: "<?php echo base_url('finance/Invoice/simpan_invoice'); ?>",
              type: "POST",
              dataType: "json",
              data: {
                no_invoice: no_invoice,
                id_toko: id_toko,
                items: selectedItems,
                totalQty: totalQty,
                totalMargin: totalMargin,
                totalSubTotal: totalSubTotal,
                catatan: catatan,
                tgl: tgl,
                jth_tempo: jth_tempo,
              },
              success: function(data) {
                Swal.fire(
                  'Berhasil',
                  'Data barang berhasil disimpan ke dalam tabel invoice.',
                  'success'
                );
                // menuju ke halaman invoice
                window.location = "<?php echo base_url('finance/Invoice') ?>";
              },
              error: function(xhr, status, error) {
                console.log(xhr.responseText);
              }
            });
          }
        }
      }

    });
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('yyyy-mm-dd', {
      'placeholder': 'yyyy-mm-dd'
    });
    $('[data-mask]').inputmask('yyyy-mm-dd');
    // ketika parameter di pilih
    $("#parameter").change(function() {
      var param = $(this).val();
      if (param === 'customer') {
        // hapus class d-none di id group_toko
        $("#group_big").removeClass('d-none');
        $("#group_cust").removeClass('d-none');
        $("#group_toko").addClass('d-none');
        $("#body_hasil").html('');
        $("#jth_tempo").val('');
      } else if (param === 'toko') {
        $("#group_big").removeClass('d-none');
        $("#group_toko").removeClass('d-none');
        $("#group_cust").addClass('d-none');
        $("#body_hasil").html('');
        $("#jth_tempo").val('');
      } else {
        $("#group_big").addClass('d-none');
        $("#group_toko").addClass('d-none');
        $("#group_cust").addClass('d-none');
        $("#body_hasil").html('');
        $("#jth_tempo").val('');
      }
    });
    // ketika customer di ganti
    $("#id_cust").change(function() {
      $("#body_hasil").html('');
      $("#jth_tempo").val('');
    });
    // ketika customer di ganti
    $("#id_toko").change(function() {
      $("#body_hasil").html('');
      $("#jth_tempo").val('');
    });

  });

  function getlunas(id) {
    $("#invoice").val(id);
  }
</script>