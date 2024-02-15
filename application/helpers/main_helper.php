<?php

function is_active($title){
    $CI =& get_instance();

    $param['user'] = $CI->session->userdata('name');
    $param['deskripsi'] = $aksi; 

    //load model log
    $CI->load->model('M_log');

    //save to database
    $CI->M_log->simpan_log($param);
}

function status_permintaan($id)
{

    if ($id==0) {
        echo "<span class='badge badge-danger'>Menunggu di approve leader !</span>";
    }elseif ($id==1){
        echo "<span class='badge badge-warning'>Menunggu di approve MV !</span>";
    }elseif ($id==2){
        echo "<span class='badge badge-info'>Disetujui MV!</span>";
    }elseif ($id==3){
        echo "<span class='badge badge-info'>Sedang Disiapkan!</span>";
    }elseif ($id==4){
        echo "<span class='badge badge-info'>Sedang dalam Pengiriman !</span>";
    }elseif ($id==6){
        echo "<span class='badge badge-success'>Selesai !</span>";
    }else{
        echo "<span class='badge badge-danger'>Di Tolak !</span>";
    }
}

function status_pengiriman($id)
{
    if ($id==0){
        echo "<span class='badge badge-danger'>Belum di Approve</span>";
    }elseif ($id==1){
        echo "<span class='badge badge-info'>Sedang di Kirim</span>";
    }elseif ($id==2){
        echo "<span class='badge badge-success'>Selesai diterima</span>";
    }else{
        echo "<span class='badge badge-warning'>Selisih !</span>";
    }
}
function piutang($id)
{
    if ($id == 0) {
        echo "<span class='badge badge-danger badge-sm'>Belum Verifikasi</span>";
    } elseif ($id == 1) {
        echo "<span class='badge badge-success badge-sm'>Terverifikasi</span>";
    } else {
        echo "<span class='badge badge-info'>Lunas</span>";
    }
}

function status_artikel($id)
{
    if ($id==0){
        echo "<span class='badge badge-secondary'>Non-Aktif!</span>";
    }elseif ($id==2) {
        echo "<span class='badge badge-warning'>Belum diApprove</span>";
    }else {
        echo "<span class='badge badge-success'>Aktif!</span>";
    }
}

function status_bap($id)
{
    if ($id==0){
        echo "<span class='badge badge-warning'>Belum Approve Leader!</span>";
    }elseif ($id==1) {
        echo "<span class='badge badge-warning'>Belum Approve MV</span>";
    }elseif ($id==2) {
        echo "<span class='badge badge-success'>Selesai</span>";
    }else{
        echo "<span class='badge badge-danger'>Di tolak !</span>";
    }
}
function status_promo($id)
{
    if ($id==0){
        echo "<span class='badge badge-danger'>Belum Approve!</span>";
    }elseif ($id==1) {
        echo "<span class='badge badge-success'>Aktif!</span>";
    }else{
        echo "<span class='badge badge-secondary'>Tidak Aktif!</span>";
    }
}
function status_het($id)
{
    if ($id==1){
        echo "<span class='badge badge-warning'>HET JAWA!</span>";
    }else if ($id==2){
        echo "<span class='badge badge-warning'>HET INDO BARAT!</span>";
    }else {
        echo "<span class='badge badge-danger'>Belum di pilih</span>";
    }
}

