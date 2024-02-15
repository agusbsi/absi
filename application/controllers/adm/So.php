<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class So extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "1"){
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
    $data['list_data'] = $this->db->query("SELECT tb_toko.*, date(tb_toko.tgl_so) as tgl_so, tb_user.nama_user FROM tb_toko 
    left JOIN tb_user ON tb_toko.id_spg = tb_user.id 
    WHERE tb_toko.status = '1'  ")->result();
    $data['list_spv'] = $this->db->query("SELECT * FROM tb_user WHERE role = 2")->result();
    $data['id_toko'] = $this->M_support->kode_toko();
    $this->template->load('template/template', 'adm/stokopname/index', $data);
  }

 // proses so untuk adjust stok
  public function detail($toko)
  {
    $data['title'] = 'Management Stock Opname';
    $data['so'] = $this->db->query("SELECT so.*, tt.nama_toko, tt.alamat, tt.telp, tu.nama_user from tb_so so
    join tb_toko tt on so.id_toko = tt.id
    join tb_user tu on so.id_user = tu.id
    where so.id_toko='$toko' order by so.id desc limit 1")->row();
    $id_so = $data['so']->id;
    $data['list_data'] = $this->db->query("SELECT ts.*,tp.kode,tp.satuan, tp.nama_produk from tb_stok ts
    join tb_produk tp on ts.id_produk = tp.id
    where ts.id_toko = '$toko'")->result();
    $this->template->load('template/template', 'adm/stokopname/detail', $data);
  }

  // proses approve so
  public function approve()
  {
    $id           = $this->input->post('id_so');
    $id_produk    = $this->input->post('id_produk');
    $id_toko      = $this->input->post('id_toko');
    $id_detail    = $this->input->post('id_detail');
    $hasil_so     = $this->input->post('hasil_so');
    $jumlah       = count($id_produk);
    
      $this->db->trans_start();
      for ($i=0; $i < $jumlah; $i++)
      { 
        $d_id_produk  = $id_produk[$i];
        $d_id_detail  = $id_detail[$i];
        $d_qty        = $hasil_so[$i];

        $data_detail = array(
          'qty' => $d_qty,
          'qty_awal' => $d_qty,
        );
        $where_stok = array(
          'id_produk' => $d_id_produk,
          'id_toko'   => $id_toko,
          'status'    => '1'
        );
        // update qty akhir di stok toko
        $this->db->update('tb_stok',$data_detail,$where_stok);
        $this->db->trans_complete();  
      }
      tampil_alert('success','Berhasil','Data Berhasil di Approve');
      redirect(base_url('adm/So'));
    
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
		    $html = $this->load->view('adm/stokopname/print_so',$data, true);	 
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
      $html = $this->load->view('adm/stokopname/print_hasil_so',$data, true);	 
      // run dompdf
      $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
  }


}
?>