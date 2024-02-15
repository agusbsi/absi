<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-info ">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-store"></i> List Toko yang anda kelola</b> </h3>
          </div>
            <div class="card-body">
            <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-right">
                      <div class="btn-group">
                        <button type="button" class="btn btn-outline-success"> <i class="fas fa-plus"></i> Tambah Toko</button>
                        <button type="button" class="btn btn-success dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" href="#" data-toggle="modal"  data-target="#modal-tambah">Customer Baru</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#" data-toggle="modal"  data-target=".cabang">Cabang</a>
                        </div>
                      </div>
                    </div>
                </div>
                <hr>
              <form action="<?= base_url('spg/Aset/simpan'); ?>" method ="post">
              <table id="table_toko" class="table table-bordered table-striped">
                <thead>
                <tr class="text-center">
                  <th style="width:5%">No</th>
                  <th style="width:20%">Nama Toko</th>
                  <th style="width:25%">Alamat</th>
                  <th style="width:15%">Team Leader</th>
                  <th>Status</th>
                  <th style="width:13%">Menu</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 0;
                    foreach($toko as $t):
                      $no++
                  ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $t->nama_toko ?></td>
                    <td><?= $t->alamat ?></td>
                    <td class="text-center">
                    <?php
                        if ($t->nama_user == ""){
                          echo "<span class='badge badge-warning'> Belum dikaitkan</span>";
                        }else{
                          echo $t->nama_user ;
                        }
                      ?>
                     
                    </td>
                    <td class="text-center">
                    <?= status_toko($t->status) ?>
                    </td>
                    <td>
                      <a href ="<?= base_url('spv/Toko/profil/'.$t->id) ?>" class="btn btn-warning btn-sm"> <i class="fas fa-cog"></i> Configurasi</a>
                    </td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
            <div class="card-footer text-center ">
          
            </div>
            </form>
          </div>
        </div>
     
      </div>
    </div>
  </div>
