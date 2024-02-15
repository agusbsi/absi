<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <!-- /.card -->

                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"> <i class="fas fa-cubes"></i> Detail</h3>
                        <div class="card-tools">
                            <a href="<?= base_url('adm/Stok') ?>" type="button" class="btn btn-tool remove">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <div id="printableArea">
                            <div class="text-center"><b><?= !empty($data->nama_produk) ? $data->kode . '  <br>  ' . $data->nama_produk  : 'DATA STOK KOSONG' ?></b></div>
                            <hr>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:3%">#</th>
                                        <th class="text-center">Nama Toko</th>
                                        <th class="text-center">Total Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total = 0;
                                    if (is_array($list_data)) {
                                        $no = 0;
                                        foreach ($list_data as $dd) :
                                            $no++;
                                    ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $dd->nama_toko ?></td>
                                                <td class="text-center"><?= $dd->qty ?></td>
                                            </tr>
                                        <?php
                                            $total += $dd->qty; // Perbaiki penggunaan variabel
                                        endforeach;
                                        ?>
                                        <tr>
                                            <td colspan="2" class="text-right">Total</td>
                                            <td class="text-center"><b><?= $total ?></b></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="no-print">
                            <a href="<?= base_url('adm/Stok') ?>" class="btn btn-danger btn-sm float-right ">Close</a>
                            <a type="button" onclick="printDiv('printableArea')" target="_blank" class="btn btn-default float-right btn-sm" style="margin-right: 5px;">
                                <i class="fas fa-print"></i> Print
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
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