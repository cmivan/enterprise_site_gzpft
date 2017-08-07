<?php $this->load->view('public/header');?>
<link href="<?php echo base_url();?>public/style/products.css" rel="stylesheet" type="text/css">

<!-- BEGIN body -->
<body class="page page-template-template-portfolio-php ie layout-2cr">

	<!-- BEGIN #container -->
	<div id="container">
	
		<!-- BEGIN #header -->
		<?php $this->load->view('public/top');?>
		<!--BEGIN #content -->
<div id="content" class="clearfix">

<div class="page-title">艺术木境&nbsp;-&nbsp;意象随形</div>
<div class="clear"></div>

<?php if(!empty($typebox)){?>
<ul id="products">
 <?php foreach($typebox as $type){?>
    <?php if(!empty($type)){?>
    <li>
      <div class="t"><div class="title"><?php echo $type['type']->type_title_2;?></div><div class="more"><a href="<?php echo site_url('products/lists');?>?p_type_id=<?php echo $type['type']->type_id;?>" title="<?php echo $type['type']->type_title_2;?>" target="_blank">更多...</a></div></div>
      <?php if(!empty($type['type']->type_pic)){?>
      <div class="pic"><img src="<?php echo $type['type']->type_pic;?>" width="940" height="260"/></div>
      <?php }?>
      
      <?php if(!empty($type['types'])){?>
      <ul class="list">
         <?php foreach($type['types'] as $item){
			 $_zwh = orderShowSize($item->size_z,$item->size_w,$item->size_h);
			 ?>
         <li><div><a href="<?php echo site_url('products/view/'.$item->id);?>" title="<?php echo $item->title;?>" target="_blank"><img alt="<?php echo $item->title;?>" src="<?php echo $item->pic_s;?>" width="165"/></a></div>
         <p class="title"><a href="<?php echo site_url('products/view/'.$item->id);?>" title="<?php echo $item->title;?>" target="_blank"><?php echo $item->title;?></a></p>
         <?php if(!empty($item->material)){?><p>材质：<?php echo $item->material;?></p><?php }?>
         <p title="长宽高:<?php echo $_zwh;?>">尺寸：<?php echo $_zwh;?></p>
         <?php if(!empty($item->price)){?><p class="price">价格：<span><?php echo $item->price;?></span> 元</p><?php }?>
         <?php if(!empty($item->i_title)){?><p>库存：<span><?php echo $item->price_vip;?></span> <?php echo $item->i_title;?></p><?php }?>
         <?php if(!empty($item->pro_no)){?><p>编号：<?php echo $item->pro_no;?></p><?php }?>
         </li>
         <?php }?>
      </ul>
      <?php }?>
    </li>
    <?php }?>
<?php }?>

</ul>
<?php }?>

<!-- END #content -->
</div>
<!-- END #container -->
</div> 	
    
<!-- BEGIN #footer-container -->
<?php $this->load->view('public/footer');?>
<?php $this->load->view('public/footer_pro');?>
<script language="javascript">
$(function(){ reloadImg({'objs':$('#products li div'),'size':165}); });
</script>
<!--END body-->
</body>
<!--END html-->
</html>