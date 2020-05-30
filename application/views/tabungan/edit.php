<!DOCTYPE html>
<html>
<?php $this->load->view('components/head'); ?>
<?php $this->load->view('components/body-open'); ?>
<?php $this->load->view('components/navbar'); ?>
<?php $this->load->view('components/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style='position:relative'>
     <?php if(($isEdit === true && $detailTabungan !== null) || ($isEdit === false)){ ?>
          <!-- Content Header (Page header) -->
          <div class="content-header">
               <div class="container-fluid">
                    <div class="row mb-2">
                         <div class="col-sm-6">
                              <h1 class="m-0 text-dark"><?=($isEdit)? 'Edit Data Tabungan':'Tabungan Baru'?></h1>
                              <?php if($isEdit){ ?>
                                   <p class='ml-1 mb-0'><?=$detailTabungan['namaTabungan']?></p>
                              <?php } ?>
                         </div><!-- /.col -->
                         <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                   <li class="breadcrumb-item"><a href="#">Home</a></li>
                                   <li class="breadcrumb-item active"><?=($isEdit)? 'Edit Data Tabungan' : 'Tambah Tabungan Baru'?></li>
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
                                                       <i class="fas fa-book mr-1"></i>
                                                       Edit Data Tabungan
                                                  </h3>
                                             </div>
                                             <div class='col-8 text-right'>
                                                  <a href='<?=site_url('tabungan')?>'>
                                                       <i class="fas fa-times text-danger cp" data-toggle='tooltip'
                                                            data-placement='top' title='List Tabungan'></i>
                                                  </a>
                                             </div>
                                        </div>
                                   </div><!-- /.card-header -->
                                   <div class="card-body">
                                        <form id="editTabungan" class='col-12' onsubmit="simpanTabungan(event, this)">
                                             <input type="hidden" name='idTabungan' value='<?=$detailTabungan['idTabungan']?>'>
                                             <div class='row'>
                                                  <div class='form-group col-lg-4 col-md-4 col-sm-6 col-xs-6'>
                                                       <label for='nomorTabungan'>Nomor Tabungan *</label>
                                                       <input required type='text' name='nomorTabungan' id='nomorTabungan' placeholder='Nomor Tabungan' 
                                                            class='form-control' value='<?=($isEdit)? $detailTabungan['nomorTabungan'] : ''?>' />
                                                  </div>
                                                  <div class='form-group col-lg-4 col-md-4 col-sm-6 col-xs-6'>
                                                       <label for='namaTabungan'>Nama Tabungan *</label>
                                                       <input required type='text' name='namaTabungan' id='namaTabungan' placeholder='Nama Tabungan' 
                                                            class='form-control' value='<?=($isEdit)? $detailTabungan['namaTabungan'] : ''?>' />
                                                  </div>
                                                  <div class='form-group col-lg-4 col-md-12 col-sm-12 col-xs-12'>
                                                       <label for='siswaPemilikTabungan'>Nama Siswa *</label>
                                                       <select name="siswaPemilikTabungan" id="siswaPemilikTabungan" class="form-control">
                                                            <option value="0">-- Siswa Pemilik Tabungan --</option>
                                                            <?php 
                                                                 $this->db->select('idSiswa, nama, nis');
                                                                 $listSiswa     =    $this->db->get('ts_siswa')->result_array();
                                                                 foreach($listSiswa as $indexData => $siswa){
                                                                      ?>
                                                                           <option value="<?=$siswa['idSiswa']?>" <?=($siswa['idSiswa'] === $detailTabungan['idSiswa'])? 'selected':''?>><?=$siswa['nama']?> | <?=$siswa['nis']?></option>
                                                                      <?php
                                                                 }
                                                            ?>
                                                       </select>
                                                  </div>
                                             </div>
                                             <hr />
                                             <div class="row">
                                                  <div class="col-12 text-left">
                                                       <button class="btn btn-success mr-1" type='submit' id='btnSubmit'>Simpan Perubahan Data Tabungan</button>
                                                       <a href='<?=site_url('tabungan')?>'>
                                                            <button class="btn btn-danger ml-1">Batal</button>
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
               </div><!-- /.container-fluid -->
          </section>
          <!-- /.content -->
     <?php 
          }else{
               $dataDataNotFound   =    [
                    'dataNotFoundTitle' =>   'Tabungan Tidak Dikenal', 
                    'dataNotFoundDesc'  =>   'Sistem tidak menemukan data Tabungan yang berkaitan !',
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

<script src='<?=base_url('assets/AdminLTE/plugins/select2/js/select2.min.js')?>'></script>
<link href='<?=base_url('assets/AdminLTE/plugins/select2/css/select2.min.css')?>' rel='stylesheet' />

<script src='<?=base_url('assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.js')?>'></script>
<link href='<?=base_url('assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.css')?>' rel='stylesheet' />

<script language='Javascript'>
     $('[data-toggle="tooltip"]').tooltip();

     $('#siswaPemilikTabungan').select2();

     $('.select2-selection').css('height', 'calc(2.25rem + 2px)');

     function simpanTabungan(e, el){
          e.preventDefault();

          let formData   =    $(el).serialize();
          let btnSubmit  =    $('#btnSubmit');
          let btnSubmitText   =    btnSubmit.text();

          btnSubmit.prop('disabled', true).text('Processing ..');

          $.ajax({
               url  : '<?=base_url('tabungan/editTabungan')?>',
               type : 'POST',
               data : formData,
               success : function(responseFromServer){
                    let JSONResponse    =    JSON.parse(responseFromServer);
                    if(JSONResponse.editTabungan === true){
                         window.location.href     =    '<?=site_url("tabungan/listtabungan")?>';
                    }else{
                         Swal.fire({
                              title : 'Perubahan Data Tabungan',
                              html : `Perubahan data tabungan baru gagal ! <b class='text-danger'>${JSONResponse.message}</b>, Coba ulangi lagi !`,
                              type : 'error'
                         });
                    }

                    btnSubmit.prop('disabled', false).text(btnSubmitText);
               }
          });
     }
</script>