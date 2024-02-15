<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('M_user');
    $this->load->model('M_admin');
    $role = $this->session->userdata('role');
    if($role != "10"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
  }

  public function index()
  {
    $data['title'] = 'Kelola User';
    $data['list_role'] = $this->db->query("SELECT * from tb_user_role where id != '1' and id != '7'")->result();
    $data['list_users'] = $this->db->query('SELECT tb_user.* , tb_user_role.nama FROM tb_user JOIN tb_user_role ON tb_user.role = tb_user_role.id WHERE deleted_at is null order by tb_user.id desc')->result();
    $this->template->load('template/template', 'audit/user/index', $data);
  }

   
}

?>
