<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends QT_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('gzpft_val');
	}

	//产品分类导航
	function p_nav_html($data,$key)
	{
		$htm = '';
		$sel = '';
		$key_val = $this->input->getnum($key);
		foreach($data as $type){
			if( $key_val == $type->type_id ){
				$htm.= '<span class="label">'.$type->type_title.'</span>';
				$sel = array('title'=>$type->type_title,'key'=>$key);
			}else{
				if($key=='p_type_id'){
					$htm.= '<a href="'.reUrl($key.'='.$type->type_id.'&p_types_use_id=null&page=null').'">'.$type->type_title.'</a>';
				}else{
					$htm.= '<a href="'.reUrl($key.'='.$type->type_id.'&page=null').'">'.$type->type_title.'</a>';
				}
			}
			$htm.= '&nbsp;&nbsp;';
		}
		$d['htm'] = $htm;
		$d['sel'] = $sel;
		return $d;
	}
	
	//“已选择” 项HTML
	function p_nav_item_html($title,$key){
		$html = '<span class="label label-success">'.$title;
		$html.= '<a class="icon-remove" href="'.reUrl($key.'=null&page=null',1).'">&nbsp;<!--[if IE 6]>×<![endif]-->&nbsp;</a>';
		$html.= '</span>';
		$html.= '&nbsp;';
		return $html;
	}
	//“已选择” 项输出
	function p_nav_item($data){
		$html = '';
		if(!empty($data)){ $html = $this->p_nav_item_html($data['title'],$data['key']); }
		return $html;
	}
	
	//左边的产品分类栏
	function p_nav_left_ul($data){
		$p_html = array();
		$p_html['htm'] = '';
		if(!empty($data)&&is_array($data)){
			foreach($data as $type){
				if(!empty($type)&&is_array($type)){
					$p_html['htm'].= '<li><a href="'.site_url('products').reUrl('p_type_id='.$type['type_id'].'&p_types_use_id=null&page=null').'">'.$type['type_title'].'</a>';
					$type_ids = $type['type_ids'];
					if(!empty($type_ids)&&is_array($type_ids)){
						$p_html['htm'].= '<ul>';
						foreach($type_ids as $types){
							$p_html['htm'].= '<li><a href="'.site_url('products').reUrl('p_type_id='.$type['type_id'].'&p_types_use_id='.$types['type_id'].'&page=null').'">'.$types['type_title'].'</a>';
						}
						$p_html['htm'].= '</ul>';
					}
					$p_html['htm'].= '</li>';
				}
			}
		}
		if(!empty($p_html['htm'])){
			$p_html['htm'] = '<ul>'.$p_html['htm'].'</ul>';
		}
		return $p_html;
	}
	
	
	

	function index()
	{
		if( $this->super===1 ){
			/*
			$type = $this->Products_Model->get_types();
			if(!empty($type))
			{
				foreach($type as $item)
				{
					//获取子产品
					$types = $this->Products_Model->get_list(10,$item->type_id);
					$this->data['typebox'][] = array( 'type' => $item,'types' => $types );
				}
			}
			//输出到视窗
			$this->load->view('products',$this->data);
			
			*/
			
			$this->lists();
		}else{
			$this->user_login();
		}
	}

	function lists($news='')
	{
		//Seo设置
		$this->data['seo']['title'] = $this->data['nav']['products'] . $this->data['seo']['space'] . $this->data['seo']['title'];

		//关键词处理**************
		$p_nav = '';
		$keyword = noHtml($this->input->get('keyword'));
		if($keyword!=''){ $p_nav.= $this->p_nav_item_html($keyword,'keyword'); }
		
		//产品分类-风格类**************
		$p_styles_html = '';
		$p_styles_id = $this->input->getnum('p_styles_id');
		$p_styles = $this->data["p_styles"];
		$p_styles_html = $this->p_nav_html($p_styles,'p_styles_id');
		if( $p_styles_id ){ $p_nav.= $this->p_nav_item($p_styles_html['sel']); }
		
		//产品分类-大类**************
		$p_type_id = $this->input->getnum('p_type_id');
		$p_types = $this->data['p_types'];
		$p_types_html = '';
		$p_types_html = $this->p_nav_html($p_types,'p_type_id');
		if( $p_type_id ){ $p_nav.= $this->p_nav_item($p_types_html['sel']); }
		
		//产品分类左边栏
		$p_types_box = $this->data['p_types_box'];
		$p_nav_left_ul_html = $this->p_nav_left_ul($p_types_box);
		
		
		//产品分类-功能类**************
		$p_types_use_html = '';
		$p_types_use_id = $this->input->getnum('p_types_use_id');
		$p_types_use = $this->Products_Model->get_types($p_type_id);
		if( $p_type_id ){
			$p_types_use_html = $this->p_nav_html($p_types_use,'p_types_use_id');
			if( $p_types_use_id ){ $p_nav.= $this->p_nav_item($p_types_use_html['sel']); }
		}else{
			$p_types_use_html['htm'] = '';
		}

		//--------------
		$this->data['sBox'] = array(	 
					  'keyword' => $keyword,	
					  'p_nav' => $p_nav,
					  'p_types_html' => $p_types_html['htm'],
					  'p_nav_left_ul_html' => $p_nav_left_ul_html['htm'],
					  'p_types_use_html' => $p_types_use_html['htm'],
					  'p_styles_html' => $p_styles_html['htm']
					  );

		$this->data['type_id'] = '';
		$this->data['type_title'] = '';
		$this->data['type_note']  = '';
		if( $p_type_id )
		{
			//读取该分类的基本信息
			$type = $this->Products_Model->get_type($p_type_id);
			if(!empty($type))
			{
				$this->data['type_id'] = $type->type_id;
				$this->data['type_title'] = $type->type_title;
				$this->data['type_note'] = $type->type_note;
			}
			
			$this->db->where('products.typeB_id',$p_type_id);
			if($p_types_use_id)
			{
				$this->db->where('typeS_id',$p_types_use_id);
			}
		}
		
		if($p_styles_id){ $this->db->where('products.styles_id',$p_styles_id);}
		if(!empty($keyword))
		{
			$keylike_on[] = array( 'products.pro_no'=> $keyword );
			$keylike_on[] = array( 'products.title'=> $keyword );
			$keylike_on[] = array( 'products.note'=> $keyword );
			$this->db->like_on($keylike_on);
		}
		if($news=='news'){ $this->db->where('products.new',1); }

		//读取该分类下的产品
	    $this->db->select('products.*,products_inventory_type.title as i_title');
    	$this->db->from('products');
		$this->db->join('products_inventory_type','products_inventory_type.id = products.i_type','left');
		$this->db->where('products.ok',1);
		$this->db->order_by('products.id','desc');
		$listsql = $this->db->getSQL();
		
		//读取列表
		$this->load->library('Paging');
		$this->data["list"] = $this->paging->show( $listsql ,15);
		$this->data["listRows"] = $this->paging->listRows;

		if ( $this->super===1 ){
			//输出到视窗
			$this->load->view('products_list',$this->data);
		}else{
			$this->user_login();
		}
	}
	
	
	

	function news()
	{
		//Seo设置
		$this->data['seo']['title'] = $this->data['nav']['products/news'] . $this->data['seo']['space'] . $this->data['seo']['title'];

		//关键词处理**************
		$p_nav = '';
		$keyword = noHtml($this->input->get('keyword'));
		if($keyword!=''){ $p_nav.= $this->p_nav_item_html($keyword,'keyword'); }
		
		//产品分类-风格类**************
		$p_styles_html = '';
		$p_styles_id = $this->input->getnum('p_styles_id');
		$p_styles = $this->data["p_styles"];
		$p_styles_html = $this->p_nav_html($p_styles,'p_styles_id');
		if( $p_styles_id ){ $p_nav.= $this->p_nav_item($p_styles_html['sel']); }
		
		//产品分类-大类**************
		$p_type_id = $this->input->getnum('p_type_id');
		$p_types = $this->data['p_types'];
		$p_types_html = '';
		$p_types_html = $this->p_nav_html($p_types,'p_type_id');
		if( $p_type_id ){ $p_nav.= $this->p_nav_item($p_types_html['sel']); }
		
		//产品分类-功能类**************
		$p_types_use_html = '';
		$p_types_use_id = $this->input->getnum('p_types_use_id');
		
		//$p_types_use = $this->Products_Model->get_types($p_type_id);
		$this->db->from('products_type');
		$this->db->join('products','products_type.type_id = products.typeS_id','left');
		$this->db->where('products.new',1);
		$this->db->group_by('products_type.type_id');
		$p_types_use = $this->db->get()->result();
		
		$p_types_use_html = $this->p_nav_html($p_types_use,'p_types_use_id');
		if( $p_types_use_id ){ $p_nav.= $this->p_nav_item($p_types_use_html['sel']); }

		//--------------
		$this->data['sBox'] = array(	 
					  'keyword' => $keyword,	
					  'p_nav' => $p_nav,
					  'p_types_html' => $p_types_html['htm'],
					  'p_types_use_html' => $p_types_use_html['htm'],
					  'p_styles_html' => $p_styles_html['htm']
					  );

		$this->data['type_id'] = '';
		$this->data['type_title'] = '';
		$this->data['type_note']  = '';
		if( $p_type_id )
		{
			//读取该分类的基本信息
			$type = $this->Products_Model->get_type($p_type_id);
			if(!empty($type))
			{
				$this->data['type_id'] = $type->type_id;
				$this->data['type_title'] = $type->type_title;
				$this->data['type_note'] = $type->type_note;
			}
			$this->db->where('typeB_id',$p_type_id);
		}
		
		if($p_types_use_id)
		{
			$this->db->where('typeS_id',$p_types_use_id);
		}
		
		if($p_styles_id){ $this->db->where('styles_id',$p_styles_id);}
		if(!empty($keyword))
		{
			$this->db->like('title',$keyword);
		}
		$this->db->where('ok',1);
		$this->db->where('new',1);

		//读取该分类下的产品
		$this->db->select('*');
		$this->db->from('products');
		$this->db->order_by('id','desc');
		$listsql = $this->db->getSQL();
		
		//读取列表
		$this->load->library('Paging');
		$this->data["list"] = $this->paging->show( $listsql ,15);
		$this->data["listRows"] = $this->paging->listRows;
		
		//输出到视窗
		$this->load->view('products_new',$this->data);
	}
	
	

	function scene()
	{
		$this->data['type_id'] = 'scene';
		$this->data['type_title'] = $this->data['nav']['products/scene'];
		$this->data['type_note']  = '';
		
		//读取该分类下的产品
		$this->db->select('*');
		$this->db->from('products_real');
		$this->db->order_by('id','desc');
		$listsql = $this->db->getSQL();
		
		//读取列表
		$this->load->library('Paging');
		$this->data["list"] = $this->paging->show( $listsql ,9);
		
		//Seo设置
		$this->data['seo']['title'] = $this->data['nav']['products/scene'] . $this->data['seo']['space'] . $this->data['seo']['title'];

		//输出到视窗
		$this->load->view('products_real',$this->data);
	}
	
	function scene_view($id=0)
	{
		$id = get_num($id,'404');
		$this->db->select('*');
		$this->db->from('products_real');
		$this->db->where('id',$id);
		$this->db->limit(1);
		$view = $this->db->get()->row();
		if(empty($view))
		{
			show_404('/');
		}
		else
		{
			//Seo设置
			$this->data['seo']['title'] = $view->title . $this->data['seo']['space'] . $this->data['seo']['title'];
			
			$this->data['view'] = $view;
			//输出到视窗
			$this->load->view('products_real_view',$this->data);
		}
	}
	
	function view($id=0)
	{
		$id = get_num($id,'404');
		$this->load->model('Products_Model');
		$view = $this->Products_Model->view($id);
		if(empty($view)){
			show_404('/');
		}else{
			//Seo设置
			$this->data['seo']['title'] = $view->title . $this->data['seo']['space'] . $this->data['seo']['title'];
			$this->data['seo']['keywords'] = noHtml($view->title) . '，' . $this->data['seo']['keywords'];
			$this->data['seo']['description'] = noHtml($view->note) . '，' . $this->data['seo']['description'];
			$this->data['view'] = $view;
			
			//验证提交的密码
			if( $this->super===1 || $view->new==1 ){
				
				//产品分类左边栏
				$p_types_box = $this->data['p_types_box'];
				$p_nav_left_ul_html = $this->p_nav_left_ul($p_types_box);
				$this->data['sBox'] = array('p_nav_left_ul_html' => $p_nav_left_ul_html['htm']);
				
				//获取相似产品
				$this->data['viewlike'] = $this->Products_Model->viewlike($view->typeB_id,$view->id);
				//输出到视窗
				$this->load->view('products_view',$this->data);
			}else{
				$this->user_login();
			}
		}
	}



}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */