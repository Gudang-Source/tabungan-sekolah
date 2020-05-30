<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExportData extends CI_Controller {
     public function __construct(){
          parent::__construct();
          $this->load->model('ExportDataModel', 'export');
     }
     public function tes(){
          $this->export->exportToExcel_PHPExcel();
     }
}
