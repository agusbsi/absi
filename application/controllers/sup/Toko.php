<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toko extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "6"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_admin');
    $this->load->model('M_support');
    $this->load->model('M_toko');
  }
  // halaman utama
  public function index()
  {
    $data['title'] = 'Master Toko';
    $data['list_data'] = $this->db->query("SELECT tb_toko.*,tb_user.nama_user FROM tb_toko 
    JOIN tb_user ON tb_toko.id_spv = tb_user.id 
    WHERE tb_toko.status != '0'")->result();
    $data['list_spv'] = $this->db->query("SELECT * FROM tb_user WHERE role = 2")->result();
    $data['id_toko'] = $this->M_support->kode_toko();
    $data['provinsi'] = $this->db->query("SELECT * from wilayah_provinsi")->result();
    $this->template->load('template/template', 'manager_mv/toko/index', $data);
  }
   // list toko tutup
  public function toko_tutup()
  {
    $id_spv = $this->session->userdata('id');
    $data['title'] = 'List Toko Tutup';
    $data['toko_tutup'] = $this->db->query("SELECT tr.id as id_retur, tr.created_at, tr.status, tt.nama_toko from tb_retur tr
    join tb_toko tt on tr.id_toko = tt.id
    where tr.status >= 10 order by tr.id desc")->result();
    $this->template->load('template/template', 'manager_mv/toko/toko_tutup', $data);
  }
  public function getdataRetur()
  {
    // Mengambil parameter id_toko dari permintaan Ajax
    $id_retur = $this->input->get('id_retur');
    $artikel = $this->db->query("SELECT trd.qty,tp.kode, tp.nama_produk from tb_retur_detail trd
      join tb_produk tp on trd.id_produk = tp.id
      where trd.id_retur = ?  order by tp.nama_produk desc ", array($id_retur));
    $aset = $this->db->query("SELECT tra.*, ta.nama_aset from tb_retur_aset tra
      join tb_aset ta on tra.id_aset = ta.id
      where tra.id_retur = ?  order by ta.nama_aset desc ", array($id_retur));
    $retur = $this->db->query("SELECT * from tb_retur where id = ?", array($id_retur))->row();

    $result = array();

    if ($artikel->num_rows() > 0) {
      $result['artikel'] = $artikel->result_array();
    } else {
      $result['artikel'] = array();
    }

    if ($aset->num_rows() > 0) {
      $result['aset'] = $aset->result_array();
    } else {
      $result['aset'] = array();
    }
    // Menambahkan data nama toko ke dalam hasil
    $result['catatan'] = $retur->catatan;
    $result['catatan_mv'] = $retur->catatan_mv;
    $result['tgl_tarik'] = $retur->tgl_jemput;
    $result['status'] = $retur->status;
    $result['id_toko'] = $retur->id_toko;

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
  }
  // halaman detail toko
  public function profil($id)
   {
     $where = array('id' => $id);
     $data['title'] = 'Master Toko';
     $data['detail'] = $this->M_admin->get_data('tb_toko',$where);
     //  lihat leader toko
     $data['spv_toko']   = $this->db->query("SELECT tt.*, tb_user.nama_user,tb_user.no_telp
     from tb_toko tt
     join tb_user on tt.id_spv = tb_user.id
     where tt.id = '$id' ")->result();
     //  lihat leader toko
     $data['leader_toko']   = $this->db->query("SELECT tt.*, tb_user.nama_user,tb_user.no_telp
     from tb_toko tt
     join tb_user on tt.id_leader = tb_user.id
     where tt.id = '$id' and tb_user.role = '3' ")->result();
     //  lihat SPG toko
     $data['spg_toko']   = $this->db->query("SELECT tt.*, tb_user.nama_user,tb_user.no_telp
     from tb_toko tt
     join tb_user on tt.id_spg = tb_user.id
     where tt.id = '$id' and tb_user.role = '4' ")->result();

     $data['last_update'] = $this->M_toko->last_update_stok($id);
     $data['cek_status'] = $this->db->query("SELECT status from tb_toko where id = '$id'")->row();
      //  cek status di stok masing" toko
    $data['cek_status_stok']  = $this->db->query("SELECT status from tb_stok where id_toko = '$id' and status = 2 ")->num_rows();
    //  stok produk per toko
    $data['stok_produk']   = $this->db->query("SELECT tb_produk.nama_produk, tb_produk.satuan, tb_produk.kode, tb_stok.*, tb_produk.harga_jawa, tb_produk.harga_indobarat, tb_toko.diskon from tb_stok
    join tb_produk on tb_stok.id_produk = tb_produk.id
    join tb_toko on tb_stok.id_toko = tb_toko.id
    where tb_stok.id_toko = '$id' order by tb_stok.qty desc")->result();
    $data['toko']          = $this->db->query("SELECT tt.*, tp.nama as provinsi,tk.nama as kabupaten,tc.nama as kecamatan, tt.provinsi as id_provinsi from tb_toko tt
    join wilayah_provinsi tp on tt.provinsi = tp.id
    join wilayah_kabupaten tk on tt.kabupaten = tk.id
    join wilayah_kecamatan tc on tt.kecamatan = tc.id
    where tt.id = '$id'")->row();
     $this->template->load('template/template', 'manager_mv/toko/lihat_toko', $data);
   }
  // halaman update toko
  public function update($id)
  {
    $data['title'] = 'Master Toko';
    $data['detail'] = $this->db->query("SELECT * from tb_toko where id = '$id'")->row();
    $data['provinsi'] = $this->db->query("SELECT * from wilayah_provinsi")->result();
    $data['kabupaten'] = $this->db->query("SELECT * from wilayah_kabupaten")->result();
    $data['kecamatan'] = $this->db->query("SELECT * from wilayah_kecamatan")->result();
    $this->template->load('template/template', 'manager_mv/toko/update',$data);
  }
  //  Update detail toko
  public function proses_update()
  {
    $id_toko        = $this->input->post('id_toko');
    $jenis_toko     = $this->input->post('jenis_toko');
    $pic            = $this->input->post('pic');
    $no_telp        = $this->input->post('no_telp');
    $tgl_so         = $this->input->post('tgl_so');
    $provinsi       = $this->input->post('provinsi');
    $kabupaten      = $this->input->post('kabupaten');
    $kecamatan      = $this->input->post('kecamatan');
    $alamat         = $this->input->post('alamat');
    $updated        = date('Y-m-d H:i:s');

    $data = array(
      'jenis_toko'  => $jenis_toko,
      'nama_pic'    => $pic,
      'telp'        => $no_telp,
      'tgl_so'      => $tgl_so,
      'provinsi'    => $provinsi,
      'kabupaten'   => $kabupaten,
      'kecamatan'   => $kecamatan,
      'alamat'      => $alamat,
      'updated_at'  => $updated
    );
    $where = array(
      'id'  => $id_toko
    );
    $this->db->update('tb_toko',$data,$where);
    tampil_alert('success','Berhasil','Data Toko berhasil di Perbaharui!');
    redirect(base_url('sup/Toko/update/'.$id_toko));
  }
  // update foto toko
  public function update_foto() 
  {
    $id_toko =  $this->input->post('id_toko_foto');
    $config['upload_path'] = 'assets/img/toko/';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['max_size'] = '2048';
    $config['file_name'] = $id_toko;
    $config['overwrite'] = TRUE;
    $config['remove_spaces'] = TRUE;
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    
    if (!$this->upload->do_upload('foto')) {
    
    } else {
      // Jika upload berhasil, simpan data foto ke database
      $foto = $this->upload->data('file_name');
      $id_toko =  $this->input->post('id_toko_foto');
      // simpan data foto ke database sesuai dengan id data yang ingin diupdate
      $this->db->query("UPDATE tb_toko set foto_toko ='$foto' where id='$id_toko'");
      $data['toko'] = $this->db->query("SELECT * from tb_toko where id = '$id_toko'")->row();
      $data['pesan'] = "berhasil di update";
      echo json_encode($data);
      
    }
  }
   // ambil data kab
   function add_ajax_kab($id_prov)
   {
       $query = $this->db->get_where('wilayah_kabupaten',array('provinsi_id'=>$id_prov));
       $data = "<option value=''>- Select Kabupaten -</option>";
       foreach ($query->result() as $value) {
           $data .= "<option value='".$value->id."'>".$value->nama."</option>";
       }
       echo $data;
   }
  //  ambil data kec
   function add_ajax_kec($id_kab)
   {
       $query = $this->db->get_where('wilayah_kecamatan',array('kabupaten_id'=>$id_kab));
       $data = "<option value=''>- Select Kecamatan -</option>";
       foreach ($query->result() as $value) {
           $data .= "<option value='".$value->id."'>".$value->nama."</option>";
       }
       echo $data;
   }
    // approve pengajuan tutup toko
  public function approveToko()
  {

    $no_retur = $this->input->post('id_retur');
    $id_toko = $this->input->post('id_toko');
    $catatan_mv = $this->input->post('catatan');
    $data = array(
      'catatan_mv'  => $catatan_mv,
      'status'  => 11,
      'updated_at' => date("Y-m-d")
    );
    $where = array(
      'id'  => $no_retur
    );
    $this->db->update('tb_retur', $data, $where);
    // ambil nama toko
    $get_toko = $this->db->query("SELECT nama_toko from tb_toko where id ='$id_toko'")->row()->nama_toko;
    $hp = $this->db->query("SELECT no_telp FROM tb_user WHERE role = 9")->row();
    $phone = $hp->no_telp;
    $message = "Anda memiliki pengajuan Tutup Toko untuk ( " . $get_toko . " ) silahkan kunjungi s.id/absi-app";
    kirim_wa($phone, $message);
    tampil_alert('success', 'Berhasil', 'Data Pengajuan berhasil di Approve!');
    redirect(base_url('sup/Toko/toko_tutup'));
  }
  public function tolakToko($id, $catatan)
  {

    $data = array(
      'catatan_mv'  => $catatan,
      'status'  => 16,
      'updated_at' => date("Y-m-d")
    );
    $where = array(
      'id'  => $id
    );
    $this->db->update('tb_retur', $data, $where);
    tampil_alert('success', 'DITOLAK', 'Data Pengajuan di Tolak!');
    redirect(base_url('sup/Toko/toko_tutup'));
  }
  
}
?>