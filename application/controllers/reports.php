<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
    
	function __construct() {
        parent::__construct();
		$this->load->model('master_model');
		if($this->session->userdata('logged_in')){
			$this->load->model('user_model');
			$this->load->model('reports_model');
			$userdata = $this->session->userdata('logged_in');
			$user_id = $userdata['user_id'];
			$this->data['functions']=$this->user_model->user_function($user_id);
			$user_parties=$this->user_model->user_parties($user_id);
			$user_party_ids =[];
			foreach ($user_parties as $key => $value) {
				array_push($user_party_ids, $value->party_id);
			}
			$this->data['user_party_ids'] = $user_party_ids;
		}
		$this->data['yousee_website'] = $this->master_model->get_defaults('yousee_website');
    }

    function summary_report(){
        if($this->session->userdata('logged_in')){
            $this->data['title']='Summary report';
            $this->load->view('templates/header' , $this->data);
			$this->data['equipment_type'] = $this->master_model->get_data('equipment_type');
			$this->data['equipment_category'] = $this->master_model->get_data('equipment_category');
			$this->data['location'] = $this->master_model->get_data('location');
			$this->data['donor_parties'] = $this->master_model->get_parties_by_party_type('donor_party');
			$this->data['procured_by_parties'] = $this->master_model->get_parties_of_user();
			$this->data['supplier_parties'] = $this->master_model->get_parties_by_party_type('supplier_party');
			$this->data['manufactured_parties'] = $this->master_model->get_parties_by_party_type('manufactured_party');
			$this->data['summary_data'] = $this->reports_model->summary_report();
            $this->load->view('summary_report', $this->data);
            $this->load->view('templates/footer' ,$this->data);
        } else {
            show_404();
        }
    }
}