<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "7"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
 
    $this->load->model('M_spg');
  }

  public function index(){
   
        $id_spv = $this->session->userdata('id');
        $id_toko = $this->session->userdata('id_toko');
        $data['title'] = 'Dashboard';
        $data['t_toko'] = $this->db->query("SELECT count(id) as total from tb_toko where status != 0")->row();
        $data['user'] = $this->db->query("SELECT tb_user.*, tb_user_role.nama as jabatan FROM tb_user JOIN tb_user_role ON tb_user_role.id = tb_user.role ORDER BY tb_user.nama_user ASC")->result();
        $data['t_toko_aset'] = $this->db->query("SELECT count(id) as total from tb_toko where status_aset = 0 and status != 0")->row();
        $data['t_toko_so'] = $this->db->query("SELECT count(id) as total from tb_toko where status_so = 0 and status != 0")->row();
        $data['t_user'] = $this->db->query("SELECT count(id) as total from tb_user where status = '1' ")->row();
        $data['toko_aktif'] = $this->db->query("SELECT  tk.*,tu.nama_user, count(tk.id) as total 
        from tb_toko tk
        join tb_user tu on tk.id_spg = tu.id
        where tk.status_so = 0
        GROUP BY tk.id order by total DESC limit 5")->result();
        $this->template->load('template/template', 'hrd/dashboard', $data);
    
  }



}
?>
