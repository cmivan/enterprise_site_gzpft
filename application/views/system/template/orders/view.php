<?php $this->load->view_system('public/header');?>
</head>
<body>
<table border="0" align="center" cellpadding="0" cellspacing="10" class="forum1">
<tbody><tr><td style="background-color:#FFFFFF; padding:12px;">

<?php $this->load->view_system('template/'.$dbtable.'/nav');?>

<div class="entry-content">
                      
<?php if(!empty($info)){?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered">
<thead>
<tr>
<td class="title"><i class="icon-shopping-cart">&nbsp;</i>产品名称</td>
<td><i class="icon-time">&nbsp;</i><span class="title">产品预览</span></td>
<td class="time"><i class="icon-time">&nbsp;</i>单价</td>
<td colspan="2" align="center" class="time"><i class="icon-info-sign">&nbsp;</i>订购数量</td>
<td class="time"><i class="icon-certificate">&nbsp;</i>合算(元)</td>
</tr>
</thead>

<tbody>
<?php $i = 1;
foreach($list as $item){
	$i++; if($i%2==0){ $iclass = "news_item news_item_hr"; }else{ $iclass = "news_item"; }
?>
<tr class="<?php echo $iclass;?>">
<td class="title">
<a target="_blank" href="<?php echo site_url('products/view/'.$item->pid);?>"><?php echo $item->title;?>
<?php if(!empty($item->pro_no)){?>(<?php echo $item->pro_no;?>)<?php }?></a></td>
<td class="time"><a target="_blank" href="<?php echo site_url('products/view/'.$item->pid);?>"><img src="<?php echo $item->pic_s;?>" width="80" /></a></td>
<td class="time"><span class="price"><?php echo $item->price;?></span></td>
<td align="center" class="changeObj"><div class="num"><?php echo $item->num;?></div></td>
<td width="40" align="center">
<?php echo $this->Products_Model->get_inventory_name($item->i_type);?>
</td>
<td class="time"><span class="total"><?php echo $item->num*$item->price;?></span></td>
</tr>
<?php }?>
</tbody>
</table>
<div class="clear"></div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered">
<thead>
<tr class="">
<td class="title">
<i class="icon-shopping-cart">&nbsp;</i>订单编号</td>
<td class="time"><i class="icon-time">&nbsp;</i>创建时间</td>
<td class="time"><i class="icon-time">&nbsp;</i>提交时间</td>
<td class="time"><i class="icon-info-sign">&nbsp;</i>状态</td>
<td class="time"><i class="icon-certificate">&nbsp;</i>总额(元)</td>
</tr>
</thead>

<tbody>
<?php if(!empty($info)){?>
<tr class="news_item news_item_hr">
<td class="title"><?php echo $info->order_no;?></td>
<td class="time"><?php echo dateTime($info->add_time);?></td>
<td class="time"><?php if($info->status=='u.shopping'){ echo '-'; }else{?><?php echo dateTime($info->add_time);?><?php }?></td>
<td class="time"><strong><?php echo $this->Orders_Model->shopping_status($info->status);?></strong></td>
<td class="time"><span class="all_total"><?php echo $this->Orders_Model->shopping_total($info->oid);?></span></td>
</tr>
<?php }?>
</tbody>
</table>
<div class="clear"></div>


<?php if(!empty($info->note_u)){?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered">
<thead><tr><td class="title">
<i class="icon-shopping-cart">&nbsp;</i>客户备注：</td>
</tr></thead><tbody>
<tr class="news_item news_item_hr">
<td class="title"><?php echo noHtml($info->note_u);?></td>
</tr></tbody></table>
<div class="clear"></div>
<?php }?>


<?php if(!empty($user)){?>
&nbsp;<strong class="red">联系方式：</strong>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered">
<tbody>
<?php if(!empty($info)){?>
<tr class="news_item news_item_hr">
<td width="200" class="title">订购单编号：</td>
<td class="time" id="order_no_diy_box">

<span id="save_ing_box"><?php echo $info->order_no_diy;?></span>

<span id="edit_ing_box"><input name="order_no_diy" type="text" id="order_no_diy" value="<?php echo $info->order_no_diy;?>">&nbsp;&nbsp;
<span id="loading"><img src="<?php echo base_url();?>public/style/system_theme/ico/loading.gif">正在保存...</span>
<span id="edit_ing">正在编辑...</span>
</span>

<script language="javascript">
$(function(){
	var is_edit_ok = false;
	$('#order_no_diy_box').hover(
	function(){
		$('#save_ing_box').fadeOut(0);
		$('#edit_ing_box').fadeIn(200);
		$('#edit_ing').fadeIn(0);
		$('#loading').fadeOut(0);
		},
	function(){
		if(is_edit_ok==false){
			var order_no_diy;
			$('#loading').fadeIn(0);
			$('#edit_ing').fadeOut(0);
			order_no_diy = $('#order_no_diy').val();
			$.post("<?php echo site_system('orders/re_order_no_diy');?>",{"oid":"<?php echo $info->oid;?>","order_no_diy":order_no_diy},
			function(e){
				if(e.cmd=='y'){
					$('#edit_ing_box').fadeOut(0);
					$('#loading').fadeOut(0);
					$('#save_ing_box').fadeIn(200).text(e.info);
				}else{
					alert(e.info);
				}
				},'json');
		}
		}
	);
	});
</script>

</td></tr>
<tr class="news_item news_item_hr">
<td width="200" class="title">姓名：</td>
<td class="time"><?php echo $user->nicename;?></td>
</tr>
<tr class="news_item news_item_hr">
  <td class="title">联系手机：</td>
  <td class="time"><?php echo $user->mobile;?></td>
  </tr>
<tr class="news_item news_item_hr">
  <td class="title">联系电话：</td>
  <td class="time"><?php echo $user->tel;?></td>
  </tr>
<tr class="news_item news_item_hr">
  <td class="title">邮箱：</td>
  <td class="time"><?php echo $user->email;?></td>
  </tr>
<tr class="news_item news_item_hr">
  <td class="title">送货地址：</td>
  <td class="time"><?php echo $user->addr;?></td>
  </tr>
<?php }?>
</tbody>
</table>
<div class="clear"></div>
<?php }?>



<?php if(strpos($info->status,'.ok.')<=0){?>
<form class="validform" method="post">
&nbsp;<strong class="red">处理订单：</strong>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered">
<tbody>
<?php if(!empty($info)){?>
<tr class="news_item news_item_hr">
<td width="200" class="title">处理：</td>
<td>
<table width="200" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><label><input type="radio" name="sended" id="radio" value="ok">已发货</label></td>
    <td><label><input type="radio" name="sended" id="radio" value="no">未发货</label></td>
    </tr>
  </table>

</td>
</tr>
<tr class="news_item news_item_hr">
  <td class="title">备注：</td>
  <td>
    <textarea name="note" rows="6" id="note" style="width:400px;"></textarea></td>
  </tr>
<tr class="news_item news_item_hr">
  <td class="title">&nbsp;</td>
  <td><?php $this->load->view_system('public/submit_btn');?><input type="hidden" name="oid" value="<?php echo $info->oid;?>"></td>
</tr>
<?php }?>
</tbody>
</table>
</form>
<?php }else{?>

&nbsp;<strong class="red">订单处理结果：</strong>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered">
<tbody>
<?php if(!empty($info)){?>
<tr class="news_item news_item_hr">
<td width="200" class="title">处理：</td>
<td>
<?php echo $this->Orders_Model->shopping_status($info->status);?>
</td>
</tr>

<?php if(!empty($info->note_a)){?>
<tr class="news_item news_item_hr"><td class="title">备注：</td><td><?php echo $info->note_a;?></td></tr>
<?php }?>
  
<?php }?>
</tbody>
</table>

<?php }?>
<div class="clear"></div>




<?php }else{?>
<div class="no_info"><strong>还没有订单哦～</strong><br><br></div>
<?php }?>
</div>

</td></tr></tbody></table>


<link href="<?php echo base_url();?>public/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<style type="text/css">
div,td{
word-break:break-all;word-wrap:break-word;
}
.all_total{
	color:#F00;
	font-weight:bold;
	}
.changeObj{
	width:93px;
	height:30px;
	line-height:30px;
	overflow:hidden;
	}
.changeObj .num{ }
.changeObj .num input{
	width:65px;
	height:18px;
	line-height:18px;
	text-align:center;
	font-weight:bold;
	border:#F63 1px solid;
	border-bottom:#fff 1px solid;
	border-right:#fff 1px solid;
	background-color:#FC9;
	}
</style>

</body></html>