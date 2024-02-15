<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title_pdf;?></title>
        <style>
            #table {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #table td, #table th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #table tr:nth-child(even){background-color: #f2f2f2;}

            #table tr:hover {background-color: #ddd;}

            #table th {
                padding-top: 10px;
                padding-bottom: 10px;
                text-align: left;
                background-color: #4CAF50;
                color: white;
            }
            #footer { 
                position: fixed; right: 0px; bottom: 10px; text-align: center;border-top: 1px solid black;
            }
            #footer .page:after { 
                content: counter(page, decimal); 
            }
            @page { 
                margin: 20px 30px 40px 50px; 
            }
        </style>
    </head>
    <body>
        <div style="text-align:center">
            <h3> <i class="fas fa-chart-pie"></i>== BERKAS TOKO / CABANG ==</h3>
            <strong>Tgl Cetak : <?= date('d-M-Y') ?> </strong>
        </div>
      
        <hr>
        Data Customer  :
        <hr>
        <table id="table">
            <thead></thead>
            <tbody>
                <tr>
                <td>ID Customer</td>
                <td>: <?= $customer->id ?> </td>
                </tr>
                <tr>
                <td>Nama Customer</td>
                <td>: <?= $customer->nama_cust ?> </td>
                </tr>
                <tr>
                <td>Nama PIC</td>
                <td>: <?= $customer->nama_pic ?>  </td>
                </tr>
                <tr>
                <td>Telephone</td>
                <td>: <?= $customer->telp ?> </td>
                </tr>
                <tr>
                <td>T.O.P</td>
                <td>: <?= $customer->top ?> hari, dari : <?= $customer->tagihan ?>  </td>
                </tr>
                <tr>
                <td>Alamat</td>
                <td>: <?= $customer->alamat_cust ?> </td>
                </tr>
            </tbody>
        </table>
        <hr>
        Data Toko / Cabang  :
        <hr>
        <table id="table">
            <thead>
            </thead>
            <tbody>
                <tr>
                <td>ID Toko</td>
                <td>: <?= $data_toko->id ?></td>
                </tr>
                <tr>
                <td>Nama Toko</td>
                <td>: <?= $data_toko->nama_toko ?></td>
                </tr>
                <tr>
                <td>Jenis Toko</td>
                <td>: <?=jenis_toko($data_toko->jenis_toko)?></td>
                </tr>
                <tr>
                <td>Jenis Harga</td>
                <td>: <?= status_het($data_toko->het) ?></td>
                </tr>
                <tr>
                <td>Diskon</td>
                <td>: <?= $data_toko->diskon ?> % </td>
                </tr>
                <tr>
                <td>Potensi Sales</td>
                <td>
                    <table style="width:100%">
                        <tbody>
                           <tr>
                            <td>RIDER</td>
                            <td>GT-MAN</td>
                            <td>CROCODILE</td>
                           </tr>
                           <tr>
                            <td>Rp <?= number_format($data_toko->s_rider) ?></td>
                            <td>Rp <?= number_format($data_toko->s_gtman) ?></td>
                            <td>Rp <?= number_format($data_toko->s_crocodile) ?></td>
                           </tr>
                        </tbody>
                    </table>
                </td>
                </tr>
                <tr>
                <td>Target Sales Toko</td>
                <td>: Rp. <?= number_format($data_toko->target) ?>,-</td>
                </tr>
                
                <tr>
                <td>Limit Toko</td>
                <td>: Rp. <?= number_format($data_toko->limit_toko) ?>,-</td>
                </tr>
                <tr>
                <td>Tgl Stok Opname (SO)</td>
                <td>: [ <?= $data_toko->tgl_so ?> ]  / setiap Bulan</td>
                </tr>
                <tr>
                <td>Provinsi</td>
                <td>: <?= $data_toko->provinsi ?>, <?= $data_toko->kabupaten ?> , <?= $data_toko->kecamatan ?></td>
                </tr>
                <tr>
                <td>Alamat</td>
                <td>: <?= $data_toko->alamat ?></td>
                </tr>
                <tr>
                <td>PIC Toko</td>
                <td>: <?= $data_toko->nama_pic ?></td>
                </tr>
                <tr>
                <td>Kontak PIC</td>
                <td>: <?= $data_toko->telp ?></td>
                </tr>
                <tr>
                <td>Tgl dibuat</td>
                <td>: <?= $data_toko->created_at ?></td>
                </tr>   
                <tr>
                <td>Status Toko :</td>
                <td>: <?= status_toko($data_toko->status) ?></td>
                </tr>   
            </tbody>
        </table>
        <hr>
        <table id="table">
            <thead></thead>
            <tbody>
                <tr>
                <td>Supervisor</td>
                <td>: <?= $spv->nama_user ?></td>
                </tr>
                <tr>
                <td>Tim Leader</td>
                <td>: <?= $leader_toko->nama_user ?></td>
                </tr>
                <tr>
                <td>SPG</td>
                <td>: <?= $spg->nama_user ?></td>
                </tr>
            </tbody>
        </table>
        <hr>
        Data Pendukung  :
        <hr>
        <div> Foto Toko Tampak Depan :</div>
        <br>
        <div>
        <img src="<?php echo base_url('assets/img/toko/'.$data_toko->foto_toko)?>" style="width: 40%;" alt="">
        </div>
        <hr>
        <div> Foto PIC :</div>
        <div>
        <img src="<?php echo base_url('assets/img/toko/'.$data_toko->foto_pic)?>" style="width: 40%;" alt="">
        </div>
        <hr>
        <div> Foto KTP Customer:</div>
        <div>
        <img src="<?php echo base_url('assets/img/customer/'.$customer->foto_ktp)?>" style="width: 40%;" alt="">
        </div>
        <hr>
        <div> Foto NPWP Customer:</div>
        <div>
        <img src="<?php echo base_url('assets/img/customer/'.$customer->foto_npwp)?>" style="width: 40%;" alt="">
        </div>
        <div id="footer">
    <p class="page"> Halaman </p>
  </div> 
     </body>
</html>