<?php $this->load->view('public/header');?>
<link href="<?php echo base_url();?>public/style/products.css" rel="stylesheet" type="text/css">

<!-- BEGIN body -->
<body id="activty_body">
<div class="activty">
<?php if(!empty($banner)){?>
<div style="margin-top:10px;">
<?php if(!empty($banner->toUrl)){?>
<a href="<?php echo $banner->toUrl;?>" target="_blank"><img src="<?php echo $banner->pic_s;?>" width="700" /></a>
<?php }else{?>
<img src="<?php echo $banner->pic_s;?>" width="700" />
<?php }?>
</div>
<?php }?>
</div>

<?php /*?>
<script language="javascript">
$(function(){
	var size = parseInt($('.activty').width());
	$('.activty').find('img').load(function(){ reLoadImg(); });
	function reLoadImg(){
		$('.activty').find('img').each(function(){
			var _this = $(this);
			var _imgW = parseInt(_this.width());
			var _imgH = parseInt(_this.height());
			var _WH_l = _imgW/_imgH;
			if(_imgH>_imgW){
				//高大于宽
				var _WH_w = Math.round( _WH_l*size );
				var _padding = Math.round( (size-_WH_w)/2 );
				_this.css({'height':size+'px','width':_WH_w+'px','padding-left':_padding+'px'});
			}else{
				//宽大于宽
				var _WH_h = Math.round( size/_WH_l );
				var _WD_h = Math.round( $(window).height() );
				var _padding = Math.round( (_WD_h-_WH_h)/2 );
				_this.css({'height':_WH_h+'px','width':size+'px','padding-top':_padding+'px'});
			}
		});
	}
});
</script>
<?php */?>


</body>
<!--END html-->
</html>