function status_retur($id)
{
    if ($id == 0) {
        echo "<span class='badge badge-danger'>Menunggu approve Leader !</span>";
    } elseif ($id == 1) {
        echo "<span class='badge badge-warning'>Menunggu approve MV !</span>";
    } elseif ($id == 2) {
        echo "<span class='badge badge-info'>Disetujui! tunggu proses kirim dari spg</span>";
    } elseif ($id == 3) {
        echo "<span class='badge badge-warning'>Di kirim dg Ekspedisi lain!</span>";
    } elseif ($id == 4) {
        echo "<span class='badge badge-success'>Selesai di terima !</span>";
    } elseif ($id == 5) {
        echo "<span class='badge badge-danger'>Ditolak !</span>";
    } elseif ($id == 6) {
        echo "<span class='badge badge-danger'>Menunggu Penjemputan Gudang!</span>";
    } elseif ($id == 10) {
        echo "<span class='badge badge-danger'>Menunggu Approve MV!</span>";
    } elseif ($id == 11) {
        echo "<span class='badge badge-warning'>Menunggu Approve MM!</span>";
    } elseif ($id == 12) {
        echo "<span class='badge badge-info'>Menunggu Approve Direksi!</span>";
    } elseif ($id == 13) {
        echo "<span class='badge badge-success'>Disetujui!</span>";
    } elseif ($id == 14) {
        echo "<span class='badge badge-primary'>Proses Pengambilan</span>";
    } elseif ($id == 15) {
        echo "<span class='badge badge-success'>Selesai</span>";
    } elseif ($id == 16) {
        echo "<span class='badge badge-danger'>Ditolak</span>";
    }
}
function status_toko($id)
{
    if ($id==0){
        echo "<span class='badge badge-default'>Tidak Aktif !</span>";
    }elseif($id==1) {
        echo "<span class='badge badge-success'>Aktif !</span>";
    }elseif($id==2) {
        echo "<span class='badge badge-warning'>Menunggu Approve Manager Marketing !</span>";
    }elseif($id==3) {
        echo "<span class='badge badge-warning'>Dalam Pengecekan Audit !</span>";
    }elseif($id==4) {
        echo "<span class='badge badge-warning'>Menunggu Approve Direksi !</span>";
    }elseif($id==5) {
        echo "<span class='badge badge-danger'>Menunggu Approve Direksi !</span>";
    }else{
        echo "<span class='badge badge-danger'>Error!</span>";
    }
}
function status_user($id)
{
    if ($id==0){
        echo "<span class='badge badge-danger'>Menunggu di approve !</span>";
    }elseif($id==1) {
        echo "<span class='badge badge-success'>Aktif !</span>";
    }else{
        echo "<span class='badge badge-info'>Tidak Aktif !</span>";
    }
}
function status_aset($id)
{
    if ($id==0){
        echo "<span class='badge badge-danger'>Menunggu di approve !</span>";
    }elseif($id==1) {
        echo "<span class='badge badge-success'>Aktif !</span>";
    }else{
        echo "<span class='badge badge-info'>Tidak Aktif !</span>";
    }
}
function kategori_bap($id)
{
    if ($id==1){
        echo "<span class='badge badge-default'>Update Penerimaan Artikel!</span>";
    }elseif($id==2) {
        echo "<span class='badge badge-default'>Artikel Hilang !</span>";
    }elseif($id==3) {
        echo "<span class='badge badge-default'>Artikel Tambahan !</span>";
    }else{
        echo "<span class='badge badge-default'>Nothing !</span>";
    }
}
function status_mutasi($id)
{
    if ($id==0){
        echo "<span class='badge badge-danger'>Menunggu di approve MV !</span>";
    }elseif($id==1) {
        echo "<span class='badge badge-warning'>Approved, Proses Transfer !</span>";
    }elseif($id==2) {
        echo "<span class='badge badge-success'>selesai !</span>";
    }else{
        echo "<span class='badge badge-danger'>Di tolak !</span>";
    }
}
function jenis_toko($id)
{
    if ($id==1){
        echo "Dept Store";
    }elseif($id==2) {
        echo "Supermarket";
    }elseif($id==3) {
        echo "Grosir";
    }elseif($id==4) {
        echo "Minimarket";
    }elseif($id==6) {
        echo "Hypermart";
    }else{
        echo "Lainnya..";
    }
}
function role($id)
{
    if ($id==1){
        echo "<span class='badge badge-warning'>Admin Utama</span>";
    }elseif($id==2) {
        echo "<span class='badge badge-warning'>Supervisor</span>";
    }elseif($id==3) {
        echo "<span class='badge badge-warning'>Team Leader</span>";
    }elseif($id==4) {
        echo "<span class='badge badge-warning'>SPG</span>";
    }elseif($id==5) {
        echo "<span class='badge badge-warning'>Admin Gudang</span>";
    }elseif($id==6) {
        echo "<span class='badge badge-warning'>Manager MV</span>";
    }elseif($id==7) {
        echo "<span class='badge badge-warning'>Manager HR/GA</span>";
    }elseif($id==8) {
        echo "<span class='badge badge-warning'>Admin MV</span>";
    }elseif($id==9) {
        echo "<span class='badge badge-warning'>Manager MKT</span>";
    }elseif($id==10) {
        echo "<span class='badge badge-warning'>Audit</span>";
    }elseif($id==11) {
        echo "<span class='badge badge-warning'>Staff HRD</span>";
    }elseif($id==12) {
        echo "<span class='badge badge-warning'>Staff GA</span>";
    }elseif($id==13) {
        echo "<span class='badge badge-warning'>Finance</span>";
    }elseif($id==14) {
        echo "<span class='badge badge-warning'>Manager Ops</span>";
    }

}

function format_tanggal1($date)
{
    return date('d-m-Y',strtotime($date));
}

function format_tanggal2($date)
{
    return date('d-M-Y',strtotime($date));
}
function format_tanggal3($date)
{
    return date('Y-m-d H:i:s',strtotime($date));
}

function format_rupiah($data)
{
    return 'Rp. ' . number_format($data);
}

?> 