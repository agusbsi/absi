<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aset extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if ($role != "4") {
      tampil_alert('error', 'DI TOLAK !', 'Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_spg');
  }

  // tampil data Aset
  public function index()
  {
    $id_toko = $this->session->userdata('id_toko');
    $data['title'] = 'Aset';
    $data['toko']  = $this->db->query("SELECT * from tb_toko where id = '$id_toko' ")->row();
    $data['list_aset']  = $this->db->query("SELECT * from tb_aset where status = 1 order by nama_aset asc")->result();
    $this->template->load('template/template', 'spg/aset/lihat_data', $data);
  }

  public function simpan()
  {
    $toko = $this->session->userdata('id_toko');
    $id_user = $this->session->userdata('id');
    $config['upload_path'] = './assets/img/aset/toko/';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['overwrite'] = true;

    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    //  terbaru
    $data_to_insert = array();
    $existing_aset_ids = array(); // Daftar ID aset yang sudah ada di tb_aset_toko

    // Ambil daftar ID aset yang sudah ada di tb_aset_toko
    $existing_aset_query = $this->db->select('id_aset')->where('id_toko', $toko)->get('tb_aset_toko');
    if ($existing_aset_query->num_rows() > 0) {
      $existing_aset_ids = $existing_aset_query->result_array();
      $existing_aset_ids = array_column($existing_aset_ids, 'id_aset');
    }

    foreach ($_POST['id_aset'] as $key => $id_aset) {
      $qty = $_POST['qty_input'][$key];
      if ($qty > 0) {
        $file_name = "{$id_aset}_{$toko}_" . date('d-m-Y');

        $_FILES['foto_aset_single']['name'] = $_FILES['foto_aset']['name'][$key];
        $_FILES['foto_aset_single']['type'] = $_FILES['foto_aset']['type'][$key];
        $_FILES['foto_aset_single']['tmp_name'] = $_FILES['foto_aset']['tmp_name'][$key];
        $_FILES['foto_aset_single']['error'] = $_FILES['foto_aset']['error'][$key];
        $_FILES['foto_aset_single']['size'] = $_FILES['foto_aset']['size'][$key];

        if ($this->upload->do_upload('foto_aset_single')) {
          $upload_data = $this->upload->data();
          $file_extension = pathinfo($upload_data['file_name'], PATHINFO_EXTENSION);
          $new_file_name = "{$file_name}.{$file_extension}";

          $old_file_path = $config['upload_path'] . $upload_data['file_name'];
          $new_file_path = $config['upload_path'] . $new_file_name;

          rename($old_file_path, $new_file_path); // Rename the file

          // Cek apakah ID aset sudah ada di tb_aset_toko
          if (in_array($id_aset, $existing_aset_ids)) {
            // Jika sudah ada, lakukan operasi update
            $this->db->where('id_aset', $id_aset);
            $this->db->where('id_toko', $toko);
            $this->db->set('qty_updated', $qty, FALSE);
            $this->db->update('tb_aset_toko');
          } else {
            // Jika belum ada, lakukan operasi insert
            $data_to_insert[] = array(
              'id_aset' => $id_aset,
              'id_toko' => $toko,
              'id_user' => $id_user,
              'qty_updated' => $qty,
              'kondisi' => $_POST['kondisi'][$key],
              'foto_aset' => $new_file_name,
              'keterangan' => $_POST['keterangan'][$key],
              'status' => 1,
            );
          }
        } else {
          $error = $this->upload->display_errors();
          // Handle error
        }
      }
    }

    if (!empty($data_to_insert)) {
      $this->db->insert_batch('tb_aset_toko', $data_to_insert);
    }
    // Update status_aset di tb_toko jika ada data aset yang disimpan
    $this->db->where('id', $toko);
    $this->db->update('tb_toko', array('status_aset' => '1'));
    tampil_alert('success', 'Berhasil', 'Data Aset berhasil disimpan!');
    redirect('spg/Aset');
  }
}
