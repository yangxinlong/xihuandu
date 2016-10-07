<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Geturl extends CI_Controller {


    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->model('Bigclass');

        $this->load->model('Books');
        $this->load->model('Article');
        $this->load->model('Discuss');
        $this->load->model('Friendlinks');
        $this->load->library('Getpinyin');
    }
    public function index()
    {
        $sitename='纵横';
      
 
       // echo  $this->getpinyin->getAllPY('汉文字字');
       // return;
        $url="http://book.zongheng.com/rank/male/r4/c3/q0/1.html";
        $str=file_get_contents($url);
        $start='<ul class="main_con">';
        $end='</ul>';
        $liststr=explode($end,explode($start,$str)[1])[0];
         
        //print_r($liststr);
        $arr=explode("</li>", $liststr);
        foreach($arr as $book){
            $book=str_replace('<em title="VIP作品" class="vip"></em>','',$book);
            $book=str_replace('<em class="mark" title="签约作品">[签约]</em>','',$book);
           //分类名
            $bookclass=explode(']',explode('[', $book)[1])[0];
            $bigclassid=$this->Bigclass->get_bigclass_id($bookclass);
         
            $data='';
            if($bigclassid==NULL){
                $data['typename']=$bookclass;
                $data['conversion']=$this->getpinyin->getAllPY($bookclass);
                $data['sortid']=100;
                $bigclassid = $this->Bigclass->set_bigclass($data);
            }
           
         //书页网址   
            $myurl=explode('"',explode('<a class="fs14" href="',$book)[1])[0];
           //书名
            $bookname=explode('"',explode('title="',$book)[1])[0];
            //print_r($bookclass." ".$myurl." ".$title);
           
           $menu_url= $this->Books->get_menu_url($bookname);
         
           if($menu_url==NULL){
               $str=file_get_contents($myurl);
               //图片
               $img_url=explode('" onerror=',explode('<img style="width: 172px; height: 230px;" alt="'.$bookname.'" src="',$str)[1])[0];
              
               $filename_arr=explode('/',$img_url);
               
               $filename=$filename_arr[count($filename_arr)-1];
              
               $img_content=file_get_contents($img_url);
               //print_r($img_url);
               //return;
              // Echo dirname(__FILE__).'/../../images/bookimages/';
               //return;
               file_put_contents(dirname(__FILE__).'/../../images/bookimages/'.$filename, $img_content);
               //作者
               $author=explode('</a>',explode('<em>·</em>作者：',$str)[1])[0];
               //内容简介
               $nrjj=explode('</div>',explode('<div class="info_con">',$str)[1])[0];
               $data='';
               //目录网址
               $menu_url=explode('"" class="btn_dl"',explode('<span class="btn_as list"><a href="',$str)[1])[0];
               $data['bookname']=$bookname;
               $data['author']=$author;
               $data['nrjj']=$nrjj;
               $data['img']=$filename;
               $data['source']=$sitename;
               $data['bigclassid']=$bigclassid;
               $data['lookcount']=0;
               $data['source_url    ']=$myurl;
               $data['menu_url']=$menu_url;
               $this->Books->set_book($data);
           }
           
          // print_r($menu_url);
          // return;
               $str=file_get_contents($menu_url);
               //处理目录，保留内容
               $str=explode('<div class="quick_fixed" style="display: none;">',explode('<!-- 公共卷 -->',$str)[1])[0];
               //读取章节
               $arr=explode('</td>',$str);
               foreach($arr as $article){
                   //章节名称
                   $articlename=explode('" chapterLevel="0"',explode('chapterName="',$article)[1])[0];
                   //章节网址
                   $articleurl=explode('" title=',explode('<a href="',$article)[1])[0];
                   //更新时间
                   $articleupdatetime=explode(' 字数:',explode('最后更新时间:',$article)[1])[0];
                   
               }
           
           
           
           return;
        }
        
    }
    public function getbook(){
        $str=file_get_contents('http://book.zongheng.com/showchapter/311835.html');
        $str=explode('<div class="quick_fixed" style="display: none;">',explode('<!-- 公共卷 -->',$str)[1])[0];
        print_r($str);
        
    }
    
    
}