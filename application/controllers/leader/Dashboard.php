<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "3"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_spg');
  }

  public function index(){
   
        $id_leader = $this->session->userdata('id');
        $id_toko = $this->session->userdata('id_toko');
        $data['title'] = 'Dashboard';
        $data['t_toko'] = $this->db->query("SELECT count(id) as total from tb_toko where id_leader = '$id_leader' and status != 0")->row();
        $data['t_user'] = $this->db->query("SELECT count(tb_user.id) from tb_user 
        JOIN tb_toko ON tb_user.id = tb_toko.id_spg
        where tb_user.deleted_at is null and tb_user.role = '4' and tb_toko.id_leader = '$id_leader' group by tb_user.id ")->num_rows();
        $data['t_jual'] = $this->db->query("SELECT count(tp.id) as total FROM tb_penjualan tp
        join tb_toko tt on tp.id_toko = tt.id
        WHERE tt.id_leader = '$id_leader'")->row();
        $data['t_minta'] = $this->db->query("SELECT count(tp.id) as total FROM tb_permintaan tp
        join tb_toko tt on tp.id_toko = tt.id
        WHERE tt.id_leader = '$id_leader'")->row();
        $data['t_retur'] = $this->db->query("SELECT count(tp.id) as total FROM tb_retur tp
        join tb_toko tt on tp.id_toko = tt.id
        WHERE tt.id_leader = '$id_leader'")->row();
        // list jual
        $data['list_jual'] = $this->db->query("SELECT tp.*, tk.nama_toko from tb_penjualan tp
        JOIN tb_toko tk on tp.id_toko = tk.id
        where tk.id_leader = '$id_leader' order by tp.id desc limit 5")->result();
         // permintaan terbaru
        $data['permintaan'] = $this->db->query("SELECT tp.*, tt.nama_toko, tu.nama_user  from tb_permintaan tp
        JOIN tb_toko tt on tp.id_toko = tt.id
        join tb_user tu on tp.id_user = tu.id
        where tp.status = '0' and tt.id_leader = '$id_leader'
        order by tp.id desc limit 5")->result();
         // Retur
        $data['retur'] = $this->db->query("SELECT tp.*, tt.nama_toko, tu.nama_user  from tb_retur tp
        JOIN tb_toko tt on tp.id_toko = tt.id
        join tb_user tu on tp.id_user = tu.id
        where tp.status = '0' and tt.id_leader = '$id_leader'
        order by tp.id desc limit 5")->result();
        $this->template->load('template/template', 'leader/dashboard', $data);
    
  }

}
?>
