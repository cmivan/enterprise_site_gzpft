<div class="enquiry-form-box">
<form class="form-horizontal validform" id="regform" method="post">
<div class="enquiry-form-item">
<dd><?php
 echo $msgbox['name'];?>：</dd><dt>
<input name="nicename" type="text" class="generic-box" id="nicename" datatype="*" nullmsg="<?php
 echo $msgtip['input'].$msgbox['name'];?>"/>
</dt>
</div>
<div class="enquiry-form-item">
<dd><?php
 echo $msgbox['userid'];?>：</dd><dt><input name="username" type="text" class="generic-box" id="username" datatype="s6-18" errormsg="<?php
 echo $msgbox['userid'].$msgtip['len6-18'];?>" nullmsg="<?php
 echo $msgtip['input'].$msgbox['userid'];?>"/></dt>
</div> 
<div class="enquiry-form-item">
<dd><?php
 echo $msgbox['pass'];?>：</dd><dt><input name="password" type="password" class="generic-box" id="password" datatype="*6-18" errormsg="<?php
 echo $msgbox['pass'].$msgtip['len6-18'];?>" nullmsg="<?php
 echo $msgtip['input'].$msgbox['pass'];?>"/></dt>
</div> 
<div class="enquiry-form-item">
<dd><?php
 echo $msgbox['email'];?>：</dd><dt><input name="email" type="text" class="generic-box" id="email" datatype="e" errormsg="<?php
 echo $msgbox['email'].$msgtip['error'];?>" nullmsg="<?php
 echo $msgtip['input'].$msgbox['email'];?>"/></dt>
</div>
<div class="enquiry-form-item">
<dd><?php
 echo $msgbox['mobile'];?>：</dd><dt><input name="mobile" type="text" class="generic-box" id="mobile" datatype="m" errormsg="<?php
 echo $msgbox['mobile'].$msgtip['error'];?>" nullmsg="<?php
 echo $msgtip['input'].$msgbox['mobile'];?>"/></dt>
</div>
<div class="enquiry-form-item">
<dd><?php
 echo $msgbox['tel'];?>：</dd><dt><input name="tel" type="text" class="generic-box" id="tel" datatype="*" nullmsg="<?php
 echo $msgtip['input'].$msgbox['userid'];?>"/></dt>
</div>
<div class="enquiry-form-item">
<dd>&nbsp;</dd><dt><button name="button" type="submit" class="btn submit_btn" id="button"><?php
 echo $msgbox['button'];?></button></dt>
</div>     
</form>
</div>