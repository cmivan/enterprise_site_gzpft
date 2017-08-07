<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends QT_Controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	//登录
	function do_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if($username==''){
			json_form_no('请输入用户名!');
		}elseif($password==''){
			json_form_no('请输入登录密码!');
		}else{
			//开始验证
			$password = pass_user($password);
			$this->db->select('id,username,password');
			$this->db->from('users');
			$this->db->where('password', $password );
			$this->db->where('username', $username );
			$this->db->limit(1);
			$rs = $this->db->get()->row();
			if(!empty($rs))
			{
				//二重审核
				if(($rs->password==$password)&&($rs->username==$username))
				{
					if( $rs->password == 1 )
					{
						json_form_no('您的账号暂时无法登录,详情可电话咨询!');
					}
					//登录成功,记录所需的信息
					$data['logid'] = $rs->id;
					$data['username'] = $rs->username;
					$this->session->set_userdata("user_power",$data);
					json_form_yes('登录成功!');
				}
			}
		}
		json_form_no('登录失败!');
	}
	
	//注册
	function do_reg()
	{
		//获取数据
		$nicename = $this->input->post("nicename");
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$email    = $this->input->post("email");
		$tel      = $this->input->post("tel");
		$mobile   = $this->input->post("mobile");
		
		//检测数据是否符合要求
		if( empty($nicename) )
		{
			json_form_alt("请填写称呼!");
		}
		if( empty($username) )
		{
			json_form_alt("请填写用户名!");
		}
		if( $this->is_reg($username)==false )
		{
			json_form_alt("这个用户名已经被注册了!");
		}
		if( empty($password) )
		{
			json_form_alt("请填写密码!");
		}
		if( empty($email) )
		{
			json_form_alt("请填写邮箱!");
		}
		if( empty($mobile) )
		{
			json_form_alt("请填写手机!");
		}

		//生成语句数组
		$data = array(
			  'nicename' => $nicename,
			  'username' => $username,
			  'password' => pass_user($password),
			  'email' => $email,
			  'tel' => $tel,
			  'mobile' => $mobile,
			  'regtime' => dateTime(),
			  'regip' => ip()
			  );
		
		//执行添加
		if( $this->db->insert('users',$data) )
		{
			json_form_yes("恭喜您!注册成功!"); 
		}
		else
		{
			json_form_no("很遗憾!注册可能失败!");
		}
	}
	
	//注销登录
	function out()
	{
		$this->session->unset_userdata('user_power');
		redirect('/index', 'refresh');
	}
	
	//验证手机号是否已经被注册
	function is_reg($username='')
	{
		if( !empty($username) )
		{
			$this->db->from('users');
			$this->db->where('username',$username);
			if( $this->db->count_all_results()<=0)
			{
				return true;
			}
		}
		return false;
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */