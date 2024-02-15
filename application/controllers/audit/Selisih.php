<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Selisih extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "10"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_support');
  }
  public function index()
  {
    $data['title'] = 'Kelola Selisih';
    $data['list_data'] = $this->M_support->lihat_data()->result();
    // list Selisih
		$data['selisih'] = $this->db->query("SELECT tp.*, tu.nama_user, tk.nama_toko from tb_pengiriman tp
    JOIN tb_toko tk on tp.id_toko = tk.id
    JOIN tb_user tu on tk.id_spg = tu.id
    where tp.status = '1'
    order by tp.id desc")->result();
    $this->template->load('template/template', 'audit/selisih/index', $data);
  }
  public function detail($no_kirim)
  {
    $data['title'] = 'Kelola Selisih';
    $data['permintaan'] = $this->M_support->get_data_selisih($no_kirim);
    $data['detail_selisih'] = $this->M_support->get_data_selisih_detail($no_kirim);
    $this->template->load('template/template', 'audit/selisih/detail',$data);
  }

}
?>