<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "9"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
 
    $this->load->model('M_spg');
  }

  public function index(){
   
        $id_spv = $this->session->userdata('id');
        $id_toko = $this->session->userdata('id_toko');
        $data['title'] = 'Dashboard';
        // Total toko
        $data['t_toko'] = $this->db->query("SELECT count(id) as total from tb_toko where  status != 0")->row();
        // user SPV
        $data['t_user_spv'] = $this->db->query("SELECT count(id) as total from tb_user 
        where deleted_at is null and role = '2'")->row();
        // user leader
        $data['t_user_leader'] = $this->db->query("SELECT count(id) as total from tb_user 
        where deleted_at is null and role = '3'")->row();
        // user leader
        $data['t_user_spg'] = $this->db->query("SELECT count(id) as total from tb_user 
        where deleted_at is null and role = '4'")->row();
        // total permintaan
        $data['t_minta'] = $this->db->query("SELECT count(tp.id) as total FROM tb_permintaan tp
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
        $data['list_jual'] = $this->db->query("SELECT tp.*, tk.nama_toko from tb_penjualan tp
        JOIN tb_toko tk on tp.id_toko = tk.id
        order by tp.id desc limit 5")->result();
        // 5 top toko
        $data['toko_aktif'] = $this->db->query("SELECT  tk.*,tu.nama_user, count(tp.id_toko) as total from tb_toko tk
        join tb_penjualan tp on tk.id = tp.id_toko
        left join tb_user_toko tut on tk.id = tut.id_toko
        left join tb_user tu on tut.id_user = tu.id
        GROUP BY tp.id_toko order by total DESC limit 5")->result();
        // list artikel terbaru dr spv
        $data['artikel_new'] = $this->db->query("SELECT ts.*, tp.nama_produk,tp.kode,tt.het,tt.nama_toko,tt.id as id_toko from tb_stok ts
        join tb_produk tp on ts.id_produk = tp.id
        JOIN tb_toko tt on ts.id_toko = tt.id
        where ts.status ='2'
        order by ts.id desc limit 5")->result();
        $this->template->load('template/template', 'manager_mkt/dashboard', $data);
    
  }



}
?>
