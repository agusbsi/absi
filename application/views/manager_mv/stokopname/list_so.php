<section class="content">
       <div class="container-fluid">
         <div class="row">
           <div class="col-12">
             <div class="card card-info">
               <div class="card-header">
                 <h3 class="card-title">
                   <li class="fas fa-file-alt"></li> Data Stok Opname Toko
                 </h3>
                 <div class="card-tools">
                   <a href="<?= base_url('sup/So') ?>" class="btn btn-tool">
                     <i class="fas fa-times"></i>
                   </a>
                 </div>
               </div>
               <!-- /.card-header -->
               <div class="card-body">

                 <table id="example1" class="table table-bordered table-striped">
                   <thead>
                     <tr class="text-center">
                       <th>No</th>
                       <th>Nama Toko</th>
                       <th>SPG</th>
                       <th>Status Aset</th>
                       <th>Status SO</th>
                       <th>Tgl max SO</th>
                       <th>Tgl SO</th>
                       <th>Menu</th>
                     </tr>
                   </thead>
                   <tbody>
                     <tr>
                       <?php if (is_array($list_data)) { ?>
                         <?php $no = 1; ?>
                         <?php foreach ($list_data as $dd) : ?>
                           <td><?= $no ?></td>
                           <td><?= $dd->nama_toko ?></td>
                           <td>
                             <?php if ($dd->nama_user == "") {
                                echo "<span class='badge badge-danger'> ( Belum dikaitkan )</span>";
                              } else {
                                echo $dd->nama_user;
                              }
                              ?>
                           </td>
                           <td class="text-center">
                             <?php if ($dd->status_aset == 0) { ?>
                               <span class='badge badge-danger'>Belum Update</span>
                             <?php } else { ?>
                               <span class='badge badge-success'>Sudah Update</span>
                             <?php } ?>
                           </td>
                           <td class="text-center">
                             <?php if ($dd->status_so == 0) {
                                echo "<span class='badge badge-danger'> Belum SO </span>";
                              } else if (($dd->status_so == 1)) {
                                echo "<span class='badge badge-success'> Sudah SO </span>";
                              }
                              ?>
                           </td>
                           <td class="text-center">
                             <?php if ($dd->tgl_so == null) { ?>
                               - Kosong -
                             <?php } else { ?>
                               <?= $dd->tgl_so ?>
                             <?php } ?>
                           </td>
                           <td class="text-center">
                             <?php if ($dd->status_so == 0) {
                                echo "<span class='badge badge-danger'> Belum SO </span>";
                              } else {
                              ?>
                               <?= date('d-m-Y', strtotime($dd->date_so)) ?>
                             <?php } ?>
                             <input type="hidden" name="id_toko" value="<?= $dd->id ?>">
                           </td>
                           <td class="text-center">
                             <a href="<?= base_url('sup/So/pdf/' . $dd->id) ?>" target="_blank" class="btn btn-warning btn-sm <?= ($dd->nama_user == "") ? 'd-none' : ''; ?> <?= ($dd->status_so == "1") ? 'd-none' : ''; ?>"><i class="fas fa-file-pdf"></i> Format SO</a>
                             <a href="<?= base_url('sup/So/riwayat_so_toko/' . $dd->id . '/' . $dd->id_so) ?>" class="btn btn-primary btn-sm <?= ($dd->nama_user == "") ? 'd-none' : ''; ?> <?= ($dd->status_so == "0") ? 'd-none' : ''; ?>"><i class="fas fa-eye"></i></a>
                             <?php
                              if ($this->session->userdata('role') == 1) { ?>
                               <a href="<?= base_url('sup/So/detail/' . $dd->id) ?>" class="btn btn-warning btn-sm <?= ($dd->nama_user == "") ? 'd-none' : ''; ?> <?= ($dd->status_so == "0") ? 'd-none' : ''; ?>"><i class="fas fa-edit"></i></a>
                             <?php } ?>
                           </td>
                     </tr>
                     <?php $no++; ?>
                   <?php endforeach; ?>
                 <?php } else { ?>
                   <td colspan="8" align="center"><strong>Data Kosong</strong></td>
                 <?php } ?>
                   </tbody>
                 </table>
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
