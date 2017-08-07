<div class="clear"></div>

<div id="footer-container">
<!-- BEGIN #footer -->
<div id="footer" class="clearfix">
<p class="copyright">&copy; Copyright 2012.by <?php echo $site['sitename'];?>
&nbsp;&nbsp;
粤ICP备12012738号</p>
<p class="credit">
<?php echo getnav($nav,'index');?> | <?php
 if(!empty($user_power)){?><?php echo getnav($nav,'products');?><?php
 }else{?><?php echo getnav($nav,'products',$logbox['title']);?><?php
 }?> | <?php echo getnav($nav,'products/news');?> | <?php echo getnav($nav,'about_us');?> | <?php echo getnav($nav,'cooperation');?> | <?php echo getnav($nav,'news');?> | <?php echo getnav($nav,'contact');?>
</p>

<div style="text-align:center; text-align:right;"><a href="http://www.qxad.com" target="_blank"><img src="<?php echo base_url();?>public/images/pft/ad.jpg" height="30" /></a></div>
<!-- END #footer -->
</div>	
<!-- END #footer-container -->
</div>
<?php
 /*?><!-- Theme Hook -->
<script type='text/javascript' src="<?php echo base_url();?>public/js/jquery.custom.js"></script>
<?php
 */?>

<script type="text/javascript" src="<?php echo $style['js_url'];?>jquery_rolling.js"></script>
<script type="text/javascript" src="<?php echo $style['js_url'];?>validform/js/validform.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $style['js_url'];?>validform/css/css.css" />

<script type="text/javascript">
$(function(){
   <!--绑定表单-登录-->
   $("#loginform").validform({
	  tiptype:1,ajaxurl:'<?php echo site_url('action/do_login');?>',
	  callback:function(data){
		  if(data.cmd=="y"){
			  setTimeout(function(){
								  $.Hidemsg();
								  window.location.href='<?php echo site_url('products/lists');?>';
								 /* window.location.reload();*/
								  },2000);
		  }else if(data.cmd=="n"){
			  setTimeout(function(){ $.Hidemsg(); },2000);
		  }
	  }
   });
   <!--登录-->
   $('#login_submit').click(function(){ $('#loginform').submit(); });
   <!--找回密码-->
   $('#login_forget').click(function(){ alert('<?php echo $logbox['forgetTip'];?>');  });  
   <!--退出登录-->
   $('.login_out').click(function(){ if(confirm('您想注销这次的登录吗？')){ return true; }else{ return false; } });
   //top nav
   $('#menu-mainmenu li').hover(
		 function(){
			 var s = parseInt($(this).find('ul').find('li').size());
			 if(s>0){ $(this).find('ul').css({'display':'block'}); }
		 },
		 function(){
			 var s = parseInt($(this).find('ul').find('li').size());
			 if(s>0){ $(this).find('ul').css({'display':'none'}); }
		 }
	);
});
</script>

<script language="javascript" src="<?php echo site_url('cm_stat/online');?>"></script>
<script type='text/javascript'>
(function() {
    var c = document.createElement('script'); 
    c.type = 'text/javascript';
    c.async = true;
    c.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'www.clicki.cn/boot/47319';
    var h = document.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(c, h);
})();
</script>