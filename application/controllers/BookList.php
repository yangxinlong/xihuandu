<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Booklist extends CI_Controller {
  
 

function __construct()
{
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('Bigclass');
    $this->load->model('Books');
   
    $this->load->model('Friendlinks');
}
    public function index($caid=1,$page=1)
    {
       $bigclassid=$caid;//$this->input->get('caid') ;
       //$page=$this->input->get('page');
       //if($page==''){$page=1;}
       $bigclassname=$this->Bigclass->get_what($bigclassid,'typename');
       
      
       $data['title']="喜欢读".$bigclassname."";
       $data['bigclasslist'] = $this->Bigclass->get_allbigclass();
       $myp =  ' <a href="/">小说频道</a>&nbsp;> <a href="'.base_url().'booklist/index/'.$bigclassid.'">'.$bigclassname.'</a>&nbsp;' ;
       $data['myposition']=$myp;
       $this->load->view('top.php',$data);
       
       
       $data['bigclassname']=$bigclassname;
       
       $pgsize=25;
       $booklist=$this->Books->get_books($bigclassid,$pgsize,$page);
       //print_r($booklist);
       $data['booklist']=$booklist;
       
       $this->load->library('pagination');
       $config['base_url'] = base_url().'booklist/index/'.$bigclassid.'/';
       $config['total_rows'] = $this->Books->get_total($bigclassid);
       $config['per_page'] = $pgsize;
       $config['first_link']=false;
       $config['last_link']=false;
       $config['next_link']='&gt;&gt;';
       $config['prev_link'] = '&lt;&lt;';
       $config['cur_tag_open'] = '<a class="p_curpage">';
       $config['cur_tag_close'] = '</a>';
       $config['attributes'] = array('class' => 'p_num');
       $config['num_links'] = 5;
       $config['use_page_numbers'] = TRUE;
       $this->pagination->initialize($config);
       //print_r($config);
       $pagelist= $this->pagination->create_links();
       
       //print_r($pagelist);
       $data['page']=$page;
       $data['pages']=ceil($config['total_rows']/$config['per_page']);
       $data['total']=$config['total_rows'];
       $data['pagelist']=$pagelist;
       
       $friendlinklist=$this->Friendlinks->get_friendlink($bigclassid);
        
       $data['friendlinklist']=$friendlinklist;
       
       $this->load->view('list.php',$data);
       
      	 
		$this->load->view('footer.php');
        
    }
}



?>