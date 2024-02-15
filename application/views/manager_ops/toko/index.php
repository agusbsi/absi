<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-info ">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-store"></i> Semua toko aktif</b> </h3>
          </div>
          <div class="card-body">
            <table id="table_toko" class="table table-bordered table-striped">
              <thead>
                <tr class="text-center">
                  <th style="width:4%">No</th>
                  <th style="width:22%">Nama Toko</th>
                  <th>Alamat</th>
                  <th style="width:15%">spg</th>
                  <th style="width:10%">Tgl dibuat</th>
                  <th style="width:10%">Menu</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 0;
                foreach ($toko as $t) :
                  $no++
                ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td>
                      <?= $t->nama_toko ?>
                    </td>
                    <td>
                      <address><?= $t->alamat ?></address>
                    </td>
                    <td class="text-center">
                      <?php
                      if ($t->nama_user == "") {
                        echo "<span class='badge badge-warning'> Belum dikaitkan</span>";
                      } else {
                        echo $t->nama_user;
                      }
                      ?>
                    </td>
                    <td class="text-center"><?= $t->created_at ?></td>
                    <td>
                      <a href="<?= base_url('mng_ops/Dashboard/toko_detail/' . $t->id) ?>" class="btn btn-info btn-sm"> <i class="fas fa-eye"></i> Detail</a>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
  </div>
</section>
<!-- jQuery -->
<script src="<?php echo base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
<script>
  $(document).ready(function() {

    $('#table_toko').DataTable({
      order: [
        [0, 'asc']
      ],
      responsive: true,
      lengthChange: false,
      autoWidth: false,
    });


  })
</script>