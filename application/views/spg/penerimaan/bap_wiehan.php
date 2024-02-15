<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-check-circle"></i>
              <strong>Berita Acara Penerimaan [ <?= $id_kirim; ?> ]</strong>
            </h3>
            <div class="card-tools">
              <a href="<?= base_url('spg/penerimaan') ?>" type="button" class="btn btn-tool"><i class="fas fa-times"></i></a>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="form-group col-12">
                <select name="kategori" class="form-control select2bs4" id="kasus">
                  <option value="">Pilih Kasus</option>
                  <option value="Update Penerimaan Artikel">Update Penerimaan Barang</option> <option value="Artikel Hilang">Artikel Hilang</option>
                  <option value="Artikel Tidak Sesuai">Artikel Tidak Sesuai</option>
                </select>
              </div>
            </div>
            <div class="update-penerimaan d-none">
              <form method="post" action="<?= base_url('spg/penerimaan/update_penerimaan') ?>" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-6">
                    <table>
                      <tr>
                        <td style="width: 35%">
                        No BAP
                        </td>
                        <td>
                          : <?= $no_bap; ?>
                          <input type="hidden" name="bap" value="<?= $no_bap; ?>">    
                        </td>
                      </tr>
                      <tr>
                        <td>Perihal</td>
                        <td>: <input type="text" name="kategori" id="sub" style="border: none;"></td>
                      </tr>
                      <tr>
                        <td>Nama Toko</td>
                        <td>: <?= $terima->nama_toko; ?>
                          <input type="hidden" name="id_toko" value="<?= $terima->id_toko; ?>">
                        </td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td>: <?= $terima->alamat; ?></td>
                      </tr>
                      <tr>
                        <td>No. Telpon</td>
                        <td>: <?= $terima->telp; ?></td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table>
                      <tr>
                        <th>ID Kirim</th>
                        <th>: <?= $terima->id; ?>
                          <input type="hidden" name="id_kirim" value="<?= $terima->id; ?>">
                        </th>
                      </tr>
                      <tr>
                        <td>Tgl. Terima Barang </td>
                        <td>: <?= $terima->created_at; ?></td>
                      </tr>
                      <tr>
                        <td>Keterangan</td>
                        <td>: <?= $terima->keterangan; ?></td>
                      </tr>
                      <tr>
                        <td>Nama SPG</td>
                        <td>: <?= $user->nama_user; ?></td>
                      </tr>
                    </table>
                  </div>
                  <div class="row">
                    <table id="table_terima" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th style="width: 2%">
                            No #
                          </th>
                          <th style="width: 12%">
                            Kode Artikel #
                          </th>
                          <th style="width: 23%">
                            Nama Artikel #
                          </th>
                          <th>Satuan</th>
                          <th>Qty Diterima</th>
                          <th>Qty Pembaruan</th>
                          <th>Foto Bukti</th>
                        </tr>
                      </thead>
                      <?php 
                      $no=0;
                      foreach ($detail_terima as $d) 
                      { $no++ ?>
                        <tr>
                          <td><?= $no; ?></td>
                          <td>
                            <?= $d->kode; ?>
                            <input type="hidden" name="id_produk[]" value="<?= $d->id; ?>">
                          </td>
                          <td>
                            <?= $d->nama_produk; ?>
                          </td>
                          <td><?= $d->satuan; ?></td>
                          <td>
                            <?= $d->qty_diterima; ?>
                            <input type="hidden" name="qty_diterima[]" value="<?= $d->qty_diterima; ?>">
                          </td>
                          <td>
                            <input type="number" name="qty[]" style="background: transparent;" required="">
                          </td>
                          <td>
                            <input type="file" class="form-control" name="foto[]" multiple accept="image/png, image/jpeg, image/jpg" style="background: transparent;" required=""></input>
                          </td>
                        </tr>
                      <?php } ?>
                    </table>
                  </div>
                </div>
                <textarea name="catatan_spg" class="form-control w-50" id="" cols="20" rows="3"  placeholder =" Opsional - Jika ada Catatan"></textarea>
                <button type="submit" class="btn btn-success float-right"><i class="fas fa-save" aria-hidden="true"></i>Kirim BAP</button>
              </form>
            </div>
            <div class="hilang-penerimaan d-none">
              <form method="post" action="<?= base_url('spg/penerimaan/hilang_penerimaan') ?>" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-6">
                    <table>
                      <tr>
                        <td style="width: 35%">
                        No BAP
                        </td>
                        <td>
                          : <?= $no_bap; ?>
                          <input type="hidden" name="bap" value="<?= $no_bap; ?>">    
                        </td>
                      </tr>
                      <tr>
                        <td>Perihal</td>
                        <td>: <input type="text" name="kategori" id="hilang" style="border: none;"></td>
                      </tr>
                      <tr>
                        <td>Nama Toko</td>
                        <td>: <?= $terima->nama_toko; ?>
                          <input type="hidden" name="id_toko" value="<?= $terima->id_toko; ?>">
                        </td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td>: <?= $terima->alamat; ?></td>
                      </tr>
                      <tr>
                        <td>No. Telpon</td>
                        <td>: <?= $terima->telp; ?></td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table>
                      <tr>
                        <th>ID Kirim</th>
                        <th>: <?= $terima->id; ?>
                          <input type="hidden" name="id_kirim" value="<?= $terima->id; ?>">
                        </th>
                      </tr>
                      <tr>
                        <td>Tgl. Terima Barang </td>
                        <td>: <?= $terima->created_at; ?></td>
                      </tr>
                      <tr>
                        <td>Keterangan</td>
                        <td>: <?= $terima->keterangan; ?></td>
                      </tr>
                      <tr>
                        <td>Nama SPG</td>
                        <td>: <?= $user->nama_user; ?></td>
                      </tr>
                    </table>
                  </div>
                  <div class="row col-12">
                    <table id="table_terima" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th style="width: 2%">
                            No #
                          </th>
                          <th style="width: 20%">
                            Kode Artikel #
                          </th>
                          <th style="width: 30%">
                            Nama Artikel #
                          </th>
                          <th>Satuan</th>
                          <th>Qty Diterima</th>
                          <th >Foto Bukti</th>
                        </tr>
                      </thead>
                      <?php 
                      $no=0;
                      foreach ($detail_terima as $d) 
                      { $no++ ?>
                        <tr>
                          <td><?= $no; ?></td>
                          <td>
                            <?= $d->kode; ?>
                            <input type="hidden" name="id_produk[]" value="<?= $d->id; ?>">
                          </td>
                          <td>
                            <?= $d->nama_produk; ?>
                          </td>
                          <td><?= $d->satuan; ?></td>
                          <td>
                            <?= $d->qty_diterima; ?>
                            <input type="hidden" name="qty_diterima[]" value="<?= $d->qty_diterima; ?>" required="">
                          </td>
                          <td>
                            <input type="file" class="form-control" name="foto[]" multiple accept="image/png, image/jpeg, image/jpg" style="background: transparent;" required=""></input>
                          </td>
                        </tr>
                      <?php } ?>
                    </table>
                  </div>
                </div>
                <textarea name="catatan_spg" class="form-control w-50" id="" cols="20" rows="3"  placeholder =" Isi Dengan Kronologi Kehilangan Artikel Disaat Penerimaan"></textarea>
                <button type="submit" class="btn btn-success float-right"><i class="fas fa-save" aria-hidden="true"></i>Kirim BAP</button>
              </form>
            </div>
            <div class="artikel-penerimaan d-none">
              <form method="post" action="<?= base_url('spg/penerimaan/hilang_penerimaan') ?>" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-6">
                    <table>
                      <tr>
                        <td style="width: 35%">
                        No BAP
                        </td>
                        <td>
                          : <?= $no_bap; ?>
                          <input type="hidden" name="bap" value="<?= $no_bap; ?>">    
                        </td>
                      </tr>
                      <tr>
                        <td>Perihal</td>
                        <td>: <input type="text" name="kategori" id="artikel" style="border: none;"></td>
                      </tr>
                      <tr>
                        <td>Nama Toko</td>
                        <td>: <?= $terima->nama_toko; ?>
                          <input type="hidden" name="id_toko" value="<?= $terima->id_toko; ?>">
                        </td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td>: <?= $terima->alamat; ?></td>
                      </tr>
                      <tr>
                        <td>No. Telpon</td>
                        <td>: <?= $terima->telp; ?></td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table>
                      <tr>
                        <th>ID Kirim</th>
                        <th>: <?= $terima->id; ?>
                          <input type="hidden" name="id_kirim" value="<?= $terima->id; ?>">
                        </th>
                      </tr>
                      <tr>
                        <td>Tgl. Terima Barang </td>
                        <td>: <?= $terima->created_at; ?></td>
                      </tr>
                      <tr>
                        <td>Keterangan</td>
                        <td>: <?= $terima->keterangan; ?></td>
                      </tr>
                      <tr>
                        <td>Nama SPG</td>
                        <td>: <?= $user->nama_user; ?></td>
                      </tr>
                    </table>
                  </div>
                  <div class="row col-12">
                    <h3>List Produk</h3>
                    <table class="table table-bordered table-striped">
                      <tr>
                        <th>Kode Artikel #</th>
                        <th>Satuan</th>
                        <th>Qty</th>
                        <th>Action</th>
                      </tr>
                      <?php foreach ($data_cart as $d) { ?>
                      <tr>
                        <td><?= $d['options']; ?></td>
                        <td><?= $d['satuan']; ?></td>
                        <td><?= $d['qty']; ?></td>
                        <td><a href="<?= base_url('spg/permintaan/hapus_cart').$d['rowid'] ?>"><i class="fas fa-trash" aria-hidden="true"></i> Hapus</a></td>
                      </tr>
                      <?php } ?>
                      <tr>
                        <td colspan="4">
                          <button id="btn-tampil" class="btn btn-link btn-block" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-plus"></i>
                             Tambah Item
                          </button>
                          <div class="collapse" id="collapseExample">
                          <form method="post" action="<?= base_url('spg/penerimaan/tambah_cart'); ?>">
                          <h3>Detail Artikel</h3>
                          <div class="form-group">
                            <label>Pilih </label>
                            <select name="id" class="form-control select2bs4" id="id_produk">
                              <option value="">Pilih Artikel</option>
                              <?php foreach ($list_produk as $l) { ?>
                                <option value="<?= $l->id; ?>"><?= $l->kode; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <table class="d-none" id="detail_produk">
                              <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Stok</th>
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
                            <label>Qty</label>
                            <input type="number" name="qty" required="" class="form-control">
                          </div>
                          <div class="form-group">
                            <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Tambahkan Ke List</button>
                          </div>  
                          </form>
                          </div>
                        </td>
                      </tr>
                      <?php if (count($data_cart) > 0) { ?>
                        <tr>
                          <td colspan="5" class="text-right"><a href="#" class="btn btn-primary" id="btn-kirim"><i class="fas fa-check-square"></i> Kirim Permintaan</a></td>
                        </tr>
                      <?php } ?>
                    </table>
                  </div>
                </div>
                <textarea name="catatan_spg" class="form-control w-50" id="" cols="20" rows="3"  placeholder =" Isi Dengan Kronologi Kehilangan Artikel Disaat Penerimaan"></textarea>
                <button type="submit" class="btn btn-success float-right"><i class="fas fa-save" aria-hidden="true"></i>Kirim BAP</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
 <!-- jQuery -->
 <script src="<?php echo base_url()?>/assets/plugins/jquery/jquery.min.js"></script>
<script>
  $(document).ready(function(){
  // table
    $('#table_terima').DataTable({
        order: [[0, 'asc']],
        responsive: true,
        lengthChange: false,
        autoWidth: false,
    });
  // end tabel

  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#kasus").change(function(){
      if ($(this).val() == "Update Penerimaan Artikel"){
      $('.update-penerimaan').removeClass('d-none');
      $('#sub').val($(this).val());
      $('.hilang-penerimaan').addClass('d-none');
      $('.artikel-penerimaan').addClass('d-none');
      }else if($(this).val() == "Artikel Hilang"){
      $('.update-penerimaan').addClass('d-none');
      $('.hilang-penerimaan').removeClass('d-none');
      $('#hilang').val($(this).val());  
      $('.artikel-penerimaan').addClass('d-none');
      }else{
      $('#artikel').val($(this).val());
      $('.update-penerimaan').addClass('d-none');
      $('.hilang-penerimaan').addClass('d-none');
      $('.artikel-penerimaan').removeClass('d-none');
      }
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#btn-tampil').click(function(){
      $('#btn-kirim').toggle();
    })
  });

  $('#btn-kirim').click(function(e){
    e.preventDefault();
    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Data permintaan akan dikirim",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Batal',
      confirmButtonText: 'Yakin'
    }).then((result) => {
      if (result.isConfirmed) {
        location.href = "<?= base_url('spg/penerimaan') ?>";
      }
    })
  })
</script>