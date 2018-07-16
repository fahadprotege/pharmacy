<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class ScheduleModel extends CI_Model
{
   
    function getLabs()
    {
        $this->db->select('labs.*');
        $this->db->from('labs');
        $query = $this->db->get();
		return $query->result();
    }
	 function checkScheduleExist($days,$lab_id)
    {
      	$found = false;
    	foreach ($days as $key => $day) {
			$this->db->select('schedules_days.*');
	        $this->db->where('days',$day);
	        $this->db->where('lab_id', $lab_id);
	        $this->db->join('schedules','schedules.id=schedules_days.schedule_id');
	        $query = $this->db->get('schedules_days');

	        if ($query->num_rows() > 0){
	            $found = true;
	        }
		}
		return $found;
       
    }
     function checkUpdateScheduleExist($days,$lab_id,$schedule_id)
    {
    	$found = false;
    	foreach ($days as $key => $day) {
			$this->db->select('schedule_id');
	 		$this->db->where('schedule_id !=', $schedule_id);
	        $this->db->where('days',$day);
	        $this->db->where('lab_id', $lab_id);
	        $this->db->join('schedules','schedules.id=schedules_days.schedule_id');
	        $query = $this->db->get('schedules_days');

	        if ($query->num_rows() > 0){
	             $found = true;
	        } 
		}
		return $found;
    }
	
	function viewRecords()
    {
        $this->db->select('schedules.*,labs.*');
        $this->db->join('labs','labs.id=schedules.lab_id');
        $this->db->from('schedules');
        $query = $this->db->get();
		return $query->result();
    }
	
	
	function save_schedule(){
		$days = $this->input->post('days');
		$lab_id = $this->input->post('lab_id');
		$exists = $this->checkScheduleExist($days,$lab_id);
		if(false){
			return "days_exist";
		}else{
			$this->db->insert('schedules',array('lab_id'=>$lab_id));
			$schedule_id = $this->db->insert_id();
			foreach ($days as $key => $day) {
				$data = array(
					'schedule_id'  =>$schedule_id, 
					'days'  => $day, 
					'opening_time'  => $this->input->post('opening_time'), 
					'closing_time'  => $this->input->post('closing_time')
				);
				$this->db->insert('schedules_days',$data);	
			}
			return 'true';
		}
	}

	function update_schedule(){
		
		$schedule_id  = $this->input->post('schedule_id_edit');
		$days = $this->input->post('days_edit');
		$lab_id = $this->input->post('lab_id_edit');
		$exists = $this->checkUpdateScheduleExist($days,$lab_id,$schedule_id);
		if($exists){
			return "days_exist";
		}else{
			$opening_time  = $this->input->post('opening_time_edit');
			$closing_time  = $this->input->post('closing_time_edit');
	        $this->db->where('schedule_id', $schedule_id);
	        $result=$this->db->delete('schedules_days');
	        if($result){
	        	$this->db->where('id', $schedule_id);
	    		$result2 = $this->db->update('schedules', array('lab_id' =>$lab_id));
	    		if($result2){
	    			foreach ($days as $key => $day) {
		    			$data = array(
						'days'  => $day, 
						'schedule_id'  => $schedule_id, 
						'opening_time'  => $opening_time, 
						'closing_time'  => $closing_time, 
						);
						$this->db->insert('schedules_days',$data);
					}
					return 'true';
	    		}else{
					return 'false';
	    		}
	      	}
    	}
    }

	function delete_schedule(){
		$schedule_id=$this->input->post('schedule_id');
        $this->db->where('schedule_id', $schedule_id);
        $result=$this->db->delete('schedules_days');
        if($result){
	        $this->db->where('id', $schedule_id);
	        $result2=$this->db->delete('schedules');
	        return $result2;
        }

        
    }
   
}

?>