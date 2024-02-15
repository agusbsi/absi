<?php

class M_admin extends CI_Model
{

  public function insert($tabel,$data)
  {
    $this->db->insert($tabel,$data);
  }

  public function select($tabel)
  {
    $query = $this->db->get($tabel);
    return $query->result();
  }
// menampilkan data toko yang status aktif
  public function lihat_data($tabel)
  {
    return  $this->db->select('*')
    ->order_by('id DESC')
    ->get($tabel);
  }
// menghapus data
  public function deleted($tabel,$where,$data)
  {
    $query = $this->db->where($where);
    $query = $this->db->update($tabel,$data);
    return $query;
  }

  public function cek_jumlah($tabel,$id_transaksi)
  {
    return  $this->db->select('*')
               ->from($tabel)
               ->where('id_transaksi',$id_transaksi)
               ->get();

  }

  public function get_data_array($tabel,$id_transaksi)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where($id_transaksi)
                      ->get();
    return $query->result_array();
  }

  public function get_data($tabel,$id_transaksi)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where($id_transaksi)
                      ->get();
    return $query->row();
  } 

  public function get_data_result($tabel,$id_transaksi)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where($id_transaksi)
                      ->get();
    return $query->result();
  }

  public function list_tambah_produk($id_toko)
  {
    $query = $this->db->query("SELECT tb_produk.*, (SELECT count(id) from tb_stok where id_produk = tb_produk.id and id_toko = '$id_toko') as jumlah_stok from tb_produk where tb_produk.status = 1 and tb_produk.deleted_at is null having jumlah_stok = 0");
    return $query;
  }

  public function update($tabel,$data,$where)
  {
    $this->db->where($where);
    $this->db->update($tabel,$data);
  }

  public function delete($tabel,$where)
  {
    $this->db->where($where);
    $this->db->delete($tabel);
  }

  public function mengurangi($tabel,$id_transaksi,$jumlah)
  {
    $this->db->set("jumlah","jumlah - $jumlah");
    $this->db->where('id_transaksi',$id_transaksi);
    $this->db->update($tabel);
  }
  public function cek_password_lama()
  {
    $old = md5($this->input->post('pass_lama'));
    $this->db->where('password',$old);
    $query = $this->db->get('tb_user');
    return $query->result();
  }
  public function ganti_password()
  {
    $pass = md5($this->input->post('pass_baru'));
    $data = array(
      'password' => $pass
    );
    $this->db->where('id',$this->session->userdata('id'));
    $this->db->update('tb_user',$data);
  }
  public function update_password($tabel,$where,$data)
  {
    $this->db->where($where);
    $this->db->update($tabel,$data);
  }

  public function get_data_gambar($tabel,$username)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where('username_user',$username)
                      ->get();
    return $query->result();
  }

  public function sum($tabel,$field)
  {
    $query = $this->db->select_sum($field)
                      ->from($tabel)
                      ->get();
    return $query->result();
  }

  public function numrows($tabel)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->get();
    return $query->num_rows();
  }

  public function kecuali($tabel,$username)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where_not_in('username',$username)
                      ->get();

    return $query->result();
  }

  // get data join 
  function tampil_produk()
	{
		return
			$this->db->join('tb_satuan', 'tb_satuan.id_satuan = tb_produk.satuan', 'left')
			->order_by('id', 'DESC')
			->distinct()
			->get('tb_produk');
	}

  // hapus produk
  function hapus($id)
	{
		$this->db->where('kode', $id);
		$this->db->delete('tb_produk');
	}
  
  // list detail
  function barang_list(){
    $query = $this->db->query("SELECT * FROM tb_produk ");
    return $query;
	}

}



 ?>
