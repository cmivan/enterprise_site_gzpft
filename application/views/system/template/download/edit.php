<?php
 $this->load->view_system('public/header');?>
</head>
<body>
<table border="0" align="center" cellpadding="0" cellspacing="10" class="forum1">
<tbody><tr><td>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="forum2 forumtop">
<tbody><tr class="forumRaw"><td align="center"><?php
 echo $dbtitle;?> 更新/录入</td>
</tr></tbody></table>

<form class="validform" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="forum2">
<tbody><tr class="forumRow">
    <td align="right">文件标题：</td><td><input name="title" type="text" id="title" value="<?php
 echo $rs['title']?>" size="45">
</td></tr>

<tr class="forumRow">
<td align="right" style="">文件地址：</td>
<td style="">
<?php echo $this->kindeditor->up_file('pic_s','pic_s_btu',190,130);?>
<input readonly name="pic_s" id="pic_s" type="text" value="<?php
 echo $rs['pic_s']?>" size="45" maxlength="255"><input type="button" value="浏览文件" class="button1" id="pic_s_btu"/>
<script> $(function(){$('#pic_s').unbind('mousemove');}); </script>
&nbsp; </td></tr>

<tr class="forumRow" style="display:none">
  <td align="right" style="">内容：</td><td><?php
 /*?>编辑器<?php
 */?>
  <?php echo $this->kindeditor->js_full('content',$rs['content'],'98%','350px');?>
</td></tr>

<tr class="forumRow" style="display:none">
<td align="right">简述：</td>
<td>
<textarea name="note" cols="45" id="note" style="width:80%; height:50px;"><?php
 echo $rs['note']?></textarea>
<br>&nbsp;<span class="red">注：不是必要的，但是适当的描述有利于优化</span>
</td></tr>

<tr class="forumRow"><td align="right">排序：</td>
<td><input type="text" name="order_id" id="order_id" value="<?php
 echo $rs['order_id'];?>"></td>
</tr>

<tr class="forumRaw">
  <td width="88" align="right" valign="top">
    <input name="id" type="hidden" value="<?php
 echo $rs['id']?>">
    <input name="edit" type="hidden" value="ok">
    </td>
  <td><?php
 $this->load->view_system('public/submit_btn');?></td>
</tr>

</tbody>
</table>
</form>

</td></tr></tbody></table>
</body></html>