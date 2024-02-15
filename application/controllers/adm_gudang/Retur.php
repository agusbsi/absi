<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Retur extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "5" and $role != "16"){
      tampil_alert('error', 'DI TOLAK !', 'Silahkan login kembali!');
      redirect(base_url(''));
    }
    $this->load->model('M_adm_gudang');
  }

  //   fungsi lihat data
  public function index()
  {
    $data['title'] = 'Retur';
    $data['list_data'] = $this->M_adm_gudang->get_data_retur()->result();
    $this->template->load('template/template', 'adm_gudang/retur/lihat_data', $data);
  }
  public function getdataJadwal()
  {
    // Mengambil parameter id_toko dari permintaan Ajax
    $id_retur = $this->input->get('id_retur');
    $retur = $this->db->query("SELECT * from tb_retur where id = ?", array($id_retur))->row();

    $result = array();
    // Menambahkan data nama toko ke dalam hasil
    $result['tgl_tarik'] = $retur->tgl_jemput;
    $result['status'] = $retur->status;

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
  }
  // confirm
  public function confirm()
  {
    $id_retur = $this->input->post('id_retur');
    $tgl_tarik = $this->input->post('tgl_tarik');
    $data = array(
      'status'  => 14,
      'tgl_jemput' => $tgl_tarik
    );
    $where = ['id' => $id_retur];
    $this->db->update('tb_retur', $data, $where);
    tampil_alert('success', 'Berhasil', 'Data Retur berhasil di Konfirmasi!');
    redirect(base_url('adm_gudang/Retur'));
  }
  // detail Retur
  public function detail($no_retur)
  {
    $data['title'] = 'Retur';
    $data['retur'] = $this->db->query("SELECT tr.*, tu.nama_user as spg, tt.nama_toko,tt.alamat, tt.telp from tb_retur tr
      join tb_user tu on tr.id_user = tu.id
      join tb_toko tt on tr.id_toko = tt.id  where tr.id = '$no_retur'")->row();
    $data['detail_retur'] = $this->db->query("SELECT trd.*,tr.foto_resi,tr.no_resi,tp.kode,tp.nama_produk,tp.satuan from tb_retur_detail trd
      join tb_retur tr on trd.id_retur = tr.id
      join tb_produk tp on trd.id_produk = tp.id
      where trd.id_retur = '$no_retur' order by tp.nama_produk desc")->result();
    $this->template->load('template/template', 'adm_gudang/retur/detail', $data);
  }

  // print SPPR
  public function sppr($no_retur)
  {
    $data['retur'] = $this->db->query("SELECT tp.*, tt.nama_toko, tu.nama_user as spg, tu.alamat, tuu.nama_user as leader, tuu.no_telp, tmv.nama_user as mv  from tb_retur tp
    join tb_toko tt on tp.id_toko = tt.id
    join tb_user tu on tt.id_spg = tu.id
    join tb_user tuu on tt.id_leader = tuu.id
    join tb_user tmv on tp.id_mv = tmv.id
    where tp.id = '$no_retur'")->result();
    $data['detail'] = $this->db->query("SELECT trd.*, tpk.nama_produk, tpk.kode, tpk.satuan from tb_retur_detail trd
    join tb_produk tpk on trd.id_produk = tpk.id
    where trd.id_retur = '$no_retur' order by tpk.nama_produk desc")->result();
    $this->load->view('adm_gudang/retur/sppr', $data);
  }
  // print SPPR TUTUP TOKO
  public function sppr_toko($no_retur)
  {
    $data['retur'] = $this->db->query(" SELECT tr.*, tt.nama_toko, tspg.nama_user as spg, tl.nama_user as leader from tb_retur tr
    join tb_toko tt on tr.id_toko = tt.id
    join tb_user tspg on tt.id_spg = tspg.id
    join tb_user tl on tt.id_leader = tl.id
    where tr.id = '$no_retur'")->row();
    $data['aset'] = $this->db->query("SELECT tra.*, ta.nama_aset from tb_retur_aset tra
    join tb_aset ta on tra.id_aset = ta.id
    where tra.id_retur = '$no_retur'")->result();
    $data['artikel'] = $this->db->query("SELECT trd.*, tpk.nama_produk, tpk.kode, tpk.satuan from tb_retur_detail trd
    join tb_produk tpk on trd.id_produk = tpk.id
    where trd.id_retur = '$no_retur'")->result();
    $this->load->view('adm_gudang/retur/sppr_toko', $data);
  }
  public function getdataRetur()
  {
    // Mengambil parameter id_toko dari permintaan Ajax
    $id_retur = $this->input->get('id_retur');
    $artikel = $this->db->query("SELECT trd.qty,trd.qty_terima,trd.id_produk,tp.kode, tp.nama_produk from tb_retur_detail trd
      join tb_produk tp on trd.id_produk = tp.id
      where trd.id_retur = ?   ", array($id_retur));
    $aset = $this->db->query("SELECT tra.*, ta.nama_aset from tb_retur_aset tra
      join tb_aset ta on tra.id_aset = ta.id
      where tra.id_retur = ?  order by ta.nama_aset desc ", array($id_retur));
    $retur = $this->db->query("SELECT * from tb_retur where id = ?", array($id_retur))->row();

    $result = array();

    if ($artikel->num_rows() > 0) {
      $result['artikel'] = $artikel->result_array();
    } else {
      $result['artikel'] = array();
    }

    if ($aset->num_rows() > 0) {
      $result['aset'] = $aset->result_array();
    } else {
      $result['aset'] = array();
    }
    // Menambahkan data nama toko ke dalam hasil
    $result['catatan'] = $retur->catatan;
    $result['catatan_mv'] = $retur->catatan_mv;
    $result['catatan_mm'] = $retur->catatan_mm;
    $result['tgl_tarik'] = $retur->tgl_jemput;
    $result['status'] = $retur->status;
    $result['id_toko'] = $retur->id_toko;

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
  }
  // fungsi terima barang dr toko tutup
  public function terimBarang()
  {
    $id_retur = $this->input->post('id_retur');
    $id_toko = $this->input->post('id_toko');
    $qty_terima = $this->input->post('qty_terima');
    $id_produk = $this->input->post('id_produk');
    $this->db->trans_start();
    // Cek jumlah aset
    $jumlah_produk = count($id_produk);

    // Loop melalui setiap produk
    for ($i = 0; $i < $jumlah_produk; $i++) {
      $d_id_produk = $id_produk[$i];
      $d_qty_terima = $qty_terima[$i];

      // Buat array data dan where untuk update
      $data = array('qty_terima' => $d_qty_terima);
      $where = array('id_retur' => $id_retur, 'id_produk' => $d_id_produk);
      // update ke tb_stok

      // Lakukan update pada tabel tb_retur_detail
      $this->db->update('tb_retur_detail', $data, $where);
      $this->db->query("UPDATE tb_stok set updated_at = now(), qty = (qty - '$d_qty_terima') where id_produk = '$d_id_produk' and id_toko = '$id_toko'");
    }

    // Update lainnya dan redireksi
    $data_retur = array(
      'status' => 15,
      'updated_at' => date('Y-m-d H:i:s'),
    );
    $where_retur = array('id' => $id_retur);

    // Lakukan update pada tabel tb_retur
    $this->db->update('tb_retur', $data_retur, $where_retur);
    $this->db->trans_complete();
    // Tampilkan alert dan redirect
    tampil_alert('success', 'Berhasil', 'Data retur berhasil diterima');
    redirect(base_url('adm_gudang/retur'));
  }
  // fungsi terima barang
   public function terima_barang()
  {
    // isi program logika
    $id_produk = $this->input->post('id_produk');
    $qty_input = $this->input->post('qty_input');
    $catatan = $this->input->post('catatan');
    $id_retur = $this->input->post('id_retur');

    date_default_timezone_set('Asia/Jakarta');
    $data_retur = [
      'id_toko' => $this->input->post('id_toko'),
      'status' => '4',
      'updated_at' => date('Y-m-d H:i:s'),
    ];
    $where_retur = [
      'id'  => $this->input->post('id_retur'),
    ];
    $nilai = count($id_produk);
    $this->db->trans_start();
    for ($i = 0; $i < $nilai; $i++) {
      $d_id_produk = $id_produk[$i];
      $d_qty_input = $qty_input[$i];
      $d_catatan = $catatan[$i];
      $id_toko = $this->input->post('id_toko');
      $data_detail = array(
        'qty_terima' => $d_qty_input,
        'catatan_gudang' => $d_catatan,
      );
      $where_detail = array(
        'id_produk' => $d_id_produk,
        'id_retur' => $id_retur,
      );
      $this->db->update('tb_retur_detail', $data_detail, $where_detail);
      $this->db->query("UPDATE tb_stok set updated_at = now(), qty = (qty - ?) where id_produk = ? and id_toko = ?", array($d_qty_input, $d_id_produk, $id_toko));
    }
    $this->db->update('tb_retur', $data_retur, $where_retur);
    $this->db->trans_complete();
    if ($this->db->trans_status() === FALSE) {
      tampil_alert('danger', 'Gagal', 'Terjadi kesalahan dalam memproses retur');
    } else {
      tampil_alert('success', 'Berhasil', 'Data retur berhasil diterima');
    }
    redirect(base_url('adm_gudang/Retur'));
  }
}
