<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Produk extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    if($this->session->userdata('status') != 'login' && $this->session->userdata('role') != 1){
        redirect(base_url());
    }    
    $this->load->model('M_admin');
  }

   //   halaman utama
  public function index()
  {
    $data['title'] = 'Produk';
    $data['list_data'] = $this->db->query("SELECT * from tb_produk order by id desc")->result();
    $this->template->load('template/template', 'adm/produk/lihat_data', $data);
  }

  // hapus
  function hapus($id)
  {
    $where = array('id' => $id);
    $data = array(
      'deleted_at' => date('Y-m-d H:i:s'),
      'status' => 0,
    );
    $this->db->update('tb_produk', $data, $where);
    tampil_alert('success', 'BERHASIL', 'artikel berhasil dinonaktifkan');
    redirect('adm/Produk');
  }

  // fungsi tambah produk
  public function proses_tambah()
  {
    $id_user = $this->session->userdata('id');
    $this->form_validation->set_rules('kode', 'Kode Artikel', 'required');
    $this->form_validation->set_rules('nama', 'Nama Artikel', 'required');
    $this->form_validation->set_rules('satuan', 'Satuan', 'required');
    $this->form_validation->set_rules('harga_jawa', 'Harga Jawa', 'required');
    $this->form_validation->set_rules('harga_indo', 'Harga Indonesia Barat', 'required');
    $this->form_validation->set_rules('sp', 'sp', 'required');

    if ($this->form_validation->run() == TRUE) {
      $kode     = $this->input->post('kode', TRUE);
      $nama     = $this->input->post('nama', TRUE);
      $satuan   = $this->input->post('satuan', TRUE);
      $deskripsi = $this->input->post('deskripsi', TRUE);
      $harga1 = $this->input->post('harga_jawa', TRUE);
      $harga2 = $this->input->post('harga_indo', TRUE);
      $sp = $this->input->post('sp', TRUE);
      $data = array(
        'kode'      => $kode,
        'nama_produk' => $nama,
        'satuan'    => $satuan,
        'deskripsi' => $deskripsi,
        'harga_jawa' => preg_replace('/[^0-9]/', '', $harga1),
        'harga_indobarat' => preg_replace('/[^0-9]/', '', $harga2),
        'sp' => preg_replace('/[^0-9]/', '', $sp),
        'status'    => "1",
        'id_user'       => $id_user
      );
      $cek = $this->db->query("SELECT * FROM tb_produk WHERE kode = '$kode' AND deleted_at is null")->num_rows();
      if ($cek > 0) {
        tampil_alert('info', 'KODE SUDAH ADA', 'Kode artikel ' . $kode . ' sudah ada, harap diganti');
        redirect(base_url('adm/produk/'));
      } else {
        $this->M_admin->insert('tb_produk', $data);
        tampil_alert('success', 'BERHASIL', 'Kode artikel ' . $kode . ' berhasil ditambahkan');
        redirect(base_url('adm/produk'));
      }
    } else {
      tampil_alert('error', 'GAGAL', 'Kode artikel ' . $kode . ' gagal ditambahkan');
      redirect(base_url('adm/produk/'));
    }
  }

  // Proses update
  public function proses_update()
  {
    $id_user = $this->session->userdata('id');
    $this->form_validation->set_rules('nama_produk', 'Nama Artikel', 'required');
    $this->form_validation->set_rules('satuan', 'Satuan', 'required');
    $this->form_validation->set_rules('harga_jawa', 'Harga Jawa', 'required');
    $this->form_validation->set_rules('harga_indo', 'Harga Indonesia Barat', 'required');
    $this->form_validation->set_rules('sp', 'sp', 'required');
    if ($this->form_validation->run() == TRUE) {
      $id           = $this->input->post('id', TRUE);
      $kode         = $this->input->post('kode', TRUE);
      $nama         = $this->input->post('nama_produk', TRUE);
      $satuan       = $this->input->post('satuan', TRUE);
      $harga1       = $this->input->post('harga_jawa', TRUE);
      $harga2       = $this->input->post('harga_indo', TRUE);
      $sp           = $this->input->post('sp', TRUE);
      $status       = $this->input->post('status', TRUE);
      date_default_timezone_set('Asia/Jakarta');
      $update_at    = date('Y-m-d h:i:s');
      $where = array('id' => $id);
      $data = array(
        'kode'          => $kode,
        'nama_produk'   => $nama,
        'satuan'        => $satuan,
        'status'        => $status,
        'harga_jawa'    => preg_replace('/[^0-9]/', '', $harga1),
        'harga_indobarat' => preg_replace('/[^0-9]/', '', $harga2),
        'sp'            => preg_replace('/[^0-9]/', '', $sp),
        'updated_at'    => $update_at,
        'id_user'       => $id_user

      );
      $this->M_admin->update('tb_produk', $data, $where);
      tampil_alert('success', 'BERHASIL', 'Kode artikel ' . $kode . ' berhasil diupdate');
      redirect(base_url('adm/Produk'));
    } else {
      tampil_alert('error', 'GAGAL', 'Kode artikel ' . $kode . ' gagal ditambahkan');
      redirect(base_url('adm/Produk'));
    }
  }

  public function produk_baru()
  {
    $data['title'] = 'Management Produk';
    $data['list_data'] = $this->db->query("SELECT * FROM tb_produk WHERE status ='2'")->result();
    $this->template->load('template/template', 'adm/produk/artikel_baru', $data); 
  }  
  public function approve()
  {
    $id = $this->uri->segment(4);
    $where = array('id' => $id);
    $data = array(
      'status' => "1",
    );
    $this->M_admin->update('tb_produk',$data,$where);
    tampil_alert('success','Berhasil','Artikel Berhasil Diaktifkan!!');
    redirect(base_url('adm/produk'));
  }

  public function reject()
  {
    $id = $this->uri->segment(4);
    $where = array('id' => $id);
    $data = array(
      'status' => "0",
    );
    $this->M_admin->update('tb_produk',$data,$where);
    tampil_alert('info','Information','Artikel dinonaktifkan!');
    redirect(base_url('adm/produk'));
  }
  
// import artikel
  public function import_artikel()
  {
    // Process the uploaded file
    $file = $_FILES['file']['tmp_name'];
    $reader = IOFactory::createReader('Xlsx');
    $spreadsheet = $reader->load($file);
    $worksheet = $spreadsheet->getActiveSheet();
    $rows = $worksheet->toArray();

    $lastRowIndex = count($rows) - 1;
    $id_user  = $this->session->userdata('id');

    // Loop through each row starting from the second row (index 1)
    for ($i = 1; $i < $lastRowIndex; $i++) {
      // Retrieve the values from each column of the current row
      $kode = trim($rows[$i][0]);
      $nama_produk = isset($rows[$i][1]) ? trim($rows[$i][1]) : '';
      $satuan = isset($rows[$i][2]) ? trim($rows[$i][2]) : '';
      $het_jawa = isset($rows[$i][3]) ? intval($rows[$i][3]) : 0;
      $het_indobarat = isset($rows[$i][4]) ? intval($rows[$i][4]) : 0;
      $sp = isset($rows[$i][5]) ? intval($rows[$i][5]) : 0;

      // Check if any required field is empty
      if (empty($kode) || empty($nama_produk)) {
        tampil_alert('warning', 'DATA KOSONG', 'Data pada baris ' . ($i + 1) . ' memiliki kolom yang kosong, tidak akan disimpan.');
        continue; // Skip this row and proceed to the next one
      }

      $existing_produk = $this->db->get_where('tb_produk', array('kode' => $kode))->row();

      if ($existing_produk) {
        tampil_alert('info', 'KODE SUDAH ADA', 'Kode artikel ' . $kode . ' sudah ada, harap hapus');
      } else {
        // Add the new product to the database
        $data = array(
          'kode' => $kode,
          'nama_produk' => $nama_produk,
          'satuan' => $satuan,
          'harga_jawa' => $het_jawa,
          'harga_indobarat' => $het_indobarat,
          'sp' => $sp,
          'id_user' => $id_user,
          'status' => 1,
        );
        $this->db->insert('tb_produk', $data);
        tampil_alert('success', 'Berhasil', 'Artikel Berhasil di import!!');
      }
    }

    // Process the last row
    $lastRow = $rows[$lastRowIndex];
    $kode = trim($lastRow[0]);
    $nama_produk = isset($lastRow[1]) ? trim($lastRow[1]) : '';
    $satuan = isset($lastRow[2]) ? trim($lastRow[2]) : '';
    $het_jawa = isset($lastRow[3]) ? intval($lastRow[3]) : 0;
    $het_indobarat = isset($lastRow[4]) ? intval($lastRow[4]) : 0;
    $sp = isset($lastRow[5]) ? intval($lastRow[5]) : 0;

    // Check if any required field is empty for the last row
    if (empty($kode) || empty($nama_produk)) {
      tampil_alert('warning', 'DATA KOSONG', 'Data pada baris ' . ($lastRowIndex + 1) . ' memiliki kolom yang kosong, tidak akan disimpan.');
    } else {
      $existing_produk = $this->db->get_where('tb_produk', array('kode' => $kode))->row();

      if ($existing_produk) {
        tampil_alert('info', 'KODE SUDAH ADA', 'Kode artikel ' . $kode . ' sudah ada, harap hapus');
      } else {
        // Add the new product to the database
        $data = array(
          'kode' => $kode,
          'nama_produk' => $nama_produk,
          'satuan' => $satuan,
          'harga_jawa' => $het_jawa,
          'harga_indobarat' => $het_indobarat,
          'sp' => $sp,
          'id_user' => $id_user,
          'status' => 1,
        );
        $this->db->insert('tb_produk', $data);
        tampil_alert('success', 'Berhasil', 'Artikel Berhasil di import!!');
      }
    }

    redirect(base_url('adm/produk'));
  }
}
?>