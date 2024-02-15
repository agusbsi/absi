<tr class="row-keranjang">
	<td class="kode_produk">
		<?= $this->input->post('kode_produk') ?>
		<input type="hidden" name="id_produk_hidden[]" id="kode_produk" value="<?= $this->input->post('id_produk') ?>">
	</td>
	<td class="nama_produk">
		<?= $this->input->post('nama_produk') ?>
	</td>
	<td class="satuan">
		<?= $this->input->post('satuan') ?>
	</td>
	<td class="aksi">
		<button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-nama-barang="<?= $this->input->post('id_produk') ?>"><i class="fa fa-trash"></i></button>
	</td>
</tr>