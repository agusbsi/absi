<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penerimaan extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "4"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_spg');
    $this->load->model('M_admin');
    $this->load->model('M_produk');

  }

   // menampilkan pengiriman
   public function index()
   {
   $data['title'] = 'Penerimaan Barang';
   $id_toko = $this->session->userdata('id_toko');
   $data['list_data'] = $this->M_spg->get_penerimaan($id_toko)->result();
   $this->template->load('template/template', 'spg/penerimaan/lihat_data', $data); 
   }
   // detail penerimaan
   public function detail($no_penerimaan)
   {
    $id_toko = $this->session->userdata('id_toko');
    $data['title'] = 'Penerimaan Barang';
    $data['terima'] = $this->M_spg->get_terima($no_penerimaan,$id_toko)->result();
    $data['detail_terima'] = $this->M_spg->get_detail_terima($no_penerimaan,$id_toko);
    $data['artikel_new'] = $this->db->query("SELECT ts.*, tb_produk.kode, tb_produk.nama_produk from tb_stok ts
    join tb_produk on ts.id_produk = tb_produk.id
    where ts.id_toko = '$id_toko'")->result();
    $this->template->load('template/template', 'spg/penerimaan/detail',$data);
   }
   // fungsi terima barang
   public function terima_barang()
  {
    $id_penerima = $this->session->userdata('id');
    $id_produk = $this->input->POST('id_produk', TRUE);
    $id_terima = $this->input->post('id_terima', TRUE);
    $id_detail = $this->input->POST('id_detail', TRUE);
    $catatan_spg = $this->input->POST('catatan_spg', TRUE);
    $id_permintaan = $this->input->post('id_permintaan', TRUE);
    $id_toko = $this->input->post('id_toko', TRUE);
    $qty = $this->input->post('qty', TRUE);
    $qty_terima = $this->input->post('qty_terima', TRUE);
    $nilai = count($id_produk);
    $selisih = 0;
    $cek_percobaan_input = $this->db->query("SELECT percobaan_input from tb_pengiriman where id = '$id_terima'")->row()->percobaan_input;
    if ($qty != $qty_terima and $cek_percobaan_input < 3) {
      $this->db->query("UPDATE tb_pengiriman set percobaan_input = (percobaan_input + 1) where id = '$id_terima'");
      echo 0;
    } else {
      $this->db->trans_start();
      $cek_status = $this->db->query("SELECT status from tb_pengiriman where id = '$id_terima'")->row()->status;
      if ($cek_status == 1) {
        for ($i = 0; $i < $nilai; $i++) {
          $d_id_produk = $id_produk[$i];
          $d_id_detail = $id_detail[$i];
          $d_qty = $qty[$i];
          $d_qty_diterima = $qty_terima[$i];
          $data_detail = array(
            'qty_diterima' =>  $d_qty_diterima,
          );
          $this->db->where('id', $d_id_detail);
          $this->db->update('tb_pengiriman_detail', $data_detail);
          if ($d_qty != $d_qty_diterima) {
            $selisih += 1;
          }
          $this->db->query("UPDATE tb_stok set updated_at = now(), qty = (qty + '$d_qty_diterima') where id_produk = '$d_id_produk' and id_toko = '$id_toko'");
        }
        if ($selisih == 0) {
          $status = 2;
        } else {
          $status = 3;
        }
        $where = array('id' => $id_terima);
        $data = array(
          'status' => $status,
          'updated_at' => date('Y-m-d H:i:s'),
          'id_penerima' => $id_penerima,
          'catatan_spg' => $catatan_spg,
        );
        $this->M_admin->update('tb_pengiriman', $data, $where);
        $where2 = array('id' => $id_permintaan);
        $data2 = array(
          'status' => 6,
          'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->M_admin->update('tb_permintaan', $data2, $where2);
        $this->db->trans_complete();
        echo 1;
      }
    }
  }

   // tampilkan detail produk yg selish
   public function list_selisih($id)
   {
     $id_terima = $this->input->get('id_terima');
     $data_produk = $this->db->query("SELECT tpd.*, tpk.kode,tpk.satuan from tb_pengiriman_detail tpd
     join tb_produk tpk on tpd.id_produk = tpk.id
     where tpd.id_produk = '$id' and tpd.id_pengiriman = '$id_terima'")->row();
     echo json_encode($data_produk);
   }
   // tampilkan detail produk baru
   public function artikel_tambahan($id)
   {
     $data_produk = $this->db->query("SELECT * from tb_produk where id = '$id'")->row();
     echo json_encode($data_produk);
   }
 // menampilkan keranjang
 public function keranjang()
 {
   $this->load->view('spg/penerimaan/keranjang');
 }
 // menampilkan List artikel hilang
 public function list_hilang()
 {
   $this->load->view('spg/penerimaan/list_hilang');
 }
 // menampilkan List artikel hilang
 public function list_tambah()
 {
   $this->load->view('spg/penerimaan/list_tambah');
 }
//  proses simpan bap
public function simpan_bap()
{
  $id_user          = $this->session->userdata('id');
  $id_toko          = $this->session->userdata('id_toko');
  $id_kirim         = $this->input->post('id_kirim');
  $id_kategori      = $this->input->post('kategori');
  $catatan          = $this->input->post('catatan');
  $id_produk          = $this->input->post('id_produk_hidden');
  $qty                = $this->input->post('qty_hidden');
  $qty_update         = $this->input->post('qty_update');
  
  $data_bap = array(
    'id'        =>'',
    'id_kirim'  => $id_kirim,
    'kategori'  => $id_kategori,
    'id_user'   => $id_user,
    'id_toko'   => $id_toko,
    'status'    => '0',
    'catatan'    => $catatan,
  );
  $this->db->trans_start();
  $this->M_admin->insert('tb_bap',$data_bap);
  $id_bap = $this->db->insert_id();
  $jumlah             = count($id_produk);
  for ($i=0; $i < $jumlah; $i++)
  {
    $d_id_produk    = $id_produk[$i];
    $d_qty          = $qty[$i];
    $d_qty_update   = $qty_update[$i];

   if($id_kategori == '1')
   {
    $data_detail = array(
      'id_bap'      => $id_bap,
      'id_produk'   => $d_id_produk,
      'qty_awal'    => $d_qty,
      'qty_update'  => $d_qty_update,
    );
   }else if ($id_kategori == '2')
   {
    $data_detail = array(
      'id_bap'      => $id_bap,
      'id_produk'   => $d_id_produk,
      'qty_awal'    => $d_qty,
    );
   }else 
   {
    $data_detail = array(
      'id_bap'      => $id_bap,
      'id_produk'   => $d_id_produk,
      'qty_update'    => $d_qty,
    );
   }
    $this->db->insert('tb_bap_detail', $data_detail);
  }
  $this->db->trans_complete();
  tampil_alert('success','Berhasil','Berita Acara Sudah Diteruskan Ke Leader!');
  redirect(base_url('spg/penerimaan'));

}
 
}
?>
