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
                         <h1 class="m-0 text-dark">Siswa</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                              <li class="breadcrumb-item"><a href="#">Home</a></li>
                              <li class="breadcrumb-item active">Siswa</li>
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
                                                  <i class="fas fa-filter mr-1"></i>
                                                  Filter Siswa
                                             </h3>
                                        </div>
                                   </div>
                              </div><!-- /.card-header -->
                              <div class="card-body">
                                   <form id="filterSiswa" class='col-12'>
                                        <div class="row">
                                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                  <div class="form-group">
                                                       <label for="kelas" style='display:block; width:100%;'>Kelas</label>
                                                       <select name="kelas" id="kelas" class="form-control form-control-sm">
                                                            <option value="">-- Semua Kelas --</option>
                                                            <?php
                                                                 $listKelas    =    $this->db->get('ts_kelas')->result_array();
                                                                 foreach($listKelas as $indexKelas => $kelas){
                                                                      ?>
                                                                      <option value="<?=$kelas['idKelas']?>" <?=($this->input->get('kelas') !== null && $this->input->get('kelas') === $kelas['idKelas'])? 'selected':''?>><?=$kelas['namaKelas']?></option>
                                                                      <?php
                                                                 }
                                                            ?>
                                                       </select>
                                                  </div>
                                             </div>
                                             <?php if(false){ ?>
                                                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                       <div class="form-group">
                                                            <label for="tahunAjaran" style='display:block; width:100%;'>Tahun Ajaran</label>
                                                            <input type='number' name="tahunAjaran" id="tahunAjaran" class="form-control form-control-sm" 
                                                                 placeholder="Tahun Ajaran" value="<?=($this->input->get('tahunAjaran') !== null)? $this->input->get('tahunAjaran'):''?>" />
                                                       </div>
                                                  </div>
                                             <?php } ?>
                                        </div>
                                        <hr>
                                        <div class="row">
                                             <div class="col-12">
                                                  <button type="submit" class='btn btn-success btn-sm'>
                                                       <span class="fas fa-search mr-1"></span>
                                                       Terapkan Filter
                                                  </button>
                                                  <button exportTo='excel' type="button" class='btn btn-light btn-sm ml-1 mr-1' id='exportToExcel'>
                                                       <span class="fas fa-file-excel mr-1"></span>
                                                       Export to Excel
                                                  </button>
                                                  <button exportTo='pdf' type="button" class='btn btn-info btn-sm' id='exportToPDF'>
                                                       <span class="fas fa-file-pdf mr-1"></span>
                                                       Export to PDF
                                                  </button>
                                             </div>
                                        </div>
                                   </form>
                              </div>
                         </div>
                         <div class="card">
                              <div class="card-header">
                                   <div class='row'>
                                        <div class='col-4 text-left'>
                                             <h3 class="card-title">
                                                  <i class="fas fa-users mr-1"></i>
                                                  Siswa Terdaftar
                                             </h3>
                                        </div>
                                        <div class='col-8 text-right'>
                                             <a href='<?=site_url('siswa/add')?>'>
                                                  <i class="fas fa-plus text-success cp" data-toggle='tooltip'
                                                       data-placement='top' title='Tambah Siswa Baru'></i>
                                             </a>
                                        </div>
                                   </div>
                              </div><!-- /.card-header -->
                              <div class="card-body">
                                   <?php if(count($dataSiswa) >= 1){ ?>
                                        <div class='table-responsive'>
                                             <table class='table table-sm table-bordered table-striped' id='tabel-siswa'>
                                                  <thead>
                                                       <tr>
                                                            <th class='text-center'>No.</th>
                                                            <th class='text-left'>Nama</th>
                                                            <th class='text-left'>NIS</th>
                                                            <th class='text-left'>Kelas</th>
                                                            <th class='text-left'>Email</th>
                                                            <th class='text-left'>No. HP Org. Tua</th>
                                                            <th class='text-center'>Opsi</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <?php foreach($dataSiswa as $indexData => $data){ ?>
                                                            <tr class='text-sm tr-row'>
                                                                 <td class='vam text-center text-bold'><?=$indexData+1?>.</td>
                                                                 <td class='vam text-left'>
                                                                      <h6 class='text-bold mt-1 mb-1'><?=$data['nama']?></h6>
                                                                      <p class='text-muted mb-1' style='font-size:8pt !important'><?=$data['alamat']?></p>
                                                                      <?php if(strlen($data['noHP']) >= 1){ ?>
                                                                           <p class='mt-1 mb-1' style='font-size:8pt !important'>Telepon <?=$data['noHP']?></p>
                                                                      <?php } ?>
                                                                 </td>
                                                                 <td class='vam text-left'><?=$data['nis']?></td>
                                                                 <td class='vam text-left'>
                                                                      <?=$data['namaKelas']?>
                                                                      <!-- <p class="text-sm mb-0"><b>TA.</b> <?=$data['tahunAjaran']?></p> -->
                                                                 </td>
                                                                 <td class='vam text-left'><?=(strlen($data['email']))? $data['email'] : '-'?></td>
                                                                 <td class='vam text-left'><?=$data['noHPOrangTua']?></td>
                                                                 <td class='vam text-center'>
                                                                      <!-- <span class='fas fa-user text-success cp' data-toggle='tooltip'
                                                                           data-placement='left' title='Detail Siswa'
                                                                           onclick='detailSiswa(this, "<?=json_encode($data)?>")'></span> -->
                                                                      <a href='<?=site_url("siswa/edit/")?><?=$data['idSiswa']?>'>
                                                                           <span class='fas fa-edit text-warning cp ml-1 mr-1' data-toggle='tooltip'
                                                                                data-placement='top' title='Edit Data Siswa'></span>
                                                                      </a>
                                                                      <span class='fas fa-trash text-danger cp' data-toggle='tooltip'
                                                                           data-placement='bottom' title='Hapus Data Siswa' 
                                                                           onclick='deleteSiswa(this, <?=$data["idSiswa"]?>, "<?=$data["nama"]?>")'></span>
                                                                 </td>
                                                            </tr>
                                                       <?php } ?>
                                                  </tbody>
                                             </table>
                                        </div>
                                   <?php }else{
                                        $notFoundData  =    [
                                             'noDataTitle'  =>   'Data Siswa',
                                             'noDataDesc'   =>   'Data Siswa Tidak Ditemukan, atau Mungkin Data Siswa Kosong !'
                                        ];

                                        $this->load->view('components/no-data', $notFoundData);
                                        ?>
                                        <div class='text-center mb-3'>
                                             <a href='<?=site_url('siswa/add')?>'><button class='btn btn-success btn-sm'>Tambah Siswa Baru</button></a>
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

<script src='<?=base_url('assets/AdminLTE/plugins/select2/js/select2.min.js')?>'></script>
<link href='<?=base_url('assets/AdminLTE/plugins/select2/css/select2.min.css')?>' rel='stylesheet' />

<script language='Javascript'>
     $('#tabel-siswa').DataTable();

     $('[data-toggle="tooltip"]').tooltip();
     $('#kelas, #admin, #jenisBiaya').select2();
     
     $('.select2-selection').css('height', 'calc(1.8125rem + 2px)');

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
     $('#exportToPDF, #exportToExcel').on('click', function(e){
          e.preventDefault();

          let filterData      =    $('#filterSiswa').serialize();
          let exportTo        =    $(this).attr('exportTo');

          let filter          =    new URLSearchParams(filterData);
          let filterKelas     =    (filter.get('kelas').length >= 1)? filter.get('kelas') : 'null';
          // let filterTahunAjaran     =    (filter.get('tahunAjaran') >= 1)? filter.get('tahunAjaran') : 'null';

          window.open(`<?=site_url("siswa/exportData/")?>${exportTo}/${filterKelas}`);
     })
</script>