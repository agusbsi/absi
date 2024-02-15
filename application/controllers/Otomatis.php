<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Otomatis extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}
	public function update()
	{
		$deskripsi = "Update otomatis crone job.";
		$tanggal = date("Y-m-d H:i:s");
		$data = array(
			'deskripsi' => $deskripsi,
			'tanggal' => $tanggal,
		);
		$this->db->insert('tb_otomatis',$data);
	}
	public function reset_so_toko()
	{ 
		$this->db->query("UPDATE tb_toko set status_aset='0', status_so ='0' where status = '1'");
	}
}
