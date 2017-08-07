<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends HT_Controller {
	
	public $table = 'orders';
	public $name = '订单信息';
	
	function __construct()
	{
		parent::__construct();
		//判断是否已经配置信息
		
		$this->data['dbtable'] = $this->table;
		$this->data['dbtitle'] = $this->name;
		
		$this->load->model('Orders_Model');
		$this->load->helper('forms');
		$this->load->helper('gzpft_val');
	}
	
	function index()
	{
		return $this->manage();
	}
	


/* ********** 管理 *********** */
	function manage($by='')
	{
		$this->load->library('Paging');
		
		//生成查询
		$this->db->select('orders.*,users.*');
		$this->db->from('orders');
		$this->db->join('users','users.id=orders.uid','left');
		$this->db->where('orders.status !=','u.shopping');
		if(!empty($type)){
			$this->db->select('orders_status.*');
			$this->db->join('orders_status','orders.status=orders_status.key','left');
			$this->db->where('orders_status.key',$type);
		}
		
		//搜索关键词
		$keyword = $this->input->get_or_post('keyword',TRUE);
		if($keyword!='')
		{
			$keylike_on[] = array( 'orders.order_no'=> $keyword );
			$keylike_on[] = array( 'orders.note_u'=> $keyword );
			$keylike_on[] = array( 'orders.note_a'=> $keyword );
			$keylike_on[] = array( 'users.nicename'=> $keyword );
			$keylike_on[] = array( 'users.note'=> $keyword );
			$keylike_on[] = array( 'users.addr'=> $keyword );
			$keylike_on[] = array( 'users.email'=> $keyword );
			$keylike_on[] = array( 'users.mobile'=> $keyword );
			$keylike_on[] = array( 'users.tel'=> $keyword );
			$this->db->like_on($keylike_on);
		}
		
		$this->db->group_by('orders.oid');
		$this->db->order_by('orders.oid','desc');

		$listsql = $this->db->getSQL();
		
		//读取列表
		$this->data["list"] = $this->paging->show( $listsql , 15 );
		$this->data['keyword'] = $keyword;
		$this->load->view_system('template/'.$this->table.'/manage',$this->data);
	}
	
	
	//我(当前登录用户)录入的数据数据
	function my()
	{
		$this->manage('my');
	}
	
	
	
	
	function excel()
	{
		//操作
		$cmd = $this->input->get_or_post('cmd');
		$customer = $this->input->get_or_post('customer');
		$date_go  = $this->input->get_or_post('date_go');
		$date_end = $this->input->get_or_post('date_end');
		$keyword = $this->input->get_or_post('keyword',TRUE);
		$excel = $this->input->get_or_post('excel');

		//记录选项
		$customer = noHtml( $customer );
		$date_go  = noHtml( $date_go );
		$date_end = noHtml( $date_end );
		
		$this->data['customer'] = noHtml( $customer );
		$this->data['date_go']  = noHtml( $date_go );
		$this->data['date_end'] = noHtml( $date_end );
		$this->data['keyword'] = noHtml( $keyword );
		
		//下载文件名称
		$downname = 'PFT@'.$date_go.'~'.$date_end.'@'.time();

		//生成查询
		if($cmd=='show')
		{
			$this->db->select('*');
			$this->db->from( $this->table );
			$this->db->where('del',0);
			if($customer=='my'){
				$this->db->where('uid',$this->logid);
			}
			
			//日期范围
			if(!empty($date_go)){
				$date_go = strtotime( $date_go );
				$this->db->where('UNIX_TIMESTAMP(logintime) >=',$date_go);
			}
			if(!empty($date_end)){
				$date_end = strtotime( $date_end );
				$date_end = $date_end + 3600*24;
				$this->db->where('UNIX_TIMESTAMP(logintime) <',$date_end);
			}
				
			//搜索关键词
			if($keyword!='')
			{
			    $keylike_on[] = array( 'city'=> $keyword );
				$keylike_on[] = array( 'nicename'=> $keyword );
				$keylike_on[] = array( 'mobile'=> $keyword );
				$keylike_on[] = array( 'email'=> $keyword );
				$keylike_on[] = array( 'addr'=> $keyword );
				$keylike_on[] = array( 'need'=> $keyword );
				$keylike_on[] = array( 'note'=> $keyword );
				$this->db->like_on($keylike_on);
			}
			$this->db->order_by('id','desc');
			$list = $this->db->get()->result();
			
			//读取列表
			$this->data["list"] = $list;	
			
			//下载报表
			if($excel=='down')
			{
				excel($downname,$list);
			}
		}

		$this->load->view_system('template/'.$this->table.'/excel',$this->data);
	}
	
	

	
	function view()
	{
		$id = $this->input->getnum('id','404');

		$_view = false;
		$this->Orders_Model->uidtype = 'null';
		$view = $this->Orders_Model->orders_view($id);
		if(!empty($view)){
			if(!empty($view)){
				$this->data['info'] = $view['info'];
				$this->data['list'] = $view['list'];
				$uid = $view['info']->uid;

				$this->load->model('Users_Model');
				$this->data['user'] = $this->Users_Model->view($uid);
				if($view['info']->status=='a.unlook'){
					//如果订单状态为 u.shopping“在选产品,待提交”,则修改为已阅
					$this->Orders_Model->set_orders_status($id,'a.untreated');
					$_view = true;
				}
			}
		}
		//输出基本信息视窗
		$this->data['formTO']->url = site_system( $this->table . '/edit_save',1);
		$this->data['formTO']->backurl = site_system($this->table,1);
		
		//输出基本信息视窗
		$this->load->view_system('template/'.$this->table.'/view',$this->data);
	}




	//保存产品添加/编辑(因是自己人的网站，没做严格权限审核)
	function edit_save()
	{
		$oid = $this->input->postnum('oid');
		$sended = $this->input->post('sended');
		$note = $this->input->post('note');
		
		//产品数量
		$pro_num = 0;
		
		$status = false;
		if($oid){
			if($sended=='ok'){
				$status = 'a.ok.shipment';
			}elseif($sended=='no'){
				$status = 'a.ok.notshipment';
			}
		}
		
		//更新状态和增加备注
		if($status){
			$data = array(
					'status' => $status,
					'note_a' => $note
					);
					
			$this->db->where('status !=','u.ok.del');
			$this->db->where('status !=','a.ok.shipment');
			$this->db->where('status !=','a.ok.notshipment');
					
			$this->db->where('oid',$oid);
			$this->db->update( $this->table ,$data);
			
			//未发货，则把库存加回去到产品里
			$orderStr = '';
			if($status == 'a.ok.notshipment'){
				$this->Orders_Model->orders_back_pro_num($oid);
/*				
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
				*/
				
				$orderStr = '，订单库存已经返回到各产品';
			}
			json_form_yes('订单处理成功'.$orderStr.'！');
		}else{
			json_form_no('请选择处理状态，“已发货”、“未发货”！');
		}
	}
	
	
	function re_order_no_diy()
	{
		$oid = $this->input->postnum('oid');
		$order_no_diy = noHtml($this->input->post('order_no_diy'));
		
		//更新状态和增加备注
		if($oid){
			$data = array('order_no_diy' => $order_no_diy);
					
			$this->db->where('oid',$oid);
			$this->db->update( $this->table ,$data);
			
			json_form_yes($order_no_diy);
		}else{
			json_form_no('修改失败，参数不完整哦！');
		}
	}
	

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */