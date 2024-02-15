<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permintaan extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "8"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));

    }    
    $this->load->model('M_admin');
    $this->load->model('M_support');
  }
    public function index()
      {
        $data['title'] = 'Permintaan Barang';
        // Menghitung tanggal dua bulan ke belakang dari tanggal saat ini
        $twoMonthsAgo = date('Y-m-d', strtotime('-1 months'));
        $data['list_data'] = $this->db->query("SELECT tp.*, tk.nama_toko as toko, tu.nama_user as spg 
             FROM tb_permintaan tp
             JOIN tb_toko tk ON tp.id_toko = tk.id
             JOIN tb_user tu on tp.id_user = tu.id
             WHERE tp.created_at >= '$twoMonthsAgo'
             ORDER BY tp.status ASC ,tp.created_at DESC")->result();
        $this->template->load('template/template', 'admin_mv/permintaan/index', $data);
      }

    public function detail($no_permintaan)
  {
    $data['title'] = 'Permintaan Barang';
    $data['permintaan'] = $this->db->query("SELECT tp.*, tk.nama_toko,tk.alamat,tk.telp, tu.nama_user as spg from tb_permintaan tp
    join tb_toko tk on tp.id_toko = tk.id
    join tb_user tu on tp.id_user = tu.id
    where tp.id ='$no_permintaan'")->row();
    $data['detail_permintaan'] = $this->M_support->get_data_detail($no_permintaan);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('username'));
    $this->template->load('template/template', 'admin_mv/permintaan/detail',$data);
  }
  
  public function approve()
  {
    $id           = $this->input->post('id_permintaan');
    $update_at    = $this->input->post('updated');
    $id_produk    = $this->input->post('id_produk');
    $id_detail    = $this->input->post('id_detail');
    $qty_acc      = $this->input->post('qty_acc');
    $catatan_mv      = $this->input->post('catatan_mv');
    $jumlah       = count($id_produk);

      $this->db->trans_start();
      $where = array('id' => $id);
      $data = array(
        'status' => 2,
        'keterangan' => $catatan_mv,
        'updated_at' => $update_at,
      );
      $this->M_admin->update('tb_permintaan',$data,$where);

      for ($i=0; $i < $jumlah; $i++)
      { 
        $d_id_produk  = $id_produk[$i];
        $d_id_detail  = $id_detail[$i];
        $d_qty        = $qty_acc[$i];

        $data_detail = array(
          'qty_acc' => $d_qty,
        );
        $this->db->where('id',$d_id_detail);
        $this->db->where('status = 1');
        $this->db->update('tb_permintaan_detail',$data_detail);
        $this->db->trans_complete();  
      }
      $hp = $this->db->query("SELECT no_telp FROM tb_user WHERE id = 128")->row();
      $phone = $hp->no_telp;
      $message = "Anda memiliki 1 Permintaan Barang baru dengan nomor ( ".$id." ) yang perlu disiapkan silahkan kunjungi s.id/absi-app";
      kirim_wa($phone,$message);
      tampil_alert('success','Berhasil','Data Berhasil di Approve');
      redirect(base_url('adm_mv/permintaan/detail/'.$id));
    
  }

  public function proses_update()
  {
    $this->form_validation->set_rules('qty_revisi','Update Qty','required');
    
    if($this->form_validation->run() == TRUE)
    {
      $id           = $this->input->post('id',TRUE);
      $id_permintaan = $this->input->post('id_permintaan', TRUE);        
      $qty         = $this->input->post('qty_revisi',TRUE);
      date_default_timezone_set('Asia/Jakarta');
      $update_at    = date('Y-m-d h:i:s');
      $where = array('id' => $id);
      $data = array(
            'qty_acc' => $qty,    
      );
      $this->M_admin->update('tb_permintaan_detail',$data,$where);
      $this->session->set_flashdata('msg_berhasil','Data Artikel Berhasil Diupdate');
      redirect(base_url('adm_mv/permintaan/detail/'.$id_permintaan));
    }else{
      $this->session->set_flashdata('msg_error', 'Data Artikel Gagal DiUpdate!');
      redirect(base_url('adm_mv/permintaan/detail'));
    }
  }

  public function edit($no_permintaan)
  {
    $data['title'] = 'Detail Permintaan Barang';
    $data['permintaan'] = $this->M_support->get_data($no_permintaan);
    $data['detail_permintaan'] = $this->M_support->get_data_detail($no_permintaan);

    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('username'));
    $this->template->load('template/template', 'admin_mv/permintaan/edit',$data); 
  }
  public function proses_total()
  {
    $grandtotal = 0;
    $qty = $_POST['qty'];
    $qty_b = $_POST['qty_b'];
    $harga = $_POST['harga'];
    if ($qty != $qty_b) {
      $total = $harga * $qty;
    } else {
      $total = $harga * $qty_b;
    }
    $grandtotal += $total;
    $data = array(
      'total' => $total,
      'grandtotal' => $grandtotal
    );
    echo json_encode($data);
  }
}
?>