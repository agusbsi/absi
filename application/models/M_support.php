<?php
class M_support extends CI_Model{
  var $tb_stokgudang = 'tb_stokgudang';
   
  // cek total stok permintaan
  public function stok_permintaan()
    {
        return $this->db->select('count(id) as total')
            ->from('tb_permintaan')->get()->row();
    }
  // cek total stok pengiriman
  public function stok_pengiriman()
    {
        return $this->db->select('sum(id) as total')
            ->from('tb_pengiriman')->get()->row();
    }

  public function cek_pass($tabel,$username){
    return  $this->db->select('*')
               ->from($tabel)
               ->where('username',$username)
               ->get();
  }

  public function list_produk_toko($id_toko){
    $query = $this->db->query("SELECT tp.id, ts.qty as stok, tp.satuan, tp.kode from tb_stok ts join tb_produk tp on tp.id = ts.id_produk where ts.id_toko = '$id_toko' order by tp.kode");
    return $query;
  }

  public function kode_aset()
  {
    $q = $this->db->query("SELECT MAX(RIGHT(id,4)) AS kd_max FROM tb_aset WHERE DATE(created_at)=CURDATE()");
    $kd = "";
    if($q->num_rows()>0){
        foreach($q->result() as $k){
            $tmp = ((int)$k->kd_max)+1;
            $kd = sprintf("%04s", $tmp);
        }
    }else{
        $kd = "0001";
    }
    date_default_timezone_set('Asia/Jakarta');
    return "ASGBL-".date('ymd').$kd;
  }
  public function kode_promo()
  {
    $q = $this->db->query("SELECT MAX(RIGHT(id,4)) AS kd_max FROM tb_promo WHERE DATE(created_at)=CURDATE()");
    $kd = "";
    if($q->num_rows()>0){
        foreach($q->result() as $k){
            $tmp = ((int)$k->kd_max)+1;
            $kd = sprintf("%04s", $tmp);
        }
    }else{
        $kd = "0001";
    }
    date_default_timezone_set('Asia/Jakarta');
    return "PROMO-".date('ymd').$kd;
  }
    public function kode_toko()
  {
    $q = $this->db->query("SELECT MAX(RIGHT(id,3)) AS kd_max FROM tb_toko WHERE DATE(created_at)=CURDATE()");
    $kd = "";
    if($q->num_rows()>0){
        foreach($q->result() as $k){
            $tmp = ((int)$k->kd_max)+1;
            $kd = sprintf("%03s", $tmp);
        }
    }else{
        $kd = "001";
    }
    date_default_timezone_set('Asia/Jakarta');
    return "TKGLB-".date('ymd').$kd;
  }

  public function get_cabang_by_id_customer($id)
  {
    $query = $this->db->query("SELECT tb_customer.*, tb_toko.alamat, tb_toko.diskon FROM tb_customer JOIN tb_toko ON tb_customer.id = tb_toko.id_customer WHERE tb_customer.id ='$id'");
    return $query->result_array();
  }

  public function detail_so($no_so)
  {
    $query = $this->db
    ->select('tb_so_detail.*,tb_produk.nama_produk,tb_produk.satuan,tb_produk.kode,tb_so_detail.qty_akhir, tb_so_detail.hasil_so')
    ->from('tb_so_detail')
    ->JOIN('tb_so','tb_so.id = tb_so_detail.id_so ')
    ->JOIN('tb_produk','tb_produk.id = tb_so_detail.id_produk ')
    ->where('tb_so_detail.id_so',$no_so)
    ->get();
    return $query->result();
  }
  // menampilkan data berdasarkan id
  public function get_so($no_so)
  {
    $query = $this->db
    ->select('tb_so.*,tb_toko.id as id_toko,tb_toko.tgl_so,tb_toko.nama_toko,tb_toko.alamat,tb_toko.telp,tb_user.nama_user')
    ->from('tb_so')
    ->JOIN('tb_toko','tb_toko.id = tb_so.id_toko ')
    ->JOIN('tb_user','tb_user.id = tb_so.id_user ')
    ->where('tb_so.id',$no_so)
    ->get();
    return $query->result();
  }

