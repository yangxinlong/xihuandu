<?php
class Friendlinks extends CI_Model{
    public function __construct(){
        $this->load->database();
    }
    public function get_friendlink($position=1){
        
        $this->db->select('title,url');
        $this->db->order_by('sortid');
        $query=$this->db->get_where('friendlinks',array('position'=>$position),0,100);
        return $query->result_array();
    }
 
    
}