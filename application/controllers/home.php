<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('master_model');
		if($this->session->userdata('logged_in')){
			$userdata = $this->session->userdata('logged_in');
			$user_id = $userdata['user_id'];
			$this->data['functions']=$this->master_model->user_function($user_id);
		}
		$this->data['yousee_website'] = $this->master_model->get_defaults('yousee_website');
    }

	public function index()
	{
		$this->data['title']='Home';
		$this->load->view('templates/header' , $this->data);
		$this->data['pagination'] = $this->master_model->get_defaults('pagination');
		$this->data['equipment_type'] = $this->master_model->get_data('equipment_type');
		$this->data['equipment_category'] = $this->master_model->get_data('equipment_category');
		$this->data['location'] = $this->master_model->get_data('location');
		$this->data['donor_parties'] = $this->master_model->get_parties_by_party_type('donor_party');
		$this->data['procured_by_parties'] = $this->master_model->get_parties_by_party_type('procured_by_party');
		$this->data['supplier_parties'] = $this->master_model->get_parties_by_party_type('supplier_party');
		$this->data['manufactured_parties'] = $this->master_model->get_parties_by_party_type('manufactured_party');
		$this->data['equipment_data'] = $this->master_model->get_equipment_data($this->data['pagination']->value);
		$this->data['equipment_count'] = $this->master_model->get_equipment_count();
		if($this->session->userdata('logged_in')){
			foreach($this->data['functions'] as $f){
				if($f->user_function=="equipment"){ 
					if($f->edit)
						$this->data['edit_equipment_access']=1;                
					if($f->view)
						$this->data['view_equipment_access']=1;                
					if($f->remove){
						$this->data['remove_equipment_access']=1;                
					}
				}
			}
		} else {
			$this->data['edit_equipment_access']=0;
			$this->data['view_equipment_access']=0;
			$this->data['remove_equipment_access']=0;
		}
		$this->load->view('home', $this->data);
		$this->load->view('templates/footer' ,$this->data);
	}

	public function login(){
		$this->load->helper('form');
		if($this->session->userdata('logged_in')){
			$this->data['title']="Home";
			$this->load->view('templates/header' , $this->data);
			// $this->load->view('admin/admin_functions' , $this->data);
		}
		else {
			if(!$this->session->userdata('logged_in')){
				$this->data['title']="Login";
				$this->load->view('templates/header',$this->data);
				$this->load->helper('form');
				$this->load->library('form_validation');				
				$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
				$login = 0;
				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('user/login');
				}
				else{
					$login = 1;
				}
				if($this->input->post('username') && $this->input->post('username')!=""){
					$this->user_model->save_user_signin($this->input->post('username'), $login);
				}
				if($login==1){
					redirect('home', 'refresh');	
				}	
			}
			else {
				redirect('home','refresh');
			}
		}
		$this->load->view('templates/footer');		
	}

	function check_database($password){
		$this->load->model('user_model');
		//Field validation succeeded.  Validate against database
		$username = $this->input->post('username');
		$result = $this->user_model->login($username, $password);
		if($result) {
			$sess_array = array(
				'user_id' => $result->user_id,
				'username' => $result->username,
				'email'=>$result->email,
				'default_party_id'=>$result->default_party_id
				);
			$this->session->set_userdata('logged_in', $sess_array);
			return TRUE;
		} else {
			$this->form_validation->set_message('check_database','Invalid Username or Password');
	     return false;
		}
	}

	function logout(){
	   $this->session->sess_destroy();
	   redirect('home', 'refresh');
	 }

}
