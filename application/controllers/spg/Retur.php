<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Retur extends CI_Controller
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
    $this->load->model('M_produk');
    $this->load->model('M_admin');
  }

  // tampil data retur
  public function index()
  {
    $id_toko = $this->session->userdata('id_toko');
    $data['title'] = 'Retur Barang';
    $data['list_retur'] = $this->db->query("SELECT * from tb_retur where id_toko ='$id_toko' and status < 10 Order By id desc ")->result();
    $this->template->load('template/template', 'spg/retur/index', $data);
  }
  // detail retur
  public function detail($id)
  {

    $data['title'] = 'Retur Barang';
    $data_retur = $this->db->query("SELECT tp.id, tp.created_at, tp.status, tt.nama_toko, tu.nama_user  from tb_retur tp 
    join tb_toko tt on tt.id = tp.id_toko 
    join tb_user tu on tu.id = tp.id_user 
    where  tp.id = '$id'")->row();
    $data['detail_retur'] = $this->db->query("SELECT td.*, tp.nama_produk, tp.kode FROM tb_retur_detail td
    join tb_produk tp on td.id_produk = tp.id
    WHERE id_retur = '$id'")->result();
    $data['no_retur'] = $id;
    $data['tanggal'] = $data_retur->created_at;
    $data['status'] = $data_retur->status;
    $data['nama_toko'] = $data_retur->nama_toko;
    $data['nama'] = $data_retur->nama_user;
    $this->template->load('template/template', 'spg/retur/detail', $data);
  }
  // tambah retur
  public function tambah_retur()
  {
    if ($this->session->userdata('cart') != "Retur") {
      $this->cart->destroy();
    }
    $id_toko = $this->session->userdata('id_toko');
    $data['title'] = 'Retur Barang';
    $data['nama'] = $this->session->userdata('nama_user'); // generate no permintaan
    $user_id = $this->session->userdata('id');
    $data_toko = $this->M_spg->user_toko($user_id)->row(); // generate no permintaan
    $id_toko = $this->session->userdata('id_toko');
    $data['toko_new'] = $this->db->query("SELECT * from tb_toko where id = '$id_toko'")->row();
    $data['kode_retur'] = $this->M_spg->kode_retur(); // generate no permintaan

    $data['list_produk'] = $this->db->query("SELECT tp.kode, ts.id_produk from tb_stok ts
    join tb_produk tp on ts.id_produk = tp.id
    where id_toko = '$id_toko'")->result();
    $data['data_cart'] = $this->cart->contents(); // menampilkan data cart

    $this->template->load('template/template', 'spg/retur/tambah_retur', $data);
  }
  public function tambah_cart()
  {
    $id = $this->input->post('id');
    $kirim = $this->input->post('no_kirim');
    $qty = $this->input->post('qty');
    $keterangan = $this->input->post('keterangan');
    $catatan = $this->input->post('catatan');
    $no_retur = $this->M_spg->kode_retur();
    $produk = $this->M_produk->get_by_id($id);

    // upload foto
    $file_name = str_replace('-', '', $produk->id . $no_retur);
    $config['upload_path'] = './assets/img/retur/';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['file_name'] = $file_name;
    $config['overwrite'] = true;

    $this->load->library('image_lib', $config);
    $this->image_lib->resize();
    $this->upload->initialize($config);

    // Cek apakah ada unggahan foto
    if (isset($_FILES['foto_retur']) && $_FILES['foto_retur']['error'] != UPLOAD_ERR_NO_FILE) {
      $this->upload->do_upload('foto_retur');
      $gbr = $this->upload->data();
      $foto_retur = $gbr['file_name'];
    } else {
      $foto_retur = ''; // Jika tidak ada unggahan foto
    }
    $data = array(
      'id'      => $id,
      'qty'     => $qty,
      'price'   => "",
      'name'    => $produk->id,
      'options' => $produk->kode,
      'sj'      => $kirim,
      'keterangan' => array(
        'status' => $keterangan,
        'catatan' => $catatan
      ),
      'foto_retur' => $foto_retur,
    );

    $this->cart->insert($data);
    $this->session->set_userdata('cart', 'Retur');
    redirect(base_url('spg/retur/tambah_retur'));
  }

  public function hapus_cart($id)
  {

    $this->cart->remove($id);

    redirect(base_url('spg/retur/tambah_retur'));
  }
  public function reset_cart()
  {
    $this->cart->destroy();

    redirect(base_url('spg/tambah_retur'));
  }
  // menampilkan list detail json
  function list_detail()
  {
    $id = $_POST['no_kirim'];
    $id_toko = $this->session->userdata('id_toko');
    $data = $this->M_spg->barang_list($id, $id_toko);
    echo json_encode($data);
  }
  public function tampilkan_detail_produk($id)
  {
    $id_toko = $this->session->userdata('id_toko');
    $data_produk = $this->db->query("SELECT qty from tb_stok 
        where id_produk = '$id' and id_toko = '$id_toko' ")->row();
    if ($data_produk) {
      $hasil = array(
        'stok' => $data_produk->qty,
      );
    } else {
      $hasil = array(
        'stok' => "0"
      );
    }
    echo json_encode($hasil);
  }
   // proses simpan
  public function kirim_retur()
  {
    $id_toko = $this->session->userdata('id_toko');
    $id_user = $this->session->userdata('id');
    $no_retur = $this->M_spg->kode_retur();
    $config['upload_path'] = './assets/img/retur/lampiran/';
    $config['allowed_types'] = 'pdf|doc|docx|jpg|jpeg|png';
    $config['max_size'] = 10048;
    $config['overwrite'] = true; // Izinkan mode overwrite
    $this->load->library('upload', $config);
    $upload_data_lampiran = null;
    $upload_data_foto_packing = null;
    // Initialize variables
    $lampiran = "";
    $packing = "";
    // Upload 'lampiran' file
    $config['file_name'] = "lampiran_" . $no_retur; // Nama file sesuai pola
    $this->upload->initialize($config);
    if ($this->upload->do_upload('lampiran')) {
      $upload_data_lampiran = $this->upload->data();
      $lampiran = $upload_data_lampiran['file_name'];
    } else {
      $error = $this->upload->display_errors();
    }
    // Upload 'foto_packing' file
    $config['file_name'] = "packing_" . $no_retur; // Nama file sesuai pola
    $this->upload->initialize($config);
    if ($this->upload->do_upload('foto_packing')) {
      $upload_data_foto_packing = $this->upload->data();
      $packing = $upload_data_foto_packing['file_name'];
    } else {
      $error = $this->upload->display_errors();
    }
    $data_retur = array(
      'id' => $no_retur,
      'id_toko' => $id_toko,
      'id_user' => $id_user,
      'lampiran' => $lampiran,
      'foto_packing' => $packing,
    );
    $this->db->trans_start();
    $this->db->insert('tb_retur', $data_retur);
    $data_cart = $this->cart->contents();
    foreach ($data_cart as $d) {
      $data = array(
        'id_retur' => $no_retur,
        'id_produk' => $d['id'],
        'keterangan' => $d['keterangan']['status'],
        'catatan' => $d['keterangan']['catatan'],
        'qty' => $d['qty'],
        'id_pengiriman' => $d['sj'],
        'foto' => $d['foto_retur'],
      );
      $this->db->insert('tb_retur_detail', $data);
    }
    $this->db->trans_complete();
    $this->cart->destroy();
    $got_lead = $this->db->query("SELECT id_leader FROM tb_toko WHERE id = '$id_toko' AND id_spg = '$id_user'")->row();
    $id_lead = $got_lead->id_leader;
    $hp = $this->db->query("SELECT no_telp FROM tb_user WHERE id = '$id_lead'")->row();
    $phone = $hp->no_telp;
    $message = "Anda memiliki 1 Pengajuan Retur baru dengan nomor ( " . $no_retur . " ) yang perlu approve silahkan kunjungi s.id/absi-app";
    kirim_wa($phone, $message);
    tampil_alert('success', 'Berhasil', 'Data berhasil disimpan !');
    redirect(base_url('spg/Retur'));
  }
  public function resi()
  {
    $this->form_validation->set_rules('no_retur', 'Nomor Retur', 'required');

    if ($this->form_validation->run() == TRUE) {
      $id_retur = $this->input->post('no_retur');
      $resi = $this->input->post('resi');
      $ekspedisi = $this->input->post('ekspedisi');
      $where = array('id' => $id_retur);
      if ($ekspedisi == "gudang") {
        $tgl_jemput = $this->input->post('tgl_penjemputan');
        $data = array(
          'status' => '6',
          'tgl_jemput' => $tgl_jemput,
          'ekspedisi' => $ekspedisi,
        );
        $this->M_admin->update('tb_retur', $data, $where);
        tampil_alert('success', 'Berhasil', 'Tanggal Penjemputan Sudah Diinfokan ke pihak Gudang!');
      } else {
        $data = array(
          'status' => '3',
          'no_resi' => $resi,
          'ekspedisi' => $ekspedisi,
        );
        $this->M_admin->update('tb_retur', $data, $where);
        tampil_alert('success', 'Berhasil', 'Nomor Resi Berhasil Dikirim!');
      }
      redirect(base_url('spg/retur'));
    }
  }
}

