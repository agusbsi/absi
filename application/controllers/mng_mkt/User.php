<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    
    $role = $this->session->userdata('role');
    if($role != "9"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_admin');
  }

  public function index()
  {
    $data['title'] = 'User';
    $data['list_role'] = $this->M_admin->select('tb_user_role');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $data['list_users'] = $this->db->query('SELECT * from tb_user WHERE deleted_at is null')->result();
    $this->template->load('template/template', 'manager_mkt/user/index', $data);
  }

  

  
 
  
}

?>