    // menampilkan data permintaan yg sudah di approvel admin support
  public function lihat_data()
  {
    return  $this->db->select('tb_permintaan.id,tb_permintaan.created_at as tgl_permintaan,tb_permintaan.status as status_permintaan,tb_user.username,tb_toko.id as id_toko,tb_toko.nama_toko as toko')
    ->join('tb_toko', 'tb_permintaan.id_toko = tb_toko.id') //mengambil data toko
    ->join('tb_user', 'tb_permintaan.id_user = tb_user.id') //mengambil data user
    ->order_by('tb_permintaan.status','asc')
    ->distinct()
    ->get('tb_permintaan');
  }

  public function lihat_data2($tgl_awal,$tgl_akhir)
  {
    return  $this->db->select('tb_permintaan.id,tb_permintaan.created_at as tgl_permintaan,tb_permintaan.status as status_permintaan,tb_user.username,tb_toko.id as id_toko,tb_toko.nama_toko as toko')
    ->join('tb_toko', 'tb_permintaan.id_toko = tb_toko.id') //mengambil data toko
    ->join('tb_user', 'tb_permintaan.id_user = tb_user.id') //mengambil data user
    ->where('tb_permintaan.created_at >=', $tgl_awal)
    ->where('tb_permintaan.created_at <=', $tgl_akhir)
    ->order_by('tb_permintaan.status','asc')
    ->distinct()
    ->get('tb_permintaan');
  }

// menampilkan data berdasarkan id
public function get_data($no_permintaan)
  {
    $query = $this->db->select('tb_permintaan.id_toko, tb_permintaan.id as id_permintaan,tb_permintaan.status,tb_permintaan.created_at as tgl_permintaan,tb_toko.nama_toko,tb_toko.id as id_toko,tb_toko.alamat,tb_toko.telp,tb_user.username as spg,tb_permintaan.keterangan')
    ->from('tb_permintaan')
    ->JOIN('tb_toko','tb_toko.id = tb_permintaan.id_toko ','LEFT')
    ->JOIN('tb_user','tb_user.id = tb_permintaan.id_user ','LEFT')
    ->where('tb_permintaan.id',$no_permintaan)
    ->get();
    return $query->row();
  }

  // lihat berdasarkan detail permintaan
  public function get_data_detail($no_permintaan)
  {
    $query = $this->db->select('tb_produk.nama_produk,tb_produk.kode,tb_produk.satuan,tb_produk.deskripsi,tb_produk.harga_jawa as het_jawa, tb_produk.harga_indobarat as het_indobarat, tb_permintaan_detail.qty as qty_permintaan,tb_permintaan_detail.qty_acc, tb_permintaan_detail.id as id_detail, tb_permintaan_detail.id_permintaan, tb_permintaan_detail.id_produk,tb_toko.het')
    ->from('tb_permintaan_detail')
    ->JOIN('tb_permintaan','tb_permintaan.id = tb_permintaan_detail.id_permintaan')
    ->JOIN('tb_produk','tb_produk.id = tb_permintaan_detail.id_produk')
    ->JOIN('tb_toko','tb_toko.id = tb_permintaan.id_toko')
    ->where('tb_permintaan_detail.status = 1')
    ->where('tb_permintaan_detail.id_permintaan',$no_permintaan)
    ->get();
    return $query->result();
  }

  
    // menampilkan data penjualan tiap toko
  public function lihat_data_penjualan()
  {
    $query2 = $this->db->query("SELECT tb_penjualan.id_toko, tb_toko.nama_toko, tb_penjualan.tanggal_penjualan, tb_user.nama_user,count(tb_penjualan_detail.qty) as total_qty, count(distinct tb_penjualan.id) as total_transaksi FROM tb_penjualan join tb_penjualan_detail on tb_penjualan.id = tb_penjualan_detail.id_penjualan join tb_toko on tb_toko.id = tb_penjualan.id_toko join tb_user on tb_user.id = tb_penjualan.id_user group by date(tb_penjualan.tanggal_penjualan), tb_penjualan.id_toko order by tb_penjualan.tanggal_penjualan DESC ");

    return $query2->result();
  }


