<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mutasi extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "6"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }    
    $this->load->model('M_admin');
    $this->load->model('M_support');
  }
  public function index()
  {
    $data['title'] = 'Mutasi Barang';
    $data['list_data']  = $this->db->query("SELECT tm.*, tt.nama_toko as asal, tk.nama_toko as tujuan from tb_mutasi tm
    join tb_toko tt on tm.id_toko_asal = tt.id
    join tb_toko tk on tm.id_toko_tujuan = tk.id
    order by tm.created_at desc")->result();
    $this->template->load('template/template', 'manager_mv/mutasi/lihat_data', $data);
  }

  // detail mutasi
  // detail permintaan
  public function detail($mutasi)
  {
    
      $data['title'] = 'Mutasi Barang';
      $data['mutasi'] = $this->db->query("SELECT tm.*,tu.nama_user as leader, tt.nama_toko as asal, tk.nama_toko as tujuan, tt.alamat as alamat_asal, tk.alamat as alamat_tujuan from tb_mutasi tm
      join tb_toko tt on tm.id_toko_asal = tt.id
      join tb_toko tk on tm.id_toko_tujuan = tk.id
      join tb_user tu on tm.id_user = tu.id
      where tm.id = '$mutasi'")->row();
      $data['detail_mutasi']  = $this->db->query("SELECT tmd.*, tp.nama_produk, tp.kode, tp.satuan from tb_mutasi_detail tmd
      join tb_produk tp on tmd.id_produk = tp.id
      where tmd.id_mutasi = '$mutasi'")->result();
      $this->template->load('template/template', 'manager_mv/mutasi/detail',$data);
   
  }
  // proses approve
  //  approve artikel
  public function approve()
  {
    $id = $this->input->get('id');
    $id_mutasi = $this->input->get('id_mutasi');
    
    $nilai = count($id);
   
    for ($i=0; $i < $nilai; $i++)
    {
      $list_id = $id[$i];
      $this->db->trans_start();
      $this->db->query("UPDATE tb_mutasi_detail set status = '1' where id = '$list_id'");
      $this->db->query("UPDATE tb_mutasi set status = '1' where id = '$id_mutasi'");
      $this->db->trans_complete();
    }
   
  }

    // di tolak
  public function reject()
  {
    $id = $this->input->get('id_mutasi');
    $where = array('id' => $id);
    $data = array(
      'status' => '3',
    );
    $this->M_admin->update('tb_mutasi', $data, $where);
    tampil_alert('error', 'DITOLAK', 'Mutasi artikel telah ditolak!!');
    redirect(base_url('sup/Mutasi'));
  }
}
?>