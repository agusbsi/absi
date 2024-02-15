<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "6" && $role != 1 && $role != 14 && $role != 10){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }    
    $this->load->model('M_admin');
    $this->load->model('M_support');
  }
public function index()
  {
    $data['title'] = 'Penjualan Toko';
    $data['akses'] = $this->session->userdata('role');
    $tgl_awal = $this->input->get('tgl_awal');
    $tgl_akhir = $this->input->get('tgl_akhir');
    if ($tgl_awal and $tgl_akhir){
        $data['list_data'] = $this->db->query("SELECT tp.*, tk.nama_toko 
            FROM tb_penjualan tp
            JOIN tb_toko tk ON tp.id_toko = tk.id
            WHERE tp.tanggal_penjualan between '$tgl_awal' and '$tgl_akhir'
            ORDER BY tp.created_at DESC")->result();
    } else {
        // Menghitung tanggal dua bulan ke belakang dari tanggal saat ini
        $twoMonthsAgo = date('Y-m-d', strtotime('-2 months'));
        $data['list_data'] = $this->db->query("SELECT tp.*, tk.nama_toko 
            FROM tb_penjualan tp
            JOIN tb_toko tk ON tp.id_toko = tk.id
            WHERE tp.created_at >= '$twoMonthsAgo'
            ORDER BY tp.created_at DESC")->result();
    }
    $this->template->load('template/template', 'manager_mv/penjualan/index', $data);
    
    
  }
  public function detail($id)
  {  
    $data['title'] = 'Penjualan Toko';
    $data['jual'] = $this->db->query("SELECT tp.*, tt.nama_toko from tb_penjualan tp 
    join tb_toko tt on tp.id_toko = tt.id
    where tp.id = '$id'")->row();
    $data['list_data'] = $this->db->query("SELECT tpd.*, tpk.kode, tpk.nama_produk from tb_penjualan_detail tpd
    join tb_penjualan tp on tpd.id_penjualan = tp.id
    join tb_produk tpk on tpd.id_produk = tpk.id
    where tpd.id_penjualan = '$id'")->result();
    $this->template->load('template/template', 'manager_mv/penjualan/detail',$data);
  }
  public function approve()
  {
    $id     = $this->input->post('id_permintaan',TRUE);
    $where  = array('id' => $id);
    $status = '1';
    $data   = array(
          'status'  => $status,
    );
    $this->M_admin->update('tb_permintaan',$data,$where);
    $this->session->set_flashdata('msg_berhasil','Data Permintaan Berhasil Diupdate');
    redirect(base_url('sup/penjualan'));
  } 
   // update penjualan
  public function update_jual()
  {
    $id_jual     = $this->input->post('id_jual');
    $tanggal     = $this->input->post('tanggal');
    $this->db->update('tb_penjualan', array('tanggal_penjualan' => $tanggal), array('id' => $id_jual));
    tampil_alert('success', 'BERHASIL', 'Data penjualan berhasil di perbaharui.');
    redirect(base_url('sup/penjualan'));
  }
  // hapus penjualan
  public function hapus_data($id)
  {
    // Ambil data detail penjualan
    $toko = $this->db->query("SELECT id_toko from tb_penjualan where id = '$id'")->row()->id_toko;
    $detail = $this->db->query("SELECT id_produk, qty from tb_penjualan_detail where id_penjualan = '$id'")->result();

    $this->db->trans_start();
    foreach ($detail as $d) {
      // Ambil stok saat ini
      $currentStock = $this->db->select('qty')->where(['id_produk' => $d->id_produk, 'id_toko' => $toko])->get('tb_stok')->row()->qty;
      // Hitung stok yang baru
      $newStock = $currentStock + $d->qty;
      // Update stok
      $this->db->where(['id_produk' => $d->id_produk, 'id_toko' => $toko])->update('tb_stok', ['qty' => $newStock]);
    }

    $this->db->delete('tb_penjualan', array('id' => $id));
    $this->db->delete('tb_penjualan_detail', array('id_penjualan' => $id));

    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      tampil_alert('error', 'GAGAL', 'Gagal menghapus data penjualan ' . $id);
    } else {
      $this->db->trans_commit();
      tampil_alert('success', 'DI HAPUS', 'Data Penjualan ' . $id . ' berhasil dihapus');
    }

    redirect(base_url('sup/penjualan'));
  }
}
?>