  public function updatedata($wehere,$data)
  {
    $this->db->update('tb_permintaan_detail',$where,$data);
    return $this->db->affected_rows();
  }

  // menampilkan data berdasarkan id
  public function get_data_penjualan($id_toko,$tanggal)
  {
    $query = $this->db->select('DATE_FORMAT(tb_penjualan.tanggal_penjualan, "%d-%b-%Y") as tanggal_penjualan, tb_penjualan.*, tb_penjualan_detail.harga, tb_penjualan_detail.diskon_promo, tb_penjualan_detail.diskon_toko,tb_produk.kode,tb_produk.nama_produk,tb_produk.satuan,tb_penjualan_detail.qty,tb_penjualan_detail.diskon_promo,tb_penjualan_detail.diskon_toko,tb_penjualan_detail.harga')
    ->from('tb_penjualan')
    ->join('tb_penjualan_detail', 'tb_penjualan_detail.id_penjualan = tb_penjualan.id')
    ->join('tb_produk','tb_produk.id = tb_penjualan_detail.id_produk')
    ->where('tb_penjualan.id_toko',$id_toko)
    ->where('tb_penjualan.tanggal_penjualan',$tanggal)
    ->get();
    return $query->result();
  }

  // lihat berdasarkan detail permintaan
  public function get_data_penjualan_detail($no_penjualan)
  {
    $query = $this->db->select('tb_produk.nama_produk,tb_produk.kode,tb_produk.satuan,tb_penjualan_detail.qty')
    ->from('tb_penjualan_detail')
    ->JOIN('tb_penjualan','tb_penjualan.id = tb_penjualan_detail.id_penjualan')
    ->JOIN('tb_produk','tb_produk.id = tb_penjualan_detail.id_produk')
    ->where('tb_penjualan_detail.id_penjualan',$no_penjualan)
    ->get();
    return $query->result();
  }
  public function lihat_data_retur()
  {
    return  $this->db->select('tb_retur.id,tb_retur.created_at as tgl_retur,tb_retur.id_toko,tb_retur.status,tb_toko.id as id_toko,tb_toko.nama_toko,tb_toko.alamat, tb_user.id as id_user, tb_user.nama_user')
    ->join('tb_toko', 'tb_retur.id_toko = tb_toko.id') //mengambil data toko
    ->join('tb_user', 'tb_retur.id_user = tb_user.id')
    ->order_by('tb_retur.status','ASC')
    // ->where('tb_permintaan.status = 0')
    ->distinct()
    ->get('tb_retur');
  }
  // menampilkan data berdasarkan id
  public function get_data_retur($no_retur)
  {
    $query = $this->db->select('tb_retur.id as id_retur,tb_retur.created_at as tgl_retur,tb_retur.status, tb_toko.nama_toko, tb_toko.alamat, tb_toko.telp,tb_user.username')
    ->from('tb_retur')
    ->JOIN('tb_toko','tb_toko.id = tb_retur.id_toko ')
    ->JOIN('tb_user','tb_user.id = tb_retur.id_user ')
    ->where('tb_retur.id',$no_retur)
    ->get();
    return $query->row();
  }

  // lihat berdasarkan detail permintaan
  public function get_data_retur_detail($no_retur)
  {
    $query = $this->db->select('tb_produk.nama_produk,tb_produk.kode,tb_produk.satuan,tb_retur_detail.qty,tb_retur_detail.foto')
    ->from('tb_retur_detail')
    ->JOIN('tb_retur','tb_retur.id = tb_retur_detail.id_retur')
    ->JOIN('tb_produk','tb_produk.id = tb_retur_detail.id_produk')
    ->where('tb_retur_detail.id_retur',$no_retur)
    ->get();
    return $query->result();
  }
  
