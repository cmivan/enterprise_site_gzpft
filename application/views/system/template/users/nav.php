<?php
 if( is_num($rs['id']) ){?>
<style>a.on{ font-weight:bold; color:#fff; background-color:#C33;}</style>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="forum2 forumtop">
<tbody>

<tr class="forumRaw">
  <td align="center">
  <a href="<?php
 echo reUrl('v=null&page=null&tab=base');?>" <?php
 if($tab=='base'){echo ' class="on"';}?>>基本信息</a>
  |
  <a href="<?php
 echo reUrl('v=null&page=null&tab=login');?>" <?php
 if($tab=='login'){echo ' class="on"';}?>>登录情况</a>
  |
  <a href="<?php
 echo reUrl('v=null&page=null&tab=ip');?>" <?php
 if($tab=='ip'){echo ' class="on"';}?>>IP记录</a>
  |
  <a href="<?php
 echo reUrl('v=null&page=null&tab=visit');?>" <?php
 if($tab=='visit'){echo ' class="on"';}?>>访问情况</a>
  </td>
</tr>

<tr class="forumRaw">
  <td align="center">
  当前会员：<strong class="red"><?php
 echo $rs['nicename']?></strong>
  &nbsp; - &nbsp;
  注册时间：<span class="red"><?php
 echo $rs['regtime']?></span>
  </td></tr>

</tbody></table>
<?php
 }else{?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="forum2 forumtop">
<tbody><tr class="forumRaw">
  <td align="center"><?php
 echo $dbtitle;?> 录入</td>
</tr></tbody></table>
<?php
 }?>