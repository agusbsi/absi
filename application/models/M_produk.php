<?php
class M_produk extends CI_Model {

  public function get()
  {
    $id_toko = $this->session->userdata('id_toko');
    $query = $this->db
    ->select('tb_produk.*')
    ->join('tb_stok','tb_stok.id_produk = tb_produk.id')
    ->WHERE('tb_stok.id_toko', $id_toko)
    ->get('tb_produk');
    return $query->result();
  }

  public function get_produk_by_id($id)
  {
    $id_toko = $this->session->userdata('id_toko');
    $query = $this->db->query("SELECT tb_produk.*, tb_stok.qty FROM tb_produk join tb_stok ON tb_produk.id = tb_stok.id_produk WHERE tb_stok.id_produk = '$id' and tb_stok.id_toko = '$id_toko'");
    return $query->row(); 
  }

  public function get_stok()
  {
    $id_toko = $this->session->userdata('id_toko');
    $query = $this->db->query("SELECT * from tb_stok ts join tb_produk tp on tp.id = ts.id_produk where ts.id_toko = '$id_toko'");
    return $query;
  }

  public function get_by_id($id)
  {
    $query = $this->db->query("SELECT * FROM tb_produk where id='$id'");
    return $query->row();
  }

  

}
?>