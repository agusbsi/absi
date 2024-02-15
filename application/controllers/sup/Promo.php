<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promo extends CI_Controller {

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
    $id_grup = $this->input->get('id_grup');
    $data['title'] = 'Management Promo';
    $data['list_grup'] = $this->db->query("SELECT * FROM tb_grup ORDER BY nama_grup ASC ")->result();
    $data['list_data'] = $this->db->query("SELECT tb_grup.nama_grup, tb_promo.judul, tb_promo.content, tb_promo.status, date(tb_promo.tgl_mulai) as tgl_mulai, date(tb_promo.tgl_selesai) as tgl_selesai, tb_promo.id_grup, tb_promo.id,tb_promo.sk FROM tb_promo JOIN tb_grup ON tb_grup.id = tb_promo.id_grup ORDER BY tb_promo.status ASC ")->result();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->template->load('template/template', 'manager_mv/promo/index', $data);
  }

  public function tambah_promo()
  {
    $this->form_validation->set_rules('id_grup','Id Grup','required');
    $this->form_validation->set_rules('nama','Judul Promo','required');
    $this->form_validation->set_rules('content','Isi Content Promo','required');
    $this->form_validation->set_rules('tgl_awal','Tanggal Mulai','required');
    $this->form_validation->set_rules('tgl_akhir','Tanggal Selesai','required');
    $cek_from = $this->form_validation->run();
    if ($cek_from == TRUE) {
      $id_grup   = $this->input->post('id_grup',TRUE);
      $judul = $this->input->post('nama',TRUE);
      $content = $this->input->post('content',TRUE);
      $sk = $this->input->post('sk',TRUE);
      $tgl_mulai = $this->input->post('tgl_awal',TRUE);
      $tgl_selesai = $this->input->post('tgl_akhir',TRUE);
      $data = array(
        'id_grup'  => $id_grup,
        'judul' => $judul,
        'content' => $content,
        'sk' => $sk,
        'tgl_mulai' => $tgl_mulai,
        'tgl_selesai' => $tgl_selesai,
        'status' => '1', 
      );
      $this->M_admin->insert('tb_promo',$data);
      tampil_alert('success','Berhasil','Promo Berhasil Didaftarkan!');
      redirect(base_url('sup/promo'));
    }else{
      tampil_alert('error','Gagal','Promo Gagal Didaftarkan!');
      redirect(base_url('sup/promo'));
    }
  }
  public function edit_promo()
  {
    $this->form_validation->set_rules('judul','Judul Promo','required');
    $this->form_validation->set_rules('nama_grup','Judul Promo','required');
    $this->form_validation->set_rules('content','Isi Content Promo','required');
    $this->form_validation->set_rules('sk','Isi Syarat Promo','required');
    $this->form_validation->set_rules('tgl_awal','Tanggal Mulai','required');
    $this->form_validation->set_rules('tgl_selesai','Tanggal Selesai','required');
    if ($this->form_validation->run() == TRUE)
    {
      $id         = $this->input->post('id',TRUE);
      $nama_grup  = $this->input->post('nama_grup',TRUE);
      $judul      = $this->input->post('judul',TRUE);
      $content    = $this->input->post('content',TRUE);
      $sk    = $this->input->post('sk',TRUE);
      $tgl_awal   = $this->input->post('tgl_awal',TRUE);
      $tgl_akhir  = $this->input->post('tgl_selesai',TRUE);
      $where = array('id' => $id);
      $data = array(
        'judul'       =>  $judul,
        'content'     =>  $content,
        'sk'          =>  $sk,
        'tgl_mulai'   =>  $tgl_awal,
        'tgl_selesai' =>  $tgl_akhir,
      );
      $this->M_admin->update('tb_promo',$data,$where);
      tampil_alert('success','Berhasil','Promo Berhasil Di Update!');
      redirect(base_url('sup/promo'));
    }else{
      tampil_alert('error','Gagal','Promo Gagal DiUpdate!');
      redirect(base_url('sup/promo'));
    }
  }
  function hapus()
  {
    $id = $this->uri->segment(4);
    $where = array('id' => $id);
    $cek = $this->M_admin->delete('tb_promo',$where);
    tampil_alert('success','Berhasil','Promo Berhasil dihapus!');
    redirect(base_url('sup/promo'));
  }
}
?>



// <!-- SELECT * FROM `tb_promo` WHERE tgl_mulai <= now() and tgl_selesai >= now() and status = 1 and id_grup = 1; -->