<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "13"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }

    $this->load->model('M_finance');
    $this->load->model('M_admin');
  }

  public function index()
  {
    $data['title'] = 'Kelola Penjualan';
    $data['jual'] = $this->db->query("SELECT tp.id, tp.tanggal_penjualan, tp.status, tt.nama_toko, sum(tpd.qty) as total_qty,sum((tpd.harga - (tpd.harga * tpd.diskon_toko / 100)) * tpd.qty ) as total_jual  from tb_penjualan tp
    join tb_toko tt on tp.id_toko = tt.id
    join tb_penjualan_detail tpd on tp.id = tpd.id_penjualan
    group by tpd.id_penjualan order by tp.id desc")->result();
    $this->template->load('template/template', 'finance/penjualan/index', $data);
  }

   public function getdata()
   {
       // Mengambil parameter id_toko dari permintaan Ajax
       $id_penjualan = $this->input->get('id_penjualan');
   
       // Mengambil data artikel dari tabel tb_stok berdasarkan id_toko
       // Ganti dengan kode Anda untuk mengambil data dari database
       $artikel = $this->db->query("SELECT * from tb_penjualan_detail tpd
       join tb_produk tp on tpd.id_produk = tp.id
       where tpd.id_penjualan = '$id_penjualan'  order by tpd.id desc ");
   
       if ($artikel->num_rows() > 0) {
           $result = $artikel->result();
           header('Content-Type: application/json'); // Tambahkan header untuk menandakan bahwa respons adalah JSON
           echo json_encode($result);
       } else {
           header('Content-Type: application/json'); // Tambahkan header untuk menandakan bahwa respons adalah JSON
           echo json_encode(array());
       }
   }
  
}
?>
