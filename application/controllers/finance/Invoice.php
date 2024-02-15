<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "13"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }

    $this->load->model('M_finance');
    $this->load->model('M_admin');
  }

  public function index()
  {
    $data['title'] = 'Kelola Invoice';
    $data['no_invoice'] = $this->no_invoice();
    $data['invoice'] = $this->db->query("SELECT ti.*, tt.nama_toko as toko, tc.nama_cust as cust_toko, tcc.nama_cust as customer from tb_invoice ti
    left join tb_toko tt on ti.id_toko = tt.id
    left join tb_customer tc on tt.id_customer = tc.id
    left join tb_customer tcc on ti.id_cust = tcc.id
    order by ti.id desc")->result();
    $data['cust'] = $this->db->query("SELECT * from tb_customer ")->result();
    $data['list_toko'] = $this->db->query("SELECT * from tb_toko where status = 1")->result();
    $this->template->load('template/template', 'finance/invoice/index', $data);
  }
  // no invoice
  public function no_invoice()
  {
    $tahun  = date('Y');
   $q = $this->db->query("SELECT MAX(RIGHT(id,5)) AS kd_max FROM tb_invoice WHERE YEAR(created_at) = '$tahun'");
    $kd = "";
    if($q->num_rows()>0){
        foreach($q->result() as $k){
            $tmp = ((int)$k->kd_max)+1;
            $kd = sprintf("%05s", $tmp);
        }
    }else{
        $kd = "00001";
    }
    date_default_timezone_set('Asia/Jakarta');
    return "INV-".date('Y')."-".$kd;
  }
  public function list_jual_cust()
  {
     $id_cust   = $this->input->get('id_cust');
     $tgl       = $this->input->GET('tgl');
     $tgl_awal  = $this->input->GET('tgl_awal');
     $tgl_akhir = $this->input->GET('tgl_akhir');
    $data = $this->db->query("SELECT tpd.*, DATE_ADD(CURRENT_DATE(), INTERVAL tc.top DAY) as tgl_tempo, tpd.id as id_detail, tpk.kode, tp.tanggal_penjualan, (tpd.harga - (tpd.harga * tpd.diskon_toko / 100)) * tpd.qty as sub_total, (tpd.harga * tpd.diskon_toko / 100) as margin from tb_penjualan_detail tpd
    join tb_penjualan tp on tpd.id_penjualan = tp.id
    join tb_produk tpk on tpd.id_produk = tpk.id
    join tb_toko tt on tp.id_toko = tt.id
    join tb_customer tc on tt.id_customer = tc.id
    where tt.id_customer = '$id_cust' and tpd.status = 0 and  date(tp.tanggal_penjualan) between '$tgl_awal' and '$tgl_akhir' order by tp.tanggal_penjualan desc")->result();
    echo json_encode($data);
  }
  public function list_jual()
  {
    $id_toko = $this->input->get('id_toko');
     $tgl       = $this->input->GET('tgl');
     $tgl_awal  = $this->input->GET('tgl_awal');
     $tgl_akhir = $this->input->GET('tgl_akhir');
    $data = $this->db->query("SELECT tpd.*, DATE_ADD(CURRENT_DATE(), INTERVAL tc.top DAY) as tgl_tempo, tpd.id as id_detail, tpk.kode, tp.tanggal_penjualan, (tpd.harga - (tpd.harga * tpd.diskon_toko / 100)) * tpd.qty as sub_total, (tpd.harga * tpd.diskon_toko / 100) as margin from tb_penjualan_detail tpd
    join tb_penjualan tp on tpd.id_penjualan = tp.id
    join tb_produk tpk on tpd.id_produk = tpk.id
    join tb_toko tt on tp.id_toko = tt.id
    join tb_customer tc on tt.id_customer = tc.id
    where tp.id_toko = '$id_toko' and tpd.status = 0 and  date(tp.tanggal_penjualan) between '$tgl_awal' and '$tgl_akhir' order by tp.tanggal_penjualan desc")->result();
    echo json_encode($data);
  }
  // simpan invoice
  public function simpan_invoice_cust() 
  {
    // Ambil data dari permintaan POST
    $no_invoice = $this->input->post('no_invoice');
    $id_cust = $this->input->post('id_cust');
    $items = $this->input->post('items');
    $totalQty = $this->input->post('totalQty');
    $totalMargin = $this->input->post('totalMargin');
    $totalSubTotal = $this->input->post('totalSubTotal');
    $catatan = $this->input->post('catatan');
    $jth_tempo = $this->input->post('jth_tempo');
    $tgl = $this->input->post('tgl');
    $id_user = $this->session->userdata('id');

   
    // Lakukan operasi penyimpanan ke tabel tb_invoice
    $invoice = array(
      'id'        => $no_invoice,
      'id_cust'   => $id_cust,
      'id_toko'   => 0,
      'total_qty' => $totalQty,
      'total'     => $totalSubTotal,
      'total_margin'     => $totalMargin,
      'id_user'   => $id_user,
      'catatan'   => $catatan,
      'jth_tempo'   => $jth_tempo,
      'range_tgl'       => $tgl,
    );
    $this->db->trans_start();
    $this->db->insert('tb_invoice', $invoice);
   
      // Lakukan operasi penyimpanan ke tabel tb_detail_invoice untuk setiap item
      for ($i = 0; $i < count($items); $i++) {
        $item   = $items[$i];
        $id_produk_item = $item['id_produk'];
        $id_detail_item = $item['id_detail'];
        $id_penjualan = $item['id_penjualan'];
        $qty = $item['qty'];
        $harga = $item['harga'];
        $margin = $item['margin'];
        $sub_total = $item['sub_total'];
  
        $detail_invoice_data = array(
          'id_invoice' => $no_invoice,
          'id_produk' => $id_produk_item,
          'no_penjualan' => $id_penjualan,
          'id_jual_detail' => $id_detail_item,
          'qty' => $qty,
          'harga' => $harga,
          'margin' => $margin,
          'sub_total' => $sub_total
        );
        $jual = array(
          'status'  => 1
        );
        $where = array(
          'id'  => $id_penjualan
        );
        $where_detail = array(
          'id'  => $id_detail_item
        );
        $this->db->insert('tb_invoice_detail', $detail_invoice_data);
        $this->db->update('tb_penjualan',$jual,$where);
        $this->db->update('tb_penjualan_detail',$jual,$where_detail);
      }
      $this->db->trans_complete();
    // Kirim respons ke klien (misalnya berupa JSON)
    $response = ['success' => true];
    echo json_encode($response);
  }
  // simpan invoice
  public function simpan_invoice() 
  {
    // Ambil data dari permintaan POST
    $no_invoice = $this->input->post('no_invoice');
    $id_toko = $this->input->post('id_toko');
    $items = $this->input->post('items');
    $totalQty = $this->input->post('totalQty');
    $totalMargin = $this->input->post('totalMargin');
    $totalSubTotal = $this->input->post('totalSubTotal');
    $catatan = $this->input->post('catatan');
    $jth_tempo = $this->input->post('jth_tempo');
    $id_user = $this->session->userdata('id');
    $tgl = $this->input->post('tgl');
   
    // Lakukan operasi penyimpanan ke tabel tb_invoice
    $invoice = array(
      'id'        => $no_invoice,
      'id_toko'   => $id_toko,
      'total_qty' => $totalQty,
      'total'     => $totalSubTotal,
      'total_margin'     => $totalMargin,
      'id_user'   => $id_user,
      'catatan'   => $catatan,
      'jth_tempo'   => $jth_tempo,
      'range_tgl'       => $tgl,
    );
    $this->db->trans_start();
    $this->db->insert('tb_invoice', $invoice);
   
      // Lakukan operasi penyimpanan ke tabel tb_detail_invoice untuk setiap item
      for ($i = 0; $i < count($items); $i++) {
        $item   = $items[$i];
        $id_produk_item = $item['id_produk'];
        $id_detail_item = $item['id_detail'];
        $id_penjualan = $item['id_penjualan'];
        $qty = $item['qty'];
        $harga = $item['harga'];
        $margin = $item['margin'];
        $sub_total = $item['sub_total'];
  
        $detail_invoice_data = array(
          'id_invoice' => $no_invoice,
          'id_produk' => $id_produk_item,
          'no_penjualan' => $id_penjualan,
          'id_jual_detail' => $id_detail_item,
          'qty' => $qty,
          'harga' => $harga,
          'margin' => $margin,
          'sub_total' => $sub_total
        );
        $jual = array(
          'status'  => 1
        );
        $where = array(
          'id'  => $id_penjualan
        );
        $where_detail = array(
          'id'  => $id_detail_item
        );
        $this->db->insert('tb_invoice_detail', $detail_invoice_data);
        $this->db->update('tb_penjualan',$jual,$where);
        $this->db->update('tb_penjualan_detail',$jual,$where_detail);
      }
      $this->db->trans_complete();
    // Kirim respons ke klien (misalnya berupa JSON)
    $response = ['success' => true];
    echo json_encode($response);
  }
  //  invoice
  public function invoice($id)
  {
    $data['title'] = 'Kelola Invoice';
    $data['invoice']  = $this->db->query("SELECT ti.*, tt.nama_toko as toko, tc.nama_cust as cust_toko, tc.alamat_cust as a_toko, tcc.nama_cust as customer, tcc.alamat_cust as a_customer,  tu.nama_user from tb_invoice ti
    left join tb_toko tt on ti.id_toko = tt.id
    left join tb_customer tc on tt.id_customer = tc.id
    left join tb_customer tcc on ti.id_cust = tcc.id
    join tb_user tu on ti.id_user = tu.id
    where ti.id = '$id'")->row();
    $data['detail'] = $this->db->query("SELECT tid.*, tp.kode, tp.nama_produk from tb_invoice_detail tid
    join tb_produk tp on tid.id_produk = tp.id
    where tid.id_invoice = '$id' order by tp.kode desc")->result();
    $this->template->load('template/template', 'finance/invoice/invoice', $data);
  }
  // bayar
  public function bayar()
  {
    $invoice = $this->input->post('invoice');
    $faktur = $this->input->post('faktur');
    $catatan = $this->input->post('catatan');
    // update pembayaran
    $update = array(
      'bukti_byr' => $faktur,
      'catatan_byr' => $catatan,
      'updated_at'  => date('Y-m-d'),
      'status'      => 3
    );
    $where = array(
      'id'  => $invoice
    );

    // Mendapatkan ID dari tb_invoice_detail berdasarkan id_invoice
    $this->db->select('id_jual_detail');
    $this->db->from('tb_invoice_detail');
    $this->db->where('id_invoice', $invoice);
    $query = $this->db->get();
    $invoiceDetailIds = $query->result_array();

    $this->db->trans_start();
    // Update status di tb_penjualan_detail berdasarkan ID yang didapatkan
    if (!empty($invoiceDetailIds)) {
        $ids = array_column($invoiceDetailIds, 'id_jual_detail');
        $this->db->where_in('id', $ids);
        $this->db->update('tb_penjualan_detail', ['status' => 2]);
    }
    $this->db->update('tb_invoice', $update, $where);
    $this->db->trans_complete();
    tampil_alert('success','LUNAS','Nomor Invoice : <b>'.$invoice.'</b> sudah lunas.');
    redirect($_SERVER['HTTP_REFERER']);
  }
  

}
?>
