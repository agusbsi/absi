<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
    	$role = $this->session->userdata('role');
	    if($role != "8"){
	      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
	      redirect(base_url(''));

	    }
		$this->load->model('M_admin');
		$this->load->model('M_support');
	}
	public function index()
	{
	    $data['title'] = 'Dashboard';
		// Total toko
        $data['t_toko'] = $this->db->query("SELECT count(id) as total from tb_toko where  status = 1")->row();
	    $data['jumlah_produk'] = $this->db->query("SELECT * FROM tb_produk where deleted_at is null")->num_rows();
	    $data['jumlah_permintaan'] = $this->db->query("SELECT * FROM tb_permintaan where deleted_at is null")->num_rows();
	    $data['jumlah_retur'] = $this->db->query("SELECT * FROM tb_retur WHERE deleted_at is null")->num_rows();
		// selisih penerimaan
		$data['jumlah_selisih'] = $this->db->query("SELECT count(id) as total from tb_pengiriman where  status = 1")->row();
		// list permintaan
		$data['list_minta'] = $this->db->query("SELECT tp.*, tt.nama_toko, tu.nama_user  from tb_permintaan tp
		 JOIN tb_toko tt on tp.id_toko = tt.id
		 join tb_user tu on tp.id_user = tu.id
		 where tp.status = '1'
		 order by tp.id desc limit 5")->result();
		// list Retur
		$data['list_retur'] = $this->db->query("SELECT tp.*, tt.nama_toko, tu.nama_user  from tb_retur tp
		 JOIN tb_toko tt on tp.id_toko = tt.id
		 join tb_user tu on tp.id_user = tu.id
		 where tp.status = '1'
		 order by tp.id desc limit 5")->result();
		// list Selisih
		$data['list_selisih'] = $this->db->query("SELECT tp.*, tt.nama_toko, tu.nama_user  from tb_pengiriman tp
		 JOIN tb_toko tt on tp.id_toko = tt.id
		 join tb_user tu on tp.id_penerima = tu.id
		 where tp.status = '3'
		 order by tp.id desc limit 5")->result();
	    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('username'));
	    $this->template->load('template/template', 'admin_mv/dashboard/index', $data);
	}
}
?>

