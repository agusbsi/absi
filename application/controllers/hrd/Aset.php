<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aset extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if ($role != "7" && $role != "11" && $role != "1" && $role != "14" && $role != "15") {
      tampil_alert('error', 'DI TOLAK !', 'Silahkan login kembali');
      redirect(base_url(''));
    }
    $this->load->model('M_admin');
    $this->load->model('M_support');
  }
  public function index()
  {

    $data['title'] = 'Kelola Aset';
    $data['list_data'] = $this->db->query("SELECT * FROM tb_aset WHERE deleted_at is null order by id desc")->result();
    $data['id_aset'] = $this->M_support->kode_aset();
    $this->template->load('template/template', 'hrd/aset/index', $data);
  }
  // detail aset
  public function get_detail()
  {
    $aset = $this->input->post('aset');
    $barang = $this->db->query("SELECT * from tb_aset where id = '$aset'")->row();

    if ($barang) {
      echo json_encode($barang);
    } else {
      echo json_encode(array('error' => 'Data barang tidak ditemukan'));
    }
  }
  public function proses_update()
  {
    $this->form_validation->set_rules('id', 'ID aset', 'required');
    $this->form_validation->set_rules('nama', 'Nama Aset', 'required');

    if ($this->form_validation->run() == FALSE) {
      tampil_alert('error', 'Information', 'Data Aset Gagal diUpdate!');
    } else {
      $id = $this->input->post('id', TRUE);
      $config['upload_path'] = './assets/img/aset/'; //path folder
      $config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
      $config['file_name'] = "aset_" . $id; // Menggunakan ID sebagai nama file
      $config['overwrite'] = true;
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      $nama = $this->input->post('nama', TRUE);
      $keterangan = $this->input->post('keterangan');
      $status = $this->input->post('status');
      date_default_timezone_set('Asia/Jakarta');
      $update_at = date('Y-m-d h:i:s');
      if ($this->upload->do_upload('foto')) {
        $upload_data = $this->upload->data();
        $gambar = $upload_data['file_name']; // Gabungkan nama dan ekstensi
        $data = array(
          'nama_aset' => $nama,
          'keterangan' => $keterangan,
          'foto_aset' => $gambar,
          'updated_at' => $update_at,
          'status' => $status,
        );
      } else {
        $data = array(
          'nama_aset' => $nama,
          'keterangan' => $keterangan,
          'updated_at' => $update_at,
          'status' => $status,
        );
      }
      $where = array('id' => $id);

      $this->db->trans_start();
      $this->db->update('tb_aset', $data, $where);
      $this->db->trans_complete();

      tampil_alert('success', 'Berhasil', 'Data Aset Berhasil di Update');
    }

    redirect(base_url('hrd/aset'));
  }
  function hapus()
  {
    $id = $this->uri->segment(4);
    $where = array('id' => $id);
    $data = array(
      'deleted_at' => date('Y-m-d H:i:s'),
    );
    $this->M_admin->update('tb_aset', $data, $where);
    tampil_alert('success', 'Berhasil', 'Data berhasil dihapus !');
    redirect(base_url('hrd/aset'));
  }
  // detail aset
  public function get_asetToko()
  {
    $aset = $this->input->post('aset');
    $barang = $this->db->query("SELECT tt.*, ta.nama_aset from tb_aset_toko tt
    join tb_aset ta on tt.id_aset = ta.id where tt.id = '$aset'")->row();

    if ($barang) {
      echo json_encode($barang);
    } else {
      echo json_encode(array('error' => 'Data barang tidak ditemukan'));
    }
  }
  // update aset toko
  public function update_asetToko()
  {
    $qty = $this->input->post('qty');
    $no_aset = $this->input->post('no_aset');
    $keterangan = $this->input->post('keterangan');
    $id_aset = $this->input->post('id');
    $id_asetToko = $this->input->post('id_asetToko');
    $config['upload_path'] = './assets/img/aset/toko/'; //path folder
    $config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
    $config['file_name'] = "aset_" . $id_aset; // Menggunakan ID sebagai nama file
    $config['overwrite'] = true;
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    date_default_timezone_set('Asia/Jakarta');
    $update_at = date('Y-m-d h:i:s');
    if ($this->upload->do_upload('foto')) {
      $upload_data = $this->upload->data();
      $gambar = $upload_data['file_name']; // Gabungkan nama dan ekstensi
      $data = array(
        'qty' => $qty,
        'no_aset' => $no_aset,
        'keterangan' => $keterangan,
        'foto_aset' => $gambar,
        'updated_at' => $update_at,
      );
    } else {
      $data = array(
        'qty' => $qty,
        'no_aset' => $no_aset,
        'keterangan' => $keterangan,
        'updated_at' => $update_at,
      );
    }
    $where = array('id' => $id_asetToko);
    $this->db->update('tb_aset_toko', $data, $where);

    tampil_alert('success', 'Berhasil', 'Data Aset toko Berhasil di Update');
    redirect($_SERVER['HTTP_REFERER']);
  }
  public function hapus_asetToko($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('tb_aset_toko');
    if ($this->db->affected_rows() > 0) {
      tampil_alert('success', 'Berhasil', 'Data berhasil dihapus !');
    } else {
      tampil_alert('error', 'GAGAL', 'Data gagal dihapus !');
    }
    redirect($_SERVER['HTTP_REFERER']);
  }
  // fungsi tambah Barang
  public function proses_tambah()
  {
    $this->form_validation->set_rules('id', 'Id Aset', 'required');
    $this->form_validation->set_rules('nama', 'Nama Asset', 'required');

    if ($this->form_validation->run() == TRUE) {
      $nama = $this->input->post('nama', TRUE);
      $keterangan = $this->input->post('keterangan');
      $id = $this->input->post('id', TRUE);
      $config['upload_path'] = './assets/img/aset/'; //path folder
      $config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
      $config['file_name'] = "aset_" . $id; // Menggunakan ID sebagai nama file
      $config['overwrite'] = true;
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ($this->upload->do_upload('foto')) {
        $upload_data = $this->upload->data();
        $gambar = $upload_data['file_name']; // Gabungkan nama dan ekstensi

        $data = array(
          'id' => $id,
          'nama_aset' => $nama,
          'keterangan' => $keterangan,
          'status' => "1",
          'foto_aset' => $gambar,
        );

        $cek = $this->db->query("SELECT * FROM tb_aset WHERE nama_aset = '$nama' AND deleted_at is NULL")->num_rows();
        if ($cek > 0) {
          tampil_alert('Info', 'Information', 'Aset sudah ada!');
          redirect('hrd/aset');
        } else {
          $this->db->trans_start();
          $this->db->insert('tb_aset', $data);
          $this->db->trans_complete();
          tampil_alert('success', 'Berhasil', 'Data User Berhasil di buat');
          redirect(base_url('hrd/aset'));
        }
      } else {
        tampil_alert('error', 'Information', 'Harap Upload Foto terlebih dahulu!');
        redirect(base_url('hrd/aset'));
      }
    } else {
      tampil_alert('error', 'Information', 'Aset Gagal DiTambahkan!');
      redirect(base_url('hrd/aset'));
    }
  }
  public function list_aset()
  {
    $data['title'] = 'Management Aset';
    $data['list_data'] = $this->getTokoData();
    $this->template->load('template/template', 'hrd/aset/list_aset.php', $data);
  }
  private function getTokoData()
  {
    $query = $this->db->select('tt.id as id_toko, tt.nama_toko, tt.alamat, COUNT(ta.id_aset) AS total_aset, SUM(ta.qty) as total_qty')
      ->from('tb_toko tt')
      ->join('tb_aset_toko ta', 'tt.id = ta.id_toko', 'LEFT')
      ->group_by('tt.nama_toko')
      ->where('tt.status = 1')
      ->get();
    return $query->result();
  }
  public function tambah_aset_toko()
  {
    $id_toko   = $this->input->post('id_toko');
    $id_aset = $this->input->post('id_aset');
    $qty = $this->input->post('qty');
    $no_aset = $this->input->post('no_aset');
    $keterangan = $this->input->post('keterangan');
    $config['upload_path'] = './assets/img/aset/toko/'; //path folder
    $config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
    $config['file_name'] = "aset_" . $id_aset; // Menggunakan ID sebagai nama file
    $config['overwrite'] = true;
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if ($this->upload->do_upload('foto')) {
      $upload_data = $this->upload->data();
      $gambar = $upload_data['file_name'];
      $data = array(
        'id_aset'  => $id_aset,
        'id_toko' => $id_toko,
        'qty' => $qty,
        'no_aset' => $no_aset,
        'foto_aset' => $gambar,
        'keterangan' => $keterangan,
      );
      $this->db->insert('tb_aset_toko', $data);
    }

    tampil_alert('success', 'Berhasil', 'Aset berhasil ditambahkan ketoko ');
    redirect('hrd/Aset/detail/' . $id_toko);
  }
  public function edit_aset_toko()
  {
    $this->form_validation->set_rules('id_aset', 'Id Aset', 'required');
    $this->form_validation->set_rules('qty', 'Jumlah Qty', 'required');
    if ($this->form_validation->run() == TRUE) {
      $id          = $this->input->post('id', TRUE);
      $id_toko     = $this->input->post('id_toko', TRUE);
      $qty         = $this->input->post('qty', TRUE);
      $update_at   = $this->input->post('updated', TRUE);
      $where = array('id' => $id);
      $data = array(
        'id'            => $id,
        'qty'           => $qty,
        'updated_at'    => $update_at,
      );
      $this->M_admin->update('tb_aset_toko', $data, $where);
      tampil_alert('success', 'Berhasil', 'Data berhasil diupdate !');
      redirect('hrd/aset/list_aset?id_toko=' . $id_toko);
    } else {
      tampil_alert('erorr', 'Gagal', 'Data Gagal diupdate !');
      redirect('hrd/aset/list_aset?id_toko=' . $id_toko);
    }
  }
  public function approve()
  {
    $id = $this->uri->segment(4);
    $where = array('id' => $id);
    $data = array(
      'status' => 1,
    );
    $this->M_admin->update('tb_aset', $data, $where);
    tampil_alert('success', 'Berhasil', 'Aset Sudah Aktif!');
    redirect(base_url('hrd/aset'));
  }
  public function detail($id)
  {
    $data['title'] = 'Management Aset';
    $data['toko'] = $this->db->query("SELECT tt.*, tu.nama_user as spv, tuu.nama_user as leader, ts.nama_user as spg FROM tb_toko tt
    join tb_user tu on tt.id_spv = tu.id
    join tb_user tuu on tt.id_leader = tuu.id
    join tb_user ts on tt.id_spg = ts.id
    WHERE tt.id ='$id'")->row();
    $data['list'] = $this->db->query("SELECT ts.*, ta.nama_aset from tb_aset_toko ts
    join tb_aset ta on ts.id_aset = ta.id
    where ts.id_toko = '$id' and ts.status = 0 ")->result();
    $data['aset_spg'] = $this->db->query("SELECT ts.*, ta.nama_aset from tb_aset_toko ts
    join tb_aset ta on ts.id_aset = ta.id
    where ts.id_toko = '$id' and ts.status = 1 ")->result();
    $data['aset'] = $this->db->query("SELECT * from tb_aset where id  not in (select id_aset from tb_aset_toko where id_toko = '$id')")->result();
    $this->template->load('template/template', 'hrd/aset/detail', $data);
  }
}