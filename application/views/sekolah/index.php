<?php 
     $userLevel     =    $this->session->userdata('level');
?>
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
                         <h1 class="m-0 text-dark">Sekolah</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                              <li class="breadcrumb-item"><a href="#">Home</a></li>
                              <li class="breadcrumb-item active">Sekolah</li>
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
                                                  Sekolah Terdaftar
                                             </h3>
                                        </div>
                                        <div class='col-lg-8 text-right'>
                                             <?php if($userLevel === 'superadmin'){ ?>
                                                  <a href='<?=site_url('sekolah/add')?>'>
                                                       <i class="fas fa-plus text-success cp" data-toggle='tooltip'
                                                            data-placement='top' title='Tambah Sekolah Baru'></i>
                                                  </a>
                                             <?php } ?>
                                        </div>
                                   </div>
                              </div><!-- /.card-header -->
                              <div class="card-body">
                                   <?php if(count($dataSekolah) >= 1){ ?>
                                        <div class='table-responsive'>
                                             <table class='table table-sm table-bordered table-striped' id='tabel-sekolah'>
                                                  <thead>
                                                       <tr>
                                                            <th class='text-center'>No.</th>
                                                            <th class='text-left'>Nama</th>
                                                            <th class='text-left'>Email</th>
                                                            <th class='text-left'>Tgl. Pendiri</th>
                                                            <?php if($userLevel === 'superadmin'){ ?>
                                                                 <th class='text-center'>Opsi</th>
                                                            <?php } ?>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <?php foreach($dataSekolah as $indexData => $data){ ?>
                                                            <tr class='text-sm tr-row'>
                                                                 <td class='vam text-center text-bold'><?=$indexData+1?>.</td>
                                                                 <td class='vam text-left'>
                                                                      <h6 class='text-bold mt-1 mb-1'><?=$data['nama']?></h6>
                                                                      <p class='text-muted mb-1' style='font-size:8pt !important'><?=$data['alamat']?></p>
                                                                      <p class='mt-1 mb-1' style='font-size:8pt !important'>Telepon <?=$data['noHP']?></p>
                                                                 </td>
                                                                 <td class='vam text-left'><?=$data['email']?></td>
                                                                 <td class='vam text-left'>
                                                                      <?=date('D, M d Y', strtotime($data['tglPendiri']))?>
                                                                 </td>
                                                                 <?php if($userLevel === 'superadmin'){ ?>
                                                                      <td class='vam text-center'>
                                                                           <a href='<?=site_url('sekolah/edit/')?><?=$data["idSekolah"]?>'>
                                                                                <span class='fas fa-edit text-warning cp' data-toggle='tooltip'
                                                                                     data-placement='bottom' title='Edit Data Sekolah'></span>
                                                                           </a>
                                                                           <span class='fas fa-trash text-danger cp ml-1' 
                                                                                onclick='deleteSekolah(this, <?=$data["idSekolah"]?>, "<?=$data["nama"]?>")'
                                                                                data-toggle='tooltip' data-placement='top' title='Hapus Sekolah'></span>
                                                                      </td>
                                                                 <?php } ?>
                                                            </tr>
                                                       <?php } ?>
                                                  </tbody>
                                             </table>
                                        </div>
                                   <?php }else{
                                        $notFoundData  =    [
                                             'noDataTitle'  =>   'Data Sekolah',
                                             'noDataDesc'   =>   'Data Sekolah Tidak Ditemukan, atau Mungkin Data Sekolah Kosong !'
                                        ];

                                        $this->load->view('components/no-data', $notFoundData);
                                        ?>
                                        <?php if($userLevel === 'superadmin'){ ?>
                                             <div class='text-center mb-3'>
                                                  <a href='<?=site_url('sekolah/add')?>'><button class='btn btn-success btn-sm'>Tambah Sekolah Baru</button></a>
                                             </div>
                                             <?php } ?>
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
     $('#tabel-sekolah').DataTable();
     
     $('[data-toggle="tooltip"]').tooltip();
</script>
<?php if($userLevel === 'superadmin'){ ?>
     <script language='Javascript'>                              
          function deleteSekolah(el, idSekolah, namaSekolah){
               el   =    $(el);
               Swal.fire({
                    title: 'Konfirmasi Hapus Data',
                    html: `Apakah anda yakin akan menghapus data sekolah <b class='text-danger'>${namaSekolah}</b> ?`,
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
                              url: '<?= base_url('sekolah/deleteSekolah') ?>',
                              type: 'POST',
                              data: `idSekolah=${idSekolah}`,
                              success: function(responseFromServer) {
                                   let JSONResponse = JSON.parse(responseFromServer);
                                   if (JSONResponse.deleteSekolah === true) {
                                        el.parents('.tr-row').remove();
                                   }else{
                                        Swal.fire('Hapus Sekolah', 'Gagal Menghapus Sekolah', 'error');
                                   }
                              }
                         });
                    }
               })
          }
     </script>
<?php } ?>