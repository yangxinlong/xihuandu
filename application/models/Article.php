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
        $query=$this->db->get_where('Article',array('bookid'=>$bookid),0,2);
       // echo $this->db->last_query();
        return $query->row_array();
    }
    public function get_article($articleid){
        $this->db->order_by('id');
        $query=$this->db->get_where('Article',array('id'=>$articleid));
         
        return $query->row_array();
    }
    public function get_next($bookid,$articleid){
        $sql = "SELECT * FROM Article WHERE id > ? and bigclassid = ?";
        $query=$this->db->query($sql, array($articleid, $bookid));
        return $query->row_array();
    }
    public function get_isexist($articleurl){
        $query=$this->db->get_where('Article',array('url'=>$articleurl));
        if($query->row_array()==NULL){
            return false;
        }else{
            return true;
        };
       
    }
    public function set_article($data){
        $query=$this->db->insert('Article',$data);
        return $this->db->insert_id();
    }
    public function get_menu($bookid){
        $query=$this->db->get_where('Article',array('bookid'=>$bookid));
        return $query->result_array();
    }
}
 ?>