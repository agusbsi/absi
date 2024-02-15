<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $role = $this->session->userdata('role');
    if ($role == null) {
      redirect(base_url());
    }
    $this->load->model('M_admin');
    $this->load->model('M_support');
    $this->load->model('M_login');
  }
  public function index()
  {
    $id = $this->session->userdata('id');
    $role = $this->session->userdata('role');
    $data['title'] = 'FAQ';
    $data['profil'] = $this->db->query("SELECT * FROM tb_user WHERE id = '$id'")->row();
    $data['lihat_role'] = $this->db->query("SELECT * FROM tb_user_role WHERE id = '$role'")->row();
    $data['foto'] = "img/profil/".$id.".jpg";
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('username'));
    $this->template->load('template/template', 'faq/index', $data);
  }
}
?>