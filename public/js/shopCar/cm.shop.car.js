/**
 ****************************
 * Time: 2013.07.12
 * For : Shop Order Car v1.0
 * By  : CM.ivan,QQ:394716221
 ****************************
 */
 
function orderCar(){
	
	var $shopCarId= 'cmShopCar';
	var $bindObj  = $('#container');
	var $this  = $('#container');
	var $closeCarHeight = 8;
	
	//在页面底部创建购物车
	this.car = null;
	this.carBox = null;
	this.carBody = null;
	this.carDock = null;
	this.shopCar = null;
	$this = this;
	
	this.carCreate = function(){
		var carNum = parseInt( $('#' + $shopCarId).size() );
		if(carNum>=1){
			alert('该购物车已经在使用中，不能重复创建...');
		}else{
			var _bind_L = parseInt( $bindObj.offset().left );
			var _bind_W = parseInt( $bindObj.width() );
			var _shopCar_W = 280,_shopCar_H = 200;
			var _carDockBody = '<div class="carDock"><a href="/orders" target="_blank">购物车物品 <b></b></a><em>&nbsp;</em><p>&nbsp;</p></div>';
			//添加carBox框架元素
			this.carBody = '<div class="shopCar">Cmshop Car v1.0 <b>Loading...</b></div>';
			this.carBody = '<div class="carBox">'+this.carBody+'</div>';
			this.carBody = this.carBody + _carDockBody;
			this.carBody = '<div id="'+$shopCarId+'">'+this.carBody+'</div>';
			$bindObj.append( this.carBody );
			//添加carBox属性
			this.car = $('#' + $shopCarId);
			this.carBox = this.car.find('.carBox');
			_shopCar_W = parseInt( this.car.width() );
			this.car.css({'left':(_bind_W+_bind_L-_shopCar_W)+'px'});
			this.carBox.css({'width':(_shopCar_W-8)+'px'});
			//重获取对象
			this.car = $('#' + $shopCarId);
			this.carBox = this.car.find('.carBox');
			this.shopCar = this.carBox.find('.shopCar');
			this.carDock = this.car.find('.carDock');
			
			//初始化显示状态
			this.carClose();
			//绑定基本的按钮事件
			this.carDockBtn(); /*购物车展开按钮*/
			this.carItemAdd(); /*添加产品按钮*/
		}
	}
	//获取车库高度
	this.carHeight = function(){
		var _H = 450,_M = 0;
		var _height = $('.carBox').height();
		if(_height>_H){
			_height = _H;
			//第一层
			_M = _M + parseInt( this.shopCar.css('padding-top') );
			_M = _M + parseInt( this.shopCar.css('padding-bottom') );
			//第二层
			this.shopCar.find('.carCl').each(function(){
				$(this).css({'margin-top':0,'margin-bottom':0});
				_M = _M + parseInt( $(this).height() );
				_M = _M + parseInt( $(this).css('padding-top') );
				_M = _M + parseInt( $(this).css('padding-bottom') );
			});
			this.shopCar.find('ul').css({'height':(_H-_M)+'px','overflow':'auto'});	
		}
		return _height;
	}
	//购物车展开按钮
	this.carDockBtn = function(){
		this.carDock.click(function(){
			var _isOpen = $(this).find('p').attr('class');
			if(_isOpen=='on'){
				$this.carClose();
			}else{
				$this.carOpen();
			}
		});
		return this;
	}
	this.carUpdate = function(e){
		//验证数据,判断有更新后打开购物车
		$this.carLoad(function(data){ 
			 //写入数据
			 if(data!=''){
				 //更新数据
				 $CAR = data;
				 //设置购买按钮属性
				 $this.carSetSel('buy-car');
				 
				 //显示数量
				 $this.carDock.find('a b').html(data.num);
				 //添加md5值
				 $this.carDock.attr('carmd5',data.md5);
				 //添加购物车清单
				 $this.shopCar.html( data.lists );
				 $this.carDock.find('em').fadeOut(300);
				 //绑定删除按钮
				 $this.carItemDel();
				 if(e=='open'){
					 $this.carOpen();
				 }else if(e=='close'){
					 $this.carClose();
				 }else{
					 $this.carReHeight();
				 }
			}else{
				 $this.carClose();
			} 
		});
		return this;
	}
	//在当前状态下,重新加载高度
	this.carReHeight = function(){
		var _on = this.carDock.find('p').attr('class');
		if(_on==='on'){
			this.carOpen();
		}else{
			this.carClose();
		}
	}
	//拉出购物车
	this.carOpen = function(){
		var _height = parseInt(this.carHeight());
		this.carDock.find('p').attr('class','on');
		if(_height<30){
			this.carClose();
		}else{
			this.carBox.animate({top: -(_height-30)+"px"}, {duration: 300});
		}
		return this;
	}
	//收起购物车
	this.carClose = function(){
		this.carDock.find('em').fadeOut(0);
		this.carDock.find('p').attr('class','');
		this.carBox.animate({top: '-'+$closeCarHeight+'px'}, {duration: 300});
		return this;
	}
	//加载购物车信息
	this.carLoad = function(fun){
		//显示Loading
		$this.carDock.find('em').fadeIn(0);
		$.ajax({
			   type:'POST',
			   url:'/orders/shopcar.htm',
			   data:{'md5':$CAR.md5},
			   dataType:'json',
			   success:function(da){
				   $this.carDock.find('em').fadeOut(0);
				   fun(da); //调用函数
			   },
			   error:function(){ $this.carClose(); }
		});
		return this;
	}
	//向购物车添加物品
	this.carItemAdd = function(){
		$('#buy-car').click(function(){
			var pid = $PRO.pid,md5=$PRO.md5;
			if(pid==parseInt(pid)){
				$.ajax({
					type:'POST',
					url:'/orders/add.htm',
					data:{'pid':pid,'md5':md5},
					dataType:'json',
					success:function(data){
						if(data.cmd=='y'){
							$this.carUpdate();
						}else{
							alert(data.info);
						}
					}
				});
			}else{
				alert('添加失败,无法获取产品ID');
			}
		});
		return this;
	}
	//从购物车删除物品
	this.carItemDel = function(){
		this.shopCar.find('.r').find('a').click(function(){
			var pid = $(this).attr('pid'),md5=$(this).attr('md5');
			if(pid==parseInt(pid)){
				$.ajax({
					type:'POST',
					url:'/orders/del.htm',
					data:{'pid':pid,'md5':md5},
					dataType:'json',
					success:function(data){
						if(data.cmd=='y'){
							$this.carUpdate('open');
						}else{
							alert(data.info);
						}	
					}
				});
			}else{
				alert('添加失败,无法获取产品ID');
			}
		});
		return this;
	}
	
	//判断产品是否已经被选中,若选中,则取消购买按钮
	this.carSetSel = function(key){
		//将按钮设置成不可点击
		var pid = $PRO.pid;
		if(pid!=""&&pid==parseInt(pid)){
			var p_pid = '@'+pid+'@';
			var p_pids= '@'+$CAR.keys;
			if(p_pids.indexOf(p_pid)>0){
				//包含
				$('#'+key).css({'display':'none'});
				$('#'+key+'-disabled').css({'display':'block'});
			}else{
				//不包含
				$('#'+key).css({'display':'block'});
				$('#'+key+'-disabled').css({'display':'none'});
			}
		}
	}
	
	//对象飞入:对象1飞向对象2
	this.objFly = function(obj1,obj2){
		
	}
}