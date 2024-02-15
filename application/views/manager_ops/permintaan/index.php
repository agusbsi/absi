     <!-- Main content -->
     <section class="content">
       <div class="container-fluid">
         <div class="card card-info">
           <div class="card-header">
             <h3 class="card-title">
               Data Permintaan artikel bulan ini
             </h3>
           </div>
           <!-- /.card-header -->
           <div class="card-body">

             <table id="example1" class="table table-bordered table-striped">
               <thead>
                 <tr>
                   <th style="width: 2%">#</th>
                   <th>No. Permintaan</th>
                   <th>Nama Toko</th>
                   <th>Tanggal</th>
                   <th>Status</th>
                   <th style="width: 9%">Menu</th>
                 </tr>
               </thead>
               <tbody>
                 <tr>
                   <?php if (!empty($permintaan)) { ?>
                     <?php $no = 1; ?>
                     <?php foreach ($permintaan as $dd) : ?>
                       <td><?= $no ?></td>
                       <td><?= $dd->id ?></td>
                       <td><?= $dd->nama_toko ?></td>
                       <td><?= $dd->created_at ?></td>
                       <td class="text-center"><?= status_permintaan($dd->status) ?></td>
                       <td><a href="<?= base_url('mng_ops/Dashboard/detail_p/' . $dd->id) ?>" class="btn btn-info btn-sm">Detail</a></td>
                 </tr>
                 <?php $no++; ?>
               <?php endforeach; ?>
             <?php } else { ?>
               <td colspan="5" align="center"><strong>Data Kosong</strong></td>
             <?php } ?>
               </tbody>
             </table>

           </div>
           <!-- /.card-body -->
         </div>
       </div>
       <!-- /.container-fluid -->
     </section>