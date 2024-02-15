<section class="contents">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card-tools float-right">
					<a href="<?= base_url('mng_mkt/promo'); ?>" type="button" class="btn btn-tool"><i class="fas fa-times"></i></a>
				</div>
				<div class="callout callout-info">
					<h5><i class="fas fa-info"></i>Note :</h5>
					<div class="row">
						<div class="col-md-6">
							No. Promo : <?= $promo->id; ?>
						</div>
						<div class="col-md-6">
							Status : <?= status_promo($promo->status); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">Berlaku untuk Toko : <br><strong>
							<?= $nama_toko; ?>
						</strong></div>
					</div>
				</div>
	<div id="printtableArea">
		<div class="invoice p-3 mb-3">
			<div class="row">
				<h4><i class="fas fa-file-alt"></i> Detail Artikel Promo</h4>
			</div>
			<div class="row">
				<div class="col-12 table-responsive">
					<table class="table table-striped ">
						<thead>
						  <tr>
							<th>No</th>
							<th>Kode Artikel</th>
							<th>Nama Artikel</th>
							<th>Diskon (%)</th>
						  </tr>
						</thead>
						<tbody>
					<?php 
						$no = 1;
						$t_diskon = "";
						$d_hicoop = $promo->partisipasi_hicoop;
						$d_toko = $promo->partisipasi_toko;
						$t_diskon = $d_hicoop + $d_toko;
						foreach ($nama_produk as $np) { ?>
							<tr>
								<td><?= $no++; ?></td>
								<td>
									<?= $kode_produk[$no-2]; ?>
								</td>
								<td><?= $np; ?></td>
								<td><?= $t_diskon; ?></td>
							</tr>
					<?php } ?>
						</tbody>
					</table>
					<div class="row float-right">
						<a href="<?= base_url('mng_mkt/promo'); ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
					</div>
				</div>
			</div>
		</div>
	</div>
			</div>
		</div>
	</div>
</section>