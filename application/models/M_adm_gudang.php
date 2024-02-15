<?php
class M_adm_gudang extends CI_Model
{

  // fungsi select
  public function select($tabel)
  {
    $query = $this->db->get($tabel);
    return $query->result();
  }
  // cek total stok produk
  public function stok_produk()
    {
        return $this->db->select('sum(qty) as total','*')
            ->from('tb_stok')->get()->row();
    }
  // cek total Produk yang dikirm
  public function produk_dikirim()
    {
        return $this->db->select('sum(qty) as total','*')
            ->from('tb_pengiriman_detail')->get()->row();
    } 
  // cek total stok permintaan
  public function stok_permintaan()
    {
        return $this->db->select('count(id) as total')
            ->from('tb_permintaan')
            ->where('status = 2')
            ->get()->row();
    }
  // cek total pending permintaan
  public function permintaan_pending()
    {
        return $this->db
            ->select('count(id) as total')
            ->where('status = 4')
            ->from('tb_permintaan')->get()->row();
    }
  // cek total stok pengiriman
  public function stok_pengiriman()
    {
        return $this->db->select('count(id) as total')
            ->from('tb_pengiriman')->get()->row();
    }
  // menampilkan data permintaan yg sudah di approvel admin support
  public function lihat_data()
    {
      return  $this->db->select('tb_permintaan.*,tb_toko.nama_toko')
      ->join('tb_permintaan_detail', 'tb_permintaan.id = tb_permintaan_detail.id_permintaan') //mengambil data detail permintaan
      ->join('tb_toko', 'tb_permintaan.id_toko = tb_toko.id') //mengambil data toko
      ->where('tb_permintaan.status = 2')
      ->order_by('tb_permintaan.id','desc')
      ->distinct()
      ->get('tb_permintaan');
    }
  // menampilkan data berdasarkan id
  public function get_data($no_permintaan)
    {
      $query = $this->db
      ->select('tb_permintaan.*,tb_toko.nama_toko,tb_toko.alamat,tb_toko.telp,tb_user.username as spg')
      ->from('tb_permintaan')
      ->JOIN('tb_toko','tb_toko.id = tb_permintaan.id_toko ')
      ->JOIN('tb_user','tb_user.id = tb_permintaan.id_user ','left')
      ->where('tb_permintaan.id',$no_permintaan)
      ->get();
      return $query->result();
    }
  // lihat berdasarkan detail permintaan
  public function get_data_detail($no_permintaan)
  {
    $query = $this->db
    ->select('tb_permintaan_detail.*,tb_produk.kode as kode_produk,tb_produk.nama_produk,tb_produk.satuan')
    ->from('tb_permintaan_detail')
    ->JOIN('tb_permintaan','tb_permintaan.id = tb_permintaan_detail.id_permintaan ')
    ->JOIN('tb_produk','tb_produk.id = tb_permintaan_detail.id_produk ')
    ->where('tb_permintaan_detail.id_permintaan',$no_permintaan)
    ->get();
    return $query->result();
  }
  // ======================= MODEL UNTUK PENGIRIMAN =========================== //
  // menampilkan data pengiriman
  public function data_pengiriman()
  {
     return  $this->db->select('tb_pengiriman.*,tb_toko.nama_toko')
     ->join('tb_toko', 'tb_pengiriman.id_toko = tb_toko.id') //mengambil data toko
     ->order_by('tb_pengiriman.id','desc')
     ->distinct()
     ->get('tb_pengiriman');
  }
  // menampilkan list permintaan
  public function list_permintaan()
  {
    $query = $this->db->query("SELECT prm.id, tk.nama_toko from tb_permintaan prm join tb_toko tk on prm.id_toko = tk.id where prm.status in (2) order by prm.id desc");
     return  $query;
  }
 
