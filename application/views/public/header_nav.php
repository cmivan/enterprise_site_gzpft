<div class="menu-contact">
<?php
 /*?><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=364829394&site=gzpft&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:364829394:41" alt="点击可以在线交谈!" title="点击可以在线交谈!"></a><?php
 */?>
<a target="_blank" href="http://sighttp.qq.com/authd?IDKEY=196e1d0c874aaf46b16b9d3821e486b5b3d2ae00611dd3cc"><img border="0" src="http://wpa.qq.com/imgd?IDKEY=196e1d0c874aaf46b16b9d3821e486b5b3d2ae00611dd3cc&pic=41" alt="点击可以在线交谈!" title="点击可以在线交谈!"></a>
&nbsp;&nbsp;&nbsp;<span>中国个性原木家居领航者</span>
</div>

<div id="primary-nav">
<div class="menu-mainmenu-container">
<ul id="menu-mainmenu" class="menu">
<?php
 if(empty($user_power)){?><li class="current-menu-item"><?php echo getnav($nav,'index');?></li><?php
 }?>
<li><?php echo getnav($nav,'about_us');?></li>
<li id="menu-products"><span>新</span><?php echo getnav($nav,'news');?></li>
<li><?php
 if($super===1){?><?php echo getnav($nav,'products');?><?php
 }else{?><?php echo getnav($nav,'products_series');?><?php echo getnav2($nav2,'products_series');?><?php
 }?></li>
<li><?php echo getnav($nav,'products/news');?></li>
<li><?php echo getnav($nav,'products/scene');?></li>
<li><?php echo getnav($nav,'cooperation');?><?php echo getnav2($nav2,'cooperation');?></li>
<?php
 if($super===1){?><li><?php echo getnav($nav,'download');?></li><?php
 }?>
<li><?php echo getnav($nav,'contact');?></li>
</ul></div>
</div>