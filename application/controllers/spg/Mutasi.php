<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mutasi extends CI_Controller
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
   $data['title'] = 'Mutasi Barang';
   $id_toko = $this->session->userdata('id_toko');
   $data['list_data']  = $this->db->query("SELECT tm.*, tt.nama_toko as asal, tk.nama_toko as tujuan from tb_mutasi tm
    join tb_toko tt on tm.id_toko_asal = tt.id
    join tb_toko tk on tm.id_toko_tujuan = tk.id
    where tm.status = '1' and tm.id_toko_tujuan = '$id_toko'
    order by tm.created_at desc")->result();
   $this->template->load('template/template', 'spg/mutasi/lihat_data', $data); 
   }
   // detail penerimaan
   public function detail($mutasi)
   {
    $id_toko = $this->session->userdata('id_toko');
    $data['title'] = 'Mutasi Barang';
    $data['mutasi'] = $this->db->query("SELECT tm.*,tu.nama_user as leader, tt.nama_toko as asal,tt.id as toko_asal, tk.nama_toko as tujuan, tt.alamat as alamat_asal, tk.alamat as alamat_tujuan from tb_mutasi tm
      join tb_toko tt on tm.id_toko_asal = tt.id
      join tb_toko tk on tm.id_toko_tujuan = tk.id
      join tb_user tu on tm.id_user = tu.id
      where tm.id = '$mutasi'")->row();
      $data['detail_mutasi']  = $this->db->query("SELECT tmd.*, tp.id as id_produk, tp.nama_produk, tp.kode, tp.satuan from tb_mutasi_detail tmd
      join tb_produk tp on tmd.id_produk = tp.id
      where tmd.id_mutasi = '$mutasi' and tmd.status='1'")->result();
    $this->template->load('template/template', 'spg/mutasi/detail',$data);
   }
   // fungsi terima barang
    public function terima()
    {        // isi program logika
      $id_spg = $this->session->userdata('id');
      $id_toko = $this->session->userdata('id_toko');
      $id_toko_asal = $this->input->POST('id_toko_asal');
      $id_mutasi = $this->input->POST('id_mutasi');
      $id_produk = $this->input->POST('id_produk');
      $qty = $this->input->POST('qty');
      $qty_terima = $this->input->POST('qty_terima');
      $list = count($id_produk);
      $this->db->trans_start();
      for ($i=0; $i < $list; $i++)
      {
        $l_id_produk = $id_produk[$i];
        $l_qty = $qty_terima[$i];
         // cek apakah artikel ada di stok 
        $cek = $this->db->query("SELECT id_produk FROM tb_stok WHERE id_produk = '$l_id_produk' AND id_toko = '$id_toko' ")->num_rows();
        if ($cek>0)
        {
          $this->db->query("UPDATE tb_stok set qty = (qty + '$l_qty'), updated_at = now() where id_produk = '$l_id_produk' and id_toko = '$id_toko'");
          $this->db->query("UPDATE tb_stok set qty = (qty - '$l_qty'), updated_at = now() where id_produk = '$l_id_produk' and id_toko = '$id_toko_asal'");
        }else
        {
          $data_detail = array(
            'id_produk' => $l_id_produk,
            'qty' => $l_qty,
            'id_toko' => $id_toko,
            'status' => "1",
          );
        
          $this->db->insert('tb_stok',$data_detail);
          $this->db->query("UPDATE tb_stok set qty = (qty - '$l_qty'), updated_at = now() where id_produk = '$l_id_produk' and id_toko = '$id_toko_asal'");
        }
         //  update di tabel detail mutasi
         $where_mutasi = array(
          'id_mutasi' => $id_mutasi,
          'id_produk' => $l_id_produk,
        );
        $detail_mutasi = array(
          'qty_terima' => $l_qty,
        );
        $this->db->update('tb_mutasi_detail',$detail_mutasi,$where_mutasi);
      }
       // update status di tabel permintaan
       $where = array(
        'id' => $id_mutasi,
        'id_toko_tujuan' => $id_toko,
      );
       $list_mutasi = array(
         'status' => 2,
         'updated_at' => date('Y-m-d H:i:s'),
       );
       $this->M_admin->update('tb_mutasi',$list_mutasi,$where);
     
      $this->db->trans_complete();
  }


 
}
?>
