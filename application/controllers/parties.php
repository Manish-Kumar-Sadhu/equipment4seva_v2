<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parties extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('master_model');
		if($this->session->userdata('logged_in')){
			$this->load->model('user_model');
			$userdata = $this->session->userdata('logged_in');
			$user_id = $userdata['user_id'];
			$this->data['functions']=$this->user_model->user_function($user_id);
			$this->data['user_parties']=$this->user_model->user_parties($user_id);
		}
		$this->data['yousee_website'] = $this->master_model->get_defaults('yousee_website');
    }

	function index(){
		if($this->session->userdata('logged_in')){
				$this->load->helper('form');
				$this->load->library('form_validation');
				$this->data['title']='My parties';
				$this->load->view('templates/header' , $this->data);
				$this->data['user_parties'] = $this->master_model->get_parties_of_user();
				$this->load->view('pages/parties', $this->data);
				$this->load->view('templates/footer' ,$this->data);
		} else{
			show_404();
		}
	}

    function add() {
        if($this->session->userdata('logged_in')){
			$add_party_access=0; 
			foreach($this->data['functions'] as $f){
				if($f->user_function=="party"){ 
					if($f->add)
						$add_party_access=1;  	
				}	
			}
			if($add_party_access){
				$this->load->helper('form');
				$this->load->library('form_validation');
				$this->data['title']='Add Party';
				$this->load->view('templates/header' , $this->data);
				$this->data['districts'] = $this->master_model->get_data('district');
				$this->data['party_types'] = $this->master_model->get_data('party_type');
				$this->form_validation->set_rules('party_name','party_name','required');
				if ($this->form_validation->run() === FALSE) {
					$this->load->view('pages/add_party',$this->data);
				} else {
					if($this->master_model->add_party()){
						$this->data['status']=200;
						$this->data['msg']="Party created successfully";
						$this->load->view('pages/add_party',$this->data);
					} else {
						$this->data['status']=500;
						$this->data['msg']="Error creating party. Please retry.";
						$this->load->view('pages/add_party',$this->data);
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