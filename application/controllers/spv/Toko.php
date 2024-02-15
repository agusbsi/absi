<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Toko extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if ($role != "2" && $role != "3") {
      tampil_alert('error', 'DI TOLAK !', 'Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_spv');
    $this->load->model('M_spg');
  }

  // tampil data Aset
  public function index()
  {
    $id_spv = $this->session->userdata('id');
    $data['title'] = 'Kelola Toko';
    $data['toko'] = $this->db->query("SELECT tt.*, tu.nama_user
    from tb_toko tt
    left join tb_user tu on tt.id_leader = tu.id
    where tt.id_spv = $id_spv order by tt.id desc")->result();
    $data['list_leader'] = $this->db->query("SELECT * FROM tb_user WHERE role = 3")->result();
    $data['list_spg'] = $this->db->query("SELECT * FROM tb_user WHERE role = 4")->result();
    $data['customer'] = $this->db->query("SELECT * FROM tb_customer WHERE deleted_at is NULL")->result();
    // get data provinsi
    $get_prov = $this->db->select('*')->from('wilayah_provinsi')->get();
    $data['provinsi'] = $get_prov->result();
    $this->template->load('template/template', 'spv/toko/lihat_data', $data);
  }
  // list toko tutup
  public function toko_tutup()
  {
    $id_spv = $this->session->userdata('id');
    $data['title'] = 'List Toko Tutup';
    $data['toko_tutup'] = $this->db->query("SELECT tr.id as id_retur, tr.created_at, tr.status, tt.nama_toko from tb_retur tr
    join tb_toko tt on tr.id_toko = tt.id
    where tr.status >= 10 order by tr.id desc")->result();
    $this->template->load('template/template', 'spv/toko/toko_tutup', $data);
  }
  public function getdataRetur()
  {
    // Mengambil parameter id_toko dari permintaan Ajax
    $id_retur = $this->input->get('id_retur');
    $artikel = $this->db->query("SELECT trd.qty,tp.kode, tp.nama_produk from tb_retur_detail trd
      join tb_produk tp on trd.id_produk = tp.id
      where trd.id_retur = ?  order by tp.nama_produk desc ", array($id_retur));
    $aset = $this->db->query("SELECT tra.*, ta.nama_aset from tb_retur_aset tra
      join tb_aset ta on tra.id_aset = ta.id
      where tra.id_retur = ?  order by ta.nama_aset desc ", array($id_retur));
    $retur = $this->db->query("SELECT * from tb_retur where id = ?", array($id_retur))->row();

    $result = array();

    if ($artikel->num_rows() > 0) {
      $result['artikel'] = $artikel->result_array();
    } else {
      $result['artikel'] = array();
    }

    if ($aset->num_rows() > 0) {
      $result['aset'] = $aset->result_array();
    } else {
      $result['aset'] = array();
    }
    // Menambahkan data nama toko ke dalam hasil
    $result['catatan'] = $retur->catatan;
    $result['tgl_tarik'] = $retur->tgl_jemput;

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
  }

  //  form tutup
  public function form_tutup()
  {
    $id_spv = $this->session->userdata('id');
    $data['title'] = 'List Toko Tutup';
    $data['list_toko']  = $this->db->query("SELECT * from tb_toko where id_spv = '$id_spv' OR id_leader = '$id_spv' AND status = 1")->result();
    $data['kode_retur'] = $this->M_spg->kode_retur(); // generate no permintaan
    $data['list_aset']  = $this->db->query("SELECT * from tb_aset where status = 1 order by nama_aset asc")->result();
    $this->template->load('template/template', 'spv/toko/form_tutup_toko', $data);
  }
  // cek list artikel
  public function artikelToko()
  {
    $id_toko   = $this->input->get('id_toko');
    $data = $this->db->query("SELECT ts.qty,ts.id_produk, tp.kode, tp.nama_produk from tb_stok ts
    join tb_produk tp on ts.id_produk = tp.id
    where id_toko = '$id_toko'")->result();
    echo json_encode($data);
  }

  // simpan simpanRetur
  public function saveTutup()
  {
    $id_toko        = $this->input->post('id_toko');
    $tgl_tarik      = $this->input->post('tgl_tarik');
    $catatan        = $this->input->post('catatan');
    $id_spv         = $this->session->userdata('id');
    $no_retur       = $this->M_spg->kode_retur(); // generate no permintaan
    $id_aset        = $this->input->post('id_aset');
    $qty_input      = $this->input->post('qty_input');
    $kondisi        = $this->input->post('kondisi');
    $keterangan     = $this->input->post('keterangan');
    $id_produk      = $this->input->post('id_produk');
    $qty_retur      = $this->input->post('qty_retur');
    $jml            = count($id_aset);
    $jml_produk     = count($id_produk);
    // ambil nama toko
    $get_toko = $this->db->query("SELECT nama_toko from tb_toko where id ='$id_toko'")->row()->nama_toko;
    $this->db->trans_start();
    // cek jumlah aset
    for ($i = 0; $i < $jml; $i++) {
      if ($qty_input[$i] > 0 || !empty($qty_input[$i])) {
        $data = array(
          'id_aset' => $id_aset[$i],
          'id_retur' => $no_retur,
          'qty' => $qty_input[$i],
          'kondisi' => $kondisi[$i],
          'keterangan' => $keterangan[$i],
        );
        $this->db->insert('tb_retur_aset', $data);
      }
    }
    //  cek jumlah id_produk
    for ($a = 0; $a < $jml_produk; $a++) {
      $dataArtikel = array(
        'id_produk'   => $id_produk[$a],
        'id_retur'    => $no_retur,
        'qty'         => $qty_retur[$a]
      );
      $this->db->insert('tb_retur_detail', $dataArtikel);
    }
    // simpan ke tabel retur
    $dataRetur = array(
      'id'          => $no_retur,
      'id_toko'     => $id_toko,
      'id_user'     => $id_spv,
      'status'      => 10,
      'tgl_jemput'  => $tgl_tarik,
      'catatan'     => $catatan,
    );
    $this->db->insert('tb_retur', $dataRetur);
    $this->db->trans_complete();
    $hp = $this->db->query("SELECT no_telp FROM tb_user WHERE role = 6")->row();
    $phone = $hp->no_telp;
    $message = "Anda memiliki pengajuan Tutup Toko untuk ( " . $get_toko . " ) silahkan kunjungi s.id/absi-app";
    kirim_wa($phone, $message);
    tampil_alert('success', 'Berhasil', 'Pengajuan Tutup Toko berhasil di buat');
    redirect(base_url('spv/Toko/toko_tutup'));
  }
  // ambil data ajax untuk wilayah
  function add_ajax_kab($id_prov)
  {
    $query = $this->db->get_where('wilayah_kabupaten', array('provinsi_id' => $id_prov));
    $data = "<option value=''>- Select Kabupaten -</option>";
    foreach ($query->result() as $value) {
      $data .= "<option value='" . $value->id . "'>" . $value->nama . "</option>";
    }
    echo $data;
  }

  function add_ajax_kec($id_kab)
  {
    $query = $this->db->get_where('wilayah_kecamatan', array('kabupaten_id' => $id_kab));
    $data = "<option value=''> - Pilih Kecamatan - </option>";
    foreach ($query->result() as $value) {
      $data .= "<option value='" . $value->id . "'>" . $value->nama . "</option>";
    }
    echo $data;
  }

  function add_ajax_des($id_kec)
  {
    $query = $this->db->get_where('wilayah_desa', array('kecamatan_id' => $id_kec));
    $data = "<option value=''> - Pilih Desa - </option>";
    foreach ($query->result() as $value) {
      $data .= "<option value='" . $value->id . "'>" . $value->nama . "</option>";
    }
    echo $data;
  }
  // Script profil toko
  public function profil($id_toko)
  {
    $cekspv = $this->db->query("SELECT id_spv from tb_toko where id = '$id_toko'")->row()->id_spv;
    $id_spv = $this->session->userdata('id');
    if ($cekspv != $id_spv) {
      tampil_alert('info', 'Information', 'Anda tidak punya akses di Toko ini!');
      redirect(base_url('spv/Customer'));
    }
    $data['last_update'] = $this->M_spv->last_update_stok($id_toko);
    $data['cek_status'] = $this->db->query("SELECT status from tb_toko where id = '$id_toko'")->row();
    $data['title']         = 'Kelola Toko';
    $data['toko']          = $this->db->query("SELECT tt.*, tp.nama as provinsi,tk.nama as kabupaten,tc.nama as kecamatan, tt.provinsi as id_provinsi from tb_toko tt
     join wilayah_provinsi tp on tt.provinsi = tp.id
     join wilayah_kabupaten tk on tt.kabupaten = tk.id
     join wilayah_kecamatan tc on tt.kecamatan = tc.id
     where tt.id = '$id_toko'")->row();
    //  list leader
    $data['list_leader']  = $this->db->query("SELECT * from tb_user where status = 1 and role = 3 ")->result();
    //  lihat leader toko
    $data['leader_toko']   = $this->db->query("SELECT tt.*, tb_user.nama_user
     from tb_toko tt
     join tb_user on tt.id_leader = tb_user.id
     where tt.id = '$id_toko' and tt.id_spv = '$id_spv' ")->result();
    //  lihat spg
    $data['spg']   = $this->db->query("SELECT tt.*,tb_user.nama_user 
     from tb_toko tt
     join tb_user on tt.id_spg = tb_user.id
     where tt.id = '$id_toko' and tt.id_spv = '$id_spv' ")->result();
    //  stok produk per toko
    $data['stok_produk']   = $this->db->query("SELECT tb_produk.nama_produk, tb_produk.satuan, tb_produk.kode, tb_stok.*, tb_produk.harga_jawa, tb_produk.harga_indobarat, tb_toko.diskon from tb_stok
     join tb_produk on tb_stok.id_produk = tb_produk.id
     join tb_toko on tb_stok.id_toko = tb_toko.id
     where tb_stok.id_toko = '$id_toko' order by tb_stok.qty desc")->result();
    //  cek status di stok masing" toko
    $data['cek_status_stok']  = $this->db->query("SELECT status from tb_stok where id_toko = '$id_toko' and status = 2 ")->num_rows();
    //  list Produk
    $data['list_produk']  = $this->db->query("SELECT * from tb_produk where id not in (select id_produk from tb_stok where id_toko = '$id_toko') ")->result();

    $this->template->load('template/template', 'spv/toko/profil', $data);
  }
  // hash password
  private function hash_password($password)
  {
    return password_hash($password, PASSWORD_DEFAULT);
  }
  // proses tambah terbaru 2 foto
  public function proses_tambah_baru()
  {
    $kode_customer      = $this->input->post('kode_customer');
    $customer           = $this->input->post('customer');
    $pic_cust           = $this->input->post('pic_cust');
    $telp_cust          = $this->input->post('telp_cust');
    $top                = $this->input->post('top');
    $tagihan            = $this->input->post('tagihan');
    $alamat_cust        = $this->input->post('alamat_cust');

    $this->db->trans_start();
    $database = $this->db->database;
    $id_auto_cust = $this->db->query("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$database' AND TABLE_NAME = 'tb_customer' ")->row()->AUTO_INCREMENT;
    // Proses upload foto NPWP
    $config['upload_path'] = 'assets/img/customer/';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['file_name'] = 'npwp_' . $id_auto_cust;
    $config['overwrite'] = TRUE;
    $config['remove_spaces'] = TRUE;
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if ($this->upload->do_upload('foto_npwp')) {
      $foto_npwp = $this->upload->data('file_name');
    } else {
      $foto_npwp  = "";
      // Tampilkan error jika upload foto KTP gagal
    }

    // Proses upload foto ktp
    $config['upload_path'] = 'assets/img/customer/';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['file_name'] = 'ktp_' . $id_auto_cust;
    $config['overwrite'] = TRUE;
    $config['remove_spaces'] = TRUE;
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if ($this->upload->do_upload('foto_ktp')) {
      $foto_ktp = $this->upload->data('file_name');
    } else {
      $foto_ktp = "";
      // Tampilkan error jika upload foto selfie gagal
    }

    // Simpan data user ke dalam database
    $data_customer = array(
      'kode_customer'    => $kode_customer,
      'nama_cust'         => $customer,
      'nama_pic'          => $pic_cust,
      'telp'              => $telp_cust,
      'wajib_pajak'       => $top,
      'foto_npwp'         => $foto_npwp,
      'foto_ktp'          => $foto_ktp,
      'top'               => $top,
      'tagihan'           => $tagihan,
      'alamat_cust'       => $alamat_cust,
    );
    $this->M_spv->insert('tb_customer', $data_customer);
    $id_customer  = $this->db->insert_id();
    $id_auto_toko = $this->db->query("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$database' AND TABLE_NAME = 'tb_toko' ")->row()->AUTO_INCREMENT;
    // Proses upload foto Toko
    $config['upload_path'] = 'assets/img/toko/';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['file_name'] = 'toko_' . $id_auto_toko;
    $config['overwrite'] = TRUE;
    $config['remove_spaces'] = TRUE;
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if ($this->upload->do_upload('foto_toko')) {
      $foto_toko = $this->upload->data('file_name');
    } else {
      $foto_toko  = "";
      // Tampilkan error jika upload foto KTP gagal
    }

    // Proses upload foto Kepala Toko
    $config['upload_path'] = 'assets/img/toko/';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['file_name'] = 'kepala_toko_' . $id_auto_toko;
    $config['overwrite'] = TRUE;
    $config['remove_spaces'] = TRUE;
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if ($this->upload->do_upload('foto_pic')) {
      $foto_pic = $this->upload->data('file_name');
    } else {
      $foto_pic = "";
      // Tampilkan error jika upload foto KTP gagal
    }
    $nama_toko          = $this->input->post('nama_toko');
    $s_rider            = $this->input->post('s_rider');
    $s_gtman            = $this->input->post('s_gtman');
    $s_crocodile        = $this->input->post('s_crocodile');
    $jenis_toko         = $this->input->post('jenis_toko');
    $target_toko        = $this->input->post('target');
    $provinsi           = $this->input->post('provinsi');
    $kabupaten          = $this->input->post('kabupaten');
    $kecamatan          = $this->input->post('kecamatan');
    $alamat             = $this->input->post('alamat');
    $nama_pic           = $this->input->post('nama_pic');
    $nohp               = $this->input->post('nohp');
    $id_spv             = $this->session->userdata('id');
    $id_leader          = $this->input->post('id_leader');
    $id_spg             = $this->input->post('id_spg');
    $het                = $this->input->post('het');
    $diskon             = $this->input->post('diskon');
    $tgl_so             = $this->input->post('tgl_so');

    $data_toko = array(
      'id_customer'    => $id_customer,
      'id_spv'         => $id_spv,
      'id_leader'      => $id_leader,
      'id_spg'         => $id_spg,
      'nama_toko'      => $nama_toko,
      'jenis_toko'      => $jenis_toko,
      's_rider'        => $s_rider,
      's_gtman'        => $s_gtman,
      's_crocodile'    => $s_crocodile,
      'target'         => $target_toko,
      'provinsi'       => $provinsi,
      'kabupaten'      => $kabupaten,
      'kecamatan'      => $kecamatan,
      'alamat'         => $alamat,
      'nama_pic'       => $nama_pic,
      'telp'           => $nohp,
      'status'         => '2',
      'foto_toko'      => $foto_toko,
      'foto_pic'       => $foto_pic,
      'het'               => $het,
      'diskon'            => $diskon,
      'tgl_so'            => $tgl_so,
    );

    $cek = $this->db->query("SELECT * FROM tb_toko WHERE nama_toko = '$nama_toko' AND status != '0'")->num_rows();
    if ($cek > 0) {
      tampil_alert('info', 'Information', 'Toko sudah ada!');
      redirect(base_url('spv/toko'));
    } else {
      $this->M_spv->insert('tb_toko', $data_toko);
    }
    $this->db->trans_complete();
    $hp = $this->db->query("SELECT no_telp FROM tb_user WHERE id = 125")->row();
    $phone = $hp->no_telp;
    $message = "Anda memiliki pengajuan Customer baru silahkan kunjungi s.id/absi-app";
    kirim_wa($phone, $message);
    tampil_alert('success', 'Berhasil', 'Data Customer & Toko Berhasil di buat');
    redirect(base_url('spv/Toko'));
  }
  // proses tambah terbaru 2 foto
  public function proses_cabang()
  {

    $id_customer        = $this->input->post('id_customer');
    $nama_toko          = $this->input->post('nama_toko');
    $s_rider            = $this->input->post('s_rider');
    $s_gtman            = $this->input->post('s_gtman');
    $s_crocodile        = $this->input->post('s_crocodile');
    $jenis_toko         = $this->input->post('jenis_toko');
    $target_toko        = $this->input->post('target');
    $provinsi           = $this->input->post('provinsi');
    $kabupaten          = $this->input->post('kabupaten');
    $kecamatan          = $this->input->post('kecamatan');
    $alamat             = $this->input->post('alamat');
    $nama_pic           = $this->input->post('nama_pic');
    $nohp               = $this->input->post('nohp');
    $pajak              = $this->input->post('pajak');
    $id_spv             = $this->session->userdata('id');
    $id_leader          = $this->input->post('id_leader');
    $id_spg             = $this->input->post('id_spg');
    $het                = $this->input->post('het');
    $diskon             = $this->input->post('diskon');
    $tgl_so             = $this->input->post('tgl_so');

    $database = $this->db->database;
    $id_auto_toko = $this->db->query("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$database' AND TABLE_NAME = 'tb_toko' ")->row()->AUTO_INCREMENT;
    // Proses upload foto Toko
    $config['upload_path'] = 'assets/img/toko/';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['file_name'] = 'toko_' . $id_auto_toko;
    $config['overwrite'] = TRUE;
    $config['remove_spaces'] = TRUE;
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if ($this->upload->do_upload('foto_toko')) {
      $foto_toko = $this->upload->data('file_name');
    } else {
      $foto_toko  = "";
      // Tampilkan error jika upload foto KTP gagal
    }

    // Proses upload foto Kepala Toko
    $config['upload_path'] = 'assets/img/toko/';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['file_name'] = 'kepala_toko_' . $id_auto_toko;
    $config['overwrite'] = TRUE;
    $config['remove_spaces'] = TRUE;
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if ($this->upload->do_upload('foto_pic')) {
      $foto_pic = $this->upload->data('file_name');
    } else {
      $foto_pic = "";
      // Tampilkan error jika upload foto KTP gagal
    }


    $data_toko = array(
      'id_customer'    => $id_customer,
      'id_spv'         => $id_spv,
      'id_leader'      => $id_leader,
      'id_spg'         => $id_spg,
      'nama_toko'      => $nama_toko,
      'jenis_toko'      => $jenis_toko,
      's_rider'        => $s_rider,
      's_gtman'        => $s_gtman,
      's_crocodile'    => $s_crocodile,
      'target'         => $target_toko,
      'provinsi'       => $provinsi,
      'kabupaten'      => $kabupaten,
      'kecamatan'      => $kecamatan,
      'alamat'         => $alamat,
      'nama_pic'       => $nama_pic,
      'telp'           => $nohp,
      'status'         => '2',
      'foto_toko'      => $foto_toko,
      'foto_pic'       => $foto_pic,
      'het'               => $het,
      'diskon'            => $diskon,
      'tgl_so'            => $tgl_so,
    );
    $this->db->trans_start();
    $cek = $this->db->query("SELECT * FROM tb_toko WHERE nama_toko = '$nama_toko' AND status != '0'")->num_rows();
    if ($cek > 0) {
      tampil_alert('info', 'Information', 'Toko sudah ada!');
      redirect(base_url('spv/toko'));
    } else {
      $this->M_spv->insert('tb_toko', $data_toko);
    }
    $this->db->trans_complete();
    $hp = $this->db->query("SELECT no_telp FROM tb_user WHERE id = 125")->row();
    $phone = $hp->no_telp;
    $message = "Anda memiliki 1 Pengajuan Toko baru yang perlu approve silahkan kunjungi s.id/absi-app";
    kirim_wa($phone, $message);
    tampil_alert('success', 'Berhasil', 'Toko Cabang Berhasil di buat');
    redirect(base_url('spv/Toko'));
  }
  // add leader
  public function add_leader()
  {
    $leader     = $this->input->post('leader');
    $id_toko     = $this->input->post('id_toko');
    $this->db->query("UPDATE tb_toko set id_leader = '$leader' where id ='$id_toko'");
    tampil_alert('success', 'Berhasil', 'Data team leader Berhasil di Kaitkan');
    redirect(base_url('spv/toko/profil/' . $id_toko));
  }
  // tambah artikel
  public function tambah_artikel()
  {
    $this->form_validation->set_rules('id_toko', 'ID Toko', 'required');
    $this->form_validation->set_rules('id_produk', 'Id Produk', 'required');
    if ($this->form_validation->run() == TRUE) {
      $id_toko = $this->input->post('id_toko');
      $id_produk = $this->input->post('id_produk');
      // ambil nama toko
      $get_toko = $this->db->query("SELECT nama_toko from tb_toko where id ='$id_toko'")->row()->nama_toko;
      $data = array(
        'id_produk' => $id_produk,
        'id_toko' => $id_toko,
        'status' => '2',
      );
      $cek = $this->db->query("SELECT * FROM tb_stok WHERE id_produk = '$id_produk' AND id_toko = '$id_toko'")->num_rows();
      if ($cek > 0) {
        tampil_alert('info', 'Information', 'Artikel sudah terdaftar di Toko ini!');
        redirect(base_url('spv/toko/profil/' . $id_toko));
      } else {
        $this->db->trans_start();
        $this->M_spv->insert('tb_stok', $data);
        // ambil insert id
        $id_stok = $this->db->insert_id();
        $this->db->trans_complete();
        $hp = $this->db->query("SELECT no_telp FROM tb_user WHERE id = 125")->row();
        $phone = $hp->no_telp;
        $message = "Anda memiliki 1 Pengajuan Artikel baru untuk toko ( " . $get_toko . " ) yang perlu di approve silahkan kunjungi s.id/absi-app";
        kirim_wa($phone, $message);
        tampil_alert('success', 'Berhasil', 'Artikel Berhasil didaftarkan, menunggu approve Manager!');
        redirect(base_url('spv/toko/profil/' . $id_toko));
      }
    } else {
      tampil_alert('error', 'Gagal', 'Artikel Gagal didaftarkan!');
      redirect(base_url('spv/toko/profil/' . $id_toko));
    }
  }
}
