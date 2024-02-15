<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Toko extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if ($role != "7" && $role != 11) {
      tampil_alert('error', 'DI TOLAK !', 'Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_admin');
    $this->load->model('M_support');

  }
  public function index()
  {
    $data['title'] = 'Akses Toko';
    $data['list_toko'] = $this->db->query("SELECT tt.*, tu.nama_user as spg, tu.id as id_spg, tl.id as id_leader, tl.nama_user as leader, ts.id as id_spv, ts.nama_user as spv from tb_toko tt
    left join tb_user tu on tt.id_spg = tu.id 
    left join tb_user tl on tt.id_leader = tl.id
    left join tb_user ts on tt.id_spv = ts.id
    where tt.status = 1 order by tt.id desc")->result();
    $data['spv'] = $this->db->query("SELECT * from tb_user where role = 2 ")->result();
    $data['leader'] = $this->db->query("SELECT * from tb_user where role = 3 ")->result();
    $data['spg'] = $this->db->query("SELECT * from tb_user where role = 4 ")->result();
    $this->template->load('template/template', 'hrd/toko/index', $data);
  }
  // ganti akses
  public function ganti_akses()
  {
    $id_toko = $this->input->post('id_toko');
    $spv = $this->input->post('spv');
    $leader = $this->input->post('leader');
    $spg = $this->input->post('spg');
    $data = array(
      'id_spv' => $spv,
      'id_leader' => $leader,
      'id_spg' => $spg,
    );
    $where = array(
      'id' => $id_toko
    );
    // update toko
    $this->db->update('tb_toko', $data, $where);
    tampil_alert('success', 'Berhasil', 'Data Akses Toko Berhasil di Update');
    redirect(base_url('hrd/Toko'));
  }

}
?>