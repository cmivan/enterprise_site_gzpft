<?php $this->load->view_system('public/header');?>
</head>
<body>
<table border="0" align="center" cellpadding="0" cellspacing="10" class="forum1">
<tbody><tr><td>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="forum2 forumtop">
<form name="search" method="get">
<tbody><tr class="forumRaw"><td width="100%" align="center" class="mainTitle"><?php echo $dbtitle;?>列表</td>
<td align="center">
<table border="0" cellpadding="0" cellspacing="0" class="forum2">
<tbody><tr class="forumRaw2"><td><input name="keyword" value="<?php echo $keyword;?>" type="text" id="keyword" style="font-size: 9pt" size="25"></td>
<td align="center">
<input name="submit" type="submit" value="搜索<?php echo $dbtitle;?>" align="absMiddle" class="button">
</td></tr></tbody></table></td></tr></tbody>
</form>
</table>

<?php $this->load->view_system('template/'.$dbtable.'/nav');?>

<?php if($passCxecl!=='yes'){?>
<?php $this->load->view_system('template/'.$dbtable.'/pass');?>
<?php }else{?>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="forum2 forumtop">
<TR class="forumRow">
  <TD colspan="3" align="left" style="padding:5px;padding-left:15px;"><strong class="red">请选择导出哪些客户数据到Excel：</strong></td></TR>
<TR class="forumRow">
  <TD colspan="3" align="left" style="padding:10px;padding-left:15px;">

<strong>第一步：</strong>
<?php $this->load->view_system('public/mod/manage_type');?>
<br>


<strong>第二步：</strong>
<form name="form1" method="get" action="">
    <label><input name="customer" type="radio" id="radio" value="all" <?php if($customer!='my'){?>checked<?php }?>>所有客户</label>
    &nbsp;&nbsp;
    <label><input name="customer" type="radio" id="radio" value="my" <?php if($customer=='my'){?>checked<?php }?>>我录入的客户</label>
    &nbsp;&nbsp;&nbsp;&nbsp;
    
    录入日期：
    <label>从 <input type="text" name="date_go" id="date_go" value="<?php echo $date_go;?>"></label>
    <label>到 <input type="text" name="date_end" id="date_end" value="<?php echo $date_end;?>"></label>
    
    <input name="提交" type="submit" class="button" value="&nbsp;查看数据&nbsp;" />
    <input type="hidden" name="cmd" value="show" />
    <input type="hidden" name="typeb_id" value="<?php echo $typeB_id;?>" />
    <input type="hidden" name="types_id" value="<?php echo $typeS_id;?>" />
	<input type="hidden" value="<?php echo $keyword;?>" name="keyword" />
  </form></td>
</TR>
</TABLE>

<?php if(!empty($list)){?>
<form name="manage_box" method="post">
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="forum2">
<tbody>

<tr class="forumRaw">
<td height="40" colspan="8" style="padding:2px;padding-left:12px;">

<?php
  $excelBtn = "&nbsp;导出并下载 从";
  $excelBtn = $excelBtn . $date_go . "到" . $date_end . "期间";
  if($customer=='all'){
	  $excelBtn = $excelBtn . " 所有的客户数据！";
  }else{
	  $excelBtn = $excelBtn . " 我录入的客户数据！";
  }
?>
<input type="button" url="<?php echo reUrl('excel=down');?>" tip="确定下载报表数据？" class="btu_excel btu" value="<?php echo $excelBtn;?>" />

</td>
</tr>
<tr class="forumRaw">
<td align="center"><strong>ID</strong></td>
<td align="center"><strong>城市</strong></td>
<td><strong>&nbsp;姓名</strong></td>
<td align="center"><strong>手机</strong></td>
<td align="center"><strong>固话</strong></td>
<td align="center"><strong>邮箱</strong></td>
<td align="center"><strong>需求</strong></td>
<td align="center"><strong>录入时间</strong></td>
</tr>

<?php foreach($list as $item){?>
<tr class="forumRow">
<td height="26" align="center"><?php echo $item->id;?></td>
<td height="26" align="center"><?php echo keycolor($item->city,$keyword);?></td>
<td align="center"><?php echo keycolor($item->nicename,$keyword);?></td>
<td align="center"><?php echo $item->mobile;?></td>
<td align="center"><?php echo $item->tel;?></td>
<td align="center"><?php echo $item->email;?></td>
<td align="center"><?php echo keycolor($item->need,$keyword);?></td>
<td align="center"><?php echo $item->logintime;?></td>
</tr>
<?php }?>

</tbody></table>
</form>
<?php }else{?>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="forum2">
<tbody>
<tr class="forumRow">
<td height="80" align="center"><span class="red">没有找到相应的信息</span></td>
</tr></tbody></table>
<?php }?>

<? }?>

</td></tr></tbody></table>


<?php /*?>绑定日期<?php */?>
<link rel="stylesheet" href="<?php echo $style['js_url'];?>datepicker/css/default.css" type="text/css">
<script language="javascript" type="text/javascript" src="<?php echo $style['js_url'];?>datepicker/javascript/zebra_datepicker.cn.js"></script>
<script language="JavaScript" type="text/javascript">
//辅助函数 add by cmivan
function reNum(num){
	var strNum = String(num);
	var newNum = strNum.length;
	if(newNum==1){ strNum = '0' + strNum; }
	return strNum;
	}
function ZgetSdate(){
	var Tdata = new Date();
	var TMonth = parseInt(Tdata.getMonth());
	var TSMonth = TMonth-6;
	var TSYear = parseInt(Tdata.getFullYear());
	if(TSMonth>12){
		TSMonth = 12;
	}else if(TSMonth<=0){
		TSMonth = 1;
	}
	SData = TSYear + "-" + reNum(TSMonth) + "-" + reNum( Tdata.getDate() );
	return SData;
	}
function ZgetEdate(){
	var Tdata=new Date();
	var TMonth=parseInt(Tdata.getMonth());
	var TEMonth = TMonth + 1;
	var TYear = Tdata.getFullYear();
	if(TEMonth>12){
		TYear = parseInt(TYear)+1;
		TEMonth = parseInt(TEMonth)-12;
	}
	EData = (TYear) + "-" + reNum(TEMonth) + "-" + reNum( Tdata.getDate() );
	return EData;
	}
	
$(function(){
	var Zsdata = ''; //ZgetSdate();
	var Zedata = ''; //ZgetEdate();
    $('#date_go').Zebra_DatePicker({ direction: [Zsdata, false] });
	$('#date_end').Zebra_DatePicker({ direction: [Zedata, false] });
});
</script>
</body></html>