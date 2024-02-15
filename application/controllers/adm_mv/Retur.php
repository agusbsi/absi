<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retur extends CI_Controller {

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
    $data['title'] = 'Retur Barang';
    $data['list_data'] = $this->M_support->lihat_data_retur()->result();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('username'));
    $this->template->load('template/template', 'admin_mv/retur/index', $data);
  }
  public function detail($no_retur){
    $data['title'] = 'Retur Barang';
    $data['retur'] = $this->M_support->get_data_retur($no_retur);
    $data['detail_retur'] = $this->M_support->get_data_retur_detail($no_retur);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('username'));
    $this->template->load('template/template', 'admin_mv/retur/detail',$data);
  }
  public function approve()
  {
    $id = $this->uri->segment(4);
    $update = $this->input->post('updated');
    $where = array('id' => $id);
    $data = array(
      'status' => '1',
      'updated_at' => $update,
    );
    $this->M_admin->update('tb_retur',$data,$where);
    $got_id = $this->db->query("SELECT id_toko,id_user FROM tb_retur where id = '$id'")->row();
    $id_toko = $got_id->id_toko;
    $got_name = $this->db->query("SELECT nama_toko FROM tb_toko WHERE id_toko = '$id_toko'")->row();
    $nama_toko = $got_name->nama_toko;
    $id_user = $got_id->id_user;
    $hp = $this->db->query("SELECT no_telp FROM tb_user WHERE id = '$id_user'")->row();
    $phone = $hp->no_telp;
    $message = "Pengajuan Retur yang anda ajukan ( $nama_toko ) sudah diapprove, silahkan kunjungi s.id/absi-app";
    kirim_wa($phone,$message);
    tampil_alert('success','Berhasil','');
    redirect(base_url('leader/retur'));
  }
  public function tolak()
  {
    $id = $this->uri->segment(4);
    $where = array('id' => $id);
    $data = array(
      'status' => '4',
    );
    $this->M_admin->update('tb_retur',$data,$where);
    tampil_alert('success','Berhasil','Pengajuan Retur telah ditolak!!');
    redirect(base_url('leader/retur'));
  } 
}
?>