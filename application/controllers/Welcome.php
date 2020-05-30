<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
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
			'title' => 'Home | Aplikasi Tabungan Sekolah'
		];
		$this->load->view('index', $dataWebsite);
	}
}
