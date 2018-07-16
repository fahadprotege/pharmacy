<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class ProductModel extends CI_Model
{
   
	 function checkProductExist($name,$cat_id)
    {
        $this->db->select('id');

        $this->db->where('name', $name);
        $this->db->where('cat_id', $cat_id);
        $query = $this->db->get('products');

        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }
    function checkProductUpdateExist($name,$cat_id,$id)
    {
        $this->db->select('id');
 		$this->db->where('id !=',$id);
        $this->db->where('name', $name);
        $this->db->where('cat_id', $cat_id);
        $query = $this->db->get('products');

        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }

    function getCategories()
    {
        $this->db->select('categories.*');
        $this->db->from('categories');
        $query = $this->db->get();
		return $query->result();
    }
	
	function viewRecords()
    {
        $this->db->select('products.*,categories.name as cat_name');
        $this->db->join('categories','categories.id=products.cat_id');
        $this->db->from('products');
        $query = $this->db->get();
		return $query->result();
    }
	
	
	function save_product(){
		
		
		
		$exists = $this->checkProductExist($_POST["name"],$_POST["cat_id"]);
		if($exists){
			return "name_exist";
		}else{
			
			$data = array(
					'cat_id'  => $_POST["cat_id"], 
					'name'  =>$_POST["name"], 
					'sku'  => $_POST["sku"], 
					'image' => $_POST["image"],
					'price' => $_POST["price"],
				);


		
			if($this->db->insert('products',$data)){
				return 'true';
			} else {
				return 'false';
			}
		}
		
		
			
		
		
	}
	
	
	function update_product(){
		$id_edit  = $this->input->post('id_edit'); 
		$name_edit  = $this->input->post('name_edit'); 
		$cat_id_edit  = $this->input->post('cat_id_edit'); 
		$exists = $this->checkProductUpdateExist($name_edit,$cat_id_edit,$id_edit);
		if($exists){
		 echo TRUE;
		}else{
			
			if(isset($_POST['image_edit']) && !empty($_POST['image_edit']) && $_POST['image_edit'] !="undefined" && $_POST['image_edit'] !=undefined){
					
					$data = array(
						'cat_id'  => $_POST["cat_id_edit"], 
						'name'  =>$_POST["name_edit"], 
						'sku'  => $_POST["sku_edit"], 
						'image' => $_POST["image_edit"],
						'price' => $_POST["price_edit"]
					);
					$this->db->where('id', $id);
			        $result=$this->db->update('products',$data);
			        return $result;
			}else{
					$data = array(
						'cat_id'  => $_POST["cat_id_edit"], 
						'name'  =>$_POST["name_edit"], 
						'sku'  => $_POST["sku_edit"], 
						'price' => $_POST["price_edit"]
					);
					$this->db->where('id', $id_edit);
			        $result=$this->db->update('products',$data);
			        return $result;
			}
	        
    	}
    }
	
	function delete_product(){
        $id=$this->input->post('id');
        $this->db->where('id', $id);
        $result=$this->db->delete('products');
        return $result;
    }
   
}

?>