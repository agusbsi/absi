<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Piutang extends CI_Controller
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
    $data['title'] = 'Kelola Piutang';
    $data['piutang'] = $this->db->query("SELECT tt.id, tt.nama_toko, tc.nama_cust as customer, 
      SUM(CASE WHEN tpd.status = 1 THEN (tpd.harga - (tpd.harga * tpd.diskon_toko / 100)) * tpd.qty ELSE 0 END) as verifikasi,
      SUM(CASE WHEN tpd.status = 0 THEN (tpd.harga - (tpd.harga * tpd.diskon_toko / 100)) * tpd.qty ELSE 0 END) as belum,
      SUM(CASE WHEN tpd.status = 2 THEN (tpd.harga - (tpd.harga * tpd.diskon_toko / 100)) * tpd.qty ELSE 0 END) as lunas,
      SUM(CASE WHEN tpd.status = 3 THEN (tpd.harga - (tpd.harga * tpd.diskon_toko / 100)) * tpd.qty ELSE 0 END) as blm_lunas
      FROM tb_toko tt
      JOIN tb_customer tc ON tt.id_customer = tc.id
      LEFT JOIN tb_penjualan tp ON tt.id = tp.id_toko
      LEFT JOIN tb_penjualan_detail tpd ON tp.id = tpd.id_penjualan
      GROUP BY tt.id
      ORDER BY tt.id DESC")->result();
    $this->template->load('template/template', 'finance/piutang/index', $data);
  }
  public function getdata()
   {
       // Mengambil parameter id_toko dari permintaan Ajax
       $id_toko = $this->input->get('id_toko');
   
       // Mengambil data artikel dari tabel tb_stok berdasarkan id_toko
       // Ganti dengan kode Anda untuk mengambil data dari database
       $artikel = $this->db->query("SELECT tpd.*, tp.kode, tpd.status as piutang from tb_penjualan_detail tpd
       join tb_produk tp on tpd.id_produk = tp.id
       join tb_penjualan tpp on tpd.id_penjualan = tpp.id
       where tpp.id_toko = '$id_toko'  order by tpd.id desc ");
   
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
