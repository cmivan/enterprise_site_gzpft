<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends HT_Controller {
	
	public $table = 'customer';
	public $name = '客户资料';
	
	function __construct()
	{
		parent::__construct();
		//判断是否已经配置信息
		
		$this->data['dbtable'] = $this->table;
		$this->data['dbtitle'] = $this->name;
		
		$this->load->model('Customer_Model');
		$this->load->helper('forms');
		$this->load->helper('gzpft_val');
		
		$this->data['typeB'] = $this->Customer_Model->types_box();
		
		
		//验证密码
		$this->data['passTip'] = '';
		$pass = $this->input->post('pass');
		if(!empty($pass)){
			$pass01 = $this->data['seo']['customer.pass.view'];
			$pass02 = $this->data['seo']['customer.pass.execl'];
			if($pass==$pass01){
				$this->session->set_userdata("passView",'yes');
			}else{
				$this->data['passTip'] = '页面进入失败，密码不正确!';
			}
			if($pass==$pass02){
				$this->session->set_userdata("passCxecl",'yes');
			}else{
				$this->data['passTip'] = '页面进入失败，密码不正确!';
			}
		}
		$this->data['passView'] = $this->session->userdata('passView');
		$this->data['passCxecl']= $this->session->userdata('passCxecl');
	}
	
	function index()
	{
		return $this->manage();
	}
	


/* ********** 管理 *********** */
	function manage($by='')
	{
		$this->load->library('Paging');

		//操作
		$id = $this->input->get_or_post('id');
		$cmd = $this->input->get_or_post('cmd');
		switch($cmd)
		{
			//删除信息
			case 'del':
				  if( is_num($id) )
				  {
					  $this->db->set('del',1);
					  $this->db->where('id',$id);
					  if($this->super!=1)
					  {
						  $this->db->where('uid',$this->logid);
					  }
					  $this->db->update( $this->table );
				  }
				  elseif( is_array($id) )
				  {
					  $this->db->set('del',1);
					  if($this->super!=1)
					  {
						  $this->db->where('uid',$this->logid);
					  }
					  $this->db->where_in('id',$id);
					  $this->db->update( $this->table );
				  }
			break;
			//切换check状态
			case 'ok':
			case 'hot':
			case 'new':
			      $val = $this->input->get('val');
				  if( is_num($val) )
				  {
					  if( is_num($id) )
					  {
						  $val = get_num($val,0);
						  $this->Customer_Model->check_change($id,$cmd,$val);
					  }  
				  }
			break;
		}
		
		//获取分类
		$typeB_id = $this->input->getnum('typeb_id');
		$typeS_id = $this->input->getnum('types_id');
		if( $typeB_id && $typeB_id!=0 ){
			$this->data['typeS'] = $this->Customer_Model->types_box( $typeB_id );
		}
		//分类检索
		if( $typeB_id ){
			$this->db->where("typeB_id",$typeB_id);
			if( $typeS_id ){
				$this->db->where("typeS_id",$typeS_id);
			}
		}
		
		//生成查询
		$this->db->select('*');
		$this->db->from( $this->table );
		$this->db->where('del',0);
		if($by=='my'){
			$this->db->where('uid',$this->logid);
		}

		/*
		//除超级管理员外，其他人只能查看自己添加的客户数据
		if($this->super!=1)
		{
			$this->db->where('uid',$this->logid);
		}
		*/
		
		$this->data['typeB_id'] = $typeB_id;
		$this->data['typeS_id'] = $typeS_id;
		//搜索关键词
		$keyword = $this->input->get_or_post('keyword',TRUE);
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
		$listsql = $this->db->getSQL();
		
		//读取列表
		$this->data["list"] = $this->paging->show( $listsql , 15 );
		$this->data['keyword'] = $keyword;
		$this->data['passTitle'] = '查看';
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
		
		//获取分类
		$typeB_id = $this->input->get_or_post('typeb_id');
		$typeS_id = $this->input->get_or_post('types_id');
		

		//记录选项
		$customer = noHtml( $customer );
		$date_go  = noHtml( $date_go );
		$date_end = noHtml( $date_end );
		
		$this->data['customer'] = noHtml( $customer );
		$this->data['date_go']  = noHtml( $date_go );
		$this->data['date_end'] = noHtml( $date_end );
		$this->data['keyword']  = noHtml( $keyword );
		
		//下载文件名称
		$downname = 'PFT@'.$date_go.'~'.$date_end.'@'.time();

		//生成查询
		if($cmd=='show')
		{
			
			//按分类筛选
			if( $typeB_id && $typeB_id!=0 ){
				$this->data['typeS'] = $this->Customer_Model->types_box( $typeB_id );
			}
			//分类检索
			if( $typeB_id ){
				$this->db->where("typeB_id",$typeB_id);
				if( $typeS_id ){ $this->db->where("typeS_id",$typeS_id); }
			}
			
			
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
			$rs = $this->db->get();
			if(!empty($rs)){
				$list = $rs->result();
		    }else{
				$list = NULL;
			}
			
			//读取列表
			$this->data["list"] = $list;	
			
			//下载报表
			if($excel=='down')
			{
				excel($downname,$list);
			}
		}
		
		$this->data['passTitle'] = '导出';
		$this->data['typeB_id'] = $typeB_id;
		$this->data['typeS_id'] = $typeS_id;

		$this->load->view_system('template/'.$this->table.'/excel',$this->data);
	}
	
	

	
	function view()
	{
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
				$this->load->view_system('template/'.$this->table.'/view',$this->data);
			}
		}
	}


