<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('master_model');
		$this->data['yousee_website'] = $this->master_model->get_defaults('yousee_website');
    }

	public function index()
	{
		$this->data['title']='Home';
		$this->load->view('templates/header' , $this->data);
		$this->data['equipment_type'] = $this->master_model->get_data('equipment_type');
		$this->data['equipment_category'] = $this->master_model->get_data('equipment_category');
		$this->data['location'] = $this->master_model->get_data('location');
		$this->data['donor_parties'] = $this->master_model->get_parties_by_party_type('donor_party');
		$this->data['procured_by_parties'] = $this->master_model->get_parties_by_party_type('procured_by_party');
		$this->data['supplier_parties'] = $this->master_model->get_parties_by_party_type('supplier_party');
		$this->data['manufactured_parties'] = $this->master_model->get_parties_by_party_type('manufactured_party');
		$this->load->view('home', $this->data);
		$this->load->view('templates/footer' ,$this->data);
	}
}
