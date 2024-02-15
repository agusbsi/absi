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
    if($role != "7" && $role != "1" && $role != "11"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
  }

  public function index()
  {
    $data['title'] = 'Kelola User';
    $data['list_role'] = $this->db->query("SELECT * from tb_user_role ")->result();
    $data['list_users'] = $this->db->query('SELECT tb_user.* , tb_user_role.nama, tb_jenis_bank.nama_bank FROM tb_user JOIN tb_user_role ON tb_user.role = tb_user_role.id JOIN tb_jenis_bank ON tb_user.type_bank = tb_jenis_bank.id WHERE deleted_at is null order by tb_user.id desc')->result();
    $data['list_bank'] = $this->db->query("SELECT * FROM tb_jenis_bank ORDER BY nama_bank ASC")->result();
    $this->template->load('template/template', 'hrd/user/index', $data);
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
    redirect(base_url('hrd/user'));
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
        'status'        => "1",
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
                tampil_alert('success','Berhasil','Data User Berhasil di buat');
                redirect(base_url('hrd/user'));
      }else
      {
        tampil_alert('error','Information','Password Tidak Sama!');
        redirect(base_url('hrd/user'));
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
    
     private function set_upload_options()
     {
       $config = array();
       $config['upload_path'] = 'assets/img/user/';
       $config['allowed_types']    = 'jpg|jpeg|png';
       $config['max_size']         = '2048'; // 2 MB
       $config['quality']= '50%';
       $config['overwrite'] = TRUE;
       $config['remove_spaces'] = TRUE;
     
       return $config;
     }
     public function update($id)
     {
       $data['title'] = 'Kelola User';
       $data['detail'] = $this->db->query("SELECT tb_user.* , tb_user_role.nama as role_akses, tb_jenis_bank.nama_bank FROM tb_user JOIN tb_user_role ON tb_user.role = tb_user_role.id JOIN tb_jenis_bank ON tb_jenis_bank.id = tb_user.type_bank WHERE tb_user.id = '$id'")->row();
       $data['tipe_bank'] = $this->db->query("SELECT * from tb_jenis_bank")->result();
       $data['role'] = $this->db->query("SELECT * from tb_user_role ")->result();
       $this->template->load('template/template', 'hrd/user/update',$data);
     }
   
     //  Update detail toko
  public function proses_update()
  {
    $id_user          = $this->input->post('id_user');
    $nama_lengkap     = $this->input->post('nama_lengkap');
    $nik              = $this->input->post('nik');
    $no_telp          = $this->input->post('no_telp');
    $email            = $this->input->post('email');
    $alamat           = $this->input->post('alamat');
    $type_bank        = $this->input->post('type_bank');
    $no_rek           = $this->input->post('no_rek');
    $role             = $this->input->post('role');
    $updated          = date('Y-m-d H:i:s');

    $data = array(
      'nama_user'     => $nama_lengkap,
      'nik_ktp'       => $nik,
      'no_telp'       => $no_telp,
      'email'         => $email,
      'alamat'        => $alamat,
      'type_bank'     => $type_bank,
      'rek_bank'      => $no_rek,
      'role'          => $role,
      'updated_at'    => $updated
    );
    $where = array(
      'id'  => $id_user
    );
    $this->db->update('tb_user',$data,$where);
    tampil_alert('success','Berhasil','Data User berhasil di Perbaharui!');
    redirect(base_url('hrd/user/update/'.$id_user));
  }
  // update foto selfi
  public function update_foto_selfi() 
  {
    $id_user =  $this->input->post('id_user_selfi');
    $nik_hidden =  $this->input->post('nik_hidden');
    $config['upload_path'] = 'assets/img/user/';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['max_size'] = '2048';
    $config['file_name'] = 'selfie_'.$nik_hidden;
    $config['overwrite'] = TRUE;
    $config['remove_spaces'] = TRUE;
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    
    if (!$this->upload->do_upload('foto_diri')) {
    
    } else {
      // Jika upload berhasil, simpan data foto ke database
      $foto = $this->upload->data('file_name');
      $id_user =  $this->input->post('id_user_selfi');
      // simpan data foto ke database sesuai dengan id data yang ingin diupdate
      $this->db->query("UPDATE tb_user set foto_diri ='$foto' where id='$id_user'");
      $data['user'] = $this->db->query("SELECT * from tb_user where id = '$id_user'")->row();
      $data['pesan'] = "berhasil di update";
      echo json_encode($data);
      
    }
  }
  // update foto toko
  public function update_foto() 
  {
    $id_user =  $this->input->post('id_user_ktp');
    $nik_h =  $this->input->post('nik_h');
    $config['upload_path'] = 'assets/img/user/';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['max_size'] = '2048';
    $config['file_name'] = 'ktp_'.$nik_h;
    $config['overwrite'] = TRUE;
    $config['remove_spaces'] = TRUE;
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    
    if (!$this->upload->do_upload('foto')) {
    
    } else {
      // Jika upload berhasil, simpan data foto ke database
      $foto = $this->upload->data('file_name');
      $id_user =  $this->input->post('id_user_ktp');
      // simpan data foto ke database sesuai dengan id data yang ingin diupdate
      $this->db->query("UPDATE tb_user set foto_ktp ='$foto' where id='$id_user'");
      $data['user'] = $this->db->query("SELECT * from tb_user where id = '$id_user'")->row();
      $data['pesan'] = "berhasil di update";
      echo json_encode($data);
      
    }
  }
  // Aktif
  function aktif()
  {
      $id = $this->uri->segment(4);
      $where = array('id' => $id);
      $data = array(
          'updated_at' => date('Y-m-d H:i:s'),
          'status' => 1,
      );
      $this->M_admin->update('tb_user',$data,$where);
      tampil_alert('success','Berhasil','Data User Diaktifkan kembali');
      redirect('hrd/User');
  }
  // hapus
  function hapus()
  {
      $id = $this->uri->segment(4);
      $where = array('id' => $id);
      $data = array(
          'updated_at' => date('Y-m-d H:i:s'),
          'status' => 2,
      );
      $this->M_admin->update('tb_user',$data,$where);
      tampil_alert('success','Berhasil','Data User Dinonaktifkan');
      redirect('hrd/User');
  }
  public function list_user()
  {
    $data['title'] = 'Management User';
    $data['list_role'] = $this->db->query("SELECT * from tb_user_role where id != '1' and id != '7'")->result();
    $data['list_users'] = $this->db->query('SELECT tb_user.* , tb_user_role.nama FROM tb_user JOIN tb_user_role ON tb_user.role = tb_user_role.id WHERE tb_user.status = 0 order by tb_user.role ASC')->result();
    $data['list_bank'] = $this->db->query("SELECT * FROM tb_jenis_bank ORDER BY nama_bank ASC")->result();
    $this->template->load('template/template', 'hrd/user/list_user', $data);
  }
  public function detail($id)
  {
    $where = array('id' => $id);
    $data['title'] = 'Kelola User';
    $data['foto'] = $this->db->query("SELECT * FROM tb_user WHERE id = '$id'")->row();
    $data['detail'] = $this->db->query("SELECT tb_user.* , tb_user_role.nama as role_akses, tb_jenis_bank.nama_bank FROM tb_user JOIN tb_user_role ON tb_user.role = tb_user_role.id JOIN tb_jenis_bank ON tb_jenis_bank.id = tb_user.type_bank WHERE tb_user.id = '$id'")->row();
    
    $this->template->load('template/template', 'hrd/user/detail',$data);
  }
  public function proses_approve()
  {
    $id = $this->input->post('id_user', TRUE);
    $updated_at = $this->input->post('updated');
    $where = array('id' => $id);
    $data = array(
      'status' => 1,
      'updated_at' => $update_at,
    );
    $this->M_admin->update('tb_user',$data,$where);
    tampil_alert('success','Berhasil','User Sudah Aktif!');
    redirect(base_url('hrd/user'));
  }
   public function getdata()
  {
    $id_user = $this->input->get('id_user');
    $artikel = $this->db->get_where('tb_user', array('id' => $id_user))->row();
    header('Content-Type: application/json');
    echo json_encode($artikel ? $artikel : array());
  }
  public function reset()
  {
    $id_user = $this->input->post('id_user');
    $username = $this->input->post('username');
    $data['password'] = $this->hash_password($username);
    $this->db->update('tb_user', $data, array('id' => $id_user));
    tampil_alert('success', 'DI RESET', 'Password user berhasil di Reset');
    redirect('hrd/User');
  }
   
}

?>
