<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends QT_Controller {
	
	function __construct()
	{
		parent::__construct();
	}

	function index($type_id=0)
	{
		
		//Seo设置
		$this->data['seo']['title'] = $this->data['nav']['products'] . $this->data['seo']['space'] . $this->data['seo']['title'];
		
		//输出到视窗
		$this->load->view('index',$this->data);
	}

	function news()
	{
		$this->data['type_id'] = 'news';
		$this->data['type_title'] = $this->data['nav']['products/news'];
		$this->data['type_note']  = '';
		
		//读取该分类下的产品
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('new',1);
		$this->db->order_by('id','desc');
		$listsql = $this->db->getSQL();
		
		//读取列表
		$this->load->library('Paging');
		$this->data["list"] = $this->paging->show( $listsql ,20);
		
		//Seo设置
		$this->data['seo']['title'] = $this->data['nav']['products/news'] . $this->data['seo']['space'] . $this->data['seo']['title'];

		//输出到视窗
		$this->load->view('products',$this->data);
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
		$view = $this->Products_Model->view($id);
		if(empty($view))
		{
			show_404('/');
		}
		else
		{
			//Seo设置
			$this->data['seo']['title'] = $view->title . $this->data['seo']['space'] . $this->data['seo']['title'];
			$this->data['seo']['keywords'] = noHtml($view->title) . '，' . $this->data['seo']['keywords'];
			$this->data['seo']['description'] = noHtml($view->note) . '，' . $this->data['seo']['description'];
			
			$this->data['view'] = $view;
			$this->data["list"] = $this->Products_Model->get_list(3, $view->typeB_id );
			//输出到视窗
			$this->load->view('products_view',$this->data);
		}
	}
	
	function type($type_id=0)
	{
		$this->data['type_id'] = '';
		$this->data['type_title'] = '';
		$this->data['type_note']  = '';
		if( is_num($type_id) )
		{
			//读取该分类的基本信息
			$type = $this->Products_Model->get_type($type_id);
			if(!empty($type))
			{
				$this->data['type_id'] = $type->type_id;
				$this->data['type_title'] = $type->type_title;
				$this->data['type_note'] = $type->type_note;
			}
			
			$this->db->where('typeB_id',$type_id);
		}

		//Seo设置
		$this->data['seo']['title'] = $this->data['type_title'] . $this->data['seo']['space'] . $this->data['seo']['title'];
		
		
		//读取该分类下的产品
		$this->db->select('*');
		$this->db->from('products');
		$this->db->order_by('id','desc');
		$listsql = $this->db->getSQL();
		
		//读取列表
		$this->load->library('Paging');
		$this->data["list"] = $this->paging->show( $listsql ,20);

		//输出到视窗
		$this->load->view('products',$this->data);
	}



}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */