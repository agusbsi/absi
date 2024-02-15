<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "2"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
 
    $this->load->model('M_spg');
  }

  public function index(){
   
        $id_spv = $this->session->userdata('id');
        $id_toko = $this->session->userdata('id_toko');
        $data['title'] = 'Dashboard';
        $data['t_toko'] = $this->db->query("SELECT count(id) as total from tb_toko where id_spv = '$id_spv' and status != 0")->row();
        $data['t_minta'] = $this->db->query("SELECT count(tp.id) as total FROM tb_permintaan tp
        join tb_toko tt on tp.id_toko = tt.id
        WHERE tt.id_spv = '$id_spv'")->row();
        $data['t_jual'] = $this->db->query("SELECT count(tp.id) as total FROM tb_penjualan tp
        join tb_toko tt on tp.id_toko = tt.id
        WHERE tt.id_spv = '$id_spv'")->row();
        $data['t_retur'] = $this->db->query("SELECT count(tp.id) as total FROM tb_retur tp
        join tb_toko tt on tp.id_toko = tt.id
        WHERE tt.id_spv = '$id_spv'")->row();
        $data['list_jual'] = $this->db->query("SELECT tp.*, tk.nama_toko from tb_penjualan tp
        JOIN tb_toko tk on tp.id_toko = tk.id
        where tk.id_spv = '$id_spv' order by tp.id desc limit 5")->result();
        $data['toko_aktif'] = $this->db->query("SELECT  tk.*,tu.nama_user, count(tp.id_toko) as total from tb_toko tk
        join tb_penjualan tp on tk.id = tp.id_toko
        join tb_user tu on tk.id_leader = tu.id
        where tk.id_spv = '$id_spv' GROUP BY tp.id_toko order by total DESC limit 5")->result();
        $this->template->load('template/template', 'spv/dashboard', $data);
    
  }



}
?>
