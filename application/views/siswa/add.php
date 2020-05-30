<!DOCTYPE html>
<html>
<?php $this->load->view('components/head'); ?>
<?php $this->load->view('components/body-open'); ?>
<?php $this->load->view('components/navbar'); ?>
<?php $this->load->view('components/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style='position:relative'>
     <?php if(($isEdit === true && $detailSiswa !== null) || ($isEdit === false)){ ?>
          <!-- Content Header (Page header) -->
          <div class="content-header">
               <div class="container-fluid">
                    <div class="row mb-2">
                         <div class="col-sm-6">
                              <h1 class="m-0 text-dark"><?=($isEdit)? 'Edit Data Siswa':'Siswa Baru'?></h1>
                              <?php if($isEdit){ ?>
                                   <p class='ml-1 mb-0'><?=$detailSiswa['nama']?></p>
                              <?php } ?>
                         </div><!-- /.col -->
                         <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                   <li class="breadcrumb-item"><a href="#">Home</a></li>
                                   <li class="breadcrumb-item active"><?=($isEdit)? 'Edit Data Siswa' : 'Tambah Siswa Baru'?></li>
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
                                                       <?=($isEdit)? 'Edit Data Siswa':'Siswa Baru'?>
                                                  </h3>
                                             </div>
                                             <div class='col-lg-8 col-md-8 col-sm-8 col-xs-8 text-right'>
                                                  <a href='<?=site_url('siswa')?>'>
                                                       <i class="fas fa-times text-danger cp" data-toggle='tooltip'
                                                            data-placement='top' title='List Siswa'></i>
                                                  </a>
                                             </div>
                                        </div>
                                   </div><!-- /.card-header -->
                                   <div class="card-body">
                                        <form id='<?=($isEdit)? 'editSiswa' : 'tambahSiswaBaru'?>' class='col-lg-12'>
                                             <?php if($isEdit){ ?>
                                                  <input required type='hidden' name='idSiswa' id='idSiswa' placeholder='ID Siswa' 
                                                       class='form-control' value='<?=$detailSiswa['idSiswa']?>' />
                                             <?php } ?>

                                             <div class='row'>
                                                  <div class='form-group col-lg-6 col-md-6'>
                                                       <label for='namaSiswa'>Nama Siswa *</label>
                                                       <input required type='text' name='namasiswa' id='namaSiswa' placeholder='Nama Siswa' 
                                                            class='form-control' value='<?=($isEdit)? $detailSiswa['nama'] : ''?>' />
                                                  </div>
                                                  <div class='form-group col-lg-6 col-md-6'>
                                                       <label for='alamatSiswa'>Alamat Siswa *</label>
                                                       <textarea required name='alamatsiswa' id='alamatSiswa' 
                                                            placeholder='Alamat Siswa' class='form-control'><?=($isEdit)? $detailSiswa['alamat'] : ''?></textarea>
                                                  </div>
                                                  <div class='form-group col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                                                       <label for='nomorTeleponSiswa'>Nomor Telepon Siswa</label>
                                                       <input type='number' name='nomorteleponsiswa' id='nomorTeleponSiswa' placeholder='Nomor Telepon Siswa' 
                                                            class='form-control'  value='<?=($isEdit)? $detailSiswa['noHP'] : ''?>'/>
                                                  </div>
                                                  <div class='form-group col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                                                       <label for='emailSiswa'>Email Siswa</label>
                                                       <input type='email' name='emailsiswa' id='emailSiswa' placeholder='Email Siswa'
                                                             class='form-control' value='<?=($isEdit)? $detailSiswa['email'] : ''?>'/>
                                                  </div>
                                                  <div class='form-group col-lg-4 col-md-4 col-sm-4 col-xs-4'>
                                                       <label for='nisSiswa'>NIS Siswa *</label>
                                                       <input required type='text' name='nissiswa' id='nisSiswa' placeholder='NIS Siswa' 
                                                            class='form-control'  value='<?=($isEdit)? $detailSiswa['nis'] : ''?>' />
                                                  </div>
                                                  <div class='form-group col-lg-2 col-md-2 col-sm-2 col-xs-2'>
                                                       <label for='jenisKelamin'>Jenis Kelamin *</label>
                                                       <select required name='jeniskelamin' id='jenisKelamin' class='form-control'>
                                                            <option value='L' <?=($isEdit && $detailSiswa['jenisKelamin'] === 'L')? 'selected' : ''?>>Laki - Laki</option>
                                                            <option value='P' <?=($isEdit && $detailSiswa['jenisKelamin'] === 'P')? 'selected' : ''?>>Perempuan</option>
                                                       </select>
                                                  </div>
                                                  <div class='form-group col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                                                       <label for='kelas'>Kelas *</label>
                                                       <select name='kelas' id='kelas' class='form-control'>
                                                            <?php 
                                                                 foreach($listKelas as $indexData => $kelas){
                                                                      ?>
                                                                           <option value='<?=$kelas['idKelas']?>' <?=($isEdit && $detailSiswa['kelas'] === $kelas['idKelas'])? 'selected' : ''?>><?=$kelas['namaKelas']?></option>
                                                                      <?php
                                                                 }
                                                            ?>
                                                       </select>
                                                  </div>
                                                  <?php if(false){ ?>
                                                       <div class='form-group col-lg-2 col-md-2 col-sm-2 col-xs-2'>
                                                            <label for='tahunAjaran'>Tahun Ajaran *</label>
                                                            <input required type='number' name='tahunajaran' id='tahunAjaran' placeholder='Tahun Ajaran Siswa' 
                                                                 class='form-control' value='<?=($isEdit)? $detailSiswa['tahunAjaran'] : ''?>'/>
                                                       </div>
                                                  <?php } ?>
                                             </div>
                                             <hr />
                                             <div class='row'>
                                                  <div class='form-group col-lg-4 col-md-6 col-sm-6 col-xs-6'>
                                                       <label for='namaIbuKandung'>Nama Ibu Kandung *</label>
                                                       <input required type='text' name='namaibukandung' id='namaIbuKandung' placeholder='Nama Ibu Kandung' 
                                                            class='form-control' value='<?=($isEdit)? $detailSiswa['namaIbuKandung'] : ''?>' />
                                                  </div>
                                                  <div class='form-group col-lg-4 col-md-6 col-sm-6 col-xs-6'>
                                                       <label for='namaAyahKandung'>Nama Ayah Kandung *</label>
                                                       <input required type='text' name='namaayahkandung' id='namaAyahKandung' placeholder='Nama Ayah Kandung' 
                                                            class='form-control' value='<?=($isEdit)? $detailSiswa['namaAyahKandung'] : ''?>' />
                                                  </div>
                                                  <div class='form-group col-lg-4 col-md-12 col-sm-12 col-xs-12'>
                                                       <label for='nomorHPOrangTua'>Nomor HP Ayah atau Ibu *</label>
                                                       <input required type='number' name='nomorhporangtua' id='nomorHPOrangTua' placeholder='Nomor HP Ayah / Ibu' 
                                                            class='form-control' value='<?=($isEdit)? $detailSiswa['noHPOrangTua'] : ''?>' />
                                                  </div>
                                             </div>
                                             <hr />
                                             <div class='row'>
                                                  <div class='col-lg-12'>
                                                       <button type='submit' class='btn btn-success'><?=($isEdit)? 'Simpan Perubahan Data Siswa' : 'Simpan Data Siswa'?></button>
                                                       <a href='<?=site_url('siswa')?>'><button type='button' class='btn btn-danger'>Kembali ke List Siswa</button></a>
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
                    'dataNotFoundTitle' =>   'Siswa Tidak Dikenal', 
                    'dataNotFoundDesc'  =>   'Sistem tidak menemukan data siswa yang berkaitan !',
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

<script src='<?=base_url('assets/AdminLTE/plugins/select2/js/select2.min.js')?>'></script>
<link href='<?=base_url('assets/AdminLTE/plugins/select2/css/select2.min.css')?>' rel='stylesheet' />

<script language='Javascript'>
     $('#tambahSiswaBaru, #editSiswa').on('submit', function(e){
          e.preventDefault();
          let formData   =    $(this).serialize();

          $.ajax({
               url  : '<?=base_url('siswa/addSiswa')?>',
               type : 'POST',
               data : formData,
               success : function(responseFromServer){
                    let JSONResponse    =    JSON.parse(responseFromServer);
                    if(JSONResponse.addSiswa === true){
                         window.location.href     =    '<?=site_url("siswa/listsiswa")?>';
                    }else{
                         Swal.fire({
                              title : 'Penyimpanan Data Siswa Baru',
                              html : `Penyimpanan data siswa baru gagal ! <b class='text-danger'>${JSONResponse.message}</b>, Coba ulangi lagi !`,
                              type : 'error'
                         });
                    }
               }
          })
     });
     
     $('[data-toggle="tooltip"]').tooltip();
     $('#kelas').select2();

     $('.select2-selection').css('height', 'calc(2.25rem + 2px)');
</script>