  // info toko
  public function info_toko($id)
  {
    return  $this->db->select('tb_permintaan.*,tb_toko.nama_toko,tb_toko.alamat,tb_user.nama_user')
    ->join('tb_toko', 'tb_permintaan.id_toko = tb_toko.id') //mengambil data toko
    ->join('tb_user', 'tb_permintaan.id_user = tb_user.id','left') //mengambil data toko
    ->where('tb_permintaan.id',$id)
    ->distinct()
    ->get('tb_permintaan');
  }
  //  menampilkan data json
  public function view($no_permintaan)
  {
		$query = $this->db->query("SELECT pr.*, us.username, tk.alamat, tk.nama_toko FROM tb_permintaan pr join tb_toko tk on tk.id = pr.id_toko join tb_user us on us.id = pr.id_user where pr.id = '$no_permintaan'");
		return $query;
	}
  // list detail
  function barang_list($id)
  {
    $query = $this->db->query("SELECT pd.*, pr.nama_produk, tp.id_toko FROM tb_permintaan_detail pd 
    join tb_produk pr on pr.id = pd.id_produk 
    join tb_permintaan tp on tp.id = pd.id_permintaan 
    where pd.id_permintaan = '$id' and pd.status = '1'");
    return $query;
	}
//  kode otomatis kirim

  public function kode_kirim()
      {
        $q = $this->db->query("SELECT MAX(RIGHT(id,4)) AS kd_max FROM tb_pengiriman WHERE DATE(created_at)=CURDATE()");
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
        return "KM-".date('ymd').$kd;
      }
      // kode mutasi
  public function kode_mutasi()
      {
        $q = $this->db->query("SELECT MAX(RIGHT(id,4)) AS kd_max FROM tb_mutasi WHERE DATE(created_at)=CURDATE()");
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
        return "MU-".date('ymd').$kd;
      }
// fungsi tambah master
  public function tambah($data)
  {
    return $this->db->insert('tb_pengiriman', $data);
  }
// fungsi tambah detail
  public function tambah_detail($data)
  {
    return $this->db->insert_batch('tb_pengiriman_detail', $data);
  }
// lihat berdasarkan detail permintaan
  public function detail_kirim($no_pengiriman)
  {
    $query = $this->db
    ->select('tb_pengiriman_detail.*,tb_produk.nama_produk,tb_produk.satuan,tb_produk.kode')
    ->from('tb_pengiriman_detail')
    ->JOIN('tb_pengiriman','tb_pengiriman.id = tb_pengiriman_detail.id_pengiriman ')
    ->JOIN('tb_produk','tb_produk.id = tb_pengiriman_detail.id_produk ')
    ->where('tb_pengiriman_detail.id_pengiriman',$no_pengiriman)
    ->get();
    return $query->result();
  }
// menampilkan data berdasarkan id
  public function get_kirim($no_pengiriman)
  {
    $query = $this->db
    ->select('tb_pengiriman.*,tb_toko.id as id_toko,tb_toko.nama_toko,tb_toko.alamat,tb_toko.telp,tb_user.nama_user')
    ->from('tb_pengiriman')
    ->JOIN('tb_toko','tb_toko.id = tb_pengiriman.id_toko ')
    ->JOIN('tb_user','tb_user.id = tb_pengiriman.id_user ')
    ->where('tb_pengiriman.id',$no_pengiriman)
    ->get();
    return $query->result();
  }

// =============== untuk laporan ==================
  public function lap_permintaan()
   {
     return  $this->db->select('tb_permintaan.id as kode,tb_toko.*')
     ->join('tb_permintaan_detail', 'tb_permintaan.id = tb_permintaan_detail.id_permintaan', 'left') //mengambil data detail permintaan
     ->join('tb_toko', 'tb_permintaan.id_toko = tb_toko.id', 'left') //mengambil data toko
     ->distinct()
     ->get('tb_permintaan');
   }
  public function lap_pengiriman()
   {
     return  $this->db->select('tb_pengiriman.id as kode,tb_toko.*')
     ->join('tb_pengiriman_detail', 'tb_pengiriman.id = tb_pengiriman_detail.id_pengiriman', 'left') //mengambil data detail permintaan
     ->join('tb_toko', 'tb_pengiriman.id_toko = tb_toko.id', 'left') //mengambil data toko
     ->distinct()
     ->get('tb_pengiriman');
   }
  public function lap_toko()
   {
     return  $this->db->select('*')
     ->get('tb_toko');
   }
  function hasil_permintaan()
   {
		$hasil=$this->db->query("SELECT count(id) as jumlah  FROM tb_permintaan");
		return $hasil->result();
	 }
  // fungsi datattables
  function get_tables_query($query,$cari,$where,$iswhere)
    {
            // Ambil data yang di ketik user pada textbox pencarian
            $search = htmlspecialchars($_POST['search']['value']);
            // Ambil data limit per page
            $limit = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['length']}");
            // Ambil data start
            $start =preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['start']}"); 

