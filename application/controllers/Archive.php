<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Archive extends CI_Controller {
    

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
    }
    public function index($bookid=1)
    {
        
        $book=$this->Books->get_book($bookid);
        
        $bigclassid=$book['bigclassid'];
        $data['title']="喜欢读".$bigclassname."";
        $data['bigclasslist'] = $this->Bigclass->get_allbigclass();
        $bigclassname=$this->Bigclass->get_what($bigclassid,'typename');
        $myp =  ' <a href="/">小说频道</a>&nbsp;> <a href="'.base_url().'booklist/index/'.$bigclassid.'">'.$bigclassname.'</a>&nbsp;' ;
        $data['myposition']=$myp;
        
        $this->load->view('top.php',$data);
        
        $data['book']=$book;
       
        $data['articlelist']=$this->Article->get_news($bookid);
        $discusslist=$this->Discuss->get_book_dis($bookid,1);
        //print_r($discusslist);
        $data['discusslist']=$discusslist;
        $friendlinklist=$this->Friendlinks->get_friendlink($bigclassid);
        
        $data['friendlinklist']=$friendlinklist;
        
        $this->load->view('archive.php',$data);
        
        $this->load->view('footer.php');
    }
    function rand_create(){
        
         session_start();
        
        
        
         //生成验证码图片
        
         header("Content-type: image/png");
        
         //要显示的字符，可自己进行增删
        
         $str = "1,2,3,4,5,6,7,8,9,a,b,c,d,e,f,g,h,i,j,k,m,n,p,q,r,s,t,y,z";
        
         $list = explode(",", $str);
        
         $cmax = count($list) - 1;
        
         $verifyCode = '';
        
         for ( $i=0; $i < 5; $i++ ){
            
             $randnum = mt_rand(0, $cmax);
            
             //取出字符，组合成验证码字符
            
             $verifyCode .= $list[$randnum];
            
             }
            
             //避免程序读取session字符串破解，生成的验证码用MD5加密一下再放入session，提交的验证码md5以后和seesion存储的md5进行对比
            
             //直接md5还不行，别人反向md5后提交还是可以的，再加个特定混淆码再md5强度才比较高,总长度在14位以上
            
             //网上有反向md5的 Rainbow Table，64GB的量几分钟内就可以搞定14位以内大小写字母、数字、特殊字符的任意排列组合的MD5反向
            
             //但这种方法不能避免直接分析图片上的文字进行破解，生成gif动画比较难分析出来
            
            
            
             //加入前缀、后缀字符，prestr endstr 为自定义字符，将最终字符放入SESSION中
            
             $_SESSION['randcode'] =  md5("prestr".$verifyCode."endstr");
            
             //生成图片
            
             $im = imagecreate(58,28);
            
             //此条及以下三条为设置的颜色
            
             $black = imagecolorallocate($im, 0,0,0);
            
             $white = imagecolorallocate($im, 255,255,255);
            
             $gray = imagecolorallocate($im, 200,200,200);
            
             $red = imagecolorallocate($im, 255, 0, 0);
            
             //给图片填充颜色
            
             imagefill($im,0,0,$white);
            
            
            
             //将验证码写入到图片中
            
             imagestring($im, 5, 10, 8, $verifyCode, $black);
            
            
            
             //加入干扰象素
            
             for($i=0;$i<50;$i++)
                
                 {
                
                 $randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255));
                
                         imagesetpixel($im, rand()%70 , rand()%30 , $randcolor);
                
                 }
                
                 imagepng($im);
                
                 imagedestroy($im);
                
                 }
                
                
                
                 function add(){
                    
                     $bookid=$this->input->post('bookid');
                     $contentinfo=$this->input->post('contentinfo');
                     session_start();
                    
                     $randcode = md5("prestr".$this->input->post('regcode')."endstr");//prestr endstr 要对应上面放入session的字符串
                    
                     if($randcode != $_SESSION['randcode']){
                        
                        echo "<script>alert('对不起，验证码输入错误，请重试！');window.location.href='".base_url()."archive/index/".$bookid."/';</script>";
                        


                         return;
                        
                         }else{
                             
                             $data=array(
                                 'bookid'=>$bookid,
                                 'userid'=>$_SESSION['userid'],
                                 'contentinfo'=>$contentinfo,
                                 'createtime'=>date('Y-m-d H:i:s',time())
                             );
                            $result= $this->Discuss->add_recorecount($data);
                             if($result){
                                    echo "<script>alert('评论成功!');window.location.href='".base_url()."archive/index/".$bookid."/';</script>";
                        
                             }
                             
                         }
                 }
         public function read($aid){
             if($aid==''){
                 $this->load->view('404.php');
             }else{
                 //---------------------top
                 $data['title']="喜欢读";
                 $data['bigclasslist'] = $this->Bigclass->get_allbigclass();
                 $myp =  ' <a href="'.base_url().'">小说频道</a>&nbsp;' ;
                 $data['myposition']=$myp;
                 
                 $article=$this->Article->get_article($aid);
                
                 $data['articlename']=$article['articlename'];
                 $data['bigclassid']=$article['bigclassid'];
                 $data['bookid']=$article['bookid'];
                 $data['nrjj']=$article['nrjj'];
                 $data['createtime']=$article['createtime'];
                 $data['lookcount']=$article['lookcount'];
                  
                 $book=$this->Books->get_book($article['bookid']);
                 
                 $data['bookname']=$book['bookname'];
                 $data['author']=$book['author'];
                 $data['source']=$book['source'];
                 
                 
                 $bigclass=$this->Bigclass->get_bigclass($bigclassid);
                 
                 $data['bigclassname']=$bigclass['typename'];
                 $data['bigclassid']=$bigclass['id'];
                 $data['contentinfo']= file_get_contents('articles/'.$article['bookid'].'/'.$aid.'.txt');
                 
                 $next=$this->Article->get_next($article['bookid'],$article['id']);
                 $data['nextid']=$next['id'];
                 $data['nextname']=$next['articlename'];
                 $this->load->view('article.php',$data);
             }
         }               
}