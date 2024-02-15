<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_opname extends CI_Controller
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
  }

  // tampil data Aset
  public function index()
  {
    $data['title'] = 'Stok Opname';
    $id_toko= $this->session->userdata('id_toko');

    // Mendapatkan bulan dan tahun dari bulan kemarin
    $last_month = date('m', strtotime('last month'));
    $last_year  = date('Y', strtotime('last month'));

    $data['stok_produk'] = $this->db->query("SELECT ts.*, tp.nama_produk, tt.nama_toko, tu.nama_user, tp.kode,
    sum(tpd.qty_diterima) as total_terima, sum(tpj.qty) as total_jual, sum(trd.qty_terima) as total_retur , sum(tmd.qty_terima) as mutasi_masuk, sum(tmd2.qty_terima) as mutasi_keluar
    from tb_stok ts
    join tb_produk tp on ts.id_produk = tp.id
    join tb_toko tt on ts.id_toko = tt.id
    join tb_user tu on tt.id_spg = tu.id
    left join tb_pengiriman_detail tpd on ts.id_produk = tpd.id_produk and tpd.id_pengiriman in (SELECT id from tb_pengiriman where id_toko ='$id_toko' and MONTH(updated_at) = '$last_month' and YEAR(updated_at) = '$last_year' )
    left join tb_penjualan_detail tpj on ts.id_produk = tpj.id_produk and tpj.id_penjualan in (SELECT id from tb_penjualan where id_toko ='$id_toko' and MONTH(tanggal_penjualan) = '$last_month' and YEAR(tanggal_penjualan) = '$last_year' )
    left join tb_retur_detail trd on ts.id_produk = trd.id_produk and trd.id_retur in (SELECT id from tb_retur where id_toko ='$id_toko' and MONTH(updated_at) = '$last_month' and YEAR(updated_at) = '$last_year' )
    left join tb_mutasi_detail tmd on ts.id_produk = tmd.id_produk and tmd.id_mutasi in (SELECT id from tb_mutasi where id_toko_tujuan ='$id_toko' and MONTH(updated_at) = '$last_month' and YEAR(updated_at) = '$last_year' )
    left join tb_mutasi_detail tmd2 on ts.id_produk = tmd2.id_produk and tmd2.id_mutasi in (SELECT id from tb_mutasi where id_toko_asal ='$id_toko' and MONTH(updated_at) = '$last_month' and YEAR(updated_at) = '$last_year' )
    where ts.id_toko = '$id_toko' group by  ts.id order by tp.kode asc")->result();
    
    // ambil data toko
    $data['toko'] = $this->db->query("SELECT tt.*, tg.nama_grup from tb_toko tt
    left join tb_info ti on tt.id = ti.id_toko
    left join tb_grup tg on ti.id_grup = tg.id
    where tt.id ='$id_toko'")->row();
    $data['kode_so'] = $this->M_spg->kode_so(); // generate no permintaan
    // cek data status aset

    $cek_aset = $this->db->query("SELECT id from tb_aset_toko where id_toko = '$id_toko'")->num_rows();
    $cek= $this->db->query("SELECT status_aset from tb_toko where id = '$id_toko'")->result();
    foreach($cek as $cek){
      if ($cek->status_aset != 1 and $cek_aset != 0)
      {
        tampil_alert('info','WAJIB UPDATE ASET','Anda harus melakukan Update Aset terlebih dahulu agar bisa Stok Opname.');
        redirect('spg/Aset');
      }else{
        $this->template->load('template/template', 'spg/stok_opname/lihat_data', $data);
      }
    }
    
  }

   public function simpan_so()
   {
     $id_user       = $this->session->userdata('id');
     $id_toko       = $this->session->userdata('id_toko');
     $kode_so       = $this->M_spg->kode_so();
     $id_produk     = $this->input->post('id_produk');
     $qty_awal      = $this->input->post('qty_awal');
     $qty           = $this->input->post('qty');
     $t_terima      = $this->input->post('t_terima');
     $t_jual        = $this->input->post('t_jual');
     $t_retur       = $this->input->post('t_retur');
     $t_mutasi      = $this->input->post('t_mutasi');
     $qty_input     = $this->input->post('qty_input');
     $keterangan    = $this->input->post('keterangan');
     $jumlah        = count($id_produk);

      
   
     // array untuk tb so
     
     $this->db->trans_start();
     for ($i=0; $i < $jumlah ; $i++) 
       {
         $d_id_produk     = $id_produk[$i];
         $d_qty_awal      = $qty_awal[$i];
         $d_qty           = $qty[$i];
         $d_terima        = $t_terima[$i];
         $d_jual          = $t_jual[$i];
         $d_retur         = $t_retur[$i];
         $d_mutasi        = $t_mutasi[$i];
         $d_qty_input     = $qty_input[$i];
         if(empty($d_qty_input))
         {
          $d_qty_input = 0;
         }
         if(empty($d_mutasi))
         {
          $d_mutasi = 0;
         }
         $data_detail = array(
           'id_so'          => $kode_so,
           'id_produk'      => $d_id_produk,
           'qty_awal'       => $d_qty_awal,
           'qty_akhir'      => $d_qty,
           'total_terima'   => $d_terima,
           'total_jual'     => $d_jual,
           'total_retur'    => $d_retur,
           'total_mutasi'   => $d_mutasi,
           'hasil_so'       => $d_qty_input
         );

        //  set untuk update qty awal di tabel stok
        $where = array(
          'id_produk'   => $d_id_produk,
          'id_toko'     => $id_toko,
        );

        $update = array(
          'qty_awal'    => $d_qty
        );

        // update qty awal di tb stok berdasarkan hasil so spg
        $this->db->update('tb_stok',$update,$where);
       
        // insert ke tabel detail pengiriman
        $this->db->insert('tb_so_detail', $data_detail);
       }

       
      
     $data = array(
       'id' => $kode_so,
       'id_toko' => $id_toko,
       'id_user' => $id_user,
       'catatan' => $keterangan,
       
     );
     $this->db->insert('tb_so', $data);
     $this->db->query("UPDATE tb_toko set status_so = 1, status_aset = 1 where id = '$id_toko'");
     $this->db->trans_complete();

     tampil_alert('success','Berhasil','Data berhasil di Proses');
     redirect('spg/Stok_opname');
   }

}
?>
