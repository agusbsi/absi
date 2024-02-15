<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-info ">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-store"></i> Data Toko Konsinyasi</b> </h3>
          </div>
          <div class="card-body">
            <form action="<?= base_url('spg/Aset/simpan'); ?>" method="post">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr class="text-center">
                    <th style="width:5%">No</th>
                    <th style="width:25%">Nama Toko</th>
                    <th style="width:35%">Alamat</th>
                    <th>SPV</th>
                    <th>Team Leader</th>
                    <th>SPG</th>
                    <th>Status</th>
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
                      <td><?= $t->nama_toko ?></td>
                      <td><?= $t->alamat ?></td>
                      <td class="text-center">
                        <?php
                        if ($t->spv == "") {
                          echo "<span class='badge badge-warning'> Belum dikaitkan</span>";
                        } else {
                          echo $t->spv;
                        }
                        ?>

                      </td>
                      <td class="text-center">
                        <?php
                        if ($t->leader == "") {
                          echo "<span class='badge badge-warning'> Belum dikaitkan</span>";
                        } else {
                          echo $t->leader;
                        }
                        ?>

                      </td>
                      <td class="text-center">
                        <?php
                        if ($t->spg == "") {
                          echo "<span class='badge badge-warning'> Belum dikaitkan</span>";
                        } else {
                          echo $t->spg;
                        }
                        ?>

                      </td>
                      <td class="text-center">
                        <?= status_toko($t->status) ?>
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

<!-- jQuery -->
<script src="<?php echo base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $("#provinsi").change(function() {
      var url = "<?php echo base_url('spv/Toko/add_ajax_kab'); ?>/" + $(this).val();
      $('#kabupaten').load(url);
      return false;
    })

    $("#kabupaten").change(function() {
      var url = "<?php echo base_url('spv/Toko/add_ajax_kec'); ?>/" + $(this).val();
      $('#kecamatan').load(url);
      return false;
    })
  });
</script>
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