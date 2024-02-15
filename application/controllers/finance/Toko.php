<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toko extends CI_Controller
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

  public function index()
  {
    $data['title'] = 'Master Toko';
    $data['toko'] = $this->db->query("SELECT tt.*, tu.nama_user as leader, tuu.nama_user as spv, tspg.nama_user as spg
    from tb_toko tt
    left join tb_user tu on tt.id_leader = tu.id
    left join tb_user tuu on tt.id_spv = tuu.id
    left join tb_user tspg on tt.id_spg = tspg.id
    where tt.status = 1
    order by tt.id desc")->result();
    $this->template->load('template/template', 'finance/toko/index', $data);
  }
}
?>
