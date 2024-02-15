<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "9"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
  }

  //  fungsi lihat data
  public function index()
  {
       
        $data['title'] = 'Artikel Baru';
        $data['list_data'] = $this->db->query("SELECT ts.*, tp.nama_produk,tp.kode,tt.nama_toko,tt.id as id_toko, tp.harga_jawa,tp.harga_indobarat, tt.het from tb_stok ts
        join tb_produk tp on ts.id_produk = tp.id
        JOIN tb_toko tt on ts.id_toko = tt.id
        where ts.status ='2'
        order by ts.id desc")->result();
        $this->template->load('template/template', 'manager_mkt/artikel/artikel_baru', $data);
  
  }

  //  approve artikel
  public function approve()
  {
    $id = $this->input->get('id');
    $nilai = count($id);
   
    for ($i=0; $i < $nilai; $i++)
    {
      $list_id = $id[$i];
      $this->db->query("UPDATE tb_stok set status = '1' where id = '$list_id'");
    }
  }
  //  Reject  Artikel
  public function reject()
  {
    $id = $this->input->get('id');
    $nilai = count($id);
   
    for ($i=0; $i < $nilai; $i++)
    {
      $list_id = $id[$i];
      $this->db->query("UPDATE tb_stok set status = '0' where id = '$list_id'");
    }
  }
  


}
?>