<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permintaan extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "5" and $role != "16"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_adm_gudang');
  }

  //  fungsi lihat data
  public function index()
  {
    $data['title'] = 'Permintaan Barang';
    $data['list_data'] = $this->M_adm_gudang->lihat_data()->result();
    $this->template->load('template/template', 'adm_gudang/permintaan/lihat_data', $data);
  }
  // tampilkan data permintaan
  public function permintaan()
  {
    $data['title'] = 'Permintaan Barang';
    $data['list_data'] = $this->M_adm_gudang->lihat_data()->result();
    
    $this->template->load('template/template', 'adm_gudang/permintaan/lihat_data', $data);
  }
  // detail permintaan
  public function detail($no_permintaan)
  {
    $data['title'] = 'Permintaan Barang';
    $data['permintaan'] = $this->db->query("SELECT tp.*, tt.nama_toko, tt.alamat from tb_permintaan tp
    join tb_toko tt on tp.id_toko = tt.id 
    where tp.id = '$no_permintaan'")->row();
    $data['kode_kirim'] = $this->M_adm_gudang->kode_kirim();
    $data['detail'] = $this->db->query("SELECT tpd.*, tp.id_toko,tpk.nama_produk, tpk.kode from tb_permintaan_detail tpd
    join tb_permintaan tp on tpd.id_permintaan = tp.id
    join tb_produk tpk on tpd.id_produk = tpk.id
    where tpd.id_permintaan = '$no_permintaan'")->result();
    
    $this->template->load('template/template', 'adm_gudang/permintaan/detail',$data);
  }
  // proses approve data terpending
  public function proses_approve()
  {
    if($this->session->userdata('status') == 'login' && $this->session->userdata('role') == 5)
    {
      $id                = $this->input->post('id');        
      $catatan           = $this->input->post('catatan');
      date_default_timezone_set('Asia/Jakarta');
      $update_at         = date('Y-m-d h:i:s');
      $this->db->trans_start();
      $this->db->query("UPDATE tb_permintaan set  status = '3', catatan_adm = '$catatan' where   id = '$id'");
      $this->db->trans_complete();
      $hp = $this->db->query("SELECT no_telp FROM tb_user WHERE id = 132")->row();
      $phone = $hp->no_telp;
      $message = "Anda memiliki Data Pengiriman barang yang perlu diapprove silahkan kunjungi s.id/absi-app";
      kirim_wa($phone,$message);
      tampil_alert('success','Berhasil','Data Permintaan berhasil di approve !');
      redirect(base_url('adm_gudang/permintaan'));
    }else {
      redirect(base_url('login'));
    }
    
  }
  // print packing_list
  public function packing_list($no_permintaan)
  {
  $data['title'] = 'Permintaan Barang';
  $data['permintaan'] = $this->db->query("SELECT tp.*, tt.nama_toko, tu.nama_user as spg, tt.alamat  from tb_permintaan tp
  join tb_toko tt on tp.id_toko = tt.id
  join tb_user tu on tt.id_spg = tu.id
  where tp.id = '$no_permintaan'")->result();
  $data['detail'] = $this->db->query("SELECT tpd.*, tpk.nama_produk, tpk.kode,tpk.satuan from tb_permintaan_detail tpd
  join tb_produk tpk on tpd.id_produk = tpk.id
  where tpd.id_permintaan = '$no_permintaan' and tpd.status ='1'")->result();
  $this->load->view('adm_gudang/permintaan/list_packing',$data);
  }

}
?>