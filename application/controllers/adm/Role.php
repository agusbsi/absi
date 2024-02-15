<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller{

  public function __construct(){
    parent::__construct();
    if($this->session->userdata('status') != 'login' && $this->session->userdata('role') != 1){
        redirect(base_url());
    }    
    $this->load->model('M_user');
    $this->load->model('M_admin');

  }

  public function index(){
    $data['title'] = 'Data Role';
    $data['list_role'] = $this->M_admin->select('tb_user_role');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->template->load('admin/template/template', 'admin/role/index', $data);
  }
  public function signout()
  {
    session_destroy();
    redirect(base_url('login'));
  }
  public function tambah(){
    $data['title'] = 'Tambah-Role';
    $data['list_satuan'] = $this->M_admin->select('tb_user_role');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->template->load('admin/template/template', 'admin/role/form_insert', $data);
  }
  public function proses_tambah() {
    $this->form_validation->set_rules('nama_role','Nama Role','required');

    if($this->form_validation->run() == TRUE )
    {
        $nama_role     = $this->input->post('nama_role',TRUE);
        $data = array(
              'nama'     => $nama_role,
        );
        $this->M_admin->insert('tb_user_role',$data);
        $this->session->set_flashdata('msg_berhasil','User Berhasil Ditambahkan');
        redirect(base_url('Role'));
    }else {
        $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
        $this->session->set_flashdata('msg_gagal','User Gagal Ditambahkan!');        
        redirect(base_url('tambah'));
    }
  }
  public function update($id)
  {
    $where = array('id' => $id);
    $data['title'] = 'Update Role';
    $data['data_update'] = $this->M_admin->get_data('tb_user_role',$where);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->template->load('admin/template/template', 'admin/role/form_update', $data);
  }
   public function proses_update()
  {
    $this->form_validation->set_rules('nama_role','Nama Role','required');

    if($this->form_validation->run() == TRUE)
    {
      $id             = $this->input->post('id_role',TRUE);
      $nama           = $this->input->post('nama_role',TRUE);
      $where = array('id' => $id);
      $data = array(
            'id'            => $id,
            'nama'          => $nama
            
      );
      $this->M_admin->update('tb_user_role',$data,$where);
      $this->session->set_flashdata('msg_berhasil','Data Role Berhasil Diupdate');
      redirect(base_url('role'));
    }else{
      $this->load->view('role/form_update');
    }
  }
    public function delete()
  {
    $uri = $this->uri->segment(3);
    $where = array('id' => $uri);
    $this->M_admin->delete('tb_user_role',$where);
    redirect(base_url('role'));
  }  
}
 ?>