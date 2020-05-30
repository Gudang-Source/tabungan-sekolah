<?php 
     $userLevel     =    $this->session->userdata('level');
?>
<!DOCTYPE html>
<html>
<?php $this->load->view('components/head'); ?>
<?php $this->load->view('components/body-open'); ?>
<?php $this->load->view('components/navbar'); ?>
<?php $this->load->view('components/sidebar'); ?>

<?php  $this->load->view('kelas/add-kelas');  ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
          <div class="container-fluid">
               <div class="row mb-2">
                    <div class="col-sm-6">
                         <h1 class="m-0 text-dark">Kelas</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                              <li class="breadcrumb-item"><a href="#">Home</a></li>
                              <li class="breadcrumb-item active">Kelas</li>
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
                                                  <i class="fas fa-chart-pie mr-1"></i>
                                                  Kelas Terdaftar
                                             </h3>
                                        </div>
                                        <div class='col-lg-8 text-right'>
                                                  <span class='fas fa-plus text-success cp' onclick='showTambahKelasModal()'></span>
                                             
                                        </div>
                                   </div>
                              </div><!-- /.card-header -->
                              <div class="card-body">
                                   <div class='col-lg-12' id='cardBody'>

                                   </div>
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

<script language='Javascript'>
     function getListKelas() {
          $.ajax({
               url: '<?= base_url('kelas/JSONListKelas') ?>',
               type: 'POST',
               data: 'doJob=true',
               success: function(responseFromServer) {
                    let JSONResponse = JSON.parse(responseFromServer);
                    if (JSONResponse.listKelas.length >= 1) {
                         let rows = '';
                         for (let i = 0; i < JSONResponse.listKelas.length; i++) {
                              let index = i + 1;
                              let data = JSONResponse.listKelas[i];
                              rows      +=   `<tr class='text-sm tr-kelas'>
                                                  <td class='text-center text-bold'>${index}.</td>
                                                  <td class='text-left namaKelas'>${data.namaKelas}</td>
                                                  <td class='text-center'>
                                                       <span class='fa fa-edit mr-2 text-warning cp' 
                                                            onClick='editKelas(${data.idKelas}, ${JSON.stringify(data)})'
                                                            data-toggle='tooltip' data-placement='top' title='Edit Data Kelas'></span>
                                                       <span class='fa fa-trash ml-2 text-danger cp' 
                                                            onClick='deleteKelas(${data.idKelas}, "${data.namaKelas}")'
                                                            data-toggle='tooltip' data-placement='bottom' title='Hapus Data Kelas'></span>
                                                  </td>
                                             </tr>`;
                         }

                         let html = `<div class="table-responsive">
                                             <table class='table' id='tabel-kelas'>
                                                  <thead>
                                                       <tr>
                                                            <th class='text-center no-bt'>No.</th>
                                                            <th class='text-left no-bt'>Nama Kelas</th>
                                                            <th class='text-center no-bt'>Opsi</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody id='tbody'>
                                                       ${rows}
                                                  </tbody>
                                             </table>
                                        </div>`;
                         $('#cardBody').html(html);
                    } else {
                         <?php
                         $dataNoData    =    [
                              'noDataTitle'  =>   '',
                              'noDataDesc'   =>   'Data Kelas Tidak Ditemukan, atau Data Kelas Belum Ada'
                         ];
                         ?>
                         $('#cardBody').html(`<?php $this->load->view('components/no-data', $dataNoData); ?>`);
                    }

                    setTimeout(function(){
                         $('#tabel-kelas').DataTable();
                    }, 400);

               }
          });
     }
     getListKelas();

          setTimeout(function(){
               $('#tabel-kelas').DataTable();
          }, 400);

     function deleteKelas(idKelas, namaKelas) {
          Swal.fire({
               title: 'Konfirmasi Hapus Data',
               html: `Apakah anda yakin akan menghapus data kelas <b class='text-danger'>${namaKelas}</b> ?`,
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
                         url: '<?= base_url('kelas/deleteKelas') ?>',
                         type: 'POST',
                         data: `idKelas=${idKelas}`,
                         success: function(responseFromServer) {
                              let JSONResponse = JSON.parse(responseFromServer);
                              if (JSONResponse.deleteKelas === true) {
                                   getListKelas();
                              } else {
                                   Swal.fire('Hapus Kelas', 'Gagal Menghapus Kelas', 'error');
                              }
                         }
                    });
               }
          })
     }
     function editKelas(idKelas, dataKelas){
          $('#modal-add-kelas').find('#namaKelas').val(dataKelas.namaKelas);

          $('#modal-add-kelas').find('#action').attr('action', 'edit');
          $('#modal-add-kelas').find('#modalTitle').text('Edit Data Kelas');
          $('#modal-add-kelas').find('#submit').text('Simpan Perubahan Data Kelas');
          $('#modal-add-kelas').find('#action').attr('dataKelas', JSON.stringify(dataKelas));
          $('#modal-add-kelas').modal('show');
     }
     function showTambahKelasModal(){
          $('#modal-add-kelas').find('#action').attr('action', 'add');
          $('#modal-add-kelas').find('#modalTitle').text('Tambah Kelas Baru');
          $('#modal-add-kelas').find('#submit').text('Simpan Data Kelas');
          $('#modal-add-kelas').find('#action').attr('dataKelas', '');
          $('#modal-add-kelas').modal('show');
     }
</script>