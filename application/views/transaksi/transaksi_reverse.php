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
                         <h1 class="m-0 text-dark">Request Reverse</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                              <li class="breadcrumb-item"><a href="#">Home</a></li>
                              <li class="breadcrumb-item active">Request Reverse</li>
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
                                                  Request Reverse
                                             </h3>
                                        </div>
                                   </div>
                              </div><!-- /.card-header -->
                              <div class="card-body">
                                   <form id="formReverse">
                                        <div class="row">
                                             <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                                  <label for="nomorTransaksi">Nomor Transaksi *</label>
                                                  <input required type="text" class="form-control" placeholder="Nomor Transaksi" id='nomorTransaksi'
                                                       name='nomorTransaksi' />
                                             </div>
                                             <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                                                  <label for="keterangan">Keterangan Reverse *</label>
                                                  <textarea required class="form-control" placeholder="Penyebab Mengapa Transaksi Ini Direverse" id='keterangan'
                                                       name='keterangan'></textarea>
                                             </div>
                                        </div>
                                        <hr />
                                        <button class="btn btn-success" type='submit'>
                                             <span class='fas fa-reply mr-2'></span>
                                             Reverse
                                        </button>
                                   </form>
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

<script language='Javascript'>

     $('[data-toggle="tooltip"]').tooltip()

     // $('#siswa, #admin').select2();
     // $('.select2-selection').css('height', 'calc(2.25rem + 2px)');
     // $('.select2.select2-container').css('display', 'block');

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
</script>