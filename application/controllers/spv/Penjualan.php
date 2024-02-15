<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "2"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
  }

  //  fungsi lihat data
  public function index()
  {
        $id_spv = $this->session->userdata('id');
        $data['title'] = 'Penjualan';
        $data['list_data'] = $this->db->query("SELECT tp.*, tk.nama_toko from tb_penjualan tp
        JOIN tb_toko tk on tp.id_toko = tk.id
        where tk.id_spv = '$id_spv' order by tp.id desc")->result();
        $this->template->load('template/template', 'spv/penjualan/lihat_data', $data);
  
  }
  // detail permintaan
  public function detail_p($id_jual)
  {
    
      $data['title'] = 'Penjualan';
      $data['penjualan'] = $this->db->query("SELECT tp.*, tk.nama_toko, tk.alamat, tk.telp, tu.nama_user as spg from tb_penjualan tp
        JOIN tb_toko tk on tp.id_toko = tk.id
        JOIN tb_user tu on tp.id_user = tu.id
        where tp.id = '$id_jual'")->result();
      $data['detail_penjualan'] = $this->db->query("SELECT td.*,tpk.kode as kode_produk, tpk.nama_produk, tpk.satuan  from tb_penjualan_detail td
        JOIN tb_penjualan tp on td.id_penjualan = tp.id
        JOIN tb_produk tpk on td.id_produk = tpk.id
        where td.id_penjualan = '$id_jual'")->result();
    
      
      $this->template->load('template/template', 'spv/penjualan/detail',$data);
   
  }


}
?>