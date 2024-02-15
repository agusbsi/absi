<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "13" && $role != "9" && $role != "1"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }

    $this->load->model('M_finance');
    $this->load->model('M_admin');
  }

  public function index()
  {
    $data['title'] = 'Kelola Stok';
    $data['stok'] = $this->db->query("SELECT tt.*, tc.nama_cust as customer, sum(ts.qty) as stok, 
    sum((tp.harga_jawa - (tp.harga_jawa * tt.diskon / 100)) * tt.diskon ) as total_jawa, sum((tp.harga_indobarat - (tp.harga_indobarat * tt.diskon / 100)) * tt.diskon ) as total_indobarat, sum((tp.sp - (tp.sp * tt.diskon / 100)) * tt.diskon ) as sp from tb_toko tt
    join tb_stok ts on tt.id = ts.id_toko
    join tb_customer tc on tt.id_customer = tc.id
    join tb_produk tp on ts.id_produk = tp.id
    group by ts.id_toko order by tt.id desc")->result();
    $this->template->load('template/template', 'finance/stok/index', $data);
  }
  public function get_artikel()
{
    // Mengambil parameter id_toko dari permintaan Ajax
    $id_toko = $this->input->get('id_toko');

    // Mengambil data artikel dari tabel tb_stok berdasarkan id_toko
    // Ganti dengan kode Anda untuk mengambil data dari database
    $artikel = $this->db->query("SELECT ts.*, tp.kode, tp.nama_produk,tt.het,
    tp.harga_jawa, tp.harga_indobarat, tp.sp, (tp.harga_jawa * tt.diskon / 100) as margin_jawa, (tp.harga_indobarat * tt.diskon / 100) as margin_indo, (tp.sp * tt.diskon / 100) as margin_sp from tb_stok ts
    left join tb_toko tt on ts.id_toko = tt.id
    join tb_produk tp on ts.id_produk = tp.id
    where ts.id_toko = '$id_toko' group by ts.id_produk order by ts.id desc ");

    if ($artikel->num_rows() > 0) {
        $result = $artikel->result();
        header('Content-Type: application/json'); // Tambahkan header untuk menandakan bahwa respons adalah JSON
        echo json_encode($result);
    } else {
        header('Content-Type: application/json'); // Tambahkan header untuk menandakan bahwa respons adalah JSON
        echo json_encode(array());
    }
}

}
?>
