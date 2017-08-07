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
		$this->Orders_Model->set_orders_status($id,'a.untreated');
		
		$_view = false;
		$this->Orders_Model->uidtype = 'null';
		$view = $this->Orders_Model->orders_view($id);
		if(!empty($view)){
			if(!empty($view)){
				$this->data['info'] = $view['info'];
				$this->data['list'] = $view['list'];
				$uid =$view['info']->uid;
				
				$this->load->model('Users_Model');
				$this->data['user'] = $this->Users_Model->view($uid);
				if($view['info']->status=='u.shopping'){ $_view = true; }
			}
		}
		//输出基本信息视窗
		$this->data['formTO']->url = site_system( $this->table . '/edit_save',1);
		$this->data['formTO']->backurl = site_system($this->table,1);
		$this->load->view_system('template/'.$this->table.'/edit',$this->data);
		
		//输出基本信息视窗
		$this->load->view_system('template/'.$this->table.'/view',$this->data);
	}


/* ********** 添加/编辑 *********** */
	function edit()
	{
		$this->load->library('kindeditor');
		
		$id = $this->input->getnum('id');
		$this->data['rs'] = array(
			  'id' => $id,
			  'nicename' => '',
			  'city' => '',
			  'note' => '',
			  'addr' => '',
			  'need' => '',
			  'email' => '',
			  'mobile' => '',
			  'tel' => '',
			  'regtime' => '',
			  'new' => 0,
			  'ok' => 0,
			  'hot' => 0
			  );
		
		if( $id )
		{
			$this->db->select('*');
			$this->db->from( $this->table );
			$this->db->where('id',$id);
			$rs = $this->db->get()->row();
			if( !empty($rs) )
			{
				$this->data['rs'] = array(
					  'id' => $rs->id,
					  'nicename' => $rs->nicename,
					  'city' => $rs->city,
					  'note' => $rs->note,
					  'addr' => $rs->addr,
					  'need' => $rs->need,
					  'email' => $rs->email,
					  'mobile' => $rs->mobile,
					  'tel' => $rs->tel,
					  'regtime' => $rs->regtime,
					  'new' => $rs->new,
					  'ok' => $rs->ok,
					  'hot' => $rs->hot
					  );
		
				//输出基本信息视窗
				$this->data['formTO']->url = site_system( $this->table . '/edit_save',1);
				$this->data['formTO']->backurl = site_system($this->table,1);
				$this->load->view_system('template/'.$this->table.'/edit',$this->data);
			}
			else
			{
				show_404();
			}
		}
		else
		{
			//输出基本信息视窗
			$this->data['formTO']->url = site_system( $this->table . '/edit_save',1);
			$this->data['formTO']->backurl = site_system($this->table,1);
			$this->load->view_system('template/'.$this->table.'/edit',$this->data);
		}
	}


	//保存产品添加/编辑(因是自己人的网站，没做严格权限审核)
	function edit_save()
	{
		$id = $this->input->postnum('id');
		
		$nicename = $this->input->post('nicename');
		$city = $this->input->post('city');
		$note = $this->input->post('note');
		$addr = $this->input->post('addr');
		$need = $this->input->post('need');
		$email = $this->input->post('email');
		$mobile = $this->input->post('mobile');
		$tel = $this->input->post('tel');
		$new = $this->input->postnum('new',0);
		$ok = $this->input->postnum('ok',0);
		$hot = $this->input->postnum('hot',0);

		
		//注：这里用户hot字段为1，用于识别用户是从后台添加还是自己注册的
		$data = array(
			  'nicename' => $nicename,
			  'city' => $city,
			  'note' => $note,
			  'addr' => $addr,
			  'need' => $need,
			  'email' => $email,
			  'mobile' => $mobile,
			  'tel' => $tel,
			  'new' => $new,
			  'ok' => $ok,
			  'hot' => 1,
			  'uid' => $this->logid
			  );
		
		if( $id )
		{
			//是否重置密码
			$rePass = $this->input->postnum('repass',0);
			$rePassStr = '';
			if($rePass==1){
				$data['password'] = pass_user( $this->data['seo']['product.pass'] );
				$rePassStr = '，并已初始化密码为：'.$this->data['seo']['product.pass'];
			}
			$this->db->where('id',$id);
			$this->db->update( $this->table ,$data);
			json_form_yes('更新成功'.$rePassStr);
		}
		else
		{
			//默认密码
			$data['loginIp'] = ip();
			$data['password'] = pass_user( $this->data['seo']['product.pass'] );
			$this->db->insert( $this->table ,$data);
			json_form_yes('录入成功！');
		}
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */