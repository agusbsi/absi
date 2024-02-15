<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "10"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }  
   
  }

  //   halaman utama
  public function index()
  {
    $data['title'] = 'Master Artikel';
    $data['list_data'] = $this->db->query("SELECT * from tb_produk where status = '1' order by id desc")->result();
    $this->template->load('template/template', 'audit/artikel/lihat_data', $data); 
  }



}
?>