<?php
class M_spg extends CI_Model
{
  var $tb_spg   = 'tb_user_toko as a';
  var $tb_produk   = 'tb_produk as b';
  var $tb_stok   = 'tb_stok as c';
  var $tb_toko = 'tb_toko as d';

      public function __construct()
      {
      parent::__construct();
      $this->load->database();
      }

      public function select($tabel)
      {
        $query = $this->db->get($tabel);
        return $query->result();
      }
      public function get_produk_by_id($id_produk)
      {
        $this->db->where_in('id',explode(',', $id_produk));
        $query = $this->db->get('tb_produk');
        return $query->result_array();
      }

      // mengambil toko berdasarkan id
      public function get_toko($id_toko)
      {
        return  $this->db->select('tb_toko.*,tb_grup.nama_grup,tb_user.nama_user')
        ->join('tb_info', 'tb_toko.id = tb_info.id_toko') //mengambil data toko
        ->join('tb_grup', 'tb_info.id_grup = tb_grup.id') //mengambil data grup
        ->join('tb_user', 'tb_toko.id_spg = tb_user.id') //mengambil data toko
        ->where('tb_toko.id',$id_toko)
        ->distinct()
        ->get('tb_toko');
      }
      // mengambil profil toko berdasarkan id
      public function get_profil_toko($id_toko)
      {
        $query = $this->db
        ->select('tb_toko.id as id_toko,tb_toko.nama_toko,tb_toko.alamat,tb_toko.telp,tb_user.nama_user,tb_toko.deskripsi')
        ->from('tb_toko') //mengambil data toko
        ->join('tb_user', 'tb_toko.id_spg = tb_user.id') //mengambil data toko
        ->where('tb_toko.id',$id_toko)
        ->get();
        return $query->result();
      }
      // mengambil stok produk per toko user
      public function get_stok_produk()
      {
        $id_toko = $this->session->userdata('id_toko');
        $query = $this->db
        ->select('tb_stok.*,tb_produk.nama_produk,tb_produk.kode, tb_produk.satuan,tb_produk.id as id_produk')
        ->from('tb_stok')
        ->join('tb_produk', 'tb_stok.id_produk = tb_produk.id') //mengambil data toko
        ->where('tb_stok.id_toko',$id_toko)
        // ->where('tb_stok.qty > 0')
        // ->ORDER_BY ('tb_stok.qty','Desc')
        ->get();
        return $query->result();
      }
        // cek total Produk yang dikirm
      public function produk_toko($id_toko)
      {
          return $this->db->select('sum(tb_stok.qty) as total')
          ->join('tb_toko','tb_toko.id = tb_stok.id_toko')
          ->where('tb_stok.id_toko',$id_toko)
          ->from('tb_stok')->get()->row();
      }
      // kode retur
      public function kode_retur()
      {
        $q = $this->db->query("SELECT MAX(RIGHT(id,3)) AS kd_max FROM tb_retur WHERE DATE(created_at)=CURDATE()");
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
          return "R-".date('ymd')."-".$kd;
        }
      // Kode BAP
      public function kode_bap()
      {
        $q = $this->db->query("SELECT MAX(RIGHT(id,3)) AS kd_max FROM tb_bap WHERE DATE(created_at)=CURDATE()");
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
          return "BAP-".date('ymd')."-".$kd;
        }
      // kode SO
      public function kode_so()
      {
        $q = $this->db->query("SELECT MAX(RIGHT(id,3)) AS kd_max FROM tb_so WHERE DATE(created_at)=CURDATE()");
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
          return "SO-".date('ymd')."-".$kd;
        }
      // data stok
      public function data_stok()
      {
        $userId = $this->session->userdata('id');
        //$toko_id = $this->db->query("SELECT id_toko FROM tb_spg WHERE id_user = $id")->row()->id_toko; 
        $this->db->select('b.kode,b.nama_produk,b.satuan,c.qty');
        $this->db->from($this->tb_stok);
        $this->db->join($this->tb_produk, 'c.id_produk = b.id');
        $this->db->join($this->tb_toko, 'd.id = c.id_toko');
        $this->db->where('d.id', '(SELECT id_toko FROM tb_user_toko WHERE id_user = '.$userId.')', false);
        $this->db->where('b.deleted_at', null);
        $query = $this->db->get();
        return $query->result();
      }

