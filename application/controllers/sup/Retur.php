<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retur extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "6" && $role != 1){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }    
    $this->load->model('M_admin');
    $this->load->model('M_support');
  }
  public function index()
  {
    $data['title'] = 'Retur Barang';
    $data['list_data'] = $this->M_support->lihat_data_retur()->result();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('username'));
    $this->template->load('template/template', 'manager_mv/retur/index', $data);
  }
  public function detail($no_retur)
  {
    $data['title'] = 'Retur Barang';
    $data['retur'] = $this->db->query("SELECT tp.*, tk.nama_toko, tk.alamat, tk.telp, tu.nama_user as spg from tb_retur tp
    JOIN tb_toko tk on tp.id_toko = tk.id
    JOIN tb_user tu on tp.id_user = tu.id
    where tp.id = '$no_retur'")->row();
    $data['detail_retur'] = $this->db->query("SELECT td.*,tpk.kode as kode_produk, tpk.nama_produk, tpk.satuan  from tb_retur_detail td
     JOIN tb_retur tp on td.id_retur = tp.id
     JOIN tb_produk tpk on td.id_produk = tpk.id
     where td.id_retur = '$no_retur'")->result();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('username'));
    $this->template->load('template/template', 'manager_mv/retur/detail', $data);
  }

  public function tindakan()
  {
    $catatan = $this->input->post('catatan');
    $action = $this->input->post('action');
    $id_retur = $this->input->post('id_retur');
    $id_mv = $this->session->userdata('id');
    if ($action == "approve") {
      $data = array(
        'status' => "2",
        'id_mv' => $id_mv,
        'catatan_mv' => $catatan,
      );
      $response = 'setuju';
    } else {
      $data = array(
        'status' => "5",
        'id_mv' => $id_mv,
        'catatan_mv' => $catatan,
      );
      $response = 'tolak';
    }
    $where = array('id' => $id_retur);
    $this->db->update('tb_retur', $data, $where);
    $got_id = $this->db->query("SELECT id_toko,id_user FROM tb_retur where id = '$id_retur'")->row();
    $id_toko = $got_id->id_toko;
    $got_name = $this->db->query("SELECT nama_toko FROM tb_toko WHERE id = '$id_toko'")->row();
    $nama_toko = $got_name->nama_toko;
    $id_user = $got_id->id_user;
    $hp = $this->db->query("SELECT no_telp FROM tb_user WHERE id = '$id_user'")->row();
    $phone = $hp->no_telp;
    $message = "Pengajuan Retur yang anda ajukan ( $nama_toko ) sudah diapprove, silahkan kunjungi s.id/absi-app";
    kirim_wa($phone, $message);
    echo $response;
  }
}
?>