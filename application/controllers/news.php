<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends QT_Controller {
	
	public $table = 'news';
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		//读取该分类下的产品
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->order_by('id','desc');
		$listsql = $this->db->getSQL();
		
		//读取列表
		$this->load->library('Paging');
		$this->data["list"] = $this->paging->show( $listsql ,15);
		
		//Seo设置
		$this->data['seo']['title'] = $this->data['nav'][$this->table] . $this->data['seo']['space'] . $this->data['seo']['title'];
		
		$this->data['top_news'] = NULL;
		//输出到视窗
		$this->load->view($this->table,$this->data);
	}
	
	function view($id=0)
	{
		$id = get_num($id,'404');
		$this->load->model('News_Model');
		$view = $this->News_Model->view($id);
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
			//输出到视窗
			$this->load->view($this->table.'_view',$this->data);
		}
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */