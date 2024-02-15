<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller
{

  function __construct()
  {
    parent::__construct();

    if($this->session->userdata('status') != 'login' && $this->session->userdata('role') != 1){
        redirect(base_url());
    }

    $this->load->model('M_spg');
    $this->load->model('M_produk');
  }


  public function index(){
    $tgl_awal = $this->input->get('tgl_awal');
    $tgl_akhir = $this->input->get('tgl_akhir');
    $data['title'] = 'Penjualan Barang';

    $data['list_penjualan'] = $this->db->query("SELECT tp.* , tk.nama_toko from tb_penjualan tp join tb_toko tk on tk.id = tp.id_toko where date(tp.created_at) between '$tgl_awal' and '$tgl_akhir'")->result();
    $this->template->load('template/template', 'adm/transaksi/penjualan.php', $data);
  }

  public function detail($id){
    $data['title'] = 'Penjualan Barang';
    $data_permintaan = $this->db->query("SELECT tp.*, tt.nama_toko, tu.username from tb_penjualan tp join tb_toko tt on tt.id = tp.id_toko join tb_user tu on tu.id = tp.id_user where tp.id = '$id'")->row();
    $data['detail_penjualan'] = $this->db->query("SELECT * from tb_penjualan_detail tpd join tb_produk tp on tp.id = tpd.id_produk where tpd.id_penjualan = '$id'")->result();

    $data['no_penjualan'] = $id;
    $data['tanggal'] = $data_permintaan->tgl_penjualan;
    $data['nama_toko'] = $data_permintaan->nama_toko;
    $data['nama'] = $data_permintaan->username;
    $this->template->load('template/template', 'adm/transaksi/penjualan_detail', $data);
  }
 
}
?>
