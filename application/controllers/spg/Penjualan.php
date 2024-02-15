<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "4"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }

    $this->load->model('M_spg');
    $this->load->model('M_produk');
  }


  public function index()
  {
    $id_toko = $this->session->userdata('id_toko');
    $data['title'] = 'Penjualan';
    $data['list_penjualan'] = $this->db->query("SELECT * from tb_penjualan where id_toko = '$id_toko' order by id desc ")->result();
    $this->template->load('template/template', 'spg/penjualan/index', $data);
  }

  public function detail($id)
  {
    $data['title'] = 'Penjualan';
    $data_penjualan = $this->db->query("SELECT tp.*, tt.nama_toko, tu.username from tb_penjualan tp join tb_toko tt on tt.id = tp.id_toko join tb_user tu on tu.id = tp.id_user where tp.id = '$id'")->row();
    $data['detail_penjualan'] = $this->db->query("SELECT * from tb_penjualan_detail tpd join tb_produk tp on tp.id = tpd.id_produk where tpd.id_penjualan = '$id'")->result();

    $data['no_permintaan'] = $id;
    $data['tanggal'] = $data_penjualan->tanggal_penjualan;
    
    $data['nama_toko'] = $data_penjualan->nama_toko;
    $data['nama'] = $data_penjualan->username;
    $this->template->load('template/template', 'spg/penjualan/detail', $data);
  }

  public function tampilkan_detail_produk($id)
  {
    $data_produk = $this->M_produk->get_produk_by_id($id);
    echo json_encode($data_produk);
  }

  public function tambah_penjualan()
  {
    if ($this->session->userdata('cart') != "Penjualan") {
      $this->cart->destroy();
    }
    $data['title'] = 'Penjualan';
    $data['no_penjualan'] = $this->M_spg->kode_penjualan(); // generate no permintaan
    $user_id = $this->session->userdata('id');
    $data['nama'] = $this->session->userdata('nama_user'); // generate no permintaan
    $id_toko = $this->session->userdata('id_toko');
    $data['toko_new'] = $this->db->query("SELECT * from tb_toko where id = '$id_toko'")->row();
    $data['data_cart'] = $this->cart->contents(); // menampilkan data cart
    $data['list_produk'] = $this->M_produk->get_stok()->result(); // menampilkan semua data artikel
    $this->template->load('template/template', 'spg/penjualan/tambah_penjualan', $data);
  }

  public function tambah_cart()
  {
    if($this->session->userdata('status') == 'login' && $this->session->userdata('role') == 4){
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');

        $produk = $this->M_produk->get_by_id($id);

        $data = array(
          'id'      => $id,
          'qty'     => $qty,
          'price'   => "",
          'name'    => $produk->id,
          'options' => $produk->kode
        );

        $this->cart->insert($data);
        $this->session->set_userdata('cart','Penjualan');

        redirect(base_url('spg/penjualan/tambah_penjualan'));
    } else {
        redirect(base_url('login'));
    }
    
  }

  public function hapus_cart($id)
  {
    $this->cart->remove($id);

    redirect(base_url('spg/Penjualan/tambah_penjualan'));
  }

  public function reset_cart()
  {
    $this->cart->destroy();

    redirect(base_url('spg/Penjualan/tambah_penjualan'));
  }
  public function set_tanggal($tanggal)
  {
    $this->session->set_userdata(['tanggal_penjualan' => $tanggal]);
  }

  public function simpan_penjualan()
  {
    $id_user = $this->session->userdata('id');
    $id_toko = $this->session->userdata('id_toko');
    $tanggal_penjualan = $this->session->userdata('tanggal_penjualan');
    $tgl_cek_promo = format_tanggal3($tanggal_penjualan);

    $id_penjualan = $this->M_spg->kode_penjualan();
    $keterangan = "";
    $data = array(
      'id' => $id_penjualan,
      'id_toko' => $id_toko,
      'id_user' => $id_user,
      'tanggal_penjualan' => $tanggal_penjualan,
    );
    $this->db->trans_start();
    $this->db->insert('tb_penjualan', $data);
    $data_cart = $this->cart->contents();
    foreach ($data_cart as $d) {
      $id_produk = $d['id'];

      // cari kategori harga dan diskon toko
      $query1 = $this->db->query("SELECT * from tb_toko where id = '$id_toko'")->row();
      $cek_promo = $this->db->query("SELECT * FROM tb_promo WHERE FIND_IN_SET('$id_toko', id_toko) AND tgl_mulai<='$tgl_cek_promo' AND tgl_selesai >= '$tgl_cek_promo' AND status =1")->result();
      $diskon_berlaku = "";
      foreach ($cek_promo as $promo) {
        if ($promo->id_produk == null) {
          $diskon_berlaku .= $promo->partisipasi_hicoop . ",";
        }else{
          $list_produk = explode(",", $promo->id_produk);
          foreach ($list_produk as $produk_promo) {
            if ($produk_promo == $id_produk) {
              $diskon_berlaku .= $promo->partisipasi_hicoop . ",";
            }
          }
        }
      }
      $diskon_berlaku = rtrim($diskon_berlaku, ",");
      $kategori = $query1->het; //kategori harga
      $diskon_toko = $query1->diskon; // diskon toko
      // cari harga produk
      $query2 = $this->db->query("SELECT * from tb_produk where id = '$id_produk'")->row();

      if ($kategori == 1) {
        $harga = $query2->harga_jawa;
      } elseif ($kategori == 2) {
        $harga = $query2->harga_indobarat;
      } elseif ($kategori == 3) {
        $harga = $query2->sp;
      } else {
        $harga = 0;
      }
      $qty = $d['qty'];
      $data = array(
        'id_penjualan' => $id_penjualan,
        'id_produk' => $id_produk,
        'harga' => $harga,
        'diskon_toko' => $diskon_toko,
        'diskon_promo' => $diskon_berlaku,
        'qty' => $qty,
      );
      $this->db->insert('tb_penjualan_detail', $data);
      $this->db->query("UPDATE tb_stok SET qty = (qty-'$qty'),updated_at = NOW() where id_toko = '$id_toko' and id_produk = '$id_produk'");
    }
    $this->db->trans_complete();
    $this->cart->destroy();
    tampil_alert('success','Berhasil','Data berhasil disimpan !');
    redirect(base_url('spg/Penjualan'));
  }
 
}
?>
