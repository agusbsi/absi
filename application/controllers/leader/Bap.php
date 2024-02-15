<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bap extends CI_Controller
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
        $data['title'] = 'Bap';
        $data['list_data'] = $this->db->query("SELECT tp.*, tk.nama_toko from tb_bap tp
        JOIN tb_toko tk on tp.id_toko = tk.id
        where tk.id_leader = '$id_leader' order by tp.id desc ")->result();
        $this->template->load('template/template', 'leader/bap/lihat_data', $data);
  }
  // detail permintaan
  public function detail_p($Bap)
  {
    
      $data['title'] = 'Bap';
      $data['bap'] = $this->db->query("SELECT tp.*, tk.nama_toko, tk.alamat, tk.telp, tu.nama_user as spg from tb_bap tp
        JOIN tb_toko tk on tp.id_toko = tk.id
        JOIN tb_user tu on tp.id_user = tu.id
        where tp.id = '$Bap'")->row();
      $data['detail_bap'] = $this->db->query("SELECT td.*,tpk.kode as kode_produk, tpk.nama_produk, tpk.satuan  from tb_bap_detail td
        JOIN tb_bap tp on td.id_bap = tp.id
        JOIN tb_produk tpk on td.id_produk = tpk.id
        where td.id_bap = '$Bap'")->result();
    
      
      $this->template->load('template/template', 'leader/bap/detail',$data);
  }
  public function approve()
  {
    $id = $this->input->get('id');;
    $cat_leader = $this->input->get('cat_leader');
    $where = array('id' => $id);
    $data = array(
      'status' => "1",
      'catatan_leader' => $cat_leader,
    );
    $this->M_admin->update('tb_bap',$data,$where);
    redirect(base_url('leader/Bap'));
  }
  public function tolak()
  {
    $id = $this->input->get('id');;
    $cat_leader = $this->input->get('cat_leader');
    $where = array('id' => $id);
    $data = array(
      'status' => '3',
      'catatan_leader' => $cat_leader,
    );
    $this->M_admin->update('tb_bap',$data,$where);
    redirect(base_url('leader/Bap'));
  }

}
?>