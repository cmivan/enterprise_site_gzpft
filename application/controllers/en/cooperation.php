<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cooperation extends QT_Controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->view();
	}
	
	function view($id=0)
	{
		$this->load->model('Cooperation_Model');
		$view = $this->Cooperation_Model->view($id);
		if( empty($view) )
		{
			show_404();
		}
		$this->data['view'] = $view;
		
		//全部加盟合作
		$this->data['list'] = $this->Cooperation_Model->lists();
		
		//Seo设置
		$this->data['seo']['title'] = $view->title . $this->data['seo']['space'] . $this->data['seo']['title'];
		$this->data['seo']['keywords'] = noHtml($view->title) . '，' . $this->data['seo']['keywords'];
		$this->data['seo']['description'] = noHtml($view->note) . '，' . $this->data['seo']['description'];
		
		//输出到视窗
		$this->load->view('cooperation',$this->data);
	}


}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */