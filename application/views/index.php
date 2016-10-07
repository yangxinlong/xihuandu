<div id="main">
<div id="left">
<div class="divbox">
<div class="left">

<script type="text/javascript" src="<?php echo base_url();?>js/picBox.js" ></script>
<div id="flash_show">
<div class="flash_pic"><table cellpadding="0" cellspacing="0" border="0">
<tr><td align="center" valign="middle" id="flash_img" width="200" height="259"></td></tr></table></div>
<div class="flash_set">
    <ul id="flash_btn">
    <?php 
    $i=1;
    foreach ($suggestlist as $suggest){?>>
        <li><a onMouseOver="javascript:showImage(<?php echo $i;?>-1);return false;" title="<?php echo $suggest['bookname']?>" href="<?php echo base_url();?>archive.php?aid=<?php echo $suggest['id']?>" target="_blank"><img title="<?php echo $suggest['nrjj']?>" src="<?php echo $suggest['img']?>" alt="198*257" /></a></li>
    <?php $i++;}?>
       
    </ul>
<div class="navli"><a id=img_prev_btn onClick="showPrevImage();return false;" href="javascript:void();" target=_self><img height=12 alt="上一页" src="<?php echo base_url();?>images/flash_back.gif" width=11 border=0></a>&nbsp;<a id=img_next_btn onClick="showNextImage();return false;" href="javascript:void();" target=_self><img height=12 alt="下一页" src="<?php echo base_url();?>images/flash_next.gif" width=11 border=0></a></div>
</div>

<div id="flash_show_ctl_msg" align="center">
<h3><a id="flash_title" href="javascript:void();"></a></h3>
<p id="flash_abs"></p></div>
<script type="text/javascript">
var fImgs=$("flash_btn").getElementsByTagName("a");
var fImgsrc=$("flash_btn").getElementsByTagName("img");
imagePlay();

function change_bg(d){
    d.style.background = "url('<?php echo base_url();?>images/indexbg.png')";
    d.onmouseout = function(){d.style.background = "";}
}
</script>

</div>


<div id="lm1">
<dl>
<dt><img src="<?php echo base_url();?>images/ggao.gif" align="absmiddle" />网站公告</dt>
<dd><div class="li_ggao">
<?php foreach ($noticelist as $notice){?>
<cite><?php echo $notice['createtime'];?></cite><a href="<?php echo base_url();?>freeinfo.php?aid=<?php echo $notice['id'];?>" title="<?php echo $notice['title'];?>"  target="_blank"><?php echo $notice['title'];?></a><BR>
<?php }?>

</div></dd>
</dl>
</div>

</div>
<div class="right">
<div class="search" id="searchbox"><table cellpadding="0">
<tr>
<form id="searchform" action="/search.php?sid=0" method="get" target="_blank">
<td width="5%" valign="middle"><img src="<?php echo base_url();?>images/ico_search.gif" /></td>
<td width="14%" valign="middle"><b>站内搜索</b></td>
<td width="66%" id="seach_y"><input name="searchword" value="推荐热门小说" type="text" style="width:263px" maxlength="18" onclick="this.value=''" /></td>
<td width="15%"><input type="hidden" name="searchsubmit" value="1"><input src="<?php echo base_url();?>images/b_s.gif"  type="image" width="52" height="21" id="Image12" /></td>
</form>
</tr>
</table></div>



