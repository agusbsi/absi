<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-store"></i> Pilih Toko</h3>
            </div>
            <div class="card-body">
              <form action="<?= base_url('audit/aset') ?>" method="get">
                  <small class="text-red">Silahkan ketikkan nama toko</small>
                  <div class="form-group">
                    <select class="form-control select2bs4" style="width: 100%;" id="id_toko" name="id_toko" >
                      <option selected="selected" value="">Pilih Toko</option>
                      <?php foreach ($list_toko as $l) { ?>
                      <option value="<?= $l->id ?>"><?= $l->nama_toko?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group text-center">
                    <input class="btn btn-info" type="submit" value="Tampilkan Data">
                  </div>
                </form>
            </div>
        </div>
      </div>
      <div class="col-md-9">
        <div class="card card-info card-outline">
          <?php if($toko != ""){ ?>
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-cog"></i> List Aset di : <?=$toko->nama_toko ?></h3>
              <div class="card-tools">
             
              </div>
            </div>
              <div class="card-body">         
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>ID Aset</th>
                      <th>Nama Aset</th>
                      <th>Qty</th>
                      <th>Keterangan</th>
                      
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list_aset_toko as $row){ ?>
                    <tr>
                        <td><?= $row->id_asset ?></td>
                        <td><?=$row->nama_aset?></td>
                        <td><?=$row->qty?></td>
                        <td><?=$row->keterangan?></td>
                       
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
              </div>
              <!-- end card body -->
              <?php } else {?>
                
                <div class="card-body text-center">
                <span class="text-center text-danger "> <i class="fas fa-store text-danger"></i> Data Toko Kosong, Pilih Toko terlebih dahulu !</span>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
  </div>
</section>

<script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>

<script type="text/javascript">
  $('.btn-aset').click(function(){
    var id = $(this).data('id');
    var nama = $(this).data('nama');
    $('[name=id]').val(id);
    $('[name=nama_toko]').val(nama);
    $('.judul').text(nama);
  })
</script>

