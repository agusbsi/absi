<section class="content">
  <div class="container-fluid">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"><i class="nav-icon fas fa-cart-plus"></i> Form Penjualan</h3>
        <div class="card-tools">
              <a href="<?= base_url('spg/Penjualan') ?>" type="button" class="btn btn-tool" >
                <i class="fas fa-times"></i>
              </a>
            </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col">
            <b>No. Penjualan</b><br>
            <b>Toko</b><br>
            <b>Tanggal</b><br>
          </div>
          <div class="col">
            : <?= $no_penjualan ?><br>
            : <?= $toko_new->nama_toko." ($nama)" ?><br>
            : <input id="tanggal_penjualan" type="date" value="<?= ($this->session->userdata('tanggal_penjualan')) ? $this->session->userdata('tanggal_penjualan') : date('Y-m-d') ?>" max="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d', strtotime('-40 days')) ?>"></input><br>
          </div>
        </div>
        <hr>
        <h3>List Produk</h3>
        
        <table class="table table-bordered table-striped">
          <tr>
            <th>Kode Artikel #</th>
            <th>Nama Artikel</th>
            <th>Qty</th>
            <th>Action</th>
          </tr>
          <?php foreach ($data_cart as $d) { ?>
          <tr>
            <td><?= $d['options'] ?></td>
            <td><?= $this->db->query("SELECT nama_produk FROM tb_produk where id = '$d[id]'")->row()->nama_produk  ?></td>
            <td><?= $d['qty'] ?></td>
            <td><a class="btn btn-danger btn-sm" href="<?= base_url('spg/penjualan/hapus_cart/').$d['rowid'] ?>"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a></td>
          </tr>
          <?php } ?>
          <tr>
            <td colspan="4">
              <button id="btn-tampil" class="btn btn-link btn-block" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <i class="fa fa-plus"></i>Tambah Item
              </button>
              <div class="collapse" id="collapseExample">
              <form method="POST" action="<?= base_url('spg/penjualan/tambah_cart') ?>">
                <div class="form-group">
                  <select name="id" class="form-control select2bs4" id="id_produk">
                    <option value="">Pilih Produk</option>
                    <?php foreach ($list_produk as $l) { ?>
                      <option value="<?= $l->id_produk ?>"><?= $l->kode ?> | <?= $l->nama_produk ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <table class="d-none" id="detail_produk">
                    <tr>
                      <th>Kode</th>
                      <th>Nama</th>
                      <th>Stok Tersedia</th>
                      <th>Satuan</th>
                    </tr>
                    <tr>
                      <td id="kode">-</td>
                      <td id="nama_produk">-</td>
                      <td id="stok_tersedia">-</td>
                      <td id="satuan">-</td>
                    </tr>
                  </table>
                </div>
                <div class="form-group">
                  <input class="form-control" type="number" min="0" name="qty" required="" placeholder="Jumlah">
                </div>
                <div class="form-group">
                  <textarea class="form-control" placeholder="Tambahkan catatan jika ada.."></textarea>
                  <small>*opsional</small>
                </div>
                <div class="form-group">
                  <button type="submit" id="btn-tambah" class="btn btn-success"><i class="fa fa-plus"></i> Tambahkan ke List</button>
                </div>
              </form>
            </div>
            </td>
          </tr>
          <?php if (count($data_cart) > 0) { ?>
          <tr>
              <td colspan="4" class="text-right"><a class="btn btn-primary" id="btn-kirim" href="#"><i class="fa fa-check-square" aria-hidden="true"></i> Simpan Data Penjualan</a></td>
          </tr>
          <?php } ?>
            
        </table>
    </div>
  </div>
 
</div>
</section>


<script type="text/javascript">
  $(document).ready(function() {
    $('#btn-tampil').click(function(){
      $('#btn-kirim').toggle();
    })
  
  });

  $('#btn-kirim').click(function(e){
    var tanggal = $("#tanggal_penjualan").val();
    e.preventDefault();
    Swal.fire({
      title: 'Data Penjualan di </br>'+ tanggal,
      text: "Apakah anda yakin untuk memprosesnya ?",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Batal',
      confirmButtonText: 'Yakin'
    }).then((result) => {
      if (result.isConfirmed) {
        location.href = "<?= base_url('spg/Penjualan/simpan_penjualan/') ?>";
      }
    })
  })
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#id_produk').on('change', function()
    {
      // menampilkan detail permintaan
      var id=$(this).val();
        $.ajax({
            type  : 'get',
            url   : '<?php echo base_url()?>spg/penjualan/tampilkan_detail_produk/'+id,
            async : true,
            dataType : 'json',
            success : function(data){
              $('#kode').text(data.kode);            
              $('#nama_produk').text(data.nama_produk);            
              $('#stok_tersedia').text(data.qty);            
              $('#satuan').text(data.satuan);            
              $('#detail_produk').removeClass('d-none');
            }
        });
        // end detail permintaan

    });
    
  });
</script>

<script type="text/javascript">
  $('#tanggal_penjualan').change(function()
    {
      var tanggal = $("#tanggal_penjualan").val();
      $.ajax({
        type: 'GET',
        url: "<?= base_url('spg/penjualan/set_tanggal/') ?>"+tanggal, // file PHP untuk memproses data
      });

    });
</script>