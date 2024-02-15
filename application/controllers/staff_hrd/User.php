<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('M_user');
    $this->load->model('M_admin');
    $role = $this->session->userdata('role');
    if($role != "11"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
  }

  public function index()
  {
    $data['title'] = 'Kelola User';
    $data['list_role'] = $this->db->query("SELECT * from tb_user_role where id != '1' and id != '7'")->result();
    $data['list_users'] = $this->db->query("SELECT tb_user.* , tb_user_role.nama, tb_jenis_bank.nama_bank FROM tb_user JOIN tb_user_role ON tb_user.role = tb_user_role.id JOIN tb_jenis_bank ON tb_user.type_bank = tb_jenis_bank.id WHERE deleted_at is null order by tb_user.id desc")->result();
    $data['list_bank'] = $this->db->query("SELECT * FROM tb_jenis_bank ORDER BY nama_bank ASC")->result();
    $this->template->load('template/template', 'staff_hrd/user/index', $data);
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
    redirect(base_url('staff_hrd/user'));
  }

  private function hash_password($password)
  {
    return password_hash($password,PASSWORD_DEFAULT);
  }

  // proses tambah terbaru 2 foto
  public function proses_tambah_baru()
  {
    $this->form_validation->set_rules('pass','Password','required');
    $this->form_validation->set_rules('konfirm','Confirm password','required|matches[pass]');
    
    if($this->form_validation->run() == TRUE)
    {
      $this->db->trans_start();
      $nik            = $this->input->post('nik_ktp');
        // Proses upload foto KTP
        $config['upload_path'] = 'assets/img/user/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['file_name'] = 'ktp_'.$nik;
        $config['overwrite'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('ktp')) {
            $ktp = $this->upload->data('file_name');
        } else {
            $ktp  = "";
            // Tampilkan error jika upload foto KTP gagal
        }

        // Proses upload foto selfie
        $config['upload_path'] = 'assets/img/user/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['file_name'] = 'selfie_'.$nik;
        $config['overwrite'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('selfi')) {
            $selfie = $this->upload->data('file_name');
        } else {
            $selfie = "";
            // Tampilkan error jika upload foto selfie gagal
        }
      
    //  data
      $username       = $this->input->post('username');
      $password       = $this->input->post('pass');
      $nama_user      = $this->input->post('nama');
      $no_telp        = $this->input->post('telp');
      $role           = $this->input->post('id_role');
      $nik            = $this->input->post('nik_ktp');
      $alamat         = $this->input->post('alamat');
      $no_rek         = $this->input->post('no_rek');
      $email          = $this->input->post('email');
      $bank           = $this->input->post('id_bank');
      // Simpan data user ke dalam database
      $data = array(
      'username'      => $username,
      'nama_user'     => $nama_user,
      'no_telp'       => $no_telp,
      'password'      => $this->hash_password($password),
      'role'          => $role,
      'status'        => "0",
      'nik_ktp'       => $nik,
      'alamat'        => $alamat,
      'email'         => $email,
      'rek_bank'      => $no_rek,
      'type_bank'     => $bank,
      'foto_ktp'      => $ktp,
      'foto_diri'     => $selfie
      );
      $this->M_admin->insert('tb_user',$data);
      $this->db->trans_complete();
      $hp = $this->db->query("SELECT no_telp FROM tb_user WHERE id = 61")->row();
      $phone = $hp->no_telp;
      $message = "Anda memiliki 1 Permintaan User baru yang perlu approve silahkan kunjungi s.id/absi-app";
      kirim_wa($phone,$message);
      tampil_alert('success','Berhasil','Data User Berhasil di buat');
      redirect(base_url('staff_hrd/user'));
    }else
    {
      tampil_alert('error','Information','Password Tidak Sama!');
      redirect(base_url('staff_hrd/user'));
    }
  }

  public function cek_nik() 
    {
      $nik = $this->input->post('nik');
      // Cek apakah NIK sudah ada di tabel my_table
      $result = $this->db->get_where('tb_user', array('nik_ktp' => $nik))->result();
      
      if (count($result) > 0) {
        // NIK sudah ada di tabel, kirim respons TRUE
        echo json_encode(TRUE);
        return;
      }
      
      // NIK belum ada di tabel, kirim respons FALSE
      echo json_encode(FALSE);
    }
    public function cek_username() 
    {
      $username = $this->input->post('username');
      // Cek apakah NIK sudah ada di tabel my_table
      $result = $this->db->get_where('tb_user', array('username' => $username))->result();
      
      if (count($result) > 0) {
        // NIK sudah ada di tabel, kirim respons TRUE
        echo json_encode(TRUE);
        return;
      }
      
      // NIK belum ada di tabel, kirim respons FALSE
      echo json_encode(FALSE);
    }

  public function detail($id)
  {
    $where = array('id' => $id);
    $data['title'] = 'Kelola User';
    $data['foto'] = $this->db->query("SELECT * FROM tb_user WHERE id = '$id'")->row();
    $data['detail'] = $this->db->query("SELECT tb_user.* , tb_user_role.nama as role_akses, tb_jenis_bank.nama_bank FROM tb_user JOIN tb_user_role ON tb_user.role = tb_user_role.id JOIN tb_jenis_bank ON tb_jenis_bank.id = tb_user.type_bank WHERE tb_user.id = '$id' ORDER BY tb_user.role ASC")->row();
    
    $this->template->load('template/template', 'staff_hrd/user/detail',$data);
  }
 
   
}

?>
