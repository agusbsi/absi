<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Selisih extends CI_Controller {

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
    $data['title'] = 'Selisih Penerimaan';
    $data['selisih'] = $this->M_support->lihat_data_selisih()->result();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('username'));
    $this->template->load('template/template', 'manager_mv/selisih/index', $data);
  }
  public function detail($no_kirim)
  {
    $data['title'] = 'Selisih Penerimaan';
    $data['permintaan'] = $this->M_support->get_data_selisih($no_kirim);
    $data['detail_selisih'] = $this->M_support->get_data_selisih_detail($no_kirim);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('username'));
    $this->template->load('template/template', 'manager_mv/selisih/detail',$data);
  }

  public function proses_update()
  {
    $this->form_validation->set_rules('catatan','Update Selisih','required');
    
    if($this->form_validation->run() == TRUE)
    {
      $id           = $this->input->post('id',TRUE);
      $id_permintaan = $this->input->post('id_permintaan', TRUE);        
      $catatan         = $this->input->post('catatan',TRUE);
      date_default_timezone_set('Asia/Jakarta');
      $update_at    = date('Y-m-d h:i:s');
      $where = array('id' => $id);
      $data = array(
            'catatan_selisih' => $catatan,   
            'updated_at' => $update_at, 
            'status'  => '2'
      );
      $this->M_admin->update('tb_pengiriman',$data,$where);
      tampil_alert('success','Berhasil','Data Selisih Berhasil diselesaikan!');
      redirect(base_url('sup/selisih/'));
    }else{
      tampil_alert('error','Gagal','Data Selisih Gagal diselesaikan!');
      redirect(base_url('sup/selisih/detail'));
    }
  }
}
?>