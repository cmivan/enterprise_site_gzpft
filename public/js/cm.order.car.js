/**
 ****************************
 * Time: 2013.07.12
 * For : Shop Order Car v1.0
 * By  : CM.ivan,QQ:394716221
 ****************************
 */
function orderCar(){
	
	var orderId = 'cmOrderCar';
	var bindObj = $('#container');
	
	//在页面底部创建购物车
	this.car = null;
	this.carBody = null;
	this.carCreate = function(){
		var carNum = parseInt( $('#' + orderId).size() );
		if(carNum>1){
			alert('该购物车已经在使用中...');
		}else{
			//var _carCss = 'line-height:24px;height:24px; padding-top:2px;';
			//_carCss = _carCss + 'background-color:#E1E1E1;border-top:#000 1px solid;color:#000;';
			var _carCss = 'line-height:20px;';
			_carCss = _carCss + 'padding-bottom:0;margin:0;width:100%;z-index:999;';
			_carCss = _carCss + 'position:fixed;bottom: 0;left:0;_position:absolute;';
			_carCss = _carCss + '_top:expression(documentElement.scrollTop + document.body.clientHeight - this.offsetHeight);';
			
			this.carBody = '<div class="shopCar">' + orderId + '</div>';
			this.carBody = '<div class="carBox">' + this.carBody + '</div>';
			this.carBody = '<div id="' + orderId + '" style="' + _carCss + '">' + this.carBody + '</div>';
			bindObj.append( this.carBody );
			
			//添加carBox属性
			var _carBoxWidth = parseInt(bindObj.width());
			$('#' + orderId).find('.carBox').css({'width':_carBoxWidth + 'px','margin':'auto','position':'relative'});
			$('#' + orderId).find('.shopCar').css({'width':'250px' + 'px','right':0,'position':'absolute'});
			this.car = $('#' + orderId);
		}
	}
	
	//拉出购物车
	
	//缩小购物车
	
	//向购物车添加物品
	this.carItemAdd = function(carId){
		
	}
	
	//从购物车删除物品
	this.carItemDel = function(carId){
		
	}
	
	//对象飞入:对象1飞向对象2
	this.objFly = function(obj1,obj2){
		
	}
}



$(function(){
	var cmCar = new orderCar();
	cmCar.carCreate();
});
