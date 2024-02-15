<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "6"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_admin');
    $this->load->model('M_support');
  }

  public function index()
  {
    $data['title'] = 'Kelola Customer';
    $data['customer'] = $this->db->query("SELECT tc.*, count(tt.id) as total_toko FROM tb_customer tc
    left join tb_toko tt on tt.id_customer = tc.id 
    where tc.deleted_at is null group by tc.nama_cust order by tc.id desc ")->result();
    $this->template->load('template/template', 'manager_mv/customer/index', $data);
  }
  public function detail($id_customer)
  {
    $data['title'] = 'Kelola Customer';
    $data['customer'] = $this->db->query("SELECT * from tb_customer where id ='$id_customer'")->row();
    $data['list_toko'] = $this->db->query("SELECT tb_toko.*, tu.nama_user as spv,tuu.nama_user as leader, tuuu.nama_user as spg from tb_toko
    join tb_customer tc on tb_toko.id_customer = tc.id
    join tb_user tu on tb_toko.id_spv = tu.id
    join tb_user tuu on tb_toko.id_leader = tuu.id
    left join tb_user tuuu on tb_toko.id_spg = tuuu.id
    where tb_toko.id_customer ='$id_customer'")->result();
    $this->template->load('template/template', 'manager_mv/customer/detail', $data);
  }
 
}
?>