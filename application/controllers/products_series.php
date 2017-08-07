<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products_series extends QT_Controller {
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->view();
	}
	
	function view($id='')
	{
		$id = get_num($id);
		$view = $this->Products_series_Model->view( $id );
		if( empty($view) )
		{
			show_404();
		}
		$this->data['view'] = $view;

		//Seo设置
		$this->data['seo']['title'] = $view->title . $this->data['seo']['space'] . $this->data['seo']['title'];
		$this->data['seo']['keywords'] = noHtml($view->title) . '，' . $this->data['seo']['keywords'];
		$this->data['seo']['description'] = noHtml($view->note) . '，' . $this->data['seo']['description'];
		
		//输出到视窗
		$this->load->view('page',$this->data);	
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */