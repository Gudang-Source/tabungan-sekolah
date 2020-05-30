<!DOCTYPE html>
<html>
<?php $this->load->view('components/head'); ?>
<?php $this->load->view('components/body-open'); ?>
<?php $this->load->view('components/navbar'); ?>
<?php $this->load->view('components/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
          <div class="container-fluid">
               <div class="row mb-2">
                    <div class="col-sm-6">
                         <h1 class="m-0 text-dark">User</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                              <li class="breadcrumb-item"><a href="#">Home</a></li>
                              <li class="breadcrumb-item active">User</li>
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
                                        <div class='col-lg-4 text-left'>
                                             <h3 class="card-title">
                                                  <i class="fas fa-user mr-1"></i>
                                                  User Terdaftar
                                             </h3>
                                        </div>
                                        <div class='col-lg-8 text-right'>
                                             <a href='<?=site_url('user/add')?>'>
                                                  <i class="fas fa-plus text-success cp" data-toggle='tooltip'
                                                       data-placement='top' title='Tambah User Baru'></i>
                                             </a>
                                        </div>
                                   </div>
                              </div><!-- /.card-header -->
                              <div class="card-body">
                                    <?php if(count($dataUser) >= 1){ ?>
                                        <div class='table-responsive'>
                                             <table class='table table-sm table-striped table-bordered' id='tabel-user'>
                                                  <thead>
                                                       <tr>
                                                            <th class='text-center'>No.</th>
                                                            <th class='text-left'>Nama</th>
                                                            <th class='text-left'>Username</th>
                                                            <th class='text-left'>Email</th>
                                                            <th class='text-center'>Status</th>
                                                            <th class='text-center'>Opsi</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <?php foreach($dataUser as $indexData => $data){ ?>
                                                            <tr class='text-sm tr-row'>
                                                                 <td class='vam text-center text-bold'><?=$indexData+1?>.</td>
                                                                 <td class='vam text-left'>
                                                                      <h6 class='mt-1 mb-1'><?=$data['nama']?></h6>
                                                                      <p class='text-muted mb-1' style='font-size:8pt !important'><?=$data['alamat']?></p>
                                                                      <p class='mt-1 mb-1' style='font-size:8pt !important'>Telepon <?=$data['noHP']?></p>
                                                                 </td>
                                                                 <td class='vam text-left'>
                                                                      <p class='mb-1'><?=$data['username']?></p>
                                                                      <span class='badge badge-success'>as <?=$data['level']?></span>
                                                                 </td>
                                                                 <td class='vam text-left'><?=$data['email']?></td>
                                                                 <td class='vam text-center'>
                                                                      <?php $badgeColor = (strtolower($data['status']) === 'aktif')? 'success' : 'danger'; ?>
                                                                      <span class='badge-status badge badge-<?=$badgeColor?>'><?=$data['status']?></span>
                                                                 </td>
                                                                 <td class="vam text-center">
                                                                      <?php 
                                                                           $iconColor     = (strtolower($data['status']) === 'aktif')? 'danger':'success';
                                                                           $toolTipText   = (strtolower($data['status']) === 'aktif')? 'Nonaktifkan':'Aktifkan'; 
                                                                      ?>
                                                                      <a href='<?=site_url("user/edit/".$data['idUser'])?>'>
                                                                           <span class='fas fa-edit cp text-warning'
                                                                                data-toggle='tooltip' data-placement='left' title='Edit User'></span>
                                                                      </a>
                                                                      <span class='fas fa-power-off cp ml-1 mr-1 text-<?=$iconColor?>'
                                                                           data-toggle='tooltip' data-placement='top' title='<?=$toolTipText?> User'
                                                                           onclick='changeStatusUser(this, <?=$data["idUser"]?>, "<?=$data["nama"]?>", "<?=$data["status"]?>")'></span>
                                                                      <span class='fas fa-trash cp text-danger'
                                                                           data-toggle='tooltip' data-placement='bottom' title='Hapus User'
                                                                           onclick='deleteUser(this, <?=$data["idUser"]?>, "<?=$data["nama"]?>")'></span>
                                                                 </td>
                                                            </tr>
                                                       <?php } ?>
                                                  </tbody>
                                             </table>
                                        </div>
                                   <?php }else{
                                             $notFoundData  =    [
                                                  'noDataTitle'  =>   'Data User',
                                                  'noDataDesc'   =>   'Data User Tidak Ditemukan, atau Mungkin Data User Kosong !'
                                             ];

                                             $this->load->view('components/no-data', $notFoundData);
                                             ?>
                                             <div class='text-center mb-3'>
                                                  <a href='<?=site_url('user/add')?>'><button class='btn btn-success btn-sm'>Tambah User Baru</button></a>
                                             </div>
                                             <?php
                                        } ?>
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
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('components/footer'); ?>
<?php $this->load->view('components/control-sidebar'); ?>
<?php $this->load->view('components/body-close'); ?>

</html>

<script src='<?=base_url('assets/AdminLTE/plugins/datatables/jquery.dataTables.js')?>'></script>
<script src='<?=base_url('assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js')?>'></script>
<link href='<?=base_url('assets/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.css')?>' rel='stylesheet' />

<script src='<?=base_url('assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.js')?>'></script>
<link href='<?=base_url('assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.css')?>' rel='stylesheet' />

<script language='Javascript'>
     $('#tabel-user').DataTable();

     $('[data-toggle="tooltip"]').tooltip();

     function deleteUser(el, idUser, namaUser){
          el   =    $(el);
          Swal.fire({
               title: 'Konfirmasi Hapus Data',
               html: `Apakah anda yakin akan menghapus data user <b class='text-danger'>${namaUser}</b> ?`,
               showConfirmButton: true,
               showCancelButton: true,
               type: 'question',
               confirmButtonColor: '#dc3545',
               cancelButtonColor: '#28a745',
               confirmButtonText : 'Lanjutkan Hapus',
               cancelButtonText : 'Batalkan',
               focusCancel: true
          }).then(konfirmasi => {
               if (konfirmasi.value === true) {
                    $.ajax({
                         url: '<?= base_url('user/deleteUser') ?>',
                         type: 'POST',
                         data: `idUser=${idUser}`,
                         success: function(responseFromServer) {
                              let JSONResponse = JSON.parse(responseFromServer);
                              if (JSONResponse.deleteUser === true) {
                                   el.parents('.tr-row').remove();
                              }else{
                                   Swal.fire('Hapus User', 'Gagal Menghapus User', 'error');
                              }
                         }
                    });
               }
          })
     }
     function changeStatusUser(el, idUser, namaUser, statusUser){
          el   =    $(el);

          let actionMessage, actionTitle, akibat, onClickAttr, classAttr, tooltipText, badgeText, badgeClass;
          if(statusUser.toLowerCase() === 'aktif'){
               actionTitle    =    'Penonaktifan User';
               actionMessage  =    'menonaktifkan';
               akibat         =    'Ini akan membuat user tidak dapat login ke dalam sistem hingga anda mengaktifkannya kembali.';
               classAttr      =    'fas fa-power-off cp ml-1 mr-1 text-success';
               onClickAttr    =    `changeStatusUser(this, ${idUser}, "${namaUser}", "nonaktif")`;
               tooltipText    =    'Aktifkan User';
               badgeText      =    'nonaktif';
               badgeClass     =    'badge-status badge badge-danger';
          }else{
               actionTitle  =    'Pengaktifan User';
               actionMessage  =    'mengaktifkan';
               akibat    =    'Ini akan membuat user dapat login kembali ke dalam sistem.';
               classAttr      =    'fas fa-power-off cp ml-1 mr-1 text-danger';
               onClickAttr    =    `changeStatusUser(this, ${idUser}, "${namaUser}", "aktif")`;
               tooltipText    =    'Nonaktifkan User';
               badgeText      =    'aktif';
               badgeClass     =    'badge-status badge badge-success';
          }

          Swal.fire({
               title: `Konfirmasi ${actionTitle}`,
               html: `Apakah anda yakin akan ${actionMessage} data user <b class='text-danger'>${namaUser}</b> ? ${akibat}`,
               showConfirmButton: true,
               showCancelButton: true,
               type: 'question',
               confirmButtonColor: '#dc3545',
               cancelButtonColor: '#28a745',
               confirmButtonText : 'Lanjutkan',
               cancelButtonText : 'Batalkan',
               focusCancel: true
          }).then(konfirmasi => {
               if (konfirmasi.value === true) {
                    $.ajax({
                         url: '<?= base_url('user/changeStatusUser') ?>',
                         type: 'POST',
                         data: `idUser=${idUser}&`,
                         success: function(responseFromServer) {
                              let JSONResponse = JSON.parse(responseFromServer);
                              if (JSONResponse.changeStatusUser === true) {
                                   el.attr('class', classAttr);
                                   el.attr('onClick', onClickAttr);
                                   el.attr('data-original-title', tooltipText);
                                   el.parents('.tr-row').find('.badge-status').text(badgeText);
                                   el.parents('.tr-row').find('.badge-status').attr('class', badgeClass);
                              }else{
                                   Swal.fire(actionTitle, `Gagal ${actionMessage} user`, 'error');
                              }
                         }
                    });
               }
          })
     }
</script>