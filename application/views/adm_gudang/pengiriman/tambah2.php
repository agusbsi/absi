<!-- Main content -->
<section class="content">
<div id="content" >
    <div class="row">
        <div class="col-md-12">
            <div class="card card-row card-info">
                <div class="card-header">
                    <h3 class="card-title">
                    <li class="fa fa-list"></li> Tambah Data Pengiriman
                    </h3>
                    <div class="card-tools">
                        <a href="<?= base_url('adm_gudang/Pengiriman') ?>" type="button" class="btn btn-tool" >
                        <i class="fas fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Master -->
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title"><li class="fas fa-truck"></li> <strong>Master Pengiriman</strong> </h3>
                            
                        </div>
                        <!-- /.card-header -->
                    
                        <div class="card-body">                         
                            <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                <label>No Pengiriman :</label>
                                <input type="text" class="form-control" name="kode_kirim"  value="<?= $kode_kirim ?>" readonly>
                                </div>
                                <div class="form-group">
                                <label>No Permintaan :</label>
                                 <select class="form-control select2bs4" style="width: 100%;" id="no_permintaan" name="no_permintaan" >
                                    <option selected="selected" value="">Pilih Permintaan</option>
                                    <?php foreach ($list_permintaan as $l) { ?>
                                    <option value="<?= $l->id ?>"><?= $l->id." ( ".$l->nama_toko." )" ?></option>
                                    <?php } ?>
                                
                                </select> 
                              
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-1"></div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <div class="form-group">
                                <label>Tujuan :</label>
                                </div>
                                <div class="form-group">
                                [ <label id="toko">Nama Toko</label> ] 
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                <label>Alamat :</label><br>
                                <span id="alamat">Alamat Toko</span>
                                
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <label>Tanggal Permintaan :</label>
                                <input type="hidden" name="tgl" >
                                </div>
                                <div class="form-group">
                                [ <label id="tgl">Tgl Permintaan</label> ]  
                                </div>
                                <div class="form-group">
                                <label >Catatan MV :</label> <br>
                                <address id="catatan_mv"></address>
                                </div>
                                <!-- /.form-group -->
                               
                            </div>
                            <!-- /.col -->
                            </div>
                            <!-- /.row -->
                             
                        </div>
                        <!-- /.card-body -->
                    
                    </div>
                    <!-- /.card -->
                    <!-- List -->
                    <!-- detail barang -->
                    <div id="rincian">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title"> <li class="fas fa-cube"></li> <strong>List Barang</strong> </h3>
                        </div>
                    <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                            <div class="col-md-12">
                                <!-- isi konten -->
                                <form id="form_qty">
                                    <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                    <tr class="text-center">
                                        <th style="width: 20px;">No</th>
                                        <th style="width: 40%;">Nama Barang</th>
                                        <th>Qty Permintaan</th>
                                        <th>Qty Sudah Dikirim</th>
                                        <th>Qty Akan Dikirim</th>
                                    
                                    </tr>
                                    </thead>
                                    <tbody id="show_data" >
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                    <td colspan="6">
                                    <b>Noted:</b> Untuk Artikel yang jumlahnya = 0, maka secara otomatis tidak akan ditampilkan di list lagi.
                                    </td>
                                    </tr>
                                    </tfoot>
                                    </table>
                            
                            </div>
                        
                            </div>
                            <!-- /.row -->
                            <div class="row">
                               <div class="col-md-4">
                                Catatan : <br>
                                <textarea name="catatan" class="form-control"  cols="1" rows="3" placeholder="cth: ada 8 koli/box/karung" required></textarea>
                                <small>Wajib di isi | untuk keterangan jumlah packing</small>
                               </div>
                                
                                <div class="col-sm-8 ">
                                <div class="float-right form-group">
                                    <label>Admin Gudang :</label> 
                                    <br>
                                    <br>
                                    <br>
                                    <?= $this->session->userdata('nama_user'); ?>
                                </div>
                                </div>
                            </div>
                        </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    </div>
                    <!-- end rincian -->
                </div>
                <div class="card-footer " id="footer" >
                    <div class="float-right">
                    <a href="<?= base_url('adm_gudang/pengiriman') ?>" class="btn btn-danger"><li class="fa fa-times-circle"></li> Cancel</a>
                    <button type="button" class="btn btn-success" id="btn_simpan"><li class="fa fa-save"></li> Proses</button>
                    </div>
                    
                </div>
            </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
      <!-- /.row -->
      </form>
    <!-- end form -->
                         
