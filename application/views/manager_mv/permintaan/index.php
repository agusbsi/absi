 <!-- Main content -->
 <section class="content">
   <div class="container-fluid">
     <div class="row">
       <div class="col-12">
         <div class="card card-info">
           <div class="card-header">
             <h3 class="card-title">
               <li class="fas fa-cube"></li> Data Permintaan
             </h3>
           </div>
           <div class="card-body">
             <table id="example1" class="table table-bordered table-striped">
               <thead>
                 <tr class="text-center">
                   <th style="width: 1%">No</th>
                   <th>Nomor #</th>
                   <th>Status</th>
                   <th>Toko</th>
                   <th>Tgl</th>
                   <th>Menu</th>
                 </tr>
               </thead>
               <tbody>
                 <tr>
                   <?php if (is_array($list_data)) { ?>
                     <?php $no = 0; ?>
                     <?php foreach ($list_data as $data) :
                        $no++ ?>
                       <td><?= $no ?></td>
                       <td><?= $data->id ?></td>
                       <td>
                         <?php
                          status_permintaan($data->status);
                          ?>
                       </td>
                       <td><?= $data->nama_toko ?></td>
                       <td><?= $data->created_at ?></td>
                       <td class="text-center">
                         <?php
                          if ($data->status == 1) {
                          ?>
                           <a type="button" class="btn btn-success btn-sm" href="<?= base_url('sup/permintaan/detail/' . $data->id . '/' . $data->id_toko) ?>" name="btn_proses"><i class="fas fa-link" aria-hidden="true"></i> Proses</a>
                         <?php
                          } else if ($data->status == 0) {
                            echo "";
                          } else {
                          ?>
                           <a type="button" class="btn btn-primary btn-sm" href="<?= base_url('sup/permintaan/detail/' . $data->id) ?>" name="btn_detail"><i class="fas fa-eye" aria-hidden="true"></i> Detail</a>
                         <?php }
                          ?>
                       </td>
                 </tr>
               <?php endforeach; ?>
               <?php $no++; ?>
             <?php } else { ?>
               <td colspan="6" align="center"><strong>Data Kosong</strong></td>
             <?php } ?>
             </tr>
               </tbody>
             </table>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
 <script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>