/* ********** 添加/编辑 *********** */
	function edit()
	{
		$this->load->library('kindeditor');
		
		$id = $this->input->getnum('id');
		$this->data['rs'] = array(
			  'id' => $id,
			  'typeB_id' => 0,
			  'typeS_id' => 0,
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
					  'typeB_id' => $rs->typeB_id,
					  'typeS_id' => $rs->typeS_id,
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
		
		$type_id = $this->input->post('type_id');
		$T = $this->Customer_Model->get_type_arr( $type_id );
		$typeB_id = $T['typeB_id'];
		$typeS_id = $T['typeS_id'];

		
		//注：这里用户hot字段为1，用于识别用户是从后台添加还是自己注册的
		$data = array(
			  'typeB_id' => $typeB_id,
			  'typeS_id' => $typeS_id,
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
	
	

/* ********** 分类管理页面 *********** */
	
	
	//分类页面
	function type()
	{
		//普通删除、数据处理
		$del_id = $this->input->getnum('del_id');
		if( $del_id )
		{
			$this->Customer_Model->del_type($del_id);
			//重新获取分类
			$this->data['typeB'] = $this->Customer_Model->types_box();
		}

		//(post)处理大类排序问题
		$go = $this->input->post('go');
		if($go=='yes')
		{
			$cmd = $this->input->post('cmd');
			$type_id = $this->input->postnum('type_id');
			
			if($cmd=='')
			{
				json_form_no('未知操作!');
			}
			elseif($type_id==false)
			{
				json_form_no('参数丢失,本次操作无效!');
			}
			
			$row = $this->Customer_Model->get_type( $type_id );
			if(!empty($row))
			{
				//执行重新排序
				$this->load->helper('publicedit');
				$keys = array(
					  'table'=> $this->table . '_type',
					  'key'  => 'type_id',
					  'okey' => 'type_order_id',
					  'id'   => $row->type_id,
					  'oid'  => $row->type_order_id,
					  'type' => $cmd
					  );
				List_Re_Order($keys);
			}	
		}
		
		//表单配置
		$this->data['formTO']->url = site_system( $this->table . '/type',1);
		$this->data['formTO']->backurl = '';

		//输出界面效果
		$this->load->view_system('template/'.$this->table.'/type_manage',$this->data);
	}
	
	function type_edit()
	{
		$this->load->library('kindeditor');
		
		//接收Url参数
		$id = $this->input->getnum('id');
		
		//初始化数据
		$this->data['type_id'] = $id;
		$this->data['type_title'] = '';
		$this->data['type_ids'] = 0;
		$this->data['type_order_id'] = 0;
		
		$this->data['action_name'] = "添加";
		if( $id )
		{
			$this->data['action_name'] = "编辑";
			$rs = $this->Customer_Model->get_type($id);
			if(!empty($rs))
			{
				$this->data['type_title'] = $rs->type_title;
				$this->data['type_ids'] = $rs->type_ids;
				$this->data['type_order_id'] = $rs->type_order_id;
			}
		}
		
		//表单配置
		$this->data['formTO']->url = site_system( $this->table . '/type_save',1);
		$this->data['formTO']->backurl = site_system( $this->table . '/type',1);
		
		$this->load->view_system('template/'.$this->table.'/type_edit',$this->data);
	}
	
	
	//保存分类
	function type_save()
	{
		//接收提交来的数据
		$type_id = $this->input->postnum('type_id');
		$type_title = $this->input->post('type_title');
		$type_ids = $this->input->postnum('type_ids',0);
		$type_order_id = $this->input->postnum('type_order_id',0);

		//验证数据
		if($type_title=='')
		{
			json_form_no('请填写标题!');
		}
		elseif($type_order_id===false)
		{
			json_form_no('请在排序处填写正整数!');
		}
		
		//写入数据
		$data['type_title'] = $type_title;
		$data['type_ids'] = $type_ids;
		$data['type_order_id'] = $type_order_id;
		
		if($type_id==false)
		{
			//添加
			$this->db->insert($this->table . '_type',$data);
			//重洗分类排序
			$this->re_order_type();
			json_form_yes('添加成功!');
		}
		else
		{
			//修改
			$this->db->where('type_id',$type_id);
			$this->db->update($this->table . '_type',$data);
			//重洗分类排序
			$this->re_order_type();
			json_form_yes('修改成功!');
		}	
	}

	//重洗分类排序
	function re_order_type()
	{
		$re_row = $this->Customer_Model->get_types();
		if(!empty($re_row))
		{
			$re_num = $this->Customer_Model->get_types_num();
			foreach($re_row as $re_rs)
			{
				$data['type_order_id'] = $re_num;
				$this->db->where('type_id',$re_rs->type_id);
				$this->db->update( $this->table . '_type',$data);
				$re_num--;
			}
		}
	}
	
	
	

}





	



/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */