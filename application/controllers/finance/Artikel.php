<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel extends CI_Controller
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
    $this->load->model('M_admin');
  }

  public function index()
  {
    $data['title'] = 'Master Artikel';
    $data['list_data'] = $this->db->query("SELECT * FROM tb_produk WHERE deleted_at is null order by kode asc")->result();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
      $this->template->load('template/template', 'finance/produk/index', $data);
  }
}
?>
