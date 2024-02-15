<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('M_admin');
    $this->load->model('M_login');
    $this->load->model('M_support');
  }
  public function index()
  {
    if($this->session->userdata('status') == 'login' && $this->session->userdata('role') == 5){
        $id = $this->session->userdata('id');
        $role = $this->session->userdata('role');
        $data['title'] = 'Profile';
        $data['profil'] = $this->db->query("SELECT * FROM tb_user WHERE id = '$id'")->row();
        $data['lihat_role'] = $this->db->query("SELECT * FROM tb_user_role WHERE id = '$role'")->row();
        $data['foto'] = "img/profil/".$id.".jpg";
        $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('username'));
        $this->template->load('template/template', 'adm_gudang/profil/index', $data);
    }else {
        redirect(base_url('login'));
    }
  }

  public function upload_profil()
  {
        $id = $this->input->post('id');
        $config['upload_path']    = 'img/profil';
        $config['allowed_types']  = 'jpg|jpeg';
        $config['file_name']      = $id.".jpg";
        $config['overwrite']      = TRUE;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $cek = $this->upload->do_upload('foto_profil');
        if ($cek != 1) {
          $this->session->set_flashdata('msg_tidak','Gagal upload foto profil silahkan cek format foto (.JPG/.PNG)');
          redirect(base_url('adm_gudang/profile'));
        }else{
        $this->session->set_flashdata('upload_profil', 'Foto berhasil diupload');
        redirect(base_url('adm_gudang/profile'));          
        }
  }

  private function hash_password($password)
  {
    return password_hash($password,PASSWORD_DEFAULT);
  }
  
  public function ganti_password()
  {
    if ($this->session->userdata('status') ==  'login' && $this->session->userdata('role') == 5)
    {
    $this->form_validation->set_rules('pass_lama','Password Lama','required');
    $this->form_validation->set_rules('pass_baru','Password Baru','required');
    $this->form_validation->set_rules('konfirm','Konfirmasi Password','required|matches[pass_baru]');
      if ($this->form_validation->run() == TRUE )
      {
        $username = $this->session->userdata('username', TRUE);
        $id = $this->input->post('id_user');
        $pass_lama = $this->input->post('pass_lama', TRUE);
        $pass_baru = $this->input->post('pass_baru', TRUE);
        $konfirm = $this->input->post('konfirm', TRUE);
        $cek = $this->M_support->cek_pass('tb_user',$username);
        if ($cek->num_rows() != 1) {
          $this->session->set_flashdata('msg_tidak','Password lama salah!');
          redirect(base_url('adm_gudang/profile'));
        }else{
          $isi= $cek->row();
          if (password_verify($pass_lama, $isi->password) === TRUE) {
            $data = array
            (
              'password' => $this->hash_password($pass_baru)
            );
            $where = array
            (
              'id' => $id
            );
            $this->M_admin->update_password('tb_user', $where, $data);
            $this->session->set_flashdata('msg_success','Berhasil Ganti Password! Silahkan Re-Login');
            redirect(base_url('login'));
          }else{
            $this->session->set_flashdata('msg_tidak','Password lama salah!');
            redirect(base_url('adm_gudang/profile'));
          }
        }
      }
    }
  }
  public function logout()
  {
    if($this->session->userdata('status') == 'login' && $this->session->userdata('role') == 5)
    {
      session_destroy();
      redirect(base_url('login'));
    }
  } 
}
?>