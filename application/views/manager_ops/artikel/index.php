     <!-- Main content -->
     <section class="content">
       <div class="container-fluid">
         <div class="row">
           <div class="col-12">

             <!-- /.card -->

             <div class="card card-info">
               <div class="card-header">
                 <h3 class="card-title">
                   <li class="fas fa-cube"></li> List Artikel
                 </h3>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                   <thead>
                     <tr class="text-center">
                       <th>No.</th>
                       <th>Kode Artikel</th>
                       <th>Deskripsi</th>
                       <th>Satuan</th>
                       <th>Status</th>
                     </tr>
                   </thead>
                   <tbody>
                     <tr>
                       <?php if (is_array($list_data)) { ?>
                         <?php $no = 1; ?>
                         <?php foreach ($list_data as $dd) : ?>
                           <td class="text-center"><?= $no ?></td>
                           <td><?= $dd->kode ?></td>
                           <td><?= $dd->nama_produk ?></td>
                           <td class="text-center"><?= $dd->satuan ?></td>
                           <td class="text-center"><?= status_artikel($dd->status) ?></td>
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
             <!-- /.card -->
           </div>
           <!-- /.col -->
         </div>
         <!-- /.row -->
       </div>
       <!-- /.container-fluid -->
     </section>