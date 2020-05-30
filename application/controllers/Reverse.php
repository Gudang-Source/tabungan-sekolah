<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reverse extends CI_Controller {
     public function __construct(){
          parent::__construct();

          $this->load->library('session');
		$this->load->model('AuthModel', 'am');
     }
     public function transaksireverse(){
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
               $this->load->model('ReverseModel', 'rm');

               $options  =    ['where' => ['nomorTransaksi' => $nomorTransaksi]];
               $detailTransaksi    =    $this->rm->getData('ts_transaksi', $options, true);

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

                                   $addReverse    =    $this->rm->addData('ts_reverse', $dataReverse);
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

          $userLevel 	=	$this->session->userdata('level');
		if($userLevel !== 'superadmin'){
               redirect('mistake/not_accessible');
               exit();
          }

          $this->load->model('ReverseModel', 'rm');
          $options       =    [
               'where'   =>   [
                    'waktu >= '     =>   date('Y-m-d').' 00:00:00', 
                    'waktu <= '     =>   date('Y-m-d').' 23:59:59',
                    'statusReverse'          =>   'pending'
               ]
          ];

          $listReverse   =    $this->rm->getData('ts_reverse', $options);

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

          $this->load->model('ReverseModel', 'rm');
          $reverse  =    $this->rm->editData('ts_reverse', $dataReverse, $options);

          $statusReverse =    ($reverse)? true : false;
          echo json_encode(['statusReverse' => $statusReverse]);
     }
     public function exportData($exportTo, $statusReverse = false, $waktuAwal = false, $waktuAkhir = false){
          $exportTo      =    strtolower($exportTo);

          if($exportTo === 'excel'){
               $this->load->model('ExportDataModel', 'export');

               $kolomExcel    =    ['No.', 'Nomor Transaksi', 'Keterangan', 'Status Reverse', 'Waktu Reverse'];
               $barisExcel    =    [];

               if($statusReverse !== false){
                    $this->db->where('statusReverse', $statusReverse);
               }
               if($waktuAwal !== false && $waktuAkhir !== false){
                    $opsiRentangWaktu   =    [
                         'waktu >=' => $waktuAwal.' 00:00:00',
                         'waktu <=' => $waktuAkhir.' 23:59:59'
                    ];

                    $this->db->where($opsiRentangWaktu);
               }
               $laporanReverse     =    $this->db->get('ts_reverse')->result_array();
               foreach($laporanReverse as $indexReverse => $reverse){
                    $data     =    [
                         $indexReverse+1,
                         $reverse['nomorTransaksi'],
                         $reverse['keterangan'],
                         $reverse['statusReverse'],
                         $reverse['waktu']
                    ];
                    
                    array_push($barisExcel, $data);
               }

               if($waktuAwal !== false && $waktuAkhir !== false){
                    $title         =    ['', '', 'Laporan Reverse Periode'.$waktuAwal.' sd '.$waktuAkhir, '', ''];
                    $fileName      =    'Laporan_Reverse_Periode'.$waktuAwal.'_sd_'.$waktuAkhir.'.xls';
               }else{
                    $title         =    ['', '', 'Laporan Reverse', '', ''];
                    $fileName      =    'Laporan_Reverse.xls';
               }

               $this->export->exportToExcel($title, false, $kolomExcel, $barisExcel, $fileName);
          }else if($exportTo === 'pdf'){
               $options  =    [
                    'statusReverse'     =>   $statusReverse,
                    'waktuAwal'         =>   $waktuAwal,
                    'waktuAkhir'        =>   $waktuAkhir
               ];
               $this->load->view('laporan/reverse_pdf', $options);
          }else{
               redirect('mistake');
          }
     }
}
