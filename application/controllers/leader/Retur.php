<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retur extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "3"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_admin');
  }

  //  fungsi lihat data
  public function index()
  {
    $id_leader = $this->session->userdata('id');
    $data['title'] = 'Retur';
    $data['list_data'] = $this->db->query("SELECT tp.*, tk.nama_toko from tb_retur tp
        JOIN tb_toko tk on tp.id_toko = tk.id
        where tk.id_leader = '$id_leader' and tp.status < 10 order by tp.id desc ")->result();
    $this->template->load('template/template', 'leader/retur/lihat_data', $data);
  }
  // detail permintaan
  public function detail_p($Retur)
  {

    $data['title'] = 'Retur';
    $data['retur'] = $this->db->query("SELECT tp.*, tk.nama_toko, tk.alamat, tk.telp, tu.nama_user as spg from tb_retur tp
        JOIN tb_toko tk on tp.id_toko = tk.id
        JOIN tb_user tu on tp.id_user = tu.id
        where tp.id = '$Retur'")->row();
    $data['detail_permintaan'] = $this->db->query("SELECT td.*,tpk.kode as kode_produk, tpk.nama_produk, tpk.satuan  from tb_retur_detail td
        JOIN tb_retur tp on td.id_retur = tp.id
        JOIN tb_produk tpk on td.id_produk = tpk.id
        where td.id_retur = '$Retur'")->result();
    $this->template->load('template/template', 'leader/retur/detail', $data);
  }
  public function tindakan()
  {
    $catatan = $this->input->post('catatan');
    $action = $this->input->post('action');
    $id_retur = $this->input->post('id_retur');
    $id_leader = $this->session->userdata('id');
    if ($action == "approve") {
      $data = array(
        'status' => "1",
        'id_leader' => $id_leader,
        'catatan_leader' => $catatan,
      );
      $response = 'setuju';
    } else {
      $data = array(
        'status' => "5",
        'id_leader' => $id_leader,
        'catatan_leader' => $catatan,
      );
      $response = 'tolak';
    }
    $where = array('id' => $id_retur);
    $this->db->update('tb_retur', $data, $where);
    $hp = $this->db->query("SELECT no_telp FROM tb_user WHERE role = 6")->row();
    $phone = $hp->no_telp;
    $message = "Anda memiliki 1 Permintaan Retur baru dengan nomor ( $id_retur ) yang perlu approve silahkan kunjungi s.id/absi-app";
    kirim_wa($phone, $message);

    echo $response;
  }

}
?>