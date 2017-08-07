<?php
class Banner_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	//切换是否选项的状态
	function check_change($id=0,$cmd='ok',$val=0)
	{
	    $this->db->set($cmd,$val);
    	$this->db->where('id',$id);
    	return $this->db->update('banner');
	}

	
	//返回文章内容详情
	function view($id='',$ok='')
	{
	    $this->db->select('*');
    	$this->db->from('banner');
		if($id!=0&&!empty($id)&&is_num($id)){ $this->db->where('id',$id); }
		if(!empty($ok)&&is_num($ok)){ $this->db->where('ok',$ok); }
    	$this->db->limit(1);
    	return $this->db->get()->row();
	}
	
	
	//删除文章内容
	function del($id)
	{
    	$this->db->where('id', $id);
    	return $this->db->delete('banner'); 
	}

}
?>