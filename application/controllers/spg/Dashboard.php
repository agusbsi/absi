<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    $id_toko = $this->session->userdata('id_toko');
    if($role != "4"){
      tampil_alert('error','DITOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    if (!$id_toko) {
      tampil_alert('warning','Oops','Anda belum memilih toko, silahkan pilih toko yang akan anda kelola !');
      redirect(base_url('login/list_toko'));
    }
    $this->load->model('M_spg');
  }

  public function index(){
   
        $id = $this->session->userdata('id');
        $id_toko = $this->session->userdata('id_toko');
        $tahun  = date("Y");
        $bulan  = date("m");
        // set tanggal akhir so semua tokoso disetiap bulan
        $tanggal = $tahun."-".$bulan."-15";
        // Mengubah tanggal menjadi format waktu dengan strtotime()
        $waktu_so = strtotime($tanggal); 
        // waktu sekarang
        $waktu_now = strtotime("now");
        $hitung_so = intval(($waktu_now - $waktu_so) / 86400);
        // jika 5 s/d 10 hari setelah so, maka sttus aset & so akan reset untuk semua toko.
       
        $tgl = date('Y-m-d H:i:s');
        $data['promo'] = $this->db->query("SELECT * FROM tb_promo WHERE FIND_IN_SET($id_toko, id_toko) AND tgl_mulai <= '$tgl' AND tgl_selesai >= '$tgl' AND status = '1'")->result();
        $data['title'] = 'Dashboard';
        $data['toko_new'] = $this->db->query("SELECT * from tb_toko where id = '$id_toko'")->row();
        $data['total_penjualan'] = $this->db->query("SELECT * FROM tb_penjualan WHERE id_toko = '$id_toko'")->num_rows();
        $data['total_permintaan'] = $this->db->query("SELECT * FROM tb_permintaan WHERE id_toko = '$id_toko' ")->num_rows();
        $data['total_penerimaan'] = $this->db->query("SELECT * FROM tb_pengiriman WHERE  id_toko = '$id_toko' and status = '1'")->num_rows();
        $data['total_retur'] = $this->db->query("SELECT * FROM tb_retur WHERE id_toko = '$id_toko'")->num_rows();
        $data['total_stok'] = $this->M_spg->produk_toko($id_toko)->total;
        $this->template->load('template/template', 'spg/dashboard', $data);
    
  }
  // menampilkan profil toko
  public function toko_spg(){
        $id_toko = $this->session->userdata('id_toko');
        $data['title'] = 'Toko spg';
        $data['toko'] = $this->db->query("SELECT * from tb_toko where id = '$id_toko'")->row();
        $data['stok_produk'] = $this->M_spg->get_stok_produk($id_toko);
        $this->template->load('template/template', 'spg/toko/lihat_data', $data);
  }
  public function get_produk_detail()
  {
    $id_produk = $this->input->post('id_produk');
    $data = $this->M_spg->get_produk_by_id($id_produk);
    echo json_encode($data);
  }

}
?>
