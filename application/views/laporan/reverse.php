<?php
date_default_timezone_set("Asia/Bangkok");
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
                         <h1 class="m-0 text-dark">Laporan Reverse</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                              <li class="breadcrumb-item"><a href="#">Home</a></li>
                              <li class="breadcrumb-item active">Laporan Reverse</li>
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
                                                  <i class="fas fa-filter mr-1"></i>
                                                  Filter Reverse
                                             </h3>
                                        </div>
                                   </div>
                              </div><!-- /.card-header -->
                              <div class="card-body">
                                   <form id="formFilter">
                                        <div id="filterData" class="row">
                                             <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                                  <div class="form-group">
                                                       <label for="statusReverse">Status Reverse</label>
                                                       <select required name="statusReverse" id="statusReverse" class="form-control">
                                                            <option value="">-- Status Reverse --</option>
                                                            <option value="pending">Pending</option>
                                                            <option value="reverse">Reverse</option>
                                                       </select>
                                                  </div>
                                             </div>
                                             <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                                  <div class="form-group">
                                                       <label for="rentangWaktu">Rentang Waktu Request Reverse</label>
                                                       <div class="input-group">
                                                            <input type="date" class="form-control" name='waktuAwal'>
                                                            <input type="date" class="form-control" name='waktuAkhir'>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                        <hr />
                                        <button class="btn btn-success" type='submit'>
                                             <span class='fas fa-filter mr-1'></span>
                                             Lakukan Pencarian
                                        </button>
                                   </form>
                              </div><!-- /.card-body -->
                         </div>
                         <!-- /.card -->
                         <div class="card" id='cardResult' style='display:none'>
                              <div class="card-header">
                                   <div class='row'>
                                        <div class='col-lg-4 text-left'>
                                             <h3 class="card-title">
                                                  <i class="fas fa-history mr-1"></i>
                                                  Histori Transaksi Reverse
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
                                                       <th class='text-center'>No. Transaksi</th>
                                                       <th class='text-left'>Keterangan</th>
                                                       <th class='text-center'>Status</th>
                                                       <th class='text-right'>Waktu</th>
                                                  </tr>
                                             </thead>
                                             <tbody id="hasilFilter"></tbody>
                                        </table>
                                   </div>
                                   <hr />
                                   <div class="col-12 text-right">
                                        <button class="btn btn-success mr-1" id='exportToExcel' exportTo='excel'>
                                             <span class="fa fa-file-excel mr-1"></span>
                                             Export to Excel
                                        </button>
                                        <button class="btn btn-light ml-1" id='exportToPDF' exportTo='pdf'>
                                             <span class="fa fa-file-pdf mr-1"></span>
                                             Export to PDF
                                        </button>
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

<script src='<?= base_url('assets/AdminLTE/plugins/select2/js/select2.min.js') ?>'></script>
<link href='<?= base_url('assets/AdminLTE/plugins/select2/css/select2.min.css') ?>' rel='stylesheet' />

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

     $('[data-toggle="tooltip"]').tooltip()

     $('#siswa, #admin').select2();
     $('.select2-selection').css('height', 'calc(2.25rem + 2px)');
     $('.select2.select2-container').css('display', 'block');

     $('#formFilter').on('submit', function(e) {
          e.preventDefault();

          $('#cardResult, #hasilKosong').css('opacity', '0.5');

          let formData = $(this).serialize();

          $.ajax({
               url: '<?= base_url("JSON/laporanReverse") ?>',
               data: formData,
               type: 'POST',
               success: function(responseFromServer) {
                    let dataJSON        =    JSON.parse(responseFromServer);
                    let dataJSONString  =    JSON.stringify(dataJSON.laporanReverse);
                    let laporanReverse  =    dataJSON.laporanReverse;

                    if (laporanReverse.length >= 1) {
                         let rows = '';

                         for (let i = 0; i < laporanReverse.length; i++) {
                              let data  =    laporanReverse[i];
                              
                              let statusReverse   =    data.statusReverse;

                              rows      +=   `<tr class='text-sm tr-row'>
                                                  <td class='text-center text-bold'>${i+1}.</td>
                                                  <td class='text-center'>${data.nomorTransaksi}</td>
                                                  <td class='text-left'>${data.keterangan}</td>
                                                  <td class='text-center'>
                                                       <span class='badge badge-${(statusReverse === 'pending')? 'warning' : 'success'}'>${statusReverse}</span>
                                                  </td>
                                                  <td class='text-right'>${data.waktu}</td>
                                             </tr>`;
                         }

                         $('#hasilFilter').html(rows);

                         $('#cardResult').show();
                         $('#hasilKosong').hide();
                    } else {
                         $('#hasilKosong').show();
                         $('#cardResult').hide();
                    }

                    $('#cardResult, #hasilKosong').css('opacity', '1');
                    $('#cardResult, #hasilKosong').addClass('naikTurun');
                    setTimeout(() => {
                         $('#cardResult, #hasilKosong').removeClass('naikTurun');
                    }, 3000);
               }
          });
     });

     $('#exportToPDF, #exportToExcel').on('click', function(e){
          e.preventDefault();
          filterData     =    $('#formFilter').serialize();
          let url        =    new URLSearchParams(filterData);
          let exportTo   =    $(this).attr('exportTo').toLowerCase();

          let statusReverse   =    url.get('statusReverse');
          let waktuAwal       =    url.get('waktuAwal');
          let waktuAkhir      =    url.get('waktuAkhir');
          
          if(waktuAwal.length >= 1 && waktuAkhir.length >= 1){
               window.open(`<?=site_url('reverse/exportData/')?>${exportTo}/${statusReverse}/${waktuAwal}/${waktuAkhir}`, '_blank');
          }else{
               window.open(`<?=site_url('reverse/exportData/')?>${exportTo}/${statusReverse}`, '_blank');
          }
     });
</script>