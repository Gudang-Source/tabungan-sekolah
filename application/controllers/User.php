<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
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
          $userLevel 	=	$this->session->userdata('level');
		if($userLevel !== 'superadmin'){
               redirect('mistake/not_accessible');
               exit();
          }
          
          $this->load->model('UserModel', 'um');
          $options       =    ['orderBy' => ['column' => 'idUser', 'value' => 'desc']];
          $dataUser      =    $this->um->getData('ts_user', $options);

		$dataWebsite 	=	[
               'title'        =>   'User | Aplikasi Tabungan Sekolah',
               'dataUser'     =>   $dataUser
          ];

		$this->load->view('user/index', $dataWebsite);
     }
     public function add(){
          $userLevel 	=	$this->session->userdata('level');
		if($userLevel !== 'superadmin'){
               redirect('mistake/not_accessible');
               exit();
          }
          
		$dataWebsite 	=	[
               'title'        =>   'Tambah User Baru | Aplikasi Tabungan Sekolah',
               'isEdit'       =>   false
          ];

		$this->load->view('user/add', $dataWebsite);
     }
     public function edit($idUser){
          $this->load->model('UserModel', 'um');

          $options       =    ['where' => ['idUser' => $idUser]];
          $detailUser    =    $this->um->getData('ts_user', $options, true);
          
          $dataWebsite 	=	[
               'title'        =>   'Edit Data User | Aplikasi Tabungan Sekolah',
               'isEdit'       =>   true,
               'detailUser'   =>   $detailUser
          ];

		$this->load->view('user/add', $dataWebsite);
     }
     public function listuser(){
          $this->index();
     }
     
     public function addUser(){
          $namaUser          =    trim($this->input->post('namaUser'));
          $alamatUser        =    trim($this->input->post('alamatUser'));
          $nomorTeleponUser  =    trim($this->input->post('nomorTeleponUser'));
          $emailUser         =    trim($this->input->post('emailUser'));
          
          $levelUser          =    strtolower(trim($this->input->post('levelUser')));
          $username           =    trim($this->input->post('username'));
          $password           =    trim($this->input->post('password'));
          $konfirmasiPassword    =    trim($this->input->post('konfirmasiPassword'));

          $statusAdd          =    false;

          $this->load->model('UserModel', 'um');

          $isUsernameExist    =    $this->um->isThisDataExist('ts_user', 'username', $username);
          if($isUsernameExist === false){
               $isNomorHPExist    =    $this->um->isThisDataExist('ts_user', 'noHP', $nomorTeleponUser);
               if($isNomorHPExist === false){
                    $isEmailExist    =    $this->um->isThisDataExist('ts_user', 'email', $emailUser);
                    if($isEmailExist === false){
     
                         if(strlen($namaUser) >= 1 && strlen($alamatUser) >= 1 && 
                              strlen($nomorTeleponUser) >= 0 && strlen($emailUser) >= 0 && 
                              strlen($levelUser) >= 1 && strlen($username) >= 1 
                              && strlen($password) >= 1 && strlen($konfirmasiPassword) >= 1){

                              if($password === $konfirmasiPassword){
                                   $dataUser   =    [
                                        'nama'         =>   $namaUser,
                                        'noHP'         =>   $nomorTeleponUser,
                                        'alamat'       =>   $alamatUser,
                                        'email'        =>   $emailUser,
                                        'username'     =>   $username,
                                        'password'     =>   md5($password),
                                        'level'        =>   $levelUser
                                   ];

                                   $addUser    =    $this->um->addData('ts_user', $dataUser);

                                   if($addUser){
                                        $statusAdd          =    true;
                                        $messageToClient    =    'Berhasil menyimpan data !';
                                   }else{                        
                                        $messageToClient  = 'gagal menyimpan data !';
                                   }
                              }else{  
                                   $messageToClient  = 'password dan konfirmasi password tidak sama !';
                              }
                         }else{
                              $messageToClient  = 'salah satu form tidak terisi, harap lengkapi data !';
                         }
                    }else{
                         $messageToClient    =    'Email Sudah Digunakan';
                    }
               }else{
                    $messageToClient    =    'Nomor HP Sudah Digunakan';
               }
          }else{
               $messageToClient    =    'Username Digunakan';
          }

          echo json_encode(['addUser' => $statusAdd, 'messageToClient' => $messageToClient]);
     }
     public function deleteUser(){
          $idUser       =    $this->input->post('idUser');

          $this->load->model('UserModel', 'um');
          $deleteUser    =    $this->um->deleteData('ts_user', ['idUser' => $idUser]);
          $response      =    ['deleteUser' => $deleteUser];
          
          echo json_encode($response);
     }
     public function editUser(){
          $idUser             =    trim($this->input->post('idUser'));
          $namaUser          =    trim($this->input->post('namaUser'));
          $alamatUser        =    trim($this->input->post('alamatUser'));
          $nomorTeleponUser  =    trim($this->input->post('nomorTeleponUser'));
          $emailUser         =    trim($this->input->post('emailUser'));
          
          $levelUser          =    strtolower(trim($this->input->post('levelUser')));
          $username           =    trim($this->input->post('username'));

          $statusEdit          =    false;

          if(strlen($namaUser) >= 1 && strlen($alamatUser) >= 1 && 
               strlen($nomorTeleponUser) >= 0 && strlen($emailUser) >= 0 && 
               strlen($levelUser) >= 1 && strlen($username) >= 1){

                    $dataBaruUser   =    [
                         'nama'         =>   $namaUser,
                         'noHP'         =>   $nomorTeleponUser,
                         'alamat'       =>   $alamatUser,
                         'email'        =>   $emailUser,
                         'username'     =>   $username,
                         'level'        =>   $levelUser
                    ];

                    $this->load->model('UserModel', 'um');
                    $options  =    ['where' => ['idUser' => $idUser]];    
                    $addUser  =    $this->um->editData('ts_user', $dataBaruUser, $options);

                    if($addUser){
                         $statusEdit          =    true;
                         $messageToClient    =    'Berhasil memperbaharui data !';
                    }else{                        
                         $messageToClient  = 'gagal memperbaharui data !';
                    }
          }else{
               $messageToClient  = 'salah satu form tidak terisi, harap lengkapi data !';
          }

          echo json_encode(['addUser' => $statusEdit, 'messageToClient' => $messageToClient]);
     }
     public function changeStatusUser(){
          $this->load->model('UserModel', 'um');

          $idUser   =    $this->input->post('idUser');
          $options  =    ['where' => ['idUser' => $idUser]];
          $detailUser    =    $this->um->getData('ts_user', $options, true);

          if($detailUser['status'] === 'aktif'){
               $data     =    ['status' => 'nonaktif'];
          }else{
               $data     =    ['status' => 'aktif'];
          }

          $changeStatusUser   =    $this->um->editData('ts_user', $data, $options);
          
          echo json_encode(['changeStatusUser' => $changeStatusUser]);
     }
}
