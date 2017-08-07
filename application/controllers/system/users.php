<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends HT_Controller {
	
	public $table = 'users';
	public $name = '会员';
	
	function __construct()
	{
		parent::__construct();
		//判断是否已经配置信息
		
		$this->data['dbtable'] = $this->table;
		$this->data['dbtitle'] = $this->name;
		
		$this->load->model('Users_Model');
		$this->load->helper('forms');
		$this->load->helper('gzpft_val');
	}
	
	function index()
	{
		return $this->manage();
	}
	


/* ********** 管理 *********** */
	function manage()
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
					  $this->db->update( $this->table );
				  }
				  elseif( is_array($id) )
				  {
					  $this->db->set('del',1);
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
						  $this->Users_Model->check_change($id,$cmd,$val);
					  }  
				  }
			break;
		}
		
		//生成查询
		$this->db->select('*');
		$this->db->from( $this->table );
		$this->db->where('del',0);
		//搜索关键词
		$keyword = $this->input->get_or_post('keyword',TRUE);
		if($keyword!='')
		{
			$keylike_on[] = array( 'username'=> $keyword );
			$keylike_on[] = array( 'note'=> $keyword );
			$this->db->like_on($keylike_on);
		}
		$this->db->order_by('id','desc');
		$listsql = $this->db->getSQL();
		//读取列表
		$this->data["list"] = $this->paging->show( $listsql , 20 );
		$this->data['keyword'] = $keyword;
		$this->load->view_system('template/'.$this->table.'/manage',$this->data);
	}


/* ********** 添加/编辑 *********** */
	function edit()
	{
		$this->load->library('kindeditor');
		
		$id = $this->input->getnum('id');
		$this->data['rs'] = array(
			  'id' => $id,
			  'nicename' => '',
			  'username' => '',
			  'note' => '',
			  'addr' => '',
			  'face' => '',
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
					  'username' => $rs->username,
					  'note' => $rs->note,
					  'addr' => $rs->addr,
					  'face' => $rs->face,
					  'email' => $rs->email,
					  'mobile' => $rs->mobile,
					  'tel' => $rs->tel,
					  'regtime' => $rs->regtime,
					  'new' => $rs->new,
					  'ok' => $rs->ok,
					  'hot' => $rs->hot
					  );
				
				
				
				//tab切换
				$tab = $this->input->get('tab');
				$tab = empty($tab) ? 'base' : $tab;
				$this->data['tab'] = $tab;
				
				switch($tab)
				{
					case 'base':
						//输出基本信息视窗
						$this->data['formTO']->url = site_system( $this->table . '/edit_save',1);
						$this->data['formTO']->backurl = site_system($this->table,1);
						$this->load->view_system('template/'.$this->table.'/edit',$this->data);
						break;
						
					case 'login':
						//读取用户登录信息
						$this->load->library('Paging');
						$listsql = $this->Users_Model->login_history($id);
						$this->data["list"] = $this->paging->show( $listsql , 5 );
						$this->load->view_system('template/'.$this->table.'/login',$this->data);
						break;
						
					case 'ip':
						//读取用户使用的IP信息
						$this->load->library('Paging');
						$this->load->library('Sitecount');
						$listsql = $this->sitecount->iplist_Sql($id);
						$this->data["list"] = $this->paging->show( $listsql , 5 );
						$this->load->view_system('template/'.$this->table.'/ip',$this->data);
						break;
						
					case 'visit':
						//读取用户浏览过的页面
						$this->load->library('Paging');
						$this->load->library('Sitecount');
						$listsql = $this->sitecount->urls_Sql($id);
						$this->data["list"] = $this->paging->show( $listsql , 5 );
						$this->load->view_system('template/'.$this->table.'/page',$this->data);
						break;
				}	
				
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
	
	//保存产品添加/编辑
	function edit_save()
	{
		$id = $this->input->postnum('id');
		
		$nicename = $this->input->post('nicename');
		$username = $this->input->post('username');
		$note = $this->input->post('note');
		$addr = $this->input->post('addr');
		$face = $this->input->post('face');
		$email = $this->input->post('email');
		$mobile = $this->input->post('mobile');
		$tel = $this->input->post('tel');
		$new = $this->input->postnum('new',0);
		$ok = $this->input->postnum('ok',0);
		$hot = $this->input->postnum('hot',0);

		
		//注：这里用户hot字段为1，用于识别用户是从后台添加还是自己注册的
		$data = array(
			  'nicename' => $nicename,
			  'username' => $username,
			  'note' => $note,
			  'addr' => $addr,
			  'face' => $face,
			  'email' => $email,
			  'mobile' => $mobile,
			  'tel' => $tel,
			  'new' => $new,
			  'ok' => $ok,
			  'hot' => 1
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