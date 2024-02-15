<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promo extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "9"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_admin');
    $this->load->model('M_support');
    $this->load->model('M_marketing');
  }

  public function index()
  {
    $id_grup = $this->input->get('id_grup');
    $data['title'] = 'Management Promo';
    $data['list_grup'] = $this->db->query("SELECT * FROM tb_grup ORDER BY nama_grup ASC ")->result();
    $data['list_toko'] = $this->db->query("SELECT * FROM tb_toko ORDER BY nama_toko ASC")->result();
    $data['list_data'] = $this->db->query("SELECT * FROM tb_promo ORDER BY id DESC")->result();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->template->load('template/template', 'manager_mkt/promo/index', $data);
  }

  public function tambah_promo_reguler()
  {
   $data['title'] = 'Management Promo';
   $data['kode_promo'] = $this->M_support->kode_promo();
   $data['list_toko'] = $this->db->query("SELECT * FROM tb_toko ORDER BY nama_toko")->result();
   $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->template->load('template/template', 'manager_mkt/promo/tambah_promo_reguler', $data); 
  }

  function list_produk($id_toko)
  {
      $query = $this->db->query("SELECT ts.*, tp.kode, tp.id as id_p from tb_stok ts
      join tb_produk tp on ts.id_produk = tp.id
      where ts.id_toko = '$id_toko'");
      foreach ($query->result() as $value) {
          $data .= "<option value='".$value->id_p."'>".$value->kode."</option>";
      }
      echo $data;
  }


  public function proses_reguler()
  {
    $id_produk = $this->input->post('id_artikel');
    $id_toko = $this->input->post('id_toko');
    $type_promo = $this->input->post('type_promo');
    $type_diskon = $this->input->post('type_diskon');
    $kode_promo = $this->input->post('id_promo');
    $judul = $this->input->post('judul_promo');
    $diskon_hicoop = $this->input->post('diskon_hicoop');
    $diskon_toko = $this->input->post('diskon_toko');
    $tgl_mulai = $this->input->post('tgl_mulai');
    $tgl_selesai = $this->input->post('tgl_selesai');
    $promo = [
      'id' => $kode_promo,
      'id_toko' => $id_toko,
      'id_produk' => $id_produk,
      'type_promo' => $type_promo,
      'judul' => $judul,
      'type_diskon' => $type_diskon,
      'partisipasi_hicoop' => $diskon_hicoop,
      'partisipasi_toko' => $diskon_toko,
      'tgl_mulai' => $tgl_mulai,
      'tgl_selesai' => $tgl_selesai,
      'status' => '0',
    ];
    $this->db->insert('tb_promo',$promo);
    tampil_alert('success','Berhasil','Promo Berhasil Diajukan!Menuggu Approve Direksi!');
    redirect(base_url('mng_mkt/promo'));
  }
  
  public function tambah_promo_nasional()
  {
   $data['title'] = 'Management Promo';
   $data['kode_promo'] = $this->M_support->kode_promo();
   $data['list_grup'] = $this->db->query("SELECT * FROM tb_customer ORDER BY nama_cust ASC")->result();
   $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->template->load('template/template', 'manager_mkt/promo/tambah_promo_nasional', $data); 
  }
  function list_cabang()
  {
    $id_grup = $this->input->post('id_grup');
    $data['cabang'] = $this->db->query("SELECT id FROM tb_toko WHERE id_customer = '$id_grup'")->result_array();
    echo json_encode($data['cabang']); 
  }
  public function list_produk_cabang()
  {
    $id_cabang = $this->input->get('id_cabang');
    $id_cabang_arr = explode(',', $id_cabang);
    $id_cabang_str = implode("','", $id_cabang_arr);

    $query = $this->db->query("SELECT tb_stok.*, tb_produk.kode, tb_produk.id as id_produk FROM tb_stok JOIN tb_produk ON tb_stok.id_produk = tb_produk.id WHERE tb_stok.id_toko IN ('$id_cabang_str') GROUP BY tb_produk.kode");
    $data = array();

    foreach ($query->result() as $value) {
        $data[] = array(
            'id_produk' => $value->id_produk,
            'kode' => $value->kode
        );
    }

    echo json_encode($data);
}
  public function proses_nasional()
  {
    $id_promo = $this->input->post('id_promo');
    $id_toko = $this->input->post('id_cabang');
    $judul = $this->input->post('judul_promo');
    $type_promo = $this->input->post('type_promo');
    $type_diskon = $this->input->post('type_diskon');
    $diskon_hicoop = $this->input->post('diskon_hicoop');
    $diskon_toko = $this->input->post('diskon_toko');
    $tgl_mulai = $this->input->post('tgl_mulai');
    $tgl_selesai = $this->input->post('tgl_selesai');
    $id_produk = $this->input->post('id_artikel');
    if ($type_diskon == "Single Margin") {
      $promo = [
      'id' => $id_promo,
      'id_toko' => $id_toko,
      'id_produk' => $id_produk,
      'type_promo' => $type_promo,
      'judul' => $judul,
      'type_diskon' => $type_diskon,
      'partisipasi_hicoop' => $diskon_hicoop,
      'partisipasi_toko' => '0',
      'tgl_mulai' => $tgl_mulai,
      'tgl_selesai' => $tgl_selesai,
      'status' => '0',
    ];
    $this->db->insert('tb_promo',$promo);
    tampil_alert('success','Berhasil','Promo Berhasil Diajukan! Menunggu Approve Direksi!');
    redirect(base_url('mng_mkt/promo'));
    }else if ($type_diskon == "Margin Bertingkat") {
     $promo = [
      'id' => $id_promo,
      'id_toko' => $id_toko,
      'id_produk' => $id_produk,
      'type_promo' => $type_promo,
      'judul' => $judul,
      'type_diskon' => $type_diskon,
      'partisipasi_hicoop' => $diskon_hicoop,
      'partisipasi_toko' => $diskon_toko,
      'tgl_mulai' => $tgl_mulai,
      'tgl_selesai' => $tgl_selesai,
      'status' => '0',
    ];
    $this->db->insert('tb_promo',$promo);
    tampil_alert('success','Berhasil','Promo Berhasil Diajukan! Menunggu Approve Direksi!');
    redirect(base_url('mng_mkt/promo'));
    }
  }
  public function detail($id_promo)
{
    $data['title'] = 'Management Promo';
    $data['promo'] = $this->db->query("SELECT * FROM tb_promo WHERE id = '$id_promo'")->row();
    $id_toko = $data['promo']->id_toko;
    $id_toko_string = explode(",", $id_toko);
    $nama_toko = "";
    
    foreach ($id_toko_string as $ids) {
        $query = $this->db->query("SELECT * FROM tb_toko WHERE id = '$ids'")->row();
        $nama_toko .= $query->nama_toko.',';
    }
    
    $id_produk = $data['promo']->id_produk;
    $id_produk_string = explode(",", $id_produk);
    $nama_produk = array();
    $kode_produk = array();
    
    if ($id_produk == "") {
        $id_toko_arr = explode(',', $id_toko);
        $id_toko_str = implode("','", $id_toko_arr);
        $query = $this->db->query("SELECT tb_stok.*, tb_produk.kode, tb_produk.id as id_produk, tb_produk.kode, tb_produk.nama_produk FROM tb_stok JOIN tb_produk ON tb_stok.id_produk = tb_produk.id WHERE tb_stok.id_toko IN ('$id_toko_str') GROUP BY tb_produk.kode")->result();
      foreach ($query as $row) {
        $nama_produk[] = $row->nama_produk;
        $kode_produk[] = $row->kode;
      }
    } else {
        foreach ($id_produk_string as $ips) {
            $query = $this->db->query("SELECT * FROM tb_produk WHERE id = '$ips'")->row();
            $nama_produk[] = $query->nama_produk;
            $kode_produk[] = $query->kode;
        }  
    } 
    $data['nama_produk'] = $nama_produk;
    $data['kode_produk'] = $kode_produk;
    $data['nama_toko'] = rtrim($nama_toko, ',');
    $this->template->load('template/template', 'manager_mkt/promo/detail', $data);
  }
}
?>
