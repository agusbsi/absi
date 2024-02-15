<?php

class M_toko extends CI_Model
{

  // fungsi tambah data
  public function insert($tabel,$data)
  {
    $this->db->insert($tabel,$data);
  }

// menampilkan data toko yang status aktif
  public function lihat_data($tabel)
  {
    return  $this->db->select('*')
    ->where('status = 1')
    ->order_by('id','desc')
    ->get($tabel);
  }
// menghapus data
  public function deleted($tabel,$where,$data)
  {
    $query = $this->db->where($where);
    $query = $this->db->update($tabel,$data);
    return $query;
  }

  // fungsi update data
  public function update($tabel,$data,$where)
  {
    $this->db->where($where);
    $this->db->update($tabel,$data);
  }

// menampilkan data berdasarkan id
public function get_data($tabel,$where)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where($where)
                      ->get();
    return $query->result();
  }

// menampilkan data supervisor
function supervisor($id)
	{
		return
			$this->db
            ->select('tb_user_toko.id as id, tb_user.username as pengguna,tb_user_role.nama as spv, tb_user.id as id_user')
            ->join('tb_user', 'tb_user.id = tb_user_toko.id_user', 'left') //mengambil nama user
            ->join('tb_user_role', 'tb_user_role.id = tb_user.role', 'left') //mengambil id role
            ->where('tb_user.role = 2') //menampilkan role supervisor
            ->where('tb_user_toko.id_toko',$id) //menampilkan sesuai dg toko
			->get('tb_user_toko');
	}
// menampilkan data Tim Leader
function leader($id)
	{
		return
			$this->db
            ->select('tb_user_toko.id as id, tb_user.username as pengguna,tb_user_role.nama as leader')
            ->join('tb_user', 'tb_user.id = tb_user_toko.id_user', 'left') //mengambil nama user
            ->join('tb_user_role', 'tb_user_role.id = tb_user.role', 'left') //mengambil id role
            ->where('tb_user.role = 3') //menampilkan role tim leader
            ->where('tb_user_toko.id_toko',$id) //menampilkan sesuai dg toko
			->get('tb_user_toko');
	}

// menampilkan data SPG
function spg($id)
	{
		return
			$this->db
            ->select('tb_user_toko.id as id, tb_user.username as pengguna,tb_user_role.nama as spg')
            ->join('tb_user', 'tb_user.id = tb_user_toko.id_user', 'left') //mengambil nama user
            ->join('tb_user_role', 'tb_user_role.id = tb_user.role', 'left') //mengambil id role
            ->where('tb_user.role = 4') //menampilkan role SPG
            ->where('tb_user_toko.id_toko',$id) //menampilkan sesuai dg toko
			->get('tb_user_toko');
	}

// menampilkan list spv
public function list_spv($tabel)
{
  return  $this->db->select('*')
  ->where('role = 2')
  ->get($tabel);
}
// menampilkan list timleader
public function list_leader($tabel)
{
  return  $this->db->select('*')
  ->where('role = 3')
  ->get($tabel);
}

// menampilkan list spg
public function list_spg()
{
  return  $this->db->query("SELECT u.* FROM tb_user u left join tb_user_toko ut on ut.id_user = u.id where role = 4 and status = 1 and ut.id is null");
}

// ambil link
function get_one($id)
	{
		$param = array('id' => $id);
		return $this->db->get_where('tb_user_toko', $param);
	}

// proses hapus
public function delete($tabel,$where)
{
  $this->db->where($where);
  $this->db->delete($tabel);
}

public function last_update_stok($id)
{
  $query = $this->db->query("SELECT updated_at from tb_stok where id_toko = '$id' order by updated_at desc");

  if ($query->num_rows() > 0) {

    return $query->row()->updated_at;
  } else {
    return "Not Available";
  }

}

// Menampilkan stok berdasarkan ID toko
function stok($id)
	{
		return
			$this->db
            ->select('tb_stok.id as id_stok, tb_produk.id as id_produk, tb_produk.kode, tb_produk.nama_produk, tb_stok.qty, tb_stok.updated_at')
            ->join('tb_produk', 'tb_stok.id_produk = tb_produk.id') //mengambil id produk
            ->join('tb_toko', 'tb_stok.id_toko = tb_toko.id') //mengambil id toko
            ->where('tb_stok.id_toko',$id) //menampilkan sesuai dg toko
			->get('tb_stok');
	}

  // menampilkan stok untuk update

  function update_stok($id)
	{
		return
			$this->db
            ->select('tb_stok.id as id_stok, tb_produk.nama_produk as produk, tb_stok.qty, tb_toko.nama_toko as toko, tb_stok.id_toko, tb_stok.id_produk')
            ->join('tb_produk', 'tb_stok.id_produk = tb_produk.id', 'left') //mengambil id produk
            ->join('tb_toko', 'tb_stok.id_toko = tb_toko.id', 'left') //mengambil id toko
            ->where('tb_stok.id',$id) //menampilkan sesuai dg toko
			->get('tb_stok');
	}
  
  
}



 ?>
