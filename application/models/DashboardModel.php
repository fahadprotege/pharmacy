<?php
class DashboardModel extends CI_Model{

	function get_all_product(){
		$this->db->select('products.*,categories.name as cat_name');
        $this->db->join('categories','categories.id=products.cat_id');
        $this->db->from('products');
        $query = $this->db->get();
		return $query->result();
	}
	
}