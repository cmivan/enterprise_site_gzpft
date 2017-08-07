<?php
 if (!defined('BASEPATH')) exit('No direct access allowed.');

 //后台公共配置
 class QT_Controller extends CI_Controller {
	
	public $data;
	public $logid = 0;
	public $super = 0;
	
	function __construct(){
		parent::__construct();
		
		//评测应用程序
		//$this->output->enable_profiler(true);
		
		//初始化SEO设置
		$this->data['seo'] = $this->config->item("seo");
		//样式配置
		$this->data["style"] = $this->config->item("style");
		//站点信息
		$this->data["cm_pro"] = $this->config->item("cm_pro");
		//样式辅助
		$this->data["css_helper"] = false;

		
		//全局数据
		//用户登录
		$this->data['user_power'] = $this->session->userdata("user_power");
		if( is_num($this->data['user_power']['logid']) )
		{
			$this->logid = $this->data['user_power']['logid'];	
			$hot = $this->data['user_power']['hot'];
			if( $hot==1 )
			{
				//权限1,经销商用户权限
				$this->super = 1;
			}else{
				//权限2,注册用户权限
				$this->super = 2;
			}
		}
		$this->data['super'] = $this->super;

		//3.产品分类
		$this->load->model('Products_Model');
		$this->data["p_types"] = $this->Products_Model->get_types();
		$this->data["p_types_box"] = $this->Products_Model->types_box();
		$this->data["p_styles"] = $this->Products_Model->get_styles();
		//4.产品推荐
		//$this->data["products_ok"] = $this->Products_Model->get_ok(2);
		//5.新闻动态
		$this->load->model('News_Model');
		$this->data["top_news"] = $this->News_Model->top_news(3);
		//6.加盟合作.二级菜单
		$this->load->model('Cooperation_Model');
		$this->data["nav2"]['cooperation'] = $this->Cooperation_Model->lists();
		$this->load->model('Products_series_Model');
		$this->data["nav2"]['products_series'] = $this->Products_series_Model->lists();
		
		
		//加载语言包
		$this->lang->load('config','en');
		$this->data["site"] = $this->lang->line('site');
		$this->data["nav"] = $this->lang->line('nav');
		$this->data["pro"] = $this->lang->line('pro');
		$this->data["msgbox"] = $this->lang->line('msgbox');
		$this->data["logbox"] = $this->lang->line('logbox');
		$this->data["msgtip"] = $this->lang->line('msgtip');

    }
	
	
	
	//显示用户登录界面
	function user_login()
	{
		$this->load->view('user_login',$this->data);
	}


 }
 
 
 
 //会员后台公共配置
 class U_Controller extends QT_Controller {
	 
	function __construct(){
		parent::__construct();
		//初始化登录信息
		$this->data = $this->ini_login( $this->data );
    }

	//初始化登录信息
	function ini_login( $data = NULL )
	{
		$power = $this->session->userdata("user_power");
		$this->logid = $power['logid'];
		if( is_num( $this->logid ) )
		{
			return array_merge($data,$power);
		}
		show_error('可能是没有登录 或者是 登录后超过了15分钟没有操作!<br>可以尝试<a href="'.site_url('index').'">重新登录</a>',500, '无法访问该页面!');
		exit;
	} 
 }



 //系统后台公共配置
 class HT_Controller extends QT_Controller {
	 
	function __construct(){
		parent::__construct();
		//初始化登录信息
		$this->data = $this->ini_login( $this->data );
		//后台路径
		$this->data["admin_url"] = $this->config->item("admin_url");
    }

	//初始化登录信息
	function ini_login( $data = NULL )
	{
		$power = $this->session->userdata("cm_power");
		$this->logid = $power['logid'];
		$this->super = $power['super'];
		if( is_num( $this->logid ) )
		{
			return array_merge($data,$power);
		}
		show_error('可能是没有登录 或者是 登录后超过了15分钟没有操作!<br>可以尝试<a href="'.site_system('system_login').'">重新登录</a>',500, '无法访问该页面!');
		exit;
	} 
 }
 
/* End of file MY_Controller.php */
/* Location: ./application/libraries/MY_Controller.php */