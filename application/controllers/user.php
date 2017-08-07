<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends U_Controller {
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		if( is_num($this->logid) )
		{
			//读取用户信息
			$this->load->model('Users_Model');
			$user = $this->Users_Model->view( $this->logid );
			if( !empty($user) )
			{
				$this->data['user'] = $user;
			}
			else
			{
				echo '未找到相应的用户信息!'; exit;
			}
		}

		//Seo设置
		$this->data['seo']['title'] = $this->data['nav']['user'] . $this->data['seo']['space'] . $this->data['seo']['title'];
		
		$this->data['formTO']->url = 'user/save';
		$this->data['formTO']->backurl = 'user';
		
		//输出到视窗
		$this->load->view('user',$this->data);
	}
	
	
	//用户中心
	function center()
	{
		//输出到视窗
		$this->load->view('user_center',$this->data);
	}
	
	//活动中心
	function activity()
	{
		/*banner图片*/
		$this->load->model('Banner_Model');
		$this->data['banner'] = $this->Banner_Model->view('',1);
		//输出到视窗
		$this->load->view('user_activity',$this->data);
	}

	
	//提交保存
	function save()
	{
		$save = $this->input->post('save');
		if($save=='go')
		{
			//获取数据
			$nicename = noHtml($this->input->post("nicename"));
			$password = $this->input->post("password");
			$password2= $this->input->post("password2");
			$email    = noHtml($this->input->post("email"));
			$mobile   = noHtml($this->input->post("mobile"));
			$tel      = noHtml($this->input->post("tel"));
			$sex      = noHtml($this->input->post("sex"));
			$note     = noHtml($this->input->post("note"));
			$addr     = noHtml($this->input->post("addr"));
			
			//检测数据是否符合要求
			if( empty($nicename) )
			{
				json_form_alt("请填写称呼!");
			}
			if( empty($password) && !empty($password2) )
			{
				json_form_alt("请填写新密码!");
			}
			if( !empty($password) && empty($password2) )
			{
				json_form_alt("请确认新密码!");
			}
			if( empty($email) )
			{
				json_form_alt("请填写邮箱!");
			}
			if( empty($mobile) )
			{
				json_form_alt("请填写手机!");
			}
			if( empty($sex) )
			{
				json_form_alt("请选择性别!");
			}

			//生成语句数组
			$this->db->where('id', $this->logid );
			$data = array(
				  'nicename' => $nicename,
				  'email' => $email,
				  'mobile' => $mobile,
				  'tel' => $tel,
				  'sex' => $sex,
				  'note' => $note,
				  'addr' => $addr
				  );
			if(!empty($password))
			{
				$data['password'] = pass_user($password);
			}

			//执行更新
			if( $this->db->update('users',$data) )
			{
				if(!empty($password))
				{
					json_form_yes("更新成功,请牢记新密码!"); 
				}
				else
				{
					json_form_yes("更新成功!"); 
				}
			}
			else
			{
				json_form_no("很遗憾!更新可能失败!");
			}
			
		}
	}
	
	
	//注销登录
	function out()
	{
		$this->session->unset_userdata('user_power');
		redirect('/index', 'refresh');
	}



}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */