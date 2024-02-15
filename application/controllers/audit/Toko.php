<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toko extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "10"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_spv');
  }

  // tampil data Aset
 public function index()
  {
    $data['title'] = 'Master Toko';
    $data['toko'] = $this->db->query("SELECT tt.*, tu.nama_user
    from tb_toko tt
    left join tb_user tu on tt.id_spg = tu.id
    ORDER BY tt.status = 3 DESC, tt.status = 4 DESC,tt.status = 2 DESC, tt.id DESC")->result();
    $this->template->load('template/template', 'audit/toko/lihat_data', $data);
  }
 
   // Script profil toko
   public function profil($id_toko)
   {
     $id_spv = $this->session->userdata('id');
     $data['title']         = 'Master Toko';
     $data['toko']          = $this->db->query("SELECT tt.*, tp.nama as provinsi,tk.nama as kabupaten,tc.nama as kecamatan, tt.provinsi as id_provinsi from tb_toko tt
     join wilayah_provinsi tp on tt.provinsi = tp.id
     join wilayah_kabupaten tk on tt.kabupaten = tk.id
     join wilayah_kecamatan tc on tt.kecamatan = tc.id
     where tt.id = '$id_toko'")->row();
     //  lihat SPV toko
    $data['spv']   = $this->db->query("SELECT tt.*, tb_user.nama_user
    from tb_toko tt
    left join tb_user on tt.id_spv = tb_user.id
    where tt.id = '$id_toko'
    ")->row();
    //  lihat leader toko
    $data['leader_toko']   = $this->db->query("SELECT tt.*, tb_user.nama_user
    from tb_toko tt
    left join tb_user on tt.id_leader = tb_user.id
    where tt.id = '$id_toko'
    ")->row();
    //  lihat spg
    $data['spg']   = $this->db->query("SELECT tt.*,tb_user.nama_user 
    from tb_toko tt
    left join tb_user on tt.id_spg = tb_user.id
    where tt.id = '$id_toko'
    ")->row();
    //  cek status di stok masing" toko
    $data['cek_status_stok']  = $this->db->query("SELECT status from tb_stok where id_toko = '$id_toko' and status = 2 ")->num_rows();
    //  stok produk per toko
     $data['stok_produk']   = $this->db->query("SELECT tb_produk.nama_produk, tb_produk.satuan, tb_stok.*, tb_produk.kode, tb_produk.harga_jawa, tb_produk.harga_indobarat, tb_toko.diskon  from tb_stok
     join tb_produk on tb_stok.id_produk = tb_produk.id
     join tb_toko on tb_stok.id_toko = tb_toko.id
     where tb_stok.id_toko = '$id_toko'")->result();
   // cek status toko
   $data['cek_status'] = $this->db->query("SELECT status from tb_toko where id = '$id_toko'")->row();
     $this->template->load('template/template', 'audit/toko/profil', $data);
   }

  //  toko baru
  public function toko_baru()
  {
    $data['title'] = 'Kelola Toko_new';
    $data['toko'] = $this->db->query("SELECT tt.*, tu.nama_user
    from tb_toko tt
    left join tb_user tu on tt.id_spv = tu.id
    where tt.status = '2'
    order by tt.id desc")->result();
    $this->template->load('template/template', 'audit/toko/toko_baru', $data);
  }
  // profil toko baru
  public function profil_baru($id_toko)
   {
     $cek_status = $this->db->query("SELECT status from tb_toko where id = '$id_toko'")->row();
     if ($cek_status->status == 1){
      tampil_alert('info','TOKO SUDAH AKTIF','Toko sudah di approve Oleh Tim Audit.');
      redirect('audit/Toko/');
     }else if ($cek_status->status == 0)
     {
      tampil_alert('info','TOKO NON AKTIF','Toko telah di non aktifkan.');
      redirect('audit/Toko/');
     }
     $data['title']         = 'Kelola Toko_new';
     $data['toko']          = $this->db->query("SELECT * from tb_toko
     where id = '$id_toko'")->row();
     //  lihat SPV toko
    $data['spv']   = $this->db->query("SELECT tt.*, tb_user.nama_user
    from tb_toko tt
    left join tb_user on tt.id_spv = tb_user.id
    where tt.id = '$id_toko'
    ")->row();
    //  lihat leader toko
    $data['leader_toko']   = $this->db->query("SELECT tt.*, tb_user.nama_user
    from tb_toko tt
    left join tb_user on tt.id_leader = tb_user.id
    where tt.id = '$id_toko'
    ")->row();
    //  lihat spg
    $data['spg']   = $this->db->query("SELECT tt.*,tb_user.nama_user 
    from tb_toko tt
    left join tb_user on tt.id_spg = tb_user.id
    where tt.id = '$id_toko'
    ")->row();
    //  stok produk per toko
     $data['stok_produk']   = $this->db->query("SELECT tb_produk.nama_produk, tb_produk.satuan, tb_stok.qty, tb_produk.kode as id_produk from tb_stok
     join tb_produk on tb_stok.id_produk = tb_produk.id
     where tb_stok.id_toko = '$id_toko'")->result();
  
     $this->template->load('template/template', 'audit/toko/profil_baru', $data);
   }

  //  approve toko
  public function approve()
  {
    $id_toko = $this->input->post('id_toko');
    $keterangan = $this->input->post('keterangan');
    $approve = $this->input->post('approve');
    if ($approve == 1) {
      $status = 4;
    } elseif ($approve == 0) {
      $status = 5;
    }
    $this->db->query("UPDATE tb_toko set status = '$status', catatan_audit = '$keterangan' where id = '$id_toko'");
    tampil_alert('success','Berhasil','Data berhasil disimpan !');
    redirect(base_url('audit/Toko'));
  }
  //  reject toko
  public function reject()
  {
    $id_toko = $this->input->post('id_toko');
    $catatan_audit = $this->input->post('catatan_audit');
    $this->db->query("UPDATE tb_toko set status = '5', catatan_audit = '$catatan_audit' where id = '$id_toko'");
    echo "1";
  }
 
   // download pdf
   public function unduh_pdf($id_toko)
   {
       // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
       $this->load->library('pdfgenerator');
       // title dari pdf
       $data['title_pdf'] = 'Berkas Toko';
       // filename dari pdf ketika didownload
       $file_pdf = 'Berkas_toko';
       // setting paper
       $paper = 'A4';
       //orientasi paper potrait / landscape 
       $orientation = "portrait";
       // menampilkan Data Toko
       $data['data_toko'] = $this->db->query("SELECT tt.*, tp.nama as provinsi,tk.nama as kabupaten,tc.nama as kecamatan, tt.provinsi as id_provinsi from tb_toko tt
        join wilayah_provinsi tp on tt.provinsi = tp.id
        join wilayah_kabupaten tk on tt.kabupaten = tk.id
        join wilayah_kecamatan tc on tt.kecamatan = tc.id
        where tt.id = '$id_toko'")->row();
        // nama Customer
       $data['customer']   = $this->db->query("SELECT tc.* from tb_customer tc
       join tb_toko on tc.id = tb_toko.id_customer
       where tb_toko.id = '$id_toko'")->row();
      // nama spv
      $data['spv']   = $this->db->query("SELECT tt.*, tb_user.nama_user
        from tb_toko tt
        left join tb_user on tt.id_spv = tb_user.id
        where tt.id = '$id_toko'
        ")->row();
        //  lihat leader toko
      $data['leader_toko']   = $this->db->query("SELECT tt.*, tb_user.nama_user
      from tb_toko tt
      left join tb_user on tt.id_leader = tb_user.id
      where tt.id = '$id_toko'
      ")->row();
      //  lihat spg
      $data['spg']   = $this->db->query("SELECT tt.*,tb_user.nama_user 
      from tb_toko tt
      left join tb_user on tt.id_spg = tb_user.id
      where tt.id = '$id_toko'
      ")->row();
       $html = $this->load->view('audit/toko/unduh',$data, true);	 
       // run dompdf
       $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
   }
   
   public function unduh_excel($id_toko)
   {    

      // menampilkan Data Toko
       $data['data_toko'] = $this->db->query("SELECT tt.*, tp.nama as provinsi,tk.nama as kabupaten,tc.nama as kecamatan, tt.provinsi as id_provinsi from tb_toko tt
        join wilayah_provinsi tp on tt.provinsi = tp.id
        join wilayah_kabupaten tk on tt.kabupaten = tk.id
        join wilayah_kecamatan tc on tt.kecamatan = tc.id
        where tt.id = '$id_toko'")->row();
        // nama Customer
       $data['customer']   = $this->db->query("SELECT tc.* from tb_customer tc
       join tb_toko on tc.id = tb_toko.id_customer
       where tb_toko.id = '$id_toko'")->row();
      // nama spv
      $data['spv']   = $this->db->query("SELECT tt.*, tb_user.nama_user
        from tb_toko tt
        left join tb_user on tt.id_spv = tb_user.id
        where tt.id = '$id_toko'
        ")->row();
        //  lihat leader toko
      $data['leader_toko']   = $this->db->query("SELECT tt.*, tb_user.nama_user
      from tb_toko tt
      left join tb_user on tt.id_leader = tb_user.id
      where tt.id = '$id_toko'
      ")->row();
      //  lihat spg
      $data['spg']   = $this->db->query("SELECT tt.*,tb_user.nama_user 
      from tb_toko tt
      left join tb_user on tt.id_spg = tb_user.id
      where tt.id = '$id_toko'
      ")->row();
       $this->load->view('audit/toko/unduh_excel',$data);
   }
// list SO Adjust
  public function list_adjust()
  {
    $data['title'] = 'Adjust SO';
    $data['so'] = $this->db->query("SELECT ts.*, tt.nama_toko from tb_so_audit ts
    join tb_toko tt on ts.id_toko = tt.id")->result();
    $this->template->load('template/template', 'audit/toko/list_adjust', $data);
  }
  //  ADJUST SO TOKO
  public function adjust_so()
  {
    $data['title'] = 'Adjust SO';
    $data['list_toko']  = $this->db->query("SELECT * from tb_toko where  status = 1")->result();
    $data['kode_retur'] = $this->kode_so(); 
    $data['list_aset']  = $this->db->query("SELECT * from tb_aset where status = 1 order by nama_aset asc")->result();
    $this->template->load('template/template', 'audit/toko/adjust_so', $data);
  }
   // kode retur
   public function kode_so()
   {
     $q = $this->db->query("SELECT MAX(RIGHT(id,3)) AS kd_max FROM tb_so_audit");
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
       return "SO-".date('Y')."-".$kd;
     }
  // cek list artikel
  public function artikelToko()
  {
    $id_toko   = $this->input->get('id_toko');
    $data = $this->db->query("SELECT ts.qty,ts.id_produk, tp.kode, tp.nama_produk from tb_stok ts
     join tb_produk tp on ts.id_produk = tp.id
     where id_toko = '$id_toko'")->result();
    echo json_encode($data);
  }
  // simpan hasil so audit
  public function simpan_so_audit()
  {
        $id_user      = $this->session->userdata('id');
        $id_produk    = $this->input->post('id_produk');
        $qty_sistem   = $this->input->post('qty_sistem');
        $qty_input    = $this->input->post('qty_input');
        $no_audit     = $this->input->post('no_audit');
        $catatan      = $this->input->post('catatan');
        $id_toko      = $this->input->post('id_toko');

        // Validate the data or perform any other necessary checks
        $this->db->trans_start();
        // Process the data and insert into the database
        $insertedRows = 0;
        foreach ($id_produk as $index => $id) {
            $data = array(
                'id_produk' => $id,
                'qty_sistem' => $qty_sistem[$index],
                'qty_input' => $qty_input[$index],
                'id_so_audit' => $no_audit,
            );

            // Assuming you have a model to handle database interactions named "YourModel"
            $this->db->insert('tb_so_audit_detail',$data);
            $insertedRows++;
        }
        // simpan data so ke tb_so_audit
        $data_so = array(
          'id'  => $no_audit,
          'id_user'  => $id_user,
          'id_toko'  => $id_toko,
          'catatan'  => $catatan,
        );
        $this->db->insert('tb_so_audit',$data_so);
        $this->db->trans_complete();
        // Prepare the response
        $response = array(
            'success' => true,
            'message' => "Data successfully inserted. Rows inserted: " . $insertedRows,
        );

        // Send the response back to the client
        header('Content-Type: application/json');
        echo json_encode($response);
  }
  public function getdata()
   {
       // Mengambil parameter id_toko dari permintaan Ajax
       $id_penjualan = $this->input->get('id_penjualan');
   
       // Mengambil data artikel dari tabel tb_stok berdasarkan id_toko
       // Ganti dengan kode Anda untuk mengambil data dari database
       $artikel = $this->db->query("SELECT * from tb_so_audit_detail tpd
       join tb_produk tp on tpd.id_produk = tp.id
       where tpd.id_so_audit = '$id_penjualan'  order by tpd.id desc ");
   
       if ($artikel->num_rows() > 0) {
           $result = $artikel->result();
           header('Content-Type: application/json'); // Tambahkan header untuk menandakan bahwa respons adalah JSON
           echo json_encode($result);
       } else {
           header('Content-Type: application/json'); // Tambahkan header untuk menandakan bahwa respons adalah JSON
           echo json_encode(array());
       }
   }

}
?>