  public function lihat_data_selisih()
  {
    return  $this->db->select('tb_pengiriman.id as id_kirim, tb_pengiriman.id_toko, tb_pengiriman.id_penerima, tb_pengiriman_detail.qty, tb_pengiriman_detail.qty_diterima, tb_toko.id, tb_toko.nama_toko, tb_user.id, tb_user.nama_user, tb_pengiriman.created_at as tgl_kirim')
    ->join('tb_pengiriman_detail', 'tb_pengiriman_detail.id_pengiriman = tb_pengiriman.id') //mengambil data toko
    ->join('tb_user', 'tb_pengiriman.id_penerima = tb_user.id')
    ->JOIN('tb_toko', 'tb_toko.id = tb_pengiriman.id_toko')
    ->where('tb_pengiriman.status = 3')
    // ->where('tb_pengiriman.catatan_selisih = ""')
    ->where('tb_pengiriman_detail.qty != tb_pengiriman_detail.qty_diterima')
    ->group_by('tb_pengiriman.id')
    ->get('tb_pengiriman');
  }

  public function get_data_selisih($no_kirim)
  {
    $query = $this->db->select('tb_pengiriman.id as id_kirim,tb_pengiriman.created_at as tgl_kirim,tb_pengiriman.status, tb_toko.nama_toko, tb_toko.alamat, tb_toko.telp,tb_user.nama_user, tb_pengiriman.keterangan, tb_pengiriman.id_permintaan')
    ->from('tb_pengiriman')
    ->JOIN('tb_toko','tb_toko.id = tb_pengiriman.id_toko ')
    ->JOIN('tb_user','tb_user.id = tb_pengiriman.id_user ')
    ->where('tb_pengiriman.id',$no_kirim)
    ->get();
    return $query->row();    
  }

  public function get_data_selisih_detail($no_kirim)
  {
    $query = $this->db->select('tb_produk.nama_produk, tb_produk.kode,tb_produk.satuan, tb_pengiriman_detail.qty, tb_pengiriman_detail.qty_diterima, tb_pengiriman.id_permintaan')
    ->from('tb_pengiriman_detail')
    ->JOIN('tb_pengiriman','tb_pengiriman.id = tb_pengiriman_detail.id_pengiriman')
    ->JOIN('tb_produk','tb_produk.id = tb_pengiriman_detail.id_produk')
    ->where('tb_pengiriman_detail.id_pengiriman',$no_kirim)
    ->where('tb_pengiriman_detail.qty != tb_pengiriman_detail.qty_diterima')
    ->get();
    return $query->result();
  }

  // tes fungsi import
  public function get_produk_by_kode($kode)
  {
    return $this->db->get_where('tb_stokgudang', array('kode' => $kode))->row();
  }

  public function get_idproduk($kode)
  {
    // Query untuk mendapatkan id_produk berdasarkan kode
    $query = $this->db->get_where('tb_produk', array('kode' => $kode));

    // Mengambil nilai id_produk
    $row = $query->row();
    return $row->id;
  }

  public function update_stok($kode, $toko, $stok, $tanggal_sekarang)
  {
    // Update level stok dalam tabel tb_produk berdasarkan kode
    $id_produk = $this->get_idproduk($kode);
    $this->db->set('qty', $stok, false);
    $this->db->set('qty_awal', $stok, false);
    $this->db->set('updated_at', $tanggal_sekarang);
    $this->db->where('id_produk', $id_produk);
    $this->db->where('id_toko', $toko);
    $this->db->update('tb_stok');
  }

  public function add_produk($data)
  {
    $this->db->insert('tb_stokgudang', $data);
  }
}
