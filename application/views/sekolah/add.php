<!DOCTYPE html>
<html>
<?php $this->load->view('components/head'); ?>
<?php $this->load->view('components/body-open'); ?>
<?php $this->load->view('components/navbar'); ?>
<?php $this->load->view('components/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style='<?=($isEdit)? 'position:relative':''?>'>
     <?php if(($isEdit === true && $detailSekolah !== null) || ($isEdit === false)){ ?>
          <!-- Content Header (Page header) -->
          <div class="content-header">
               <div class="container-fluid">
                    <div class="row mb-2">
                         <div class="col-sm-6">
                              <h1 class="m-0 text-dark"><?=($isEdit)? 'Edit Data Sekolah' : 'Sekolah Baru'?></h1>
                              <?php if($isEdit){ ?>
                                   <p class='mb-0 ml-1'><?=$detailSekolah['nama']?></p>
                              <?php } ?>
                         </div><!-- /.col -->
                         <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                   <li class="breadcrumb-item"><a href="#">Home</a></li>
                                   <li class="breadcrumb-item active"><?=($isEdit)? 'Edit Data Sekolah' : 'Tambah Sekolah Baru'?></li>
                              </ol>
                         </div><!-- /.col -->
                    </div><!-- /.row -->
               </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->

          <!-- Main content -->
          <section class="content">
               <div class="container-fluid">
                    <!-- Main row -->
                    <div class="row">
                         <!-- Left col -->
                         <section class="col-lg-12">
                              <!-- Custom tabs (Charts with tabs)-->
                              <div class="card">
                                   <div class="card-header">
                                        <div class='row'>
                                             <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4 text-left'>
                                                  <h3 class="card-title">
                                                       <i class="fas fa-users mr-1"></i>
                                                       <?=($isEdit)? 'Edit Data Sekolah':'Sekolah Baru'?>
                                                  </h3>
                                             </div>
                                             <div class='col-lg-8 col-md-8 col-sm-8 col-xs-8 text-right'>
                                                  <a href='<?=site_url('sekolah')?>'>
                                                       <i class="fas fa-times text-danger cp" data-toggle='tooltip'
                                                            data-placement='top' title='List Sekolah'></i>
                                                  </a>
                                             </div>
                                        </div>
                                   </div><!-- /.card-header -->
                                   <div class="card-body">
                                        <form id='<?=($isEdit)? 'editSekolah':'tambahSekolahBaru' ?>' class='col-lg-12'>
                                             <?php if($isEdit){ ?>
                                                  <input required type='hidden' name='idSekolah' id='idSekolah' placeholder='ID Sekolah' 
                                                       class='form-control' value='<?=$detailSekolah['idSekolah']?>' />
                                             <?php } ?>
                                             <div class='row'>
                                                  <div class='form-group col-lg-4 col-md-6'>
                                                       <label for='nama'>Nama Sekolah *</label>
                                                       <input required type='text' name='namasekolah' id='namaSekolah' placeholder='Nama Sekolah' 
                                                            class='form-control' value='<?=($isEdit)? $detailSekolah['nama'] : ''?>' />
                                                  </div>
                                                  <div class='form-group col-lg-4 col-md-6'>
                                                       <label for='nomorTelepon'>Nomor Telepon Sekolah *</label>
                                                       <input required type='text' name='nomorteleponsekolah' id='nomorTelepon' 
                                                            placeholder='Nomor Telepon Sekolah' class='form-control' 
                                                            value='<?=($isEdit)? $detailSekolah['noHP'] : ''?>' />
                                                  </div>
                                                  <div class='form-group col-lg-4 col-md-6'>
                                                       <label for='email'>Email Sekolah *</label>
                                                       <input required type='email' name='emailsekolah' id='email' placeholder='Email Sekolah'
                                                            class='form-control' value='<?=($isEdit)? $detailSekolah['email'] : ''?>' />
                                                  </div>
                                                  <div class='form-group col-lg-6 col-md-6'>
                                                       <label for='tglPendiri'>Tgl. Pendiri Sekolah *</label>
                                                       <input required type='date' name='tglpendiri' id='tglPendiri' placeholder='Tgl. Pendiri'
                                                            class='form-control' value='<?=($isEdit)? $detailSekolah['tglPendiri'] : ''?>' />
                                                  </div>
                                                  <div class='form-group col-lg-6 col-md-12'>
                                                       <label for='alamat'>Alamat Sekolah *</label>
                                                       <textarea required name='alamat' id='alamat' 
                                                            placeholder='Alamat Sekolah' class='form-control'><?=($isEdit)? $detailSekolah['alamat'] : ''?></textarea>
                                                  </div>
                                             </div>
                                             <hr />
                                             <div class='row'>
                                                  <div class='col-lg-12'>
                                                       <button type='submit' class='btn btn-success'>Simpan <?=($isEdit)? 'Perubahan' : ''?> Data Sekolah</button>
                                                       <a href='<?=site_url('sekolah')?>'><button type='button' class='btn btn-default'>Kembali ke List Sekolah</button></a>
                                                  </div>
                                             </div>
                                        </form>
                                   </div><!-- /.card-body -->
                              </div>
                              <!-- /.card -->
                         </section>
                         <!-- /.Left col -->
                    </div>
                    <!-- /.row (main row) -->
               </div><!-- /.container-fluid -->
          </section>
          <!-- /.content -->
     <?php
          }else{
               $dataDataNotFound   =    [
                    'dataNotFoundTitle' =>   'Sekolah Tidak Dikenal', 
                    'dataNotFoundDesc'  =>   'Sistem tidak menemukan data sekolah yang berkaitan !',
                    'containerStyle'    =>   'position:absolute; top:50%; left:50%; transform : translate(-50%, -50%)'
               ];
               $this->load->view('components/data-not-found', $dataDataNotFound);
          }
     ?>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('components/footer'); ?>
<?php $this->load->view('components/control-sidebar'); ?>
<?php $this->load->view('components/body-close'); ?>

</html>
<script src='<?=base_url('assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.js')?>'></script>
<link href='<?=base_url('assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.css')?>' rel='stylesheet' />
<script language='Javascript'>
     $('#tambahSekolahBaru, #editSekolah').on('submit', function(e){
          e.preventDefault();
          let formData   =    $(this).serialize();

          $.ajax({
               url  : '<?=base_url('sekolah/addSekolah')?>',
               type : 'POST',
               data : formData,
               success : function(responseFromServer){
                    let JSONResponse    =    JSON.parse(responseFromServer);
                    if(JSONResponse.addSekolah === true){
                         window.location.href     =    '<?=site_url("sekolah/listsekolah")?>';
                    }else{
                         Swal.fire({
                              title : 'Penyimpanan Data Sekolah Baru',
                              html : `Penyimpanan data sekolah baru gagal ! <b class='text-danger'>${JSONResponse.message}</b>, Coba ulangi lagi !`,
                              type : 'error'
                         });
                    }
               }
          })
     });

     $('[data-toggle="tooltip"]').tooltip();
</script>