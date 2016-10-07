<?php
class Discuss extends CI_Model{
    public function __construct(){
        $this->load->database();
    }
    public function get_dis($tops=20){
       // $this->db->group_by('bookid');
        $this->db->select('bookid,count(userid) as a');
        $this->db->order_by('a','desc');
        $query=$this->db->get('discuss',0,$tops);
        return $query->result_array();
    }
    public function get_book_dis($bookid,$page=1){
        $pgsie=20;
        $this->db->order_by('id',desc);
        $query=$this->db->get_where('discuss',array('bookid'=>$bookid),($page-1)*$pgsize,$page*$pgsize);
        return $query->result_array();
        
    }
    public function add_recorecount($data){
        $query=$this->db->insert('discuss',$data);
        return $query;
    }
    
}