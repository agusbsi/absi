<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends CI_Controller {

  public function __construct(){
    parent::__construct();
    if($this->session->userdata('status') != 'login' && $this->session->userdata('role') != 4){
        redirect(base_url('login'));
    }
    $this->load->model('M_admin');
    $this->load->model('M_support');
  }

  public function index()
  {
    $id_grup = $this->input->get('id_grup');
    $data['title'] = 'Management Group';
    $data['grup'] = $this->db->query("SELECT * FROM tb_grup WHERE id = '$id_grup'")->row();
    $data['toko'] = $this->db->query("SELECT * FROM tb_toko ORDER By nama_toko ASC")->result();
    $data['list_group'] = $this->db->query("SELECT * FROM tb_grup ORDER BY nama_grup ASC ")->result();
    $data['list_group_toko'] = $this->db->query("SELECT tb_info.id, tb_info.id_grup, tb_info.id_toko, tb_grup.nama_grup, tb_toko.nama_toko,tb_toko.alamat,tb_toko.telp FROM tb_info JOIN tb_grup ON tb_grup.id = tb_info.id_grup JOIN tb_toko ON tb_toko.id = tb_info.id_toko WHERE tb_info.id_grup = '$id_grup'")->result();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->template->load('template/template', 'admin_mv/group/index', $data);
  }

  public function tambah_toko()
  {
    $this->form_validation->set_rules('id','Id Aset','required');
    $this->form_validation->set_rules('daftar_aset','Daftar Aset','required');
    $cek_from = $this->form_validation->run();
    if ($cek_from == TRUE) {
      $id   = $this->input->post('id',TRUE);
      $id_toko = $this->input->post('daftar_aset',TRUE);
      $data = array(
        'id_grup'  => $id,
        'id_toko' => $id_toko,
      );
      $cek_aset = $this->db->query("SELECT * FROM tb_info WHERE id_grup = '$id_grup' AND id_toko = '$id_toko'")->num_rows();
      if ($cek_aset>0) {
        tampil_alert('info','Informasi','Toko sudah didaftarkan didalam Grup ini!');
        redirect('adm_mv/group?id_grup='.$id);
      }else{
        $this->M_admin->insert('tb_info',$data);
        tampil_alert('success','Berhasil','Toko Berhasil ditambahkan kedalam grup');
        redirect('adm_mv/group?id_grup='.$id);
      }
    }
  }

  public function tambah_grup()
  {
    $this->form_validation->set_rules('nama_grup','Nama Grup','required');
    $this->form_validation->set_rules('deskripsi','Deskripsi');
    $cek_from = $this->form_validation->run();
    if ($cek_from == TRUE) {
      $nama_grup   = $this->input->post('nama_grup',TRUE);
      $deskripsi = $this->input->post('deskripsi',TRUE);
      $data = array(
        'nama_grup'  => $nama_grup,
        'deskripsi' => $deskripsi,
      );
      $cek_aset = $this->db->query("SELECT * FROM tb_grup WHERE nama_grup = '$nama_grup'")->num_rows();
      if ($cek_aset>0) {
        tampil_alert('info','Informasi','Grup sudah pernah didaftarkan harap dicek kembali!');
        redirect('adm_mv/group');
      }else{
        $this->M_admin->insert('tb_grup',$data);
        tampil_alert('success','Berhasil','Grup Berhasil ditambahkan');
        redirect('adm_mv/group');
      }
    }
  }
  public function edit_grup()
  {
  $this->form_validation->set_rules('nama_grup','Nama Grup','required');
  $this->form_validation->set_rules('deskripsi','Deskripsi');
  if ($this->form_validation->run() == TRUE) {
    $id          = $this->input->post('id',TRUE);
    $nama_grup   = $this->input->post('nama_grup',TRUE);
    $deskripsi = $this->input->post('deskripsi',TRUE);
    $where = array('id' => $id);
    $data = array(
      'nama_grup'  => $nama_grup,
      'deskripsi' => $deskripsi,
    );
    $this->M_admin->update('tb_grup',$data,$where);
    tampil_alert('success','Berhasil','Data berhasil diupdate !');
    redirect('adm_mv/group/');
    }else{
    tampil_alert('erorr','Gagal','Data Gagal diupdate !');
    redirect('adm_mv/group/');
    }
  }

  function hapus()
  {
    $id_grup = $this->input->get('id_grup');
    $id = $this->uri->segment(4);
    $where = array('id' => $id);
    $cek = $this->M_admin->delete('tb_info',$where);
    tampil_alert('success','Berhasil','Data Toko dihapus dari grup!');
    redirect('adm_mv/group?id_grup'.$id_grup);
  }
}
?>