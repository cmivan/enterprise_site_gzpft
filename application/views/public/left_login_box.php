<?php
 if(empty($user_power)){?>
<div><strong><?php
 echo $logbox['title'];?></strong></div><br />
<div class="sidebar_left"><br />
<form class="validform" id="loginform" method="post" style="padding:0; margin:0;">
<div>&nbsp;<?php
 echo $logbox['username'];?>：<input name="username" type="text" class="login_input" id="username" datatype="s6-18" errormsg="用户名至少6个字符,最多18个字符！" nullmsg="请填写用户名！"/></div><div>&nbsp;<?php
 echo $logbox['password'];?>：<input name="password" type="password" class="login_input" id="password" datatype="*6-18" errormsg="密码范围在6~15位之间,不能使用空格！" nullmsg="请填写密码！"/></div><p style="padding-left:43px;"><a href="javascript:void(0);" id="login_submit"><?php
 echo $logbox['button'];?></a>&nbsp;&nbsp;<a href="javascript:void(0);" id="login_forget"><?php
 echo $logbox['forget'];?></a></p>
<div class="clear"></div>
</form>
</div>
<?php
 }?>