<?php
class Books extends CI_Model{
    public function __construct(){
        $this->load->database();
    }
    public function get_suggest(){
        $sql="select  * from books where issuggest=? limit 0,4";
        $query=$this->db->query($sql,true);
        return $query->result_array();
    }
    public function get_top(){
        $sql="select  * from books where istop=? limit 0,8";
        $query=$this->db->query($sql,true);
        return $query->result_array();
    }
    public function get_tj($bigclassid){
        $sql="select  * from books where istj=? and bigclassid=? limit 0,1";
        $query=$this->db->query($sql,array(true,$bigclassid));
        return $query->result_array();
    }
    public function get_news(){
        $sql="select  * from books order by id desc limit 0,24";
        $query=$this->db->query($sql,true);
        return $query->result_array();
    }
    public function get_last($count = 1){
       
            $query=$this->db->get('books',0,$count);
            return $query->result_array();
    
      
    }
    public function get_dianji($count = 1){
         $this->db->order_by('lookcount','desc');
        $query=$this->db->get('books',0,$count);
        return $query->result_array();
    }
   public function get_name($bookid){
       $query=$this->db->get_where('books',array('id'=>$bookid));
       return $query->row_array()['bookname'];
   }
   public function get_total($bigclassid=1){
       $this->db->where('bigclassid='.$bigclassid);
       $result=$this->db->count_all_results('books');
       return $result;
   }
   public function get_books($bigclassid=1,$pgsize=25,$page=1){
       $this->db->where('bigclassid='.$bigclassid);
       $query=$this->db->get('books',($page-1)*$pgsize,$page*$pgsize);
       return $query->result_array();
   }
   public function get_book($bookid){
       $query=$this->db->get('books');
       return $query->row_array();
       
   }
   public function get_menu_url($bookname){
       $query=$this->db->get_where('books',array('bookname'=>$bookname));
       
        return $query->row_array()['menu_url'];
       
   }
   public function set_book($data){
      $this->db->insert('books',$data);
      return $this->db->insert_id();
   }
   public function get_bookid($menu_url){
       $query=$this->db->get_where('books',array('menu_url'=>$menu_url));
       return $query->row_array()['id'];
   }
}   
?>