<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-cart-plus"></i> <?= $title ?></h3>
          </div>
            <div class="card-body">
              <h3>Data Penjualan Barang</h3>
              <form action="<?= base_url('template/Sales_order') ?>" method="get">
                <small class="text-red">Silahkan pilih tanggal terlebih dahulu untuk menampilkan data berdasarkan tanggal.</small>
                <div class="form-group">
                  <label>Dari</label>
                  <input class="form-control col-md-3" type="date" name="tgl_awal" value="<?= $this->input->get('tgl_awal') ?>">
                </div>
                <div class="form-group">
                  <label>Sampai</label>
                  <input class="form-control col-md-3" type="date" name="tgl_akhir" value="<?= $this->input->get('tgl_akhir') ?>">
                </div>
                <div class="form-group">
                  <input class="btn btn-success" type="submit" value="Tampilkan Data">
                </div>
              </form>
              <div class="row">
              </div>
              <hr>
              <!-- <div class="<?= ($sales_order) ? '' : 'd-none' ?>"> -->
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No. Faktur</th>
                      <th>No. Pelanggan</th>
                      <th>Deskripsi</th>
                      <th>Tanggal</th>
                      <th>Nilai Tukar</th>
                      <th>Nilai Tukar Pajak</th>
                      <th>Syarat</th>
                      <th>Kirim Melalui</th>
                      <th>FOB</th>
                      <th>Diskon Faktur</th>
                      <th>Diskon Faktur (%)</th>
                      <th>Rancangan</th>
                      <th>No. PO</th>
                      <th>Kirim Ke</th>
                      <th>Penjual</th>
                      <th>Pengguna</th>
                      <th>Est. Tgl. Kirim</th>
                      <th>Termasuk Pajak</th>
                      <th>No. Barang</th>
                      <th>Qty</th>
                      <th>Harga Satuan</th>
                      <th>Kode Pajak</th>
                      <th>Diskon Barang</th>
                      <th>Satuan</th>
                      <th>Department</th>
                      <th>Proyek</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($list_penjualan as $row){ ?>
                  <tr>
                      <td><?= $row->id_penjualan ?></td>
                      <td><?= $row->nama_toko ?></td>
                      <td></td>
                      <td><?= $row->tanggal_transaksi ?></td>
                      <td>1,00</td>
                      <td>1,00</td>
                      <td>C.O.D</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Salaes Order</td>
                      <td><?= $row->id_penjualan ?></td>
                      <td></td>
                      <td></td>
                      <td>ADMINISTRATOR</td>
                      <td></td>
                      <td></td>
                      <td><?= $row->kode ?></td>
                      <td><?= $row->qty ?></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


