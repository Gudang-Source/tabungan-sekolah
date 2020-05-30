<!DOCTYPE html>
<html>
<?php $this->load->view('components/head'); ?>
<?php $this->load->view('components/body-open'); ?>
<?php $this->load->view('components/navbar'); ?>
<?php $this->load->view('components/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style='position:relative;'>
     <?php if(($isEdit  && $detailUser !== null) || ($isEdit === false)){ ?>
          <!-- Content Header (Page header) -->
          <div class="content-header">
               <div class="container-fluid">
                    <div class="row mb-2">
                         <div class="col-sm-6">
                              <h1 class="m-0 text-dark"><?=($isEdit)? 'Edit Data User' : 'User Baru'?></h1>
                              <?php if($isEdit){ ?>
                                   <p class='mb-0 ml-1'><?=$detailUser['nama']?></p>
                              <?php } ?>
                         </div><!-- /.col -->
                         <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                   <li class="breadcrumb-item"><a href="#">Home</a></li>
                                   <li class="breadcrumb-item active"><?=($isEdit)? 'Edit Data User' : 'Tambah User Baru'?></li>
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
                                                       <i class="fas fa-user mr-1"></i>
                                                       <?=($isEdit)? 'Edit Data User' : 'User Baru'?>
                                                  </h3>
                                             </div>
                                             <div class='col-lg-8 col-md-4 col-sm-4 col-xs-4 text-right'>
                                                  <a href='<?=site_url('user')?>'>
                                                       <i class="fas fa-times text-danger cp" data-toggle='tooltip'
                                                            data-placement='top' title='List User'></i>
                                                  </a>
                                             </div>
                                        </div>
                                   </div><!-- /.card-header -->
                                   <div class="card-body">
                                        <form id='<?=($isEdit)? 'editUser' : 'tambahUserBaru'?>' class='col-lg-12'>
                                             <?php if($isEdit){ ?>
                                                  <input type='hidden' name='idUser' id='idUser' placeholder='ID User' 
                                                            class='form-control' value='<?=$detailUser['idUser']?>' />
                                             <?php } ?>
                                             <div class='row'>
                                                  <div class='form-group col-lg-6 col-md-6'>
                                                       <label for='namaUser'>Nama User *</label>
                                                       <input required type='text' name='namaUser' id='namaUser' placeholder='Nama User' 
                                                            class='form-control' value='<?=($isEdit)? $detailUser['nama'] : '' ?>' />
                                                  </div>
                                                  <div class='form-group col-lg-6 col-md-6'>
                                                       <label for='alamatUser'>Alamat User *</label>
                                                       <textarea required name='alamatUser' id='alamatUser' placeholder='Alamat User' 
                                                            class='form-control'><?=($isEdit)? $detailUser['alamat'] : '' ?></textarea>
                                                  </div>
                                                  <div class='form-group col-lg-4 col-md-4'>
                                                       <label for='nomorTeleponUser'>Nomor Telepon User *</label>
                                                       <input required type='number' name='nomorTeleponUser' id='nomorTeleponUser' 
                                                            placeholder='Nomor Telepon User' class='form-control' 
                                                            value='<?=($isEdit)? $detailUser['noHP'] : '' ?>' />
                                                  </div>
                                                  <div class='form-group col-lg-4 col-md-4'>
                                                       <label for='emailUser'>Email User *</label>
                                                       <input required type='email' name='emailUser' id='emailUser' placeholder='Email User' 
                                                            class='form-control' value='<?=($isEdit)? $detailUser['email'] : '' ?>' />
                                                  </div>
                                                  <div class='form-group col-lg-4 col-md-4'>
                                                       <label for='levelUser'>Level User *</label>
                                                       <select required name='levelUser' id='levelUser' class='form-control'>
                                                            <option value='admin' <?=($isEdit && $detailUser['level'] === 'admin')? 'selected' : '' ?>>Admin</option>
                                                            <option value='superadmin' <?=($isEdit && $detailUser['level'] === 'superadmin')? 'selected' : '' ?>>Super Admin</option>
                                                       </select>
                                                  </div>
                                             </div>
                                             <hr />
                                             <div class='row'>
                                                  <div class='form-group col-lg-<?=($isEdit)? '12' : '4'?> col-md-<?=($isEdit)? '12' : '6'?>'>
                                                       <label for='username'>Username *</label>
                                                       <input required type='text' name='username' id='username' placeholder='Nama Pengguna' 
                                                            class='form-control' value='<?=($isEdit)? $detailUser['username'] : '' ?>' />
                                                  </div>
                                                  <?php if($isEdit === false){ ?>
                                                       <div class='form-group col-lg-4 col-md-6'>
                                                            <label for='password'>Password *</label>
                                                            <div class="input-group password-container">                                 
                                                                 <input required type='password' name='password' id='password' placeholder='Password' 
                                                                      class='form-control password' />
                                                                 <div class="input-group-append">
                                                                      <span class="input-group-text cp">
                                                                           <i passwordState='hidden' class="toggle-password fas fa-eye"></i>
                                                                      </span>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class='form-group col-lg-4 col-md-12'>
                                                            <label for='konfirmasipassword'>Konfirmasi Password *</label>
                                                            <div class="input-group password-container">                                 
                                                                 <input required type='password' name='konfirmasiPassword' id='konfirmasipassword' placeholder='Ulangi Password' 
                                                                      class='form-control password' />
                                                                 <div class="input-group-append">
                                                                      <span class="input-group-text cp">
                                                                           <i passwordState='hidden' class="toggle-password fas fa-eye"></i>
                                                                      </span>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  <?php } ?>
                                             </div>
                                             <hr />
                                             <div class='row'>
                                                  <div class='col-lg-12'>
                                                       <button type='submit' class='btn btn-success'>Simpan <?=($isEdit)? 'Perubahan' : ''?> Data User</button>
                                                       <a href='<?=site_url('user')?>'><button type='button' class='btn btn-danger'>Kembali ke List User</button></a>
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
                    'dataNotFoundTitle' =>   'User Tidak Dikenal', 
                    'dataNotFoundDesc'  =>   'Sistem tidak menemukan data user yang berkaitan !',
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
     $('#tambahUserBaru, #editUser').on('submit', function(e){
          e.preventDefault();

          let formData   =    $(this).serialize();

          $.ajax({
               url  : '<?=($isEdit)? base_url('user/editUser') : base_url('user/addUser')?>',
               type : 'POST',
               data : formData,
               success : function(responseFromServer){
                    let JSONResponse    =    JSON.parse(responseFromServer);
                    if(JSONResponse.addUser === true){
                         window.location.href     =    '<?=site_url("user/listuser")?>';
                    }else{
                         let cause      =    JSONResponse.messageToClient;
                         Swal.fire({
                              title : 'Penambahan Data User Baru',
                              html : `Penambahan data User baru gagal dikarenakan <b class="text-danger">${cause}</b> Coba ulangi lagi !`,
                              type : 'error'
                         });
                    }
               }
          })
     });
</script>
<?php if($isEdit === false){ ?>
     <script language='Javascript'>
          $('.toggle-password').on('click', function(){
               let parent     =    $(this).parents('.input-group');

               let thisEl     =    $(this);
               let passwordState   =    thisEl.attr('passwordState');
               let classValue, newPasswordState, newPasswordType;

               if(passwordState === 'hidden'){
                    classValue          =    'fa fa-eye-slash';
                    newPasswordState    =    'show';
                    newPasswordType     =    'text';
               }else{
                    classValue          =    'fa fa-eye';
                    newPasswordState    =    'hidden';
                    newPasswordType     =    'password';
               }

               thisEl.attr('class', classValue);
               thisEl.attr('passwordState', newPasswordState);
               parent.find('.password').attr('type', newPasswordType);
          });
          
          $('[data-toggle="tooltip"]').tooltip();
     </script>
<?php } ?>