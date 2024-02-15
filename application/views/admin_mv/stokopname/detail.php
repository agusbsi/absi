<?php
$tgl_awal = $this->input->get('tgl_awal');
$tgl_akhir = $this->input->get('tgl_akhir');
$id_toko = $this->input->get('id_toko');
?>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-info card-outline">
          <div class="card-body box-profile">
            <div class="text-center">

          <?php if($toko->foto=="") { 
            ?>
            <img style="width: 100%;" class="profile-user-img img-responsive img-rounded" src="<?php echo base_url()?>assets/img/toko/hicoop.png" alt="User profile picture">
            <?php
            }else{ ?>
            <img style="width: 100%;" class="profile-user-img img-responsive img-rounded" src="<?php echo base_url('assets/img/user.png')?>" alt="User profile picture">
          <?php } ?> 
            </div>

            <h3 class="profile-username text-center"><strong><?=$toko->nama_toko?></strong></h3>

            <p class="text-muted text-center">[ ID : <?=$toko->id?> ]</p>

            <div class="card-body">
              <strong><i class="fa fa-map"></i> Alamat</strong>
              <p class="text-muted"><?=$toko->alamat?></p>
              <hr>
              <strong><i class="fa fa-phone"></i> Telp</strong>
              <p class="text-muted"><?=$toko->telp?></p>
              <hr>
              <strong><i class="fa fa-list"></i> Deskripsi</strong>
              <p class="text-muted"><?=$toko->deskripsi?></p>
              <hr>
              <strong><i class="fa fa-calendar-week"></i> Tanggal SO</strong>
              <p class="text-muted"><?= format_tanggal1($toko->tgl_so) ?></p>
              <hr>
                <div class="text-center">
                
                </div>
            </div>

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
        <div class="col-md-9">
          <div class="card card-info card-outline">
            <div class="card-header p-0 pt-1">
              <div class="card-body">
                 <form action="<?= base_url('adm_mv/so/detail') ?>" method="get">
                <small class="text-red">Silahkan pilih tanggal terlebih dahulu untuk menampilkan data berdasarkan tanggal.</small>
                <div class="form-group">
                  <label>Dari</label>
                  <input type="hidden" name="id_toko" value="<?= $id_toko ?>">
                  <input class="form-control col-md-3" type="date" name="tgl_awal" value="<?= $tgl_awal ?>">
                </div>
                <div class="form-group">
                  <label>Sampai</label>
                  <input class="form-control col-md-3" type="date" name="tgl_akhir" value="<?= $tgl_akhir ?>">
                </div>
                <div class="form-group">
                  <input class="btn btn-success" type="submit" value="Tampilkan Data">
                </div>
              </form>
              <div class="row">
              </div>
              <hr>
              <div class="<?= ($list_data) ? '' : 'd-none' ?>">
                <table id="" class="table table-bordered table-striped" >
                  <thead>
                  <tr>
                    <th>Tanggal Stok Opname</th>
                    <th>No. SO</th>
                    <th>Nama Toko</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($list_data as $row){ ?>
                  <tr>
                      <td><?= date("M-Y",strtotime($row->created_at)) ?></td>
                      <td><?=$row->id?></td>
                      <td><?=$row->nama_toko?></td>
                      <td>                    
                        <a type="button" class="btn btn-default" target="_blank"  href="<?=base_url('adm_mv/so/detail_so/'.$row->id)?>" style="margin-right: 5px;"><i class="fa fa-print" aria-hidden="true"></i> </a>
                      </td>
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

<script>
  function printDiv(divName) {
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
  }
</script>

          <!-- <select class="form-control" name="periode">
                      <option selected="">Pilih Periode SO</option>
                    <?php foreach ($list_so as $ls) { ?>
                      <option value="<?= $ls->created_at ?>"><?= date("M-Y", strtotime($ls->created_at)) ?></option>
                    <?php } ?>  
                    
                  </select> -->