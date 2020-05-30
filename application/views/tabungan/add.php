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
                                             <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4 text-left'>
                                                  <h3 class="card-title">
                                                       <i class="fas fa-users mr-1"></i>
                                                       <?=($isEdit)? 'Edit Data Tabungan':'Tabungan Baru'?>
                                                  </h3>
                                             </div>
                                             <div class='col-lg-8 col-md-8 col-sm-8 col-xs-8 text-right'>
                                                  <a href='<?=site_url('tabungan')?>'>
                                                       <i class="fas fa-times text-danger cp" data-toggle='tooltip'
                                                            data-placement='top' title='List Tabungan'></i>
                                                  </a>
                                             </div>
                                        </div>
                                   </div><!-- /.card-header -->
                                   <div class="card-body">
                                             <div class='row'>
                                                  <div class='form-group col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                                                       <label for='siswaPemilikTabungan'>Siswa Pemilik Tabungan *</label>
                                                       <div class="input-group">
                                                            <!-- <input required type='text' name='siswaPemilikTabungan' id='siswaPemilikTabungan' 
                                                                 placeholder='Cari berdasarkan Nama, NIS, Email ataupun Nomor HP Siswa / Orang Tua' 
                                                                 class='form-control' /> -->
                                                            <select required name="siswaPemilikTabungan" id="siswaPemilikTabungan" class="form-control">
                                                                 <option value="">-- Siswa Yang Belum Memiliki Tabungan --</option>
                                                                 <?php 
                                                                      $query    =    'select s.idSiswa, s.nis, s.nama from ts_siswa s left join ts_tabungan t on t.idSiswa=s.idSiswa where idTabungan is NULL';
                                                                      $siswaTidakPunyaTabungan      =    $this->db->query($query);

                                                                      foreach($siswaTidakPunyaTabungan->result_array() as $indexData => $siswa){
                                                                           ?>
                                                                                <option value="<?=$siswa['idSiswa']?>" nama='<?=$siswa['nama']?>'>
                                                                                     <?=$siswa['nama']?> | <?=$siswa['nis']?>
                                                                                </option>
                                                                           <?php
                                                                      }
                                                                 ?>
                                                            </select>
                                                            <div class="input-group-append" id='klikSiswaPemilikTabungan'>
                                                                 <div class="input-group-text cp">
                                                                      <span class="fas fa-search text-success"></span>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </form>
                                   </div><!-- /.card-body -->
                              </div>
                              <!-- /.card -->
                         </section>
                         <!-- /.Left col -->
                    </div>
                    <div class="row" id='listSiswa' style='position:relative !important'>
                    </div>
                    <!-- /.row (main row) -->
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

<script src='<?=base_url('assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.js')?>'></script>
<link href='<?=base_url('assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.css')?>' rel='stylesheet' />

<script src='<?=base_url('assets/AdminLTE/plugins/select2/js/select2.min.js')?>'></script>
<link href='<?=base_url('assets/AdminLTE/plugins/select2/css/select2.min.css')?>' rel='stylesheet' />