</section>
  <!-- modal tambah customer baru -->
  <div class="modal fade" id="modal-tambah">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"> <li class="fas fa-plus-circle"></li> Form Pengajuan Toko Customer Baru</h4>
                    <button
                      type="button"
                      class="close"
                      data-dismiss="modal"
                      aria-label="Close"
                    >
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                  <form method="POST" action="<?= base_url('spv/toko/proses_tambah_baru')?>" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-4">
                        <label for=""><li class="fas fa-hotel"></li> | # Data Customer</label>
                        <hr>
                      <div class="form-group">
                        <p class="mb-0">Nomor Customer :</p>
                        <input type="text" name="kode_customer" class="form-control" placeholder=" Contoh : KS00001" required="">
                      </div>
                      <div class="form-group">
                        <p class="mb-0">Nama Customer :</p>
                        <input type="text" name="customer" class="form-control" placeholder=" Contoh : Hyper Mart xxx xxx" required>
                      </div>
                      <div class="form-group">
                        <p class="mb-0">PIC:</p>
                        <input type="text" name="pic_cust" class="form-control" placeholder=" Masukan nama PIC" >
                      </div>
                      <div class="form-group">
                        <p class="mb-0">Telp:</p>
                        <input type="number" name="telp_cust" class="form-control" placeholder="No Telephone" required>
                      </div>
                      <div class="form-group">
                        <p class="mb-0">Wajib Pajak ?</p>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="pajak" value="1" checked>
                          <label class="form-check-label">PKP</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="pajak" value="2" >
                          <label class="form-check-label">NON-PKP</label>
                        </div>
                      </div>
                        <div class="form-group">
                          <p class="mb-0">Foto NPWP :</p>
                          <input type="file" class="form-control" name="foto_npwp" multiple accept="image/png, image/jpeg, image/jpg" ></input>
                          <small>Jenis foto yang di perbolehkan : JPG,JPEG,PNG & Maksimal : 2 mb.</small>
                        </div>
                        <div class="form-group">
                          <p class="mb-0">Foto KTP :</p>
                          <input type="file" class="form-control" name="foto_ktp" multiple accept="image/png, image/jpeg, image/jpg"></input>
                          <small>Opsional</small> | <small>Jenis foto yang di perbolehkan : JPG,JPEG,PNG & Maksimal : 2 mb.</small>
                        </div>
                         <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <p class="mb-0">Jatuh Tempo / T.O.P :</p>
                            <div class="input-group">
                              <input type="number" name="top" class="form-control" placeholder="T.O.P " min="0" required>
                              <div class="input-group-append">
                                <span class="input-group-text"> Hari</span>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <p class="mb-0">Terhitung dari :</p>
                            <div class="input-group">
                            <select name="tagihan" class="form-control select2bs4" required>
                            <option value="Tanggal Invoice"> Tanggal Invoice </option>
                            <option value="Tanggal LPT"> Tanggal LPT </option>
                          </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label > Alamat Customer</label>
                        <textarea class="form-control" name="alamat_cust"  placeholder="cth : Jl. pangeran jayakarta ...." required></textarea>
                        <small>Alamat yang digunakan untuk penagihan.</small>
                      </div>
                     
                      
                      </div>
                      <div class="col-md-1">
                        
                      </div>
                      <div class="col-md-7">
                        <label for=""><li class="fas fa-store"></li> | # Data Toko</label>
                        <hr>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <p class="mb-0">Nama Toko :</p>
                              <input type="text" name="nama_toko" class="form-control" placeholder="Masukan nama Toko " required>
                            </div>
                            <div class="form-group">
                              <p class="mb-0">Jenis Toko :</p>
                              <select name="jenis_toko" class="form-control select2bs4" required="">
                                <option value="">Pilih Jenis Toko</option>
                                  <option value="1">Dept Store</option>
                                  <option value="6">Hypermarket</option>
                                  <option value="2">Supermarket</option>
                                  <option value="3">Grosir</option>
                                  <option value="4">Minimarket</option>
                                  <option value="5">Lain-lain.</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <p class="mb-0">Potensi Sales :</p>
                              <div class="row">
                                <div class="col-md-4 text-center">
                                  <small> <strong> RIDER</strong></small>
                                  <input type="number" name="s_rider" class="form-control" placeholder="cth : 3000000" min="0" required>
                                  <small class="mb-0">Tanpa titik / koma</small>
                                </div>
                                <div class="col-md-4 text-center">
                                  <small> <strong> GT-MAN</strong></small>
                                  <input type="number" name="s_gtman" class="form-control" placeholder="cth : 3000000" min="0" required>
                                  <small>Tanpa titik / koma</small>
                                </div>
                                <div class="col-md-4 text-center">
                                  <small> <strong> CROCODILE</strong></small>
                                  <input type="number" name="s_crocodile" class="form-control" placeholder="cth : 3000000" min="0" required>
                                  <small>Tanpa titik / koma</small>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <p class="mb-0">Target sales Toko :</p>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Rp </span>
                                </div>
                                <input type="number" name="target" class="form-control" placeholder="Masukan Target Toko " min="0" required>
                                <div class="input-group-append">
                                  <span class="input-group-text"> / Bulan</span>
                                </div>
                              </div>
                              <small>Tanpa titik / koma</small>
                            </div>
                            <div class="form-group">
                              <p class="mb-0">Provinsi :</p>
                                <select name="provinsi" class="form-control select2bs4" id="provinsi" required>
                                  <option value=''>- Pilih Provinsi -</option>
                                  <?php 
                                    foreach($provinsi as $prov)
                                    {
                                      echo '<option value="'.$prov->id.'">'.$prov->nama.'</option>';
                                    }
                                  ?>
                                </select>
                            </div>
                            <div class="form-group">
                              <p class="mb-0">Kabupaten :</p>
                                <select name="kabupaten" class="form-control select2bs4" id="kabupaten" required>
                                  <option value=''>- Pilih Kabupaten -</option>
                                </select>
                            </div>
                            <div class="form-group">
                              <p class="mb-0">Kecamatan :</p>
                                <select name="kecamatan" class="form-control select2bs4" id="kecamatan" required>
                                  <option>- Pilih Kecamatan -</option>
                                </select>
                            </div>
                            <div class="form-group">
                              <p class="mb-0">Alamat Toko :</p>
                              <textarea class="form-control" name="alamat" id="deskripsi" placeholder="cth : Jl. pangeran jayakarta ...." required></textarea>
                              <small>Alamat ini digunakan untuk tujuan pengiriman barang.</small>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <p class="mb-0">Foto Toko :</p>
                              <input type="file" class="form-control" name="foto_toko" multiple accept="image/png, image/jpeg, image/jpg" required></input>
                              <small>Tampak Depan</small> | <small>Jenis foto yang di perbolehkan : JPG,JPEG,PNG & Maksimal : 2 mb.</small>
                            </div>
                            <div class="form-group">
                              <p class="mb-0">Kepala Toko :</p>
                              <input type="text" name="nama_pic" class="form-control" placeholder="Masukan nama PIC / Penanggung jawab" required>
                            </div>
                            <div class="form-group">
                              <p class="mb-0">No. HP / WhatsApp :</p>
                              <input type="number" class="form-control" name="nohp" placeholder="Nomor Handphone / WhatsApp" required=""></input>
                            </div>
                            <div class="form-group">
                              <p class="mb-0">Foto Kepala Toko :</p>
                              <input type="file" class="form-control" name="foto_pic" multiple accept="image/png, image/jpeg, image/jpg" required=""></input>
                              <small>Jenis foto yang di perbolehkan : JPG,JPEG,PNG & Maksimal : 2 mb.</small>
                            </div>
                            <div class="form-group">
                              <label>Tanggal Stok Opname (SO):</label>
                              <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <select name="tgl_so" class="form-control" required>
                                  <option value="">- Pilih Tgl SO -</option>
                                  <?php
                                  $limit = 15;
                                  for($i=1; $i <= $limit; $i++)
                                  {
                                    echo "<option value='$i'>$i</option>";
                                  }
                                  ?>
                                  
                                </select>
                                  <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text">/ Bulan</div>
                                  </div>
                              </div>
                            </div>
                           <div class="form-group">
                              <label>Diskon %</label>
                              <div class="input-group my-colorpicker2">
                                      <input type="text" class="form-control" id="diskon1" name="diskon" autocomplete ="off" placeholder="contoh : 23.6" required>
                                      <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                      </div>
                                    </div>
                              <small>* untuk nilai decimal menggunakan titik (.)</small>
                            </div>
                            <div class="form-group">
                              <label>HARGA HET</label>
                              <select name="het" class="form-control" id="" required>
                                <option value="">- Pilih Type Harga -</option>
                                <option value="1">HET JAWA</option>
                                <option value="2">HET INDOBARAT</option>
                              </select>
                            </div>
                            <hr>
                            <label for=""># Sistem Aplikasi</label>
                            <hr>
                            <div class="form-group">
                              <li class="fas fa-user"></li><label for="kode" > Team Leader</label>
                              <select name="id_leader" class="form-control select2bs4" required="">
                                <option value="">Pilih Team Leader</option>
                                <?php foreach ($list_leader as $l) { ?>
                                  <option value="<?= $l->id ?>"><?= $l->nama_user ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <li class="fas fa-user"></li><label for="kode" > SPG </label>
                              <select name="id_spg" class="form-control select2bs4">
                                <option value="0"> - Belum ada SPG -</option>
                                <?php foreach ($list_spg as $l) { ?>
                                  <option value="<?= $l->id ?>"><?= $l->nama_user ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                        </div>
                      
                      </div>
                    </div>
                  
                  </div>
                  <div class="modal-footer float-right">
                    <button
                      type="button"
                      class="btn btn-danger"
                      data-dismiss="modal"
                    >
                    <li class="fas fa-times-circle"></li> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                    <li class="fas fa-save"></li> Simpan
                    </button>
                  </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <!-- modal tambah cabang -->

<div class="modal fade cabang" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> <li class="fas fa-store"></li> Form Pengajuan Toko Cabang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="<?= base_url('spv/toko/proses_cabang')?>" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="form-group">
          <p class="mb-0">Nama Customer :</p>
            <select name="id_customer" class="form-control select2bs4" id="customer" required>
              <option value="">- Pilih customer -</option>
              <?php foreach($customer as $c): ?>
                <option value="<?= $c->id ?>"><?= $c->nama_cust ?></option>
              <?php endforeach ?>
            </select>
        </div>
        <hr>
        <label for=""># Data Toko Cabang</label>
        <hr>
        <!-- data toko -->
        <div class="row d-none" id="data_toko">
                          <div class="col-md-5">
                            <div class="form-group">
                              <p class="mb-0">Nama Toko :</p>
                              <input type="text" name="nama_toko" class="form-control" placeholder="Masukan nama Toko " required>
                            </div>
                            <div class="form-group">
                              <p class="mb-0">Jenis Toko :</p>
                              <select name="jenis_toko" class="form-control select2bs4" required="">
                                <option value="">Pilih Jenis Toko</option>
                                  <option value="1">Dept Store</option>
                                  <option value="6">Hypermarket</option>
                                  <option value="2">Supermarket</option>
                                  <option value="3">Grosir</option>
                                  <option value="4">Minimarket</option>
                                  <option value="5">Lain-lain.</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <p class="mb-0">Potensi Sales :</p>
                              <div class="row">
                                <div class="col-md-4 text-center">
                                  <small> <strong> RIDER</strong></small>
                                  <input type="number" name="s_rider" class="form-control" placeholder="cth : 3000000" min="0" required>
                                  <small class="mb-0">Tanpa titik / koma</small>
                                </div>
                                <div class="col-md-4 text-center">
                                  <small> <strong> GT-MAN</strong></small>
                                  <input type="number" name="s_gtman" class="form-control" placeholder="cth : 3000000" min="0" required>
                                  <small>Tanpa titik / koma</small>
                                </div>
                                <div class="col-md-4 text-center">
                                  <small> <strong> CROCODILE</strong></small>
                                  <input type="number" name="s_crocodile" class="form-control" placeholder="cth : 3000000" min="0" required>
                                  <small>Tanpa titik / koma</small>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <p class="mb-0">Target sales Toko :</p>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Rp </span>
                                </div>
                                <input type="number" name="target" class="form-control" placeholder="Masukan Target Toko " min="0" required>
                                <div class="input-group-append">
                                  <span class="input-group-text"> / Bulan</span>
                                </div>
                              </div>
                              <small>Tanpa titik / koma</small>
                            </div>
                            <div class="form-group">
                              <p class="mb-0">Provinsi :</p>
                                <select name="provinsi" class="form-control select2bs4" id="provinsi_toko" required>
                                  <option>- Pilih Provinsi -</option>
                                  <?php 
                                    foreach($provinsi as $prov)
                                    {
                                      echo '<option value="'.$prov->id.'">'.$prov->nama.'</option>';
                                    }
                                  ?>
                                </select>
                            </div>
                            <div class="form-group">
                              <p class="mb-0">Kabupaten :</p>
                                <select name="kabupaten" class="form-control select2bs4" id="kabupaten_toko" required>
                                  <option value=''>- Pilih Kabupaten -</option>
                                </select>
                            </div>
                            <div class="form-group">
                              <p class="mb-0">Kecamatan :</p>
                                <select name="kecamatan" class="form-control select2bs4" id="kecamatan_toko" required>
                                  <option>- Pilih Kecamatan -</option>
                                </select>
                            </div>
                            <div class="form-group">
                              <p class="mb-0">Alamat Toko :</p>
                              <textarea class="form-control" name="alamat" id="deskripsi" placeholder="cth : Jl. pangeran jayakarta ...." required></textarea>
                              <small>Alamat ini digunakan untuk tujuan pengiriman barang.</small>
                            </div>
                          </div>
                          <div class="col-md-2"></div>
                          <div class="col-md-5">
                            <div class="form-group">
                              <p class="mb-0">Foto Toko :</p>
                              <input type="file" class="form-control" name="foto_toko" multiple accept="image/png, image/jpeg, image/jpg" required></input>
                              <small>Tampak Depan</small> | <small>Jenis foto yang di perbolehkan : JPG,JPEG,PNG & Maksimal : 2 mb.</small>
                            </div>
                            <div class="form-group">
                              <p class="mb-0">Kepala Toko :</p>
                              <input type="text" name="nama_pic" class="form-control" placeholder="Masukan nama PIC / Penanggung jawab" required>
                            </div>
                            <div class="form-group">
                              <p class="mb-0">No. HP / WhatsApp :</p>
                              <input type="number" class="form-control" name="nohp" placeholder="Nomor Handphone / WhatsApp" required=""></input>
                            </div>
                            <div class="form-group">
                              <p class="mb-0">Foto Kepala Toko :</p>
                              <input type="file" class="form-control" name="foto_pic" multiple accept="image/png, image/jpeg, image/jpg" required=""></input>
                              <small>Jenis foto yang di perbolehkan : JPG,JPEG,PNG & Maksimal : 2 mb.</small>
                            </div>
                            <div class="form-group">
                              <label>Tanggal Stok Opname (SO):</label>
                              <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <select name="tgl_so" class="form-control" required>
                                  <option value="">- Pilih Tgl SO -</option>
                                  <?php
                                  $limit = 15;
                                  for($i=1; $i <= $limit; $i++)
                                  {
                                    echo "<option value='$i'>$i</option>";
                                  }
                                  ?>
                                  
                                </select>
                                  <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text">/ Bulan</div>
                                  </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label>Diskon %</label>
                              <div class="input-group my-colorpicker2">
                                      <input type="text" class="form-control" name="diskon" id="diskon2" autocomplete ="off" placeholder="contoh : 23.6" required>
                                      <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                      </div>
                                    </div>
                              <small>* untuk nilai decimal menggunakan titik (.)</small>
                            </div>
                            <div class="form-group">
                              <label>HARGA HET</label>
                              <select name="het" class="form-control" id="" required>
                                <option value="">- Pilih Type Harga -</option>
                                <option value="1">HET JAWA</option>
                                <option value="2">HET INDOBARAT</option>
                              </select>
                            </div>
                            <hr>
                            <label for=""># Sistem Aplikasi</label>
                            <hr>
                            <div class="form-group">
                              <li class="fas fa-user"></li><label for="kode" > Team Leader</label>
                              <select name="id_leader" class="form-control select2bs4" required="">
                                <option value="">Pilih Team Leader</option>
                                <?php foreach ($list_leader as $l) { ?>
                                  <option value="<?= $l->id ?>"><?= $l->nama_user ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <li class="fas fa-user"></li><label for="kode" > SPG </label>
                              <select name="id_spg" class="form-control select2bs4">
                                <option value="0"> - Belum ada SPG -</option>
                                <?php foreach ($list_spg as $l) { ?>
                                  <option value="<?= $l->id ?>"><?= $l->nama_user ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
        </div>
        <!-- end data toko -->
      </div>
      <div class="modal-footer float-right">
        <button type="button" class="btn btn-danger" data-dismiss="modal" >
          <li class="fas fa-times-circle"></li> Cancel
        </button>
        <button type="submit" class="btn btn-primary">
          <li class="fas fa-save"></li> Simpan
        </button>
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
	            $("#provinsi").change(function (){
	                var url = "<?php echo base_url('spv/Toko/add_ajax_kab');?>/"+$(this).val();
	                $('#kabupaten').load(url);
	                return false;
	            })
	   
              $("#kabupaten").change(function (){
                      var url = "<?php echo base_url('spv/Toko/add_ajax_kec');?>/"+$(this).val();
                      $('#kecamatan').load(url);
                      return false;
                  })

              // ketika customer di pilih
              $("#customer").change(function (){
                var $nilai = $(this).val();
                if ($nilai != "")
                {
                  $('#data_toko').removeClass('d-none');
                }else 
                {
                  $('#data_toko').addClass('d-none');
                }
	            })
              $("#provinsi_toko").change(function (){
	                var url = "<?php echo base_url('spv/Toko/add_ajax_kab');?>/"+$(this).val();
	                $('#kabupaten_toko').load(url);
	                return false;
	            })
              $("#kabupaten_toko").change(function (){
	                var url = "<?php echo base_url('spv/Toko/add_ajax_kec');?>/"+$(this).val();
	                $('#kecamatan_toko').load(url);
	                return false;
	            })
	        });
          
    	</script>
  <script>
    $(document).ready(function(){
    
      $('#table_toko').DataTable({
          order: [[0, 'asc']],
          responsive: true,
          lengthChange: false,
          autoWidth: false,
      });

 // Mengambil elemen input diskon dari halaman HTML
      const inputDiskon = document.getElementById('diskon1');
      const inputDiskon2 = document.getElementById('diskon2');
      // non aktif huruf dan koma
      inputDiskon.addEventListener('keydown', function(event) {
        if ((event.keyCode >= 65 && event.keyCode <= 90) || (event.keyCode == 188)) {
          event.preventDefault();
        }
      });
      // non aktif huruf dan koma
      inputDiskon2.addEventListener('keydown', function(event) {
        if ((event.keyCode >= 65 && event.keyCode <= 90) || (event.keyCode == 188)) {
          event.preventDefault();
        }
      });
    
    })
  </script>


