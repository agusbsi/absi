<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
class Stokgudang extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "3"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_admin');
    $this->load->model('M_support');
  }
  public function index()
  {

    $data['title'] = 'Stokgudang';
    $data['list_data'] = $this->db->query("SELECT ts.*, tp.satuan FROM tb_stokgudang ts
    left join tb_produk tp on ts.kode = tp.kode
    where ts.kode != ''
    order by ts.kode asc")->result();
    $this->template->load('template/template', 'leader/stokgudang/index', $data);
  }
  
}
?>