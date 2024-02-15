<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aset extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');
    if($role != "12"){
      tampil_alert('error','DI TOLAK !','Anda tidak punya akses untuk halaman ini.!');
      redirect(base_url(''));
    }
    $this->load->model('M_admin');
    $this->load->model('M_support');
  }
  public function index()
  {

    $data['title'] = 'Kelola Aset';
    $data['list_data'] = $this->db->query("SELECT * FROM tb_aset WHERE deleted_at is null order by id desc")->result();
    $data['id_aset'] = $this->M_support->kode_aset();
    $this->template->load('template/template', 'staff_ga/aset/index', $data);
  }
  public function proses_update()
  {
    $this->form_validation->set_rules('id','ID aset','required');
    $this->form_validation->set_rules('nama','Nama Aset','required');
    if($this->form_validation->run() == TRUE)
    {
      $config['upload_path'] = './assets/img/aset/'; //path folder
      $config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
      $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload

      $this->upload->initialize($config);
        if ($this->upload->do_upload('foto'))
        {
            $gbr = $this->upload->data();
            //Compress Image
            $config['image_library']='gd2';
            $config['source_image']='./assets/img/aset/'.$gbr['file_name'];
            $config['create_thumb']= FALSE;
            $config['maintain_ratio']= FALSE;
            $config['quality']= '50%';
            $config['width']= 512;
            $config['height']= 512;
            $config['new_image']= './assets/img/aset/'.$gbr['file_name'];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            $gambar=$gbr['file_name'];
            $id     = $this->input->post('id',TRUE);
            $nama     = $this->input->post('nama',TRUE);
            $update = $this->input->post('updated', TRUE);
            $where = array('id' => $id);
            $data = array(
                  'nama_aset'     => $nama,
                  'foto_aset' => $gambar,
                  'updated_at' => $update,
            );
            $this->db->trans_start();
            $this->M_admin->update('tb_aset',$data, $where);
            $this->db->trans_complete();
            tampil_alert('success','Berhasil','Data Aset Berhasil di Update');
            redirect(base_url('staff_ga/aset'));
        }else{
            $id     = $this->input->post('id',TRUE);
            $nama     = $this->input->post('nama',TRUE);
            $update = $this->input->post('updated', TRUE);
            $where = array('id' => $id);
            $data = array(
                  'nama_aset'     => $nama,
                  'foto_aset' => $gambar,
                  'updated_at' => $update,
            );
          $this->db->trans_start();
          $this->M_admin->update('tb_aset',$data, $where);
          $this->db->trans_complete();
          tampil_alert('success','Berhasil','Data Aset Berhasil di Update');
          redirect(base_url('staff_ga/aset')); 
        }
      }else{
        tampil_alert('error','Information','Data Aset Gagal diUpdate!');
        redirect(base_url('staff_ga/aset')); 
      }
  }
  function hapus()
  {
    $id = $this->uri->segment(4);
    $where = array('id' => $id);
    $data = array(
        'deleted_at' => date('Y-m-d H:i:s'),
    );
    $this->M_admin->update('tb_aset',$data,$where);
    tampil_alert('success','Berhasil','Data berhasil dihapus !');
    redirect(base_url('staff_ga/aset'));
  }
  // fungsi tambah Barang
  public function proses_tambah() 
  {
      $this->form_validation->set_rules('id','Id Aset','required');
      $this->form_validation->set_rules('nama','Nama Asset','required');

  
      if($this->form_validation->run() == TRUE )
      {
      $config['upload_path'] = './assets/img/aset/'; //path folder
      $config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
      $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload

      $this->upload->initialize($config);
        if ($this->upload->do_upload('foto')){
            $gbr = $this->upload->data();
            //Compress Image
            $config['image_library']='gd2';
            $config['source_image']='./assets/img/aset/'.$gbr['file_name'];
            $config['create_thumb']= FALSE;
            $config['maintain_ratio']= FALSE;
            $config['quality']= '50%';
            $config['width']= 512;
            $config['height']= 512;
            $config['new_image']= './assets/img/aset/'.$gbr['file_name'];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            $gambar=$gbr['file_name'];
            $nama     = $this->input->post('nama',TRUE);
            $id     = $this->input->post('id',TRUE);
            
            $data = array(
                  'id'     => $id,
                  'nama_aset'     => $nama,
                  'status'     => "1",
                  'foto_aset' => $gambar,
            );
            $cek = $this->db->query("SELECT * FROM tb_aset WHERE nama_aset = '$nama' AND deleted_at is NULL")->num_rows();
            if ($cek>0) {
              tampil_alert('Info','Information','Aset sudah ada!');
              redirect('hrd/aset');
            }else{
            $this->db->trans_start();
            $this->M_admin->insert('tb_aset',$data);
            $this->db->trans_complete();
            $hp = $this->db->query("SELECT no_telp FROM tb_user WHERE id = 61")->row();
            $phone = $hp->no_telp;
            $message = "Anda memiliki 1 Permintaan Aset baru yang perlu approve silahkan kunjungi s.id/absi-app";
            kirim_wa($phone,$message);
            tampil_alert('success','Berhasil','Data User Berhasil di buat');
            redirect(base_url('staff_ga/aset'));
            }
          }else{
            tampil_alert('error','Information','Harap Upload Foto terlebih dahulu!');
            redirect(base_url('staff_ga/aset'));
          }
    }else{
      tampil_alert('error','Information','Aset Gagal DiTambahkan!');
      redirect(base_url('staff_ga/aset'));
    }
  }

  public function list_aset()
  {
      $id_toko = $this->input->get('id_toko');
      $data['title'] = 'Management Aset';
      $data['list_toko'] = $this->db->query("SELECT tb_toko.nama_toko,tb_toko.id FROM tb_toko ORDER BY nama_toko ASC ")->result();
      $data['toko'] = $this->db->query("SELECT * FROM tb_toko WHERE id = '$id_toko'")->row();
      $data['aset'] = $this->db->query("SELECT * FROM tb_aset WHERE deleted_at is null ORDER BY nama_aset ASC")->result();
      $data['list_aset_toko'] = $this->db->query("SELECT tb_aset.nama_aset, tb_aset.id as id_asset, tb_aset_toko.id_toko, tb_aset_toko.qty,tb_aset_toko.keterangan,tb_aset_toko.id, tb_toko.nama_toko 
      FROM tb_aset_toko JOIN tb_aset ON tb_aset.id = tb_aset_toko.id_aset 
      JOIN tb_toko ON tb_toko.id = tb_aset_toko.id_toko 
      WHERE tb_aset_toko.id_toko = '$id_toko'")->result();
      $this->template->load('template/template', 'staff_ga/aset/list_aset.php', $data);
  }

    public function tambah_aset_toko()
    {
      $this->form_validation->set_rules('id','Id Aset','required');
      $this->form_validation->set_rules('daftar_aset','Daftar Aset','required');
      $this->form_validation->set_rules('qty','Jumlah Qty','required');
      $cek_from = $this->form_validation->run();
      if ($cek_from == TRUE) {
        $id   = $this->input->post('id',TRUE);
        $id_aset = $this->input->post('daftar_aset',TRUE);
        $nama_toko = $this->input->post('nama_toko',TRUE);
        $keterangan = $this->input->post('keterangan',TRUE);
        $qty  = $this->input->post('qty',TRUE);
        $data = array(
          'id_aset'  => $id_aset,
          'id_toko' => $id,
          'qty' => $qty,
          'keterangan' => $keterangan,
        );
        $cek_aset = $this->db->query("SELECT * FROM tb_aset_toko WHERE id_toko = '$id' AND id_aset = '$id_aset'")->num_rows();
        if ($cek_aset>0) {
          tampil_alert('info','Informasi','Aset sudah pernah terdaftarkan ditoko ini!');
          redirect('staff_ga/aset/list_aset?id_toko='.$id);
        }else{
          $this->M_admin->insert('tb_aset_toko',$data);
          tampil_alert('success','Berhasil','Aset berhasil ditambahkan ketoko '.$nama_toko);
          redirect('staff_ga/aset/list_aset?id_toko='.$id);
        }
      }
    }
    public function edit_aset_toko()
    {
      $this->form_validation->set_rules('id_aset','Id Aset','required');
      $this->form_validation->set_rules('qty','Jumlah Qty','required');
      if ($this->form_validation->run() == TRUE) {
        $id          = $this->input->post('id',TRUE);
        $id_toko     = $this->input->post('id_toko', TRUE);                 
        $qty         = $this->input->post('qty',TRUE);
        $update_at   = $this->input->post('updated', TRUE);
        $where = array('id' => $id);
        $data = array(
              'id'            => $id,
              'qty'           => $qty,
              'updated_at'    => $update_at,
        );
        $this->M_admin->update('tb_aset_toko',$data,$where);
        tampil_alert('success','Berhasil','Data berhasil diupdate !');
        redirect('staff_ga/aset/list_aset?id_toko='.$id_toko);
        }else{
        tampil_alert('erorr','Gagal','Data Gagal diupdate !');
        redirect('staff_ga/aset/list_aset?id_toko='.$id_toko);
        }
    }
    public function approve()
    {
      $id = $this->uri->segment(4);
      $where = array('id' => $id);
      $data = array(
        'status' => 1,
      );
      $this->M_admin->update('tb_aset',$data,$where);
      tampil_alert('success','Berhasil','Aset Sudah Aktif!');
      redirect(base_url('staff_ga/aset'));
    }
  public function detail($id)
  {
  $where = array('id' => $id);
  $data['title'] = 'Kelola Aset';
  $data['detail'] = $this->db->query("SELECT * FROM tb_aset WHERE id ='$id'")->row();
  
  $this->template->load('template/template', 'staff_ga/aset/detail',$data);
  }
}
?>