<!DOCTYPE html>
<html>
<?php $this->load->view('components/head'); ?>
<?php $this->load->view('components/body-open'); ?>
<?php $this->load->view('components/navbar'); ?>
<?php $this->load->view('components/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style='position:relative'>
     <?php if(($isEdit === true && $detailTabungan !== null) || ($isEdit === false)){ ?>
          <!-- Content Header (Page header) -->
          <div class="content-header">
               <div class="container-fluid">
                    <div class="row mb-2">
                         <div class="col-sm-6">
                              <h1 class="m-0 text-dark"><?=($isEdit)? 'Edit Data Tabungan':'Transaksi Baru'?></h1>
                              <?php if($isEdit){ ?>
                                   <p class='ml-1 mb-0'><?=$detailTabungan['namaTabungan']?></p>
                              <?php } ?>
                         </div><!-- /.col -->
                         <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                   <li class="breadcrumb-item"><a href="#">Home</a></li>
                                   <li class="breadcrumb-item active"><?=($isEdit)? 'Edit Data Tabungan' : 'Tambah Transaksi Baru'?></li>
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
                                             <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4 text-left'>
                                                  <h3 class="card-title">
                                                       <i class="fas fa-credit-card mr-1"></i>
                                                       <?=($isEdit)? 'Edit Data Tabungan':'Transaksi Baru'?>
                                                  </h3>
                                             </div>
                                             <div class='col-lg-8 col-md-8 col-sm-8 col-xs-8 text-right'>
                                                  <a href='<?=site_url('tabungan')?>'>
                                                       <i class="fas fa-times text-danger cp" data-toggle='tooltip'
                                                            data-placement='top' title='List Tabungan'></i>
                                                  </a>
                                             </div>
                                        </div>
                                   </div><!-- /.card-header -->
                                   <div class="card-body">
                                        <form id="transaksi">
                                             <div class='row'>
                                                  <div class='form-group col-lg-4 col-md-4 col-sm-4 col-xs-12'>
                                                       <label for='tabungan'>Tabungan *</label>
                                                       <select required name='tabungan' id='tabungan' class='form-control'>
                                                            <option value='0'>-- Tabungan --</option>
                                                            <?php foreach($listTabungan as $indexData => $tabungan){ ?>
                                                                 <option value='<?=$tabungan['idTabungan']?>'><?=$tabungan['namaTabungan']?> an. <?=$tabungan['namaSiswa']?></option>
                                                            <?php } ?>
                                                       </select>
                                                  </div>
                                                  <div class='form-group col-lg-4 col-md-4 col-sm-4 col-xs-12'>
                                                       <label for='nominal'>Nominal (Rp. ) *</label>
                                                       <input required type='number' name='nominal' id='nominal' placeholder='Nominal (Rp. )' 
                                                            class='form-control' />
                                                  </div>
                                                  <div class='form-group col-lg-4 col-md-4 col-sm-4 col-xs-12'>
                                                       <label for='Action'>Action *</label>
                                                       <select required name='action' id='action' class='form-control'>
                                                            <option value=''>-- Action --</option>
                                                            <option value='masuk'>Menabung</option>
                                                            <option value='keluar'>Penarikan</option>
                                                       </select>
                                                  </div>
                                                  <div class='form-group col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                                                       <label for='jenisBiaya'>Jenis Biaya *</label>
                                                       <select name="jenisBiaya" id="jenisBiaya" class="form-control">
                                                            <option value="0" keterangan=''>-- Jenis Biaya --</option>
                                                            <?php 
                                                                 $jenisBiaya    =    $this->db->get('ts_jenis_biaya');
                                                                 if($jenisBiaya->num_rows() >= 1){
                                                                      foreach($jenisBiaya->result_array() as $indexData => $data){
                                                                           ?>
                                                                                <option value="<?=$data['idJenisBiaya']?>" 
                                                                                     keterangan='<?=$data['keterangan']?>'><?=$data['nama']?></option>
                                                                           <?php
                                                                      }
                                                                 }
                                                            ?>
                                                       </select>
                                                       <p id="keteranganJenisBiaya" class="text-left text-sm mb-0 mt-2 text-muted" style='display:none;'></p>
                                                  </div>
                                                  <div class='form-group col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                                                       <label for='keterangan'>Keterangan (Opsional)</label>
                                                       <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan"></textarea>
                                                  </div>
                                             </div>
                                             <hr />
                                             <div class="row">
                                                  <button class="mr-1 btn btn-success" type="submit" id='btnSubmit'>Simpan Transaksi</button>
                                                  <a href="<?=site_url('transaksi')?>">
                                                       <button class="ml-1 btn btn-danger" type="button">Kembali ke List Transaksi</button>
                                                  </a>
                                             </div>
                                        </form>
                                   </div><!-- /.card-body -->
                              </div>
                              <!-- /.card -->
                         </section>
                         <!-- /.Left col -->
                    </div>
                    <div class="row" id='listSiswa' style='position:relative !important'>
                    </div>
                    <!-- /.row (main row) -->
               </div><!-- /.container-fluid -->
          </section>
          <!-- /.content -->
     <?php 
          }else{
               $dataDataNotFound   =    [
                    'dataNotFoundTitle' =>   'Tabungan Tidak Dikenal', 
                    'dataNotFoundDesc'  =>   'Sistem tidak menemukan data Tabungan yang berkaitan !',
                    'containerStyle'    =>   'position:absolute; top:50%; left:50%; transform : translate(-50%, -50%)'
               ];
               $this->load->view('components/data-not-found', $dataDataNotFound);
          }    
     ?>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('components/footer'); ?>
<?php $this->load->view('components/control-sidebar'); ?>
<?php $this->load->view('components/body-close'); ?>

</html>

<script src='<?=base_url('assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.js')?>'></script>
<link href='<?=base_url('assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.css')?>' rel='stylesheet' />

<script src='<?=base_url('assets/AdminLTE/plugins/select2/js/select2.min.js')?>'></script>
<link href='<?=base_url('assets/AdminLTE/plugins/select2/css/select2.min.css')?>' rel='stylesheet' />

<script language='Javascript'>

     $('#transaksi').on('submit', function(e){
          e.preventDefault();
          let formData   =    $(this).serialize();
          let btnSubmit  =    $('#btnSubmit');

          let btnSubmitText   =    btnSubmit.text();
          btnSubmit.prop('disabled', true).text('Processing ..');

          $.ajax({
               url  : '<?=base_url('transaksi/addTransaksi')?>',
               type : 'POST',
               data : formData,
               success : function(responseFromServer){
                    let JSONResponse    =    JSON.parse(responseFromServer);
                    if(JSONResponse.addTransaksi === true){
                         window.location.href     =    '<?=site_url("transaksi/listtransaksi")?>';
                    }else{
                         Swal.fire({
                              title : 'Penyimpanan Transaksi Baru',
                              html : `Penyimpanan data transaksi baru gagal ! <b class='text-danger'>${JSONResponse.message}</b>, Coba ulangi lagi !`,
                              type : 'error'
                         }).then((konfirmasi) => {
                              if(konfirmasi.value){
                                   btnSubmit.prop('disabled', false).text(btnSubmitText);
                              }
                         });
                    }

               }
          })
     });
     
     $('[data-toggle="tooltip"]').tooltip();

     $('#tabungan, #jenisBiaya').select2();
     $('.select2-selection').css('height', 'calc(2.25rem + 2px)');

     $('#jenisBiaya').on('change', function(e){
          e.preventDefault();
          let keterangan      =    $(this).find('option:selected').attr('keterangan');
          let idJenisBiaya    =    $(this).find('option:selected').attr('value');

          if(keterangan.length <= 0 || Number.parseInt(idJenisBiaya) === 0){
               $('#keteranganJenisBiaya').hide();
          }else{
               $('#keteranganJenisBiaya').html(`<b>Keterangan Jenis Biaya :</b> ${keterangan}`);
               $('#keteranganJenisBiaya').show();
          }
     });
</script>