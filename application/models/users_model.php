<?php
class Users_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	
	//返回详情
	function view($id=0)
	{
	    $this->db->select('*');
    	$this->db->from('users');
    	$this->db->where('id',$id);
    	$this->db->limit(1);
    	return $this->db->get()->row();
	}
	
	//用户登录信息
	function login_history($uid=0)
	{
	    $this->db->select('*');
    	$this->db->from('login_history');
    	$this->db->where('uid',$uid);
		$this->db->order_by('id','desc');
    	return $this->db->getSQL();
	}
	
	//切换是否选项的状态
	function check_change($id=0,$cmd='ok',$val=0)
	{
	    $this->db->set($cmd,$val);
    	$this->db->where('id',$id);
    	return $this->db->update('users');
	}

	//删除
	function del($id)
	{
    	$this->db->where('id', $id);
    	return $this->db->delete('users'); 
	}

}
?>