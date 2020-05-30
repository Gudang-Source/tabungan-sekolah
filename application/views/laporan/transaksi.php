<?php
     date_default_timezone_set("Asia/Bangkok");

     if($category !== false){
          $allowedTypes  =    ['sukses', 'kelas', 'admin'];
          $category      =    strtolower($category);

          $showView      =    true;

          if($category === 'sukses'){
               $this->db->where('statusReverse', '');
               $dataTransaksi      =    $this->db->get('view_transaksi');
          }
          if($category === 'kelas'){
               // $this->db->where();
          }
     }else{
          $showView      =    false;
     }
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
                         <h1 class="m-0 text-dark">
                              Laporan Transaksi Tabungan
                              <?php if($category !== false){ ?>
                                   <p class="mb-0 text-sm">Per <?=ucwords($category)?></p>
                              <?php } ?>
                         </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                              <li class="breadcrumb-item"><a href="#">Home</a></li>
                              <li class="breadcrumb-item active">Laporan Transaksi Tabungan</li>
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
                         <div class="card">
                              <div class="card-header">
                                   <div class='row'>
                                        <div class='col-lg-4 text-left'>
                                             <h3 class="card-title">
                                                  <i class="fas fa-list mr-1"></i>
                                                  Laporan Transaksi Tabungan
                                             </h3>
                                        </div>
                                   </div>
                              </div>
                              <div class="card-body">
                                   <div class="col-12 table-responsive">
                                        <table id="tabelHistoriTransaksiReverse" class="table table-sm table-bordered">
                                             <thead>
                                                  <tr>
                                                       <th class='text-center'>No.</th>
                                                       <th class='text-left'>Tabungan</th>
                                                       <th class='text-left'>Nominal (Rp.)</th>
                                                       <th class='text-left'>Siswa Pemilik</th>
                                                       <th class='text-left'>Admin</th>
                                                       <th class='text-left'>Waktu</th>
                                                  </tr>
                                             </thead>
                                             <tbody id="hasilFilter">
                                                  <?php if($showView && in_array($category, $allowedTypes)){ ?>
                                                       <?php foreach($dataTransaksi->result_array() as $indexData => $data){ ?>
                                                            <tr class='text-sm tr-row'>
                                                                 <td class='vam text-center text-bold'><?=$indexData+1?>.</td>
                                                                 <td class='vam text-left'>
                                                                      <h6 class='text-bold mt-1 mb-1'><?=$data['namaTabungan']?></h6>
                                                                      <p class='text-muted mb-1' style='font-size:8pt !important'>No. Tab. <?=$data['nomorTabungan']?></p>
                                                                      <p class='text-muted mb-1' style='font-size:8pt !important'>No. Transaksi. <?=$data['nomorTransaksi']?></p>
                                                                 </td>
                                                                 <td class='vam text-left'>
                                                                      Rp. <?=number_format($data['nominal'])?>
                                                                      <p class="mb-0 mt-1">
                                                                           <span class="badge badge-<?=($data['action'] === 'masuk')? 'success' : 'danger'?>"><?=$data['action']?></span>
                                                                      </p>
                                                                 </td>
                                                                 <td class='vam text-left'><?=$data['siswaPemilikTabungan']?></td>
                                                                 <td class='vam text-left'>
                                                                      Kode Admin <span class="badge badge-info"><?=$data['admin']?></span>
                                                                 </td>
                                                                 <td class="text-left vam"><?=date('D, Y M d H:i:s', strtotime($data['waktuTransaksi']))?></td>
                                                            </tr>
                                                       <?php } ?>
                                                  <?php } ?>
                                             </tbody>
                                        </table>
                                   </div>
                              </div>
                         </div>
                         <div id="hasilKosong" class='pt-5 pb-5' style='display:none'>
                              <?php
                              $data     =    [
                                   'dataNotFoundTitle' =>   'Data Tidak Ditemukan',
                                   'dataNotFoundDesc'  =>   'Kemungkinan filter yang anda terapkan salah atau data memang tidak ada.'
                              ];
                              $this->load->view('components/data-not-found', $data);
                              ?>
                         </div>
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

<script src='<?= base_url('assets/js/numeral/numeral.js') ?>'></script>

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

<script language='Javascript'>
     $('#tabelHistoriTransaksiReverse').DataTable();
     $('[data-toggle="tooltip"]').tooltip();
</script>