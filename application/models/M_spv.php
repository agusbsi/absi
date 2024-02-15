<?php

class M_spv extends CI_Model
{

  public function insert($tabel,$data)
  {
    $this->db->insert($tabel,$data);
  }
  // update data
  public function update($tabel,$where,$user_toko)
  {
    $query = $this->db->where($where);
    $query = $this->db->update($tabel,$user_toko);
    return $query;
  }
  // last update
  public function last_update_stok($id_toko)
{
  $query = $this->db->query("SELECT updated_at from tb_stok where id_toko = '$id_toko' order by updated_at desc");

  if ($query->num_rows() > 0) {

    return $query->row()->updated_at;
  } else {
    return "Not Available";
  }

}
}
?>