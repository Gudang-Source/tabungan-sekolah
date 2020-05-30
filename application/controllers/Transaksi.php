<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
     public function __construct(){
          parent::__construct();

          $this->load->library('session');
		$this->load->model('AuthModel', 'am');
     }
	public function index(){
		$isLogin 	=	$this->am->isLogin();
		if($isLogin === false){
               redirect('auth?showNotice');
               exit();
          }
          
          $this->load->model('TransaksiModel', 'trm');

          if($this->input->get('waktuAwal') == null && $this->input->get('waktuAkhir') == null){
               $waktuAwal     =    date('Y-m-d').' 00:00:00';
               $waktuAkhir    =    date('Y-m-d').' 23:59:59';
          }else{
               $waktuAwal     =    $this->input->get('waktuAwal');
               $waktuAkhir    =    $this->input->get('waktuAkhir');
          }
        
          if($this->input->get('admin') == null || $this->input->get('admin') == ''){
               $admin     =    false;
          }else{
               $admin     =    $this->input->get('admin');
          }

          if($this->input->get('kelas') == null || $this->input->get('kelas') == ''){
               $kelas     =    false;
          }else{
               $kelas     =    $this->input->get('kelas');
          }
          if($this->input->get('jenisBiaya') == null || $this->input->get('jenisBiaya') == ''){
               $jenisBiaya     =    false;
          }else{
               $jenisBiaya     =    $this->input->get('jenisBiaya');
          }

          $options       =    [
               'orderBy' =>   ['column' => 'idTransaksi', 'value' => 'desc'],
               'where'   =>   [
                    'waktuTransaksi >=' =>   $waktuAwal.' 00:00:00', 
                    'waktuTransaksi <=' =>   $waktuAkhir.' 23:59:59'
               ]
          ];

          $statusReverse      =    $this->input->get('statusReverse');
          $actionTransaksi    =    $this->input->get('actionTransaksi');

          if($actionTransaksi !== null){
               if($actionTransaksi === 'masuk' || $actionTransaksi === 'keluar'){
                    $options['where']['action'] =    $actionTransaksi;
               }
          }

          if($statusReverse !== null){
               if($statusReverse === 'pending' || $statusReverse === 'reverse'){
                    $options['where']['statusReverse'] =    $statusReverse;
               }
          }
               
          if($admin !== false && $admin !== ''){
               $options['where']['admin'] =    $admin;
          }
          if($kelas !== false && $kelas !== ''){
               $options['where']['idKelas'] =    $kelas;
          }
          if($jenisBiaya !== false && $jenisBiaya !== ''){
               $options['where']['jenisBiaya'] =    $jenisBiaya;
          }


          $dataTransaksi  =    $this->trm->getData('view_transaksi', $options);

		$dataWebsite 	=	[
               'title'             =>   'Transaksi | Aplikasi Tabungan Sekolah',
               'dataTransaksi'     =>   $dataTransaksi
          ];

		$this->load->view('transaksi/index', $dataWebsite);
     }
     public function add(){
		$isLogin 	=	$this->am->isLogin();
		if($isLogin === false){
               redirect('auth?showNotice');
               exit();
          }
          
          $userLevel 	=	$this->session->userdata('level');
		if($userLevel !== 'admin'){
               redirect('mistake/not_accessible');
               exit();
          }
          
          $this->load->model('TabunganModel', 'tm');

          $options  =    [
               'select'  =>   'idTabungan, namaTabungan, namaSiswa'
          ];
          $listTabungan     =    $this->tm->getData('view_tabungan', $options);

		$dataWebsite 	=	[
               'isEdit'       =>   false,
               'title'        =>   'Tambah Transaksi Baru | Aplikasi Tabungan Sekolah',
               'listTabungan' =>   $listTabungan
          ];

		$this->load->view('transaksi/add', $dataWebsite);
     }
     public function riwayattransaksisiswa(){
          $this->load->model('SiswaModel', 'sm');
          $this->load->model('UserModel', 'um');

          $options       =    ['select' => 'idSiswa, nama, nis'];
          $listSiswa     =    $this->sm->listSiswa($options);

          $options       =    ['select' => 'idUser, nama'];
          $listAdmin     =    $this->um->getData('ts_user', $options);

		$dataWebsite 	=	[
               'title'        =>   'Riwayat Transaksi Siswa | Aplikasi Tabungan Sekolah',
               'listSiswa'    =>   $listSiswa->result_array(),
               'listAdmin'    =>   $listAdmin
          ];

		$this->load->view('transaksi/riwayat_transaksi_siswa', $dataWebsite);
     }
     public function listtransaksi(){
          $this->index();
     }
     
     public function addTransaksi(){
		$isLogin 	=	$this->am->isLogin();
		if($isLogin === false){
               redirect('auth?showNotice');
               exit();
          }
          
          $tabungan      =    trim($this->input->post('tabungan'));
          $nominal       =    abs(trim($this->input->post('nominal')));
          $action        =    strtolower(trim($this->input->post('action')));
          $jenisBiaya    =    strtolower(trim($this->input->post('jenisBiaya')));
          $keterangan    =    trim($this->input->post('keterangan'));

          $statusAdd     =    false;
          $message       =    '';

          if($action === 'masuk' || $action === 'keluar'){
               if($tabungan >= 1 && $nominal >= 1 && strlen($keterangan) >= 0){
                    $this->load->model('TransaksiModel', 'trm');
                    $this->load->model('SiswaModel', 'sm');

                    $options  =    [
                         'select'  =>   'idSiswa',
                         'where'   =>   ['idTabungan' => $tabungan]
                    ];

                    $idAdmin  =    $this->session->userdata('idUser');
                    $idSiswa  =    $this->trm->getData('view_tabungan', $options, true)['idSiswa'];

                    if($action === 'keluar'){
                         $totalSaldo    =    $this->sm->totalSaldo($idSiswa);
                         if($nominal > $totalSaldo){
                              $message  =    'Sisa Saldo Siswa Pemilik Tabungan adalah Rp. '.number_format($totalSaldo).' ,-';

                              echo json_encode(['addTransaksi' => $statusAdd, 'message' => $message]);
                              exit();
                         }
                    }

                    $data     =    [
                         'idTabungan'   =>   $tabungan,
                         'nominal'      =>   $nominal,
                         'action'       =>   $action,
                         'jenisBiaya'   =>   $jenisBiaya,
                         'keterangan'   =>   $keterangan,
                         'admin'        =>   $idAdmin,
                         'nomorTransaksi'    =>   ''
                    ];

                    $addTransaksi  =    $this->trm->addData('ts_transaksi', $data);
                    if($addTransaksi){
                         $idTransaksi   =    $this->db->insert_id();
                         $nomorTransaksi     =    date('ymd').'-'.$idAdmin.'-'.$idSiswa.'-'.$idTransaksi;

                         $this->db->where('idTransaksi', $idTransaksi);
                         $updateIDTransaksi  =    $this->db->update('ts_transaksi', ['nomorTransaksi' => $nomorTransaksi]);

                         if($updateIDTransaksi){
                              $statusAdd     =    true;
                         }
                    }
               }
          }

          echo json_encode(['addTransaksi' => $statusAdd, 'message' => $message]);
     }
     public function exportData($exportTo, $idSiswa = false, $waktuAwal = false, $waktuAkhir = false){
          $exportTo =    strtolower($exportTo);

          $this->db->select('nama, kelas, alamat, nis, namaKelas');
          $this->db->where('idSiswa', $idSiswa);
          $detailSiswa   =   $this->db->get('view_siswa');

          if($detailSiswa->num_rows() >= 1){
               $detailSiswa   =    $detailSiswa->row();
               if($exportTo === 'excel'){
                    $this->load->model('ExportDataModel', 'export');
                    $this->load->model('TransaksiModel', 'trm');
                    $this->load->model('SiswaModel', 'sm');
               
                    $this->db->where('idSiswaPemilikTabungan', $idSiswa);
                    if($waktuAwal !== false && $waktuAkhir !== false){
                         $this->db->where('waktuTransaksi >=', $waktuAwal.' 00:00:00');
                         $this->db->where('waktuTransaksi <=', $waktuAkhir.' 23:59:59');
                    }
                    $listTransaksiSiswa   =    $this->db->get('view_transaksi')->result_array();

                    // echo json_encode($listTransaksiSiswa);
                    // exit();

                    $optionsTransaksi  =    [
                         'select'  =>   'nominal, action',
                         'where'   =>   [
                              'idSiswaPemilikTabungan' =>   $idSiswa,
                              'statusReverse !='       =>   'reverse'
                         ]
                    ];
                    
                    $debitKredit   =    $this->sm->getData('view_transaksi', $optionsTransaksi);
                    $totalSaldo    =    0;
     
                    foreach($debitKredit as $indexData => $dK){
                         if($dK['action'] === 'keluar'){
                              $nominal  =    $dK['nominal']*-1;
                         }else{
                              $nominal  =    $dK['nominal'];
                         }
     
                         $totalSaldo    +=   $nominal;
                    }

                    $kolomExcel    =    ['No.', 'Nomor Transaksi', 'Keterangan', 'Jenis Biaya', 'Debit', 'Kredit', 'Saldo Akhir', 'Admin', 'Waktu'];
                    $barisExcel    =    [];

                    $saldoAkhir    =    0;

                    if(is_array($listTransaksiSiswa)){
                         foreach($listTransaksiSiswa as $indexListTransaksi => $transaksi){
                              if($transaksi['action'] === 'keluar'){
                                   $saldoAkhir     =    $saldoAkhir + $transaksi['nominal']*-1;
                              }else{
                                   $saldoAkhir     =    $saldoAkhir + $transaksi['nominal'];
                              }

                              if($transaksi['statusReverse'] === 'reverse'){
                                   $keteranganTransaksi     =    $transaksi['keterangan'].' (Transaksi Ini Sudah di Reverse !)';
                              }else{
                                   $keteranganTransaksi     =    $transaksi['keterangan'];
                              }

                              $isReversed    =    $transaksi['statusReverse'] === 'reverse';

                              $data     =    [
                                   $indexListTransaksi+1,
                                   $transaksi['nomorTransaksi'], 
                                   $keteranganTransaksi, 
                                   $transaksi['namaJenisBiaya'], 
                                   ($transaksi['action'] === 'keluar')? $transaksi['nominal'] : 0, 
                                   ($transaksi['action'] === 'masuk')? $transaksi['nominal'] : 0,
                                   $saldoAkhir,
                                   'admin-'.$transaksi['admin'],
                                   $transaksi['waktuTransaksi']
                              ];

                              array_push($barisExcel, $data);
                              
                              if($isReversed){
                                   if($transaksi['action'] === 'masuk'){
                                        $saldoAkhir     =    $saldoAkhir + $transaksi['nominal']*-1;
                                   }else{
                                        $saldoAkhir     =    $saldoAkhir + $transaksi['nominal'];
                                   }

                                   $RowReverse     =    [
                                        '-',
                                        '', 
                                        'Status Reverse : '.$transaksi['statusReverse'], 
                                        ($transaksi['action'] === 'masuk')? $transaksi['nominal'] : 0, 
                                        ($transaksi['action'] === 'keluar')? $transaksi['nominal'] : 0,
                                        $saldoAkhir,
                                        'admin-'.$transaksi['admin'],
                                        $transaksi['waktuTransaksi']
                                   ];

                                   $RowKeteranganReverse    =    [
                                        '-',
                                        '', 
                                        'Keterangan : '.$transaksi['keteranganReverse'], 
                                        '', 
                                        '',
                                        '',
                                        '',
                                        ''
                                   ];

                                   array_push($barisExcel, $RowReverse);
                                   array_push($barisExcel, $RowKeteranganReverse);
                              }

                         }
                    }

                    $fileName      =    'Riwayat Transaksi Siswa '.$listTransaksiSiswa[0]['siswaPemilikTabungan'].' exported '.date('d M Y').'.xls';
                    $header        =    [
                         ['NIS', ':', $detailSiswa->nis],
                         ['Nama', ':', $detailSiswa->nama],
                         ['Kelas', ':', $detailSiswa->namaKelas],
                         ['Alamat', ':', $detailSiswa->alamat],
                         ['Total Saldo', ':', 'Rp. '.number_format($totalSaldo).' ,-'],
                         ['', '', '(Terhitung Dari Awal Menabung sampai Sekarang)']
                    ];
                    $title         =    ['', '', '', '', 'Riwayat Transaksi', '', '', ''];
                    $this->export->exportToExcel($title, $header, $kolomExcel, $barisExcel, $fileName);
                    // echo json_encode($header);
                    exit;
               }else if($exportTo === 'pdf' && $idSiswa !== false){
                    $options  =    [
                         'idSiswa'      =>   $idSiswa,
                         'waktuAwal'    =>   $waktuAwal,
                         'waktuAkhir'   =>   $waktuAkhir
                    ];
                    $this->load->view('transaksi/pdf', $options);
               }else{
                    redirect('mistake');
               }
          }else{
               redirect('mistake');
          }
     }
     public function transaksireverse(){
		$isLogin 	=	$this->am->isLogin();
		if($isLogin === false){
               redirect('auth?showNotice');
               exit();
          }
		$dataWebsite 	=	[
               'title'        =>   'Transaksi Reverse | Aplikasi Tabungan Sekolah'
          ];

		$this->load->view('transaksi/transaksi_reverse', $dataWebsite);
     }
     public function addReverse(){
		$isLogin 	=	$this->am->isLogin();
		if($isLogin === false){
               redirect('auth?showNotice');
               exit();
          }
          
          $nomorTransaksi     =    trim($this->input->post('nomorTransaksi'));
          $keterangan         =    trim($this->input->post('keterangan'));

          $statusReverse      =    false;
          $messageReverse     =    '';

          if(strlen($nomorTransaksi) >= 1 && strlen($keterangan) >= 1){
               $this->load->model('TransaksiModel', 'trm');

               $options  =    ['where' => ['nomorTransaksi' => $nomorTransaksi]];
               $detailTransaksi    =    $this->trm->getData('ts_transaksi', $options, true);

               if(count($detailTransaksi) >= 1){
                    $currentActiveUserID      =    $this->session->userdata('idUser');
                    if($detailTransaksi['admin'] === $currentActiveUserID){
                         $tanggalTransaksi   =    explode(' ', $detailTransaksi['waktuTransaksi'])[0];
                         if($tanggalTransaksi === date('Y-m-d')){
                              $this->db->select('idReverse');
                              $this->db->where('nomorTransaksi', $nomorTransaksi);
                              $isSudahDiReverse   =    $this->db->get('ts_reverse');

                              if($isSudahDiReverse->num_rows() <= 0){
                                   $dataReverse   =    [
                                        'nomorTransaksi'    =>   $nomorTransaksi,
                                        'keterangan'        =>   $keterangan
                                   ];

                                   $addReverse    =    $this->trm->addData('ts_reverse', $dataReverse);
                                   if($addReverse){
                                        $statusReverse      =    true;
                                        $messageReverse     =    'Berhasil Reverse !';
                                   }else{
                                        $messageReverse     =    'Tidak dapat menyimpan ke database !';
                                   }
                              }else{
                                   $messageReverse     =    'Transaksi ini sudah direverse sebelumnya !';
                              }
                         }else{
                              $messageReverse     =    'Transaksi ini tidak dapat direverse karena sudah melewati batas waktu !';
                         }
                    }else{
                         $messageReverse     =    'Anda bukan admin yang menginput data transaksi tabungan !';
                    }
               }else{
                    $messageReverse     =    'Nomor Transaksi Tidak Terdaftar !';
               }
          }else{
               $messageReverse  =    'Data Tidak Lengkap !';
          }

          echo json_encode(['addReverse' => $statusReverse, 'messageReverse' => $messageReverse]);
     }
     public function approvementreverse(){
		$isLogin 	=	$this->am->isLogin();
		if($isLogin === false){
               redirect('auth?showNotice');
               exit();
          }

          $this->load->model('TransaksiModel', 'trm');
          $options       =    [
               'where'   =>   [
                    'waktu >= ' => date('Y-m-d').' 00:00:00', 
                    'waktu <= ' => date('Y-m-d').' 23:59:59',
                    'statusReverse'     =>   'pending'
               ]
          ];

          $listReverse   =    $this->trm->getData('ts_reverse', $options);

		$dataWebsite 	=	[
               'title'        =>   'Persetujuan Reverse | Aplikasi Tabungan Sekolah',
               'listReverse'  =>   $listReverse
          ];

		$this->load->view('transaksi/approvement_reverse', $dataWebsite);
     }
     public function reverse(){
		$isLogin 	=	$this->am->isLogin();
		if($isLogin === false){
               redirect('auth?showNotice');
               exit();
          }

          $idReverse     =    trim($this->input->post('idReverse'));

          $options       =    ['where' => ['idReverse' => $idReverse]];
          $dataReverse   =    ['statusReverse'     =>   'reverse'];

          $this->load->model('TransaksiModel', 'trm');
          $reverse  =    $this->trm->editData('ts_reverse', $dataReverse, $options);

          $statusReverse =    ($reverse)? true : false;
          echo json_encode(['statusReverse' => $statusReverse]);
     }
}
