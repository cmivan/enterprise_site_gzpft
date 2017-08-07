<?php $this->load->view_system('public/header');?>
</head>
<body>
<table border="0" align="center" cellpadding="0" cellspacing="10" class="forum1">
<tbody><tr><td>


<?php $this->load->view_system('template/'.$dbtable.'/nav');?>

<form class="validform" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="forum2 forumtop">
<tbody>

<?php if( is_num($rs['id']) ){?>
<tr class="forumRaw">
<td colspan="5" align="center"><strong class="red">基本信息</strong></td>
</tr>
<?php }?>

<tr class="forumRow">
<td align="right">分区：</td>
<td>
<?php
$typeB_id = '';
$typeS_id = '';
if(!empty($rs['typeB_id'])){ $typeB_id = $rs['typeB_id']; }
if(!empty($rs['typeS_id'])){ $typeS_id = $rs['typeS_id']; }
echo cm_form_type_select( $typeB ,$typeB_id,$typeS_id );
?>
</td></tr>

<tr class="forumRow">
<td align="right">城市：</td><td><input name="city" type="text" id="city" value="<?php echo $rs['city']?>" size="45">
</td></tr>

<tr class="forumRow">
<td align="right">姓名：</td><td><input name="nicename" type="text" id="nicename" value="<?php echo $rs['nicename']?>" size="45">
</td></tr>

<tr class="forumRow" style="display:none">
<td align="right">用户名：</td>
<td><input name="username" type="text" id="username" value="<?php echo $rs['username']?>" size="45">
<span class="red">（用于登录的）</span>
</td></tr>

<tr class="forumRow">
<td align="right">邮箱：</td>
<td><input name="email" type="text" id="email" value="<?php echo $rs['email']?>" size="45">
</td></tr>

<tr class="forumRow">
<td align="right">手机：</td>
<td><input name="mobile" type="text" id="mobile" value="<?php echo $rs['mobile']?>" size="45">
</td></tr>

<tr class="forumRow">
<td align="right">固话：</td><td>
<input name="tel" type="text" id="tel" value="<?php echo $rs['tel']?>" size="45">
</td></tr>

<tr class="forumRow">
<td align="right">地址：</td><td>
<input name="addr" type="text" id="addr" value="<?php echo $rs['addr']?>" size="45">
<span class="red">（住址或送货地址）</span>
</td></tr>

<?php /*?>
<tr class="forumRow">
  <td align="right" style="">头像：</td>
  <td style="">
  <?php echo $this->kindeditor->up_img('face','face_btu',200,200);?>
  <input readonly name="face" id="face" type="text" value="<?php echo $rs['face']?>" size="45" maxlength="255"><input type="button" value="浏览图片" class="button1" id="face_btu"/>
  &nbsp;&nbsp;宽：200px 高：200px </td>
</tr>
<?php */?>

  
<tr class="forumRow" style="display:none;">
  <td align="right">设置：</td>
  <td height="24">
    &nbsp;<?php echo cm_form_checkbox('封锁','ok',$rs['ok']);?>&nbsp;
    ( <span class="red">打上勾后，这个用户就不能登录了</span> )
  </td></tr>

<tr class="forumRow">
<td align="right">需求：</td><td>
  <input name="need" type="text" id="need" value="<?php echo $rs['need'];?>" size="45">
</td></tr>

<tr class="forumRow">
<td align="right"> 备注：</td>
<td>
<textarea name="note" cols="45" rows="4" id="note" style="width:460px;"><?php echo $rs['note'];?></textarea>
</td></tr>

<tr class="forumRaw">
  <td width="88" align="right" valign="top">
    <input name="id" type="hidden" value="<?php echo $rs['id']?>">
    <input name="edit" type="hidden" value="ok">
    </td>
  <td><?php $this->load->view_system('public/submit_btn');?></td>
</tr>

<tr class="forumRow" style="display:none;">
  <td align="right">强行：</td>
  <td height="24">
    <div style="padding-left:5px;">
    <div class="red" style="border-bottom:#CCC 1px solid; padding-bottom:5px; margin-bottom:6px;">注：1、在这里添加的用户，默认登录密码是：<?php echo $seo['product.pass'];?><br>
    &nbsp;&nbsp;&nbsp;&nbsp;2、打上勾后，这个用户的密码将自动初始到默认密码</div>
    <?php echo cm_form_checkbox('初始化密码','repass',0);?>
    </div>
    </td></tr>
</tbody>
</table>
</form>

</td></tr></tbody></table>
</body></html>