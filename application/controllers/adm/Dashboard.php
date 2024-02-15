<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "1"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));

    }
    $this->load->model('M_adm_gudang');
  }

  public function index(){ 
    $data['title'] = 'Dashboard';
    $data['box'] = $this->box();
    // total permintaan
    $data['t_minta'] = $this->db->query("SELECT count(tp.id) as total FROM tb_permintaan tp
    join tb_toko tt on tp.id_toko = tt.id
    ")->row();
    // total Pengiriman
    $data['t_kirim'] = $this->db->query("SELECT count(tp.id) as total FROM tb_pengiriman tp
    join tb_toko tt on tp.id_toko = tt.id
    ")->row();
      // Total Penjualan
      $data['t_jual'] = $this->db->query("SELECT count(tp.id) as total FROM tb_penjualan tp
      join tb_toko tt on tp.id_toko = tt.id
      ")->row();
      // retur
      $data['t_retur'] = $this->db->query("SELECT count(tp.id) as total FROM tb_retur tp
      join tb_toko tt on tp.id_toko = tt.id
      ")->row();
      // 5 top toko
      $data['toko_aktif'] = $this->db->query("SELECT  tk.*,tu.nama_user, count(tp.id_toko) as total from tb_toko tk
      join tb_penjualan tp on tk.id = tp.id_toko
      left join tb_user_toko tut on tk.id = tut.id_toko
      left join tb_user tu on tut.id_user = tu.id
      GROUP BY tp.id_toko order by total DESC limit 5")->result();
    $this->template->load('template/template', 'adm/dashboard', $data);
  }

  // fungsi box
  public function box()
    {
        $box = [
            
            [
                'box'         => 'bg-info',
                'total'       => $this->db->query("SELECT count(id) as total from tb_toko where  status != 0")->row()->total,
                'title'       => 'Total Toko',
                'link'        => 'adm/Toko/',
                'icon'        => 'fas fa-store'
            ],
            [
                'box'         => 'bg-warning',
                'total'       =>  $this->db->query("SELECT count(id) as total from tb_produk where  status != 0")->row()->total,
                'title'       => 'Total Semua Artikel',
                'link'        => 'adm/Produk/',
                'icon'        => 'fas fa-cube'
            ],
            [
                'box'         => 'bg-info',
                'total'       =>  $this->db->query("SELECT count(id) as total from tb_user where  status != 0")->row()->total,
                'title'       => 'Total User',
                'link'        => 'adm/User/',
                'icon'        => 'fas fa-users'
            ],
            [
                'box'         => 'bg-success',
                'total'       => $this->db->query("SELECT count(id) as total from tb_promo where  status != 0")->row()->total,
                'title'       => 'Total Promo',
                'link'        => 'adm/Promo',
                'icon'        => 'fas fa-tag'
            ]
           
        ];
        $info_box = json_decode(json_encode($box), FALSE);
        return $info_box;
    }

 
}
?>
