<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <?php
                foreach ($list_group as $p) :
            ?>    
           <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Nama Group:</h5>
             <strong> <?= $p->nama_grup ?></strong>
           </div>

            <!-- print area -->
            <div id="printableArea">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
              <h4><li class="fas fa-store"></li> List Toko </h4>
              </div>
         
              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Toko</th>
                      <th>Alamat</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                            $no = 0;
                    
                            foreach ($list_toko as $d) {
                            $no++; 
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $d->nama_toko ?></td>
                                <td><?= $d->alamat ?></td>
                            </tr>
                        <?php 
                 
                            } 
                        ?>
                    </tbody>
                   
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

            <?php
            endforeach
            ?>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>



