<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
class Toko extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('status') != 'login' && $this->session->userdata('role') != 1) {
      redirect(base_url());
    }
  }

    public function index()
  {
    $data['title'] = 'Toko';
    $data['customer'] = $this->db->query("SELECT * FROM tb_customer WHERE deleted_at is NULL")->result();
    $data['provinsi'] = $this->db->query("SELECT * from wilayah_provinsi")->result();
    $data['toko'] = $this->db->query("SELECT tt.*, tu.nama_user
    from tb_toko tt
    left join tb_user tu on tt.id_spg = tu.id
    ORDER BY tt.status = 4 DESC, tt.status = 3 DESC,tt.status = 2 DESC, tt.id desc")->result();
    $this->template->load('template/template', 'adm/toko/lihat_data', $data);
  }
  // fitur tambah toko sementara
  public function tambahToko()
  {
    $nama_toko = $this->input->post('namaToko');
    $customer = $this->input->post('id_customer');
    $jenis_toko = $this->input->post('jenis_toko');
    $het = $this->input->post('het');
    $provinsi = $this->input->post('provinsi');
    $kabupaten = $this->input->post('kabupaten');
    $kecamatan = $this->input->post('kecamatan');
    $alamat = $this->input->post('alamat');

    $data = array(
      'jenis_toko' => $jenis_toko,
      'nama_toko' => $nama_toko,
      'id_customer' => $customer,
      'het' => $het,
      'provinsi' => $provinsi,
      'kabupaten' => $kabupaten,
      'kecamatan' => $kecamatan,
      'alamat' => $alamat,
      'status' => 1
    );
    $this->db->insert('tb_toko', $data);
    tampil_alert('success', 'Berhasil', 'Data Toko berhasil di tambahkan!');
    redirect(base_url('adm/Toko/'));
  }

  // list toko tutup
  public function toko_tutup()
  {
    $id_spv = $this->session->userdata('id');
    $data['title'] = 'List Toko Tutup';
    $data['toko_tutup'] = $this->db->query("SELECT tr.id as id_retur, tr.created_at, tr.status, tt.nama_toko from tb_retur tr
     join tb_toko tt on tr.id_toko = tt.id
     where tr.status >= 12 order by tr.id desc")->result();
    $this->template->load('template/template', 'adm/toko/toko_tutup', $data);
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
      'status'  => 13,
      'updated_at' => date("Y-m-d")
    );
    $where = array(
      'id'  => $no_retur
    );
    $dataToko = array(
      'status'  => 0
    );
    $whereToko = array(
      'id'  => $id_toko
    );
    $this->db->trans_start();
    $this->db->update('tb_retur', $data, $where);
    $this->db->update('tb_toko', $dataToko, $whereToko);
    $this->db->trans_complete();
    $get_toko = $this->db->query("SELECT nama_toko from tb_toko where id ='$id_toko'")->row()->nama_toko;
    $hp = $this->db->query("SELECT no_telp FROM tb_user WHERE role = 5")->row();
    $phone = $hp->no_telp;
    $message = "Anda memiliki pengajuan Retur untuk ( " . $get_toko . " ) segera proses & silahkan kunjungi s.id/absi-app";
    kirim_wa($phone, $message);
    tampil_alert('success', 'Berhasil', 'Data Pengajuan berhasil di Approve!');
    redirect(base_url('adm/Toko/toko_tutup'));
  }
  public function tolakToko($id)
  {

    $data = array(
      'status'  => 16,
      'updated_at' => date("Y-m-d")
    );
    $where = array(
      'id'  => $id
    );
    $this->db->update('tb_retur', $data, $where);
    tampil_alert('success', 'DITOLAK', 'Data Pengajuan di Tolak!');
    redirect(base_url('adm/Toko/toko_tutup'));
  }
  public function update($id)
  {
    $data['title'] = 'Kelola Toko';
    $query = $this->db->query("SELECT tb_toko.*, tb_user.nama_user as spg from tb_toko
    left join tb_user on tb_toko.id_spg = tb_user.id 
    where tb_toko.id = '$id'");
    $data['detail'] = $query->row();
    $id_prov = $query->row()->provinsi;
    $id_kab = $query->row()->kabupaten;
    $data['provinsi'] = $this->db->query("SELECT * from wilayah_provinsi")->result();
    $data['kabupaten'] = $this->db->query("SELECT * from wilayah_kabupaten where provinsi_id = '$id_prov'")->result();
    $data['kecamatan'] = $this->db->query("SELECT * from wilayah_kecamatan where kabupaten_id = '$id_kab'")->result();

    $data['supervisor'] = $this->db->query("SELECT * from tb_user where role ='2' and status ='1'")->result();
    $data['leader'] = $this->db->query("SELECT * from tb_user where role ='3' and status ='1'")->result();
    $data['spg'] = $this->db->query("SELECT * from tb_user where role ='4' and status ='1'")->result();
    $this->template->load('template/template', 'adm/toko/update', $data);
  }

  function add_ajax_kab($id_prov)
  {
    $this->db->select('id, nama'); // Pilih kolom yang ingin Anda sertakan dalam respons JSON
    $query = $this->db->get_where('wilayah_kabupaten', array('provinsi_id' => $id_prov));

    $kabupaten = $query->result(); // Ambil hasil query

    header('Content-Type: application/json'); // Tentukan tipe konten sebagai JSON
    echo json_encode($kabupaten); // Keluarkan data dalam format JSON
  }
  function add_ajax_kec($id_kab)
  {
    $this->db->select('id, nama'); // Pilih kolom yang ingin Anda sertakan dalam respons JSON
    $query = $this->db->get_where('wilayah_kecamatan', array('kabupaten_id' => $id_kab));

    $kecamatan = $query->result(); // Ambil hasil query

    header('Content-Type: application/json'); // Tentukan tipe konten sebagai JSON
    echo json_encode($kecamatan); // Keluarkan data dalam format JSON
  }

  public function proses_update()
  {
    $id_toko = $this->input->post('id_toko');
    $nama_toko = $this->input->post('nama_toko');
    $jenis_toko = $this->input->post('jenis_toko');
    $pic = $this->input->post('pic');
    $no_telp = $this->input->post('no_telp');
    $tgl_so = $this->input->post('tgl_so');
    $het = $this->input->post('het');
    $diskon = $this->input->post('diskon');
    $ssr = $this->input->post('ssr');
    $batas_po = $this->input->post('batas_po');
    $limit = $this->input->post('limit');
    $provinsi = $this->input->post('provinsi');
    $kabupaten = $this->input->post('kabupaten');
    $kecamatan = $this->input->post('kecamatan');
    $alamat = $this->input->post('alamat');

    $target = $this->input->post('target');
    $updated = date('Y-m-d H:i:s');

    $data = array(
      'jenis_toko' => $jenis_toko,
      'nama_toko' => $nama_toko,
      'nama_pic' => $pic,
      'telp' => $no_telp,
      'tgl_so' => $tgl_so,
      'het' => $het,
      'diskon' => $diskon,
      'ssr' => $ssr,
      'limit_toko' => $limit,
      'provinsi' => $provinsi,
      'kabupaten' => $kabupaten,
      'kecamatan' => $kecamatan,
      'alamat' => $alamat,
      'status_ssr' => $batas_po,
      'target' => $target,
      'updated_at' => $updated
    );
    $where = array(
      'id' => $id_toko
    );
    $this->db->update('tb_toko', $data, $where);
    tampil_alert('success', 'Berhasil', 'Data Toko berhasil di Perbaharui!');
    redirect(base_url('adm/Toko/update/' . $id_toko));
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

  public function profil($id_toko)
  {

    $id_spv = $this->session->userdata('id');
    $data['title']         = 'Toko';
    $data['toko']          = $this->db->query("SELECT tt.*, tp.nama as provinsi,tk.nama as kabupaten,tc.nama as kecamatan, tt.provinsi as id_provinsi from tb_toko tt
     join wilayah_provinsi tp on tt.provinsi = tp.id
     join wilayah_kabupaten tk on tt.kabupaten = tk.id
     join wilayah_kecamatan tc on tt.kecamatan = tc.id
     where tt.id = '$id_toko'")->row();
    //  lihat SPV toko
    $data['spv']   = $this->db->query("SELECT tt.*, tb_user.nama_user
   from tb_toko tt
   left join tb_user on tt.id_spv = tb_user.id
   where tt.id = '$id_toko'
   ")->row();
    //  lihat leader toko
    $data['leader_toko']   = $this->db->query("SELECT tt.*, tb_user.nama_user
   from tb_toko tt
   left join tb_user on tt.id_leader = tb_user.id
   where tt.id = '$id_toko'
   ")->row();
    //  lihat spg
    $data['spg']   = $this->db->query("SELECT tt.*,tb_user.nama_user 
   from tb_toko tt
   left join tb_user on tt.id_spg = tb_user.id
   where tt.id = '$id_toko'
   ")->row();
    //  cek status di stok masing" toko
    $data['cek_status_stok']  = $this->db->query("SELECT status from tb_stok where id_toko = '$id_toko' and status = 2 ")->num_rows();
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
    $data['list_produk'] = $this->db->query("SELECT * from tb_produk where id not in (select id_produk from tb_stok where id_toko = '$id_toko') ")->result();
    // cek status toko
    $data['cek_status'] = $this->db->query("SELECT status from tb_toko where id = '$id_toko'")->row();
    $this->template->load('template/template', 'adm/toko/profil', $data);
  }

  public function tambah_produk()
  {
    $id_produk = $this->input->post('id_produk');
    $id_toko = $this->input->post('id_toko');
    $data = array(
      'id_produk' => $id_produk,
      'id_toko' => $id_toko,
      'status' => '1',
      'updated_at' => date('Y-m-d H:i:s')
    );

    $this->db->insert('tb_stok', $data);
    tampil_alert('success', 'Berhasil', 'Artikel berhasil di tambahkan.');
    redirect(base_url('adm/toko/profil/' . $id_toko));
  }
  //  approve toko
  public function approve($id_toko)
  {
    $this->db->query("UPDATE tb_toko set status = '1' where id = '$id_toko'");
    tampil_alert('success', 'Berhasil', 'Toko Berhasil di Approve !');
    redirect(base_url('adm/Toko/profil/' . $id_toko));
  }
  //  reject toko
  public function reject($id_toko)
  {
    $this->db->query("UPDATE tb_toko set status = '0' where id = '$id_toko'");
    tampil_alert('info', 'REJECT', 'Toko di Reject!');
    redirect(base_url('adm/Toko/profil/' . $id_toko));
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
    $data['customer']   = $this->db->query("SELECT tc.* from tb_customer tc
       join tb_toko on tc.id = tb_toko.id_customer
       where tb_toko.id = '$id_toko'")->row();
    // nama spv
    $data['spv']   = $this->db->query("SELECT tt.*, tb_user.nama_user
        from tb_toko tt
        left join tb_user on tt.id_spv = tb_user.id
        where tt.id = '$id_toko'
        ")->row();
    //  lihat leader toko
    $data['leader_toko']   = $this->db->query("SELECT tt.*, tb_user.nama_user
      from tb_toko tt
      left join tb_user on tt.id_leader = tb_user.id
      where tt.id = '$id_toko'
      ")->row();
    //  lihat spg
    $data['spg']   = $this->db->query("SELECT tt.*,tb_user.nama_user 
      from tb_toko tt
      left join tb_user on tt.id_spg = tb_user.id
      where tt.id = '$id_toko'
      ")->row();
    $html = $this->load->view('adm/toko/unduh', $data, true);
    // run dompdf
    $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
  }
   // export file template stok
  public function templateStok($id_toko)
  {
    $query = $this->db->query("SELECT tp.kode, ts.qty,ts.id_toko,tt.nama_toko from tb_stok ts
    join tb_produk tp on ts.id_produk = tp.id
    join tb_toko tt on ts.id_toko = tt.id
    WHERE ts.id_toko = '$id_toko'");
    if ($query->num_rows() > 0) {
      $toko = $query->row();
      $detail = $query->result();
      // Create a new Spreadsheet instance
      $spreadsheet = new Spreadsheet();
      $worksheet = $spreadsheet->getActiveSheet();
      $worksheet->setTitle($toko->nama_toko);
      $worksheet->getStyle('A1:E1')->getFont()->setBold(true);
      $worksheet->getStyle('A1:E1')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('FFFF00'); // Kode warna kuning (FFFF00)
      $worksheet->setCellValue('A1', 'NO URUT');
      $worksheet->setCellValue('B1', 'ID TOKO (jangan di rubah)');
      $worksheet->setCellValue('C1', 'KODE ARTIKEL');
      $worksheet->setCellValue('D1', 'STOK SISTEM');
      $worksheet->setCellValue('E1', 'STOK TERBARU (kolom ini yang harus di isi)');

      $row = 2; // Start from the second row
      $no = 1; // Nomor urut
      foreach ($detail as $data) {
        // Set values for each row
        $worksheet->setCellValue('A' . $row, $no);
        $worksheet->setCellValue('B' . $row, $data->id_toko);
        $worksheet->setCellValue('C' . $row, $data->kode);
        $worksheet->setCellValue('D' . $row, $data->qty);
        $row++;
        $no++;
      }
      // Create Excel writer
      $writer = new Xlsx($spreadsheet);
      // Set headers for file download
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="' . $toko->nama_toko . '.xlsx"');
      // Save Excel file to PHP output stream
      ob_end_clean();
      $writer->save('php://output');
      exit();
    } else {
      $cek = $this->db->query("SELECT * from tb_toko where id='$id_toko'");
      $dataToko = $cek->row();
      // Create a new Spreadsheet instance
      $spreadsheet = new Spreadsheet();
      $worksheet = $spreadsheet->getActiveSheet();
      $worksheet->setTitle($dataToko->nama_toko);
      $worksheet->getStyle('A1:E1')->getFont()->setBold(true);
      $worksheet->getStyle('A1:E1')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('FFFF00'); // Kode warna kuning (FFFF00)
      $worksheet->setCellValue('A1', 'NO URUT');
      $worksheet->setCellValue('B1', 'ID TOKO (Jangan di Ganti)');
      $worksheet->setCellValue('C1', 'KODE ARTIKEL');
      $worksheet->setCellValue('D1', 'STOK SISTEM');
      $worksheet->setCellValue('E1', 'STOK TERBARU (kolom ini yang harus di isi)');
      $worksheet->setCellValue('A2', '1');
      $worksheet->setCellValue('B2', $dataToko->id);
      $worksheet->setCellValue('C2', 'kode artikel disini');
      $worksheet->setCellValue('D2', '0');
      $worksheet->setCellValue('E2', '0');
      // Create Excel writer
      $writer = new Xlsx($spreadsheet);
      // Set headers for file download
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="' . $dataToko->nama_toko . '.xlsx"');
      // Save Excel file to PHP output stream
      ob_end_clean();
      $writer->save('php://output');
      exit();
    }
  }
  // import Stok
  public function importStok()
  {
    $this->load->library('user_agent');
    $file = $_FILES['file']['tmp_name'];
    $reader = IOFactory::createReader('Xlsx');
    $spreadsheet = $reader->load($file);
    $worksheet = $spreadsheet->getActiveSheet();
    $rows = $worksheet->toArray();
    $redirect_url = $this->agent->referrer();

    $import_status = []; // Array to store import status for each code

    for ($i = 1; $i < count($rows); $i++) {
      $row = $rows[$i];
      $id_toko = intval($row[1]);
      $kode = trim($row[2]);
      $stok = intval($row[4]);

      $idproduk = null;
      $cariId = $this->db->get_where('tb_produk', array('kode' => $kode));

      if ($cariId->num_rows() > 0) {
        $idproduk = $cariId->row()->id;
      }

      date_default_timezone_set('Asia/Jakarta');
      $tanggal_sekarang = date("Y-m-d H:i:s");

      if ($idproduk !== null) {
        $query = $this->db->get_where('tb_stok', array('id_produk' => $idproduk, 'id_toko' => $id_toko));
        $existing_stok = $query->row();

        if ($existing_stok) {
          $data_update = array(
            'qty' => $stok,
            'qty_awal' => $stok,
            'updated_at' => $tanggal_sekarang,
          );
          $where = array(
            'id_produk' => $idproduk,
            'id_toko' => $id_toko,
          );
          $this->db->update('tb_stok', $data_update, $where);
          $import_status[$kode] = '<text style="color:green;">BERHASIL DIUPDATE</text>';
        } else {
          $data_insert = array(
            'qty' => $stok,
            'qty_awal' => $stok,
            'updated_at' => $tanggal_sekarang,
            'id_produk' => $idproduk,
            'id_toko' => $id_toko,
          );
          $this->db->insert('tb_stok', $data_insert);
          $import_status[$kode] = '<text style="color:green;">BERHASIL DITAMBAHKAN</text>';
        }
      } else {
        $import_status[$kode] = '<text style="color:red;">KODE BELUM TERDAFTAR.</text>';
      }
    }

    // Store the import status in a session variable
    $this->session->set_userdata('import_status', $import_status);
    tampil_alert('success', 'Berhasil', 'DATA BERHASIL DI IMPORT.');
    // Redirect back to the product list
    redirect(base_url('adm/Toko/displayImportStatus/' . $id_toko));
  }
  public function displayImportStatus($id_toko)
  {
    $data['title']         = 'Toko';
    $data['import_status'] = $this->session->userdata('import_status');
    $data['toko'] = $this->db->query("SELECT * from tb_toko where id = '$id_toko'")->row();
    $this->template->load('template/template', 'adm/toko/status_import', $data);
  }
}
