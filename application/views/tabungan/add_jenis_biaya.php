<!DOCTYPE html>
<html>
<?php $this->load->view('components/head'); ?>
<?php $this->load->view('components/body-open'); ?>
<?php $this->load->view('components/navbar'); ?>
<?php $this->load->view('components/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style='position:relative'>
     <?php if(($isEdit === true && $detailJenisBiaya !== null) || ($isEdit === false)){ ?>
          <!-- Content Header (Page header) -->
          <div class="content-header">
               <div class="container-fluid">
                    <div class="row mb-2">
                         <div class="col-sm-6">
                              <h1 class="m-0 text-dark"><?=($isEdit)? 'Edit Data Jenis Biaya':'Jenis Biaya Baru'?></h1>
                              <?php if($isEdit){ ?>
                                   <p class='ml-1 mb-0'><?=$detailJenisBiaya['nama']?></p>
                              <?php } ?>
                         </div><!-- /.col -->
                         <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                   <li class="breadcrumb-item"><a href="#">Home</a></li>
                                   <li class="breadcrumb-item active"><?=($isEdit)? 'Edit Data Jenis Biaya' : 'Tambah Jenis Biaya Baru'?></li>
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
                                             <div class='col-4 text-left'>
                                                  <h3 class="card-title">
                                                       <i class="fas fa-dollar-sign mr-1"></i>
                                                       <?=($isEdit)? 'Edit Data Jenis Biaya':'Jenis Biaya Baru'?>
                                                  </h3>
                                             </div>
                                             <div class='col-8 text-right'>
                                                  <a href='<?=site_url('tabungan/jenis_biaya')?>'>
                                                       <i class="fas fa-times text-danger cp" data-toggle='tooltip'
                                                            data-placement='top' title='List Jenis Biaya'></i>
                                                  </a>
                                             </div>
                                        </div>
                                   </div><!-- /.card-header -->
                                   <div class="card-body">
                                        <form id="<?=($isEdit)? 'editJenisBiaya':'jenisBiayaBaru'?>">
                                             <?php if($isEdit){ ?>
                                                  <input required type="hidden" class="form-control" id="idJenisBiaya" 
                                                       placeholder="ID Jenis Biaya" name='idJenisBiaya' 
                                                       value='<?=($isEdit)? $detailJenisBiaya['idJenisBiaya'] : ''?>' />
                                             <?php } ?>
                                             <div class='row'>
                                                  <div class='form-group col-lg-4 col-md-4 col-sm-12 col-xs-12'>
                                                       <label for='namaJenisBiaya'>Nama Jenis Biaya *</label>
                                                       <input required type="text" class="form-control" id="namaJenisBiaya" 
                                                            placeholder="Nama Jenis Biaya" name='namaJenisBiaya' 
                                                            value='<?=($isEdit)? $detailJenisBiaya['nama'] : ''?>' />
                                                  </div>
                                                  <div class='form-group col-lg-8 col-md-8 col-sm-12 col-xs-12'>
                                                       <label for='keteranganJenisBiaya'>Keterangan Jenis Biaya (Opsional)</label>
                                                       <textarea class="form-control" id="keteranganJenisBiaya" 
                                                            placeholder="Keterangan Jenis Biaya" 
                                                            name='keteranganJenisBiaya'><?=($isEdit)? $detailJenisBiaya['keterangan'] : ''?></textarea>
                                                  </div>
                                             </div>
                                             <hr>
                                             <div class='row'>
                                                  <div class='col-12'>
                                                       <button class="btn btn-success mr-1" id="btnSubmit" 
                                                            type='submit'>Simpan <?=($isEdit)? 'Perubahan' : ''?> Data Jenis Biaya</button>
                                                       <a href='<?=site_url('tabungan/jenis_biaya')?>'>
                                                            <button class="btn btn-danger ml-1" id="btnCancel" type='button'>Kembali ke List Jenis Biaya</button>
                                                       </a>
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
                    'dataNotFoundTitle' =>   'Jenis Biaya Tidak Dikenal', 
                    'dataNotFoundDesc'  =>   'Sistem tidak menemukan data jenis biaya yang berkaitan !',
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
     $('[data-toggle="tooltip"]').tooltip();

     $('#jenisBiayaBaru, #editJenisBiaya').on('submit', function(e){
          e.preventDefault();

          let formData   =    $(this).serialize();
          let btnSubmit  =    $(this).find('#btnSubmit');
          let btnSubmitText   =    btnSubmit.text();

          btnSubmit.prop('disabled', true).text('Processing ..');

          $.ajax({
               url  : '<?=base_url('tabungan/addJenisBiaya')?>',
               type : 'POST',
               data : formData,
               success : function(responseFromServer){
                    let JSONResponse    =    JSON.parse(responseFromServer);
                    if(JSONResponse.addJenisBiaya === true){
                         window.location.href     =    '<?=site_url("tabungan/jenis_biaya")?>';
                    }else{
                         Swal.fire({
                              title : 'Penyimpanan Data Jenis Biaya',
                              html : `Penyimpanan data jenis biaya gagal ! <b class='text-danger'>${JSONResponse.message}</b>, Coba ulangi lagi !`,
                              type : 'error'
                         });
                    }

                    btnSubmit.prop('disabled', false).text(btnSubmitText);
               }
          });
     });
</script>