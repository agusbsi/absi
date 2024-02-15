<!DOCTYPE html>
<html lang="en">

<head>
	<title></title>
	<style>
		.str{
			mso-number-format:\@;
		}
	</style>
	<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data Pegawai.xls");
	?>
</head>
<body>
	<table border="1" cellpadding="5">
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
		<?php 
			$no = 1;
			foreach ($list_data as $row) {
		 ?>
		<tr>
			<td class="str"><?= $row['no_so'] ?></td>
			<td class="str"><?= $row['no_pelanggan'] ?></td>
			<td class="str"><?= $row['deskripsi'] ?></td>
			<td class="str"><?= $row['tanggalfaktur'] ?></td>
			<td class="str"><?= $row['nilai_tukar'] ?></td>
			<td class="str"><?= $row['nilai_tukar_pajak'] ?></td>
			<td class="str"><?= $row['syarat'] ?></td>
			<td class="str"><?= $row['kirim_melalui'] ?></td>
			<td class="str"><?= $row['fob'] ?></td>
			<td class="str"><?= $row['diskon_faktur'] ?></td>
			<td class="str"><?= $row['persentase_diskon_faktur'] ?></td>
			<td class="str"><?= $row['rancangan'] ?></td>
			<td class="str"><?= $row['no_po'] ?></td>
			<td class="str"><?= $row['kirim_ke'] ?></td>
			<td class="str"><?= $row['penjual'] ?></td>
			<td class="str"><?= $row['pengguna'] ?></td>
			<td class="str"><?= $row['tgl_kirim'] ?></td>
			<td class="str"><?= $row['termasuk_pajak'] ?></td>
			<td class="str"><?= $row['no_barang'] ?></td>
			<td class="str"><?= $row['qty'] ?></td>
			<td class="str"><?= $row['harga_satuan'] ?></td>
			<td class="str"><?= $row['kode_pajak'] ?></td>
			<td class="str"><?= $row['diskon_barang'] ?></td>
			<td class="str"><?= $row['satuan'] ?></td>
			<td class="str"><?= $row['departemen'] ?></td>
			<td class="str"><?= $row['proyek'] ?></td>
		</tr>
		<?php } ?>
	</table>
</body>