<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="<?php echo $articlename?>,小说网,玄幻小说,武侠小说,都市小说,历史小说,网络小说,言情小说,青春小说,原创网络文学" />
<TITLE><?php echo $articlename?></TITLE>
<meta name="Description" content="<?php echo $nrjj?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/style.css" />
<script type="text/javascript">var cmsUrl = "<?php echo base_url();?>";</script>
<script src="<?php echo base_url();?>js/jquery-1.4.2.js" type="text/javascript" language="javascript"></script>
</head>
<body>
<!-- 顶部 begin -->
<div id="top">
<div class="left orangea"><img src="<?php echo base_url();?>images/time.gif"  align="absmiddle" /> <script type="text/javascript" src="<?php echo base_url();?>js/time.js" ></script></div>
<div class="right">【<a href="#" onclick="this.style.behavior='url(#default#homepage)';this.setHomePage('<?php echo base_url()?>');" style="cursor:hand">设为首页</a>】【<a href="#" onClick="javascript:window.external.AddFavorite('<?php echo base_url()?>','喜欢读网');">收藏本站</a>】</div>
</div>
<!-- 首体 begin -->
<div id="head">
<div class="left"><a href="<?php echo base_url()?>" ><img src="<?php echo base_url()?>images/logo.gif" /></a></div>
<div class="right">
<div class="r1"><ul>

</ul></div>
<div class="r2"><a href="<?php echo base_url();?>" title="banner" target="_blank"><img width="700" height="60" src="<?php echo base_url();?>images/banner.png" border="0" /></a></div>
</div>
</div>
<!-- 首体 begin -->
<script type="text/javascript">
function showmenu(id){
	for(var i=1; i<=5; i++){
		$('menu_'+i).style.display='none';
	}
	$('menu_'+id).style.display='block';
}
</script>
<div id="menu">
<div class="h1"><ul>
<li><a href="<?php echo base_url();?>">首页</a></li>
<li onmouseover="showmenu(1)"><a href="<?php echo base_url();?>">小说频道</a></li>

<li onmouseover="showmenu(4)"><a href="<?php echo base_url();?>bigclass/method=all">全本小说</a></li>

<li onmouseover="showmenu(3)"><a href="<?php echo base_url();?>booklist/method=ph">排行榜</a></li>
<li><a href="<?php echo base_url();?>adminm.php" target="_blank">会员中心</a></li>
<li onmouseover="showmenu(2)"><a href="<?php echo base_url();?>booklist/method=vip">VIP专区</a></li>
</ul></div>
<div class="h2" id="menu_1">
<div class="left"><a>小说频道&gt;&gt;</a></div>
<div class="right"><?php
foreach ($bigclasslist as $bigclass){?>
<a href="<?php echo base_url();?>booklist/index/<?php echo $bigclass['id'];?>"><?php echo $bigclass['typename']?></a>
<?php

} ; ?></div>
</div>
<div class="h2" id="menu_2">
<div class="left"><a>&lt;&lt; VIP小说频道</a></div>
<div class="right"><?php  
foreach ($bigclasslist as $bigclass){?>
<a href="<?php echo base_url();?>booklist/index/<?php echo $bigclass['id'];?>"><?php echo $bigclass['typename']?></a>
<?php

} ; ?></div>
</div>

<div class="h2" id="menu_3">
<div class="left"><a>&lt;&lt; 排行榜</a></div>
<div class="right"><?php 
foreach ($bigclasslist as $bigclass){?>
<a href="<?php echo base_url();?>booklist/index/<?php echo $bigclass['id'];?>"><?php echo $bigclass['typename']?></a>
<?php

} ; ?></div>
</div>

<div class="h2" id="menu_4">
<div class="left"><a>全本小说&gt;&gt;</a></div>
<div class="right"><?php 
foreach ($bigclasslist as $bigclass){?>
<a href="<?php echo base_url();?>booklist/index/<?php echo $bigclass['id'];?>"><?php echo $bigclass['typename']?></a>
<?php } ; ?></div>
</div>

<span class="reda">当前位置&gt;&gt;</span>  <a href="<?php echo base_url();?>">首页</a> > <?php echo $myposition;?></div>
</div>
</div>

<div id="main">
    <div class="container">
        <div id="arc_title"><h1><a href="<?php echo base_url()?>archive.php?aid=60882" title="<?php echo $bookname?>"><?php echo $bookname?></a> </h1><div class="info"><span>
            <a href="javascript:alt_font('contents','12');" class="font12">小</a>
            <a href="javascript:alt_font('contents','14');" class="font14">中</a>
            <a href="javascript:alt_font('contents','16');" class="font16">大</a>
            </span>   发布: <?php echo $createtime?> | 作者: <?php echo $author?> | 来源: <?php echo $source?> | 查看: <font id="cms_clicks"><?php echo $lookcount?></font>次</div>
            </div>
        <div id="contents">
        <h1 style="border-bottom:#BFBFBF 1px dashed;"><?php echo $articlename?></h1>
       <?php echo $contentinfo?>
        <div class="blank18"></div>      
        </div>
 
       
  <div class="blank18"></div>
    <div class="blank9"></div>
    <div class="pagenav1">  <a href="<?php echo base_url()?>archive/index/<?php echo $bookid?>/">【目录】</a>  <?php if($nextid!=""){?><a href="<?php echo base_url()?>archive/read/<?php echo $nextid?>/" class="btn">下一篇：<?php echo $nextname?></a><?php }?></div>
    <div class="blank9"></div>
    </div>
</div>
<script type="text/javascript">
function set_stat(s){
    var k, o;
    s = s['60883'];
    if(!s)return;
    for(k in s){
        o = $id('cms_' + k);
        if(o)o.innerHTML = s[k];
        o = $id('ccms_' + k);
        if(o)o.innerHTML = s[k];
    }
}
ajax_get_stat('60883', set_stat);

</script>

<div id="foot">
<span>

<a href="<?php echo base_url();?>register.php" >会员注册</a>
</span>
<p id="copyright">Copyright &#169; 2016-2026 <a href="<?php echo base_url();?>" target="_blank">xihuandu.com</a> All rights reserved.<br>  <br> </p>
</div>
</body>
</html>