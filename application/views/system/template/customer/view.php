<?php
 $this->load->view_system('public/header');?>
</head>
<body>
<table border="0" align="center" cellpadding="0" cellspacing="10" class="forum1">
<tbody><tr><td>

<?php
 $this->load->view_system('template/'.$dbtable.'/nav');?>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="forum2 forumtop">
<tbody>

<?php
 if( is_num($rs['id']) ){?>
<tr class="forumRaw">
<td colspan="5" align="center"><strong class="red">基本信息</strong></td>
</tr>
<?php
 }?>

<tr class="forumRow">
<td height="28" align="right">称呼：</td><td>&nbsp;&nbsp;<?php
 echo $rs['nicename']?></td></tr>

<tr class="forumRow">
<td height="28" align="right">邮箱：</td><td>&nbsp;&nbsp;<?php
 echo $rs['email']?></td></tr>

<tr class="forumRow">
<td height="28" align="right">手机：</td><td>&nbsp;&nbsp;<?php
 echo $rs['mobile']?></td></tr>

<tr class="forumRow">
<td height="28" align="right">固话：</td><td>&nbsp;&nbsp;<?php
 echo $rs['tel']?></td></tr>

<tr class="forumRow">
<td height="28" align="right">地址：</td><td>&nbsp;&nbsp;<?php
 echo $rs['addr']?>&nbsp;<span class="red">（住址或送货地址）</span></td></tr>

<?php
 /*?>
<tr class="forumRow">
  <td align="right" style="">头像：</td>
  <td style="">
  <?php echo $this->kindeditor->up_img('face','face_btu',200,200);?>
  <input readonly name="face" id="face" type="text" value="<?php
 echo $rs['face']?>" size="45" maxlength="255"><input type="button" value="浏览图片" class="button1" id="face_btu"/>
  &nbsp;&nbsp;宽：200px 高：200px </td>
</tr>
<?php
 */?>

<tr class="forumRow">
  <td height="28" align="right">备注：</td><td>&nbsp;&nbsp;<?php
 echo $rs['note'];?></td></tr>

<tr class="forumRaw">
  <td width="88" height="28" align="right" valign="top">&nbsp;</td>
  <td>&nbsp;<input type="button" class="button" value="返回" id="edit_back"/></td>
</tr>
</tbody>
</table>

</td></tr></tbody></table>
</body></html>