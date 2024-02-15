<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aset extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "10"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
  }
  public function index()
  {
    $id_toko = $this->input->get('id_toko');
    $data['title'] = 'Master Aset';
    $data['list_toko'] = $this->db->query("SELECT tb_toko.nama_toko,tb_toko.id FROM tb_toko ORDER BY nama_toko ASC ")->result();
    $data['toko'] = $this->db->query("SELECT * FROM tb_toko WHERE id = '$id_toko'")->row();
    $data['aset'] = $this->db->query("SELECT * FROM tb_aset WHERE deleted_at is null ORDER BY nama_aset ASC")->result();
    $data['list_aset_toko'] = $this->db->query("SELECT tb_aset.nama_aset, tb_aset.id as id_asset, tb_aset_toko.id_toko, tb_aset_toko.qty,tb_aset_toko.keterangan,tb_aset_toko.id, tb_toko.nama_toko 
    FROM tb_aset_toko JOIN tb_aset ON tb_aset.id = tb_aset_toko.id_aset 
    JOIN tb_toko ON tb_toko.id = tb_aset_toko.id_toko 
    WHERE tb_aset_toko.id_toko = '$id_toko'")->result();
    $this->template->load('template/template', 'audit/aset/list_aset.php', $data);
  }

}
?>