<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "5" and $role != "16"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_adm_gudang');
  }

//   halaman utama
  public function index()
  {
   
        $data['title'] = 'Laporan';
        $data['list_permintaan'] = $this->M_adm_gudang->lap_permintaan()->result();
        $data['list_kirim'] = $this->M_adm_gudang->lap_pengiriman()->result();
        $data['toko'] = $this->M_adm_gudang->lap_toko()->result();
        $this->template->load('template/template', 'adm_gudang/laporan/lihat_data', $data);
 
  }

// fungsi btn cari permintaan
  public function cari_permintaan()  
  {    
        
      if (isset($_POST['btn_minta'])) 
      {  
        $id_minta = $this->input->post('id_minta');
        $toko = $this->input->post('toko');
        $status = $this->input->post('status');
        $tgl = date($this->input->post('tanggal'));
        $tgl_akhir = substr($tgl,-10);
        $tgl_awal = substr($tgl,0,10);
            
        if ($id_minta == 'all' && $toko == 'all' && $status == 'all' && $tgl == '')
        {
          $data['title']  = 'Laporan';
          $data['laporan'] = $this->M_adm_gudang->cari_all();
          tampil_alert('success','Berhasil','Data berhasil di tampilkan !');
          $this->template->load('template/template', 'adm_gudang/laporan/hasil_permintaan', $data);
        }else if($id_minta != 'all')
        {
          $id_minta = $this->input->post('id_minta');
          $data['title']  = 'Laporan';
          $data['laporan'] = $this->M_adm_gudang->cari_id($id_minta);
          tampil_alert('success','Berhasil','Data berhasil di tampilkan !');
          $this->template->load('template/template', 'adm_gudang/laporan/hasil_permintaan', $data);
        }else if($toko != 'all')
        {
          $toko = $this->input->post('toko');
          $data['title']  = 'Laporan';
          $data['laporan'] = $this->M_adm_gudang->cari_toko($toko);
          tampil_alert('success','Berhasil','Data berhasil di tampilkan !');
          $this->template->load('template/template', 'adm_gudang/laporan/hasil_permintaan', $data);
        }else if($status != 'all')
        {
          $status = $this->input->post('status');
          $data['title']  = 'Laporan';
          $data['laporan'] = $this->M_adm_gudang->cari_status($status);
          tampil_alert('success','Berhasil','Data berhasil di tampilkan !');
          $this->template->load('template/template', 'adm_gudang/laporan/hasil_permintaan', $data);
        }else if($tgl != '')
        {
          $tgl = date($this->input->post('tanggal'));
          $tgl_awal = substr($tgl,0,10);
          $tgl_akhir = substr($tgl,-10);
          $data['title']  = 'Laporan';
          $data['laporan'] = $this->M_adm_gudang->cari_tgl($tgl_awal,$tgl_akhir);
          $this->session->set_flashdata('msg_berhasil','Berhasil menampilkan data');
          $this->template->load('template/template', 'adm_gudang/laporan/hasil_permintaan', $data);
        }     
      } 
   
  }

  // fungsi btn cari pengiriman
  public function cari_pengiriman()  
  {    
      
      if (isset($_POST['btn_kirim'])) 
      {  
        $id_kirim = $this->input->post('id_kirim');
        $toko = $this->input->post('toko');
        $status = $this->input->post('status');
        $tgl = date($this->input->post('tanggal'));
        $tgl_akhir = substr($tgl,-10);
        $tgl_awal = substr($tgl,0,10);
            
        if ($id_kirim == 'all' && $toko == 'all' && $status == 'all' && $tgl == '')
        {
          $data['title']  = 'Laporan';
          $data['laporan'] = $this->M_adm_gudang->cari_all_kirim();
          tampil_alert('success','Berhasil','Data berhasil di tampilkan !');
          $this->template->load('template/template', 'adm_gudang/laporan/hasil_pengiriman', $data);
        }else if($id_kirim != 'all')
        {
          $id_kirim = $this->input->post('id_kirim');
          $data['title']  = 'Laporan';
          $data['laporan'] = $this->M_adm_gudang->cari_id_kirim($id_kirim);
          tampil_alert('success','Berhasil','Data berhasil di tampilkan !');
          $this->template->load('template/template', 'adm_gudang/laporan/hasil_pengiriman', $data);
        }else if($toko != 'all')
        {
          $toko = $this->input->post('toko');
          $data['title']  = 'Laporan';
          $data['laporan'] = $this->M_adm_gudang->cari_toko_kirim($toko);
          tampil_alert('success','Berhasil','Data berhasil di tampilkan !');
          $this->template->load('template/template', 'adm_gudang/laporan/hasil_pengiriman', $data);
        }else if($status != 'all')
        {
          $status = $this->input->post('status');
          $data['title']  = 'Laporan';
          $data['laporan'] = $this->M_adm_gudang->cari_status_kirim($status);
          tampil_alert('success','Berhasil','Data berhasil di tampilkan !');
          $this->template->load('template/template', 'adm_gudang/laporan/hasil_pengiriman', $data);
        }else if($tgl != '')
        {
          $tgl = date($this->input->post('tanggal'));
          $tgl_awal = substr($tgl,0,10);
          $tgl_akhir = substr($tgl,-10);
          $data['title']  = 'Laporan';
          $data['laporan'] = $this->M_adm_gudang->cari_tgl($tgl_awal,$tgl_akhir);
          tampil_alert('success','Berhasil','Data berhasil di tampilkan !');
          $this->template->load('template/template', 'adm_gudang/laporan/hasil_pengiriman', $data);
        }     
      } 
   
  }
}
?>