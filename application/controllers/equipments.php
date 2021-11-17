<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipments extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('master_model');
		$this->data['yousee_website'] = $this->master_model->get_defaults('yousee_website');
    }

    function index($equipment_id){
        $this->data['title']='Equipment';
		$this->load->view('templates/header' , $this->data);
        $this->data['equipment'] = $this->master_model->get_equipment_by_id($equipment_id);
        $this->load->view('equipment', $this->data);
		$this->load->view('templates/footer' ,$this->data);
    }

    function create(){
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

        $this->load->view('add_equipment', $this->data);
		$this->load->view('templates/footer' ,$this->data);
    }
}