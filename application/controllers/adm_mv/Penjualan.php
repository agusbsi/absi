<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

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
    $data['title'] = 'Report Penjualan Toko';
    $data['list_data'] = $this->M_support->lihat_data_penjualan()->result();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('username'));
    $this->template->load('template/template', 'admin_mv/penjualan/index', $data);
  }
  public function detail($no_penjualan)
  {
    $data['title'] = 'Report Penjualan Toko';
    $data['permintaan'] = $this->M_support->get_data_penjualan($no_penjualan);
    $data['detail_permintaan'] = $this->M_support->get_data_penjualan_detail($no_penjualan);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('username'));
    $this->template->load('template/template', 'admin_mv/penjualan/detail',$data);
  
  }
  public function approve()
  {
    $id     = $this->input->post('id_permintaan',TRUE);
    $where  = array('id' => $id);
    $status = '1';
    $data   = array(
          'status'  => $status,
    );
    $this->M_admin->update('tb_permintaan',$data,$where);
    $this->session->set_flashdata('msg_berhasil','Data Permintaan Berhasil Diupdate');
    redirect(base_url('adm_mv/penjualan'));
  } 
}
?>