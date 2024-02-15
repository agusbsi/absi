<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aset extends CI_Controller {

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

    $data['title'] = 'Master Aset';
    $data['list_data'] = $this->db->query("SELECT * FROM tb_aset WHERE deleted_at is null")->result();
   
    $data['id_aset'] = $this->M_support->kode_aset();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
      $this->template->load('template/template', 'manager_mv/aset/index', $data);
  }

  public function proses_update()
  {
    $this->form_validation->set_rules('id','ID aset','required');
    $this->form_validation->set_rules('nama_produk','Nama Aset','required');
    if($this->form_validation->run() == TRUE)
    {
      $id           = $this->input->post('id',TRUE);        
      $nama         = $this->input->post('nama_produk',TRUE);
      $update_at    = $this->input->post('updated', TRUE);
      $where = array('id' => $id);
      $data = array(
            'id'          => $id,
            'nama_aset'   => $nama,
            'updated_at'    => $update_at,
      );
      $this->M_admin->update('tb_aset',$data,$where);
      tampil_alert('success','Berhasil','Data berhasil diupdate !');
      redirect(base_url('sup/aset'));
    }else{
      tampil_alert('erorr','Gagal','Data Gagal diupdate !');
      redirect(base_url('sup/aset'));
    }
  }
    function hapus()
    {
        $id = $this->uri->segment(4);
        $where = array('id' => $id);
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s'),
        );
        $this->M_admin->update('tb_aset',$data,$where);
        tampil_alert('success','Berhasil','Data berhasil dihapus !');
        redirect(base_url('sup/aset'));
    }

    // fungsi tambah Barang
    public function proses_tambah() {
      $this->form_validation->set_rules('id','Id Aset','required');
      $this->form_validation->set_rules('nama','Nama Asset','required');

  
      if($this->form_validation->run() == TRUE )
      {
          $kode     = $this->input->post('id',TRUE);
          $nama     = $this->input->post('nama',TRUE);
          $data = array(
                'id'      => $kode,
                'nama_aset' => $nama,
                'created_at' => date('Y-m-d H:i:s'),
          );
          $cek = $this->db->query("SELECT * FROM tb_aset WHERE id = '$kode' AND deleted_at is not null")->num_rows();
          if ($cek>0) {
            tampil_alert('info','Information','Artikel sudah ada!');
            redirect(base_url('sup/aset'));
          }else{
            $this->M_admin->insert('tb_aset',$data);
            tampil_alert('success','Berhasil','Data berhasil disimpan !');
            redirect(base_url('sup/aset'));
          }
  
  
      }else{
          tampil_alert('error','Gagal','Artikel Gagal ditambahkan!');        
          redirect(base_url('sup/aset'));
      }
    }

    public function list_aset(){
    $id_toko = $this->input->get('id_toko');
    $data['title'] = 'Management Aset';
    $data['list_toko'] = $this->db->query("SELECT tb_toko.nama_toko,tb_toko.id FROM tb_toko ORDER BY nama_toko ASC ")->result();
    $data['toko'] = $this->db->query("SELECT * FROM tb_toko WHERE id = '$id_toko'")->row();
    $data['aset'] = $this->db->query("SELECT * FROM tb_aset ORDER By nama_aset ASC")->result();
    $data['list_aset_toko'] = $this->db->query("SELECT tb_aset.nama_aset, tb_aset.id as id_asset, tb_aset_toko.id_toko, tb_aset_toko.qty, tb_aset_toko.kondisi, tb_aset_toko.keterangan,tb_aset_toko.id, tb_toko.nama_toko FROM tb_aset_toko JOIN tb_aset ON tb_aset.id = tb_aset_toko.id_aset JOIN tb_toko ON tb_toko.id = tb_aset_toko.id_toko WHERE tb_aset_toko.id_toko = '$id_toko'")->result();
    $this->template->load('template/template', 'manager_mv/aset/list_aset.php', $data);
    }

    public function tambah_aset_toko()
    {
      $this->form_validation->set_rules('id_toko','Id Toko','required');
      $this->form_validation->set_rules('daftar_aset','Daftar Aset','required');
      $this->form_validation->set_rules('kondisi','Kondisi','required');
      $this->form_validation->set_rules('keterangan','keterangan','required');
      $this->form_validation->set_rules('qty','Jumlah Qty','required');
      $cek_from = $this->form_validation->run();
      if ($cek_from == TRUE) {
        $id   = $this->input->post('id_toko',TRUE);
        $id_aset = $this->input->post('daftar_aset',TRUE);
        $kondisi = $this->input->post('kondisi',TRUE);
        $keterangan = $this->input->post('keterangan',TRUE);
        $qty  = $this->input->post('qty',TRUE);
        $data = array(
          'id_aset'  => $id_aset,
          'id_toko' => $id,
          'qty' => $qty,
          'keterangan' => $keterangan,
          'kondisi' => $kondisi,
        );
        $cek_aset = $this->db->query("SELECT * FROM tb_aset_toko WHERE id_toko = '$id' AND id_aset = '$id_aset'")->num_rows();
        if ($cek_aset>0) {
          tampil_alert('info','Informasi','Aset sudah pernah terdaftarkan ditoko ini!');
          redirect('sup/aset/list_aset?id_toko='.$id);
        }else{
          $this->M_admin->insert('tb_aset_toko',$data);
          tampil_alert('success','Berhasil','Aset berhasil ditambahkan ketoko'.$nama_toko);
          redirect('sup/aset/list_aset?id_toko='.$id);
        }
      }else{
        tampil_alert('error','Gagal','Gagal menambahkan Aset pada Toko!');
        redirect('sup/aset/list_aset?id_toko='.$id);

      }
    }
    public function edit_aset_toko()
    {
      $this->form_validation->set_rules('id_aset','Id Aset','required');
      $this->form_validation->set_rules('qty','Jumlah Qty','required');
      if ($this->form_validation->run() == TRUE) {
        $id          = $this->input->post('id',TRUE);
        $id_toko     = $this->input->post('id_toko', TRUE);         
        $qty         = $this->input->post('qty',TRUE);
        $update_at   = $this->input->post('updated', TRUE);
        $where = array('id' => $id);
        $data = array(
              'id'          => $id,
              'qty'   => $qty,
              'updated_at'    => $update_at,
        );
        $this->M_admin->update('tb_aset_toko',$data,$where);
        tampil_alert('success','Berhasil','Data berhasil diupdate !');
        redirect('sup/aset/list_aset?id_toko='.$id_toko);
        }else{
        tampil_alert('erorr','Gagal','Data Gagal diupdate !');
        redirect('sup/aset/list_aset?id_toko='.$id_toko);
        }
    }
}
?>