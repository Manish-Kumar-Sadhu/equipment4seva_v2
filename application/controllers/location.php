<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {

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

    function add() {
        if($this->session->userdata('logged_in')){
			$add_location_access=0; 
			foreach($this->data['functions'] as $f){
				if($f->user_function=="location"){ 
					if($f->add)
						$add_location_access=1;  	
				}	
			}
			if($add_location_access){
				$this->load->helper('form');
				$this->load->library('form_validation');
				$this->data['title']='Add location';
				$this->load->view('templates/header' , $this->data);
				$this->data['district'] = $this->master_model->get_data('district');
				$this->data['state'] = $this->master_model->get_data('state');
				$this->form_validation->set_rules('location','location','required');
				if ($this->form_validation->run() === FALSE) {
					$this->load->view('pages/add_location',$this->data);
				} else {
					if($this->master_model->add_location()){
						$this->data['status']=200;
						$this->data['msg']="Location added successfully";
						$this->load->view('pages/add_location',$this->data);
					} else {
						$this->data['status']=500;
						$this->data['msg']="Error adding location. Please retry.";
						$this->load->view('pages/add_location',$this->data);
					}
				}
				$this->load->view('templates/footer' ,$this->data);
			} else {
				show_404();	
			}
		} else{
			show_404();
		}
    }
}