<div id="txtbox" class="k1">
<?php $i=0;
foreach ($toplist as $top){
if($i==0){?>
<h1><a href="<?php echo base_url();?>archive.php?aid=<?php echo $top['id']?>" title="<?php echo $top['bookname']?>"  target="_blank"><?php echo $top['bookname']?></a></h1>
<h2>
<?php }elseif($i<=5){?>
<a href="<?php echo base_url();?>archive.php?aid=<?php echo $top['id']?>" title="<?php echo $top['bookname']?>"  target="_blank"><?php echo $top['bookname']?></a>

<?php }else{
if($i==6) ?>
</h2>
<div id="txtpic"  onmouseover="change_bg(this);">
<div class="txtpic_r"><b><a href="<?php echo base_url();?>archive.php?aid=<?php echo $top['id']?>" title="<?php echo $top['bookname']?>"><?php echo $top['bookname']?></a></b><br>    　　
<?php if(strlen($top['nrjj'])>80){
    echo substr_cut($top['nrjj'],80);
    }else{
        echo $top['nrjj'];
    }?> <a href="<?php echo base_url();?>archive.php?aid=<?php echo $top['id'];?>"  target="_blank">阅读&gt;&gt;</a>
</div>
<div class="txtpic_l pic_on"><a href="<?php echo base_url();?>archive.php?aid=<?php echo $top['id']?>" target="_blank"><img src="<?php echo base_url();?>/image/<?php echo $top['img'];?>"  width="66" height="87" title=""></a></div>
</div>
<?php }
$i++;}?>




</div>
</div></div>
<div class="blank3"></div>
<div id="lm3"><dl>
<dt><img src="<?php echo base_url();?>images/ico_hsg.gif"  align="absmiddle" /><b>最新小说推荐</b></dt>
<dd>
<table cellpadding="0" cellspacing="10"><tr><td width="262">

<div id="txtpic_fm">
<div class="txtpic_fm_l pic_on"><a href="<?php echo base_url();?>archive.php?aid=<?php echo $lastbookid;?>" target="_blank"><img src="<?php echo base_url();?>images/bookimages/<?php echo $lastbookimg;?>"  width="105" height="137" title="<?php echo $lastbookname;?>"></a></div>
<div class="txtpic_fm_r">
<div class="font14" style="padding:5px 0"><a href="<?php echo base_url();?>archive.php?aid=<?php echo $lastbookid;?>" target="_blank" ><?php echo $lastbookname;?></a></div>
<span class="orange_u"><?php echo $lastbooknrjj;?>  <A href="<?php echo base_url();?>archive.php?aid=<?php echo $lastbookid;?>"  target=_blank>点击阅读</A></span></div>
</div>

</td>
<td valign="top">

<div class="newtxt">
    <ul>
    <?php foreach($news as $new){?>
        <li><a  href="<?php echo base_url();?>archive.php?aid=<?php echo $new['id'];?>" target="_blank" ><?php echo $new['bookname'];?></a></li>
     <?php }?>   
       
     </ul>
</div>

</td></tr></table></dd></dl></div>

<div class="adwimg"><a href="http://www.xihuandu.com" title="喜欢读" target="_blank"><img width="690" height="100" src="<?php echo base_url();?>userfiles/image/20160710/10182526fbdc3727df0020.png" border="0" /></a></div>

<div id="divboxc">
<?php 
 
for($i=0;$i<count($bigclassid);$i++){?>
         <div class="divboxc divboxc_<?php echo $i;?>">
<div id="lm3"><dl><dt><span><a href="<?php echo base_url();?>booklist/index/<?php echo $bigclassid[$i]; ?>/">更多&gt;&gt;</a></span><b><?php echo $bigclassname[$i];?></b></dt>
<dd>
<?php if(isset($bookid[$i])){?>
<table cellpadding="0" cellspacing="10">
    <tr><td><div style="padding-top:5px" class="black_u"><img src="<?php echo base_url();?>images/hot2.gif"  align="absmiddle" />  <a href="<?php echo base_url();?>archive.php?aid=<?php echo $bookid[$i]?>" target="_blank"><b ><?php echo $bookname[$i];?></b></a>
</div><div class="PicOut_F" onMouseOver="className='PicOver_F'"  onmouseout="className='PicOut_F'"><div id="txtpic_66" ><div class="txtpic_66_r orange_u"><?php if(strlen($nrjj[$i])>60){echo substr_cut($nrjj[$i],60);}else{echo $nrjj[$i];}?><A href="<?php echo base_url();?>archive.php?aid=<?php echo $bookid[$i]?>"  target="_blank">阅读作品&gt;&gt;</A></div>
<div class="txtpic_66_l pic_on"><a href="<?php echo base_url();?>archive.php?aid=<?php echo $bookid[$i];?>" target="_blank"><img src="<?php echo base_url();?>images/bookimages/<?php echo $img[$i];?>"  width="66" height="87" title=""></a></div></div></div>
<div class="hottxt"><ul>
</ul></div></td></tr>
</table>
<?php }?>
</dd></dl></div></div>
 <?php }
?>   
 </div>


<div id="divboxd">
<div id="lm4"><dl>
<dt><img src="<?php echo base_url();?>images/ico_gx.gif"  align="absmiddle" /><b>最新小说更新列表</b><span class="rright"><a href="<?php echo base_url();?>list.php?caid=1">更多&gt;&gt;</a></span></dt>
<dd>
<div id="txttd4"><div class="txttb4 txtbg1"><ul>
<?php foreach ($newbookslist as $newbook){?>
<li><span class="urs4 cGray">[<?php echo $newbook['bigclassname']?>]</span> <span class="urs5"><a href="<?php echo base_url();?>archive.php?aid=<?php echo $newbook['bookid']; ?>" title="<?php echo $newbook['bookname']?>"><?php echo $newbook['bookname']?></a></span>

<span class="urs3 cGray"><?php echo $newbook['updatetime']?></span><a href="<?php echo base_url();?>archive.php?aid=<?php echo $newbook['articleid']; ?>" title="<?php echo $newbook['articlename']; ?>"><?php echo $newbook['articlename']; ?></a>

</li>
<?php }?>

</ul></div>
</div></dd>
</dl></div>
</div>



</div>

<div id="right">

<div id="login">
<div class="lm_login"><img src="<?php echo base_url();?>images/ico_login.gif"  align="absmiddle" />会员管理中心</div>
<div class="login"><script language="javascript"  src="<?php echo base_url();?>login.php?mode=js&sid=0"></script></div>
</div>

<div class="ad m_b8"><div id="li_ad"></div></div>



<div id="lm2"><dl><dt><img src="<?php echo base_url();?>images/ico_ph.gif"  align="absmiddle" />风云榜<span></span></dt>
<dd style="padding:0px">
<div id="TabMenu"><ul>
<li class="tab_on" onmouseover="changeTab(0)"><a href="<?php echo base_url();?>index.php?caid=1&ccid7=38">点击榜</a></li>
<li class="div"></li>
<li class="tab_off" onmouseover="changeTab(1)"><a href="<?php echo base_url();?>index.php?caid=1&ccid7=38">收藏榜</a></li>
<li class="div"></li>
<li class="tab_off" onmouseover="changeTab(2)"><a href="<?php echo base_url();?>index.php?caid=1&ccid7=38">评论榜</a></li>
</ul></div>
<div id="txt_tab" class="ttxt_tab">
<div><ul>
<?php foreach($djblist as $djb){

    ?>
    
     <li><span><?php echo $djb['lookcount'];?></span><a href="<?php echo base_url();?>archive.php?aid=<?php echo $djb['id']?>" target="_blank" ><?php echo $djb['bookname']?></a></li>
<?php }?>
   
    
  </ul></div>
<div style="display:none;"><ul>
<?php foreach($favlist as $fav){?>
<li><span><?php echo $fav['favcount']?></span><a href="<?php echo base_url();?>archive.php?aid=<?php echo $fav['bookid']?>" target="_blank" ><?php echo $fav['bookname']?></a></li>
<?php }?>
 
</ul></div>
<div style="display:none"><ul>
<?php foreach($dislist as $dis){?>
<li><span><?php echo $dis['discount']?></span><a href="<?php echo base_url();?>archive.php?aid=<?php echo $dis['bookid']?>" target="_blank" ><?php echo $dis['bookname']?></a></li>
<?php }?>
 
</ul></div>
</div>
</dd></dl></div>

 
</div>
</div>
<div id="links"><b>合作链接：</b><br /><?php

foreach($friendlinklist as $friendlink){?>
    <a href="<?php echo $friendlink['url']?>" target="_blank"><?php echo $friendlink['title']?></a>
<?php }
?>
</div>
</div>
