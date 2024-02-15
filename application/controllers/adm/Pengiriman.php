<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengiriman extends CI_Controller
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
    $data['title'] = 'Pengiriman Barang';
    $data['list_pengiriman'] = $this->db->query("SELECT tp.*, tk.nama_toko from tb_pengiriman tp join tb_toko tk on tk.id = tp.id_toko where date(tp.created_at) between '$tgl_awal' and '$tgl_akhir'")->result();
    $this->template->load('template/template', 'adm/transaksi/pengiriman', $data);
  }

  public function detail($id){
    $data['title'] = 'Pengiriman Barang';
    $data_pengiriman = $this->db->query("SELECT tp.*, tt.nama_toko, tu.username from tb_pengiriman tp join tb_toko tt on tt.id = tp.id_toko join tb_user tu on tu.id = tp.id_user where tp.id = '$id'")->row();
    $data['detail_pengiriman'] = $this->db->query("SELECT * from tb_pengiriman_detail tpd join tb_produk tp on tp.id = tpd.id_produk where tpd.id_pengiriman = '$id'")->result();

    $data['no_pengiriman'] = $id;
    $data['tanggal'] = $data_pengiriman->created_at;
    $data['status'] = $data_pengiriman->status;
    $data['nama_toko'] = $data_pengiriman->nama_toko;
    $data['nama'] = $data_pengiriman->username;
    $this->template->load('template/template', 'adm/transaksi/pengiriman_detail', $data);
  }
 
}
?>
