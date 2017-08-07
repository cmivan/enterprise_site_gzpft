<?php
class Orders_Model extends CI_Model {

    public $uidtype = '';
 
    function __construct()
    {
        parent::__construct();
    }

	//获取当前用户的所有订单
	function orders_list($type='')
	{
		$this->db->select('orders.*,users.*');
		$this->db->from('orders');
		$this->db->join('users','users.id=orders.uid','left');
		if(!empty($type)){
			$this->db->select('orders_status.*');
			$this->db->join('orders_status','orders.status=orders_status.key','left');
			$this->db->where('orders_status.key',$type);
		}
		if($this->uidtype!='null'){
		   $this->db->where('orders.uid',$this->logid);
		}
		$this->db->group_by('orders.oid');
		$this->db->order_by('orders.oid','desc');
		return $this->db->getSQL();
	}
		
	//****************************
	//获取当前登录用户的购物车列表
	//****************************
	function shopping_view()
	{
		$list = NULL;
		$order = $this->shopping_info_view();
		if(!empty($order)){
			//获取产品列表
			$list['info'] = $order;
			$list['list'] = $this->shopping_pro_list( $order->oid );
			$list['count']= $this->shopping_pro_list( $order->oid , 'count' );
		}
		return $list;
	}
	
	//****************************
	//获取当前登录用户的购物车信息(正在购物的)
	//****************************
	function shopping_info_view()
	{
		  $this->db->select('*');
		  $this->db->from('orders');
		  if($this->uidtype!='null'){
		     $this->db->where('uid',$this->logid);
		  }
		  $this->db->where('status','u.shopping');
		  $this->db->limit(1);
		  return $this->db->get()->row();
	}
	
	//****************************
	//获取当前登录用户的购物车列表
	//****************************
	function orders_view($oid='')
	{
		$list = NULL;
		$order = $this->orders_info_view($oid);
		if(!empty($order)){
			//获取产品列表
			$list['info'] = $order;
			$list['list'] = $this->shopping_pro_list( $order->oid );
			$list['count']= $this->shopping_pro_list( $order->oid , 'count' );
		}
		return $list;
	}
	
	//获取当前登录用户的某订单信息(已经提交的)
	function orders_info_view($oid='')
	{
		  $this->db->select('*');
		  $this->db->from('orders');
		  $this->db->where('oid',$oid);
		  if($this->uidtype!='null'){
		     $this->db->where('uid',$this->logid);
		  }
		  $this->db->limit(1);
		  return $this->db->get()->row();
	}
	
	//获取当前登录用户的购物车的产品清单
	function shopping_pro_list($oid='',$cmd='')
	{
		if(is_num($oid)){
			$this->db->select('*');
			$this->db->from('products');
			$this->db->join('orders_list','products.id=orders_list.pid','left');
			$this->db->where('orders_list.oid',$oid);
			$this->db->group_by('orders_list.id');
			$this->db->order_by('orders_list.id');
			if($cmd=='count'){
				return $this->db->get()->num_rows();
			}else{
				return $this->db->get()->result();
			}
		}
	}
	
	//获取当前登录用户的购物车的产品清单总费用
	function shopping_total($oid='')
	{
		$total = 0;
		if(is_num($oid)){
			$this->db->select('orders_list.num,orders_list.price');
			$this->db->from('products');
			$this->db->join('orders_list','products.id=orders_list.pid','left');
			$this->db->where('orders_list.oid',$oid);
			$this->db->group_by('orders_list.id');
			$this->db->order_by('orders_list.id');
			$rs = $this->db->get()->result();
			if(!empty($rs)){
				foreach($rs as $item){
					$total+= $item->num*$item->price;
				}
			}
		}
		return $total;
	}
	
	//获取当前登录用户的购物车的产品清单
	function shopping_status($key='')
	{
		$key = noSql($key);
		if($key!=''){
			$this->db->select('title');
			$this->db->from('orders_status');
			$this->db->where('key',$key);
			$this->db->limit(1);
			$row = $this->db->get()->row();
			if(!empty($row)){ return $row->title; }
		}
		return '-';
	}
	
