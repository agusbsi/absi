<section class="content">
  <div class="container-fluid">
    <div class="callout callout-danger">
      <div class="row">
      <?php if ($detail_promo->status == 0) { ?>
        <div class="col-md-6">
        <h5><i class="fas fa-info "></i> Status Promo : <span class="badge badge-danger"> Promo Belum Aktif </span></h5>
              Promo ini menunggu persetujuan : <?= status_promo($detail_promo->status) ?>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('adm/promo/tolak/'.$detail_promo->id) ?>" class="btn btn-danger mr-3"><h6 style="color: white;"><i class="fa fa-times-circle" aria-hidden="true"></i> Tolak</h6></a>
          <a href="<?= base_url('adm/promo/approve/'.$detail_promo->id) ?>" class="btn btn-success mr-3"><h6 style="color: white;"><i class="fa fa-check-circle" ></i> Approve</h6></a>
        </div>
    <?php }elseif ($detail_promo->status == 1) { ?>
      <div class="col-md-6">
        <h5><i class="fas fa-info "></i> Status Promo : <span class="badge badge-success"> Promo Sedang Aktif </span></h5>
      </div>
    <?php }else{ ?>
      <div class="col-md-6">
        <h5><i class="fas fa-info "></i> Status Promo : <span class="badge badge-info"> Promo Tidak Aktif </span></h5>
      </div>
    <?php } ?>
      </div>

    </div>
    <div class="row">
      <div class="col-12">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <table class="table table-bordered">
              <tr>
                <th style="width: 20%">Judul Promo</th>
                <th> : <?= $detail_promo->judul; ?></th>
              </tr>
              <tr>
                <th>Untuk Toko</th>
                <th> : <?= $detail_promo->nama_grup; ?></th>
              </tr>
              <tr>
                <th>Berlaku dari tanggal</th>
                <th> : <?= format_tanggal1($detail_promo->tgl_mulai); ?></th>
              </tr>
              <tr>
                <th>Berakhir pada tanggal</th>
                <th> : <?= format_tanggal1($detail_promo->tgl_selesai); ?></th>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="card-header">
              <div class="text-center">
                <h3>Detail Promo Yang Diajukan :</h3>
               <?= $detail_promo->content; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="card-body">
              <div class="text-center">
                <h3>Detail Syarat dan Ketentuan Yang Berlaku :</h3>
               <?= $detail_promo->sk; ?>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
