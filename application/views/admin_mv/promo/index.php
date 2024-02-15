     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
    
            <!-- /.card -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> <li class="fas fa-cube"></li> Data Promo</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <script type="text/javascript">
                <?php if ($this->session->flashdata('msg_error')) { ?>
                  swal.fire({
                    Title: 'Warning!',
                    text: '<?= $this->session->flashdata('msg_error') ?>',
                    icon: 'Error',
                    confirmButtonColor : '#3085d6',
                    confirmButtonText: 'Ok' 
                  })  
                <?php } ?>  
              </script>
              <script type="text/javascript">
                <?php if ($this->session->flashdata('msg_berhasil')) { ?>
                  swal.fire({
                    Title: 'Success!',
                    text: '<?= $this->session->flashdata('msg_berhasil') ?>',
                    icon: 'success',
                    confirmButtonColor : '#3085d6',
                    confirmButtonText: 'Ok' 
                  })  
                <?php } ?>  
              </script>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-right">
                    <button type="button" class="btn btn-success" data-toggle="modal"  data-target="#modal-tambah" ><i class="fas fa-plus"></i>
                      Tambah Promo
                    </button>
                    
                    </div>
                </div>
                <hr>
                <table id ="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width:2% ">No</th>
                      <th style="width:10%">Nama Grup</th>
                      <th style="width:10%">Judul</th>
                      <th style="width: 20%">Content</th>
                      <th style="width: 20%">Syarat & Ketentuan</th>
                      <th>Status</th>
                      <th>Tgl. Mulai</th>
                      <th>Tgl. Selesai</th>
                      <th>Menu</th>       
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php if(is_array($list_data)){ ?>
                      <?php $no = 1;?>
                      <?php foreach($list_data as $dd): ?>
                        <td><?=$no?></td>
                        <td><?=$dd->nama_grup?></td>
                        <td><?=$dd->judul?></td>
                        <td><?=$dd->content?></td>
                        <td><?=$dd->sk?></td>
                        <td><?= status_promo($dd->status); ?></td>
                        <td><?= format_tanggal1($dd->tgl_mulai)?></td>
                        <td><?= format_tanggal1($dd->tgl_selesai)?></td>
                        <td>
                         <a href="#" class="btn btn-warning btn-edit" 
                        data-id="<?= $dd->id;?>" data-id_grup="<?= $dd->id_grup;?>" data-judul="<?= $dd->judul;?>" data-nama_grup="<?= $dd->nama_grup;?>" data-content="<?= $dd->content;?>" data-sk="<?= $dd->sk ?>" data-tgl_mulai="<?= $dd->tgl_mulai;?>" data-tgl_selesai="<?= $dd->tgl_selesai ?>" >
                        <li class="fas fa-edit"></li></a>
                        - 
                        <a type="button" class="btn btn-danger btn-hapus"  href="<?=base_url('adm_mv/promo/hapus/'.$dd->id)?>" title="Hapus Data"  ><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                      <?php $no++; ?>
                      <?php endforeach;?>
                      <?php }else { ?>
                            <td colspan="8" align="center"><strong>Data Kosong</strong></td>
                      <?php } ?>

              
                     
                  </tbody>
                  <tfoot>
                  <tr>
                  <th colspan="8"></th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
      <!-- modal tambah data -->
      <div class="modal fade" id="modal-tambah">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"> <li class="fas fa-cube"></li> Form Tambah Promo</h4>
                    <button
                      type="button"
                      class="close"
                      data-dismiss="modal"
                      aria-label="Close"
                    >
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!-- isi konten -->
                    <form method="POST" action="<?= base_url('adm_mv/promo/tambah_promo')?>">
                      <div class="form-group">
                        <label for="kode" >Nama Grup</label>
                        <select class="form-control select2bs4" style="width: 100%;" id="id_grup" name="id_grup" >
                          <option selected="selected" value="">Pilih Grup</option>
                          <?php foreach ($list_grup as $l) { ?>
                          <option value="<?= $l->id ?>"><?= $l->nama_grup?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="nama" >Judul</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Promo" required="">
                      </div>
                      <div class="form-group">
                        <label for="nama" >Content</label>
                        <textarea class="form-control" name="content" placeholder="Isi Content Promo" required=""></textarea>
                      </div>
                      <div class="form-group">
                        <label for="nama" >Syarat & Ketentuan</label>
                        <textarea class="form-control" name="sk" placeholder="Isi Syarat Promo" required=""></textarea>
                      </div>
                      <div class="form-group">
                        <label>Tgl. Mulai</label>
                        <input class="form-control" type="date" name="tgl_awal" value="<?= $this->input->get('tgl_awal') ?>">
                      </div>
                      <div class="form-group">
                        <label>Tgl. Selesai</label>
                        <input class="form-control" type="date" name="tgl_akhir" value="<?= $this->input->get('tgl_akhir') ?>">
                      </div>
                      
                    
                    <!-- end konten -->
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button
                      type="button"
                      class="btn btn-danger"
                      data-dismiss="modal"
                    >
                    <li class="fas fa-times-circle"></li> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                    <li class="fas fa-save"></li> Simpan
                    </button>
                  </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <!-- modal edit data -->
    <form action="<?= base_url('adm_mv/promo/edit_promo')?>" method="POST">
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <li class="fas fa-edit"></li> Update Promo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Grup</label>
                    <input type="text" class="form-control nama_grup" name="nama_grup" placeholder=" Name" readonly="">
                    <input type="hidden" name="id" class="id">
                </div>
                <div class="form-group">
                    <label>Judul Promo</label>
                    <input type="text" class="form-control judul" name="judul">
                </div>
                <div class="form-group">
                    <label>Content Promo</label>
                    <textarea class="form-control content" name="content" placeholder="Content"></textarea>
                </div>
                <div class="form-group">
                    <label>Syarat & Ketentuan Promo</label>
                    <textarea class="form-control sk" name="sk" placeholder="Content"></textarea> 
                </div>
                <div class="form-group">
                  <label>Tgl. Mulai</label>
                  <input class="form-control tgl_mulai" type="date" name="tgl_awal" >
                </div>
                <div class="form-group">
                  <label>Tgl. Selesai</label>
                  <input class="form-control tgl_selesai" type="date"  name="tgl_selesai">
                </div>
 
                
             
            </div>
              <div class="modal-footer justify-content-between">
                <button
                  type="button"
                  class="btn btn-danger"
                  data-dismiss="modal">
                  <li class="fas fa-times-circle"></li> Cancel
                </button>
                <input type="hidden" name="id" class="id">
                <button type="submit" class="btn btn-primary">
                  <li class="fas fa-edit"></li> Update
                </button>
              </div>
           
            </div>
        </div>
        </div>
    </form>
    <!-- End Modal Edit Product-->
      <!-- end modal -->
  
<!-- jQuery -->
<script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
<script>
   $(document).ready(function(){
    // get Edit Product
    $('.btn-edit').on('click',function(){
        // get data from button edit
        const id = $(this).data('id');
        const judul = $(this).data('judul');
        const nama_grup = $(this).data('nama_grup');
        const content = $(this).data('content');
        const sk = $(this).data('sk');
        const tgl_mulai = $(this).data('tgl_mulai');
        const tgl_selesai = $(this).data('tgl_selesai');
        // Set data to Form Edit
        $('.id').val(id);
        $('.nama_grup').val(nama_grup);
        $('.judul').val(judul);
        $('.tgl_mulai').val(tgl_mulai);
        $('.tgl_selesai').val(tgl_selesai);
        $('.content').val(content);
        $('.sk').val(sk);
        // Call Modal Edit
        $('#editModal').modal('show');
    });
   })
</script>
