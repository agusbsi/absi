<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toko extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "9" && $role != "1"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_spv');
  }

 // tampil data Aset
  public function index()
  {
    $id_spv = $this->session->userdata('id');
    $data['title'] = 'Kelola Toko';
    $data['toko'] = $this->db->query("SELECT tt.*, tu.nama_user
    from tb_toko tt
    left join tb_user tu on tt.id_spg = tu.id
    ORDER BY tt.status = 2 DESC, tt.status = 4 DESC,tt.status = 3 DESC, tt.id desc")->result();
    $this->template->load('template/template', 'manager_mkt/toko/lihat_data', $data);
  }
  // list toko tutup
  public function toko_tutup()
  {
    $id_spv = $this->session->userdata('id');
    $data['title'] = 'List Toko Tutup';
    $data['toko_tutup'] = $this->db->query("SELECT tr.id as id_retur, tr.created_at, tr.status, tt.nama_toko from tb_retur tr
    join tb_toko tt on tr.id_toko = tt.id
    where tr.status >= 10 order by tr.id desc")->result();
    $this->template->load('template/template', 'manager_mkt/toko/toko_tutup', $data);
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
    $result['catatan_mv'] = $retur->catatan_mv;
    $result['catatan_mm'] = $retur->catatan_mm;
    $result['tgl_tarik'] = $retur->tgl_jemput;
    $result['status'] = $retur->status;
    $result['id_toko'] = $retur->id_toko;

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
  }
  // approve pengajuan tutup toko
  public function approveToko()
  {
    $no_retur = $this->input->post('id_retur');
    $id_toko = $this->input->post('id_toko');
    $catatan_mm = $this->input->post('catatan_mm');
    $data = array(
      'catatan_mm'  => $catatan_mm,
      'status'  => 12,
      'updated_at' => date("Y-m-d")
    );
    $where = array(
      'id'  => $no_retur
    );
    $this->db->update('tb_retur', $data, $where);
    $get_toko = $this->db->query("SELECT nama_toko from tb_toko where id ='$id_toko'")->row()->nama_toko;
    $hp = $this->db->query("SELECT no_telp FROM tb_user WHERE role = 1")->row();
    $phone = $hp->no_telp;
    $message = "Anda memiliki pengajuan Tutup Toko untuk ( " . $get_toko . " ) silahkan kunjungi s.id/absi-app";
    kirim_wa($phone, $message);
    tampil_alert('success', 'Berhasil', 'Data Pengajuan berhasil di Approve!');
    redirect(base_url('mng_mkt/Toko/toko_tutup'));
  }
  public function tolakToko($id, $catatan_mm)
  {

    $data = array(
      'catatan_mm'  => $catatan_mm,
      'status'  => 16,
      'updated_at' => date("Y-m-d")
    );
    $where = array(
      'id'  => $id
    );
    $this->db->update('tb_retur', $data, $where);
    tampil_alert('success', 'DITOLAK', 'Data Pengajuan di Tolak!');
    redirect(base_url('mng_mkt/Toko/toko_tutup'));
  }
  // halaman update toko
  public function update($id)
  {
    $data['title'] = 'Kelola Toko';
    $data['detail'] = $this->db->query("SELECT tb_toko.*, tb_user.nama_user as spg from tb_toko
    left join tb_user on tb_toko.id_spg = tb_user.id 
    where tb_toko.id = '$id'")->row();
    $data['provinsi'] = $this->db->query("SELECT * from wilayah_provinsi")->result();
    $data['kabupaten'] = $this->db->query("SELECT * from wilayah_kabupaten")->result();
    $data['kecamatan'] = $this->db->query("SELECT * from wilayah_kecamatan")->result();

    $data['supervisor'] = $this->db->query("SELECT * from tb_user where role ='2' and status ='1'")->result();
    $data['leader'] = $this->db->query("SELECT * from tb_user where role ='3' and status ='1'")->result();
    $data['spg'] = $this->db->query("SELECT * from tb_user where role ='4' and status ='1'")->result();
    $this->template->load('template/template', 'manager_mkt/toko/update', $data);
  }
  // ambil data kab
  function add_ajax_kab($id_prov)
  {
    $query = $this->db->get_where('wilayah_kabupaten', array('provinsi_id' => $id_prov));
    $data = "<option value=''>- Select Kabupaten -</option>";
    foreach ($query->result() as $value) {
      $data .= "<option value='" . $value->id . "'>" . $value->nama . "</option>";
    }
    echo $data;
  }
  //  ambil data kec
  function add_ajax_kec($id_kab)
  {
    $query = $this->db->get_where('wilayah_kecamatan', array('kabupaten_id' => $id_kab));
    $data = "<option value=''>- Select Kecamatan -</option>";
    foreach ($query->result() as $value) {
      $data .= "<option value='" . $value->id . "'>" . $value->nama . "</option>";
    }
    echo $data;
  }

  //  Update detail toko
  public function proses_update()
  {
    $id_toko = $this->input->post('id_toko');
    $jenis_toko = $this->input->post('jenis_toko');
    $pic = $this->input->post('pic');
    $no_telp = $this->input->post('no_telp');
    $tgl_so = $this->input->post('tgl_so');
    $het = $this->input->post('het');
    $diskon = $this->input->post('diskon');
    $limit = $this->input->post('limit');
    $provinsi = $this->input->post('provinsi');
    $kabupaten = $this->input->post('kabupaten');
    $kecamatan = $this->input->post('kecamatan');
    $alamat = $this->input->post('alamat');

    $target = $this->input->post('target');
    $updated = date('Y-m-d H:i:s');

    $data = array(
      'jenis_toko' => $jenis_toko,
      'nama_pic' => $pic,
      'telp' => $no_telp,
      'tgl_so' => $tgl_so,
      'het' => $het,
      'diskon' => $diskon,
      'limit_toko' => $limit,
      'provinsi' => $provinsi,
      'kabupaten' => $kabupaten,
      'kecamatan' => $kecamatan,
      'alamat' => $alamat,

      'target' => $target,
      'updated_at' => $updated
    );
    $where = array(
      'id' => $id_toko
    );
    $this->db->update('tb_toko', $data, $where);
    tampil_alert('success', 'Berhasil', 'Data Toko berhasil di Perbaharui!');
    redirect(base_url('mng_mkt/Toko/update/' . $id_toko));
  }
  // update foto toko
  public function update_foto()
  {
    $id_toko = $this->input->post('id_toko_foto');
    $config['upload_path'] = 'assets/img/toko/';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['max_size'] = '2048';
    $config['file_name'] = $id_toko;
    $config['overwrite'] = TRUE;
    $config['remove_spaces'] = TRUE;
    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if (!$this->upload->do_upload('foto')) {
    } else {
      // Jika upload berhasil, simpan data foto ke database
      $foto = $this->upload->data('file_name');
      $id_toko = $this->input->post('id_toko_foto');
      // simpan data foto ke database sesuai dengan id data yang ingin diupdate
      $this->db->query("UPDATE tb_toko set foto_toko ='$foto' where id='$id_toko'");
      $data['toko'] = $this->db->query("SELECT * from tb_toko where id = '$id_toko'")->row();
      $data['pesan'] = "berhasil di update";
      echo json_encode($data);
    }
  }
  // Script profil toko
  public function profil($id_toko)
  {
    $id_spv = $this->session->userdata('id');
    $data['last_update'] = $this->M_spv->last_update_stok($id_toko);
    $data['cek_status'] = $this->db->query("SELECT status from tb_toko where id = '$id_toko'")->row();
    $data['title'] = 'Kelola Toko';
    $data['toko'] = $this->db->query("SELECT tt.*, tp.nama as provinsi,tk.nama as kabupaten,tc.nama as kecamatan, tt.provinsi as id_provinsi from tb_toko tt
     join wilayah_provinsi tp on tt.provinsi = tp.id
     join wilayah_kabupaten tk on tt.kabupaten = tk.id
     join wilayah_kecamatan tc on tt.kecamatan = tc.id
     where tt.id = '$id_toko'")->row();
    //  lihat SPV toko
    $data['spv'] = $this->db->query("SELECT tt.*, tb_user.nama_user
    from tb_toko tt
    left join tb_user on tt.id_spv = tb_user.id
    where tt.id = '$id_toko'
    ")->row();
    //  lihat leader toko
    $data['leader_toko'] = $this->db->query("SELECT tt.*, tb_user.nama_user
    from tb_toko tt
    left join tb_user on tt.id_leader = tb_user.id
    where tt.id = '$id_toko'
    ")->row();
    //  lihat spg
    $data['spg'] = $this->db->query("SELECT tt.*,tb_user.nama_user 
    from tb_toko tt
    left join tb_user on tt.id_spg = tb_user.id
    where tt.id = '$id_toko'
    ")->row();
    //  cek status di stok masing" toko
    $data['cek_status_stok'] = $this->db->query("SELECT status from tb_stok where id_toko = '$id_toko' and status = 2 ")->num_rows();
    //  stok produk per toko
    $ssr = $this->db->query("SELECT ssr from tb_toko where id = '$id_toko'")->row()->ssr;
     $data['stok_produk'] = $this->db->query("
        SELECT tb_produk.*, tb_stok.qty, COALESCE(ROUND(AVG(penjualan_3_bulan.qty), 0), 0) * '$ssr' as ssr
        FROM tb_produk
        LEFT JOIN tb_stok ON tb_produk.id = tb_stok.id_produk AND tb_stok.id_toko = '$id_toko'
        LEFT JOIN (
            SELECT tb_penjualan_detail.id_produk, AVG(tb_penjualan_detail.qty) as qty
            FROM tb_penjualan_detail
            JOIN tb_penjualan ON tb_penjualan_detail.id_penjualan = tb_penjualan.id
            WHERE tb_penjualan.id_toko = '$id_toko'
                AND tb_penjualan.tanggal_penjualan >= DATE_SUB(NOW(), INTERVAL 3 MONTH)
            GROUP BY tb_penjualan_detail.id_produk
        ) as penjualan_3_bulan ON tb_produk.id = penjualan_3_bulan.id_produk
        WHERE tb_stok.id_toko = '$id_toko'
        GROUP BY tb_produk.id
    ")->result();
    //  list Produk
    $data['list_produk'] = $this->db->query("SELECT * from tb_produk where id not in (select id_produk from tb_stok where id_toko = '$id_toko') ")->result();

    $this->template->load('template/template', 'manager_mkt/toko/profil', $data);
  }
  //  approve toko
  public function approve($id_toko)
  {
    $catatan = $this->input->post('catatan');
    $this->db->query("UPDATE tb_toko set status = '3', catatan_mm = '$catatan_mm' where id = '$id_toko'");
    tampil_alert('success', 'Berhasil di Proses', 'Data Toko di teruskan dan di proses oleh Audit!');
    redirect(base_url('mng_mkt/Toko/profil/' . $id_toko));
  }
  //  reject toko
  public function reject($id_toko)
  {
    $catatan = $this->input->post('catatan');
    $this->db->query("UPDATE tb_toko set status = '0' , catatan_mm = '$catatan_mm' where id = '$id_toko'");
    tampil_alert('info', 'REJECT', 'Toko di Reject!');
    redirect(base_url('mng_mkt/Toko/'));
  }

  // tambah artikel
  public function tambah_artikel()
  {
    $this->form_validation->set_rules('id_toko', 'ID Toko', 'required');
    $this->form_validation->set_rules('id_produk', 'Id Produk', 'required');
    if ($this->form_validation->run() == TRUE) {
      $id_toko = $this->input->post('id_toko');
      $id_produk = $this->input->post('id_produk');
      $data = array(
        'id_produk' => $id_produk,
        'id_toko' => $id_toko,
        'status' => '1',
      );
      $cek = $this->db->query("SELECT * FROM tb_stok WHERE id_produk = '$id_produk' AND id_toko = '$id_toko'")->num_rows();
      if ($cek > 0) {
        tampil_alert('info', 'Information', 'Artikel sudah terdaftar di Toko ini!');
        redirect(base_url('mng_mkt/toko/profil/' . $id_toko));
      } else {
        $this->db->trans_start();
        $this->M_spv->insert('tb_stok', $data);
        $this->db->trans_complete();
        tampil_alert('success', 'Berhasil', 'Artikel Berhasil didaftarkan!');
        redirect(base_url('mng_mkt/toko/profil/' . $id_toko));
      }
    } else {
      tampil_alert('error', 'Gagal', 'Artikel Gagal didaftarkan!');
      redirect(base_url('mng_mkt/toko/profil/' . $id_toko));
    }
  }
  // download pdf
  public function unduh_pdf($id_toko)
  {
    // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
    $this->load->library('pdfgenerator');
    // title dari pdf
    $data['title_pdf'] = 'Berkas Toko';
    // filename dari pdf ketika didownload
    $file_pdf = 'Berkas_toko';
    // setting paper
    $paper = 'A4';
    //orientasi paper potrait / landscape 
    $orientation = "portrait";
    // menampilkan Data Toko
    $data['data_toko'] = $this->db->query("SELECT tt.*, tp.nama as provinsi,tk.nama as kabupaten,tc.nama as kecamatan, tt.provinsi as id_provinsi from tb_toko tt
         join wilayah_provinsi tp on tt.provinsi = tp.id
         join wilayah_kabupaten tk on tt.kabupaten = tk.id
         join wilayah_kecamatan tc on tt.kecamatan = tc.id
         where tt.id = '$id_toko'")->row();
    // nama Customer
    $data['customer'] = $this->db->query("SELECT tc.* from tb_customer tc
       join tb_toko on tc.id = tb_toko.id_customer
       where tb_toko.id = '$id_toko'")->row();
    // nama spv
    $data['spv'] = $this->db->query("SELECT tt.*, tb_user.nama_user
         from tb_toko tt
         left join tb_user on tt.id_spv = tb_user.id
         where tt.id = '$id_toko'
         ")->row();
    //  lihat leader toko
    $data['leader_toko'] = $this->db->query("SELECT tt.*, tb_user.nama_user
       from tb_toko tt
       left join tb_user on tt.id_leader = tb_user.id
       where tt.id = '$id_toko'
       ")->row();
    //  lihat spg
    $data['spg'] = $this->db->query("SELECT tt.*,tb_user.nama_user 
       from tb_toko tt
       left join tb_user on tt.id_spg = tb_user.id
       where tt.id = '$id_toko'
       ")->row();
    $html = $this->load->view('manager_mkt/toko/unduh', $data, true);
    // run dompdf
    $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
  }
}
?>
