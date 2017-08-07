<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reg extends QT_Controller {
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		//Seo设置
		$this->data['seo']['title'] = '朴风堂会员注册' . $this->data['seo']['space'] . $this->data['seo']['title'];
		
		$this->data['formTO']->url = 'action/do_reg';
		$this->data['formTO']->backurl = 'index';
		
		//输出到视窗
		$this->load->view('reg',$this->data);
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */