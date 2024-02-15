<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if ($role != "13") {
      tampil_alert('error', 'DI TOLAK !', 'Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }

    $this->load->model('M_finance');
    $this->load->model('M_admin');
  }

  public function index()
  {
    $data['title'] = 'Laporan Penjualan';
    $data['list_toko'] = $this->db->query("SELECT * from tb_toko where status = 1")->result();
    $this->template->load('template/template', 'finance/laporan/index', $data);
  }
  public function pengiriman()
  {
    $data['title'] = 'Laporan Pengiriman';
    $data['list_toko'] = $this->db->query("SELECT * from tb_toko where status = 1")->result();
    $this->template->load('template/template', 'finance/laporan/pengiriman', $data);
  }

  public function rekap_pengiriman()
  {
    // Retrieve input parameters
    $id_toko   = $this->input->get('id_toko');
    $tgl_awal  = $this->input->get('tgl_awal');
    $tgl_akhir = $this->input->get('tgl_akhir');

    // Parameter validation (example only, adjust as needed)
    if (empty($id_toko) || empty($tgl_awal) || empty($tgl_akhir)) {
      // Handle invalid parameters
      return;
    }

    // Build the WHERE condition for id_toko
    if ($id_toko !== 'all') {
      $where_id_toko = "WHERE (tt.id = '$id_toko') OR tt.id IS NULL";
    } else {
      $where_id_toko = "";
    }

    // Prepare the query with parameter binding
    $query = "SELECT tt.id, tt.nama_toko, COALESCE(SUM(tpd.qty_diterima), 0) as qty_artikel
              FROM tb_toko tt
              LEFT JOIN tb_pengiriman tp ON tp.id_toko = tt.id
              LEFT JOIN tb_pengiriman_detail tpd ON tp.id = tpd.id_pengiriman AND date(tp.created_at) BETWEEN ? AND ? AND (tp.status = '2' OR tp.status = '3')
              $where_id_toko
              GROUP BY tt.id 
              ORDER BY qty_artikel DESC";

    // Execute the query with parameter binding
    $data = $this->db->query($query, array($tgl_awal, $tgl_akhir))->result();

    // Return the JSON-encoded data
    echo json_encode($data);
  }


  public function rekap()
  {
    $id_toko   = $this->input->get('id_toko');
    $tgl_awal  = $this->input->get('tgl_awal');
    $tgl_akhir = $this->input->get('tgl_akhir');
    $where_id_toko = ($id_toko !== 'all') ? "WHERE tt.id = '$id_toko' or tt.id IS NULL" : "";
    $data = $this->db->query("SELECT tt.id,tt.nama_toko, COALESCE(SUM(tpd.qty), 0) as qty_artikel
            FROM tb_toko tt
            LEFT JOIN tb_penjualan tp ON tp.id_toko = tt.id
            LEFT JOIN tb_penjualan_detail tpd ON tp.id = tpd.id_penjualan AND date(tp.tanggal_penjualan) BETWEEN '$tgl_awal' AND '$tgl_akhir'
            $where_id_toko
            GROUP BY tt.id 
            ORDER BY qty_artikel DESC")->result();

    echo json_encode($data);
  }


  public function detail_pengiriman()
  {
    // Retrieve input parameters
    $id_toko   = $this->input->get('id_toko');
    $tgl       = $this->input->get('tgl');
    $tgl_awal  = $this->input->get('tgl_awal');
    $tgl_akhir = $this->input->get('tgl_akhir');
    // Parameter validation (example only, adjust as needed)
    if (empty($id_toko) || empty($tgl_awal) || empty($tgl_akhir)) {
      // Handle invalid parameters
      return;
    }

    // Prepare the query with parameter binding
    $query = "SELECT tp.*, tt.nama_toko, SUM(tpd.qty_diterima) AS qty_artikel
            FROM tb_pengiriman tp
            JOIN tb_toko tt ON tp.id_toko = tt.id
            JOIN tb_pengiriman_detail tpd ON tp.id = tpd.id_pengiriman
            WHERE tp.id_toko = ? AND DATE(tp.created_at) BETWEEN ? AND ?
            GROUP BY tpd.id_pengiriman
            ORDER BY tp.created_at ASC";

    // Execute the query with parameter binding
    $data = $this->db->query($query, array($id_toko, $tgl_awal, $tgl_akhir))->result();

    // Return the JSON-encoded data
    echo json_encode($data);
  }

  // proses cari
  public function detail()
  {
    $id_toko   = $this->input->GET('id_toko');
    $tgl       = $this->input->GET('tgl');
    $tgl_awal  = $this->input->GET('tgl_awal');
    $tgl_akhir = $this->input->GET('tgl_akhir');

    $data = $this->db->query("SELECT tp.*, tt.nama_toko, sum(tpd.qty) as qty_artikel, sum((tpd.harga - (tpd.harga * tpd.diskon_toko / 100)) * tpd.qty ) as total_jual from tb_penjualan tp
     join tb_toko tt on tp.id_toko = tt.id
     join tb_penjualan_detail tpd on tp.id = tpd.id_penjualan
     where tp.id_toko = '$id_toko'  and  date(tp.tanggal_penjualan) between '$tgl_awal' and '$tgl_akhir' group by tpd.id_penjualan order by tp.tanggal_penjualan asc")->result();
    echo json_encode($data);
  }
}
