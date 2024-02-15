<section class="content">
  <div class="container-fluid">
  <form action="<?= base_url('leader/Mutasi/proses_add') ?>" method="POST">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"><i class="nav-icon fas fa-box"></i> Transfer Barang</h3>
        <div class="card-tools">
          <a href="<?= base_url('leader/Mutasi') ?>" type="button" class="btn btn-tool" >
            <i class="fas fa-times"></i>
          </a>
        </div>
      </div>
      <div class="card-body">
        <!-- Master -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title"><li class="fas fa-box"></li> <strong>Master Data</strong> </h3>
                
            </div>
            <!-- /.card-header -->

            <div class="card-body">                         
                <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                    <label>No Mutasi :</label>
                    <input type="text" class="form-control" name="no_mutasi"  value="<?= $kode_mutasi ?>" readonly>
                    </div>
                    <div class="form-group">
                    <label>Tanggal :</label>
                    <input type="text" class="form-control" name="tgl_mutasi"  value="<?= date('Y-m-d') ?>" readonly>
                  
                    </div>
                    <!-- /.form-group -->
                </div>
                <div class="col-md-4"></div>
                <!-- /.col -->
                <div class="col-md-4">
                <div class="form-group">
                    <label>Toko Asal :</label>
                    <select class="form-control select2bs4" style="width: 100%;" id="toko_asal" name="toko_asal" required >
                        <option selected="selected" value="">- Pilih Toko Asal -</option>
                        <?php foreach ($list_toko as $l) { ?>
                        <option value="<?= $l->id ?>"><?= $l->nama_toko ?></option>
                        <?php } ?>
                    </select> 
                    </div>
                    <div class="form-group">
                    <label>Toko tujuan :</label>
                    <select class="form-control select2bs4" style="width: 100%;" id="toko_tujuan" name="toko_tujuan" required disabled>
                        <option selected="selected" value="">- Pilih Toko Tujuan -</option>
                        <?php foreach ($toko_tujuan as $l) { ?>
                        <option value="<?= $l->id ?>"><?= $l->nama_toko ?></option>
                        <?php } ?>
                    </select> 
                    </div>
                    <!-- /.form-group -->
                </div>
            
                </div>
                <!-- /.row -->
                
            </div>
            <!-- /.card-body -->

        </div>
        <!-- end master -->
        <div class="card card-default">
         <div class="card-body">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                        <label>Pilih Barang</label>
                        <select name="id_produk" class="form-control select2bs4" id="id_produk" disabled>
                        </select>
                    </div>
            </div>
            <div class="col-md-5">
            <label>Nama Artikel</label>
            <input type="text" name="nama_produk" value="" readonly class="form-control">
            <input type="hidden" name="kode_produk" value="" readonly class="form-control">
            </div>
            <div class="col-md-1 text-center">
            <label>Satuan</label>
            <input type="text" name="satuan" value="" readonly class="form-control">
            </div>
            <div class="col-md-1 text-center">
            <label>Stok</label>
            <input type="text" name="stok" value="" readonly class="form-control">
            </div>
            <div class="col-md-1 text-center">
            <label>Qty</label>
            <input type="number" name="qty" value="" readonly class="form-control" min="0">
            </div>
            <div class="col-md-1">
            <label for="">&nbsp;</label>
            <button disabled type="button" class="btn btn-primary btn-block" id="tambah"><i class="fa fa-plus"></i></button>
            </div>
            </div>
            
          </div>
         <!-- end row -->
         <h3 class="card-title ml-3"><i class="fas fa-cube"></i> List Barang</h3>
         <hr>
          <div class="keranjang table-responsive">
						<table class="table table-bordered table-striped" id="keranjang" >
							<thead>
                <tr>
                  <th>Kode Artikel #</th>
                  <th>Nama Artikel</th>
                  <th>Satuan</th>
                  <th>Qty</th>
                  <th>Aksi</th>
                </tr>
              </thead>
							<tbody>

              </tbody>
							<tfoot>
								<tr>
									<td colspan="4" align="right">
									  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Proses Transfer</button>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
        </div>
      </div>
  </form>
  </div>
</section>

