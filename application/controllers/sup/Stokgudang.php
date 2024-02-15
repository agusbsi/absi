<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
class Stokgudang extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "6" && $role != 1){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_admin');
    $this->load->model('M_support');
  }
  public function index()
  {

    $data['title'] = 'Stokgudang';
    $data['list_data'] = $this->db->query("SELECT ts.*, tp.satuan FROM tb_stokgudang ts
    left join tb_produk tp on ts.kode = tp.kode
    where ts.kode != ''
    order by ts.kode asc")->result();
    $this->template->load('template/template', 'manager_mv/stokgudang/index', $data);
  }


// import tes kedua
public function import_excel()
{
    // Process the uploaded file
    $file = $_FILES['file']['tmp_name'];
    $reader = IOFactory::createReader('Xlsx');
    $spreadsheet = $reader->load($file);
    $worksheet = $spreadsheet->getActiveSheet();
    $rows = $worksheet->toArray();
    // Update the stock levels for each product in the file
    foreach ($rows as $row) {
      // Looping untuk setiap baris, dimulai dari baris ke-2
        for ($i = 1; $i < count($rows); $i++) 
        {
          // Mengambil nilai kode pada kolom A dari baris ke-$i+1
          $kode = trim($rows[$i][0]);

          // Mengambil nilai jumlah pada kolom B dari baris ke-$i+1
          $jumlah = intval($rows[$i][1]);
          
          // Lakukan proses update stok atau penambahan produk baru di sini
          // ...
           // Check if the product exists in the database
        $produk = $this->M_support->get_produk_by_kode($kode);
        date_default_timezone_set('Asia/Jakarta');
        $tanggal_sekarang = date("Y-m-d H:i:s");
        if ($produk) {
            // Update the stock level for the existing product
            $this->M_support->update_stok($produk->kode,$jumlah,$tanggal_sekarang);
        } else {
            // Add the new product to the database
           
            $data = array(
                'kode' => $kode,
                'stok' => $jumlah,
                'updated_at' => $tanggal_sekarang
            );
            $this->M_support->add_produk($data);
        }
        }
    }

    // Redirect back to the product list with a success message
    tampil_alert('success','Berhasil','Data berhasil di Update!');
    redirect(base_url('sup/Stokgudang'));
}
public function update_stok()
  {
    // Process the uploaded file
    $file = $_FILES['file']['tmp_name'];
    $reader = IOFactory::createReader('Xlsx');
    $spreadsheet = $reader->load($file);
    $worksheet = $spreadsheet->getActiveSheet();
    $rows = $worksheet->toArray();

    // Loop through each row starting from the second row (index 1)
    foreach ($rows as $row) {
      // Retrieve the values from column A, B, and C of the current row
      $kode = trim($row[0]);
      $jumlah = intval($row[1]);
      $toko = intval($row[2]);
      // Get the product by kode
      $idproduk = null;
      $cariId = $this->db->get_where('tb_produk', array('kode' => $kode));
      if ($cariId->num_rows() > 0) {
        $idproduk = $cariId->row()->id;
      }

      date_default_timezone_set('Asia/Jakarta');
      $tanggal_sekarang = date("Y-m-d H:i:s");

      if ($idproduk !== null) {
        // Check if id exists in tb_stok for the given store
        $query = $this->db->get_where('tb_stok', array('id_produk' => $idproduk, 'id_toko' => $toko));
        $existing_stok = $query->row();

        if (empty($existing_stok)) {
          $data = array(
            'id_produk' => $idproduk,
            'id_toko' => $toko,
            'qty' => $jumlah,
            'qty_awal' => $jumlah,
            'status' => 1,
            'updated_at' => $tanggal_sekarang,
          );
          $this->db->insert('tb_stok', $data);
          $message = 'Data berhasil ditambahkan!';
          echo "<text style='color:green;'>$kode</text><br>";
        } else {
          $data_update = array(
            'qty' => $jumlah,
            'qty_awal' => $jumlah,
            'updated_at' => $tanggal_sekarang,
          );
          $where = array(
            'id_produk' => $idproduk,
            'id_toko' => $toko,
          );
          $this->db->update('tb_stok', $data_update, $where);
          $message = 'Data berhasil diupdate!';
          echo "<text style='color:yellow;'>$kode</text><br>";
        }

        // Display a success message
        tampil_alert('success', 'Berhasil', $message);
      } else {
          echo "<text style='color:red;'>$kode</text><br>";
      }
    }

    // Redirect back to the product list
    // redirect(base_url('sup/Stokgudang'));
  }
  
}
?>