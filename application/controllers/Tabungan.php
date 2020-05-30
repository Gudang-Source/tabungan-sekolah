<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabungan extends CI_Controller {
     public function __construct(){
          parent::__construct();

          $this->load->library('session');
		$this->load->model('AuthModel', 'am');

		$isLogin 	=	$this->am->isLogin();
		if($isLogin === false){
               redirect('auth?showNotice');
               exit();
		}
     }
	public function index(){
          $this->load->model('TabunganModel', 'tm');

          $options       =    ['orderBy' => ['column' => 'idTabungan', 'value' => 'desc']];
          $dataTabungan     =    $this->tm->getData('view_tabungan', $options);

		$dataWebsite 	=	[
               'title'        =>   'Tabungan | Aplikasi Tabungan Sekolah',
               'dataTabungan' =>   $dataTabungan
          ];

		$this->load->view('tabungan/index', $dataWebsite);
     }
     public function add(){
          $userLevel 	=	$this->session->userdata('level');
		if($userLevel !== 'admin'){
               redirect('mistake/not_accessible');
               exit();
          }
          
          $this->load->model('SiswaModel', 'sm');
          $listSiswa     =    $this->sm->listSiswa();

		$dataWebsite 	=	[
               'listSiswa'    =>   $listSiswa,
               'isEdit'       =>   false,
               'title'        =>   'Tambah Tabungan Baru | Aplikasi Tabungan Sekolah'
          ];

		$this->load->view('tabungan/add', $dataWebsite);
     }
     public function listtabungan(){
          $this->index();
     }
     
     public function addTabungan(){
          $idSiswa            =    trim($this->input->post('idSiswa'));
          $isEdit             =    (strlen($idSiswa) >= 1)? true : false;

          $siswaPemilikTabungan    =    trim($this->input->post('siswaPemilikTabungan'));
          $namaTabungan            =    trim($this->input->post('namaTabungan'));

          $addTabungan   =    false;

          if(strlen($siswaPemilikTabungan) >= 1 && strlen($namaTabungan) >= 1){
               $this->load->model('TabunganModel', 'tm');

               $isSiswaTerdaftar    =    $this->tm->isThisDataExist('view_siswa', 'idSiswa', $siswaPemilikTabungan);

               if($isSiswaTerdaftar){
                    $isSiswaExist            =    $this->tm->isThisDataExist('view_tabungan', 'idSiswa', $siswaPemilikTabungan);
                    if(!$isSiswaExist ){
                              $dataTabungan  =    [
                                   'namaTabungan'      =>   $namaTabungan,
                                   'idSiswa'           =>   $siswaPemilikTabungan
                              ];

                              if($isEdit){
                                   // $options       =    ['where' => ['idSiswa' => $idSiswa]];
                                   // $actionSiswa   =    $this->tm->editData('ts_siswa', $dataTabungan, $options);
                              }else{
                                   $actionSiswa   =    $this->tm->addData('ts_tabungan', $dataTabungan);
                                   
                                   if($actionSiswa){
                                        $idTabungan    =    $this->db->insert_id();

                                        $nomorTabungan      =    date('ymd').'-'.$idTabungan.'-'.$siswaPemilikTabungan;

                                        $dataTabunganBaru   =    ['nomorTabungan' => $nomorTabungan];
                                        $opsi     =    ['where' => ['idTabungan' => $idTabungan]];
                                        $actionSiswa   =    $this->tm->editData('ts_tabungan', $dataTabunganBaru, $opsi);
                                   }
                              }
               
                              if($actionSiswa){
                                   $addTabungan   =    true;
                                   $message       =    '';
                              }
                    }else{
                         $message  =    'Siswa tersebut sudah memiliki tabungan';
                    }
               }else{
                    $message  =    'Siswa Tidak Terdaftar di Sistem';
               }
          }

          echo json_encode(['addTabungan' => $addTabungan, 'message' => $message]);
     }
     public function edit($idTabungan){
          $this->load->model('SiswaModel', 'sm');
          $this->load->model('TabunganModel', 'tm');

          $options            =    ['where' => ['idTabungan' => $idTabungan]];
          $detailTabungan     =    $this->tm->getData('ts_tabungan', $options, true);
          
          $dataWebsite 	=	[
               'title'             =>   'Edit Data Tabungan | Aplikasi Tabungan Sekolah',
               'isEdit'            =>   true,
               'detailTabungan'    =>   $detailTabungan,
               'listSiswa'         =>   $this->sm->listSiswa()
          ];

		$this->load->view('tabungan/edit', $dataWebsite);
     }
     public function editTabungan(){
          $this->load->model('TabunganModel', 'tm');

          $idTabungan              =    trim($this->input->post('idTabungan'));
          $nomorTabungan           =    trim($this->input->post('nomorTabungan'));
          $namaTabungan            =    trim($this->input->post('namaTabungan'));
          $siswaPemilikTabungan    =    trim($this->input->post('siswaPemilikTabungan'));

          $options  =    [
               'where'   =>   ['idTabungan' => $idTabungan]
          ];
          $detailTabungan    =    $this->tm->getData('ts_tabungan', $options, true);

          $statusEdit    =    false;
          $message       =    '';

          if($detailTabungan['idSiswa'] !== $siswaPemilikTabungan){
               $apakahSiswaIniSudahPunyaTabungan  =    $this->tm->isThisDataExist('ts_tabungan', 'idSiswa', $siswaPemilikTabungan);

               if($apakahSiswaIniSudahPunyaTabungan){
                    $message  =    'Siswa Ini Sudah Punya Tabungan !';
                    echo json_encode(['editTabungan' => $statusEdit, 'message' => $message]);

                    exit();
               }
          }

          if($detailTabungan['nomorTabungan'] !== $nomorTabungan){
               $nomorTabunganSudahAda  =    $this->tm->isThisDataExist('ts_tabungan', 'nomorTabungan', $nomorTabungan);

               if($nomorTabunganSudahAda){
                    $message  =    'Nomor Tabungan Sudah Terpakai !';
                    echo json_encode(['editTabungan' => $statusEdit, 'message' => $message]);

                    exit();
               }
          }
          
          $dataTabunganBaru   =    [
               'nomorTabungan'     =>   $nomorTabungan,
               'namaTabungan'      =>   $namaTabungan,
               'idSiswa'           =>   $siswaPemilikTabungan
          ];

          $editTabungan  =    $this->tm->editData('ts_tabungan', $dataTabunganBaru, ['where' => ['idTabungan' => $idTabungan]]);
          if($editTabungan){
               $statusEdit    =    true;
          }
          
          $message  =    'Gagal Memperbaharui Data Tabungan !';
          echo json_encode(['editTabungan' => $statusEdit, 'message' => $message]);
     }
	public function jenis_biaya(){
          $userLevel 	=	$this->session->userdata('level');
		if($userLevel !== 'superadmin'){
               redirect('mistake/not_accessible');
               exit();
          }

          $this->load->model('TabunganModel', 'tm');
          // $options            =    ['orderBy' => ['column' => 'idJenisBiaya', 'value' => 'desc']];
          $dataJenisBiaya     =    $this->tm->getData('ts_jenis_biaya');

		$dataWebsite 	=	[
               'title'             =>   'Jenis Biaya | Aplikasi Tabungan Sekolah',
               'dataJenisBiaya'    =>   $dataJenisBiaya
          ];

		$this->load->view('tabungan/jenis_biaya', $dataWebsite);
     }
     public function add_jenis_biaya(){
          $userLevel 	=	$this->session->userdata('level');
		if($userLevel !== 'superadmin'){
               redirect('mistake/not_accessible');
               exit();
          }

          $dataWebsite 	=	[
               'title'   =>   'Tambah Jenis Biaya Baru | Aplikasi Tabungan Sekolah',
               'isEdit'  =>   false
          ];

		$this->load->view('tabungan/add_jenis_biaya', $dataWebsite);
     }
     public function edit_jenis_biaya($idJenisBiaya){
          $userLevel 	=	$this->session->userdata('level');
		if($userLevel !== 'superadmin'){
               redirect('mistake/not_accessible');
               exit();
          }

          $this->load->model('TabunganModel', 'tm');

          $options  =    ['where' => ['idJenisBiaya' => $idJenisBiaya]]; 
          $detailJenisBiaya   =    $this->tm->getData('ts_jenis_biaya', $options, true);        

          $dataWebsite 	=	[
               'title'   =>   'Tambah Jenis Biaya Baru | Aplikasi Tabungan Sekolah',
               'isEdit'  =>   true,
               'detailJenisBiaya'  =>   $detailJenisBiaya
          ];

		$this->load->view('tabungan/add_jenis_biaya', $dataWebsite);
     }
     public function addJenisBiaya(){
          $userLevel 	=	$this->session->userdata('level');
		if($userLevel !== 'superadmin'){
               redirect('mistake/not_accessible');
               exit();
          }

          $idJenisBiaya            =    trim($this->input->post('idJenisBiaya'));
          $isEdit                  =    (strlen($idJenisBiaya) >= 1)? true : false;

          $namaJenisBiaya          =    trim($this->input->post('namaJenisBiaya'));
          $keteranganJenisBiaya    =    trim($this->input->post('keteranganJenisBiaya'));
          
          $statusAdd     =    false;
          $message       =    '';

          if(strlen($namaJenisBiaya) >= 1){
               $this->load->model('TabunganModel', 'tm');

               $dataJenisBiaya     =    [
                    'nama'         =>   $namaJenisBiaya,
                    'keterangan'   =>   $keteranganJenisBiaya
               ];

               if($isEdit){
                    $options            =    ['where' => ['idJenisBiaya' => $idJenisBiaya]];
                    $addJenisBiaya      =    $this->tm->editData('ts_jenis_biaya', $dataJenisBiaya, $options);
               }else{
                    $addJenisBiaya      =    $this->tm->addData('ts_jenis_biaya', $dataJenisBiaya);
               }

               if($addJenisBiaya){
                    $statusAdd     =    true;
               }
          }else{
               $message  =    'Nama Jenis Biaya Wajib di IsI !';
          }

          echo json_encode(['addJenisBiaya' => $statusAdd, 'message' => $message]);
     }
     public function deleteJenisBiaya(){
          $userLevel 	=	$this->session->userdata('level');
		if($userLevel !== 'superadmin'){
               redirect('mistake/not_accessible');
               exit();
          }

          $this->load->model('TabunganModel', 'tm');

          $idJenisBiaya            =    trim($this->input->post('idJenisBiaya'));
          $deleteJenisBiaya     =    $this->tm->deleteData('ts_jenis_biaya', ['idJenisBiaya' => $idJenisBiaya]);

          $statusDelete  =    ($deleteJenisBiaya)? true : false;
          echo json_encode(['deleteJenisBiaya' => $statusDelete]);
     }
}