<script language='Javascript'>
     let idSiswaGlobal   =    0;

     // $('#tambahTabunganBaru, #editTabungan').on('submit', function(e){
     //      e.preventDefault();
     //      let formData   =    $(this).serialize();

     //      $.ajax({
     //           url  : '<?=base_url('tabungan/addTabungan')?>',
     //           type : 'POST',
     //           data : formData,
     //           success : function(responseFromServer){
     //                let JSONResponse    =    JSON.parse(responseFromServer);
     //                if(JSONResponse.addTabungan === true){
     //                     window.location.href     =    '<?=site_url("tabungan/listtabungan")?>';
     //                }else{
     //                     Swal.fire({
     //                          title : 'Penyimpanan Data Tabungan Baru',
     //                          html : `Penyimpanan data tabungan baru gagal ! <b class='text-danger'>${JSONResponse.message}</b>, Coba ulangi lagi !`,
     //                          type : 'error'
     //                     });
     //                }
     //           }
     //      })
     // });
     
     $('[data-toggle="tooltip"]').tooltip();

     $('#klikSiswaPemilikTabungan').on('click', function(e){
          e.preventDefault();

          let value      =    $('#siswaPemilikTabungan').find('option:selected').attr('nama');
          cariSiswa(value);
     });

     $('#siswaPemilikTabungan').on('keyup', function(e){
          let keyCode    =    Number.parseInt(e.keyCode);
          let value      =    $(this).val();

          if(keyCode === 13){
               cariSiswa(value);
          }
     });

     function cariSiswa(value){
          $.ajax({
               url       :    '<?=base_url('JSON/listSiswa')?>',
               type      :    'POST',
               data      :    `search=${value}&select=nama,email,alamat,noHP, idSiswa`,
               success   :    function(response){
                    let JSONResponse    =    JSON.parse(response);
                    let listSiswa  =    JSONResponse.listSiswa;

                    let listSiswaHTML   =    '';
                    if(listSiswa.length >= 1){
                         for(let i = 0; i<listSiswa.length; i++){
                              let dataSiswa  =    listSiswa[i];
                              listSiswaHTML  +=   `<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" 
                                                       style='display:flex;flex-direction:column;'>
                                                       <div class="card">
                                                            <div class="card-body text-center">
                                                                 <h5 class='mb-2'>${dataSiswa.nama}</h5>
                                                                 <p class='text-sm mb-1'>${dataSiswa.alamat}</p>
                                                                 <p class='mb-1' style='font-size:8pt'>${dataSiswa.noHP}</p>
                                                                 <p class='text-sm mt-2 text-info'>${dataSiswa.email}</p>
                                                                 <hr />
                                                                 <button class='btn btn-block btn-success btn-sm' style='border-radius:25px'
                                                                      onclick='pilihSiswa(this, ${dataSiswa.idSiswa})'>
                                                                      <span class='fas fa-check mr-2'></span>
                                                                      Pilih Siswa Ini
                                                                 </button>
                                                            </div>
                                                       </div>
                                                  </div>`;
                         }
                    }else{
                         listSiswaHTML  =    `
                              <div class='col-lg-12 text-center pb-5 pt-4'>
                                   <h1 class='text-red'>Data Siswa</h1>
                                   <img src='<?=base_url('assets/img/unknown-people.svg')?>' alt='Unknown People' 
                                        class='pb-2 pt-4 img-block' style='width:250px' />
                                   <p class='mb-0 mt-2 text-red'>Data Tidak Ditemukan Berdasarkan Pencarian !</p>
                              </div>
                         `
                    }
                    
                    $('#listSiswa').html(listSiswaHTML);
               }
          })
     }
     function pilihSiswa(el, idSiswa){
          idSiswa   =    Number.parseInt(idSiswa);
          idSiswaGlobal  =    idSiswa;

          el   =    $(el);
          let replaceHTML     =    `<form id='form-add-tabungan' onsubmit='simpanTabungan(event, this)'>
                                        <div class='form-group'>
                                             <input type='text' class='form-control form-control-sm' placeholder='Nama Tabungan' id='namaTabungan' name='namaTabungan' />
                                             <button class='btn mt-2 pl-3 pr-3 btn-success btn-sm' style='border-radius:25px' type='submit'>
                                                  <span class='fas fa-save mr-2'></span>
                                                  Simpan
                                             </button>
                                        </div>
                                   </form>`;

          el.replaceWith(replaceHTML);
     }
     function simpanTabungan(e, el){
          e.preventDefault();

          let formData   =    $(el).serialize();

          $.ajax({
               url  : '<?=base_url('tabungan/addTabungan')?>',
               type : 'POST',
               data : `${formData}&siswaPemilikTabungan=${idSiswaGlobal}`,
               success : function(responseFromServer){
                    let JSONResponse    =    JSON.parse(responseFromServer);
                    if(JSONResponse.addTabungan === true){
                         window.location.href     =    '<?=site_url("tabungan/listtabungan")?>';
                    }else{
                         Swal.fire({
                              title : 'Penyimpanan Data Tabungan Baru',
                              html : `Penyimpanan data tabungan baru gagal ! <b class='text-danger'>${JSONResponse.message}</b>, Coba ulangi lagi !`,
                              type : 'error'
                         });
                    }
               }
          });
     }

     $('#siswaPemilikTabungan').select2();
     $('.select2-selection').css('height', 'calc(2.25rem + 2px)');
</script>