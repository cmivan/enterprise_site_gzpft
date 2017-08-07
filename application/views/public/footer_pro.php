<script language="javascript">
function reloadImg(d){
	var size = d.size;
	var objs = d.objs;
	objs.find('img').each(function(){
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
			var _padding = Math.round( (size-_WH_h)/2 );
			_this.css({'height':_WH_h+'px','width':size+'px','padding-top':_padding+'px'});
		}
	});
}
</script>
