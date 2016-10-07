<?php
class Fav extends CI_Model{
    public function __construct(){
        $this->load->database();
    }
    public function get_fav($tops=20){
        $this->db->group_by('bookid');
        $this->db->select('bookid,count(userid) as a');
        $this->db->order_by('a','desc');
        $query=$this->db->get('fav',0,$tops);
        return $query->result_array();
    }
 
    
}