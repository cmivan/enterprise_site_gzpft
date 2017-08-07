<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="forum2 forumtop"><tbody>
  <tr class="forumRaw"><td height="200">
  
<form name="pass" method="post">
<table border="0" align="center" cellpadding="3" cellspacing="1" class="forum2"><tbody><tr class="forumRow">
<td width="115" height="28" align="right">请先输入<?php echo $passTitle;?>密码：</td><td><input type="password" name="pass" id="pass"></td><td width="80"><input name="tijiao" type="submit" class="button" id="edit_back" value="验证<?php echo $passTitle;?>密码"/></td>
</tr>
<?php if(!empty($passTip)){?>
<tr class="forumRow">
<td height="28" colspan="3" align="center" class="red">提示：<?php echo $passTitle.$passTip;?></td>
</tr>
<?php }?>
</tbody>
</table>
</form>

</td></tr></tbody></table>
