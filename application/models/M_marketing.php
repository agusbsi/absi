<?php
class M_marketing extends CI_Model{
  
	public function get_cabang_by_id_customer($id_grup)
	{
	$query = $this->db->query("SELECT tb_customer.*, tb_toko.alamat, tb_toko.diskon FROM tb_customer JOIN tb_toko ON tb_customer.id = tb_toko.id_customer WHERE tb_customer.id ='$id_grup'");
	return $query->result_array();
	} 
}
?>