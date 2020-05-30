<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sekolah extends CI_Controller {
     public function __construct(){
          parent::__construct();
          $this->load->model('SekolahModel', 'sm');
          $this->load->library('session');
		$this->load->model('AuthModel', 'am');

		$isLogin 	=	$this->am->isLogin();
		if($isLogin === false){
               redirect('auth?showNotice');
               exit();
		}
     }
	public function index(){
          $options       =    ['orderBy' => ['column' => 'idSekolah', 'value' => 'desc']];
          $dataSekolah   =    $this->sm->getData('ts_sekolah', $options);

		$dataWebsite 	=	[
               'title'        =>   'Sekolah | Aplikasi Tabungan Sekolah',
               'dataSekolah'  =>   $dataSekolah
          ];

		$this->load->view('sekolah/index', $dataWebsite);
     }
	public function add(){
          $userLevel 	=	$this->session->userdata('level');
		if($userLevel !== 'superadmin'){
               redirect('mistake/not_accessible');
               exit();
          }
          
		$dataWebsite 	=	[
               'title'        =>   'Tambah Sekolah Baru | Aplikasi Tabungan Sekolah',
               'isEdit'       =>   false
          ];

		$this->load->view('sekolah/add', $dataWebsite);
     }
     public function listsekolah(){
          $this->index();
     }
     public function addSekolah(){
          $idSekolah     =    $this->input->post('idSekolah');
          $isEdit        =    (strlen($idSekolah) >= 1)? true : false;
          
          $namaSekolah   =    $this->input->post('namasekolah');
          $noHP          =    $this->input->post('nomorteleponsekolah');
          $alamat        =    $this->input->post('alamat');
          $email         =    $this->input->post('emailsekolah');
          $tglPendiri    =    $this->input->post('tglpendiri');

          $statusAdd     =    false;
          $message       =    '';

          $isNamaSekolahExist     =    $this->sm->isThisDataExist('ts_sekolah', 'nama', $namaSekolah);
          if($isNamaSekolahExist === false){ 
               $isNoHpSekolahExist     =    $this->sm->isThisDataExist('ts_sekolah', 'noHP', $noHP);
               if($isNoHpSekolahExist === false){
                    $isEmailSekolahExist     =    $this->sm->isThisDataExist('ts_sekolah', 'email', $email);
                    if($isEmailSekolahExist === false){
                         if(strlen($namaSekolah) >= 1 && strlen($noHP) >= 10 && strlen($alamat) >= 1 && strlen($email) >= 1 && strlen($tglPendiri) >= 1){
                              $dataSekolah   =    [
                                   'nama'         =>   $namaSekolah,
                                   'noHP'         =>   $noHP,
                                   'alamat'       =>   $alamat,
                                   'email'        =>   $email,
                                   'tglPendiri'   =>   $tglPendiri
                              ];

                              if($isEdit){
                                   $options       =    ['where' => ['idSekolah' => $idSekolah]];
                                   $actionSekolah    =    $this->sm->editData('ts_sekolah', $dataSekolah, $options);
                              }else{
                                   $actionSekolah    =    $this->sm->addData('ts_sekolah', $dataSekolah);
                              }

                              if($actionSekolah){
                                   $statusAdd     =    true;
                              }
                         }else{
                              $message  =    'Nomor Telepon Sekolah Min. 10 karakter';
                         }
                    }else{
                         $message  =    'Email Sekolah Sudah Dipakai';
                    }
               }else{
                    $message  =    'Nomor Telepon Sekolah Sudah Dipakai';
               }
          }else{
               $message  =    'Nama Sekolah Sudah Dipakai';
          }

          echo json_encode(['addSekolah' => $statusAdd, 'message' => $message]);
     }
     public function deleteSekolah(){
          $idSekolah     =    $this->input->post('idSekolah');

          $deleteSekolah =    $this->sm->deleteData('ts_sekolah', ['idSekolah' => $idSekolah]);
          $response      =    ['deleteSekolah' => $deleteSekolah];
          
          echo json_encode($response);
     }
     public function edit($idSekolah){
          $userLevel 	=	$this->session->userdata('level');
		if($userLevel !== 'superadmin'){
               redirect('mistake/not_accessible');
               exit();
          }
          
          $options            =    ['where' => ['idSekolah' => $idSekolah]];
          $detailSekolah      =    $this->sm->getData('ts_sekolah', $options, true);
          
          $dataWebsite 	=	[
               'title'        =>   'Edit Data Siswa | Aplikasi Tabungan Sekolah',
               'isEdit'       =>   true,
               'detailSekolah'   =>   $detailSekolah
          ];

		$this->load->view('sekolah/add', $dataWebsite);
     }
}