</div>
</section>

<!-- /.content -->
<script type="text/javascript" src="<?php echo base_url().'assets/js/js/jquery-2.2.3.min.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/js/bootstrap.js'?>"></script>

<script> 
    $(document).ready(function()
    { 
        $('#rincian').hide();
        $('#footer').hide();

        // no permintaan ketika di pilih
        $('#no_permintaan').on('change', function(){
            $('#rincian').show();
            $('#footer').show();

            // menampilkan detail master
            $.ajax({
                url: '<?= base_url('adm_gudang/Pengiriman/view') ?>',
                type: 'POST',
                dataType: 'json',
                data: {no_permintaan: $(this).val()},
                success: function(data){
                    $('#toko').html(data.data.nama_toko);
                    $('#alamat').html(data.data.alamat);
                    $('#tgl').html(data.data.created_at);
                    $('#catatan_mv').html(data.data.keterangan);
                }
            })
            // end detail master
            
            // menampilkan detail permintaan
            var id=$(this).val();
            $.ajax({
                type  : 'POST',
                url   : '<?php echo base_url()?>adm_gudang/Pengiriman/list_detail',
                async : true,
                dataType : 'json',
                data : {no_permintaan:id},
                success : function(data){
                    var html = '';
                    var i;
                    var a = 0;
                    var qty_pending = 0;
                    for(i=0; i<data.length; i++){
                        a++
                        qty_pending = data[i].qty_acc - data[i].qty_dikirim;
                        html += '<tr>'+
                                '<td>'+a+'</td>'+
                                '<td>'+data[i].nama_produk+'</td>'+
                                '<td class="text-center">'+data[i].qty_acc+'</td>'+
                                '<td class="text-center">'+data[i].qty_dikirim+'</td>'+
                                '<td style="text-align:right;">'+
                                    '<input type="hidden" class="form-control" name="id_permintaan" value="'+data[i].id_permintaan+'" >'+
                                    '<input type="hidden" class="form-control" name="id_toko" value="'+data[i].id_toko+'" >'+
                                    '<input type="hidden" class="form-control" name="id_detail_permintaan[]" value="'+data[i].id+'" >'+
                                    '<input type="hidden" class="form-control" name="id_produk[]" value="'+data[i].id_produk+'" >'+
                                    '<input type="hidden" class="form-control" name="qty[]" value="'+data[i].qty_acc+'" >'+
                                    '<input type="hidden" class="form-control" name="qty_dikirim[]" value="'+data[i].qty_dikirim+'" >'+
                                    '<input type="number" class="form-control" name="qty_input[]"  value="0"  min="0">'+
                                '</tr>';
                        }   
                    $('#show_data').html(html);
                    
                    // fungsi qty input di ganti
                        
                    // $('input[name="qty_input[]"]').keyup(function(){
                    //     // cek apakah ada nilai yang di kirim / tidak
                    //     input = $(this).val();
                    //     kirim = $(this).attr('max');  
                    //     if( parseInt(input) > parseInt(kirim)){
                    //         // menampilkan pesan eror
                    //         Swal.fire(
                    //         'Melebihi jumlah Permintaan',
                    //         'Pastikan input jumlah yang sesuai dan tidak melebihi jumlah/sisa permintaan',
                    //         'info'
                    //         )
                    //         $(this).val(kirim);
                    //     }
                    // });              
                    }

            });
            // end detail permintaan
           
            // tombol proses ketika di klik
            $("#btn_simpan").click(function(e) {
                e.preventDefault();
                Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data Permintaan akan di proses Kirim",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Yakin'
                }).then((result) => {
                    if ($('textarea[name="catatan"]').val()==""){
                                Swal.fire(
                                        'Kolom Catatan Harus di isi',
                                        'Pastikan input Jumlah packing (koli/karung/box)',
                                        'info'
                                        )
                            }else{
                                // proses
                                var data_qty = $('#form_qty').serialize();
                                $.ajax({
                                url:'<?php echo base_url()?>adm_gudang/Pengiriman/proses_tambah2',
                                method:"POST",
                                dataType : 'text',
                                data : data_qty,
                                success:function(data){
                                    Swal.fire(
                                        'Berhasil',
                                        'Data Berhasil dibuat !',
                                        'success'
                                        )
                                        location.href="<?php echo base_url('adm_gudang/Pengiriman/') ?>";
                                }
                                })
                            }
                })
            })
            // end tombol proses
        });  
        // end pilih no permintaan
       
    });
</script>
