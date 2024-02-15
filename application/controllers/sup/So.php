<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class So extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != 6 && $role != 1 && $role != 2 && $role != 9 && $role != 10 && $role != 14 && $role != 11 && $role != 8 && $role != 15){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_admin');
    $this->load->model('M_support');
  }
  public function index()
  {
    $data['title'] = 'Management Stock Opname';
    $data['t_toko'] = $this->db->query("SELECT * from tb_toko where status = '1'")->num_rows();
    $data['t_so'] = $this->db->query("SELECT * from tb_toko where status_so = '1' and status = '1'")->num_rows();
    $data['t_bso'] = $this->db->query("SELECT * from tb_toko where status_so = '0' and status = '1'")->num_rows();
    
    $this->template->load('template/template', 'manager_mv/stokopname/index', $data);
  }

   // menu list so toko bulan ini
  public function list_so()
  {
    $data['title'] = 'Management Stock Opname';
    $thisMonth = date('Y-m', strtotime('this month'));
    $data['list_data'] = $this->db->query("SELECT tt.*, tb_user.nama_user,
    Max(ts.id) as id_so, Max(ts.created_at) as date_so FROM tb_toko tt
    left join tb_so ts on tt.id = ts.id_toko
    left JOIN tb_user ON tt.id_spg = tb_user.id 
    WHERE tt.status = '1' group by tt.id order by tt.id asc")->result();
    $data['list_spv'] = $this->db->query("SELECT * FROM tb_user WHERE role = 2")->result();
    $data['id_toko'] = $this->M_support->kode_toko();
    $this->template->load('template/template', 'manager_mv/stokopname/list_so', $data);

  }

  // riwayat so
  public function riwayat_so()
  {
    $data['title'] = 'Management Stock Opname';
    $lastMonth = date('Y-m-d', strtotime('first day of last month'));
    $thisMonth = date('Y-m-d', strtotime('first day of this month'));
    $data['list_so'] = $this->db->query(" SELECT *, DATE_FORMAT(created_at, '%M %Y') AS period from tb_so
    WHERE created_at < '$thisMonth'
    group by YEAR(created_at), MONTH(created_at)
    ORDER BY created_at ASC")->result();
    $this->template->load('template/template', 'manager_mv/stokopname/riwayat_so', $data);
  }
   // menampilkan list detail json
   function list_toko()
   {
       $bulan = $_POST['no_so'];
       $tahun = $_POST['tahun'];
       $data = $this->db->query("SELECT ts.*, ts.created_at as tgl_so, tt.nama_toko from tb_so ts
       join tb_toko tt on ts.id_toko = tt.id where MONTH(ts.created_at) = '$bulan' and YEAR(ts.created_at) = '$tahun'")->result();
       echo json_encode($data);
   }
  
  public function riwayat_so_toko($id_toko, $id_so)
  {
    $data['title'] = 'Management Stock Opname';
    $data['SO']  = $this->db->query("SELECT ts.*, tt.nama_toko from tb_so ts 
    join tb_toko tt on ts.id_toko = tt.id
    where ts.id_toko = '$id_toko' and ts.id = '$id_so'")->row();
    $data['detail_so'] = $this->db->query("SELECT ts.*,
   tsd.qty_awal, tsd.total_terima, tsd.total_retur, tsd.total_jual, tsd.total_mutasi, tsd.qty_akhir, tsd.hasil_so,
   CASE
       WHEN tsd.qty_akhir < 0 THEN 0
       ELSE tsd.hasil_so - tsd.qty_akhir
   END AS selisih,
   tp.kode from tb_so ts
   join tb_so_detail tsd on ts.id = tsd.id_so
   join tb_produk tp on tsd.id_produk = tp.id
   where ts.id_toko = '$id_toko' and ts.id = '$id_so' order by tp.kode asc")->result();

    $this->template->load('template/template', 'manager_mv/stokopname/detail_so_toko', $data);
  }

  // download pdf
  public function pdf($toko)
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');
        // title dari pdf
        $data['title_pdf'] = 'List Artikel Stok Opname';
        // filename dari pdf ketika didownload
        $file_pdf = 'List_Artikel_Stok_Opname';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape 
        $orientation = "portrait";
        // menampilkan Data Toko
        $data['data_toko']  = $this->db->query("SELECT tb_toko.*, tb_user.nama_user from tb_toko 
        join tb_user on tb_toko.id_spg = tb_user.id
        where tb_toko.id ='$toko'")->row();
        // menampilkan Data Stok di toko
        $data['stok'] = $this->db->query("SELECT ts.*, tp.nama_produk, tp.kode, tp.satuan from tb_stok ts
        join tb_produk tp on ts.id_produk = tp.id
        where ts.id_toko = '$toko' and ts.qty != '0'")->result();
		    $html = $this->load->view('manager_mv/stokopname/print_so',$data, true);	 
        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
    }

         // download pdf
  public function hasil_so($toko)
  {

    // so terbaru
      $id_so = $this->db->query("SELECT id from tb_so where id_toko = '$toko' order by id desc limit 1")->row();
      // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
      $this->load->library('pdfgenerator');
      // title dari pdf
      $data['title_pdf'] = 'Hasil Stok Opname';
      // filename dari pdf ketika didownload
      $file_pdf = 'Hasil_Stok_Opname';
      // setting paper
      $paper = 'A4';
      //orientasi paper potrait / landscape 
      $orientation = "portrait";
      // menampilkan Data Toko
      $data['data_toko']  = $this->db->query("SELECT tb_toko.*, tb_user.nama_user from tb_toko 
      join tb_user on tb_toko.id_spg = tb_user.id
      where tb_toko.id ='$toko'")->row();
      // menampilkan Hasil SO terbaru
      $data['hasil_so'] = $this->db->query("SELECT tsd.*, tp.kode, tp.nama_produk, tp.satuan, tsd.hasil_so - tsd.qty_akhir as selisih from tb_so_detail tsd
      join tb_so ts on tsd.id_so = ts.id
      join tb_produk tp on tsd.id_produk = tp.id
      where ts.id_toko = '$toko' and tsd.id_so = '$id_so->id'")->result();
      $data['so_terbaru'] = $this->db->query("SELECT * from tb_so where id_toko = '$toko' order by id desc limit 1")->row();
      $html = $this->load->view('manager_mv/stokopname/print_hasil_so',$data, true);	 
      // run dompdf
      $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
  }
//   update untuk edit
  // proses so untuk adjust stok
  public function detail($toko)
  {
    $data['title'] = 'Management Stock Opname';
    $data['so'] = $this->db->query("SELECT so.*, tt.nama_toko, tt.alamat, tt.telp, tu.nama_user from tb_so so
    join tb_toko tt on so.id_toko = tt.id
    join tb_user tu on so.id_user = tu.id
    where so.id_toko='$toko' order by so.id desc limit 1")->row();
    $id_so = $data['so']->id;
    $data['list_data'] = $this->db->query("SELECT ts.*,tp.kode,tp.satuan, tp.nama_produk,
    CASE
       WHEN ts.qty_akhir < 0 THEN 0
       ELSE ts.hasil_so - ts.qty_akhir
   END AS selisih from tb_so_detail ts
    join tb_produk tp on ts.id_produk = tp.id
    where ts.id_so = '$id_so'")->result();
    $this->template->load('template/template', 'manager_mv/stokopname/detail', $data);
  }
  public function update_so()
  {
    $this->load->library('user_agent');
    $id_detail = $this->input->post('id_detail');
    $qty_edit = $this->input->post('qty_edit');
    $jml = count($id_detail);

    for ($i = 0; $i < $jml; $i++) {
      $detail = array(
        'hasil_so' => $qty_edit[$i]
      );
      $where = array(
        'id' => $id_detail[$i]
      );
      $this->db->update('tb_so_detail', $detail, $where);
    }
    tampil_alert('success', 'BERHASIL', 'Data Stok Opname Berhasil di update');
    $referer = $this->agent->referrer();
    if (!empty($referer)) {
      redirect($referer);
    } else {
      redirect(base_url('sup/So'));
    }
  }
   // fitur semua so artikel dari andrew
  public function download_so()
  {
    $periode = $this->input->post('periode');
    $thisMonth = date_format(date_create($periode), 'Y-m');
    $query = $this->db->query("SELECT tp.kode, tp.nama_produk, COALESCE(SUM(tsd.hasil_so), 0) AS total_stok
    FROM tb_produk tp
    LEFT JOIN tb_so_detail tsd ON tp.id = tsd.id_produk
    JOIN tb_so ts ON tsd.id_so = ts.id AND DATE_FORMAT(ts.created_at, '%Y-%m') = '$thisMonth'
    GROUP BY tp.id, tp.nama_produk");
    if ($query->num_rows() > 0) {
      $detail = $query->result();
      $spreadsheet = new Spreadsheet();
      $worksheet = $spreadsheet->getActiveSheet();
      $bulan = date_create($periode)->format('F Y');
      $worksheet->setTitle($bulan);
      $worksheet->getStyle('A1:D1')->getFont()->setBold(true);
      $worksheet->getStyle('A1:D1')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()
        ->setARGB('FFFF00'); // Kode warna kuning (FFFF00)
      $worksheet->setCellValue('A1', 'NO');
      $worksheet->setCellValue('B1', 'KODE');
      $worksheet->setCellValue('C1', 'ARTIKEL');
      $worksheet->setCellValue('D1', 'TOTAL STOK');

      $row = 2; // Start from the second row
      $no = 1; // Nomor urut
      foreach ($detail as $data) {
        // Set values for each row
        $worksheet->setCellValue('A' . $row, $no);
        $worksheet->setCellValue('B' . $row, $data->kode);
        $worksheet->setCellValue('C' . $row, $data->nama_produk);
        $worksheet->setCellValue('D' . $row, $data->total_stok);
        $row++;
        $no++;
      }
      // Create Excel writer
      ob_end_clean();
      $writer = new Xlsx($spreadsheet);
      // Set headers for file download
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="' . strtolower(str_replace(' ', '_', $bulan)) . '.xlsx"');
      // Save Excel file to PHP output stream
      $writer->save('php://output');
       exit();
    } else {
      tampil_alert('error', 'BELUM TERSEDIA', 'Data Update aset toko belum tersedia');
      redirect($_SERVER['HTTP_REFERER']);
    }
  }

}
?>