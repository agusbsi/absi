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
            <h3> <i class="fas fa-chart-pie"></i>== Hasil Stok Opname ==</h3>
            ( <strong>NO SO :</strong> <?= $so_terbaru->id ?> )
            
            
        </div>

        <div><strong>Nama Toko :</strong> <?= $data_toko->nama_toko ?></div>
        <div><strong>SPG :</strong> <?= $data_toko->nama_user ?></div>
        <div><strong>Tanggal SO : </strong><?= $so_terbaru->created_at ?></div>
         

      <hr>
        <table id="table">
            <thead>
                <tr style="text-align:center">
                    <th>No.</th>
                    <th>Kode Artikel</th>
                    <th>Nama Artikel</th>
                    <th>Satuan</th>
                    <th>Stok Akhir</th>
                    <th>Hasil SO</th>
                    <th>Selisih</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 0;
                $total = 0;
                $total_so = 0;
                $total_selisih = 0;
                foreach($hasil_so as $s) {
                $no++
                ?>
                <tr>
                    <td scope="row" style="text-align:center"><?= $no ?></td>
                    <td><?= $s->kode ?></td>
                    <td><?= $s->nama_produk ?></td>
                    <td style="text-align:center"><?= $s->satuan ?></td>
                    <td style="text-align:center"><?= $s->qty_akhir ?></td>
                    <td style="text-align:center"><?= $s->hasil_so ?></td>
                    <td style="text-align:center"><?= $s->selisih ?></td>
                </tr>
               <?php 
               $total += $s->qty_akhir;
               $total_so += $s->hasil_so;
               $total_selisih += $s->selisih;
                } ?>
            </tbody>
            <tfoot>
                    <tr>
                      <td  colspan="4" align="right"> <strong>Total :</strong> </td>
                      <td  style="text-align:center"><b><?= $total ; ?></b></td>
                      <td  style="text-align:center"><b><?= $total_so ; ?></b></td>
                      <td  style="text-align:center"><b><?= $total_selisih ; ?></b></td>
                    </tr>
                </tfoot>
        </table>
        <br>
        Catatan SO :
        <textarea name="" id="" cols="30" rows="10"><?= $so_terbaru->catatan ?> </textarea>
        <div id="footer">
    <p class="page"> Halaman </p>
  </div> 
     </body>
</html>