<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- isi konten -->
        <form>
        <?php
          foreach ($terima as $t) :
        ?>
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"> <li class="fas fa-check-circle"></li> <strong>Detail Terima Barang </strong></h3>
            <input type="hidden" name="id_terima" value="<?= $t->id ?>">
            <div class="card-tools">
              <a href="<?= base_url('spg/Penerimaan') ?>" type="button" class="btn btn-tool" >
                <i class="fas fa-times"></i>
              </a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                
                <table>
                  <tr>
                    <th># Terima dari :</th>
                  </tr>
                  <tr>
                    <td>Gudang</td>
                    <td>: Gudang Utama PT.Vista Mandiri Gemilang
                    </td>
                  </tr>
                  <tr>
                    <th># Untuk :</th>
                  </tr>
                  <tr>
                    <td>Toko</td>
                    <td>: <?= $t->nama_toko ?>
                    <input type="hidden" name="id_toko" value="<?= $t->id_toko ?>">
                    </td>
                  </tr>
                  <tr>
                    <td>Alamat</td>
                    <td>: <?= $t->alamat ?></td>
                  </tr>
                  <tr>
                    <td>No Telp</td>
                    <td>: <?= $t->telp ?></td>
                  </tr>
                </table>
               
              </div>
              <div class="col-md-6">
                <table>
                  <tr>
                    <th> ID Kirim</th>
                    <th>: <?= $t->id ?>
                    <input type="hidden" name="id_permintaan" value="<?= $t->id_permintaan ?>">
                    </th>
                  </tr>
                  <tr>
                    <td>Tgl Terima</td>
                    <td>: <?= date('Y-m-d h:i:s') ?></td>
                  </tr>
                 
                  <tr>
                    <td>Keterangan</td>
                    <td>: <?= $t->keterangan ?>
                    <input type="hidden" name="keterangan" value="<?= $t->keterangan ?>">
                    </td>
                  </tr>
                </table>
              </div>
            </div>
            <hr>
            <?php if ($t->status == 1) { ?>
            <i class="fas fa-info"></i> <span class="badge badge-danger">Reminder :</span>  Pastikan anda menginput jumlah masing-masing artikel dengan benar (sesuai barang yang diterima), Anda hanya bisa menginput sebanyak 3 kali percobaan !
            <?php }else{ ?>
            <i class="fas fa-info"></i> <span class="badge badge-danger">Info ! :</span>  Jika ada artikel yang tidak sesuai dengan jumlah pengiriman! Harap Hubungi Tim Leader anda!</a>  
            <?php } ?>
            <hr>
              <!-- isi detail list -->
              <table  class="table table-bordered table-striped table responsive">
                <thead>
                  <tr>
                    <th style="width: 10%;">No #</th>
                    <th style="width: 20%;">ID Artikel #</th>
                    <th style="width: 45%;">Nama Artikel #</th>
                    <th>Satuan</th>
                    <th >Qty diterima</th>
                  </tr>
                </thead>
                <?php 
                $no=0;
                foreach ($detail_terima as $d) 
                { $no++ ?>
                <?php if ($t->status == 1) { ?>
                  <tr class="baris">
                    <td class="text-center"><?= $no ?></td>
                    <td ><?= $d->kode ?>
                    <input type="hidden" name="id_produk[]" value="<?= $d->id_produk ?>">
                    <input type="hidden" name="id_detail[]" value="<?= $d->id ?>">
                    </td>
                    <td><?= $d->nama_produk ?></td>
                    <td class="text-center"><?= $d->satuan ?></td>
                    <td class="text-center">
                    <input type="number" class="form-control qty_input" data-qty="<?= $d->qty ?>" name="qty_terima[]" value="0"  min="0" >
                    <input type="hidden" name="qty[]" class="form-control" value="<?= $d->qty ?>">
                    </td>
                  </tr>
                <?php }else{ ?>
                  <tr>
                    <td class="<?= ($d->qty != $d->qty_diterima) ? 'bg-danger' : '' ?> text-center"><?= $no ?></td>
                    <td class="<?= ($d->qty != $d->qty_diterima) ? 'bg-danger' : '' ?> "><?= $d->kode ?>
                    <input type="hidden" name="id_produk[]" value="<?= $d->id_produk ?>">
                    <input type="hidden" name="id_detail[]" value="<?= $d->id ?>">
                    </td>
                    <td class="<?= ($d->qty != $d->qty_diterima) ? 'bg-danger' : '' ?> "><?= $d->nama_produk ?></td>
                    <td class="<?= ($d->qty != $d->qty_diterima) ? 'bg-danger' : '' ?> text-center"><?= $d->satuan ?></td>
                    <td class="<?= ($d->qty != $d->qty_diterima) ? 'bg-danger' : '' ?> text-center">
                      <?php if ($t->status == 1) { ?>
                      <input type="number" class="form-control " name="qty_terima[]"   value="0"  min="0" >
                    <?php }else{ ?>
                      <?= $d->qty_diterima ?>
                    <?php } ?>
                      <input type="hidden" name="qty[]" class="form-control" value="<?= $d->qty ?>">
                    </td>
                  </tr>
                <?php } ?>
                 
                  <?php } ?>
              </table>
              <!-- end detail -->
            <hr>
            <br>
          
            <?php if ($t->status == 1) { ?>
              Catatan : 
              <textarea name="catatan_spg" class="form-control w-50" id="" cols="20" rows="3"  placeholder =" Opsional - Jika ada Catatan"></textarea>
              <a id="btn_terima" type="button" class='btn btn-success float-right'><i class='fa fa-save' aria-hidden='true'></i> Terima Barang</a>
            <?php }elseif($t->status == 3){ ?>
            <span class="btn btn-danger"></span> : <small>Jumlah artikel yang di input tidak sesuai dengan Sistem.</small> <br>
            <small> <span class="btn btn-warning">Segera Buat BAP dan laporkan dengan jelas. !</span></small>
            <div class="row float-right mt-3">
              <a href="#" class="btn btn-warning btn-sm mr-3" data-toggle="modal" data-target=".bap"><i class="fas fa-file"></i> Buat BAP</a>
            <a href="javascript:history.go(-1)" type="button" class="btn btn-primary btn-sm"><i class="fa fa-step-backward" aria-hidden="true"></i> Kembali</a>
            &nbsp;&nbsp;
                      
            </div>
            <?php }else{ ?>               
            Catatan : 
            <textarea class="form-control w-50" id="" cols="20" rows="3" value="<?= $t->catatan_spg ?>" readonly></textarea>
            
            <a href="javascript:history.go(-1)" type="button" class="btn btn-primary float-right"><i class="fa fa-step-backward" aria-hidden="true"></i> Kembali</a>
            <?php } ?>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <i class="fas fa-book"></i> info : Proses terima barang ini akan masuk ke dalam stok di toko : <b><?= $t->nama_toko ?></b> !
          </div>
        </div>
        <?php
         endforeach
        ?>
        </form>
        <!-- end konten -->
      </div>
    </div>    
  </div>
