<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class So extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "8"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));

    }
    $this->load->model('M_admin');
    $this->load->model('M_support');
  }
  public function index()
  {
    $data['title'] = 'Management Stock Opname';
    $data['list_data'] = $this->db->query("SELECT tb_toko.id, tb_toko.nama_toko, tb_toko.alamat, tb_toko.telp, date(tb_toko.tgl_so) as tgl_so, tb_user.id as id_user,tb_user.nama_user FROM tb_toko JOIN tb_user ON tb_toko.id_spv = tb_user.id WHERE tb_toko.deleted_at is NULL")->result();
    $data['list_spv'] = $this->db->query("SELECT * FROM tb_user WHERE role = 2")->result();
    // var_dump($data['list_data']);
    // die;
    $data['id_toko'] = $this->M_support->kode_toko();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
      $this->template->load('template/template', 'admin_mv/stokopname/index', $data);
  }

  public function detail()
  {
    $tgl_awal = $this->input->get('tgl_awal');
    $tgl_akhir = $this->input->get('tgl_akhir');
    $id_toko = $this->input->get('id_toko');
    $data['title'] = 'Management Stock Opname';
    $data['toko']  = $this->db->query("SELECT * from tb_toko where id = '$id_toko'")->row();
    // $data['list_so'] = $this->db->query("SELECT created_at from tb_so group by MONTH(created_at)")->result();
    $data['list_data'] = $this->db->query("SELECT tb_so.created_at, tb_so.id, tb_user.nama_user, tb_toko.nama_toko, tb_toko.alamat, tb_toko.id as id_toko, tb_user.id as id_user from tb_so JOIN tb_toko ON tb_toko.id = tb_so.id_toko JOIN tb_user ON tb_user.id = tb_so.id_user where tb_so.id_toko ='$id_toko' AND date(tb_so.created_at) between '$tgl_awal' and '$tgl_akhir'")->result();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('username'));
    $this->template->load('template/template', 'admin_mv/stokopname/detail',$data);
  }

  public function detail_so($no_so)
  {
   $data['title'] = 'Management Stock Opname';
   $data['so'] = $this->M_support->get_so($no_so);
   $data['detail'] = $this->M_support->detail_so($no_so);
   $this->load->view('admin_mv/stokopname/detail_print_so',$data);
  }

}
?>