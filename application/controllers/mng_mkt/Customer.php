<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "9"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_admin');
    $this->load->model('M_support');
  }

  public function index()
  {
    $data['title'] = 'Kelola Customer';
    $data['customer'] = $this->db->query("SELECT tc.*, count(tt.id) as total_toko FROM tb_customer tc
    left join tb_toko tt on tt.id_customer = tc.id 
    where tc.deleted_at is null group by tc.nama_cust order by tc.id desc ")->result();
    $this->template->load('template/template', 'manager_mkt/customer/index', $data);
  }
  public function detail($id_customer)
  {
    $data['title'] = 'Kelola Customer';
    $data['customer'] = $this->db->query("SELECT * from tb_customer where id ='$id_customer'")->row();
    $data['list_toko'] = $this->db->query("SELECT tb_toko.*, tu.nama_user as spv,tuu.nama_user as leader, tuuu.nama_user as spg from tb_toko
    join tb_customer tc on tb_toko.id_customer = tc.id
    join tb_user tu on tb_toko.id_spv = tu.id
    join tb_user tuu on tb_toko.id_leader = tuu.id
    left join tb_user tuuu on tb_toko.id_spg = tuuu.id
    where tb_toko.id_customer ='$id_customer'")->result();
    $this->template->load('template/template', 'manager_mkt/customer/detail', $data);
  }

  public function update_alamat()
  {
    $id_cust        = $this->input->post('id_cust');
    $alamat        = $this->input->post('alamat');
    // proses update ke controller
    $this->db->query("UPDATE tb_customer set alamat_cust = '$alamat' where id ='$id_cust'");
    tampil_alert('success','Berhasil','Data Alamat berhasil di Perbaharui!');
    redirect(base_url('mng_mkt/Customer/detail/'.$id_cust));

  }
  public function update_pic()
  {
    $id_cust        = $this->input->post('id_cust');
    $pic        = $this->input->post('pic');
    $telp        = $this->input->post('telp');
    // proses update ke controller
    $this->db->query("UPDATE tb_customer set nama_pic = '$pic', telp ='$telp' where id ='$id_cust'");
    tampil_alert('success','Berhasil','Data PIC & telp berhasil di Perbaharui!');
    redirect(base_url('mng_mkt/Customer/detail/'.$id_cust));

  }
  public function update_top()
  {
    $id_cust        = $this->input->post('id_cust');
    $top            = $this->input->post('top');
    $tagihan        = $this->input->post('tagihan');
    // proses update ke controller
    $this->db->query("UPDATE tb_customer set top = '$top', tagihan ='$tagihan' where id ='$id_cust'");
    tampil_alert('success','Berhasil','Data T.O.P & Tagihan berhasil di Perbaharui!');
    redirect(base_url('mng_mkt/Customer/detail/'.$id_cust));

  }
  // proses update foto ktp
 public function update_foto_ktp() 
 {
   $id_cust =  $this->input->post('id_cust');
   $config['upload_path'] = 'assets/img/customer/';
   $config['allowed_types'] = 'jpg|jpeg|png';
   $config['max_size'] = '2048';
   $config['file_name'] = 'ktp_'.$id_cust;
   $config['overwrite'] = TRUE;
   $config['remove_spaces'] = TRUE;
   $this->load->library('upload', $config);
   $this->upload->initialize($config);
   
   if (!$this->upload->do_upload('foto_ktp')) {
   
   } else {
     // Jika upload berhasil, simpan data foto ke database
     $foto = $this->upload->data('file_name');
     $id_cust =  $this->input->post('id_cust');
     // simpan data foto ke database sesuai dengan id data yang ingin diupdate
     $this->db->query("UPDATE tb_customer set foto_ktp ='$foto' where id='$id_cust'");
     $data['toko'] = $this->db->query("SELECT * from tb_customer where id = '$id_cust'")->row();
     $data['pesan'] = "berhasil di update";
     echo json_encode($data);
     
   }
 }
  // proses update foto NPWP
 public function update_foto_npwp() 
 {
   $id_cust =  $this->input->post('id_cust');
   $config['upload_path'] = 'assets/img/customer/';
   $config['allowed_types'] = 'jpg|jpeg|png';
   $config['max_size'] = '2048';
   $config['file_name'] = 'npwp_'.$id_cust;
   $config['overwrite'] = TRUE;
   $config['remove_spaces'] = TRUE;
   $this->load->library('upload', $config);
   $this->upload->initialize($config);
   
   if (!$this->upload->do_upload('foto_npwp')) {
   
   } else {
     // Jika upload berhasil, simpan data foto ke database
     $foto = $this->upload->data('file_name');
     $id_cust =  $this->input->post('id_cust');
     // simpan data foto ke database sesuai dengan id data yang ingin diupdate
     $this->db->query("UPDATE tb_customer set foto_npwp ='$foto' where id='$id_cust'");
     $data['toko'] = $this->db->query("SELECT * from tb_customer where id = '$id_cust'")->row();
     $data['pesan'] = "berhasil di update";
     echo json_encode($data);
     
   }
 }
 
}
?>