<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toko extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "8"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_admin');
    $this->load->model('M_support');
    $this->load->model('M_toko');
  }
  public function index()
  {
    $data['title'] = 'Master Toko';
    $data['list_data'] = $this->db->query("SELECT tb_toko.*,tb_user.nama_user FROM tb_toko 
    JOIN tb_user ON tb_toko.id_spv = tb_user.id 
    WHERE tb_toko.status != '0'")->result();
    $data['list_spv'] = $this->db->query("SELECT * FROM tb_user WHERE role = 2")->result();

    // var_dump($data['list_data']);
    // die;
    $data['id_toko'] = $this->M_support->kode_toko();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
      $this->template->load('template/template', 'admin_mv/toko/index', $data);
  }


  
 public function profil($id)
   {
     $where = array('id' => $id);
     $data['title'] = 'Master Toko';
     $data['detail'] = $this->db->query("SELECT * from tb_toko where id ='$id'")->row();
     //  lihat leader toko
     $data['spv_toko']   = $this->db->query("SELECT tt.*, tb_user.nama_user,tb_user.no_telp
     from tb_toko tt
     join tb_user on tt.id_spv = tb_user.id
     where tt.id = '$id' ")->result();
     //  lihat leader toko
     $data['leader_toko']   = $this->db->query("SELECT tt.*, tb_user.nama_user,tb_user.no_telp
     from tb_toko tt
     join tb_user on tt.id_leader = tb_user.id
     where tt.id = '$id' and tb_user.role = '3' ")->result();
     //  lihat SPG toko
     $data['spg_toko']   = $this->db->query("SELECT tt.*, tb_user.nama_user,tb_user.no_telp
     from tb_toko tt
     join tb_user on tt.id_spg = tb_user.id
     where tt.id = '$id' and tb_user.role = '4' ")->result();

     $data['last_update'] = $this->M_toko->last_update_stok($id);
     $data['cek_status'] = $this->db->query("SELECT status from tb_toko where id = '$id'")->row();
      //  cek status di stok masing" toko
    $data['cek_status_stok']  = $this->db->query("SELECT status from tb_stok where id_toko = '$id' and status = 2 ")->num_rows();
     //  stok produk per toko
    $data['stok_produk']   = $this->db->query("SELECT tb_produk.nama_produk, tb_produk.satuan, tb_produk.kode, tb_stok.*, tb_produk.harga_jawa, tb_produk.harga_indobarat, tb_toko.diskon from tb_stok
    join tb_produk on tb_stok.id_produk = tb_produk.id
    join tb_toko on tb_stok.id_toko = tb_toko.id
    where tb_stok.id_toko = '$id' order by tb_stok.qty desc")->result();
     $data['toko']          = $this->db->query("SELECT * from tb_toko
     where id = '$id'")->row();
     $this->template->load('template/template', 'admin_mv/toko/lihat_toko', $data);
   }


}
?>