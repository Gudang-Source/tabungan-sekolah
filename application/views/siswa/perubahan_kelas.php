<!DOCTYPE html>
<html>
<?php $this->load->view('components/head'); ?>
<?php $this->load->view('components/body-open'); ?>
<?php $this->load->view('components/navbar'); ?>
<?php $this->load->view('components/sidebar'); ?>

<style type="text/css">
     .naikTurun {
          animation-name: naikTurun;
          animation-duration: .5s;
          animation-iteration-count: 1;
     }

     @keyframes naikTurun {
          0% {
               margin-top: 10px;
          }

          50% {
               margin-top: -20px;
          }

          100% {
               margin-top: 0;
          }
     }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
          <div class="container-fluid">
               <div class="row mb-2">
                    <div class="col-sm-6">
                         <h1 class="m-0 text-dark">Perubahan Kelas Masal</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                              <li class="breadcrumb-item"><a href="#">Home</a></li>
                              <li class="breadcrumb-item active">Perubahan Kelas Siswa Masal</li>
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
                                        <div class='col-12 text-left'>
                                             <h3 class="card-title">
                                                  <i class="fas fa-home mr-1"></i>
                                                  Perubahan Kelas Masal
                                             </h3>
                                        </div>
                                   </div>
                              </div><!-- /.card-header -->
                              <div class="card-body">
                                   <div class="row">
                                        <div class="col-12">
                                             <form id="formAsalKelas">
                                                  <div id="filterData" class="row">
                                                       <div class="col-12">
                                                            <label for="asalKelas">Asal Kelas</label>
                                                            <select name="asalKelas" id="asalKelas" class="form-control form-control-sm">
                                                                 <option value="">-- Pilih Asal Kelas --</option>
                                                                 <?php 
                                                                      $listKelas     =    $this->db->get('ts_kelas');
                                                                      if($listKelas->num_rows() >= 1){
                                                                           foreach($listKelas->result_array() as $indexData => $kelas){
                                                                                ?>
                                                                                     <option value="<?=$kelas['idKelas']?>"><?=$kelas['namaKelas']?></option>
                                                                                <?php
                                                                           }
                                                                      }
                                                                 ?>
                                                            </select>
                                                       </div>
                                                  </div>
                                                  <hr>
                                                  <button class="btn btn-success btn-sm" type='submit'>
                                                       <span class='fas fa-search mr-2'></span>
                                                       Lakukan Filter Data
                                                  </button>
                                             </form>
                                        </div>
                                   </div>
                              </div><!-- /.card-body -->
                         </div>
                         
                         <div class="card" id='cardListSiswa' style='display:none'>
                              <div class="card-header">
                                   <div class='row'>
                                        <div class='col-12 text-left'>
                                             <h3 class="card-title">
                                                  <i class="fas fa-users mr-1"></i>
                                                  List Siswa
                                             </h3>
                                        </div>
                                   </div>
                              </div><!-- /.card-header -->
                              <div class="card-body">
                                   <div class="row" id='listSiswa'>
                                   </div>
                              </div>
                         <!-- /.card -->
                    </section>
                    <!-- /.Left col -->
               </div>
               <!-- /.row (main row) -->
          </div><!-- /.container-fluid -->
     </section>
     <!-- /.content -->
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

     $('[data-toggle="tooltip"]').tooltip();
     $('#asalKelas').select2();
     
     $('.select2-selection').css('height', 'calc(1.8125rem + 2px)');

     $('#formAsalKelas').on('submit', function(e){
          e.preventDefault();
          
          let formData   =    $(this).serialize();

          $('#cardListSiswa').css('opacity', '0.5');
          
          $.ajax({
               url: '<?= base_url('JSON/listSiswaInKelas') ?>',
               type: 'POST',
               data: `${formData}&withListKelas=true`,
               success: function(responseFromServer) {
                    let JSONResponse    =    JSON.parse(responseFromServer);
                    let listSiswa       =    JSONResponse.listSiswa;
                    let listKelas       =    JSONResponse.listKelas;

                    let rowsListSiswa  =    '';
                    let rowsListKelas  =    '';

                    if(listKelas.length >= 1){
                         for(let i = 0; i<listKelas.length; i++){
                              let dataKelas  =    listKelas[i];

                              rowsListKelas      +=   `<option value='${dataKelas['idKelas']}'>${dataKelas['namaKelas']}</option>`;
                         }
                    }

                    if(listSiswa.length >= 1){
                         for(let i = 0; i<listSiswa.length; i++){
                              let dataSiswa  =    listSiswa[i];

                              rowsListSiswa      +=   `<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>
                                                            <div class="custom-control custom-checkbox">
                                                                 <input class="custom-control-input" type="checkbox" checked="checked" name='checkedSiswa[]' 
                                                                      value='${dataSiswa.idSiswa}' id='siswa${dataSiswa.idSiswa}'>
                                                                 <label for="siswa${dataSiswa.idSiswa}" class="custom-control-label cp" style='font-weight:unset !important'>
                                                                      <h5>${dataSiswa.nama}</h5>
                                                                      <p class='text-sm mb-1 text-muted' style='font-weight:none'>NIS ${dataSiswa.nis}</p>
                                                                      <p class='text-sm mb-0 text-muted' style='font-weight:none'>Alamat ${dataSiswa.alamat}</p>
                                                                 </label>
                                                            </div>
                                                       </div>`;
                         }

                         $('#listSiswa').html(`
                              <form id='siswaBerubahKelas' class='col-12' onsubmit='siswaBerubahKelas(event, this)'>
                                   <div class='row'>${rowsListSiswa}</div>
                                   <hr />
                                   <div class='row'>
                                        <div class='col-12'>
                                             <select name='selectedKelas' class='form-control' id='selectedKelas'>
                                                  <option value=''>-- Kelas Tujuan --</option>
                                                  ${rowsListKelas}
                                             </select>
                                        </div>
                                   </div>
                                   <hr />
                                   <div class='row'>
                                        <div class='col-12'>
                                             <button class='btn btn-success btn-sm' type='submit' id='ubahKelasBtn'>Ubah Kelas</button>
                                        </div>
                                   </div>
                              </form>
                         `);

                         $('#selectedKelas').select2();
                    }else{
                         $('#listSiswa').html(`<?php $this->load->view('components/data-not-found', [
                                   'dataNotFoundTitle' => 'Kelas Kosong', 
                                   'dataNotFoundDesc' => 'Tidak ada siswa yang terdaftar di kelas ini !',
                                   'containerClass'    =>   'col-12'
                              ]); ?>`);
                    }

                    $('#cardListSiswa').css('opacity', '1');

                    $('#cardListSiswa').addClass('naikTurun');
                    $('#cardListSiswa').show();

                    setTimeout(() => {
                         $('#cardListSiswa').removeClass('naikTurun');
                    }, 3000);
               }
          });
     });

     function siswaBerubahKelas(e, el){
          e.preventDefault();

          el   =    $(el);
          let formData   =    el.serialize();

          let btnSubmit       =    el.find('#ubahKelasBtn');
          let btnSubmitText   =    btnSubmit.text();

          btnSubmit.prop('disabled', true).text('Processing ..');
          $.ajax({
               url  :    '<?=site_url("siswa/ubahKelas")?>',
               data :    formData,
               type :    'POST',
               success  :    function(responseFromServer){
                    let JSONResponse    =    JSON.parse(responseFromServer);
                    
                    let message, type, textColor;
                    if(JSONResponse.ubahKelas === true){
                         message   =    'Berhasil Mengubah Kelas Siswa !';
                         type      =    'success';
                         textColor =    'success';
                    }else{
                         message   =    'Gagal Mengubah Kelas Siswa !';
                         type      =    'error';
                         textColor =    'danger';
                    }

                    btnSubmit.prop('disabled', false).text(btnSubmitText);

                    Swal.fire({
                         title     :    'Ubah Kelas Masal',
                         html      :    `<b class='text-${textColor}'>${message}</b>`,
                         type
                    }).then(() => {
                         if(JSONResponse.ubahKelas){
                              location.reload();
                         }
                    });
               }
          });
     }
</script>