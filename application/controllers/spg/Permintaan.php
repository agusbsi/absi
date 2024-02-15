
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permintaan extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "4"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url());
      exit();
    }

    $this->load->model('M_spg');
    $this->load->model('M_produk');
  }


  public function index()
  {
    $id_toko = $this->session->userdata('id_toko');
    $data['title'] = 'Permintaan Barang';
    $data['list_permintaan'] = $this->db->query("SELECT * from tb_permintaan where id_toko = '$id_toko' order by id Desc")->result();
    $this->template->load('template/template', 'spg/permintaan/index', $data);
  }

  public function detail($id)
  {
    $data['title'] = 'Permintaan Barang';
    $data_permintaan = $this->db->query("SELECT tp.*, tt.nama_toko, tu.username from tb_permintaan tp join tb_toko tt on tt.id = tp.id_toko join tb_user tu on tu.id = tp.id_user where tp.id = '$id'")->row();
    $data['detail_permintaan'] = $this->db->query("SELECT * from tb_permintaan_detail tpd join tb_produk tp on tp.id = tpd.id_produk where tpd.id_permintaan = '$id'")->result();

    // $data['detail_pengiriman'] = $this->db->query("SELECT tb_produk.kode, tb_produk.nama_produk, tb_permintaan_detail.qty, tb_pengiriman_detail.qty_diterima FROM tb_pengiriman_detail JOIN tb_pengiriman ON tb_pengiriman.id = tb_pengiriman_detail.id_pengiriman JOIN tb_permintaan ON tb_permintaan.id = tb_pengiriman.id_permintaan JOIN tb_permintaan_detail ON tb_permintaan_detail.id_permintaan = tb_permintaan.id join tb_produk on tb_produk.id = tb_permintaan_detail.id_produk WHERE tb_permintaan.id = '$id' group by tb_permintaan_detail.id_produk")->result();    

    $data['no_permintaan'] = $id;
    $data['tanggal'] = $data_permintaan->created_at;
    $data['status'] = $data_permintaan->status;
    $data['nama_toko'] = $data_permintaan->nama_toko;
    $data['nama'] = $data_permintaan->username;
    $this->template->load('template/template', 'spg/permintaan/detail', $data);
  }

  public function tampilkan_detail_produk()
  {
    $id = $this->input->post('id');
    $toko = $this->input->post('toko');
    $ssr = $this->db->query("SELECT ssr from tb_toko where id = '$toko'")->row()->ssr;
    $data_produk = $this->db->query("
        SELECT tb_produk.*, tb_stok.qty, COALESCE(ROUND(AVG(penjualan_3_bulan.qty), 0), 0) * '$ssr' as ssr
        FROM tb_produk
        LEFT JOIN tb_stok ON tb_produk.id = tb_stok.id_produk AND tb_stok.id_toko = '$toko'
        LEFT JOIN (
            SELECT tb_penjualan_detail.id_produk, AVG(tb_penjualan_detail.qty) as qty
            FROM tb_penjualan_detail
            JOIN tb_penjualan ON tb_penjualan_detail.id_penjualan = tb_penjualan.id
            WHERE tb_penjualan.id_toko = '$toko'
                AND tb_penjualan.tanggal_penjualan >= DATE_SUB(NOW(), INTERVAL 3 MONTH)
            GROUP BY tb_penjualan_detail.id_produk
        ) as penjualan_3_bulan ON tb_produk.id = penjualan_3_bulan.id_produk
        WHERE tb_stok.id_toko = '$toko' AND tb_stok.id_produk = '$id'
        GROUP BY tb_produk.id
    ")->row();
    echo json_encode($data_produk);
  }
  public function tambah_permintaan()
  {
    if ($this->session->userdata('cart') != "Permintaan") {
      $this->cart->destroy();
    }
    $data['title'] = 'Permintaan Barang';
    $data['no_permintaan'] = $this->M_spg->invoice(); // generate no permintaan
    $id_toko = $this->session->userdata('id_toko');
    $data['toko_new'] = $this->db->query("SELECT * from tb_toko where id = '$id_toko'")->row();
    $data['data_cart'] = $this->cart->contents(); // menampilkan data cart
    $data['list_produk'] = $this->db->query("SELECT tp.id,tp.kode from tb_stok ts
    join tb_produk tp on ts.id_produk = tp.id
    where ts.id_toko = '$id_toko' and tp.status = 1")->result();
    $this->template->load('template/template', 'spg/permintaan/tambah_permintaan', $data);
  }

public function tambah_cart()
  {
    $id = $this->input->post('id');
    $qty = $this->input->post('qty');
    $keterangan = $this->input->post('keterangan');
    $produk = $this->M_produk->get_by_id($id);
    $data = array(
      'id'      => $id,
      'qty'     => $qty,
      'price'   => "",
      'name'    => $produk->id,
      'options' => $produk->kode,
      'satuan'  => $keterangan
    );
    $this->cart->insert($data);
    $this->session->set_userdata('cart', 'Permintaan');
    redirect(base_url('spg/permintaan/tambah_permintaan'));
  }

  public function hapus_cart($id)
  {
    $this->cart->remove($id);

    redirect(base_url('spg/permintaan/tambah_permintaan'));
  }

  public function reset_cart()
  {
    $this->cart->destroy();

    redirect(base_url('spg/tambah_permintaan'));
  }

 public function kirim_permintaan()
  {
    $id_user = $this->session->userdata('id');
    $id_toko = $this->session->userdata('id_toko');
    $id_permintaan = $this->M_spg->invoice();
    $data = array(
      'id' => $id_permintaan,
      'id_toko' => $id_toko,
      'id_user' => $id_user,
    );

    $this->db->trans_start();
    $this->db->insert('tb_permintaan', $data);
    $data_cart = $this->cart->contents();
    foreach ($data_cart as $d) {
      $data = array(
        'id_permintaan' => $id_permintaan,
        'id_produk' => $d['id'],
        'keterangan' => $d['satuan'],
        'qty' => $d['qty'],
      );
      $this->db->insert('tb_permintaan_detail', $data);
    }
    $this->db->trans_complete();
    $this->cart->destroy();
    $got_lead = $this->db->query("SELECT id_leader FROM tb_toko WHERE id = '$id_toko' AND id_spg = '$id_user'")->row();
    $id_lead = $got_lead->id_leader;
    $hp = $this->db->query("SELECT no_telp FROM tb_user WHERE id = '$id_lead'")->row();
    $phone = $hp->no_telp;
    $message = "Anda memiliki 1 Permintaan Barang baru dengan nomor ( " . $id_permintaan . " ) yang perlu approve silahkan kunjungi s.id/absi-app";
    kirim_wa($phone, $message);
    tampil_alert('success', 'Berhasil', 'Data berhasil disimpan !');
    redirect(base_url('spg/Permintaan'));
  }
 
}
?>
