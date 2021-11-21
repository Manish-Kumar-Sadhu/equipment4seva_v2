<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipments extends CI_Controller {

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

    function index($equipment_id){
        $this->data['title']='Equipment';
		$this->load->view('templates/header' , $this->data);
        $this->data['equipment'] = $this->master_model->get_equipment_by_id($equipment_id);
        $this->load->view('equipment', $this->data);
		$this->load->view('templates/footer' ,$this->data);
    }

    function add(){
		if($this->session->userdata('logged_in')){
			$add_equipment_access=0; 
			foreach($this->data['functions'] as $f){
				if($f->user_function=="equipment"){ 
					if($f->add)
						$add_equipment_access=1;  	
				}	
			}
			if($add_equipment_access){
				$this->load->helper('form');
				$this->load->library('form_validation');
				$this->data['title']='Add Equipment';
				$this->load->view('templates/header' , $this->data);
				$this->data['equipment_type'] = $this->master_model->get_data('equipment_type');
				$this->data['equipment_category'] = $this->master_model->get_data('equipment_category');
				$this->data['location'] = $this->master_model->get_data('location');
				$this->data['party'] = $this->master_model->get_data('party');
				$this->data['equipment_procurement_type'] = $this->master_model->get_data('equipment_procurement_type');
				$this->data['equipment_procurement_status'] = $this->master_model->get_data('equipment_procurement_status');
				$this->data['equipment_functional_status'] = $this->master_model->get_data('equipment_functional_status');
				$this->data['journal_type'] = $this->master_model->get_data('journal_type');
				$this->form_validation->set_rules('equipment_name','equipment_name','required');
				if ($this->form_validation->run() === FALSE) {
					$this->load->view('add_equipment',$this->data);
				} else {
					if($this->master_model->add_equipment()){
						$this->data['msg']="Equipment added successfully";
						$this->load->view('add_equipment',$this->data);
					} else {
						$this->data['msg']="Error adding equipment. Please retry.";
						$this->load->view('add_equipment',$this->data);
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

	function edit($equipment_id){
		if($this->session->userdata('logged_in')){
			$edit_equipment_access=0; 
			foreach($this->data['functions'] as $f){
				if($f->user_function=="equipment"){ 
					if($f->edit)
						$edit_equipment_access=1;  	
				}	
			}
			if($edit_equipment_access){
				$this->load->helper('form');
				$this->load->library('form_validation');
				$this->data['title']='Edit Equipment';
				$this->load->view('templates/header' , $this->data);
				$this->data['equipment_id'] = $equipment_id;
				$this->data['equipment_type'] = $this->master_model->get_data('equipment_type');
				$this->data['equipment_category'] = $this->master_model->get_data('equipment_category');
				$this->data['location'] = $this->master_model->get_data('location');
				$this->data['party'] = $this->master_model->get_data('party');
				$this->data['equipment_procurement_type'] = $this->master_model->get_data('equipment_procurement_type');
				$this->data['equipment_procurement_status'] = $this->master_model->get_data('equipment_procurement_status');
				$this->data['equipment_functional_status'] = $this->master_model->get_data('equipment_functional_status');
				$this->data['journal_type'] = $this->master_model->get_data('journal_type');
				$this->data['party'] = $this->master_model->get_data('party');
				$this->data['equipment'] = $this->master_model->get_equipment_by_id($equipment_id);
				$this->form_validation->set_rules('equipment_name','equipment_name','required');
				if ($this->form_validation->run() === FALSE) {
					$this->load->view('edit_equipment',$this->data);
				} else {
					if($this->master_model->update_equipment($equipment_id)){
						$this->data['msg']="Equipment updated successfully";
						$this->data['status']=200;
						$this->data['equipment'] = $this->master_model->get_equipment_by_id($equipment_id);
						$this->load->view('edit_equipment',$this->data);
					} else {
						$this->data['msg']="Error updating equipment. Please retry.";
						$this->data['status']=500;
						$this->load->view('edit_equipment',$this->data);
					}
				}
				$this->load->view('templates/footer' ,$this->data);
			} else {
				show_404();	
			}
		}  else{
			show_404();
		}
	}
}