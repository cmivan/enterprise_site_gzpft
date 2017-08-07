<?php if(!empty($user_power)){?>
<div class="sidebar_left">
<div class="left_login">
<?php /*?>
<div><strong><?php echo $logbox['control'];?></strong></div>
<?php */?>
<div><b><?php echo $user_power['nicename'];?> , <?php echo greetings();?></b></div>
<div><?php echo $site['welcome'];?><?php echo $site['sitename'];?> !</div>
<div class="hr">&nbsp;</div>
<div style="padding-top:4px;"><?php echo getnav($nav,'user');?> | <?php echo getnav($nav,'user/center');?> | <?php echo getnav($nav,'user/out','','login_out');?></div>
<div class="clear"></div>
</div>
</div>
<?php }?>