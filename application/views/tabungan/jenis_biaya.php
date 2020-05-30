<?php 
     $userLevel     =    $this->session->userdata('level');
     // var_dump($dataJenisBiaya);
     // exit;
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
                         <h1 class="m-0 text-dark">Jenis Biaya Tabungan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                              <li class="breadcrumb-item"><a href="#">Home</a></li>
                              <li class="breadcrumb-item active">Jenis Biaya Tabungan</li>
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
                                                  Jenis Biaya Tabungan
                                             </h3>
                                        </div>
                                        <div class='col-8 text-right'>
                                             <a href='<?=site_url('tabungan/add_jenis_biaya')?>'>
                                                  <i class="fas fa-plus text-success cp" data-toggle='tooltip'
                                                       data-placement='top' title='Tambah Jenis Biaya Tabungan Baru'></i>
                                             </a>
                                        </div>
                                   </div>
                              </div><!-- /.card-header -->
                              <div class="card-body">
                                   <?php if(count($dataJenisBiaya) >= 1){ ?>
                                        <div class='table-responsive'>
                                             <table class='table table-sm table-bordered table-striped' id='tabelJenisBiaya'>
                                                  <thead>
                                                       <tr>
                                                            <th class='text-center'>No.</th>
                                                            <th class='text-left'>Nama Jenis Biaya</th>
                                                            <th class='text-left'>Catatan / Keterangan</th>
                                                            <th class='text-center'>Opsi</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <?php foreach($dataJenisBiaya as $indexData => $data){ ?>
                                                            <tr class='text-sm tr-row'>
                                                                 <td class='vam text-center text-bold'><?=$indexData+1?>.</td>
                                                                 <td class='vam text-left'>
                                                                      <h6 class='mt-1 mb-1'><?=$data['nama']?></h6>
                                                                 </td>
                                                                 <td class='vam text-left'><?=(strlen($data['keterangan']) >= 1)? $data['keterangan'] : '-'?></td>
                                                                 <td class='vam text-center'>
                                                                      <a href='<?=site_url("tabungan/edit_jenis_biaya/")?><?=$data['idJenisBiaya']?>'>
                                                                           <span class='fas fa-edit text-warning cp pr-1' data-toggle='tooltip'
                                                                                data-placement='left' title='Edit Jenis Biaya'></span>
                                                                      </a>
                                                                      <span class='fas fa-trash text-danger pl-1 cp' data-toggle='tooltip'
                                                                           data-placement='bottom' title='Hapus Jenis Biaya'
                                                                           onclick='deleteJenisBiaya(this, <?=$data["idJenisBiaya"]?>, "<?=$data["nama"]?>")'></span>
                                                                 </td>
                                                            </tr>
                                                       <?php } ?>
                                                  </tbody>
                                             </table>
                                        </div>
                                   <?php }else{
                                        $notFoundData  =    [
                                             'noDataTitle'  =>   'Data Jenis Biaya',
                                             'noDataDesc'   =>   'Data Jenis Biaya Tidak Ditemukan, atau Mungkin Data Kosong !'
                                        ];

                                        $this->load->view('components/no-data', $notFoundData);
                                        ?>
                                        <div class='text-center mb-3'>
                                             <a href='<?=site_url('tabungan/add_jenis_biaya')?>'><button class='btn btn-success btn-sm'>Tambah Jenis Biaya Baru</button></a>
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
     $('#tabelJenisBiaya').DataTable();

     $('[data-toggle="tooltip"]').tooltip()

     function deleteJenisBiaya(el, idJenisBiaya, namaJenisBiaya){
          el   =    $(el);
          Swal.fire({
               title: 'Konfirmasi Hapus Data',
               html: `Apakah anda yakin akan menghapus data jenis tabungan <b class='text-danger'>${namaJenisBiaya}</b> ?`,
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
                         url: '<?= base_url('tabungan/deleteJenisBiaya') ?>',
                         type: 'POST',
                         data: `idJenisBiaya=${idJenisBiaya}`,
                         success: function(responseFromServer) {
                              let JSONResponse = JSON.parse(responseFromServer);
                              if (JSONResponse.deleteJenisBiaya === true) {
                                   el.parents('.tr-row').remove();
                              }else{
                                   Swal.fire('Hapus JenisBiaya', 'Gagal Menghapus JenisBiaya', 'error');
                              }
                         }
                    });
               }
          })
     }
</script>