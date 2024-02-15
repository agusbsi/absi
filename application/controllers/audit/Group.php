<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "10"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_admin');
    $this->load->model('M_support');
  }

  public function index()
  {
    $data['title'] = 'Kelola Group';
    $data['list_group'] = $this->db->query("SELECT tb_grup.*,tb_toko.nama_toko, count(tb_info.id_toko) as toko FROM tb_grup 
    left join tb_info on tb_grup.id = tb_info.id_grup
    left join tb_toko on tb_info.id_toko = tb_toko.id
    where tb_grup.deleted_at is null ORDER BY tb_grup.nama_grup ASC ")->result();
    $this->template->load('template/template', 'audit/group/index', $data);
  }
 // detail permintaan
 public function detail($id_group)
 {
   
     $data['title'] = 'Kelola Group';
     $data['list_group'] = $this->db->query("SELECT tb_grup.*,count(tb_info.id_toko) as toko FROM tb_grup 
     join tb_info on tb_grup.id = tb_info.id_grup
     where tb_grup.deleted_at is null and tb_grup.id = '$id_group' ORDER BY tb_grup.nama_grup  ASC ")->result();
     $data['list_toko'] = $this->db->query("SELECT tb_info.*, tb_toko.nama_toko, tb_toko.alamat from tb_info
     join tb_toko on tb_info.id_toko = tb_toko.id
     where tb_info.id_grup = '$id_group'")->result();

     $this->template->load('template/template', 'audit/group/detail',$data);
  
 }


}
?>