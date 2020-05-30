<?php
     class KelasModel extends CI_Model{
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
          public function getData($tabel, $options = false){
               if($options){

               }

               $this->db->order_by('idKelas', 'desc');
               $getData  =    $this->db->get($tabel)->result_array();

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
               if($options !== false){
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
          public function listKelas($options = false){
               if($options !== false){
                    if(array_key_exists('order_by', $options)){
                         $column        =    $options['order_by']['column'];
                         $orientation   =    $options['order_by']['orientation'];
                    }else{
                         $column        =    'idKelas';
                         $orientation   =    'desc';
                    }

                    $this->db->order_by($column, $orientation);
               }else{
                    $this->db->order_by('idKelas', 'desc');
               }
               $listKelas     =    $this->db->get('ts_kelas');

               return $listKelas;
          }
     }
?>