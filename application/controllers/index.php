<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends QT_Controller {
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->model('Columns_Model');
		$this->load->model('Cooperation_Model');
		
		$this->data['about_us_note'] = '';
		$this->data['products_note'] = '';
		$this->data['cooperation_note'] = '';
		
		$view = $this->Columns_Model->view(10);
		if( !empty($view) ){ $this->data['about_us_note'] = $view->note; }
		//------------------------------
		$view = $this->Cooperation_Model->view(10);
		if( !empty($view) ){ $this->data['cooperation_note'] = $view->note; }
		
		//1.基本信息
		/*banner图片*/
		$this->db->select('title,pic_s,toUrl');
		$this->db->from('banner');
//		if($this->data['super']!=1)
//		{
//			$this->db->where('ok',0);
//		}
		$this->db->where('ok',0);
		$this->db->order_by('id','desc');
		$this->data['banner'] = $this->db->get()->result();
		
		
		//Seo设置
		//$this->data['seo']['title'] = '朴风堂首页' . $this->data['seo']['space'] . $this->data['seo']['title'];
		//print_r(iptodata('102.17.2.123'));
		//$this->data["p_types"] = NULL;
		//输出到视窗
		$this->load->view('index',$this->data);
		
		
		
		
		//$this->load->model('Columns_Model');
		//$view = $this->Columns_Model->view(10);
		//if( empty($view) )
		//{
		//	show_404();
		//}
		//$this->data['view'] = $view;

		//Seo设置
		//$this->data['seo']['title'] = $view->title . $this->data['seo']['space'] . $this->data['seo']['title'];
		//$this->data['seo']['keywords'] = noHtml($view->title) . '，' . $this->data['seo']['keywords'];
		//$this->data['seo']['description'] = noHtml($view->note) . '，' . $this->data['seo']['description'];
		
		//输出到视窗
		//$this->load->view('page',$this->data);

	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */