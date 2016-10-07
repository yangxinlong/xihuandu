<?php
class Article extends CI_Model{
    public function __construct(){
        $this->load->database();
    }
    public function get_news(){
       
        $sql="select  * from Article order by id desc limit 0,10";
        $query=$this->db->query($sql,true);
        return $query->result_array();
    }
    public function get_lastarticle($bookid){
        $this->db->order_by('id','desc');
        $query=$this->db->get_where('Article',array('id'=>$bookid),0,1);
        return $query->row_array();
    }
    public function get_article($articleid){
        $this->db->order_by('id');
        $query=$this->db->get('Article',array('id'=>$articleid));
        return $query->row_array();
    }
    public function get_next($bookid,$articleid){
        $sql = "SELECT * FROM Article WHERE id > ? and bigclassid = ?";
        $query=$this->db->query($sql, array($articleid, $bookid));
        return $query->row_array();
    }
    
}
 ?>