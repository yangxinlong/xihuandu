<div class="finishbox">
    <h1><?php echo $bigclassname?>小说&nbsp;&nbsp;<a href="http://127.0.0.1/xihuandu/index.php/booklist/?bk=1&caid=1">所有章节&gt;&gt;</a></h1>
    <div class="finish_list">
        <ul>
        <?php 
        foreach($booklist as $book){
        if(count($book)>0){
            ?>
            <li><b><u><a href="<?php echo base_url();?>archive/index/<?php echo $book['id']?>/" title="<?php echo $book['bookname']?>" target="_blank"><img src="<?php echo $book['img']?>"  width="105" height="137" title="<?php echo $book['bookname']?>"></a></u></b><i>[武侠·仙侠]</i><em><a href="/archive.php?aid=<?php echo $book['id']?>" title="<?php echo $book['bookname']?>" target="_blank"><?php echo $book['bookname']?></a></em></li>
            <?php }
        }?>
            </ul>
    </div>
    <div class="blank18"></div>
    <div><div class="p_bar">
    <a class="p_total">&nbsp;<?php echo $total;?>&nbsp;</a><a class="p_pages">&nbsp;<?php echo $page;?>/<?php echo $pages;?>&nbsp;</a><?php echo $pagelist;?> </div></div>
</div>
<div class="blank9"></div>
<div id="links"><b>合作链接：</b><br /><?php

foreach($friendlinklist as $friendlink){?>
    <a href="<?php echo $friendlink['url']?>" target="_blank"><?php echo $friendlink['title']?></a>
<?php }
?></div>
