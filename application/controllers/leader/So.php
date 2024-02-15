<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class So extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "3"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_admin');
    $this->load->model('M_support');
  }
  public function index()
  {
    $id_leader = $this->session->userdata('id');
    $data['title'] = 'Management Stock Opname';
    $data['list_data'] = $this->db->query("SELECT tb_toko.*,  tb_user.nama_user FROM tb_toko 
    left JOIN tb_user ON tb_toko.id_spg = tb_user.id 
    WHERE tb_toko.status = '1' and tb_toko.id_leader = '$id_leader' ")->result();
    $data['list_spv'] = $this->db->query("SELECT * FROM tb_user WHERE role = 2")->result();
    $data['id_toko'] = $this->M_support->kode_toko();
    
    $this->template->load('template/template', 'leader/stokopname/index', $data);
  }

  // download pdf
  public function pdf($toko)
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');
        // title dari pdf
        $data['title_pdf'] = 'Format Stok Opname';
        // filename dari pdf ketika didownload
        $file_pdf = 'Format_Stok_Opname';
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
		    $html = $this->load->view('leader/stokopname/print_so',$data, true);	 
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
        $data['hasil_so'] = $this->db->query("SELECT tsd.*, tp.kode, tp.nama_produk, tp.satuan, tsd.hasil_so - tsd.qty_akhir as selisih from tb_so_detail tsd
        join tb_so ts on tsd.id_so = ts.id
        join tb_produk tp on tsd.id_produk = tp.id
        where ts.id_toko = '$toko' and tsd.id_so = '$id_so->id'")->result();
        $data['so_terbaru'] = $this->db->query("SELECT * from tb_so where id_toko = '$toko' order by id desc limit 1")->row();
		    $html = $this->load->view('leader/stokopname/print_hasil_so',$data, true);	 
        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
    }

}
?>