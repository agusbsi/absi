<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengiriman extends CI_Controller {

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
    $data['title'] = 'Pengiriman Barang';
    $data['list_data'] = $this->db->query("SELECT tp.*, tt.nama_toko, tu.nama_user from tb_pengiriman tp
    join tb_toko tt on tp.id_toko = tt.id
    join tb_user tu on tp.id_user = tu.id
    order by tp.id desc")->result();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('username'));
    $this->template->load('template/template', 'admin_mv/pengiriman/index', $data);
  }
  public function detail($id_kirim)
  {
    $data['title'] = 'Pengiriman Barang';
    $data['Pengiriman'] = $this->db->query("SELECT tp.*, tt.nama_toko,tt.alamat, tt.telp, tu.nama_user from tb_pengiriman tp
    join tb_toko tt on tp.id_toko = tt.id
    join tb_user tu on tp.id_user = tu.id
    where tp.id ='$id_kirim'")->row();
    $data['detail_kirim'] = $this->db->query("SELECT tpd.*, tpk.nama_produk, tpk.satuan,tpk.kode,tpk.harga_jawa as het_jawa, tpk.harga_indobarat as het_indobarat, tk.het from tb_pengiriman_detail tpd
    join tb_pengiriman tp on tpd.id_pengiriman = tp.id
    join tb_produk tpk on tpd.id_produk = tpk.id
    join tb_toko tk ON tp.id_toko = tk.id
    where tpd.id_pengiriman = '$id_kirim'")->result();
   
    $this->template->load('template/template', 'admin_mv/pengiriman/detail',$data);
  }
  public function approve()
  {
    $id     = $this->input->post('id_kirim',TRUE);
    $update_at    = $this->input->post('updated', TRUE);
    $where  = array('id' => $id);
    $data   = array(
          'status'  => '1',
          'updated_at'  => $update_at,
    );
    $this->M_admin->update('tb_pengiriman',$data,$where);
    $hp = $this->db->query("SELECT no_telp FROM tb_user WHERE id = 128")->row();
    $phone = $hp->no_telp;
    $message = "Anda memiliki 1 Pengiriman yang sudah disetujui dengan nomor ( ".$id." ) silahkan kunjungi s.id/absi-app";
    kirim_wa($phone,$message);
    tampil_alert('success','Berhasil','Data berhasil di Approve !');
    redirect(base_url('adm_mv/Pengiriman'));
  } 
}
?>