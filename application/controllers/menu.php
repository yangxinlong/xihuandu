<?php
defined('BASEPATH') OR exit('No direct script access allowed');
set_time_limit(0);
class Menu extends CI_Controller {


    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
       
        $this->load->model('Bigclass');

        $this->load->model('Books');
        $this->load->model('Article');
     
    }
    public function index($bookid){
        if($bookid==''){ $this->load->view('404.php');}else{
            $book=$this->Books->get_book($bookid);
            
            $data['title']="喜欢读-".$book['bookname'];
            $data['bigclasslist'] = $this->Bigclass->get_allbigclass();
            $myp =  ' <a href="'.base_url().'">小说频道</a>&nbsp;' ;
            $data['myposition']=$myp;
            $this->load->view('top.php',$data);
            
            $data='';
            $data['bookid']=$bookid;
            $data['bookname']=$book['bookname'];
            $data['author']=$book['author'];
            $data['createtime']=$book['createtime'];
            $data['source']=$book['source'];
            $data['lookcount']=$book['lookcount'];
            $data['articlelist']=$this->Article->get_menu($bookid);
            $this->load->view('menu.php',$data);
            $data='';
            $data['mydoname']="http://xihuandu.cn/xihuandu/";
            $this->load->view('footer.php',$data);
        }
       
    }
}
