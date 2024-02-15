<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_login');
	}
	public function index()
	{
		    $data['token_generate'] = $this->token_generate();
			$this->session->set_userdata($data);
			$this->load->view('template/login',$data);
	}

	public function token_generate(){
		return $tokens = md5(uniqid(rand(), true));
	}

	public function register(){
		$this->load->view('login/register');
	}

	public function list_toko(){
		$id_user = $this->session->userdata('id');
		$nama_user = $this->session->userdata('nama_user');
		$data_toko = $this->db->query("SELECT id as id_toko, nama_toko, alamat, telp from tb_toko where id_spg = '$id_user' and status = 1");

		if ($data_toko->num_rows() == 1) {
			$id_toko = $data_toko->row()->id_toko;
			$this->pilih_toko_act($id_toko);
		} else {
			$data['jumlah_toko'] = $data_toko->num_rows();
			$data['nama_spg'] = $nama_user;
			$data['list_toko'] = $data_toko->result();

			$this->load->view('spg/pilih_toko',$data);
		}
	}

	public function pilih_toko_act($id){
		$this->session->set_userdata(['id_toko' => $id]);
		redirect(base_url('spg/dashboard'));
	}

	public function proses_login(){
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');
		if($this->form_validation->run() == TRUE){
			$username = $this->input->post('username',TRUE);
			$password = $this->input->post('password',TRUE);
			$latitude = $this->input->post('latitude',TRUE);
			$longitude = $this->input->post('longitude',TRUE);

		if($this->session->userdata('token_generate') === $this->input->post('token'))
		{
			$cek =  $this->M_login->cek_user('tb_user',$username);
			$cekStatus = $this->db->query("SELECT status from tb_user where username = '$username'")->row()->status;
			if ($cek->num_rows() != 1) {
					tampil_alert('info', 'Information', 'Username belum terdaftar silahkan hubungi Administrator!');
					redirect(base_url('Login'));
				} else if ($cekStatus != 1) {
					tampil_alert('error', 'Information', 'Akun Anda telah di Non-Aktifkan!');
					redirect(base_url('Login'));
				}else {
				$id_toko = 0;
				$isi = $cek->row();
				if(password_verify($password,$isi->password) === TRUE){
					$data_session = array(
									'id' => $isi->id,
									'username' => $username,
									'nama_user' => $isi->nama_user,
									'status' => 'login',
									'role' => $isi->role,
									'last_login' => $isi->last_login,
									'id_toko' => $id_toko
					);

					$this->session->set_userdata($data_session);

					$data_login = array(
						'last_login' => date('Y-m-d H:i:s'),
					);

					$this->M_login->edit_user(['username' => $username],$data_login);

						if($isi->role == 1){
							tampil_alert('success','Berhasil','Anda Berhasil Login !');
							redirect(base_url('adm/dashboard'));
						} elseif ($isi->role == 2) {
							tampil_alert('success','Berhasil','Anda Berhasil Login !');
							redirect(base_url('spv/Dashboard'));
						} elseif ($isi->role == 3) {
							tampil_alert('success','Berhasil','Anda Berhasil Login !');
							redirect(base_url('leader/Dashboard'));
						} elseif ($isi->role == 4) {
							tampil_alert('success','Berhasil','Anda Berhasil Login !');
							redirect(base_url('Login/list_toko'));
						} elseif ($isi->role == 5) {
							tampil_alert('success','Berhasil','Anda Berhasil Login !');
							redirect(base_url('adm_gudang/dashboard'));
						} elseif ($isi->role == 6) {
							tampil_alert('success','Berhasil','Anda Berhasil Login !');
							redirect(base_url('sup/dashboard'));
						}elseif ($isi->role == 7) {
							tampil_alert('success','Berhasil','Anda Berhasil Login !');
							redirect(base_url('hrd/dashboard'));
						}elseif ($isi->role == 8) {
							tampil_alert('success','Berhasil','Anda Berhasil Login !');
							redirect(base_url('adm_mv/dashboard'));
						}elseif ($isi->role == 9) {
							tampil_alert('success','Berhasil','Anda Berhasil Login !');
							redirect(base_url('mng_mkt/dashboard'));
						}
						elseif ($isi->role == 10) {
							tampil_alert('success','Berhasil','Anda Berhasil Login !');
							redirect(base_url('audit/dashboard'));
						}
						elseif ($isi->role == 11) {
							tampil_alert('success','Berhasil','Anda Berhasil Login !');
							redirect(base_url('staff_hrd/dashboard'));
						}
						elseif ($isi->role == 12) {
							tampil_alert('success','Berhasil','Anda Berhasil Login !');
							redirect(base_url('staff_ga/dashboard'));
						}
						elseif ($isi->role == 13) {
							tampil_alert('success','Berhasil','Anda Berhasil Login !');
							redirect(base_url('finance/dashboard'));
						}
						elseif ($isi->role == 14) {
							tampil_alert('success', 'Berhasil', 'Anda Berhasil Login !');
							redirect(base_url('mng_ops/dashboard'));
						}elseif ($isi->role == 15) {
							tampil_alert('success', 'Berhasil', 'Anda Berhasil Login !');
							redirect(base_url('accounting/dashboard'));
						} elseif ($isi->role == 16) {
							tampil_alert('success','Berhasil','Anda Berhasil Login !');
							redirect(base_url('adm_gudang/dashboard'));
						}
				}else {
					tampil_alert('error','Gagal','username dan password salah!');
					
					redirect(base_url('Login'));
				}
			}
			} else {
				redirect(base_url());
			}
		} else {
			tampil_alert('error','Gagal','Harap aktifkan GPS anda !.');
						
			redirect(base_url());
		}
	}

	public function cek_jarak($lat1,$lon1,$lat2,$lon2)
	{
		$theta = $lon1 - $lon2;
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;

		$nilai = ($miles * 1.609344) * 1000;
		return round($nilai);
	}
}
