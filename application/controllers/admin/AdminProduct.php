<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminProduct extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model('admin/ProductModel','ProductModel');
		
    }
	
	
	


	public function index()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
			     redirect('admin');
        }
        else
        {
            $data['content']	 = 'admin/dashboard';
			$this->load->view('admin/template/index',$data);
			
        }
	}
	
	public function productListing()
	{
		$data["categories"] = $this->ProductModel->getCategories();
		$this->load->view('admin/includes/header');
		$this->load->view('admin/includes/nav');
		$this->load->view('admin/product/view',$data);
		$this->load->view('admin/includes/footer');
	}
	
	
	public function getProductData()
	{
		
		$data = $this->ProductModel->viewRecords();
		echo json_encode($data);
		
	}

	
	function save_product(){

		if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
             $uploadPath = 'uploads/products/';
             $config['upload_path'] = $uploadPath;
             $config['allowed_types']    = 'jpg|png';
		     $config['max_size']         = 2048;
		     $config['max_width']        = 5000;
		     $config['max_height']       = 5000;
		     $config['file_ext_tolower'] = true;
		     $config['encrypt_name']     = true;   
            
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if($this->upload->do_upload('image')){
            	$fileData = $this->upload->data();
            	$_POST['image'] =$fileData['file_name'];
	        	$data=$this->ProductModel->save_product();
	     		echo json_encode($data);
            }
        }
	 }
	    
	
	function update_product(){
		if(isset($_FILES['image_edit']['name']) && !empty($_FILES['image_edit']['name'])){
             $uploadPath = 'uploads/products/';
             $config['upload_path'] = $uploadPath;
             $config['allowed_types']    = 'jpg|png';
		     $config['max_size']         = 2048;
		     $config['max_width']        = 5000;
		     $config['max_height']       = 5000;
		     $config['file_ext_tolower'] = true;
		     $config['encrypt_name']     = true;   
            
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if($this->upload->do_upload('image_edit')){
            	$fileData = $this->upload->data();
            	$_POST['image_edit'] =$fileData['file_name'];
	        	$data=$this->ProductModel->update_product();
        		echo json_encode($data);
            }
        }else{
        	$data=$this->ProductModel->update_product();
        	echo json_encode($data);
        }
        
    }
	
	function delete_product(){
        $data=$this->ProductModel->delete_product();
        echo json_encode($data);
    }
	
	
	
		
	
	
			
	
	
	
	
	
	
	
}