	//获取当前登录用户的购物车某产品信息
	function shopping_pro_view($oid='',$pid='')
	{
		if(is_num($oid)&&is_num($pid)){
			$this->db->select('*');
			$this->db->from('orders_list');
			$this->db->where('oid',$oid);
			$this->db->where('pid',$pid);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		return false;
	}
	
	//获取当前登录用户的购物车某产品信息
	function shopping_pro_view_id($id='')
	{
		if(is_num($id)){
			$this->db->select('*');
			$this->db->from('orders_list');
			$this->db->where('id',$id);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		return false;
	}
	
	//创建购物车
	function shopping_car_add()
	{
		//未有购物车的情况下,创建购物车
		$order_no = orderNo($this->logid);
		$rs = array(
			 'order_no' => $order_no,
			 'uid'=>$this->logid,
			 //'add_ip'=>ip()
			 );
		$rs = orderMd5($rs);
		$this->db->insert('orders',$rs);
		//添加订单后获取订单ID
		return $this->db->insert_id();
	}
	
	//添加指定产品到指定订单
	function shopping_pro_add($oid='',$pid='')
	{
		//判断该产品是否已经在购物车内
		$pro = $this->shopping_pro_view($oid,$pid);
		if(!empty($pro)){
			json_form_no('这个产品已经在购物车里了!');
		}else{
			//获取该产品信息
			$pro = $this->Products_Model->view($pid);
			if(empty($pro)){ json_form_no('这个产品已经下架了!'); }
			//添加产品到订单下
			$rs = array(
				'oid' => $oid,
				'pid' => $pid,
				'num' => 1,
				'price' => $pro->price,
				'total' => $pro->price
				);
			$rs = orderMd5($rs);
			$this->db->insert('orders_list',$rs);
			return $this->db->insert_id();
		}
	}
	
	//为指定订单修改状态
	function set_orders_status($oid='',$status=''){
		if(is_num($oid)&&$status!=''){
			//判断状态是否存在
			$rs = $this->get_orders_status($status,'key');
			if(!empty($rs)){
				$data = array('status'=>$status);
				$this->db->where('oid',$oid);
				$this->db->update('orders',$data);
				return true;
			}
		}
		return false;
	}
	
	//**************************
	//获取订单状态
	//**************************
	function get_orders_status($oid='',$key=''){
		$this->db->select($key);
		$this->db->from('orders_status');
		if(is_num($oid)){
			//判断状态是否存在
			$this->db->where('oid',$oid);
		}else{
			$this->db->where('key',$oid);
		}
		$this->db->limit(1);
		$rs = $this->db->get();
		if(!empty($rs)){
			$row = $rs->row();
			if(!empty($row)){
				return $row->$key;
			}
		}
		return NULL;
	}
	
	
	//将订单中的产品数量返回，到相应的产品库存中
	function orders_back_pro_num($oid=NULL)
	{
		if(is_num($oid)){
			$pro_list = $this->Orders_Model->shopping_pro_list($oid);
			if(!empty($pro_list)){
				foreach($pro_list as $item){
					//提取数组
					if(!empty($item)){
						//更新数据
						$pro_num = 0;
						$pro_num = get_num($item->price_vip,0);
						$pro_num = $pro_num+$item->num;
						$this->Products_Model->pro_change($item->pid,'price_vip',$pro_num);
					}
				}
			}
		}
	}
	
	
	//取消订单
	function orders_cancel($oid=''){
		if(is_num($oid)){
			$this->db->select('*');
			$this->db->from('orders');
			$this->db->where('oid',$oid);
			$this->db->where('status !=','u.ok.del');
			$this->db->where('status !=','a.ok.shipment');
			$this->db->where('status !=','a.ok.notshipment');
			$this->db->limit(1);
			$row = $this->db->get()->row();
			if(!empty($row)){
				$this->set_orders_status($oid,'u.ok.del');
				//取消正在未提交的购物车，是不需要返回产品的库存信息的
				if($row->status!='u.shopping'){
					//返回产品库存
					$this->orders_back_pro_num($oid);
				}
				return true;
			}
		}
		return false;
	}
	
	//**************************
	//添加指定产品到指定订单
	//**************************
	function shopping_pro_update($id='',$num='')
	{
		$info = $this->shopping_info_view();
		if(empty($info)){
			json_form_no('操作失败,未找到相应的购物车!');
		}
		$oid = $info->oid;
			
		//判断该产品是否已经在购物车内
		$opro = $this->shopping_pro_view_id($id);
		if(empty($opro)){
			json_form_no('这个产品不在购物车里了!');
		}else{
			//获取产品ID
			$pid = $opro->pid;
			
			//获取该产品信息
			$pro = $this->Products_Model->view($pid);
			if(empty($pro)){ json_form_no('序号：[ '.$pid.' ]的产品，已经下架了!'); }
			
			//判断该当前产品的库存是否足够
			$pro_num = $pro->price_vip;
			if($num>$pro_num){ json_form_no('序号：[ '.$pid.' ]的产品当前库存为 [ '.$pro_num.' ],\r\n您填写的数量已经超过库存数量!'); }
			
			//更新产品库
			$proDa = array('price_vip'=> ($pro_num-$num));
			$this->db->where('id',$pid);
			$this->db->update('products',$proDa);
			
			//更新订单清单
			$price = $opro->price;
			$total = $price*$num;
			//添加产品到订单下
			$rs = array(
				'oid' => $oid,
				'pid' => $pid,
				'num' => $num,
				'price' => $price,
				'total' => $total
				);
			$rs = orderMd5($rs);
			$this->db->where('id',$id);
			$this->db->update('orders_list',$rs);
			return $pid;
		}
	}


	//**************************
	//删除
	//**************************
	function shopping_pro_del($pid='')
	{
		$info = $this->shopping_info_view();
		if(!empty($info)){
			$oid = $info->oid;
			$pro = $this->shopping_pro_view($oid,$pid);
			if(!empty($pro)){
				$this->db->where('oid',$oid);
				$this->db->where('pid',$pid);
				$this->db->where('id',$pro->id);
				$this->db->delete('orders_list');
			}
		}
		return true;
	}

}
?>