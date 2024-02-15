     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
    
            <!-- /.card -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-hospital"></li> Data Detail</h3>
                  <div class="card-tools">
                    <a href="<?= base_url('audit/Customer') ?>" type="button" class="btn btn-tool" >
                      <i class="fas fa-times"></i>
                    </a>
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <div class="row">
                <div class="col-md-3">
                  <div class="callout callout-danger text-center">
                    <strong><?= $customer->nama_cust?></strong>
                    <br>
                    [ ID : <?= $customer->id ?> ]
                  </div>
                </div>
                <div class="col-md-9">
                <div class="card card-primary card-outline card-outline-tabs">
                  <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Alamat</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">PIC & Telp</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">T.O.P & Tagihan</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Berkas</a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                      <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                        <div class="form-group">
                          <textarea name="c" class="form-control" readonly id="" cols="1" rows="3">
                            <?= $customer->alamat_cust ?>
                          </textarea>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                      <div class="forn-group">
                        <label for="">Nama PIC :</label>
                        <input type="text" class="form-control" value="<?= $customer->nama_pic ?>" readonly>
                      </div> 
                      <div class="forn-group">
                        <label for="">Telp :</label>
                        <input type="text" class="form-control" value="<?= $customer->telp ?>" readonly>
                      </div> 
                      </div>
                      <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                       <div class="forn-group">
                        <label for="">T.O.P :</label>
                        <input type="text" class="form-control" value="<?= $customer->top ?>" readonly>
                       </div> 
                       <div class="forn-group">
                        <label for="">Dari :</label>
                        <input type="text" class="form-control" value="<?= $customer->tagihan ?>" readonly>
                       </div> 
                      </div>
                      <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                       <div class="row">
                        <div class="col-md-5">
                          <div class="form-group">
                            <label for="">Foto KTP:</label> <br>
                            <img src="<?= base_url('assets/img/customer/'.$customer->foto_ktp) ?>" class="img img-rounded " style="width: 70%;" alt="foto ktp">
                          </div>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-5">
                          <div class="form-group">
                            <label for="">Foto NPWP:</label> <br>
                            <img src="<?= base_url('assets/img/customer/'.$customer->foto_npwp) ?>" class="img img-rounded " style="width: 70%;" alt="foto npwp">
                          </div>
                        </div>
                       </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card -->
                </div>
                </div>
               </div>
               <!-- data toko -->
               <hr>
               <div class="card-default">
                <div class="card-header">
                  <h3 class="card-title"> <li class="fas fa-store"></li> List Toko</h3>
                </div>
                <div class="card-body">
                <table  class="table table-bordered table-striped table-responsive">
                  <thead>
                    <tr>
                      <th style="width: 2%">No</th>
                      <th>Nama Toko</th>
                      <th >Alamat</th>
                      <th >Telephone</th>
                      <th >Supervisor</th>      
                      <th >Leader</th>      
                      <th >SPG</th>      
                      <th >Status</th>      
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no =0;
                    foreach ($list_toko as $toko) :
                      $no++;
                    ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><a href="<?=base_url('audit/toko/profil/'.$toko->id)?>"><?= $toko->nama_toko ?></a></td>
                      <td>
                        <address>
                        <?= $toko->alamat ?>
                        </address>
                      </td>
                      <td>
                      <?= $toko->telp ?>
                      </td>
                      <td>
                      <?= $toko->spv ?>
                      </td>
                      <td>
                      <?= $toko->leader ?>
                      </td>
                      <td>
                      <?= $toko->spg ?>
                      </td>
                      <td>
                        <?= status_toko( $toko->status) ?>
                      </td>
                    </tr>
                    <?php endforeach ?>
                  </tbody>
                 
                </table>
                </div>
               </div>
                

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
   
