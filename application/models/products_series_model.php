<?php
class Products_series_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function lists()
	{
	    $this->db->select('*');
    	$this->db->from('products_series');
		$this->db->order_by('order_id','desc');
		$this->db->order_by('id','desc');
    	return $this->db->get()->result();
	}

	function view($id=0)
	{
	    $this->db->select('*');
    	$this->db->from('products_series');
		if( $id )
		{
			$this->db->where('id',$id);
		}
		$this->db->order_by('order_id','desc');
		$this->db->order_by('id','desc');
    	$this->db->limit(1);
    	return $this->db->get()->row();
	}

	function del($id)
	{
    	$this->db->where('id', $id);
    	return $this->db->delete('products_series'); 
	}

}
?>