<script type="text/javascript">
  $(document).ready(function() {
    $('tfoot').hide()
    // data array
    var tampung_array = [];
    // pilih kota asal
    $('#toko_asal').on('change', function()
        {
            reset()
            if ($(this).val() != "")
            {
            document.getElementById("toko_tujuan").disabled = false;
            document.getElementById("id_produk").disabled = false;
            // list produk
            var url = "<?php echo base_url('leader/Mutasi/list_produk');?>/"+$(this).val();
	                $('#id_produk').load(url);
	                return false;
            }else {
            document.getElementById("toko_tujuan").disabled = true;
            document.getElementById("id_produk").disabled = true;
            }
            if ($(this).val() == $('#toko_tujuan').val())
            {
                Swal.fire({
                        title: 'Peringatan',
                        text: "Toko asal & tujuan tidak boleh sama !",
                        type: 'info',
                        icon: "info",
                      })
            $(this).val("");
            }
        })
        // pilih kota tujuan
        $('#toko_tujuan').on('change', function()
        {

            if ($(this).val() == $('#toko_asal').val())
            {
                Swal.fire({
                        title: 'Peringatan',
                        text: "Toko asal & tujuan tidak boleh sama !",
                        type: 'info',
                        icon: "info",
                      })
            $(this).val("");
            }
        })

    // funsi reset
    function reset()
    {
        $('#id_produk').val('')
				$('input[name="nama_produk"]').val('')
				$('input[name="satuan"]').val('')
				$('input[name="stok"]').val('')
				$('input[name="qty"]').val('')
				$('input[name="qty"]').prop('readonly', true)
				$('button#tambah').prop('disabled', true)
		}
    // ketika plih produk
    $('#id_produk').on('change', function()
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
                        reset()
                      }
                  }

      if ($('#toko_tujuan').val() == '')
      {
        Swal.fire({
                        title: 'Peringatan',
                        text: "Pilih Toko Tujuan terlebih dahulu !",
                        type: 'info',
                        icon: "info",
                      })
        reset()
      }
      if($(this).val() == '') 
      {
       reset()
			}	else {
          // menampilkan detail permintaan
        var id=$(this).val();
        var id_toko = $('select[name="toko_asal"]').val();
          $.ajax({
              type  : 'get',
              url   : '<?php echo base_url()?>leader/Mutasi/tampilkan_detail_produk/'+id,
              async : true,
              data: {id:id,id_toko:id_toko},
              dataType : 'json',
              success : function(data){  
                $('input[name="kode_produk"]').val(data.kode);         
                $('input[name="nama_produk"]').val(data.nama_produk);         
                $('input[name="stok"]').val(data.qty);         
                $('input[name="satuan"]').val(data.satuan); 
                $('input[name="qty"]').prop('readonly', false)        
                $('button#tambah').prop('disabled', false)                    
              }

          });
          // end detail permintaan

        }
      
    });
  
    // jumlah di isi
    $('input[name="qty"]').on('keydown keyup change', function()
    {
     var input  = $(this).val();
     var stok = $('input[name="stok"]').val();
     if (parseInt(input) > parseInt(stok)) {
      Swal.fire(
        'Peringatan !',
        'Pastikan jumlah yang di Transfer tidak melebihi jumlah stok yang tersedia.',
        'info'
      )
      $(this).val(stok);
     }
   
    });

    // ketika tombol tambah di klik
    $(document).on('click', '#tambah', function(e)
      {
        const data_keranjang = 
            {
              id_produk: $('select[name="id_produk"]').val(),
              kode_produk: $('input[name="kode_produk"]').val(),
              nama_produk: $('input[name="nama_produk"]').val(),
              satuan: $('input[name="satuan"]').val(),
              qty: $('input[name="qty"]').val(),
              keranjang: $('input[name="id_produk_hidden[]"]').val(),
            }  
        if ($('input[name="qty"]').val() <= 0) 
          {
            Swal.fire(
              'Peringatan !',
              'Jumlah tidak boleh 0',
              'info'
            )
          }else
          {
            $.ajax({
						url: '<?php echo base_url()?>leader/Mutasi/keranjang',
						type: 'POST',
						data: data_keranjang,
						success: function(data){
              tampung_array.push(data_keranjang.id_produk);
							reset()
							$('table#keranjang tbody').append(data)
							$('tfoot').show()
						}
					})
          }
			})
      
      // fungsi hapus
      $(document).on('click', '#tombol-hapus', function()
      {
				$(this).closest('.row-keranjang').remove()
				if($('tbody').children().length == 0) $('tfoot').hide()
			})
 
    });
</script>   