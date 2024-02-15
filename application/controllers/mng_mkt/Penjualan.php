<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != 6 && $role != 9 && $role != 2 && $role != 3 && $role != 1 && $role != 14 && $role != 11 && $role != 8 && $role != 15){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
  }

  //  fungsi lihat data
  public function index()
  {
        $id_spv = $this->session->userdata('id');
        $data['title'] = 'Penjualan';
        $data['toko'] = $this->db->query("SELECT * from tb_toko where status ='1'")->result();
        $this->template->load('template/template', 'manager_mkt/penjualan/lihat_data', $data);
  
  }
 
    // proses cari
  public function cari()
  {
    $id_toko = $this->input->get('id_toko');
    $tgl_awal = $this->input->get('tgl_awal');
    $tgl_akhir = $this->input->get('tgl_akhir');
    $data= $this->db->query("SELECT tpd.*, tpk.kode,tpk.nama_produk, SUM(qty) as total_qty,
    tt.nama_toko from tb_penjualan_detail tpd 
    join tb_penjualan tp on tpd.id_penjualan = tp.id
    join tb_produk tpk on tpd.id_produk = tpk.id 
    join tb_toko tt on tp.id_toko = tt.id
    where tp.id_toko = '$id_toko'  and  date(tp.tanggal_penjualan) between '$tgl_awal' and '$tgl_akhir' group by tpd.id_produk order by tpk.id asc")->result();
    echo json_encode($data);

  }


}
?>