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
                              <h1 class="m-0 text-dark">Transaksi Tabungan</h1>
                         </div><!-- /.col -->
                         <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                   <li class="breadcrumb-item"><a href="#">Home</a></li>
                                   <li class="breadcrumb-item active">List Transaksi Tabungan</li>
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
                                             <div class='col-6 text-left'>
                                                  <h3 class="card-title">
                                                       <i class="fas fa-filter mr-1"></i>
                                                       Filter Transaksi
                                                  </h3>
                                             </div>
                                             <div class='col-6 text-right'>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="card-body">
                                        <div class="row">
                                             <div class="col-12">
                                             <form id="formFilter">
                                                  <div id="filterData" class="row">
                                                       <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
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
                                                       <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                 <label for="admin" style='display:block; width:100%;'>Admin</label>
                                                                 <select name="admin" id="admin" class="form-control form-control-sm">
                                                                      <option value="">-- Semua Admin --</option>
                                                                      <?php
                                                                           $this->db->where('level', 'admin');
                                                                           $listAdmin    =    $this->db->get('ts_user')->result_array();
                                                                           foreach($listAdmin as $indexAdmin => $admin){
                                                                                ?>
                                                                                     <option value="<?=$admin['idUser']?>" <?=($this->input->get('admin') !== null && $this->input->get('admin') == $admin['idUser'])? 'selected':''?>>
                                                                                          <?=$admin['nama']?> | <?='admin-'.$admin['idUser']?>
                                                                                     </option>
                                                                                <?php
                                                                           }
                                                                      ?>
                                                                 </select>
                                                                 </select>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                 <label for="rentangWaktu">Rentang Waktu</label>
                                                                 <div class="input-group">
                                                                      <input type="date" class="form-control form-control-sm waktuAwal" name='waktuAwal'
                                                                           value='<?=($this->input->get('waktuAwal') != null)? $this->input->get('waktuAwal') : ''?>'>
                                                                      <input type="date" class="form-control form-control-sm waktuAkhir" name='waktuAkhir'
                                                                           value='<?=($this->input->get('waktuAkhir') != null)? $this->input->get('waktuAkhir') : ''?>'>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  <div class="row">
                                                       <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                 <label for="actionTransaksi">Action Transaksi</label>
                                                                 <select name="actionTransaksi" id="actionTransaksi" class="form-control form-control-sm">
                                                                      <option value="">-- Semua Status --</option>
                                                                      <option value="masuk" <?=($this->input->get('actionTransaksi') !== null && $this->input->get('actionTransaksi') === 'masuk')? 'selected':''?>>Menabung</option>
                                                                      <option value="keluar" <?=($this->input->get('actionTransaksi') !== null && $this->input->get('actionTransaksi') === 'keluar')? 'selected':''?>>Penarikan</option>
                                                                 </select>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                 <label for="statusReverse">Status Reverse Transaksi</label>
                                                                 <select name="statusReverse" id="statusReverse" class="form-control form-control-sm">
                                                                      <option value="">-- Tanpa Filter Reverse --</option>
                                                                      <option value="pending" <?=($this->input->get('statusReverse') !== null && $this->input->get('statusReverse') === 'pending')? 'selected':''?>>Pending</option>
                                                                      <option value="reverse" <?=($this->input->get('statusReverse') !== null && $this->input->get('statusReverse') === 'reverse')? 'selected':''?>>Reverse</option>
                                                                 </select>
                                                            </div>
                                                       </div>
                                                       <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                 <label for="jenisBiaya">Jenis Biaya</label>
                                                                 <select name="jenisBiaya" id="jenisBiaya" class="form-control form-control-sm">
                                                                      <option value="">-- Semua Jenis Biaya --</option>
                                                                      <?php 
                                                                           $jenisBiaya    =    $this->db->get('ts_jenis_biaya');
                                                                           
                                                                           if($jenisBiaya->num_rows() >= 1){
                                                                                foreach($jenisBiaya->result_array() as $indexData => $data){
                                                                                     ?>
                                                                                          <option value="<?=$data['idJenisBiaya']?>" 
                                                                                               keterangan='<?=$data['keterangan']?>'
                                                                                               <?=($this->input->get('jenisBiaya') !== null && $this->input->get('jenisBiaya') === $data['idJenisBiaya'])? 'selected':''?>><?=$data['nama']?></option>
                                                                                     <?php
                                                                                }
                                                                           }
                                                                      ?>
                                                                 </select>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  <hr>
                                                  <button class="btn btn-success btn-sm" type='submit'>
                                                       <span class='fas fa-search mr-2'></span>
                                                       Lakukan Filter Data
                                                  </button>
                                                  <button class="btn btn-sm btn-light mr-1 ml-1" id='exportToExcel' exportTo='excel'>
                                                       <span class="fa fa-file-excel mr-1"></span>
                                                       Export to Excel
                                                  </button>
                                                  <button class="btn btn-sm btn-info" id='exportToPDF' exportTo='pdf'>
                                                       <span class="fa fa-file-pdf mr-1"></span>
                                                       Export to PDF
                                                  </button>
                                             </form>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="card">
                                   <div class="card-header">
                                        <div class='row'>
                                             <div class='col-4 text-left'>
                                                  <h3 class="card-title">
                                                       <i class="fas fa-book mr-1"></i>
                                                       Data Transaksi
                                                  </h3>
                                             </div>
                                             <div class='col-8 text-right'>
                                                  <?php if($userLevel === 'admin'){ ?>
                                                       <a href='<?=site_url('transaksi/add')?>'>
                                                            <i class="fas fa-plus text-success cp" data-toggle='tooltip'
                                                                 data-placement='top' title='Tambah Transaksi Baru'></i>
                                                       </a>
                                                  <?php } ?>
                                             </div>
                                        </div>
                                   </div><!-- /.card-header -->
                                   <div class="card-body">
                                        <?php if(count($dataTransaksi) >= 1){ ?>
                                             <div class='table-responsive'>
                                                  <table class='table table-sm table-bordered table-striped' id='tabel-tabungan'>
                                                       <thead>
                                                            <tr>
                                                                 <th class='text-center'>No.</th>
                                                                 <th class='text-left'>Tabungan</th>
                                                                 <th class='text-left'>Nominal (Rp.)</th>
                                                                 <th class='text-left'>Siswa Pemilik</th>
                                                                 <th class='text-left'>Jenis Biaya</th>
                                                                 <th class='text-left'>Admin</th>
                                                                 <th class='text-left'>Waktu</th>
                                                            </tr>
                                                       </thead>
                                                       <tbody>
                                                            <?php foreach($dataTransaksi as $indexData => $data){ ?>
                                                                 <tr class='text-sm tr-row'>
                                                                      <td class='vam text-center text-bold'><?=$indexData+1?>.</td>
                                                                      <td class='vam text-left'>
                                                                           <h6 class='text-bold mt-1 mb-1'><?=$data['namaTabungan']?></h6>
                                                                           <p class='text-muted mb-1' style='font-size:8pt !important'>No. Tab. <?=$data['nomorTabungan']?></p>
                                                                           <p class='text-muted mb-1' style='font-size:8pt !important'>No. Transaksi. <?=$data['nomorTransaksi']?></p>
                                                                           <?php if($data['statusReverse'] === 'reverse' || $data['statusReverse'] === 'pending'){ ?>
                                                                                <p class='mb-1 mt-1'>
                                                                                     <span class='badge badge-<?=($data['statusReverse'] === 'pending')? 'warning':'danger'?>'>
                                                                                          Transaksi ini telah direverse dengan status <?=strtoupper($data['statusReverse'])?>
                                                                                     </span>
                                                                                </p>
                                                                           <?php } ?>
                                                                      </td>
                                                                      <td class='vam text-left'>
                                                                           Rp. <?=number_format($data['nominal'])?>
                                                                           <p class="mb-0 mt-1">
                                                                                <span class="badge badge-<?=($data['action'] === 'masuk')? 'success' : 'danger'?>"><?=$data['action']?></span>
                                                                           </p>
                                                                      </td>
                                                                      <td class='vam text-left'><?=$data['siswaPemilikTabungan']?></td>
                                                                      <td class="vam text-left"><?=$data['namaJenisBiaya']?></td>
                                                                      <td class='vam text-left'>
                                                                           <span class="badge badge-info">admin-<?=$data['admin']?></span>
                                                                      </td>
                                                                      <td class="text-left vam"><?=date('D, Y M d H:i:s', strtotime($data['waktuTransaksi']))?></td>
                                                                 </tr>
                                                            <?php } ?>
                                                       </tbody>
                                                  </table>
                                             </div>
                                        <?php }else{
                                             $notFoundData  =    [
                                                  'noDataTitle'  =>   'Data Tabungan',
                                                  'noDataDesc'   =>   ucwords('data tidak muncul dikarenakan pengambilan data dimulai dari tanggal hari ini, atau mungkin data tidak tersedia ! Gunakan filter rentang waktu untuk melihat transaksi di hari sebelumnya.')
                                             ];

                                             $this->load->view('components/no-data', $notFoundData);
                                             ?>
                                             <?php if($userLevel === 'admin'){ ?>
                                                  <div class='text-center mb-3'>
                                                       <a href='<?=site_url('tabungan/add')?>'><button class='btn btn-success btn-sm'>Tambah Tabungan Baru</button></a>
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

<script src='<?=base_url('assets/AdminLTE/plugins/select2/js/select2.min.js')?>'></script>
<link href='<?=base_url('assets/AdminLTE/plugins/select2/css/select2.min.css')?>' rel='stylesheet' />

<script language='Javascript'>
     $('#tabel-tabungan').DataTable();

     $('[data-toggle="tooltip"]').tooltip();
     $('#kelas, #admin, #jenisBiaya').select2();

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

     $('.select2-selection').css('height', 'calc(1.8125rem + 2px)');
     
     $('#exportToPDF, #exportToExcel').on('click', function(e){
          e.preventDefault();

          let filterData =    $('#formFilter').serialize();
          let url        =    new URLSearchParams(filterData);
          let exportTo   =    $(this).attr('exportTo').toLowerCase();

          let kelas           =    (url.get('kelas').length >= 1)? url.get('kelas') : 'null';
          let admin           =    (url.get('admin').length >= 1)? url.get('admin') : 'null';
          let waktuAwal       =    (url.get('waktuAwal').length >= 1)? url.get('waktuAwal') : 'null';
          let waktuAkhir      =    (url.get('waktuAkhir').length >= 1)? url.get('waktuAkhir') : 'null';
          let actionTransaksi =    (url.get('actionTransaksi').length >= 1)? url.get('actionTransaksi') : 'null';
          let statusReverse   =    (url.get('statusReverse').length >= 1)? url.get('statusReverse') : 'null';
          let jenisBiaya      =    (url.get('jenisBiaya').length >= 1)? url.get('jenisBiaya') : 'null';
          
          window.open(`<?=site_url('laporan/exportData/')?>${exportTo}/${kelas}/${admin}/${waktuAwal}/${waktuAkhir}/${actionTransaksi}/${statusReverse}/${jenisBiaya}`, '_blank');
     });
</script>