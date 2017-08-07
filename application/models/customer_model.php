<?php
class Customer_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	
	//返回详情
	function view($id=0)
	{
	    $this->db->select('*');
    	$this->db->from('customer');
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
	
	//返回分类
	function get_types($type_ids=0)
	{
		$data = NULL;
		if(is_num($type_ids))
		{
	    $this->db->select('*');
    	$this->db->from('customer_type');
		$this->db->where('type_ids',$type_ids);
    	$this->db->order_by('type_order_id','desc');
    	$this->db->order_by('type_id','desc');
		$rs = $this->db->get();
		if(!empty( $rs )){
			$data = $rs->result();
		}
		}
		return $data;
	}
	
	//返回分类
	function get_type($type_id)
	{
	    $this->db->select('*');
    	$this->db->from('customer_type');
    	$this->db->where('type_id',$type_id);
    	return $this->db->get()->row();
	}

	//返回大小分类
	function get_type_arr($type_id=0)
	{
		$data['typeB_id'] = 0;
		$data['typeS_id'] = 0;
		$types = $this->get_type( $type_id );
		if( !empty($types) )
		{
			$typeB_id = $types->type_ids;
			if( is_num( $typeB_id ) && $typeB_id > 0 ){
				$data['typeB_id'] = $typeB_id;
				$data['typeS_id'] = $type_id;
			}else{
				$data['typeB_id'] = $type_id;
			}
		}
		return $data;
	}
	
	//返回分类数目
	function get_types_num()
	{
		$this->db->where('type_ids',0);
    	return $this->db->count_all_results('products_type');
	}
	
	function types_box($type_ids=0)
	{
		$box = '';
		$rs = $this->get_types( $type_ids );
		if(!empty($rs))
		{
			foreach($rs as $item)
			{
				$box[] = array(
					   'type_id' => $item->type_id,
					   'type_title' => $item->type_title,
					   'type_ids' => $this->types_box( $item->type_id )
				);
			}
		}
		return $box;
	}
	
	//切换是否选项的状态
	function check_change($id=0,$cmd='ok',$val=0)
	{
	    $this->db->set($cmd,$val);
    	$this->db->where('id',$id);
    	return $this->db->update('customer');
	}

	//删除
	function del($id)
	{
    	$this->db->where('id', $id);
    	return $this->db->delete('customer'); 
	}
	
	/*删除分类*/
	function del_type($type_id)
	{
    	$this->db->where('type_id', $type_id);
    	return $this->db->delete('customer_type'); 
	}
	
	

}
?>