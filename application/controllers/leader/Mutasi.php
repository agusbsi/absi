<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mutasi extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "3" && $role != "6"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_adm_gudang');
    $this->load->model('M_produk');
  }

  public function index()
  {
    $id_leader = $this->session->userdata('id');
    $data['title'] = 'Mutasi Barang';
    $data['list_data']  = $this->db->query("SELECT tm.*, tt.nama_toko as asal, tk.nama_toko as tujuan from tb_mutasi tm
    join tb_toko tt on tm.id_toko_asal = tt.id
    join tb_toko tk on tm.id_toko_tujuan = tk.id
    where tm.id_user = '$id_leader'
    order by tm.created_at desc")->result();
    $this->template->load('template/template', 'leader/mutasi/lihat_data', $data);
  }
   // pengiriman
   public function add()
   {
    $data['title'] = 'Mutasi Barang';
    $id_leader = $this->session->userdata('id');
    $id_toko = $this->input->get('id');
    $data['kode_mutasi'] = $this->M_adm_gudang->kode_mutasi();
    $data['list_toko'] = $this->db->query("SELECT * from tb_toko where status ='1' and id_leader='$id_leader'")->result();
    $data['toko_tujuan'] = $this->db->query("SELECT * from tb_toko where status ='1' and id != '$id_toko'")->result();  
    $this->template->load('template/template', 'leader/mutasi/add', $data);      
   }
  // ambil data ajax untuk wilayah
  function list_produk($id_toko)
	{
    	$query = $this->db->query("SELECT ts.*, tp.kode, tp.id as id_p from tb_stok ts
      join tb_produk tp on ts.id_produk = tp.id
      where ts.id_toko = '$id_toko'");
    	$data = "<option value='' selected>- Pilih Artikel -</option>";
    	foreach ($query->result() as $value) {
        	$data .= "<option value='".$value->id_p."'>".$value->kode."</option>";
    	}
    	echo $data;
	}
  // tampilkan detail produk
  public function tampilkan_detail_produk($id)
  {
    $id_toko = $this->input->get('id_toko');
    $data_produk = $this->db->query("SELECT ts.*, tp.nama_produk, tp.kode, tp.satuan from tb_stok ts
    join tb_produk tp on ts.id_produk = tp.id
    where ts.id_produk = '$id' and ts.id_toko = '$id_toko'")->row();
    echo json_encode($data_produk);
  }
  // menampilkan keranjang
  public function keranjang()
  {
    $this->load->view('leader/mutasi/keranjang');
  }
  // proses add mutasi
  function proses_add()
  {
    $id_leader = $this->session->userdata('id');
    $id_produk  = $this->input->post('id_produk_hidden');
    $qty  = $this->input->post('qty_hidden');
    $no_mutasi  = $this->input->post('no_mutasi');
    $jumlah = count($this->input->post('id_produk_hidden'));
      $this->db->trans_start();
       $mutasi = [
           'id' => $this->input->post('no_mutasi'),
           'id_toko_asal' => $this->input->post('toko_asal'),
           'id_toko_tujuan' => $this->input->post('toko_tujuan'),
           'id_user' => $id_leader,
           'status' => '0',
       ];
       for ($i=0; $i < $jumlah ; $i++) { 
        $d_id_produk = $id_produk[$i];
        $d_qty = $qty[$i];
        $mutasi_detail = array(
          'id_mutasi' =>  $no_mutasi,
          'id_produk' =>  $d_id_produk,
          'qty' =>  $d_qty,
          );
        $this->db->insert('tb_mutasi_detail',$mutasi_detail);
       }
       $this->db->insert('tb_mutasi',$mutasi);
       $this->db->trans_complete();
       $hp = $this->db->query("SELECT no_telp FROM tb_user WHERE id = 132")->row();
       $phone = $hp->no_telp;
       $message = "Anda memiliki 1 Permintaan Mutasi baru dengan nomor ( ".$no_mutasi." ) yang perlu approve silahkan kunjungi s.id/absi-app";
       kirim_wa($phone,$message);
       tampil_alert('success','Berhasil','Mutasi Barang berhasil di buat. !');
       redirect(base_url('leader/Mutasi'));
  }
  // print sppr
  public function mutasi_print($mutasi)
  {
    $data['title'] = 'Surat Perintah Pengambilan retur Konsinyasi';
    $data['mutasi'] = $this->db->query("SELECT tm.*,tu.nama_user as leader, tt.nama_toko as asal, tk.nama_toko as tujuan, tt.alamat as alamat_asal, tk.alamat as alamat_tujuan from tb_mutasi tm
      join tb_toko tt on tm.id_toko_asal = tt.id
      join tb_toko tk on tm.id_toko_tujuan = tk.id
      join tb_user tu on tm.id_user = tu.id
      where tm.id = '$mutasi'")->row();
      $data['detail_mutasi']  = $this->db->query("SELECT tmd.*, tp.nama_produk, tp.kode, tp.satuan from tb_mutasi_detail tmd
      join tb_produk tp on tmd.id_produk = tp.id
      where tmd.id_mutasi = '$mutasi' and tmd.status = '1'")->result();
    $this->load->view('leader/mutasi/mutasi_print',$data);
  }

  
}

?>
