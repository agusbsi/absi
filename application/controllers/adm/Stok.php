<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Stok extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('status') != 'login' && $this->session->userdata('role') != 1) {
      redirect(base_url());
    }
  }

  //   halaman utama
  public function index()
  {
    $data['title'] = 'Stok Artikel';
    $query = "SELECT tp.*, COALESCE(SUM(ts.qty), 0) as stok
          FROM tb_produk tp
          LEFT JOIN tb_stok ts ON tp.id = ts.id_produk
          GROUP BY tp.id
          ORDER BY tp.kode ASC";

    $data['list_data'] = $this->db->query($query)->result();
    $this->template->load('template/template', 'adm/stok/index', $data);
  }
  public function detail($id)
  {
    $data['title'] = 'Stok Artikel';
    $query = "SELECT ts.*,tt.nama_toko, tp.nama_produk, tp.kode
          FROM tb_stok ts
          JOIN tb_toko tt ON ts.id_toko = tt.id
          join tb_produk tp on ts.id_produk = tp.id
          where ts.id_produk = '$id'
          ORDER BY ts.qty DESC";

    $data['data'] = $this->db->query($query)->row();
    $data['list_data'] = $this->db->query($query)->result();
    $this->template->load('template/template', 'adm/stok/detail', $data);
  }
}
