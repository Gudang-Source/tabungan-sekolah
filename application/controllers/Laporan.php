<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
     public function __construct(){
          parent::__construct();

          $this->load->library('session');
		$this->load->model('AuthModel', 'am');
     }
     public function reverse(){
		$isLogin 	=	$this->am->isLogin();
		if($isLogin === false){
               redirect('auth?showNotice');
               exit();
          }
		$dataWebsite 	=	[
               'title'        =>   'Laporan Reverse | Aplikasi Tabungan Sekolah'
          ];

		$this->load->view('laporan/reverse', $dataWebsite);
     }
     public function transaksi($category = false){
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
               $waktuAwal     =    $this->input->get('waktuAwal').' 00:00:00';
               $waktuAkhir    =    $this->input->get('waktuAkhir').' 23:59:59';
          }
          
          if($this->input->get('statusTransaksi') == null || $this->input->get('statusTransaksi') == ''){
               $statusReverse     =    false;
          }else{
               $statusReverse     =    $this->input->get('statusTransaksi');
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

          $options       =    [
               'orderBy' =>   ['column' => 'idTransaksi', 'value' => 'desc'],
               'where'   =>   [
                    'waktuTransaksi >=' =>   $waktuAwal.' 00:00:00', 
                    'waktuTransaksi <=' =>   $waktuAkhir.' 23:59:59'
               ]
          ];

          if($statusReverse !== false && $statusReverse !== 'sukses'){
               $options['where']['statusReverse'] =    $statusReverse;
          }
          if($admin !== false && $admin !== ''){
               $options['where']['admin'] =    $admin;
          }
          if($kelas !== false && $kelas !== ''){
               $options['where']['idKelas'] =    $kelas;
          }


          $dataTransaksi  =    $this->trm->getData('view_transaksi', $options);

		$dataWebsite 	=	[
               'title'             =>   'Transaksi | Aplikasi Tabungan Sekolah',
               'dataTransaksi'     =>   $dataTransaksi
          ];

		$this->load->view('transaksi/index', $dataWebsite);
     }
     public function exportData($exportTo, $kelas, $admin, $waktuAwal, $waktuAkhir, $actionTransaksi, $statusReverse, $jenisBiaya){
          $exportTo           =    strtolower($exportTo);

          $kelas              =    strtolower($kelas);
          $admin              =    strtolower($admin);
          $waktuAwal          =    strtolower($waktuAwal);
          $waktuAkhir         =    strtolower($waktuAkhir);

          if($exportTo === 'excel'){
               $this->load->model('ExportDataModel', 'export');

               if($kelas !== '' && $kelas !== 'null'){
                    $this->db->where('idKelas', $kelas);
               }
               if($admin !== '' && $admin !== 'null'){
                    $this->db->where('admin', $admin);
               }
               if($waktuAwal !== '' && $waktuAkhir !== '' && $waktuAwal !== 'null' && $waktuAkhir !== 'null'){
                    $this->db->where('waktuTransaksi >=', $waktuAwal.' 00:00:00');
                    $this->db->where('waktuTransaksi <=', $waktuAkhir.' 23:59:59');
               }
               if($actionTransaksi !== '' && $actionTransaksi !== 'null'){
                    $this->db->where('action', $actionTransaksi);
               }
               if($statusReverse !== '' && $statusReverse !== 'null'){
                    $this->db->where('statusReverse', $statusReverse);
               }
               if($jenisBiaya !== '' && $jenisBiaya !== 'null'){
                    $this->db->where('jenisBiaya', $jenisBiaya);
               }

               $listTransaksiGlobal   =    $this->db->get('view_transaksi')->result_array();

               $kolomExcel    =    ['No.', 'Nama Tabungan', 'Nomor Tabungan', 'Nomor Transaksi', 'Reverse', 'Nominal', 'Action', 'Jenis Biaya', 'Nama Siswa Pemilik', 'Admin', 'Waktu'];
               $barisExcel    =    [];

               if(is_array($listTransaksiGlobal)){
                    foreach($listTransaksiGlobal as $indexListTransaksi => $transaksi){
                         $data     =    [
                              $indexListTransaksi+1,
                              $transaksi['namaTabungan'], 
                              $transaksi['nomorTabungan'],
                              $transaksi['nomorTransaksi'],
                              ($transaksi['statusReverse'] === 'pending' || $transaksi['statusReverse'] === 'reverse')? strtoupper($transaksi['statusReverse']) : '-',
                              $transaksi['nominal'],
                              $transaksi['action'],
                              $transaksi['namaJenisBiaya'],
                              $transaksi['siswaPemilikTabungan'],
                              'admin-'.$transaksi['admin'],
                              $transaksi['waktuTransaksi']
                         ];

                         array_push($barisExcel, $data);
                    }
               }

               $fileName      =    'Laporan Transaksi Global exported '.date('d M Y').'.xls';
               
               $title         =    ['', '', '', '', 'Laporan Transaksi', '', '', '', ''];
               $this->export->exportToExcel($title, false, $kolomExcel, $barisExcel, $fileName);
          }else if($exportTo === 'pdf'){
               $options  =    [
                    'kelas'             =>   $kelas,
                    'admin'             =>   $admin,
                    'waktuAwal'         =>   $waktuAwal,
                    'waktuAkhir'        =>   $waktuAkhir,
                    'actionTransaksi'   =>   $actionTransaksi,
                    'statusReverse'     =>   $statusReverse,
                    'jenisBiaya'        =>   $jenisBiaya
               ];
               $this->load->view('laporan/transaksi_pdf', $options);
          }else{
               redirect('mistake');
          }
     }
}
