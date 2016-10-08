
<div id="main">
<div id="left" class="left">
<div class="divbox m_b8">
<div class="txtbox k1">
<h1><?php echo $book['bookname'];?>&nbsp;&nbsp;</h1>
<h2>发布: <?php echo $book['updatetime']?> | 作者: &nbsp;<?php echo $book['author']?> | 来源: <?php echo $book['source']?> | 查看: <font id="cms_clicks"><?php echo $book['lookcount']?></font>次  |  <a href="<?php echo base_url()?>shelf/index/" class="cRed">打开书架</a></h2>
<div class="account"><p><?php echo $book['nrjj']?></p></div>
<div class="shuping">
<a class="read" href="<?php echo base_url()?>menu/index/<?php echo $book['id']?>/">点击阅读</a>
<a href="javascript:ajax_praise('<?php echo $book['id']?>');">我顶(<font id="cms_praises"><?php echo $book['ding']?></font>)</a>
<a href="javascript:ajax_debase('<?php echo $book['id']?>');">我踩(<font id="cms_debases"><?php echo $book['cai']?></font>)</a>
<a href="javascript:ajax_favorite('<?php echo $book['id']?>');">收藏(<font id="cms_favorites"><?php echo $book['shoucang']?></font>)</a>
<a href="<?php echo base_url()?>report.php?aid=<?php echo $book['id']?>" onclick="return floatwin('open_report',this,800,300)">举报<font>&nbsp;</font></a>
</div>


<div class="aboutthis">
    <h1>本书相关</h1>
    <ul>
        <li><strong>总点击：</strong><font id="ccms_clicks"><?php echo $book['lookcount']?></font></li><li><strong>总收藏：</strong><font id="ccms_favorites"><?php echo $book['shoucang']?></font></li><li><strong>总推介：</strong><font id="ccms_praises"><?php echo $book['ding']?></font></li>
        <li><strong>本月点击：</strong><font id="ccms_mclicks"><?php echo $click_month?></font></li><li><strong>本月收藏：</strong><font id="ccms_mfavorites"><?php echo $fav_month?></font></li><li><strong>本月推介：</strong><font id="ccms_mpraises"><?php echo $suggest_month?></font></li>
        <li><strong>本周点击：</strong><font id="ccms_wclicks"><?php echo $click_week?></font></li><li><strong>本周收藏：</strong><font id="ccms_wfavorites"><?php echo $fav_week?></font></li><li><strong>本周推介：</strong><font id="ccms_wpraises"><?php echo $suggest_week?></font></li>
    </ul>
</div>
<div class="pagenav"><span></span><a href="<?php echo base_url()?>archive/prev/<?php echo $book['id']?>/" class="btn">上一篇：<?php echo $pre_bookname?></a></div>
</div>
</div>



<div id="divboxd">
<div id="lm4"><dl>
<dt><img src="http://www.xihuandu.com/template/default/images/ico_gx.gif"  align="absmiddle" /><b>最新章节</b></dt>
<dd>
<div class="pagelist"><dl>
<?php 
$i=1;
foreach($articlelist as $article){?>
<dd>
    <h3><font><?php echo $i?></font><a href="<?php echo base_url()?>archive/read/<?php echo $article['id']?>/" title="<?php echo $article['articlename']?>" target="_blank"><?php echo $article['articlename']?></a></h3>
   <?php echo $article['nrjj']?>...
</dd>

<?php $i++; }?>
</dl></div>
</dd>
</dl></div>
</div>
<div id="lm3">
<dl>
<dt style="text-align:center;"><img src="http://www.xihuandu.com/template/default/images/plen.png"  align="absmiddle" /> <?php echo $book['bookname']?>小说已有评论<font id="cms_comments" style="color:#F00; font-weight:bold;"><?php echo $book['discuss']?></font> 次 <a href="<?php echo base_url()?>comments/index/<?php echo $book['id']?>/">查看所有评论&gt;&gt;</a></dt>
<dd><ul class="comcon">
<?php foreach($discusslist as $discuss){?>
<li><?php if(strlen($discuss['contentinfo'])>20){
    echo substr($discuss['contentinfo'],0,20)."...";
}else{
    echo $discuss['contentinfo'];
}?>
<span style="float:right"><?php echo $discuss['createtime']?></span></li>
<?php }?>

</ul></dd></dl></div>
<div id="lm3"><dl>
<dt><img src="http://www.xihuandu.com/template/default/images/bx2.gif"  align="absmiddle" /><b>发表评论</b><span><a href="<?php echo base_url()?>comments/index/<?php echo $book['id']?>/">更多&gt;&gt;</a></span></dt>
<dd class="comform">
<form name="formcomment" method="post" action="<?php echo base_url()?>archive/add/">
<input name="bookid" type="hidden" value="<?php echo $book['id']?>" />
<textarea name="contentinfo" id="contentinfo" tabindex="3" rows="6" cols="130" title="评论内容"></textarea>
<table cellpadding="0" cellspacing="0" border="0">
<tr><td width="60"></td>
<td width="50">验证码：</td>
<td width="50"><input type="text" name="regcode" size="7" maxlength="5" id="regcode" tabindex="2" value="" class="input"></td>
<td><img src="<?php echo base_url()?>archive/rand_create/" alt="点击更换验证码" style="vertical-align:middle;cursor:pointer;" onClick="this.src='<?php echo base_url()?>archive/rand_create/'" /></td>
<td align="center"><button type="submit" name="newcommu" value="true" class="cbtn">发表评论</button></td>
<td width="40%"><?php echo $result?> </td>
</tr></table>
</form></dd>
</dl></div>
</div>

<div id="right" class="right">
<div class="picBox m_b8"><img src="<?php echo base_url().'images/bookimages/'.$book['img']?>" width="240" height="316" /></div>
<div class="search m_b8" id="searchbox"><table cellpadding="0">
<tr>
<form id="searchform" action="<?php echo base_url()?>/search/index/" method="post" target="_blank">
<td valign="middle"><img src="http://www.xihuandu.com/template/default/images/ico_search.gif" /></td>
<td valign="middle"><b>搜索 </b></td>
<td id="seach_y"><input name="searchword" value="推荐热门小说" type="text" onclick="this.value=''" style="width:120px" maxlength="18"/></td>
<td><input type="hidden" name="child" value="0"><input src="http://www.xihuandu.com/template/default/images/b_s.gif"  type="image" name="searchsubmit" width="52" height="21" id="Image12" /> </td>
</form>
</tr>
</table></div>







</div></div>

<div id="links"><b>合作链接：</b><br /><?php

foreach($friendlinklist as $friendlink){?>
    <a href="<?php echo $friendlink['url']?>" target="_blank"><?php echo $friendlink['title']?></a>
<?php }
?></div>

