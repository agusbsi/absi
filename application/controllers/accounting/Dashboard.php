<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if ($role != "15") {
      tampil_alert('error', 'DI TOLAK !', 'Silahkan login kembali');
      redirect(base_url(''));
    }
    $this->load->model('M_adm_gudang');
  }
  public function index()
  {
    $data['title'] = 'Dashboard';
    $data['box'] = $this->box();
    // Dapatkan bulan dan tahun saat ini
    $currentMonth = date('m');
    $currentYear = date('Y');
    // Query SQL untuk mengambil total permintaan dan pengiriman
    $query = "SELECT 
    (SELECT COUNT(id) FROM tb_permintaan WHERE MONTH(created_at) = $currentMonth AND YEAR(created_at) = $currentYear) AS t_minta,
    (SELECT COUNT(id) FROM tb_pengiriman WHERE MONTH(created_at) = $currentMonth AND YEAR(created_at) = $currentYear) AS t_kirim,
    (SELECT COUNT(id) FROM tb_retur WHERE MONTH(created_at) = $currentMonth AND YEAR(created_at) = $currentYear) AS t_retur,
    (SELECT COUNT(id) FROM tb_penjualan WHERE MONTH(tanggal_penjualan) = $currentMonth AND YEAR(created_at) = $currentYear) AS t_jual";
    // Jalankan query SQL
    $result = $this->db->query($query)->row();
    // Simpan hasil dalam variabel data
    $data['t_minta'] = $result->t_minta;
    $data['t_kirim'] = $result->t_kirim;
    $data['t_retur'] = $result->t_retur;
    $data['t_jual'] = $result->t_jual;
    // 5 top toko
    $data['toko_aktif'] = $this->db->query("SELECT tk.*, tu.nama_user, COUNT(tp.id_toko) as total 
    FROM tb_toko tk
    JOIN tb_penjualan tp ON tk.id = tp.id_toko
    LEFT JOIN tb_user_toko tut ON tk.id = tut.id_toko
    LEFT JOIN tb_user tu ON tut.id_user = tu.id
    WHERE MONTH(tp.tanggal_penjualan) = $currentMonth AND YEAR(tp.tanggal_penjualan) = $currentYear
    GROUP BY tk.id, tu.nama_user
    ORDER BY total DESC
    LIMIT 5")->result();

    $this->template->load('template/template', 'accounting/dashboard', $data);
  }
  // fungsi box
  public function box()
  {
    $box = [

      [
        'box'         => 'bg-info',
        'total'       => $this->db->query("SELECT count(id) as total from tb_toko where  status = 1")->row()->total,
        'title'       => 'Toko Aktif',
        'link'        => 'mng_ops/Dashboard/toko/',
        'icon'        => 'fas fa-store'
      ],
      [
        'box'         => 'bg-warning',
        'total'       =>  $this->db->query("SELECT count(id) as total from tb_produk where  status = 1")->row()->total,
        'title'       => 'Jenis Artikel',
        'link'        => 'adm/Produk/',
        'icon'        => 'fas fa-cube'
      ],
      [
        'box'         => 'bg-info',
        'total'       =>  $this->db->query("SELECT count(id) as total from tb_user where role = 3 and  status = 1")->row()->total,
        'title'       => 'Total Leader',
        'link'        => 'mng_ops/Dashboard/user',
        'icon'        => 'fas fa-users'
      ],
      [
        'box'         => 'bg-success',
        'total'       =>  $this->db->query("SELECT count(id) as total from tb_user where role = 4 and  status = 1")->row()->total,
        'title'       => 'Total SPG',
        'link'        => 'mng_ops/Dashboard/user',
        'icon'        => 'fas fa-users'
      ]

    ];
    $info_box = json_decode(json_encode($box), FALSE);
    return $info_box;
  }
}
