<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "10"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
 
    $this->load->model('M_spg');
  }

  public function index(){
   
        $id_spv = $this->session->userdata('id');
        $data['title'] = 'Dashboard';
        // Total toko
        $data['t_toko'] = $this->db->query("SELECT count(id) as total from tb_toko where  status = 1")->row();
        // Total Artikel
        $data['t_artikel'] = $this->db->query("SELECT count(id) as total from tb_produk where  status = 1")->row();
        // Total Aset
        $data['t_aset'] = $this->db->query("SELECT sum(qty) as total from tb_aset_toko ")->row();
        // Total Group
        $data['t_customer'] = $this->db->query("SELECT count(id) as total from tb_customer ")->row();
        // Total promo
        $data['t_promo'] = $this->db->query("SELECT count(id) as total from tb_promo where  status = 1")->row();
        // user all
        $data['t_user_all'] = $this->db->query("SELECT count(id) as total from tb_user 
        where deleted_at is null")->row();
        // user SPV
        $data['t_user_spv'] = $this->db->query("SELECT count(id) as total from tb_user 
        where deleted_at is null and role = '2'")->row();
        // user leader
        $data['t_user_leader'] = $this->db->query("SELECT count(id) as total from tb_user 
        where deleted_at is null and role = '3'")->row();
        // user leader
        $data['t_user_spg'] = $this->db->query("SELECT count(id) as total from tb_user 
        where deleted_at is null and role = '4'")->row();
        // total permintaan
        $data['t_minta'] = $this->db->query("SELECT count(tp.id) as total FROM tb_permintaan tp
        join tb_toko tt on tp.id_toko = tt.id
        ")->row();
        // Total Penjualan
        $data['t_jual'] = $this->db->query("SELECT count(tp.id) as total FROM tb_penjualan tp
        join tb_toko tt on tp.id_toko = tt.id
        ")->row();
        // retur
        $data['t_retur'] = $this->db->query("SELECT count(tp.id) as total FROM tb_retur tp
        join tb_toko tt on tp.id_toko = tt.id
        ")->row();
        // Toko baru
        $data['list_toko_baru'] = $this->db->query("SELECT tt.*, tu.nama_user  from tb_toko tt
        left JOIN tb_user tu on tt.id_spv = tu.id
        where tt.status = '3'
        order by tt.id desc limit 5")->result();
        // selisih penerimaan
        $data['selisih'] = $this->db->query("SELECT tp.*, tt.nama_toko from tb_pengiriman tp
        JOIN tb_toko tt on tp.id_toko = tt.id
        where tp.status = '1'
        order by tp.id desc limit 5")->result();
        // list belum SO
        $data['so_toko'] = $this->db->query("SELECT tt.*, tu.nama_user from tb_toko tt
        JOIN tb_user tu on tt.id_spg = tu.id
        where tt.status_so = '0'
        order by tt.id desc limit 5")->result();
       
        $this->template->load('template/template', 'audit/dashboard', $data);
    
  }



}
?>
