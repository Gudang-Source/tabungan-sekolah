<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {
     public function __construct(){
          parent::__construct();

          $this->load->model('SiswaModel', 'sm');
          $this->load->library('session');
		$this->load->model('AuthModel', 'am');

		$isLogin 	=	$this->am->isLogin();
		if($isLogin === false){
               redirect('auth?showNotice');
               exit();
		}
     }
	public function index(){
          
          $options       =    ['orderBy' => ['column' => 'idSiswa', 'value' => 'desc']];

          $filterKelas        =    trim($this->input->get('kelas'));
          $filterTahunAjaran  =    trim($this->input->get('tahunAjaran'));

          if($filterKelas !== null && strlen($filterKelas) >= 1){
               $options['where']['kelas']         =    $filterKelas;
          }
          if($filterKelas !== null && strlen($filterTahunAjaran) >= 1){
               $options['where']['tahunAjaran']   =    $filterTahunAjaran;
          }

          $dataSiswa     =    $this->sm->getData('view_siswa', $options);

		$dataWebsite 	=	[
               'title'        =>   'Siswa | Aplikasi Tabungan Sekolah',
               'dataSiswa'    =>   $dataSiswa
          ];

          $this->load->view('siswa/index', $dataWebsite);
     }
     public function add(){
          $this->load->model('KelasModel');
          $listKelas     =    $this->KelasModel->listKelas()->result_array();

		$dataWebsite 	=	[
               'isEdit'       =>   false,
               'title'        =>   'Tambah Siswa Baru | Aplikasi Tabungan Sekolah',
               'listKelas'    =>   $listKelas
          ];

		$this->load->view('siswa/add', $dataWebsite);
     }
     public function listsiswa(){
          $this->index();
     }
     public function addSiswa(){
          $idSiswa            =    trim($this->input->post('idSiswa'));
          $isEdit             =    (strlen($idSiswa) >= 1)? true : false;

          $namaSiswa          =    trim($this->input->post('namasiswa'));
          $alamatSiswa        =    trim($this->input->post('alamatsiswa'));
          $nomorTeleponSiswa  =    trim($this->input->post('nomorteleponsiswa'));
          $emailSiswa         =    trim($this->input->post('emailsiswa'));
          
          $NISSiswa           =    trim($this->input->post('nissiswa'));
          $jenisKelamin       =    strtoupper(trim($this->input->post('jeniskelamin')));
          $kelas              =    trim($this->input->post('kelas'));
          // $tahunAjaran        =    trim($this->input->post('tahunajaran'));
          
          $namaIbuKandung     =    trim($this->input->post('namaibukandung'));
          $namaAyahKandung    =    trim($this->input->post('namaayahkandung'));
          $nomorHPOrangTua    =    trim($this->input->post('nomorhporangtua'));

          $statusAdd     =    false;
          $message       =    '';

          $isNISExist    =    $this->sm->isThisDataExist('ts_siswa', 'nis', $NISSiswa);
          if($isNISExist === false){
               $isEmailExist    =    (strlen($emailSiswa) >= 1)? $this->sm->isThisDataExist('ts_siswa', 'email', $emailSiswa) : false;
               if($isEmailExist === false){
                    $isNoHPExist    =    (strlen($nomorTeleponSiswa) >= 1)? $this->sm->isThisDataExist('ts_siswa', 'noHP', $nomorTeleponSiswa) : false;
                    if($isNoHPExist === false){
                         if(strlen($namaSiswa) >= 1 && strlen($alamatSiswa) >= 1 && 
                         strlen($nomorTeleponSiswa) >= 0 && strlen($emailSiswa) >= 0 && 
                         strlen($namaIbuKandung) >= 1 && strlen($namaAyahKandung) >= 1 && 
                         strlen($nomorHPOrangTua) >= 1 && strlen($NISSiswa) >= 1 &&
                         strlen($jenisKelamin) >= 1){

                              $dataSiswa   =    [
                                   'nis'               =>   $NISSiswa,
                                   'nama'              =>   $namaSiswa,
                                   'noHP'              =>   $nomorTeleponSiswa,
                                   'alamat'            =>   $alamatSiswa,
                                   'email'             =>   $emailSiswa,
                                   'jenisKelamin'      =>   $jenisKelamin,
                                   'namaIbuKandung'    =>   $namaIbuKandung,
                                   'namaAyahKandung'   =>   $namaAyahKandung,
                                   'noHPOrangTua'      =>   $nomorHPOrangTua,
                                   'kelas'             =>   $kelas
                              ];

                              if($isEdit === false){ $dataSiswa['status'] = 'status belum ditentukan fungsinya'; }

                              if($isEdit){
                                   $options       =    ['where' => ['idSiswa' => $idSiswa]];
                                   $actionSiswa   =    $this->sm->editData('ts_siswa', $dataSiswa, $options);
                              }else{
                                   $actionSiswa   =    $this->sm->addData('ts_siswa', $dataSiswa);
                              }

                              if($actionSiswa){
                                   $statusAdd     =    true;
                              }
                         }else{
                              $message  =    'Data Belum Lengkap';
                         }
                    }else{
                         $message  =    'Nomor Telepon Siswa Sudah Ada';
                    }
               }else{
                    $message  =    'Email Siswa Sudah Ada';
               }
          }else{
               $message  =    'NIS Siswa Sudah Ada';
          }

          echo json_encode(['addSiswa' => $statusAdd, 'message' => $message]);
     }
     public function deleteSiswa(){
          $idSiswa       =    $this->input->post('idSiswa');

          $deleteSiswa   =    $this->sm->deleteData('ts_siswa', ['idSiswa' => $idSiswa]);
          $response      =    ['deleteSiswa' => $deleteSiswa];
          
          echo json_encode($response);
     }
     public function edit($idSiswa){
          $options       =    ['where' => ['idSiswa' => $idSiswa]];
          $detailSiswa    =    $this->sm->getData('ts_siswa', $options, true);
          
          $this->load->model('KelasModel');
          $listKelas     =    $this->KelasModel->listKelas()->result_array();
          
          $dataWebsite 	=	[
               'title'        =>   'Edit Data Siswa | Aplikasi Tabungan Sekolah',
               'isEdit'       =>   true,
               'detailSiswa'  =>   $detailSiswa,
               'listKelas'    =>   $listKelas   
          ];

		$this->load->view('siswa/add', $dataWebsite);
     }
     public function perubahan_kelas(){
		$dataWebsite 	=	[
               'title'        =>   'Perubahan Kelas | Aplikasi Tabungan Sekolah'
          ];

		$this->load->view('siswa/perubahan_kelas', $dataWebsite);
     }
     public function ubahKelas(){
          $ubahKelas     =    false;

          if(isset($_POST['checkedSiswa'])){
               $selectedSiswa    =    $_POST['checkedSiswa'];

               if(is_array($selectedSiswa)){
                    if(count($selectedSiswa) >= 1){
                         $listSiswa     =    [];

                         foreach($selectedSiswa as $idSiswa){
                              array_push($listSiswa, $idSiswa);
                         }

                         $listSiswa          =    implode(', ', $listSiswa);
                         $selectedKelas      =    trim($this->input->post('selectedKelas'));

                         $ubahKelas     =    $this->db->query('update ts_siswa set kelas='.$selectedKelas.' where idSiswa in ('.$listSiswa.')');
                         if($ubahKelas){
                              $ubahKelas     =    true;
                         }
                    }
               }
          }

          echo json_encode(['ubahKelas' => $ubahKelas]);
     }
     public function exportData($exportTo, $idKelas = false, $tahunAjaran = false){
          $exportTo =    strtolower($exportTo);

          if($exportTo === 'excel'){
               $this->load->model('ExportDataModel', 'export');
               $this->load->model('SiswaModel', 'sm');

               $kolomExcel    =    ['No.', 'Nama', 'Alamat', 'Nomor HP', 'NIS', 'Kelas', 'Email', 'Nomor HP Orang Tua'];
               $barisExcel    =    [];

               $options       =    [];

               if($idKelas !== false && $idKelas !== 'null'){
                    $options['where']['kelas']         =    $idKelas;

                    $detailKelas   =    $this->sm->getData('ts_kelas', ['where' => ['idKelas' => $idKelas]], true);
               }
               if($tahunAjaran !== false && $tahunAjaran !== 'null'){
                    $options['where']['tahunAjaran']   =    $tahunAjaran;
               }

               $listSiswa     =    $this->sm->getData('view_siswa', $options);

               if(is_array($listSiswa)){
                    foreach($listSiswa as $indexSiswa => $siswa){
                         $data     =    [
                              $indexSiswa+1,
                              $siswa['nama'],
                              $siswa['alamat'],
                              $siswa['noHP'],
                              $siswa['nis'],
                              $siswa['namaKelas'],
                              $siswa['email'],
                              $siswa['noHPOrangTua']
                         ];
                         array_push($barisExcel, $data);
                    }
               }

               $fileName      =    'Data Siswa exported '.date('d M Y').'.xls';
               $header        =    [];

               if($idKelas !== false && $idKelas !== 'null'){
                    array_push($header, ['Kelas', ':', $detailKelas['namaKelas']]);
               }
               if($tahunAjaran !== false && $tahunAjaran !== 'null'){
                    array_push($header, ['Tahun Ajaran', ':', $tahunAjaran]);
               }

               $this->export->exportToExcel(false, $header, $kolomExcel, $barisExcel, $fileName);
          }else if($exportTo === 'pdf' && $idKelas !== false){
               $options  =    [
                    'idKelas'      =>   $idKelas,
                    'tahunAjaran'  =>   $tahunAjaran
               ];
               $this->load->view('siswa/pdf', $options);
          }else{
               redirect('mistake');
          }
     }
     // public function perbaikanKelasSiswa(){
     //      $this->db->select('kelas');
     //      $this->db->group_by('kelas');
     //      $listKelasSiswa     =    $this->db->get('ts_siswa');

     //      $berhasil =    0;
     //      $do       =    0;

     //      $gagal    =    [];
     //      foreach ($listKelasSiswa->result_array() as $index => $kelasSiswa) {
     //           $this->db->select('idKelas');
     //           $this->db->where('namaKelas', $kelasSiswa['kelas']);
     //           $idKelas  =    $this->db->get('ts_kelas')->row();

     //           $this->db->where('kelas', $kelasSiswa['kelas']);
     //           $updateKelas   =    $this->db->update('ts_siswa', ['kelas' => $idKelas->idKelas]);

     //           if($updateKelas){
     //                $berhasil++;
     //           }
     //           $do++;
     //      }

     //      if($do === $berhasil){
     //           echo      'OK';
     //      }else{
     //           echo      'Gagal';
     //      }
     // }
}
