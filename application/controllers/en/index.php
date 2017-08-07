<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends QT_Controller {
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		
		//Seo设置
		$this->data['seo']['title'] = '朴风堂首页' . $this->data['seo']['space'] . $this->data['seo']['title'];
		
		//输出到视窗
		$this->load->view('index',$this->data);
	}



}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */