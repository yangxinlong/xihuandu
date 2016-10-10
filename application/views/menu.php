<div id="main">
    <div class="container">
        <div id="arc_title"><h1><a href="<?php echo base_url()?>archive/index/<?php echo $bookid?>/" title="<?php echo $bookname?>"><?php echo $bookname?></a></h1><div class="info">发布: <?php echo $createtime?> | 作者: <?php echo $author?> | 来源: <?php echo $source?> | 查看: <font id="cms_clicks"><?php echo $lookcount?></font>次&nbsp;&nbsp;<a href="<?php echo base_url()?>downtxt/<?php echo $bookid?>/" class="cRed" target="_blank">TXT下载</a></div>
            </div>
        <div class="alllist">
            <div class="listcon">
                            <h1>章节内容</h1>
                <ul>
                    <?php foreach($articlelist as $article){?>
                    <li><a href="<?php echo base_url()?>archive/read/<?php echo $article['id']?>/"><?php echo $article['articlename']?></a><span><?php echo $article['createtime']?></span></li>
                    <?php }?>
                </ul>
                
            </div>
        </div>
 
  <div class="blank18"></div>
    <div class="blank9"></div>
    <div class="pagenav1"> </div>
    <div class="blank9"></div>
    </div>
</div>

