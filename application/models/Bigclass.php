<?php
class Bigclass extends CI_Model{
    public function __construct(){
        $this->load->database();
    }
    public function get_allbigclass(){
        $query=$this->db->get('bigclass');
        return $query->result_array();
    }
    public function get_what($bigclassid,$backziduan){
        $query=$this->db->get_where('bigclass',array('id'=>$bigclassid));
        return $query->row_array()[$backziduan];
    }
    public function get_bigclass($bigclassid){
        $query=$this->db->get('bigclass',array('id'=>$bigclassid));
        return $query->row_array();
    }
    public function get_bigclass_id($bigclassname){
        
        $query=$this->db->get_where('bigclass',array('typename'=>$bigclassname));
        
        return $query->row_array()['id'];
    }
    public function set_bigclass($data){
        $this->db->insert('bigclass',$data);
        return $this->db->insert_id();
    }
}