<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download extends QT_Controller {
	
	public $table = 'download';

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
		$this->data["list"] = $this->paging->show( $listsql ,20);
		
		//Seo设置
		$this->data['seo']['title'] = $this->data['nav'][$this->table] . $this->data['seo']['space'] . $this->data['seo']['title'];
		
		if ( $this->super===1 ){
			//输出到视窗
			$this->load->view($this->table,$this->data);
		}else{
			$this->user_login();
		}
	}
	
	function view($id=0)
	{
		$id = get_num($id,'404');
		$this->load->model('Download_Model');
		$view = $this->Download_Model->view($id);
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
			
			
			//验证操作权限
			if ( $this->super===1 ){
				if(!empty($view->pic_s)){
					redirect($view->pic_s.'?5cmlabs', 'refresh'); exit;
				}else{
					json_echo('<div style="padding:60px;text-align:center;">下载失败,文件可能已删除!</div>');
				}
			}else{
				$this->user_login();
			}
			
		}
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */