<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends HT_Controller {
	
	public $table = 'banner';
	public $title = 'Banner图';
	
	function __construct()
	{
		parent::__construct();
		//判断是否已经配置信息
		
		$this->data['dbtable'] = $this->table;
		$this->data['dbtitle'] = $this->title;

		$this->load->helper('forms');
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
					  $this->db->where('id',$id);
					  $this->db->delete( $this->table );
				  }
				  elseif( is_array($id) )
				  {
					  $this->db->where_in('id',$id);
					  $this->db->delete( $this->table );	
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
						  $this->load->model('Banner_Model');
						  $this->Banner_Model->check_change($id,$cmd,$val);
					  }  
				  }

			break;
		}
		
		//生成查询
		$this->db->select('*');
		$this->db->from( $this->table );
		//搜索关键词
		$keyword = $this->input->get_or_post('keyword',TRUE);
		if($keyword!='')
		{
			$keylike_on[] = array( 'title'=> $keyword );
			$keylike_on[] = array( 'note'=> $keyword );
			$this->db->like_on($keylike_on);
		}
		$this->db->where('ok',0);
		$this->db->order_by('id','desc');
		$listsql = $this->db->getSQL();
		//读取列表
		$this->data["list"] = $this->paging->show( $listsql , 20 );
		$this->data['keyword'] = $keyword;
		$this->load->view_system('template/'.$this->table.'/manage',$this->data);
	}


	
	function edit()
	{
		$this->load->library('kindeditor');
		
		$id = $this->input->getnum('id');
		
		$this->data['rs'] = array(
			  'id' => '',
			  'title' => '',
			  'toUrl' => '',
			  'pic_s' => '',
			  'add_time' => dateTime(),
			  'add_ip' => ip(),
			  'ok' => 0
			  );
		
		if( $id )
		{
			$this->db->select('*');
			$this->db->from( $this->table );
			$this->db->where('id',$id);
			$this->db->where('ok',0);
			$rs = $this->db->get()->row();
			if( !empty($rs) )
			{
				$this->data['rs'] = array(
				  'id' => $rs->id,
				  'title' => $rs->title,
				  'toUrl' => $rs->toUrl,
				  'pic_s' => $rs->pic_s,
				  'add_time' => $rs->add_time,
				  'add_ip' => $rs->add_ip,
				  'ok' => $rs->ok
				  );
			}
		}
		$this->data['formTO']->url = site_system( $this->table . '/edit_save',1);
		$this->data['formTO']->backurl = site_system($this->table,1);
		$this->load->view_system('template/'.$this->table.'/edit',$this->data);
	}
	
	//保存产品添加/编辑
	function edit_save()
	{
		$id = $this->input->postnum('id');
		
		$title = $this->input->post('title');
		$toUrl = $this->input->post('toUrl');
		$pic_s = $this->input->post('pic_s');
		$ok = $this->input->postnum('ok',0);
		
		$data = array(
			  'title' => $title,
			  'toUrl' => $toUrl,
			  'pic_s' => $pic_s,
			  'ok' => $ok
			  );
		
		if( $id )
		{
			$this->db->where('id',$id);
			$this->db->update( $this->table ,$data);
			json_form_yes('更新成功！');
		}
		else
		{
			$this->db->insert( $this->table ,$data);
			json_form_yes('录入成功！');
		}
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */