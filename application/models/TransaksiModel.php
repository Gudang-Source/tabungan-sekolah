<?php
     class TransaksiModel extends CI_Model{
          public function __construct(){
               parent::__construct();
               $this->load->database();
          }
          public function addData($tabel, $data){
               $addData  =    $this->db->insert($tabel, $data);

               if($addData){
                    return true;
               }else{
                    return false;
               }
          }
          public function getData($tabel, $options = false, $singleRow = false){
               if($options !== false && is_array($options)){
                    if(array_key_exists('select', $options)){
                         $this->db->select($options['select']);
                    }
                    if(array_key_exists('where', $options)){
                         $this->db->where($options['where']);
                    }
                    if(array_key_exists('orderBy', $options)){
                         $this->db->order_by($options['orderBy']['column'], $options['orderBy']['value']);
                    }
               }

               $getData  =    $this->db->get($tabel);

               if($singleRow){
                    $getData  =    $getData->row_array();
               }else{
                    $getData  =    $getData->result_array();
               }

               return $getData;
          }
          public function deleteData($tabel, $options = false){
               if($options !== false){
                    $this->db->where($options);
               }

               $deleteData  =    $this->db->delete($tabel);

               if($deleteData){
                    return true;
               }else{
                    return false;
               }
          }
          public function editData($tabel, $dataBaru, $options = false){
               if($options !== false && is_array($options)){
                    if(array_key_exists('where', $options)){
                         $this->db->where($options['where']);
                    }
               }

               $editData      =    $this->db->update($tabel, $dataBaru);
               if($editData){
                    return true;
               }else{
                    return false;
               }
          }
          public function listSiswa($options = false){
               if($options !== false && is_array($options)){
                    if(array_key_exists('order_by', $options)){
                         $column        =    $options['order_by']['column'];
                         $orientation   =    $options['order_by']['orientation'];
                    }else{
                         $column        =    'idSiswa';
                         $orientation   =    'desc';
                    }

                    $this->db->order_by($column, $orientation);
               }else{
                    $this->db->order_by('idSiswa', 'desc');
               }
               $listSiswa     =    $this->db->get('view_siswa');

               return $listSiswa;
          }
          public function isThisDataExist($tabel, $column, $data){
               $this->db->where($column, $data);
               $isThisDataExist    =    $this->db->get($tabel);

               if($isThisDataExist->num_rows() >= 1){
                    return true;
               }else{
                    return false;
               }
          }
     }
?>