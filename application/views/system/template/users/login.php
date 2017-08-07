<?php
 $this->load->view_system('public/header');?>
</head>
<body>
<table border="0" align="center" cellpadding="0" cellspacing="10" class="forum1">
<tbody><tr><td>

<?php
 $this->load->view_system('template/'.$dbtable.'/nav');?>

<form name="manage_box" method="post">
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="forum2">
<tbody><tr class="forumRaw">
<td colspan="5" align="center"><strong class="red">登录情况</strong></td>
</tr>

<tr class="forumRaw">
<td width="40" align="center">ID</td>
<td width="180" align="center">所在地</td>
<td align="center">登录IP</td>
<td width="150" align="center">登录时间</td>
</tr>

<?php

if(!empty($list)){
	foreach($list as $item){
?>
<tr class="forumRow">
<td align="center"><?php
 echo $item->id;?></td>
<td align="center"><?php
 echo convertip($item->ip);?></td>
<td align="center"><a href="http://www.linkwan.com/gb/broadmeter/VisitorInfo/QureyIP.asp?QureyIP=<?php
 echo $item->ip;?>" target="_blank"><?php
 echo $item->ip;?></a></td>
<td align="center"><?php
 echo $item->logintime;?></td>
</tr>
<?php }?>

<?php }else{?>
<tr class="forumRow">
<td colspan="5" align="center"><span class="red">没有找到相应的登录信息</span></td>
</tr>
<?php }?>

</tbody></table>
</form>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="forum2 forumbottom">
<tbody><tr class="forumRaw"><td align="center">
<?php $this->paging->links(); ?>
</td></tr></tbody></table>

</td></tr></tbody></table>
</body></html>