            if($where != null)
            {
                $setWhere = array();
                foreach ($where as $key => $value)
                {
                    $setWhere[] = $key."='".$value."'";
                }
                $fwhere = implode(' AND ', $setWhere);

                if(!empty($iswhere))
                {
                    $sql = $this->db->query($query." WHERE  $iswhere AND ".$fwhere);
                    
                }else{
                    $sql = $this->db->query($query." WHERE ".$fwhere);
                }
                $sql_count = $sql->num_rows();
    
                $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";
                
                // Untuk mengambil nama field yg menjadi acuan untuk sorting
                $order_field = $_POST['order'][0]['column']; 
    
                // Untuk menentukan order by "ASC" atau "DESC"
                $order_ascdesc = $_POST['order'][0]['dir']; 
                $order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;
    
                if(!empty($iswhere))
                {
                    $sql_data = $this->db->query($query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }else{
                    $sql_data = $this->db->query($query." WHERE ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }
                
                if(isset($search))
                {
                    if(!empty($iswhere))
                    {
                        $sql_cari =  $this->db->query($query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")");
                    }else{
                        $sql_cari =  $this->db->query($query." WHERE ".$fwhere." AND (".$cari.")");
                    }
                    $sql_filter_count = $sql_cari->num_rows();
                }else{
                    if(!empty($iswhere))
                    {
                        $sql_filter = $this->db->query($query." WHERE $iswhere AND ".$fwhere);
                    }else{
                        $sql_filter = $this->db->query($query." WHERE ".$fwhere);
                    }
                    $sql_filter_count = $sql_filter->num_rows();
                }
                $data = $sql_data->result_array();

            }else{
                if(!empty($iswhere))
                {
                    $sql = $this->db->query($query." WHERE  $iswhere ");
                }else{
                    $sql = $this->db->query($query);
                }
                $sql_count = $sql->num_rows();
    
                $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";
                
                // Untuk mengambil nama field yg menjadi acuan untuk sorting
                $order_field = $_POST['order'][0]['column']; 
    
                // Untuk menentukan order by "ASC" atau "DESC"
                $order_ascdesc = $_POST['order'][0]['dir']; 
                $order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;
    
                if(!empty($iswhere))
                {                
                    $sql_data = $this->db->query($query." WHERE $iswhere AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }else{
                    $sql_data = $this->db->query($query." WHERE (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }

                if(isset($search))
                {
                    if(!empty($iswhere))
                    {     
                        $sql_cari =  $this->db->query($query." WHERE $iswhere AND (".$cari.")");
                    }else{
                        $sql_cari =  $this->db->query($query." WHERE (".$cari.")");
                    }
                    $sql_filter_count = $sql_cari->num_rows();
                }else{
                    if(!empty($iswhere))
                    {
                        $sql_filter = $this->db->query($query." WHERE $iswhere");
                    }else{
                        $sql_filter = $this->db->query($query);
                    }
                    $sql_filter_count = $sql_filter->num_rows();
                }
                $data = $sql_data->result_array();
            }
            
            $callback = array(    
                'draw' => $_POST['draw'], // Ini dari datatablenya    
                'recordsTotal' => $sql_count,    
                'recordsFiltered'=>$sql_filter_count,    
                'data'=>$data
            );
            return json_encode($callback); // Convert array $callback ke json
    }
  // Fungsi btn cari
  function cari_id($id_minta)
    {
      return $this->db
        ->select('tb_permintaan.*,tb_toko.nama_toko as nama_toko')
        ->join('tb_toko', 'tb_toko.id = tb_permintaan.id_toko')
        ->where("tb_permintaan.id", $id_minta)
        ->distinct()
        ->get('tb_permintaan')->result();
    }
  function cari_id_kirim($id_kirim)
    {
      return $this->db
        ->select('tb_pengiriman.*,tb_toko.nama_toko as nama_toko')
        ->join('tb_toko', 'tb_toko.id = tb_pengiriman.id_toko')
        ->where("tb_pengiriman.id", $id_kirim)
        ->distinct()
        ->get('tb_pengiriman')->result();
    }
  function cari_toko($toko)
    {
      return $this->db
        ->select('tb_permintaan.*,tb_toko.nama_toko as nama_toko')
        ->join('tb_toko', 'tb_toko.id = tb_permintaan.id_toko')
        ->where("tb_permintaan.id_toko", $toko)
        ->distinct()
        ->get('tb_permintaan')->result();
    }
  function cari_toko_kirim($toko)
    {
      return $this->db
        ->select('tb_pengiriman.*,tb_toko.nama_toko as nama_toko')
        ->join('tb_toko', 'tb_toko.id = tb_pengiriman.id_toko')
        ->where("tb_pengiriman.id_toko", $toko)
        ->distinct()
        ->get('tb_pengiriman')->result();
    }
  function cari_status($status)
    {
      return $this->db
        ->select('tb_permintaan.*,tb_toko.nama_toko as nama_toko')
        ->join('tb_toko', 'tb_toko.id = tb_permintaan.id_toko')
        ->where("tb_permintaan.status", $status)
        ->distinct()
        ->get('tb_permintaan')->result();
    }
  function cari_status_kirim($status)
    {
      return $this->db
        ->select('tb_pengiriman.*,tb_toko.nama_toko as nama_toko')
        ->join('tb_toko', 'tb_toko.id = tb_pengiriman.id_toko')
        ->where("tb_pengiriman.status", $status)
        ->distinct()
        ->get('tb_pengiriman')->result();
    }
  function cari_tgl($tgl_awal,$tgl_akhir)
    {
      return $this->db
        ->select('tb_permintaan.*,tb_toko.nama_toko as nama_toko')
        ->join('tb_toko', 'tb_toko.id = tb_permintaan.id_toko')
        ->where("tb_permintaan.created_at >=", $tgl_awal)
        ->where("tb_permintaan.created_at <=", $tgl_akhir)
        ->distinct()
        ->get('tb_permintaan')->result();
    }
  function cari_all()
    {
      return $this->db
        ->select('tb_permintaan.*,tb_toko.nama_toko')
        ->join('tb_toko', 'tb_toko.id = tb_permintaan.id_toko')
        ->get('tb_permintaan')->result();
    }
    // all kirim
  function cari_all_kirim()
    {
      return $this->db
        ->select('tb_pengiriman.*,tb_toko.nama_toko')
        ->join('tb_toko', 'tb_toko.id = tb_pengiriman.id_toko')
        ->get('tb_pengiriman')->result();
    }

    // =============== untuk Retur ==================
  // menampilkan data retur yang baru
   public function get_data_retur()
  {
    return $this->db->select('tb_retur.*, tb_toko.nama_toko, tb_toko.alamat, tb_toko.telp, tb_user.username')
      ->join('tb_toko', 'tb_retur.id_toko = tb_toko.id')
      ->join('tb_user', 'tb_retur.id_user = tb_user.id', 'left')
      ->order_by('(CASE WHEN tb_retur.status = 6 THEN 0 ELSE 1 END), tb_retur.status', 'asc')
      ->where_in('tb_retur.status', [3, 4, 6, 13, 14, 15])
      ->distinct()
      ->get('tb_retur');
  }
  // menampilkan data detail retur
  public function get_retur($no_retur)
  {
     return  $this->db->select('tb_retur.*,tb_toko.nama_toko,tb_toko.alamat,tb_toko.telp,tb_user.username')
     ->join('tb_toko', 'tb_retur.id_toko = tb_toko.id') //mengambil data toko
     ->join('tb_user', 'tb_retur.id_user = tb_user.id','left') //mengambil data toko
     ->order_by('tb_retur.id','desc')
     ->where('tb_retur.id',$no_retur)
     ->distinct()
     ->get('tb_retur');
  }
  // lihat berdasarkan detail permintaan
  public function get_detail_retur($no_retur)
  {
    $query = $this->db
    ->select('tb_retur_detail.*,tb_produk.id as id_produk,tb_retur.foto_resi,tb_retur.no_resi,tb_produk.kode as kode,tb_produk.nama_produk,tb_produk.satuan')
    ->from('tb_retur_detail')
    ->JOIN('tb_retur','tb_retur.id = tb_retur_detail.id_retur ')
    ->JOIN('tb_produk','tb_produk.id = tb_retur_detail.id_produk ')
    ->where('tb_retur_detail.id_retur',$no_retur)
    ->get();
    return $query->result();
  }

  // proses input ke tb retur
  public function terima_retur($data_retur,$where_retur)
  {
    return $this->db
    ->where($where_retur)
    ->update('tb_retur', $data_retur);
  }
 

}

?>
