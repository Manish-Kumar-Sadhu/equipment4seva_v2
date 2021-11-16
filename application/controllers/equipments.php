<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipments extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('master_model');
		$this->data['yousee_website'] = $this->master_model->get_defaults('yousee_website');
    }

    function _remap($param) {
        $this->index($param);
    }


    function index($equipment_id){
        $this->data['title']='Equipment';
		$this->load->view('templates/header' , $this->data);
        $this->data['equipment'] = $this->master_model->get_equipment_by_id($equipment_id);
        $this->load->view('equipment', $this->data);
		$this->load->view('templates/footer' ,$this->data);
    }
}