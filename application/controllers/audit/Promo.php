<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promo extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "10"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
  }

  public function index()
  {
  
    $data['title'] = 'Kelola Promo';
    $data['list_data'] = $this->db->query("SELECT tp.*, tt.nama_toko FROM tb_promo tp
    join tb_toko tt on tp.id_toko = tt.id
    order by tp.id asc")->result();
    $this->template->load('template/template', 'audit/promo/index', $data);
  }
  public function detail($id_promo)
  {
      $data['title'] = 'Management Promo';
      $data['promo'] = $this->db->query("SELECT * FROM tb_promo WHERE id = '$id_promo'")->row();
      $id_toko = $data['promo']->id_toko;
      $id_toko_string = explode(",", $id_toko);
      $nama_toko = "";
      
      foreach ($id_toko_string as $ids) {
          $query = $this->db->query("SELECT * FROM tb_toko WHERE id = '$ids'")->row();
          $nama_toko .= $query->nama_toko.',';
      }
      
      $id_produk = $data['promo']->id_produk;
      $id_produk_string = explode(",", $id_produk);
      $nama_produk = array();
      $kode_produk = array();
      
      if ($id_produk == "") {
          $id_toko_arr = explode(',', $id_toko);
          $id_toko_str = implode("','", $id_toko_arr);
          $query = $this->db->query("SELECT tb_stok.*, tb_produk.kode, tb_produk.id as id_produk, tb_produk.kode, tb_produk.nama_produk FROM tb_stok JOIN tb_produk ON tb_stok.id_produk = tb_produk.id WHERE tb_stok.id_toko IN ('$id_toko_str') GROUP BY tb_produk.kode")->result();
        foreach ($query as $row) {
          $nama_produk[] = $row->nama_produk;
          $kode_produk[] = $row->kode;
        }
      } else {
          foreach ($id_produk_string as $ips) {
              $query = $this->db->query("SELECT * FROM tb_produk WHERE id = '$ips'")->row();
              $nama_produk[] = $query->nama_produk;
              $kode_produk[] = $query->kode;
          }  
      } 
      $data['nama_produk'] = $nama_produk;
      $data['kode_produk'] = $kode_produk;
      $data['nama_toko'] = rtrim($nama_toko, ',');
      $this->template->load('template/template', 'audit/promo/detail', $data);
    }

 

}
?>