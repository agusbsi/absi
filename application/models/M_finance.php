<?php 
class M_finance extends CI_Model
{
	function cari_penjualan_detail($tgl_awal,$tgl_akhir,$toko)
    {
      return $this->db
        ->select('tb_penjualan.*,tb_toko.nama_toko as nama_toko,tb_penjualan_detail.qty,tb_penjualan_detail.harga,tb_produk.kode,tb_penjualan_detail.diskon_promo')
        ->join('tb_toko', 'tb_toko.id = tb_penjualan.id_toko')
        ->join('tb_penjualan_detail','tb_penjualan.id = tb_penjualan_detail.id_penjualan')
        ->join('tb_produk','tb_penjualan_detail.id_produk = tb_produk.id')
        ->where("tb_penjualan.tanggal_penjualan >=", $tgl_awal)
        ->where("tb_penjualan.tanggal_penjualan <=", $tgl_akhir)
        ->where("tb_penjualan.id_toko",$toko)
        ->distinct()
        ->get('tb_penjualan')->result();
    }
    function cari_penjualan($tgl_awal,$tgl_akhir,$toko)
    {
      return $this->db
        ->select('tb_penjualan.*,tb_toko.nama_toko, tb_toko.diskon, wilayah_kecamatan.nama as daerah')
        ->join('tb_toko', 'tb_toko.id = tb_penjualan.id_toko')
        ->join('wilayah_kecamatan','tb_toko.kecamatan = wilayah_kecamatan.id')
        ->where("tb_penjualan.tanggal_penjualan >=", $tgl_awal)
        ->where("tb_penjualan.tanggal_penjualan <=", $tgl_akhir)
        ->where("tb_penjualan.id_toko",$toko)
        ->distinct()
        ->get('tb_penjualan')->row();
    }

}

?>