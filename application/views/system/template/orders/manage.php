<?php $this->load->view_system('public/header');?>
</head>
<body>
<table border="0" align="center" cellpadding="0" cellspacing="10" class="forum1">
<tbody><tr><td>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="forum2 forumtop">
<form name="search" method="get">
<tbody><tr class="forumRaw"><td width="100%" align="center" class="mainTitle"><?php echo $dbtitle;?>列表</td>
<td align="center">
<table border="0" cellpadding="0" cellspacing="0" class="forum2">
<tbody><tr class="forumRaw2"><td><input name="keyword" value="<?php echo $keyword;?>" type="text" id="keyword" style="font-size: 9pt" size="25"></td>
<td align="center">
<input name="submit" type="submit" value="搜索<?php echo $dbtitle;?>" align="absMiddle" class="button">
</td></tr></tbody></table></td></tr></tbody>
</form>
</table>

<?php $this->load->view_system('template/'.$dbtable.'/nav');?>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="forum2 forumtop">
<tbody><tr class="forumRaw"><td align="center">
<?php $this->paging->links(); ?>
</td></tr></tbody></table>

<form name="manage_box" method="post">
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="forum2">
<tbody><tr class="forumRaw">
<td align="center"><strong>ID</strong></td>
<td align="center"><strong>单号</strong></td>
<td align="center"><strong>姓名</strong></td>
<td align="center"><strong>手机</strong></td>
<td align="center"><strong>固话</strong></td>
<td align="center"><strong>邮箱</strong></td>
<td align="center"><strong>状态</strong></td>
<td align="center"><strong>下单日期</strong></td>
<td width="130" align="center"><strong>修改操作</strong></td></tr>

<?php if(!empty($list)){
	foreach($list as $item){
?>
<tr class="forumRow">
<td height="26" align="center"><?php echo $item->id;?></td>
<td height="26" align="center"><?php echo keycolor($item->order_no,$keyword);?></td>
<td align="center"><?php echo keycolor($item->nicename,$keyword);?></td>
<td align="center"><?php echo $item->mobile;?></td>
<td align="center"><?php echo $item->tel;?></td>
<td align="center"><?php echo $item->email;?></td>
<td align="center"><?php echo ordersStatusShow($item->status);?></td>
<td align="center" title="<?php echo $item->logintime;?>"><?php echo dateYMD($item->logintime);?></td>
<td align="center">
<?php if($super==1||$item->uid==$logid){?>
<a href="<?php echo site_system($dbtable.'/view').reUrl('cmd=null&id='.$item->oid);?>" class="btn">详情(View)</a>
<?php }else{?>
<a href="<?php echo site_system($dbtable.'/view').reUrl('cmd=null&id='.$item->oid);?>" class="btn">详情(View)</a>
<?php }?></td></tr>
<?php }?>

<?php }else{?>
<tr class="forumRow">
<td colspan="9" align="center"><span class="red">没有找到相应的信息</span></td>
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