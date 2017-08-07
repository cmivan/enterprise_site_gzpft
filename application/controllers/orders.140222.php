<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends U_Controller {
	
	public $table = 'orders';
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('orders');
		
		$this->load->model('Orders_Model');
		$this->load->helper('gzpft_val');
	}

	function index($key='')
	{
		if($key!=''){ $key = $this->Orders_Model->get_orders_status($key,'key'); }
		
		//判断并取消订单
		$cmd = $this->input->get('cmd');
		$oid = $this->input->getnum('oid');
		if($cmd=='del'&&$oid)
		{
			$this->Orders_Model->orders_cancel($oid);
		}
		
		//读取该分类下的产品
		$listsql = $this->Orders_Model->orders_list($key);
		//读取列表
		$this->load->library('Paging');
		$this->data["list"] = $this->paging->show( $listsql ,15);
		
		//输出到视窗
		$this->load->view($this->table,$this->data);
	}
	

	//有效的订单，已取消
	function ok(){
		$this->index('a.ok.shipment');
	}
	
	//失效的订单,未发货
	function notshipment(){
		$this->index('a.ok.notshipment');
	}

	//失效的订单，已取消
	function cancel(){
		$this->index('u.ok.del');
	}

	
	//当前购物车清单
	function car()
	{
		$view = $this->Orders_Model->shopping_view();
		if(!empty($view)){
			if(!empty($view)){
				$this->data['info'] = $view['info'];
				$this->data['list'] = $view['list'];
			}
		}
		$this->load->view($this->table.'_shopping_view',$this->data);
	}
	
	//向订单添加产品
	function add()
	{
		$pid = $this->input->postnum('pid',0);
		$md5= $this->input->post('md5');
		if($pid==0||pass_key($pid)!=$md5){
			json_form_no('非法键值,操作无效!');
		}
		
		//检测当前是否有使用中的购物车
		$row = $this->Orders_Model->shopping_info_view();
		if(!empty($row)){
			//有购物车的情况下,找购物车下的产品
			$id = $this->Orders_Model->shopping_pro_add($row->oid,$pid);
			orderAddTip( $id );
		}else{
			//未有购物车的情况下,创建购物车并获取订单ID
			$oid = $this->Orders_Model->shopping_car_add();
			if(is_num($oid)){
				//添加产品到订单下
				$id = $this->Orders_Model->shopping_pro_add($oid,$pid);
				orderAddTip( $id );
			}else{
				json_form_no('服务器可能在忙着,请先看看其他产品!');
			}
		}
	}

	//购物车物品或数量
	function del()
	{
		$pid = $this->input->postnum('pid',0);
		$md5 = $this->input->post('md5');
		if($pid==0||pass_key($pid)!=$md5){
			json_form_no('非法键值,参数无效!');
		}
		
		$pro_del = $this->Orders_Model->shopping_pro_del($pid);
		if($pro_del){
			json_form_yes('成功删除!');
		}else{
			json_form_no('操作无效!');
		}
	}

	//获取指定产品的当前库存
	function all_num()
	{
		$pid = $this->input->postnum('pid',0);
		$md5 = $this->input->post('md5');
		if($pid==0||pass_key($pid)!=$md5){
			json_form_no('非法键值,参数无效!');
		}
		$pro = $this->Products_Model->view($pid);
		if(!empty($pro))
		{
			$pronum = $pro->price_vip;
			if(is_num($pronum)){ json_form_yes($pronum); }
		}
		json_form_no('操作无效!');
	}
	
	
	function view($id=0)
	{
		$id = get_num($id,'404');
		$_view = false;
		$view = $this->Orders_Model->orders_view($id);
		if(!empty($view)){
			if(!empty($view)){
				$this->data['info'] = $view['info'];
				$this->data['list'] = $view['list'];
				if($view['info']->status!='u.shopping'){ $_view = true; }
			}
		}
		if($_view===true){
			$this->load->view($this->table.'_unlook_view',$this->data);
		}else{
			$this->load->view($this->table.'_shopping_view',$this->data);
		}
	}

	
	//购物车物品或数量
	function shopcar($cmd='')
	{
		//$md5 = $this->input->post('md5');
		$md5 = $this->input->get('md5');
		
		//初始化数据
		$num = 0;
		$md5key = '';
		$lists = '';
		$keys = '';
		
		//读取购物车
		$shopCar = $this->Orders_Model->shopping_view();
		if(!empty($shopCar)){
			if(!empty($shopCar['info'])&&!empty($shopCar['list'])){
				$list = $shopCar['list'];
				$num = $shopCar['count'];
			}
		}
		
		//******** 获取产品ID MD5,用于判断数据是否有更新
		if(!empty($list)){
			foreach($list as $rs){ $keys.= '@'.$rs->pid; }
			if(!empty($keys)){
				$keys.= '@';
				$md5key = pass_key($keys);
			}
		}
		
		//******** 获取订单清单
		if(!empty($list)){
			foreach($list as $rs){
				$_list_l = '<div class="l"><a href="'.site_url('products/view/'.$rs->pid).'" target="_block">';
				$_list_l.= '<img src="'.$rs->pic_s.'" width="30" /></a></div>';
				
				$_list_c = '<div class="c"><div>'.$rs->title.'</div>';
				$_list_c.= '<div class="n">'.$rs->size_z.'\\'.$rs->size_w.'\\'.$rs->size_h.'</div></div>';
				
				$_list_r = '<div class="r"><em>';
				$_list_r.= '<a href="javascript:void(0);" pid="'.$rs->pid.'" md5="'.pass_key($rs->pid).'">&nbsp;</a>';
				$_list_r.= '</em><div>'.$rs->price.'元</div></div>';
				
				$lists.= '<li>'.$_list_l.$_list_c.$_list_r.'</li>';
			}
		}
		if(!empty($lists)){
			$lists = '<ul>'.$lists.'</ul>';
			$lists = '<div class="carCl" id="carTitle">朴.购物车 v1.0</div>'.$lists;
			$lists = $lists.'<div class="carCl" id="carShopBtn"><a href="'.site_url('orders/car').'" target="_block">&nbsp;</a></div>';
			$lists = $lists.'<div class="carCl" id="carFooter">&nbsp;</div>';
			}
		
		//返回数据
		$back = array(
				'md5' => $md5key,
				'num' => $num,
				'lists' => $lists,
				'keys' => $keys
				);
		json_back($back);
	}
	
	//订单处理事件
	function action(){
		$cmd = $this->input->post('cmd');
		$orders = $this->input->post('orders');
		
		$keys = '';
		if(!empty($orders)){
			$_orders = explode("@",$orders);
			if(is_array($_orders)&&!empty($_orders)){
				foreach($_orders as $item){
					$_pro = explode("$",$item);
					//提取数组
					if(!empty($_pro)){
						$id  = get_num( $_pro[0] );
						$idmd5= getInuptName($id);
						$md5 = $_pro[1];
						$num = get_num( $_pro[2] );
						if($id==false||$num==false||$num<=0){
							json_form_no('参数有误!');
						}elseif( $idmd5!=$md5){
							json_form_no('数据被篡改,操作无效!');
						}
						//更新数据
						$pid = $this->Orders_Model->shopping_pro_update($id,$num);
						$keys.= '@'.$pid;
					}
				}
			}
		}
		//该步骤确保更新完成
		$md5key_1 = orderPassKey($keys);
		
		//读取购物车
		$shopCar = $this->Orders_Model->shopping_view();
		if(!empty($shopCar)){
			if(!empty($shopCar['info'])&&!empty($shopCar['list'])){
				$oid = $shopCar['info']->oid;
				$list= $shopCar['list'];
				$num = $shopCar['count'];
			}
		}
		//获取产品ID MD5,用于判断数据是否有更新
		$keys = '';
		if(!empty($list)){
			foreach($list as $rs){ $keys.= '@'.$rs->pid; }
			$md5key_2 = orderPassKey($keys);
		}
		//更新状态,设置订单已经提交
		if($md5key_1==$md5key_2){
			if(is_num($oid)){
				$back = $this->Orders_Model->set_orders_status($oid,'a.unlook');
				if($back){
					json_form_yes('订单提交成功,管理员将于72小时内审核处理!');
				}
			}else{
				json_form_no('未能找到该订单信息!');
			}
		}
		json_form_no('订单未等提交,请稍候再试!');
	}
	

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */