<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toko extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "3"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_spv');
  }

  // tampil data Aset
  public function index()
  {
    $id_leader = $this->session->userdata('id');
    $data['title'] = 'Kelola Toko';
    $data['toko'] = $this->db->query("SELECT tt.*, tu.nama_user
    from tb_toko tt
    left join tb_user tu on tt.id_spg = tu.id
    where tt.id_leader = $id_leader order by tt.id desc")->result();
    $this->template->load('template/template', 'leader/toko/lihat_data', $data);
  }
 
   // Script profil toko
   public function profil($id_toko)
   { 
    $data['last_update'] = $this->M_spv->last_update_stok($id_toko);
     $id_leader = $this->session->userdata('id');
     $data['title']         = 'Kelola Toko';
     $data['toko']          = $this->db->query("SELECT * from tb_toko
     where id = '$id_toko'")->row();
     $data['cek_status'] = $this->db->query("SELECT status from tb_toko where id = '$id_toko'")->row();
     //  list SPG
    $data['list_spg']  = $this->db->query("SELECT * from tb_user 
    where status = 1 and role = 4 ")->result();
    //  lihat leader toko
     $data['leader_toko']   = $this->db->query("SELECT tt.*, tb_user.nama_user
     from tb_toko tt
     join tb_user on tt.id_leader = tb_user.id
     where tt.id = '$id_toko' and tt.id_leader = '$id_leader' ")->result();
    //  lihat spg
     $data['spg']   = $this->db->query("SELECT tt.*,tb_user.nama_user 
     from tb_toko tt
     join tb_user on tt.id_spg = tb_user.id
     where tt.id = '$id_toko' and tt.id_leader = '$id_leader' ")->result();
    //  stok produk per toko
    $data['stok_produk']   = $this->db->query("SELECT tb_produk.nama_produk, tb_produk.satuan, tb_produk.kode, tb_stok.*, tb_produk.harga_jawa, tb_produk.harga_indobarat, tb_toko.diskon from tb_stok
    join tb_produk on tb_stok.id_produk = tb_produk.id
    join tb_toko on tb_stok.id_toko = tb_toko.id
    where tb_stok.id_toko = '$id_toko' order by tb_stok.qty desc")->result();
   //  cek status di stok masing" toko
   $data['cek_status_stok']  = $this->db->query("SELECT status from tb_stok where id_toko = '$id_toko' and status = 2 ")->num_rows();
     $this->template->load('template/template', 'leader/toko/profil', $data);
   }

   // hash password
  private function hash_password($password)
  {
    return password_hash($password,PASSWORD_DEFAULT);
  }

     // menambhakan tim leader
  public function proses_tambah()
  {
  
    $this->form_validation->set_rules('username','Username','required');
    $this->form_validation->set_rules('pass','Password','required');
    $this->form_validation->set_rules('konfirm','Confirm password','required|matches[pass]');
    $this->form_validation->set_rules('nama_user','Nama User','required');
    $this->form_validation->set_rules('no_telp','Nomor Telpon','required');
    $this->form_validation->set_rules('id_toko','id_toko');

    if($this->form_validation->run() == TRUE )
    {
        $username     = $this->input->post('username',TRUE);
        $password     = $this->input->post('pass',TRUE);
        $nama_user     = $this->input->post('nama_user',TRUE);
        $no_telp      = $this->input->post('no_telp',TRUE);
        
      
        $data = array(
              'username'     => $username,
              'nama_user'     => $nama_user,
              'no_telp'     => $no_telp,
              'password'     => $this->hash_password($password),
              'role'         => "4",
              'status'       => "1",
        );
        $this->db->trans_start();
        $this->M_spv->insert('tb_user',$data);
        $insert_id  = $this->db->insert_id();
        $id_toko     = $this->input->post('id_toko');
        $id_leader       = $this->session->userdata('id');
        $data = array(
          'id_toko' => $id_toko,
          'id_user' => $insert_id
        );
        $this->M_spv->insert('tb_user_toko',$data);
        $this->db->query("UPDATE tb_toko set id_spg = '$insert_id' where id ='$id_toko' and id_leader = '$id_leader'");
        $this->db->trans_complete();
        tampil_alert('success','Berhasil','Data team leader Berhasil di buat');
          redirect(base_url('leader/toko/profil/'.$id_toko));
    }else{
        tampil_alert('error','Gagal','Password tidak sama!');        
        redirect(base_url('leader/toko/profil/'.$id_toko));
    }
  }

    // add SPG
  public function add_spg()
  {
    $spg         = $this->input->post('spg');
    $id_toko     = $this->input->post('id_toko');
    $data = array (
      'id_toko' => $id_toko,
      'id_user' => $spg
    );
    $this->db->trans_start();
    $this->M_spv->insert('tb_user_toko',$data);
    $this->db->query("UPDATE tb_toko set id_spg = '$spg' where id ='$id_toko'");
    $this->db->trans_complete();
    tampil_alert('success','Berhasil','Data SPG Berhasil di Kaitkan');
    redirect(base_url('leader/toko/profil/'.$id_toko));
  }



}
?>
