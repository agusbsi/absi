<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "6"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_admin');
  }
  public function index()
  {

    $data['title'] = 'Master Barang';
    $data['list_data'] = $this->db->query("SELECT * FROM tb_produk WHERE status != '0' order by id desc")->result();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
      $this->template->load('template/template', 'manager_mv/barang/index', $data);
  }

    public function proses_update()
  {
    $this->form_validation->set_rules('id','ID Artikel','required');
    $this->form_validation->set_rules('kode','Kode Artikel','required');
    $this->form_validation->set_rules('nama_produk','Nama Artikel','required');
    $this->form_validation->set_rules('satuan','Satuan','required');
    if($this->form_validation->run() == TRUE)
    {
      $id           = $this->input->post('id',TRUE);        
      $kode         = $this->input->post('kode',TRUE);
      $nama         = $this->input->post('nama_produk',TRUE);
      $satuan       = $this->input->post('satuan',TRUE);
      $deskripsi    = $this->input->post('deskripsi',TRUE);
      $update_at    = $this->input->post('updated', TRUE);
      $where = array('id' => $id);
      $data = array(
            'kode'          => $kode,
            'nama_produk'   => $nama,
            'satuan'        => $satuan,
            'harga_jawa'        => $harga1,
            'harga_indobarat'        => $harga2,
            'deskripsi'     => $deskripsi,
            'updated_at'    => $update_at,
            
      );
      $cek = $this->M_admin->update('tb_produk',$data,$where);
      tampil_alert('success','Berhasil','Data berhasil diupdate !');
      redirect(base_url('sup/barang'));
    }else{
      tampil_alert('erorr','Gagal','Data Gagal diupdate !');
      redirect(base_url('sup/barang'));
    }
  }
    function hapus()
    {
        $id = $this->uri->segment(4);
        $where = array('id' => $id);
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s'),
            'status' => 0,
        );
        $this->M_admin->update('tb_produk',$data,$where);
        tampil_alert('success','Berhasil','Data berhasil dihapus !');
        redirect(base_url('sup/barang'));
    }

    // fungsi tambah Barang
    public function proses_tambah() {
      $this->form_validation->set_rules('kode','Kode Artikel','required');
      $this->form_validation->set_rules('nama','Nama Artikel','required');
      $this->form_validation->set_rules('satuan','Satuan','required');
      $this->form_validation->set_rules('harga_jawa','Harga Jawa','required');
      $this->form_validation->set_rules('harga_indo','Harga Indonesia Barat','required');
      if($this->form_validation->run() == TRUE )
      {
          $kode     = $this->input->post('kode',TRUE);
          $nama     = $this->input->post('nama',TRUE);
          $satuan   = $this->input->post('satuan',TRUE);
          $harga1= $this->input->post('harga_jawa',TRUE);
          $harga2= $this->input->post('harga_indo',TRUE);
          $data = array(
                'kode'      => $kode,
                'nama_produk' => $nama,
                'satuan'    => $satuan,
                'harga_jawa' => $harga1,
                'harga_indobarat' => $harga2,
                'status'    => "2",
                'created_at' => date('Y-m-d H:i:s'),
          );
          $cek = $this->db->query("SELECT * FROM tb_produk WHERE kode = '$kode' AND status != 0 ")->num_rows();
          if ($cek>0) {
            tampil_alert('info','Information','Artikel sudah ada, Masukan kode yang lain!');
            redirect(base_url('sup/barang'));
          }else{
            $this->M_admin->insert('tb_produk',$data);
            tampil_alert('success','Berhasil','Artikel berhasil ditambahkan, Menunggu Approve!');
            redirect(base_url('sup/barang'));
          }
  
  
      }else{
          tampil_alert('error','Gagal','Artikel Gagal ditambahkan!');        
          redirect(base_url('sup/barang'));
      }
    }
}
?>