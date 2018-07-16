<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('DashboardModel');
		$this->load->database();
		$this->load->helper('url');

	}

	
	public function index()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
        	 $data['data']=$this->DashboardModel->get_all_product();
			 $this->load->view('home',$data);
        }
        else
        {
        	$role_id = $this->session->userdata('role_id');
        	if($role_id == '1'){
				redirect('admin');
        	}else{
				redirect('user');
        	}
			
        }
	}
	function add_to_cart(){ 
		$data = array(
			'id' => $this->input->post('product_id'), 
			'name' => $this->input->post('product_name'), 
			'price' => $this->input->post('product_price'), 
			'qty' => $this->input->post('quantity'), 
		);
		$this->cart->insert($data);
		echo $this->show_cart(); 
	}

	function show_cart(){ 
		$output = '';
		$no = 0;
		foreach ($this->cart->contents() as $items) {
			$no++;
			$output .='
				<tr>
					<td>'.$items['name'].'</td>
					<td>'.number_format($items['price']).'</td>
					<td><input type="number"  name="row_'.$items['rowid'].'" class="update_qty" id="'.$items['rowid'].'" value="'.$items['qty'].'" ></td>
					<td>'.number_format($items['subtotal']).'</td>
					<td><button type="button" id="'.$items['rowid'].'" class="romove_cart btn btn-default btn-sm">X</button></td>
					
				</tr>
			';
		}
		$output .= '
			<tr>
				<th colspan="3">Total</th>
				<th colspan="2">'.'Rp '.number_format($this->cart->total()).'</th>
			</tr>
		';
		return $output;
	}

	function load_cart(){ 
		echo $this->show_cart();
	}
	
	function cart(){ 
		 $this->load->view('cart');
	}
	
	function update_cart(){ 
	$data = array(
			'rowid' => $this->input->post('row_id'), 
			'qty' => $this->input->post('update_qty'),  
		);
		$this->cart->update($data);
		echo $this->show_cart();
	}
	function cart_count(){ 
		$data =count($this->cart->contents());
		echo json_encode($data);
	}
	

	function delete_cart(){ 
		$data = array(
			'rowid' => $this->input->post('row_id'), 
			'qty' => 0, 
		);
		$this->cart->update($data);
		echo $this->show_cart();
	}
	

	

}