</section>
<!-- modal -->
<div class="modal fade bap" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
  <form action="<?= base_url('spg/Penerimaan/simpan_bap') ?>" method="post">
    <div class="modal-content">
      
        <div class="modal-header">
          <h3 class="card-title"><li class="fas fa-check-circle"></li> Berita Acara Penerimaan : <?= $t->id ?></h3>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <small><i class="fas fa-info"></i> <span class="badge badge-danger">Info ! </span></small> <br>
          <small>Form BAP ini dibuat ketika penerimaan barang tidak sesuai dengan sistem, pastikan anda memberikan laporan yang jelas dan detail.!</small> 
          <hr>
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="">Kategori Kasus :</label>
                  <input type="hidden" name="id_kirim" value="<?= $t->id ?>">
                  <select name="kategori" class="form-control select2bs4" id="kasus" required>
                    <option value="">- Pilih Kasus -</option>
                    <option value="1">Update Penerimaan Artikel</option>
                    <option value="2">Artikel Hilang</option>
                    <option value="3">Artikel Tambahan</option>
                  </select>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group kasus_1 d-none">
                  <label for="">Pilih Artikel yang akan di update :</label>
                  <select name="artikel_update" class="form-control select2bs4" id="artikel_update">
                    <option value="">- Pilih Artikel -</option>
                    <?php foreach ($detail_terima as $dd) : ?>
                      <option value="<?= $dd->id_produk ?>"><?= $dd->kode ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group kasus_2 d-none">
                  <label for="">Pilih Artikel yang Hilang :</label>
                  <select name="artikel_hilang" class="form-control select2bs4" id="artikel_hilang">
                    <option value="">- Pilih Artikel -</option>
                    <?php foreach ($detail_terima as $dd) : ?>
                      <option value="<?= $dd->id_produk ?>"><?= $dd->kode ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group kasus_3 d-none">
                  <label for="">Pilih Artikel Tambahan :</label>
                  <select name="artikel_tambahan" class="form-control select2bs4" id="artikel_tambahan">
                    <option value="">- Pilih Artikel -</option>
                    <?php foreach ($artikel_new as $dd) : ?>
                      <option value="<?= $dd->id_produk ?>"><?= $dd->kode ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="">.</label>
                  <br>
                  <input type="hidden" name="kode_produk">
                  <input type="hidden" name="nama_produk">
                  <input type="hidden" name="satuan">
                  <input type="hidden" name="qty_diterima">
                  <button disabled type="button" class="btn btn-primary btn-block btn-sm d-none" id="pilih"><i class="fas fa-plus"></i> </button>
                  <button disabled type="button" class="btn btn-primary btn-block btn-sm d-none" id="pilih_hilang"><i class="fas fa-plus"></i> </button>
                  <button disabled type="button" class="btn btn-primary btn-block btn-sm d-none" id="pilih_tambah"><i class="fas fa-plus"></i> </button>
                </div>
              </div>
            </div>
            <hr>
            <div class="keranjang table-responsive d-none">
                <table class="table table-bordered table-striped d-none" id="keranjang" >
                  <thead>
                    <tr>
                      <th>Kode Artikel #</th>
                      <th>Satuan</th>
                      <th style="width:18%">Qty Diterima</th>
                      <th style="width:18%">Qty Update</th>
                      <th style="width:10%">Menu</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <table class="table table-bordered table-striped d-none" id="list_hilang" >
                  <thead>
                    <tr>
                      <th>Kode Artikel #</th>
                      <th>Satuan</th>
                      <th style="width:18%">Qty Diterima</th>
                      <th style="width:10%">Menu</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <table class="table table-bordered table-striped d-none" id="list_tambah" >
                  <thead>
                    <tr>
                      <th>Kode Artikel #</th>
                      <th>Nama Artikel</th>
                      <th>Satuan</th>
                      <th style="width:18%">Qty Diterima</th>
                      <th style="width:10%">Menu</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <hr>
                <div class="form-group">
                  <label for="catatan">Catatan </label>
                  <textarea name="catatan" id="" class="form-control" cols="1" rows="3" placeholder="Laporkan dengan jelas dan detail..." required></textarea>
                </div>
                <hr>
                <span class="badge badge-warning badge-sm"># Info :</span> <small>Pengajuan B.A.P ini akan diteruskan ke tim Leader dan Marketing verifikasi, setelah semua di setujui akan update data secara otomatis.!</small>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button disabled type="submit" class="btn btn-success" id="simpan">Proses</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end modal -->
 <!-- jQuery -->
 <script src="<?php echo base_url()?>/assets/plugins/jquery/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
      // data array
    var tampung_array = [];
    
    
    // table
      $('#table_terima').DataTable({
          order: [[0, 'asc']],
          responsive: true,
          lengthChange: false,
          autoWidth: false,
      });
    // end tabel
      $('#btn_terima').click(function()
      {
        var formData = $('form').serialize();
        $.ajax({
          url: '<?php echo base_url('spg/Penerimaan/terima_barang')?>',
          method: "POST",
          data: formData,
          dataType: "text",
          success: function(n){
            if (n == 1){
              Swal.fire('Berhasil','Data berhasil disimpan !','success');
              location.href="<?php echo base_url('spg/Penerimaan') ?>";
            } else {
              Swal.fire('Qty tidak sesuai','Qty yang anda masukkan tidak sesuai dengan sistem, silahkan hitung kembali!','warning')
              $(".baris").removeClass("bg-danger");
              $(".merah").addClass("bg-danger");
              $(".baris").removeClass("merah");
            }
          }
        });
      });

      $('.qty_input').change(function()
      {
        var qty = $(this).data("qty");
        var qty_input = $(this).val();
        if (qty != qty_input) {
            $(this).closest("tr").addClass("merah",true) 
        }
      });

      // ketika kasus di pilih
      $('#kasus').change(function()
      {
        if (tampung_array != '')
          {
            Swal.fire(
                          'Peringatan !',
                          'List Artikel yang di tambahkan masih tersimpan, Refresh halaman ini !',
                          'info'
                        )
                        $(this).val('');   
          }
        var data = $(this).val();
        if (data == "1") {
          $(".kasus_1").removeClass("d-none");
          $("#pilih").removeClass("d-none");
          $("#pilih_hilang").addClass("d-none");
          $("#pilih_tambah").addClass("d-none");
          $(".kasus_2").addClass("d-none");
          $(".kasus_3").addClass("d-none");
        }else if(data == "2")
        {
          $(".kasus_2").removeClass("d-none");
          $("#pilih_hilang").removeClass("d-none");
          $("#pilih_tambah").addClass("d-none");
          $("#pilih").addClass("d-none");
          $(".kasus_1").addClass("d-none");
          $(".kasus_3").addClass("d-none");
        }else if(data == "3")
        {
          $(".kasus_3").removeClass("d-none");
          $("#pilih_tambah").removeClass("d-none");
          $("#pilih").addClass("d-none");
          $("#pilih_hilang").addClass("d-none");
          $(".kasus_1").addClass("d-none");
          $(".kasus_2").addClass("d-none");
        }
        else{
          $("#pilih").addClass("d-none");
          $("#pilih_hilang").addClass("d-none");
          $("#pilih_tambah").addClass("d-none");
          $(".kasus_1").addClass("d-none");
          $(".kasus_2").addClass("d-none");
          $(".kasus_3").addClass("d-none");
        }
      });

      // ketika plih produk
    $('#artikel_update').on('change', function()
    {
      for (var i=0; i<tampung_array.length; i++)
                  {
                    if($(this).val() == tampung_array[i]) 
                      {
                        Swal.fire(
                          'Peringatan !',
                          'Artikel sudah ada di list Pilihan !',
                          'info'
                        )
                        $(this).val('');
                      }
                  }
       // menampilkan detail permintaan
       var id = $(this).val();
        var id_terima = $('input[name="id_terima"]').val();
          $.ajax({
              type  : 'get',
              url   : '<?php echo base_url()?>spg/Penerimaan/list_selisih/'+id,
              async : true,
              data: {id:id,id_terima:id_terima},
              dataType : 'json',
              success : function(data){  
                $('input[name="kode_produk"]').val(data.kode);       
                $('input[name="qty_diterima"]').val(data.qty_diterima);         
                $('input[name="satuan"]').val(data.satuan); 
                $('button#pilih').prop('disabled', false)                  
              }

          });
          // end detail permintaan
    });
      // ketika plih produk
    $('#artikel_hilang').on('change', function()
    {
      
      for (var i=0; i<tampung_array.length; i++)
                  {
                    if($(this).val() == tampung_array[i]) 
                      {
                        Swal.fire(
                          'Peringatan !',
                          'Artikel sudah ada di list Pilihan !',
                          'info'
                        )
                        $(this).val('');
                      }
                  }
       // menampilkan detail permintaan
       var id = $(this).val();
        var id_terima = $('input[name="id_terima"]').val();
          $.ajax({
              type  : 'get',
              url   : '<?php echo base_url()?>spg/Penerimaan/list_selisih/'+id,
              async : true,
              data: {id:id,id_terima:id_terima},
              dataType : 'json',
              success : function(data){  
                $('input[name="kode_produk"]').val(data.kode);       
                $('input[name="qty_diterima"]').val(data.qty_diterima);         
                $('input[name="satuan"]').val(data.satuan); 
                $('button#pilih_hilang').prop('disabled', false)                  
              }

          });
          // end detail permintaan
    });
      // ketika plih produk
    $('#artikel_tambahan').on('change', function()
    {
      console.log(tampung_array);
      for (var i=0; i<tampung_array.length; i++)
                  {
                    if($(this).val() == tampung_array[i]) 
                      {
                        Swal.fire(
                          'Peringatan !',
                          'Artikel sudah ada di list Pilihan !',
                          'info'
                        )
                        $(this).val('');
                      }
                  }
       // menampilkan detail permintaan
       var id = $(this).val();
          $.ajax({
              type  : 'get',
              url   : '<?php echo base_url()?>spg/Penerimaan/artikel_tambahan/'+id,
              async : true,
              data: {id:id},
              dataType : 'json',
              success : function(data){  
                $('input[name="kode_produk"]').val(data.kode);       
                $('input[name="nama_produk"]').val(data.nama_produk);       
                $('input[name="satuan"]').val(data.satuan); 
                $('button#pilih_tambah').prop('disabled', false)                  
              }

          });
          // end detail permintaan
    });

      // ketika tombol pilih di klik
    $(document).on('click', '#pilih', function(e)
    {
      
      const keranjang_update = 
            {
              id_produk: $('select[name="artikel_update"]').val(),
              kode_produk: $('input[name="kode_produk"]').val(),
              satuan: $('input[name="satuan"]').val(),
              qty: $('input[name="qty_diterima"]').val(),
              keranjang: $('input[name="id_produk_hidden[]"]').val(),
            }  
            $.ajax({
						url: '<?php echo base_url()?>spg/penerimaan/keranjang',
						type: 'POST',
						data: keranjang_update,
						success: function(data){
              tampung_array.push(keranjang_update.id_produk);
              $('.keranjang').removeClass('d-none');
              $('#keranjang').removeClass('d-none');
              $('#list_hilang').addClass('d-none');
              $('#list_tambah').addClass('d-none');
							$('table#keranjang tbody').append(data)
              $('button#pilih').prop('disabled', true);
              $('button#simpan').prop('disabled', false);
						}
					})
    });
      // ketika tombol pilih hilang di klik
    $(document).on('click', '#pilih_hilang', function(e)
    {
      
      const keranjang_update = 
            {
              id_produk: $('select[name="artikel_hilang"]').val(),
              kode_produk: $('input[name="kode_produk"]').val(),
              satuan: $('input[name="satuan"]').val(),
              qty: $('input[name="qty_diterima"]').val(),
              keranjang: $('input[name="id_produk_hidden[]"]').val(),
            }  
            $.ajax({
						url: '<?php echo base_url()?>spg/penerimaan/list_hilang',
						type: 'POST',
						data: keranjang_update,
						success: function(data){
              tampung_array.push(keranjang_update.id_produk);
              $('.keranjang').removeClass('d-none');
              $('#list_hilang').removeClass('d-none');
              $('#keranjang').addClass('d-none');
              $('#list_tambah').addClass('d-none');
							$('table#list_hilang tbody').append(data)
              $('button#pilih_hilang').prop('disabled', true);
              $('button#simpan').prop('disabled', false);
						}
					})
    });
      // ketika tombol pilih hilang di klik
    $(document).on('click', '#pilih_tambah', function(e)
    {
      const keranjang_update = 
            {
              id_produk: $('select[name="artikel_tambahan"]').val(),
              kode_produk: $('input[name="kode_produk"]').val(),
              nama_produk: $('input[name="nama_produk"]').val(),
              satuan: $('input[name="satuan"]').val(),
              keranjang: $('input[name="id_produk_hidden[]"]').val(),
            }  
            $.ajax({
						url: '<?php echo base_url()?>spg/penerimaan/list_tambah',
						type: 'POST',
						data: keranjang_update,
						success: function(data){
              tampung_array.push(keranjang_update.id_produk);
              $('.keranjang').removeClass('d-none');
              $('#list_tambah').removeClass('d-none');
              $('#keranjang').addClass('d-none');
              $('#list_hilang').addClass('d-none');
							$('table#list_tambah tbody').append(data)
              $('button#pilih_tambah').prop('disabled', true);
              $('button#simpan').prop('disabled', false);
						}
					})
    });
    

    // fungsi hapus
    $(document).on('click', '#tombol-hapus', function()
      {
				$(this).closest('.row-keranjang').remove()
				if($('tbody').children().length == 0) $('tfoot').hide()
			})
    // fungsi hapus
    $(document).on('click', '#btn_hilang', function()
      {
				$(this).closest('.row-list_hilang').remove()
				if($('tbody').children().length == 0) $('tfoot').hide()
			})
    // fungsi hapus
    $(document).on('click', '#btn_tambah', function()
      {
				$(this).closest('.row-list_tambah').remove()
				if($('tbody').children().length == 0) $('tfoot').hide()
			})

    });
</script>

