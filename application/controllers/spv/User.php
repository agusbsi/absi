<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('M_spv');
    $role = $this->session->userdata('role');
    if($role != "2"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
  }

  public function index()
  {
    $id_spv = $this->session->userdata('id');
    $data['title'] = 'Kelola User';
    $data['list_users'] = $this->db->query("SELECT tb_user.*  
    FROM tb_user 
    JOIN tb_toko ON tb_user.id = tb_toko.id_leader
    WHERE tb_user.deleted_at is null and role = '3' and tb_toko.id_spv = '$id_spv' group by tb_user.nama_user order by tb_user.id desc")->result();
    $this->template->load('template/template', 'spv/user/lihat_data', $data);
  }

  

  
 
  
}

?>
