<?php
 $this->load->view_system('public/header');?>
</head>
<body>
<table border="0" align="center" cellpadding="0" cellspacing="10" class="forum1">
<tbody><tr><td>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="forum2 forumtop">
<form name="search" method="get">
<tbody><tr class="forumRaw"><td width="100%" align="center" class="mainTitle"><?php
 echo $dbtitle;?>列表</td>
<td align="center">
<table border="0" cellpadding="0" cellspacing="0" class="forum2">
<tbody><tr class="forumRaw2"><td><input name="keyword" value="<?php
 echo $keyword;?>" type="text" id="keyword" style="font-size: 9pt" size="25"></td>
<td align="center">
<input name="submit" type="submit" value="搜索<?php
 echo $dbtitle;?>" align="absMiddle" class="button">
</td></tr></tbody></table></td></tr></tbody>
</form>
</table>


<form name="manage_box" method="post">
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="forum2">
<tbody><tr class="forumRaw">
<td align="center">ID</td>
<td>&nbsp;名称</td>
<td width="135" align="center">最后登录</td>
<td width="120" align="center">IP</td>
<td width="60" align="center">封锁</td>
<td width="130" align="center">修改操作</td></tr>

<?php

if(!empty($list)){
	foreach($list as $item){
?>
<?php
 if( $item->super==1 ){?>
<tr class="forumRow btu2" title="双击可以修改这项信息" url="<?php echo site_system($dbtable.'/edit').reUrl('cmd=null&id='.$item->id);?>">
<td align="center"><?php
 echo $item->id;?></td>
<td>&nbsp;<?php
 echo keycolor($item->username,$keyword);?></td>
<td align="center"><?php
 echo $item->logintime;?></td>
<td align="center">&nbsp;<?php
 echo $item->loginIp;?>&nbsp;</td>
<td align="center">-</td>
<td align="center"><input type="button" class="btu_del" value="&nbsp;" onClick="alert('不能删除高级管理员!');return false;" />  <input type="button" class="btu_edit btu" value="&nbsp;" url="<?php echo site_system($dbtable.'/edit').reUrl('cmd=null&id='.$item->id);?>"/>
</td></tr>
<?php }else{?>
<tr class="forumRow btu2" title="双击可以修改这项信息" url="<?php echo site_system($dbtable.'/edit').reUrl('cmd=null&id='.$item->id);?>">
<td align="center"><?php
 echo $item->id;?></td>
<td>&nbsp;<?php
 echo keycolor($item->username,$keyword);?></td>
<td align="center"><?php
 echo $item->logintime;?></td>
<td align="center"><?php
 echo $item->loginIp;?></td>
<td align="center"><?php
 echo cm_form_check('ok',$item->id,$item->ok);?></td>
<td align="center">
<input type="button" class="btu_del btu" value="&nbsp;" url="<?php echo reUrl('cmd=del&id='.$item->id);?>" tip="删除该项信息" />
<input type="button" class="btu_edit btu" value="&nbsp;" url="<?php echo site_system($dbtable.'/edit').reUrl('cmd=null&id='.$item->id);?>"/>
</td></tr>
<?php }}?>

<?php }else{?>
<tr class="forumRow">
<td colspan="6" align="center"><span class="red">没有找到相应的信息</span></td>
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