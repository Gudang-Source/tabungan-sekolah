<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JSON extends CI_Controller {
     var $isLogin   =    false;

     public function __construct(){
          parent::__construct();

          $this->load->library('session');
		$this->load->model('AuthModel', 'am');

		$isLogin 	=	$this->am->isLogin();
		$this->isLogin      =    $isLogin;
     }
     public function listSiswa(){
          if($this->isLogin){
               $this->load->model('SiswaModel', 'sm');

               $search   =    trim($this->input->post('search'));
               $select   =    trim($this->input->post('select'));
               $options  =    ['search' => $search, 'select' => $select];
               
               $listSiswaArray     =    $this->sm->listSiswa($options)->result_array();
          }else{
               $listSiswaArray     =    [];
          }
          
          echo json_encode(['listSiswa' => $listSiswaArray]);
     }
     public function listSiswaInKelas(){
          if($this->isLogin){
               $this->load->model('SiswaModel', 'sm');

               $asalKelas          =    trim($this->input->post('asalKelas'));
               $withListKelas      =    ($this->input->post('withListKelas') === null)? false : (trim($this->input->post('withListKelas')) === 'true')? true : false;

               $options       =    [
                    'select'  =>   'idSiswa, nama, nis, namaKelas, alamat',
                    'where'   =>   ['kelas' => $asalKelas]
               ];
               
               $listSiswaArray     =    $this->sm->getData('view_siswa', $options);
          }else{
               $listSiswaArray     =    [];
          }
          
          $response =    ['listSiswa' => $listSiswaArray];

          if($withListKelas){
               $listKelas     =    $this->sm->getData('ts_kelas');
               $response['listKelas']   =    $listKelas;
          }

          echo json_encode($response);
     }
     public function listTransaksiSiswa(){
          $this->load->database();

          $siswa         =    trim($this->input->post('siswa'));
          $jenisBiaya    =    trim($this->input->post('jenisBiaya'));
          $waktuAwal     =    trim($this->input->post('waktuAwal'));
          $waktuAkhir    =    trim($this->input->post('waktuAkhir'));
          $action        =    strtolower(trim($this->input->post('action')));

          $this->db->where('idSiswaPemilikTabungan', $siswa);
          
          if(strlen($jenisBiaya) >= 1){
               $this->db->where('jenisBiaya', $jenisBiaya);
          }

          if($waktuAwal !== '' && $waktuAkhir !== ''){
               $opsiRentangWaktu   =    [
                    'waktuTransaksi >=' => $waktuAwal.' 00:00:00',
                    'waktuTransaksi <=' => $waktuAkhir.' 23:59:59'
               ];

               $this->db->where($opsiRentangWaktu);
          }
          if($action != '' && ($action === 'masuk' || $action === 'keluar')){
               $this->db->where('action', $action);
          }
          
          $listTransaksiSiswa     =    $this->db->get('view_transaksi')->result_array();
          
          echo json_encode(['listTransaksiSiswa' => $listTransaksiSiswa]);
     }
     public function detailSiswa(){
          $this->load->model('SiswaModel', 'sm');

          $siswa    =    trim($this->input->post('siswa'));
          $options  =    ['where' => ['idSiswa' => $siswa]];
          
          $detailSiswa     =    $this->sm->getData('view_siswa', $options, true);

          echo json_encode(['detailSiswa' => $detailSiswa]);
     }
     public function totalSaldoSiswa(){
          $this->load->model('SiswaModel', 'sm');

          $siswa    =    trim($this->input->post('siswa'));
          $options  =    [
               'select'  =>   'nominal, action',
               'where'   =>   [
                    'idSiswaPemilikTabungan' =>   $siswa,
                    'statusReverse !='       =>   'reverse'
               ]
          ];
          
          $debitKredit   =    $this->sm->getData('view_transaksi', $options);
          $totalSaldo    =    0;

          foreach($debitKredit as $indexData => $dK){
               if($dK['action'] === 'keluar'){
                    $nominal  =    $dK['nominal']*-1;
               }else{
                    $nominal  =    $dK['nominal'];
               }

               $totalSaldo    +=   $nominal;
          }
          
          echo json_encode(['totalSaldo' => $totalSaldo]);
     }
     public function laporanReverse(){
          $statusReverse =    trim($this->input->post('statusReverse'));
          $waktuAwal     =    trim($this->input->post('waktuAwal'));
          $waktuAkhir    =    trim($this->input->post('waktuAkhir'));

          $this->db->where('statusReverse', $statusReverse);
          if($waktuAwal !== '' && $waktuAkhir !== ''){
               $opsiRentangWaktu   =    [
                    'waktu >=' => $waktuAwal.' 00:00:00',
                    'waktu <=' => $waktuAkhir.' 23:59:59'
               ];

               $this->db->where($opsiRentangWaktu);
          }
          $laporanReverse     =    $this->db->get('ts_reverse')->result_array();
          echo json_encode(['laporanReverse' => $laporanReverse]);
     }
}
