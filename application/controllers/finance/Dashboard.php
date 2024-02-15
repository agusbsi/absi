<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "13"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
 
    $this->load->model('M_spg');
  }

  public function index(){

        $data['title'] = 'Dashboard';
        // Total toko
        $data['t_toko'] = $this->db->query("SELECT count(id) as total from tb_toko where  status = 1")->row();
        // Total Artikel
        $data['t_artikel'] = $this->db->query("SELECT count(id) as total from tb_produk where  status = 1")->row();
        // Total Artikel
        $data['t_stok'] = $this->db->query("SELECT sum(qty) as total from tb_stok where  status = 1")->row();
        // Total Penjualan
        $data['t_jual'] = $this->db->query("SELECT count(qty) as total FROM tb_penjualan_detail")->row();
        // Tanggal sekarang
        $tanggalSekarang = date('Y-m-d');
        // Hitung tanggal H-10 dan H+1
        $tanggalAwal = date('Y-m-d', strtotime('-10 days', strtotime($tanggalSekarang)));
        $tanggalAkhir = date('Y-m-d', strtotime('+1 day', strtotime($tanggalSekarang)));
      
        $data['tempo']  = $this->db->query("SELECT ti.*, tt.nama_toko from tb_invoice ti
        join tb_toko tt on ti.id_toko = tt.id
        where ti.jth_tempo >= '$tanggalAwal' and ti.jth_tempo <= '$tanggalAkhir' ")->result();
       
        $this->template->load('template/template', 'finance/dashboard', $data);
    
  }
}
?>
