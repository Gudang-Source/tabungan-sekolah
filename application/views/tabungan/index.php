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
                         <h1 class="m-0 text-dark">Tabungan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                              <li class="breadcrumb-item"><a href="#">Home</a></li>
                              <li class="breadcrumb-item active">Tabungan</li>
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
                                                  Data Tabungan
                                             </h3>
                                        </div>
                                        <div class='col-8 text-right'>
                                             <?php if($userLevel === 'admin'){ ?>
                                                  <a href='<?=site_url('tabungan/add')?>'>
                                                       <i class="fas fa-plus text-success cp" data-toggle='tooltip'
                                                            data-placement='top' title='Tambah Tabungan Baru'></i>
                                                  </a>
                                             <?php } ?>
                                        </div>
                                   </div>
                              </div><!-- /.card-header -->
                              <div class="card-body">
                                   <?php if(count($dataTabungan) >= 1){ ?>
                                        <div class='table-responsive'>
                                             <table class='table table-sm table-bordered table-striped' id='tabel-tabungan'>
                                                  <thead>
                                                       <tr>
                                                            <th class='text-center'>No.</th>
                                                            <th class='text-left'>Nama Tabungan</th>
                                                            <th class='text-left'>Siswa Pemilik</th>
                                                            <th class='text-left'>Kelas Siswa</th>
                                                            <?php if(false){ ?>
                                                                 <th class='text-center'>Status</th>
                                                            <?php } ?>
                                                            <?php if($userLevel === 'admin'){ ?>
                                                                 <th class='text-center'>Opsi</th>
                                                            <?php } ?>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <?php foreach($dataTabungan as $indexData => $data){ ?>
                                                            <tr class='text-sm tr-row'>
                                                                 <td class='vam text-center text-bold'><?=$indexData+1?>.</td>
                                                                 <td class='vam text-left'>
                                                                      <h6 class='text-bold mt-1 mb-1'><?=$data['namaTabungan']?></h6>
                                                                      <p class='text-muted mb-1' style='font-size:8pt !important'>No. Tab. <?=$data['nomorTabungan']?></p>
                                                                 </td>
                                                                 <td class='vam text-left'><?=$data['namaSiswa']?></td>
                                                                 <td class='vam text-left'><?=$data['namaKelas']?></td>
                                                                 <?php if(false){ ?>
                                                                      <td class='vam text-center'>
                                                                           <?php
                                                                                $colorBadge         =    (strtolower($data['status']) === 'aktif')? 'success' : 'danger';
                                                                                $badgeIconColor     =    (strtolower($data['status']) === 'aktif')? 'success' : 'danger';
                                                                                $badgeTooltipText   =    (strtolower($data['status']) === 'aktif')? 'Nonaktifkan' : 'Aktifkan';
                                                                           ?>
                                                                           <span class='badge badge-<?=$colorBadge?>'><?=$data['status']?></span>
                                                                      </td>
                                                                 <?php } ?>
                                                                 <?php if($userLevel === 'admin'){ ?>
                                                                      <td class='vam text-center'>
                                                                           <a href='<?=site_url("tabungan/edit/")?><?=$data['idTabungan']?>'>
                                                                                <span class='fas fa-edit text-warning cp pr-1' data-toggle='tooltip'
                                                                                     data-placement='left' title='Edit Data Tabungan'></span>
                                                                           </a>
                                                                           <?php if(false){ ?>
                                                                                <span class='fas fa-power-off text-<?=$badgeIconColor?> cp' data-toggle='tooltip'
                                                                                     data-placement='top' title='<?=$badgeTooltipText?> Tabungan'></span>
                                                                           
                                                                                <span class='fas fa-trash text-danger pl-1 cp' data-toggle='tooltip'
                                                                                     data-placement='bottom' title='Hapus Data Tabungan' 
                                                                                     onclick='deleteSiswa(this, <?=$data["idSiswa"]?>, "<?=$data["nama"]?>")'></span>
                                                                           <?php } ?>
                                                                      </td>
                                                                 <?php } ?>
                                                            </tr>
                                                       <?php } ?>
                                                  </tbody>
                                             </table>
                                        </div>
                                   <?php }else{
                                        $notFoundData  =    [
                                             'noDataTitle'  =>   'Data Tabungan',
                                             'noDataDesc'   =>   'Data Tabungan Tidak Ditemukan, atau Mungkin Data Tabungan Kosong !'
                                        ];

                                        $this->load->view('components/no-data', $notFoundData);
                                        ?>
                                        <div class='text-center mb-3'>
                                             <a href='<?=site_url('tabungan/add')?>'><button class='btn btn-success btn-sm'>Tambah Tabungan Baru</button></a>
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
     $('#tabel-tabungan').DataTable();

     $('[data-toggle="tooltip"]').tooltip()

     function deleteSiswa(el, idSiswa, namaSiswa){
          el   =    $(el);
          Swal.fire({
               title: 'Konfirmasi Hapus Data',
               html: `Apakah anda yakin akan menghapus data siswa <b class='text-danger'>${namaSiswa}</b> ?`,
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
                         url: '<?= base_url('siswa/deleteSiswa') ?>',
                         type: 'POST',
                         data: `idSiswa=${idSiswa}`,
                         success: function(responseFromServer) {
                              let JSONResponse = JSON.parse(responseFromServer);
                              if (JSONResponse.deleteSiswa === true) {
                                   el.parents('.tr-row').remove();
                              }else{
                                   Swal.fire('Hapus Siswa', 'Gagal Menghapus Siswa', 'error');
                              }
                         }
                    });
               }
          })
     }
     function detailSiswa(el, dataSiswa){
          el   =    $(el);
          dataSiswa      =    JSON.parse(dataSiswa);
     }
</script>