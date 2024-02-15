<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class So extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "2"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_admin');
    $this->load->model('M_support');
  }
  public function index()
  {
    $id_spv = $this->session->userdata('id');
    $data['title'] = 'Management Stock Opname';
    $data['list_data'] = $this->db->query("SELECT tb_toko.*,  tb_user.nama_user FROM tb_toko 
    left JOIN tb_user ON tb_toko.id_spg = tb_user.id 
    WHERE tb_toko.status = '1' and tb_toko.id_spv = '$id_spv' ")->result();
    $data['list_spv'] = $this->db->query("SELECT * FROM tb_user WHERE role = 2")->result();
    $data['id_toko'] = $this->M_support->kode_toko();
    $this->template->load('template/template', 'spv/stokopname/index', $data);
  }

  public function detail()
  {
    $tgl_awal = $this->input->get('tgl_awal');
    $tgl_akhir = $this->input->get('tgl_akhir');
    $id_toko = $this->input->get('id_toko');
    $data['title'] = 'Management Stock Opname';
    $data['toko']  = $this->db->query("SELECT * from tb_toko where id = '$id_toko'")->row();
    // $data['list_so'] = $this->db->query("SELECT created_at from tb_so group by MONTH(created_at)")->result();
    $data['list_data'] = $this->db->query("SELECT tb_so.created_at, tb_so.id, tb_user.nama_user, tb_toko.nama_toko, tb_toko.alamat, tb_toko.id as id_toko, tb_user.id as id_user from tb_so JOIN tb_toko ON tb_toko.id = tb_so.id_toko JOIN tb_user ON tb_user.id = tb_so.id_user where tb_so.id_toko ='$id_toko' AND date(tb_so.created_at) between '$tgl_awal' and '$tgl_akhir'")->result();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('username'));
    $this->template->load('template/template', 'spv/stokopname/detail',$data);
  }

  public function detail_so($no_so)
  {
   $data['title'] = 'Management Stock Opname';
   $data['so'] = $this->M_support->get_so($no_so);
   $data['detail'] = $this->M_support->detail_so($no_so);
   $this->load->view('spv/stokopname/detail_print_so',$data);
  }
  // download pdf
  public function pdf($toko)
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');
        // title dari pdf
        $data['title_pdf'] = 'List Artikel Stok Opname';
        // filename dari pdf ketika didownload
        $file_pdf = 'List_Artikel_Stok_Opname';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape 
        $orientation = "portrait";
        // menampilkan Data Toko
        $data['data_toko']  = $this->db->query("SELECT tb_toko.*, tb_user.nama_user from tb_toko 
        join tb_user on tb_toko.id_spg = tb_user.id
        where tb_toko.id ='$toko'")->row();
        // menampilkan Data Stok di toko
        $data['stok'] = $this->db->query("SELECT ts.*, tp.nama_produk, tp.kode, tp.satuan from tb_stok ts
        join tb_produk tp on ts.id_produk = tp.id
        where ts.id_toko = '$toko' and ts.qty != '0'")->result();
		    $html = $this->load->view('spv/stokopname/print_so',$data, true);	 
        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
    }
     // download pdf
  public function hasil_so($toko)
  {

    // so terbaru
      $id_so = $this->db->query("SELECT id from tb_so where id_toko = '$toko' order by id desc limit 1")->row();
      // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
      $this->load->library('pdfgenerator');
      // title dari pdf
      $data['title_pdf'] = 'Hasil Stok Opname';
      // filename dari pdf ketika didownload
      $file_pdf = 'Hasil_Stok_Opname';
      // setting paper
      $paper = 'A4';
      //orientasi paper potrait / landscape 
      $orientation = "portrait";
      // menampilkan Data Toko
      $data['data_toko']  = $this->db->query("SELECT tb_toko.*, tb_user.nama_user from tb_toko 
      join tb_user on tb_toko.id_spg = tb_user.id
      where tb_toko.id ='$toko'")->row();
      // menampilkan Hasil SO terbaru
      $data['hasil_so'] = $this->db->query("SELECT tsd.*, tp.kode, tp.nama_produk, tp.satuan from tb_so_detail tsd
      join tb_so ts on tsd.id_so = ts.id
      join tb_produk tp on tsd.id_produk = tp.id
      where ts.id_toko = '$toko' and tsd.id_so = '$id_so->id'")->result();
      $data['so_terbaru'] = $this->db->query("SELECT * from tb_so where id_toko = '$toko' order by id desc limit 1")->row();
      $html = $this->load->view('spv/stokopname/print_hasil_so',$data, true);	 
      // run dompdf
      $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
  }


}
?>