<?php
class Notice extends CI_Model{
    public function __construct(){
        $this->load->database();
    }
    public function get_news($topi = NULL,$page = 1){
        $pgsize=20;
        if($topi == NUll){
            $sql="select  * from notice order by id desc limit ?,?";
            $query=$this->db->query($sql,($page-1)*$pgsize,$page*$pgsize);
            return $query->result_array();
            
        }else{
            $sql="select  * from notice order by id desc limit 0,?";
            $query=$this->db->query($sql,$topi);
            return $query->result_array();
        }
       
    }
    public function get_pagelist(){
        $this->load->library('pagination');
        
        $config['base_url'] = '/index.php/notice/get_pagelist/';
        $config['total_rows'] =  $this->db->count_all('notice');
        $config['per_page'] = 20;
        
        $this->pagination->initialize($config);
        
        return  $this->pagination->create_links();
       
    }
}
?>