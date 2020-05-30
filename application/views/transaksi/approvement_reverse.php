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
                         <h1 class="m-0 text-dark">Persetujuan Reverse</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                              <li class="breadcrumb-item"><a href="#">Home</a></li>
                              <li class="breadcrumb-item active">Approvement Reverse</li>
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
                                                  <i class="fas fa-reply mr-1"></i>
                                                  Request Transaksi Reverse
                                             </h3>
                                        </div>
                                   </div>
                              </div><!-- /.card-header -->
                              <div class="card-body">
                                   <?php if(count($listReverse) >= 1){ ?>
                                        <div class="table-reponsive">
                                             <table class="table table-sm table-bordered table-striped" id='tabelRequestReverse'>
                                                  <thead>
                                                       <tr>
                                                            <th class="text-center">No.</th>
                                                            <th class="text-left">Nomor Transaksi</th>
                                                            <th class="text-left">Keterangan</th>
                                                            <th class="text-left">Status</th>
                                                            <th class="text-center">Opsi</th>
                                                       </tr>
                                                       <tbody>
                                                            <?php foreach($listReverse as $indexReverse => $reverse){ 
                                                                      $statusReverse      =    strtolower($reverse['statusReverse']);
                                                                 ?>
                                                                 <tr class="tr-row text-sm">
                                                                      <td class="text-center text-bold"><?=$indexReverse+1?>.</td>
                                                                      <td class="text-left"><?=$reverse['nomorTransaksi']?></td>
                                                                      <td class="text-left"><?=$reverse['keterangan']?></td>
                                                                      <td class="text-left">
                                                                           <span class='badge badge-<?=($statusReverse === 'pending')? 'warning' : 'success'?>'>
                                                                                <?=$statusReverse?>
                                                                           </span>
                                                                      </td>
                                                                      <td class="text-center">
                                                                           <span class="fas fa-check text-success cp"
                                                                                onclick='doReverse(this, <?=$reverse["idReverse"]?>, "<?=$reverse["nomorTransaksi"]?>")'
                                                                                data-toggle='tooltip' data-placement='bottom'
                                                                                title='Reverse'></span>
                                                                      </td>
                                                                 </tr>
                                                            <?php } ?>
                                                       </tbody>
                                                  </thead>
                                             </table>
                                        </div>
                                   <?php }else{ 
                                             $dataNotFound  =    [
                                                  'dataNotFoundTitle' =>   'Request Reverse',
                                                  'dataNotFoundDesc'  =>   'Request reverse untuk hari ini tidak ada !'
                                             ];

                                             $this->load->view('components/data-not-found', $dataNotFound);
                                        }
                                   ?>
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

<script src='<?=base_url('assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.js')?>'></script>
<link href='<?=base_url('assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.css')?>' rel='stylesheet' />

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

<script src='<?=base_url('assets/AdminLTE/plugins/datatables/jquery.dataTables.js')?>'></script>
<script src='<?=base_url('assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js')?>'></script>
<link href='<?=base_url('assets/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.css')?>' rel='stylesheet' />

<script language='Javascript'>

     $('[data-toggle="tooltip"]').tooltip()
     $('#tabelRequestReverse').DataTable();

     $('#formReverse').on('submit', function(e) {
          e.preventDefault();

          $('#hasilKosong').css('opacity', '0.5');

          let formData = $(this).serialize();
          $.ajax({
               url  :    '<?=base_url("transaksi/addReverse")?>',
               data :    formData,
               type :    'POST',
               success : function(responseFromServer){
                    let JSONResponse    =    JSON.parse(responseFromServer);
                    let messageReverseTextColor, type;
                    let messageReverse      =    JSONResponse.messageReverse;

                    if(JSONResponse.addReverse === true){
                         messageReverseTextColor  =    'text-success';
                         type      =    'success';
                    }else{
                         messageReverseTextColor  =    'text-danger';
                         type      =    'error';
                    }

                    Swal.fire({
                         title     :    'Transaksi Reverse',
                         html      :    `<b class='${messageReverseTextColor}'>${messageReverse}</b>`,
                         type      :    type
                    }).then(() => {
                         if(JSONResponse.addReverse){
                              window.location.reload();
                         }
                    });
               }
          })
     });
     function doReverse(el, idReverse, nomorTransaksi){
          el   =    $(el);

          Swal.fire({
               title: 'Konfirmasi Reverse Transaksi',
               html: `Apakah anda yakin akan mereverse transaksi dengan nomor transaksi <b class='text-danger'>${nomorTransaksi}</b> ?`,
               showConfirmButton: true,
               showCancelButton: true,
               type: 'question',
               confirmButtonColor: '#dc3545',
               cancelButtonColor: '#28a745',
               confirmButtonText : 'Lanjutkan Reverse',
               cancelButtonText : 'Batalkan',
               focusCancel: true
          }).then(konfirmasi => {
               if (konfirmasi.value === true) {
                    $.ajax({
                         url: '<?= base_url('transaksi/reverse') ?>',
                         type: 'POST',
                         data: `idReverse=${idReverse}`,
                         success: function(responseFromServer) {
                              let JSONResponse = JSON.parse(responseFromServer);
                              if (JSONResponse.statusReverse === true) {
                                   el.parents('.tr-row').remove();
                              }else{
                                   Swal.fire('Reverse Transaksi', 'Gagal Mereverse Transaksi', 'error');
                              }
                         }
                    });
               }
          })
     }
</script>