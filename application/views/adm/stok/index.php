<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <!-- /.card -->

                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"> <i class="fas fa-cubes"></i> Data Stok Toko</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:3%">#</th>
                                    <th style="width:20%">Kode</th>
                                    <th class="text-center">Artikel</th>
                                    <th class="text-center">Total Stok</th>
                                    <th style="width:10%" class="text-center">Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php if (is_array($list_data)) { ?>
                                        <?php
                                        $no = 0;
                                        foreach ($list_data as $dd) :
                                            $no++; ?>
                                            <td><?= $no ?></td>
                                            <td><?= $dd->kode ?></td>
                                            <td><?= $dd->nama_produk ?></td>
                                            <td class="text-center"><?= $dd->stok ?></td>
                                            <td>
                                                <a href="<?= base_url('adm/Stok/detail/' . $dd->id) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Detail</a>
                                            </td>
                                </tr>
                            <?php endforeach; ?>
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