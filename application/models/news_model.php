<?php
class News_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	//返回分类
	function get_types($type_ids=0)
	{
	    $this->db->select('*');
    	$this->db->from('news_type');
		$this->db->where('type_ids',$type_ids);
    	$this->db->order_by('type_order_id','desc');
    	$this->db->order_by('type_id','desc');
    	return $this->db->get()->result();
	}


	//返回最新的N条
	function top_news($num=0)
	{
	    $this->db->select('*');
    	$this->db->from('news');
		$this->db->limit($num);
		$this->db->where('typeb_id',4);
    	$this->db->order_by('order_id','desc');
    	$this->db->order_by('id','desc');
    	return $this->db->get()->result();
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
	
	//返回分类数目
	function get_types_num()
	{
		$this->db->where('type_ids',0);
    	return $this->db->count_all_results('news_type');
	}

	//返回分类
	function get_type($id)
	{
	    $this->db->select('*');
    	$this->db->from('news_type');
    	$this->db->where('type_id',$id);
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
	
	//文章点击+1
	function hit($id=0)
	{
    	$this->db->set('hits', 'hits+1', FALSE);
    	$this->db->where('id', $id);
    	return $this->db->update('news_type');
	}
	
	//返回文章内容详情
	function view($id=0)
	{
	    $this->db->select('*');
    	$this->db->from('news');
    	$this->db->where('id',$id);
    	$this->db->limit(1);
    	return $this->db->get()->row();
	}
	
	
	//删除文章内容
	function del($id)
	{
    	$this->db->where('id', $id);
    	return $this->db->delete('news'); 
	}
	
	/*删除分类*/
	function del_type($type_id)
	{
    	$this->db->where('type_id', $type_id);
    	return $this->db->delete('news_type'); 
	}
	

}
?>