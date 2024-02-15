<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permintaan extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "3"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_admin');
  }

  //  fungsi lihat data
 public function index()
  {
    $id_leader = $this->session->userdata('id');
    $data['title'] = 'Permintaan';
    $data['list_data'] = $this->db->query("SELECT tp.*, tk.nama_toko from tb_permintaan tp
        JOIN tb_toko tk on tp.id_toko = tk.id
        where tk.id_leader = '$id_leader' order by tp.id desc")->result();
    $this->template->load('template/template', 'leader/permintaan/lihat_data', $data);
  }
  // detail permintaan
  public function detail_p($no_permintaan)
  {
    
      $data['title'] = 'Permintaan';
      $data['permintaan'] = $this->db->query("SELECT tp.*, tk.nama_toko, tk.alamat, tk.telp, tu.nama_user as spg, tp.status from tb_permintaan tp
        JOIN tb_toko tk on tp.id_toko = tk.id
        JOIN tb_user tu on tp.id_user = tu.id
        where tp.id = '$no_permintaan'")->row();
      $data['detail_permintaan'] = $this->db->query("SELECT td.*,tpk.kode as kode_produk, tpk.nama_produk, tpk.satuan  from tb_permintaan_detail td
        JOIN tb_permintaan tp on td.id_permintaan = tp.id
        JOIN tb_produk tpk on td.id_produk = tpk.id
        where td.id_permintaan = '$no_permintaan'")->result();
      $data['detail_approve'] = $this->db->query("SELECT td.*,tpk.kode as kode_produk, tpk.nama_produk, tpk.satuan  from tb_permintaan_detail td
        JOIN tb_permintaan tp on td.id_permintaan = tp.id
        JOIN tb_produk tpk on td.id_produk = tpk.id
        where td.id_permintaan = '$no_permintaan' AND td.status = 1")->result();
    
      
      $this->template->load('template/template', 'leader/permintaan/detail',$data);
   
  }

    public function hapus_item()
  {
    $id = $this->input->post('id');
    $hapus = $this->db->query("DELETE from tb_permintaan_detail where id = '$id'");
  }

  //  approve artikel
  public function approve()
  {
    $id = $this->input->post('id_detail');
    $id_minta = $this->input->post('id_minta');
    $catatan_leader = $this->input->post('catatan_leader');
    $qty_acc = $this->input->post('qty_acc');
    $jumlah = count($id);
    $this->db->trans_start();
    $this->db->query("UPDATE tb_permintaan set status = '1',catatan_leader = '$catatan_leader' where id = '$id_minta'");
    for ($i = 0; $i < $jumlah; $i++) {
      $id_detail    = $id[$i];
      $d_qty        = $qty_acc[$i];

      $data_detail = array(
        'qty' => $d_qty,
        'status' => 1,
      );
      $where = array('id' => $id_detail);
      $this->db->update('tb_permintaan_detail', $data_detail, $where);
      $this->db->trans_complete();
    }
    $this->db->trans_complete();
    $hp = $this->db->query("SELECT no_telp FROM tb_user WHERE role = 6")->row();
    $phone = $hp->no_telp;
    $message = "Anda memiliki 1 Permintaan Barang baru dengan nomor ( " . $id_minta . " ) yang perlu approve silahkan kunjungi s.id/absi-app";
    kirim_wa($phone, $message);
    tampil_alert('success', 'BERHASIL', 'Permintaan artikel berhasil di proses!');
    redirect(base_url('leader/Permintaan'));
  }

  public function tolak()
  {
    $permintaan = $this->input->post('id');
    $where = array('id' => $permintaan);
    $data = array(
      'status' => '5',
      'updated_at' => date('Y-m-d H:i:s'),
    );
    $this->db->update('tb_permintaan', $data, $where);
  }
}
?>