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
<form class="validform form-horizontal" method="post">
<table border="0" cellpadding="0" cellspacing="0" class="table">

<tr><td colspan="3" align="center">
<div class="content-text-note"><?php
 echo $nav['reg_tip'];?></div>
</td></tr>


  <tr>
    <td width="120" align="right"><?php
 echo $msgbox['name'];?>：</td>
    <td width="200" class="forumRow"><input name="nicename" type="text" id="nicename" datatype="*" nullmsg="<?php
 echo $msgtip['input'].$msgbox['name'];?>"/>
    </td>
    <td class="forumRow"><div class="validform_checktip">我们怎么称呼你？</div></td>
    </tr>
    
  <tr>
    <td align="right"><?php
 echo $msgbox['userid'];?>：</td>
    <td class="forumRow"><input name="username" type="text" id="username" datatype="s6-18" errormsg="<?php
 echo $msgbox['userid'].$msgtip['len6-18'];?>" nullmsg="<?php
 echo $msgtip['input'].$msgbox['userid'];?>"/></td>
    <td class="forumRow"><span class="validform_checktip">这个帐号用来登陆的</span></td>
    </tr>
    
  <tr>
    <td align="right"><?php
 echo $msgbox['pass'];?>：</td>
    <td class="forumRow"><input name="password" type="password" id="password" datatype="*6-18" errormsg="<?php
 echo $msgbox['pass'].$msgtip['len6-18'];?>" nullmsg="<?php
 echo $msgtip['input'].$msgbox['pass'];?>"/></td>
    <td class="forumRow"><span class="validform_checktip">有了密码帐号才安全</span></td>
    </tr>
    
  <tr>
    <td align="right"><?php
 echo $msgbox['confirm'];?><?php
 echo $msgbox['pass'];?>：</td>
    <td class="forumRow"><input name="password2" type="password" id="password2" recheck="password" errormsg="<?php
 echo $msgtip['recheck'];?>" datatype="*" nullmsg="<?php
 echo $msgtip['input'].$msgbox['confirm'].$msgbox['pass'];?>"/></td>
    <td class="forumRow"><span class="validform_checktip"></span></td>
    </tr>
    
  <tr>
    <td align="right"><?php
 echo $msgbox['email'];?>：</td>
    <td class="forumRow"><input name="email" type="text" id="email" datatype="e" errormsg="<?php
 echo $msgbox['email'].$msgtip['error'];?>" nullmsg="<?php
 echo $msgtip['input'].$msgbox['email'];?>"/></td>
    <td class="forumRow"><span class="validform_checktip"></span></td>
    </tr>
  <tr>
    <td align="right"><?php
 echo $msgbox['mobile'];?>：</td>
    <td class="forumRow"><input name="mobile" type="text" id="mobile" datatype="m" errormsg="<?php
 echo $msgbox['mobile'].$msgtip['error'];?>" nullmsg="<?php
 echo $msgtip['input'].$msgbox['mobile'];?>"/></td>
    <td class="forumRow"><span class="validform_checktip"></span></td>
    </tr>
  <tr>
    <td align="right"><?php
 echo $msgbox['tel'];?>：</td>
    <td class="forumRow"><input name="tel" type="text" id="tel" datatype="*" nullmsg="<?php
 echo $msgtip['input'].$msgbox['tel'];?>"/></td>
    <td class="forumRow"><span class="validform_checktip"></span></td>
    </tr>
  <tr>
    <td align="right"><?php
 echo $msgbox['sex'];?>：</td>
    <td class="forumRow">
    <select name="sex" id="sex">
      <option value="男">先生</option>
      <option value="女">女士</option>
    </select>
    </td>
    <td class="forumRow">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">
      <button class="btn" name="button" type="submit" id="button">
        &nbsp;<span class="icon-ok-sign"></span>&nbsp;<?php
 echo $msgbox['button'];?>&nbsp;&nbsp;
      </button>
      <span>以上的注册信息都是需要填写的哦！</span>
      <input type="hidden" name="save" value="go" />
    </td>
    </tr>
  </table>
</form>
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