      public function invoice()
      {
        $q = $this->db->query("SELECT MAX(RIGHT(id,3)) AS kd_max FROM tb_permintaan WHERE DATE(created_at)=CURDATE()");
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
        return "PM-".date('ymd')."-".$kd;
      }

      // START PENJUALAN
      public function kode_penjualan()
      {
       $q = $this->db->query("SELECT MAX(RIGHT(id,3)) AS kd_max FROM tb_penjualan WHERE DATE(created_at)=CURDATE()");
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
        return "PJ-".date('ymd')."-".$kd;
      }
      // END PENJUALAN
      public function user_toko($id)
      {
        $q = $this->db->query("SELECT * from tb_user_toko ut
          join tb_toko tk on tk.id = ut.id_toko
          join tb_user us on us.id = ut.id_user
          where us.id= '$id'");

        return $q;
      }

      // modul penerimaan
      // lihat data penerimaan
      public function get_penerimaan($id_toko)
      {
        return  $this->db->select('tb_pengiriman.*,tb_toko.nama_toko')
        ->join('tb_toko', 'tb_pengiriman.id_toko = tb_toko.id') //mengambil data toko
        ->order_by('tb_pengiriman.created_at','desc')
        ->where ('tb_pengiriman.id_toko',$id_toko)
        ->where ('tb_pengiriman.status != 0')
        ->get('tb_pengiriman');
      }
      
      // menampilkan data detail terima
      public function get_terima($no_penerimaan,$id_toko)
      {
        return  $this->db->select('tb_pengiriman.*,tb_toko.nama_toko,tb_toko.alamat,tb_toko.telp,tb_user.username')
        ->join('tb_toko', 'tb_pengiriman.id_toko = tb_toko.id') //mengambil data toko
        ->join('tb_user', 'tb_pengiriman.id_user = tb_user.id','left') //mengambil data toko
        ->order_by('tb_pengiriman.id','desc')
        ->where('tb_pengiriman.id',$no_penerimaan)
        ->where('tb_pengiriman.id_toko',$id_toko)
        ->distinct()
        ->get('tb_pengiriman');
      }
      // lihat berdasarkan detail terima
      public function get_detail_terima($no_penerimaan,$id_toko)
      {
        $query = $this->db
        ->select('tb_pengiriman_detail.*,tb_produk.kode,tb_produk.nama_produk,tb_produk.satuan')
        ->from('tb_pengiriman_detail')
        ->JOIN('tb_pengiriman','tb_pengiriman.id = tb_pengiriman_detail.id_pengiriman ')
        ->JOIN('tb_produk','tb_produk.id = tb_pengiriman_detail.id_produk ')
        ->where('tb_pengiriman_detail.id_pengiriman',$no_penerimaan)
        ->where('tb_pengiriman.id_toko',$id_toko)
        ->where('tb_pengiriman_detail.qty != 0')
        ->get();
        return $query->result();
      }
       // proses terima barang
      public function terima_barang($data_terima,$where_terima)
      {
        return $this->db
        ->where($where_terima)
        ->update('tb_pengiriman', $data_terima);
      }
      // list kirim untuk reut
      public function list_kirim($id_toko)
      {
        $query = $this->db->query("SELECT *  from tb_pengiriman  where id_toko = '$id_toko' and status = '1' and id NOT IN (SELECT id_pengiriman from tb_retur)  order by id desc");
        return  $query;
      }
        // list detail untuk retur
      function barang_list($id,$id_toko)
      {
        $query = $this->db
        ->select('tb_pengiriman.*,tb_produk.id as id_produk,tb_produk.kode,tb_produk.nama_produk,tb_stok.qty as stok,tb_pengiriman_detail.qty_diterima')
        ->from('tb_pengiriman')
        ->JOIN('tb_pengiriman_detail','tb_pengiriman.id = tb_pengiriman_detail.id_pengiriman ')
        ->JOIN('tb_produk','tb_produk.id = tb_pengiriman_detail.id_produk ')
        ->JOIN('tb_stok','tb_stok.id_produk = tb_pengiriman_detail.id_produk ')
        ->where('tb_pengiriman.id',$id)
        ->where('tb_pengiriman.id_toko',$id_toko)
        ->where('tb_stok.id_toko',$id_toko)
        ->get();
        return $query->result();

      }


    }


 ?>