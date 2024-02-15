<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class So extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "7"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_admin');
    $this->load->model('M_support');

  }
  public function index()
  {
    $data['title'] = 'Stok Opname';
    $data['list_toko'] = $this->db->query("SELECT tb_toko.*, tb_user.nama_user from tb_toko
    join tb_user on tb_toko.id_spg = tb_user.id where tb_toko.status = 1 order by tb_toko.id desc")->result();
    $data['list_data'] = $this->M_support->lihat_data()->result();
    $data['selisih'] = $this->M_support->lihat_data_selisih()->result();
    $this->template->load('template/template', 'hrd/so/index', $data);
  }

}
?>
