<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  function __construct()
  {
    parent::__construct();

    $role = $this->session->userdata('role');
    if($role != "5" and $role != "16"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));

    }
    $this->load->model('M_adm_gudang');
  }
//   halaman utama
  public function index()
  {
   
        $data['title'] = 'Dashboard';
        $data['box'] = $this->box();
        $data['stok'] = $this->M_adm_gudang->select('tb_stok');
        $data['terbaru'] = $this->db->query("SELECT tk.nama_toko, tp.* from tb_permintaan tp join tb_toko tk on tp.id_toko = tk.id where tp.status ='2' order by tp.id desc limit 3 ")->result();
        $this->template->load('template/template', 'adm_gudang/dashboard', $data);
   
  }
// identifikasi box
  public function box()
    {
        $box = [
           
            [
                'box'         => 'bg-danger',
                'total'       => $this->M_adm_gudang->stok_permintaan()->total,
                'title'       => 'Data Permintaan',
                'link'        => 'adm_gudang/permintaan/',
                'icon'        => 'fas fa-file-alt'
            ],
            [
              'box'         => 'bg-success',
              'total'       =>  $this->M_adm_gudang->stok_pengiriman()->total,
              'title'       => 'Data Pengiriman',
              'link'        => 'adm_gudang/Pengiriman/',
              'icon'        => 'fas fa-truck'
          ],
            [
                'box'         => 'bg-warning',
                'total'       =>  $this->db->query("SELECT count(id) as total from tb_retur where status = '3' or status = '6'")->row()->total,
                'title'       => 'Data Retur',
                'link'        => 'adm_gudang/Retur/',
                'icon'        => 'fas fa-clock'
            ],
         
            [
              'box'         => 'bg-info',
              'total'       => $this->M_adm_gudang->produk_dikirim()->total,
              'title'       => 'Total Produk yang di kirim',
              'link'        => 'adm_gudang/Pengiriman/',
              'icon'        => 'fas fa-box'
          ],
           
        ];
        $info_box = json_decode(json_encode($box), FALSE);
        return $info_box;
    }

}
?>
