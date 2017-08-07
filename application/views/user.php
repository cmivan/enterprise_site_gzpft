<?php
 $this->load->view('public/header');?>
<?php
 $this->load->view('public/validform');?>
<!-- BEGIN body -->
<body class="page page-id-109 page-template-default ie layout-2cr">

	<!-- BEGIN #container -->
	<div id="container">
		<!-- BEGIN #header -->
		<?php
 $this->load->view('public/top');?>
		<!--BEGIN #content -->
		<div id="content" class="clearfix">		
			<div class="page-title">中国个性原木家居领航者</div>
            
            <div class="clear"></div>
            
			<!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
            		
							
				<!--BEGIN .hentry -->
				<div class="hentry">	
                
					<!--BEGIN .clearfix -->
                    <div class="clearfix">		
    
                      <!--BEGIN .entry-content -->
                      <div class="entry-content">
<?php
 if(!empty($user)){?>
<form class="validform form-horizontal" method="post">
<table width="585" border="0" cellpadding="0" cellspacing="0" class="table">

  <tr>
    <td colspan="3" align="center"><div class="content-text-note"><?php
 echo $nav['user_tip'];?></div></td>
    </tr>

  <tr>
    <td align="right"><?php
 echo $msgbox['userid'];?>：</td>
    <td width="200" class="forumRow"><?php
 echo $user->username;?>
      <span class="red">(用于登录的)</span></td>
    <td class="forumRow">&nbsp;</td>
    </tr>
  <tr>
    <td width="80" align="right"><?php
 echo $msgbox['name'];?>：</td>
    <td class="forumRow">
    <input name="nicename" type="text" id="nicename" datatype="*" nullmsg="<?php
 echo $msgtip['input'].$msgbox['name'];?>" value="<?php
 echo $user->nicename;?>"/></td>
    <td class="forumRow"><div class="validform_checktip">我们怎么称呼你？</div></td>
  </tr>
  <tr>
    <td align="right"><?php
 echo $msgbox['new'];?><?php
 echo $msgbox['pass'];?>：</td>
    <td class="forumRow"><input name="password" type="password" id="password"/></td>
    <td class="forumRow"><span class="validform_checktip">如果不换密码，可以不用填写</span></td>
    </tr>
    
  <tr>
    <td align="right">&nbsp;&nbsp;<?php
 echo $msgbox['confirm'];?><?php
 echo $msgbox['pass'];?>：</td>
    <td class="forumRow"><input name="password2" type="password" id="password2" value=""></td>
    <td class="forumRow"><span class="validform_checktip"></span></td>
    </tr>
    
  <tr>
    <td align="right"><?php
 echo $msgbox['email'];?>：</td>
    <td class="forumRow">
    <input name="email" type="text" id="email" datatype="e" errormsg="<?php
 echo $msgbox['email'].$msgtip['error'];?>" nullmsg="<?php
 echo $msgtip['input'].$msgbox['email'];?>" value="<?php
 echo $user->email;?>"/>
    </td><td class="forumRow">&nbsp;</td></tr>
  <tr>
    <td align="right"><?php
 echo $msgbox['mobile'];?>：</td>
    <td class="forumRow">
    <input name="mobile" type="text" id="mobile" datatype="m" errormsg="<?php
 echo $msgbox['mobile'].$msgtip['error'];?>" nullmsg="<?php
 echo $msgtip['input'].$msgbox['mobile'];?>" value="<?php
 echo $user->mobile;?>"/>
    </td><td class="forumRow">&nbsp;</td></tr>
    
  <tr>
    <td align="right"><?php
 echo $msgbox['tel'];?>：</td>
    <td class="forumRow"><input name="tel" type="text" id="tel" value="<?php
 echo $user->tel;?>"></td>
    <td class="forumRow">&nbsp;</td>
    </tr>
   
  <tr>
    <td align="right"><?php
 echo $msgbox['addr'];?>：</td>
    <td class="forumRow"><input name="addr" type="text" id="addr" value="<?php
 echo $user->addr;?>"></td>
    <td class="forumRow"><span class="validform_checktip">住址或者送货地址</span></td>
    </tr>
    
  <tr>
    <td align="right"><?php
 echo $msgbox['sex'];?>：</td>
    <td class="forumRow">
    <select name="sex" id="sex">
      <option value="男" <?php
 if($user->sex=='男'){ echo 'selected'; }?> >先生</option>
      <option value="女" <?php
 if($user->sex=='女'){ echo 'selected'; }?> >女士</option>
    </select>
    </td>
    <td class="forumRow">&nbsp;</td>
    </tr>
  <tr>
    <td align="right"><?php
 echo $msgbox['note'];?>：</td>
    <td colspan="2">
      <textarea name="note" cols="45" rows="4" id="note" style="width:460px;"><?php
 echo $user->note;?></textarea>
      </td></tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    <button class="btn" name="button" type="submit" id="button">
      &nbsp;<span class="icon-ok-sign"></span>&nbsp;<?php
 echo $msgbox['button_update'];?>&nbsp;&nbsp;
    </button>
    <input type="hidden" name="save" value="go" />
    </td>
    <td>&nbsp;</td>
  </tr>
  </table>
</form>
<br>
<?php
 }?>
                      <!--END .entry-content -->
                      </div>
                        
                    <!--END .clearfix -->
				    </div>     
                          
				<!--END .hentry-->  
				</div>
                <!--END #primary .hfeed-->
			</div>

		<!--BEGIN #sidebar .aside-->
		<?php
 $this->load->view('public/right');?>
		<!-- END #content -->
		</div>
    <!-- END #container -->
    </div> 	
    <!-- BEGIN #footer-container -->
    <?php
 $this->load->view('public/footer');?>
<!--END body-->
</body>
<!--END html-->
</html>