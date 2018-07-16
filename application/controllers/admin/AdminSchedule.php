<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminSchedule extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model('admin/ScheduleModel','ScheduleModel');
		
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
	
	public function ScheduleListing()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
			     redirect('admin');
        }
        else
        {
        	$data["labs"] = $this->ScheduleModel->getLabs();
			$this->load->view('admin/includes/header');
			$this->load->view('admin/includes/nav');
			$this->load->view('admin/schedule/view',$data);
			$this->load->view('admin/includes/footer');
		}
	}
	
	
	public function getScheduleData()
	{
		
		$data = $this->ScheduleModel->viewRecords();
		echo json_encode($data);
		
	}

	
	function save_schedule(){
      
        $data=$this->ScheduleModel->save_schedule();
		echo json_encode($data);
    }
	
	function update_schedule(){
        $data=$this->ScheduleModel->update_schedule();
        echo json_encode($data);
    }
	
	function delete_schedule(){
        $data=$this->ScheduleModel->delete_schedule();
        echo json_encode($data);
    }
	
	
	
		
	
	
			
	
	
	
	
	
	
	
}
