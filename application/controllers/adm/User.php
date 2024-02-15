<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('M_user');
    $this->load->model('M_admin');
    if($this->session->userdata('status') != 'login' && $this->session->userdata('role') != 1)
    {
      $this->session->set_flashdata('msg','Anda Belum Login!');
      redirect(base_url('login'));
    }
  }

  public function index()
  {
    $data['title'] = 'User';
    $data['list_role'] = $this->M_admin->select('tb_user_role');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $data['list_users'] = $this->db->query('SELECT * from tb_user WHERE deleted_at is null')->result();
    $this->template->load('template/template', 'adm/user/index', $data);
  }

  public function reset_password($id)
  {
    $password = "password";
    $where = array(
      'id' => $id,
    );
    $data = array(
      'password' => password_hash($password,PASSWORD_DEFAULT),
      'updated_at' => date('Y-m-d H:i:s'),
    );
    $this->M_admin->update('tb_user',$data,$where);  
    tampil_alert('success','Berhasil','Password User berhasil direset');
    redirect(base_url('adm/user'));
  }

  private function hash_password($password)
  {
    return password_hash($password,PASSWORD_DEFAULT);
  }

  public function tambah(){
    $data['title'] = 'Tambah-User';
    $data['list_satuan'] = $this->M_admin->select('tb_user');
    $data['list_role'] = $this->db->query('SELECT * FROM tb_user_role ORDER BY id')->result();
    
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->template->load('admin/template/template', 'admin/user/form_insert', $data);
  }
  
  public function proses_tambah() {
    $this->form_validation->set_rules('username','Username','required');
    $this->form_validation->set_rules('pass','Password','required');
    $this->form_validation->set_rules('konfirm','Confirm password','required|matches[pass]');
    $this->form_validation->set_rules('nama_user','Nama User','required');
    $this->form_validation->set_rules('no_telp','Nomor Telpon','required');
    $this->form_validation->set_rules('role','Role','required');

    if($this->form_validation->run() == TRUE )
    {
        $username     = $this->input->post('username',TRUE);
        $password     = $this->input->post('pass',TRUE);
        $nama_user     = $this->input->post('nama_user',TRUE);
        $no_telp     = $this->input->post('no_telp',TRUE);
        $role         = $this->input->post('role',TRUE);
        $data = array(
              'username'     => $username,
              'nama_user'    => $nama_user,
              'no_telp'      => $no_telp,
              'password'     => $this->hash_password($password),
              'role'         => $role,
              'status'       => "1",
        );
        $cek = $this->db->query("SELECT * FROM tb_user WHERE username = '$username' AND deleted_at is null")->num_rows();
        if ($cek > 0) {
          tampil_alert('info','Information','User sudah ada!');
          redirect(base_url('adm/user')); 
        }else{
        $this->M_admin->insert('tb_user',$data);
        tampil_alert('success','Berhasil','Data User Ditambahkan'); 
        redirect(base_url('adm/user'));  
        }
    }else{
        tampil_alert('error','Gagal','Password tidak sama!');        
        redirect(base_url('adm/user'));
    }
  }

  public function update($id)
  {
    $where = array('id' => $id);
    $data['title'] = 'Update User';
    $data['data_update'] = $this->M_admin->get_data('tb_user',$where);
    $data['list_role'] = $this->db->query('SELECT * FROM tb_user_role ORDER BY id')->result();
    $data['list_data'] = $this->db->query("SELECT tb_user.* , tb_user_role.nama, tb_user_role.id as id FROM tb_user JOIN tb_user_role ON tb_user.role = tb_user_role.id WHERE tb_user.id=$id")->row();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->template->load('admin/template/template', 'admin/user/form_update', $data);
  }
   public function proses_update()
  {
    $this->form_validation->set_rules('username','Username','required');
    $this->form_validation->set_rules('role','Role', 'required');

    if($this->form_validation->run() == TRUE)
    {
      $id           = $this->input->post('id',TRUE);        
      $username     = $this->input->post('username',TRUE);
      $role         = $this->input->post('role',TRUE);
      $status       = "2";
      $where = array('id' => $id);
      $data = array(
            'username'     => $username,
            'role'         => $role,
            'status'       => $status,
            
      );
      $this->M_admin->update('tb_user',$data,$where);
      $this->session->set_flashdata('msg_berhasil','Data Role Berhasil Diupdate');
      redirect(base_url('adm/user'));
    }else{
      tampil_alert('errro','Gagal','User Gagal di Update!');
      $this->load->view('adm/user');
    }
  }
  // hapus
  function hapus()
    {
        $id = $this->uri->segment(4);
        $where = array('id' => $id);
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s'),
            'status' => 2,
        );
        $this->M_admin->update('tb_user',$data,$where);
        $this->session->set_flashdata('message', 'Data Barang berhasil dihapus!');
        redirect('adm/User');
    }
  // detail
  public function detail($id)
  {
    $where = array('id' => $id);
    $data['title'] = 'User';
    $data['foto'] = $this->db->query("SELECT * FROM tb_user WHERE id = '$id'")->row();
    $data['detail'] = $this->db->query("SELECT tb_user.* , tb_user_role.nama as role_akses, tb_jenis_bank.nama_bank FROM tb_user JOIN tb_user_role ON tb_user.role = tb_user_role.id JOIN tb_jenis_bank ON tb_jenis_bank.id = tb_user.type_bank WHERE tb_user.id = '$id'")->row();
    
    $this->template->load('template/template', 'adm/user/detail',$data);
  }
  
}

?>
