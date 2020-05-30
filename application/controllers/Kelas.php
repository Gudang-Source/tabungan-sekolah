<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {
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
		$dataWebsite 	=	[
               'title'        =>   'Kelas | Aplikasi Tabungan Sekolah'
          ];

		$this->load->view('kelas/list-kelas', $dataWebsite);
     }
     public function addKelas(){
          $idKelas       =    trim($this->input->post('idKelas'));

          if(strlen($idKelas) >= 1){
               $isEdit   =    true;
          }else{
               $isEdit   =    false;
          }

          $namaKelas     =    $this->input->post('namakelas');
          $namaKelas     =    trim($namaKelas);

          $response      =    ['addKelas' => false];

          if($namaKelas !== null && strlen($namaKelas) >= 1){
               $this->load->model('KelasModel', 'km');

               $data          =    ['namaKelas' => $namaKelas];

               if($isEdit){
                    $options       =    ['where' => ['idKelas' => $idKelas]];
                    $actionKelas   =    $this->km->editData('ts_kelas', $data, $options);
               }else{
                    $actionKelas   =    $this->km->addData('ts_kelas', $data);
               }

               if($actionKelas){
                    $response =    ['addKelas' => true];
               }
          }

          echo json_encode($response);
     }
     public function JSONListKelas(){
          $doJob    =    $this->input->post('doJob') === null? false : true;
          if($doJob){
               $this->load->model('KelasModel', 'km');

               $JSONListKelas =    $this->km->getData('ts_kelas');
               $response      =    ['listKelas' => $JSONListKelas];
               
               echo json_encode($response);
          }
     }
     public function deleteKelas(){
          $this->load->model('KelasModel', 'km');

          $idKelas       =    $this->input->post('idKelas');

          $deleteKelas   =    $this->km->deleteData('ts_kelas', ['idKelas' => $idKelas]);
          $response      =    ['deleteKelas' => $deleteKelas];
          
          echo json_encode($response);
     }
}
