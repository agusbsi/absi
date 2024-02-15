<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bap extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "6"){
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
         order by tp.status asc ")->result();
        $this->template->load('template/template', 'manager_mv/bap/lihat_data', $data);
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
    
      
      $this->template->load('template/template', 'manager_mv/bap/detail',$data);
  }
  public function approve()
  {
    $id = $this->input->get('id');;
    $cat_mv = $this->input->get('cat_mv');
    $id_toko = $this->input->get('id_toko');
    $id_kirim = $this->input->get('id_kirim');
    $where = array('id' => $id);
    $data = array(
      'status' => "2",
      'catatan_mv' => $cat_mv,
    );
    $this->db->trans_start();
    $this->M_admin->update('tb_bap',$data,$where);
    $this->db->query("UPDATE tb_pengiriman set status ='2' where id ='$id_kirim'");
    // ambil detail dari bap
    $detail = $this->db->query("SELECT *  from tb_bap_detail td
    JOIN tb_bap tp on td.id_bap = tp.id
    JOIN tb_produk tpk on td.id_produk = tpk.id
    where td.id_bap = '$id'")->result();
    foreach ($detail as $d) {
      $qty_awal = $d->qty_awal;
      $qty_update = $d->qty_update;
      $id_produk_h = $d->id_produk;

    $this->db->query("UPDATE tb_stok set qty = (qty - '$qty_awal')+ '$qty_update' where id_toko = '$id_toko' and id_produk = '$id_produk_h'");
    }
    $this->db->trans_complete();
    redirect(base_url('sup/Bap'));
  }
  public function tolak()
  {
    $id = $this->input->get('id');;
    $cat_mv = $this->input->get('cat_mv');
    $id_kirim = $this->input->get('id_kirim');
    $where = array('id' => $id);
    $data = array(
      'status' => '3',
      'catatan_mv' => $cat_mv,
    );
    $this->db->trans_start();
    $this->M_admin->update('tb_bap',$data,$where);
    $this->db->query("UPDATE tb_pengiriman set status ='2' where id ='$id_kirim'");
    $this->db->trans_complete();
    redirect(base_url('sup/Bap'));
  }

}
?>