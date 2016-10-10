<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('Bigclass');
        $this->load->model('Books');
        $this->load->model('Notice');
        $this->load->model('Article');
        $this->load->model('Fav');
        $this->load->model('Discuss');
         $this->load->model('Friendlinks');
        $this->load->helper('url');
    }
	public function index()
	{
	    
	   
	   
	    //---------------------top
	    $data['title']="喜欢读";
	    $data['bigclasslist'] = $this->Bigclass->get_allbigclass();
	    $myp =  ' <a href="'.base_url().'">小说频道</a>&nbsp;' ;
	    $data['myposition']=$myp;
		$this->load->view('top.php',$data);
		//-----------------------main
		$data1['mydoname']="http://localhost/xihuandu/";
		$data1['suggestlist']=$this->Books->get_suggest();
		$data1['noticelist']=$this->Notice->get_news(5,1);
		$data1['toplist']=$this->Books->get_top();
		
		$data1['news']=$this->Books->get_news();
		$arr=$this->Books->get_last(1);
		foreach($arr as $a){
		$data1['lastbookid']=$a['id'];
		$data1['lastbookname']=$a['bookname'];
		$data1['lastbookimg']=$a['img'];
		$data1['lastbooknrjj']=$a['nrjj'];
		}
		
		$arr=$this->Bigclass->get_allbigclass();
		$i=0;
		foreach($arr as $a){
		    $bigclassid[$i]=$a['id'];
		    $bigclassname[$i]=$a['typename'];
		    $books=$this->Books->get_tj($a['id']);
		    foreach($books as $book){
		        if(is_array($book)){
		          $bookid[$i]= $book['id'];
		          $bookname[$i]=$book['bookname'];
		          $nrjj[$i]= $book['nrjj']='' ? '' : $book['nrjj'];
		          $img[$i]=$book['img'];}
		    }
		  
		    $i++;
		}
		$data1['bigclassid']=$bigclassid;
		$data1['bigclassname']=$bigclassname;
		
		$data1['bookid']=$bookid;
		$data1['bookname']=$bookname;
		$data1['nrjj']=$nrjj;
		$data1['img']=$img;
		$arr=$this->Books->get_last(25);
		 
		$i=0;
		foreach($arr as $a){
		    $bookid=$a['id'];
		    $bookname=$a['bookname'];
		    $bookupdatetime=$a['updatetime'];
		    $bigclassid=$a['bigclassid'];
		    
		    $bigclassname=$this->Bigclass->get_what($bigclassid,'typename');
		    //print_r($bookid);
		    $article=$this->Article->get_lastarticle($bookid);
		   // print_r($article);
		    $articleid=$article['id'];
		    $articlename=$article['articlename'];
		   
		    $newbookslist[$i]=array('bookid'=>$bookid,'bookname'=>$bookname,'updatetime'=>$bookupdatetime, 'bigclassid'=>$bigclassid,'bigclassname'=>$bigclassname,'articleid'=>$articleid,'articlename'=>$articlename);
		   
		    $i++;
		}
		//print_r($newbookslist);
		$data1['newbookslist']=$newbookslist;
		$data1['djblist']=$this->Books->get_dianji();
		$favlist=$this->Fav->get_fav();
		if(count($favlist)>0){
		$i=0;
		foreach($favlist as $fav){
		    $bookid=$fav['bookid'];
		    $bookname=$this->Books->get_name($bookid);
		    $favcount=$fav['a'];
		    $favarr[$i]=array('bookid'=>$bookid,'bookname'=>$bookname,'favcount'=>$favcount);  
		    $i++;
		}
	   $data1['favlist']=$favarr;
		}
	   $dislist=$this->Discuss->get_dis();
	   if(count($dislist)>0){
	   $i=0;
	   foreach($dislist as $dis){
	       
	       $bookid=$dis['bookid'];
	       $bookname=$this->Books->get_name($bookid);
	       $discount=$dis['a'];
	       $disarr[$i]=array('bookid'=>$bookid,'bookname'=>$bookname,'discount'=>$discount);
	       
	      
	       $i++;
	   }
	   $data1['dislist']=$disarr;
	   }
	   $friendlinklist=$this->Friendlinks->get_friendlink(0);
	    
	       $data1['friendlinklist']=$friendlinklist;
	    
		$this->load->view('index.php',$data1);
		//--------------------footer
		$data2['mydoname']="http://localhost/xihuandu/";
		$this->load->view('footer.php',$data2);
	}
	function substr_cut($str_cut,$length)
	{
	    if (strlen($str_cut) > $length)
	    {
	        for($i=0; $i < $length; $i++)
	            if (ord($str_cut[$i]) > 128)    $i++;
	        $str_cut = substr($str_cut,0,$i)."..";
	    }
	    return $str_cut;
	}
}
