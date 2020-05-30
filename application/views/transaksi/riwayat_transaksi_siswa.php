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
                         <h1 class="m-0 text-dark">Riwayat Transaksi Siswa</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                              <li class="breadcrumb-item"><a href="#">Home</a></li>
                              <li class="breadcrumb-item active">Riwayat Transaksi Siswa</li>
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
                                                  Filter Transaksi
                                             </h3>
                                        </div>
                                   </div>
                              </div><!-- /.card-header -->
                              <div class="card-body">
                                   <form id="formFilter">
                                        <div id="filterData" class="row">
                                             <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                  <div class="form-group">
                                                       <label for="siswa">Siswa</label>
                                                       <select name="siswa" id="siswa" class="form-control">
                                                            <option value="0">-- Pilih Siswa --</option>
                                                            <?php foreach ($listSiswa as $indexSiswa => $siswa) { ?>
                                                                 <option value="<?= $siswa['idSiswa'] ?>"><?= $siswa['nama'] ?> | NIS <?= $siswa['nis'] ?></option>
                                                            <?php } ?>
                                                       </select>
                                                  </div>
                                             </div>
                                             <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                  <div class="form-group">
                                                       <label for="jenisBiaya">Jenis Biaya</label>
                                                       <div class="input-group">
                                                            <select name="jenisBiaya" id="jenisBiaya" class="form-control">
                                                                 <option value="">-- Semua Jenis Biaya --</option>
                                                                 <?php
                                                                      $this->db->order_by('idJenisBiaya', 'desc');
                                                                      $jenisBiaya    =    $this->db->get('ts_jenis_biaya');

                                                                      foreach($jenisBiaya->result_array() as $index => $data){
                                                                           ?>
                                                                                <option value='<?=$data['idJenisBiaya']?>'><?=$data['nama']?></option>
                                                                           <?php
                                                                      }
                                                                 ?>
                                                            </select>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                                  <div class="form-group">
                                                       <label for="rentangWaktu">Rentang Waktu</label>
                                                       <div class="input-group">
                                                            <input type="date" class="form-control" name='waktuAwal'>
                                                            <input type="date" class="form-control" name='waktuAkhir'>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                        <hr />
                                        <button class="btn btn-success" type='submit'>
                                             <span class='fas fa-search mr-2'></span>
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
                                                  Riwayat Transaksi Siswa
                                             </h3>
                                        </div>
                                   </div>
                              </div>
                              <div class="card-body">
                                   <div class="col-12 table-responsive">
                                        <table id="detailSiswa" class="table table-sm">
                                             <tr>
                                                  <td class="no-bt vam text-center title text-bold text-lg" colspan="3">Riwayat Transaksi</td>
                                             </tr>
                                             <tr class='text-sm'>
                                                  <td class="no-bt vam text-left">NIS</td>
                                                  <td class="no-bt vam text-center">:</td>
                                                  <td class="no-bt vam text-left nis"></td>
                                             </tr>
                                             <tr class='text-sm'>
                                                  <td class="no-bt vam text-left">Nama</td>
                                                  <td class="no-bt vam text-center">:</td>
                                                  <td class="no-bt vam text-left nama"></td>
                                             </tr>
                                             <tr class='text-sm'>
                                                  <td class="no-bt vam text-left">Kelas</td>
                                                  <td class="no-bt vam text-center">:</td>
                                                  <td class="no-bt vam text-left kelas"></td>
                                             </tr>
                                             <tr class='text-sm'>
                                                  <td class="no-bt vam text-left">Alamat</td>
                                                  <td class="no-bt vam text-center">:</td>
                                                  <td class="no-bt vam text-left alamat"></td>
                                             </tr>
                                             <tr class='text-sm'>
                                                  <td class="no-bt vam text-left">Total Saldo</td>
                                                  <td class="no-bt vam text-center">:</td>
                                                  <td class="no-bt vam text-left">
                                                       <p class="totalSaldo mb-1 text-success"></p>
                                                       <p class="mb-0" style='font-size:9pt !important;'>(Terhitung Dari Awal Menabung sampai Sekarang)</p>
                                                  </td>
                                             </tr>
                                        </table>
                                        <hr>
                                        <br>
                                        <table id="tabelRiwayatTransaksi" class="table table-sm table-bordered">
                                             <thead>
                                                  <tr>
                                                       <th class='text-center'>No.</th>
                                                       <th class='text-center'>No. Transaksi</th>
                                                       <th class='text-left'>Keterangan</th>
                                                       <th class='text-right'>Debit</th>
                                                       <th class='text-right'>Kredit</th>
                                                       <th class='text-right'>Saldo Akhir</th>
                                                       <th class='text-left'>Admin</th>
                                                       <th class='text-left'>Waktu</th>
                                                  </tr>
                                             </thead>
                                             <tbody id="hasilFilter"></tbody>
                                             <!-- <tfoot id='totalUang'></tfoot> -->
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

     $('#siswa, #jenisBiaya').select2();
     $('.select2-selection').css('height', 'calc(2.25rem + 2px)');
     $('.select2.select2-container').css('display', 'block');

     $('#formFilter').on('submit', function(e) {
          e.preventDefault();

          $('#cardResult, #hasilKosong').css('opacity', '0.5');

          let formData = $(this).serialize();

          $.ajax({
               url: '<?= base_url("JSON/listTransaksiSiswa") ?>',
               data: formData,
               type: 'POST',
               success: function(responseFromServer) {
                    let dataJSON = JSON.parse(responseFromServer);
                    let dataJSONString = JSON.stringify(dataJSON.listTransaksiSiswa);
                    let listTransaksiSiswa = dataJSON.listTransaksiSiswa;

                    if (listTransaksiSiswa.length >= 1) {
                         let totalUang = 0;
                         let saldoAkhir = 0;
                         let rows = '';
                         let tfoot = '';
                         let dateNowaday = new Date('<?= date('Y-m-d') ?>');

                         for (let i = 0; i < listTransaksiSiswa.length; i++) {
                              let data = listTransaksiSiswa[i];
                              let actionBadgeColor = (data['action'] === 'masuk') ? 'success' : 'danger';

                              let dataWaktuArray = data['waktuTransaksi'].split(' ');
                              let dataTanggal = new Date(dataWaktuArray[0]);

                              let opsiReverse = '<span class="badge badge-danger">Tidak Dapat Reverse</span>';
                              let opsiEdit = '<span class="badge badge-danger">Tidak Dapat Edit</span>';

                              if (dataTanggal <= dateNowaday) {
                                   opsiReverse = `<span class='fas fa-reply text-success cp mr-1' data-toggle='tooltip'
                                                            data-placement='top' title='Reverse Tabungan'></span>`;
                                   opsiEdit = `<span class='fas fa-edit text-warning cp ml-1' data-toggle='tooltip'
                                                            data-placement='bottom' title='Edit Tabungan'></span>`;
                              }

                              let nominal = Number.parseInt(data['nominal']);
                              let action = data['action'].toLowerCase();
                              totalUang += (action) ? Number.parseInt(nominal) : Number.parseInt(nominal) * -1;
                              //dikali -1 menandakan bahwa itu adalah pengeluaran/penarikan/debit 

                              if (action === 'keluar') {
                                   saldoAkhir = saldoAkhir + nominal * -1;
                              } else {
                                   saldoAkhir = saldoAkhir + nominal;
                              }
                              let noticeReverse   =    '<p class="mb-0"><span class="badge badge-danger">Transaksi Ini Sudah di Reverse !</span></p>';
                              let isReversed      =    data['statusReverse'] === 'reverse';
                              
                              rows +=   `<tr class='text-sm tr-row'>
                                             <td class='vam text-center text-bold'>${i+1}.</td>
                                             <td class='vam text-center'>
                                                  <h6 class='text-bold'>${data['nomorTransaksi']}</h6>
                                             </td>
                                             <td class='vam text-left'>
                                                  ${data['keterangan']}
                                                  ${(isReversed)? noticeReverse:''}
                                             </td>
                                             <td class='text-right vam text-danger text-bold'>
                                                  Rp. ${(action === 'keluar')? numeral(nominal).format('0, 0') : 0}
                                             </td>
                                             <td class='text-right vam text-success text-bold'>
                                                  Rp. ${(action === 'masuk')? numeral(nominal).format('0, 0') : 0}
                                             </td>
                                             <td class='text-right vam text-bold'>
                                                  Rp. ${numeral(saldoAkhir).format('0,0')} ,-
                                             </td>
                                             <td class='vam text-left'>
                                                  <span class="badge badge-info">admin-${data['admin']}</span>
                                             </td>
                                             <td class="text-left vam">${data['waktuTransaksi']}</td>
                                        </tr>`;
                              if(isReversed){
                                   if (action === 'masuk') {
                                        saldoAkhir = saldoAkhir + nominal * -1;
                                   } else {
                                        saldoAkhir = saldoAkhir + nominal;
                                   }

                                   rows +=   `<tr class='text-sm tr-row'>
                                                  <td class='vam text-center text-bold'>-</td>
                                                  <td class='vam text-left' colspan='2'>
                                                       <h6 class='text-bold mb-0'>${data['nomorTransaksi']}</h6>
                                                       <p class='text-sm text-danger mb-0'>
                                                            Status Reverse : ${data['statusReverse']}
                                                            <span class='fas fa-info-circle text-info cp ml-2' data-toggle='tooltip' data-placement='top'
                                                                 title='${data['keteranganReverse']}'></span>
                                                       </p>
                                                  </td>
                                                  <td class='text-right vam text-danger text-bold'>
                                                       Rp. ${(action === 'masuk')? numeral(nominal).format('0, 0') : 0}
                                                  </td>
                                                  <td class='text-right vam text-success text-bold'>
                                                       Rp. ${(action === 'keluar')? numeral(nominal).format('0, 0') : 0}
                                                  </td>
                                                  <td class='text-right vam text-bold'>
                                                       Rp. ${numeral(saldoAkhir).format('0,0')} ,-
                                                  </td>
                                                  <td class='vam text-left'>
                                                       <span class="badge badge-info">admin-${data['admin']}</span>
                                                  </td>
                                                  <td class="text-left vam">${data['waktuTransaksi']}</td>
                                             </tr>`;
                              }
                         }

                         // tfoot     =    `<tr>
                         //                     <td colspan='5' class='text-center text-bold'>Total Uang</td>
                         //                     <td colspan='3' class='text-center text-bold text-${(saldoAkhir >= 0)? 'success' : 'danger'}'>Rp. ${numeral(saldoAkhir).format('0,0')} ,-</td>
                         //                </tr>`;


                         $('#hasilFilter').html(rows);
                         // $('#totalUang').html(tfoot);

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

          $.ajax({
               url  : `<?=base_url('JSON/detailSiswa')?>`,
               data : formData,
               type : 'POST',
               success : function(responseFromServer){
                    let JSONData        =    JSON.parse(responseFromServer);
                    let detailSiswa     =    JSONData.detailSiswa;

                    let tabelSiswa      =    $('#detailSiswa');
                    tabelSiswa.find('.nis').text(detailSiswa.nis);
                    tabelSiswa.find('.nama').text(detailSiswa.nama);
                    tabelSiswa.find('.kelas').text(detailSiswa.namaKelas);
                    tabelSiswa.find('.alamat').text(detailSiswa.alamat);
               } 
          });
          
          $.ajax({
               url  : `<?=base_url('JSON/totalSaldoSiswa')?>`,
               data : formData,
               type : 'POST',
               success : function(responseFromServer){
                    let JSONData        =    JSON.parse(responseFromServer);
                    let totalSaldo     =    JSONData.totalSaldo;

                    let tabelSiswa      =    $('#detailSiswa');
                    tabelSiswa.find('.totalSaldo').text(`Rp. ${numeral(totalSaldo).format('0,0')} ,-`);
               } 
          })
     });

     $('#exportToPDF, #exportToExcel').on('click', function(e){
          e.preventDefault();
          filterData     =    $('#formFilter').serialize();
          let url        =    new URLSearchParams(filterData);
          let exportTo   =    $(this).attr('exportTo').toLowerCase();

          let idSiswa         =    url.get('siswa');
          let waktuAwal       =    url.get('waktuAwal');
          let waktuAkhir      =    url.get('waktuAkhir');
          
          if(waktuAwal.length >= 1 && waktuAkhir.length >= 1){
               window.open(`<?=site_url('transaksi/exportData/')?>${exportTo}/${idSiswa}/${waktuAwal}/${waktuAkhir}`, '_blank');
          }else{
               window.open(`<?=site_url('transaksi/exportData/')?>${exportTo}/${idSiswa}`, '_blank');
          }
     });
</script>