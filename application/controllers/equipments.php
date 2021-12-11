<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipments extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('master_model');
		if($this->session->userdata('logged_in')){
			$this->load->model('user_model');
			$this->load->model('documentation_model');
			$userdata = $this->session->userdata('logged_in');
			$user_id = $userdata['user_id'];
			$this->data['functions']=$this->user_model->user_function($user_id);
			$this->data['user_parties']=$this->user_model->user_parties($user_id);
			$user_party_ids =[];
			foreach ($this->data['user_parties'] as $key => $value) {
				array_push($user_party_ids, $value->party_id);
			}
			$this->data['user_party_ids'] = $user_party_ids;
		}
		$this->data['yousee_website'] = $this->master_model->get_defaults('yousee_website');
    }

	public function index(){
		$this->data['title']='Equipments';
		$this->load->view('templates/header' , $this->data);
		$this->data['pagination'] = $this->master_model->get_defaults('pagination');
		$this->data['equipment_type'] = $this->master_model->get_data('equipment_type');
		$this->data['equipment_category'] = $this->master_model->get_data('equipment_category');
		$this->data['location'] = $this->master_model->get_data('location');
		$this->data['donor_parties'] = $this->master_model->get_parties_by_party_type('donor_party');
		$this->data['procured_by_parties'] = $this->master_model->get_parties_by_party_type('procured_by_party');
		$this->data['supplier_parties'] = $this->master_model->get_parties_by_party_type('supplier_party');
		$this->data['manufactured_parties'] = $this->master_model->get_parties_by_party_type('manufactured_party');
		$equipment_data = $this->master_model->get_equipment_data($this->data['pagination']->value);
		foreach ($equipment_data as $key => $value) {
			$location = $this->master_model->get_equipment_current_location($value->equipment_id);
			$value->location = $location ? $location->location : '------';
			$value->state = $location ? $location->state : '';
			$value->district = $location ? $location->district : '';
		}
		$this->data['equipment_data']=$equipment_data;
		$this->data['equipment_count'] = $this->master_model->get_equipment_count();
		$this->data['edit_equipment_access']=0;
		$this->data['view_equipment_access']=0;
		$this->data['remove_equipment_access']=0;
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
		}
		$this->load->view('equipments', $this->data);
		$this->load->view('templates/footer' ,$this->data);
	}

	function view($equipment_id){
		$this->data['title']='Equipment';
		$this->load->view('templates/header', $this->data);
		$this->data['equipment_type'] = $this->master_model->get_data('equipment_type');
		$this->data['equipment_category'] = $this->master_model->get_data('equipment_category');
		$this->data['location'] = $this->master_model->get_data('location');
		$this->data['equipment_procurement_type'] = $this->master_model->get_data('equipment_procurement_type');
		$this->data['equipment_procurement_status'] = $this->master_model->get_data('equipment_procurement_status');
		$this->data['equipment_functional_status'] = $this->master_model->get_data('equipment_functional_status');
		$this->data['equipment_location_history'] = $this->master_model->get_equipment_location_history($equipment_id);
		$this->data['district'] = $this->master_model->get_data('district');
		$this->data['journal_type'] = $this->master_model->get_data('journal_type');
		$this->data['party'] = $this->master_model->get_data('party');
        $this->data['equipment'] = $this->master_model->get_equipment_by_id($equipment_id);
        $this->data['equipment_location_data'] = $this->master_model->get_equipment_current_location($equipment_id);
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
				$this->data['procured_by_parties'] = $this->master_model->get_parties_of_user();
				$this->data['equipment_procurement_type'] = $this->master_model->get_data('equipment_procurement_type');
				$this->data['equipment_procurement_status'] = $this->master_model->get_data('equipment_procurement_status');
				$this->data['equipment_functional_status'] = $this->master_model->get_data('equipment_functional_status');
				$this->data['journal_type'] = $this->master_model->get_data('journal_type');
				$this->form_validation->set_rules('equipment_name','equipment_name','required');
				if ($this->form_validation->run() === FALSE) {
					$this->load->view('add_equipment',$this->data);
				} else {
					if($this->master_model->add_equipment()){
						$this->data['status']=200;
						$this->data['msg']="Equipment added successfully";
						$this->load->view('add_equipment',$this->data);
					} else {
						$this->data['status']=500;
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
			$equipment = $this->master_model->get_equipment_by_id($equipment_id);
			$edit_equipment_access=0;
			$add_equipment_location=0;
			$add_equipment_document=0;
			$delete_equipment_document=0;
			foreach($this->data['functions'] as $f){
				if($f->user_function=="equipment"){ 
					if($f->edit && in_array($equipment->procured_by_party_id, $this->data['user_party_ids']))
						$edit_equipment_access=1;  	
				}	
				if($f->user_function=="equipment_location"){ 
					if($f->add)
						$add_equipment_location=1;  	
				}	
				if($f->user_function=="equipment_document"){ 
					if($f->add)
						$add_equipment_document=1; 
					if($f->remove && in_array($equipment->procured_by_party_id, $this->data['user_party_ids']) )
						$delete_equipment_document=1; 
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
				$this->data['equipment_document_type'] = $this->master_model->get_data('equipment_document_type');
				$this->data['locations'] = $this->master_model->get_data('location');
				$this->data['party'] = $this->master_model->get_data('party');
				$this->data['procured_by_parties'] = $this->master_model->get_parties_of_user();
				$this->data['equipment_procurement_type'] = $this->master_model->get_data('equipment_procurement_type');
				$this->data['equipment_procurement_status'] = $this->master_model->get_data('equipment_procurement_status');
				$this->data['equipment_functional_status'] = $this->master_model->get_data('equipment_functional_status');
				$this->data['equipment_location_history'] = $this->master_model->get_equipment_location_history($equipment_id);
				$this->data['equipment_documents'] = $this->documentation_model->get_documents_by_equipment_id($equipment_id);
				$this->data['journal_type'] = $this->master_model->get_data('journal_type');
				$this->data['equipment'] = $this->master_model->get_equipment_by_id($equipment_id);
				$this->data['add_equipment_location'] = $add_equipment_location;
				$this->data['add_equipment_document'] = $add_equipment_document;
				$this->data['delete_equipment_document'] = $delete_equipment_document;
				// documents default constraints
				$allowed_types = $this->master_model->get_defaults('upload_allowed_types')->value;
				$max_size = $this->master_model->get_defaults('upload_max_size')->value;
				$max_width = $this->master_model->get_defaults('upload_max_width')->value;
				$max_height = $this->master_model->get_defaults('upload_max_height')->value;
				$remove_spaces = $this->master_model->get_defaults('upload_remove_spaces')->value;
				$overwrite = $this->master_model->get_defaults('upload_overwrite')->value;

				$this->data['allowed_types'] = $allowed_types;
				$this->data['max_size'] = $max_size;
				$this->data['max_width'] = $max_width;
				$this->data['max_height'] = $max_height;
				$this->data['overwrite'] = $overwrite;
				if($this->input->post('form_for')== 'update_equipment_details') {
					$this->form_validation->set_rules('equipment_name','equipment_name','required');
				} else if($this->input->post('form_for') == 'add_equipment_location_log'){
					$this->form_validation->set_rules('location','location','required');
				} else if($this->input->post('form_for')== 'upload_equipment_document') {
					$this->form_validation->set_rules('document_type','document_type','required');
				}
				if ($this->form_validation->run() == FALSE) {
					$this->load->view('edit_equipment',$this->data);
				} else {
					if($this->input->post('form_for') == 'update_equipment_details'){
						if($this->master_model->update_equipment($equipment_id)){
							$this->data['msg']="Equipment updated successfully";
							$this->data['status']=200;
							$this->data['equipment'] = $this->master_model->get_equipment_by_id($equipment_id);
							$this->data['equipment_location_history'] = $this->master_model->get_equipment_location_history($equipment_id);
							$this->data['equipment_documents'] = $this->documentation_model->get_documents_by_equipment_id($equipment_id);
							$this->load->view('edit_equipment',$this->data);
						} else {
							$this->data['msg']="Error updating equipment. Please retry.";
							$this->data['status']=500;
							$this->load->view('edit_equipment',$this->data);
						}
					} else if($this->input->post('form_for') == 'add_equipment_location_log'){
						if($this->master_model->add_equipment_location_log($equipment_id)){
							$this->data['msg']="Equipment location log added successfully";
							$this->data['status']=200;
							$this->data['equipment'] = $this->master_model->get_equipment_by_id($equipment_id);
							$this->data['equipment_location_history'] = $this->master_model->get_equipment_location_history($equipment_id);
							$this->data['equipment_documents'] = $this->documentation_model->get_documents_by_equipment_id($equipment_id);
							$this->load->view('edit_equipment',$this->data);
						} else {
							$this->data['msg']="Error adding equipment's location log. Please retry.";
							$this->data['status']=500;
							$this->load->view('edit_equipment',$this->data);
						}
					} else if($this->input->post('form_for') == 'upload_equipment_document') {
						// Set field validation rules
						$config=array(
							// array(
							// 	'field'   => 'keyword',
							// 	'label'   => 'keyword',
							// 	'rules'   => 'required|trim|xss_clean'
							// ),
							// array(
							// 	'field'   => 'topic',
							// 	'label'   => 'topic',
							// 	'rules'   => 'required|trim|xss_clean'
							// ),
							// array(
							// 	'field'   => 'document_date',
							// 	'label'   => 'document_date',
							// 	'rules'   => 'required|trim|xss_clean'
							// )		     
						);
						$this->form_validation->set_rules($config);
						if($this->form_validation->run()===FALSE){
							$this->load->view('edit_equipment',$this->data);		
						} else {
							$dir_path = './assets/equipment_documents/';
							$config['upload_path'] = $dir_path;
							$config['allowed_types'] = $allowed_types;
							$config['max_size'] = $max_size;
							$config['max_width'] = $max_width;
							$config['max_height'] = $max_height;
							$config['encrypt_name'] = FALSE;
							$config['overwrite'] = $overwrite ? TRUE : FALSE;
							$config['remove_spaces'] = $remove_spaces ? TRUE : FALSE;
							var_dump($overwrite);
							// Upload file and add document record
							$msg = "Error: ";
							$uploadOk = 1;
							$target_file = $dir_path . basename($_FILES["upload_file"]["name"]);
							$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
							if ($_FILES['upload_file']['size'] <= 0 && $uploadOk == 1) {
								$status = 500;
								$msg = $msg . "Select at least one file.";
								$uploadOk = 0;
							}
							
							// Check for upload errors
							if ($uploadOk == 0) {
								$this->data['msg']= $msg . " Your file was not uploaded.";
							} else {
								// if everything is ok, try to upload file
								$this->load->library('upload', $config);
								$this->upload->initialize($config);
								if (!$this->upload->do_upload('upload_file')) {
									$status=500;
									$msg = $msg . $this->upload->display_errors();
									$uploadOk = 0;
								} else {
									$file = $this->upload->data();
									$uploadOk = 1;
								}
							}
							
							// Add document record
							if ($uploadOk ==1 && $this->documentation_model->add_document($file['file_name'], $equipment_id)){							
								$this->data['status']=200;
								$this->data['msg']="Document Added Succesfully";
								$this->data['equipment'] = $this->master_model->get_equipment_by_id($equipment_id);
								$this->data['equipment_location_history'] = $this->master_model->get_equipment_location_history($equipment_id);
								$this->data['equipment_documents'] = $this->documentation_model->get_documents_by_equipment_id($equipment_id);
								$this->load->view('edit_equipment',$this->data);					
							}
							else {
								$this->data['status']=$status;
								$this->data['msg'] = $msg;
								$this->load->view('edit_equipment',$this->data);
							}
						}
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

	function delete_document($id){
		$this->load->helper("file");
		$document = $this->documentation_model->get_document_by_id($id);
		if($document) {
			$path_to_file = "./assets/equipment_documents/".$document->document_link;
			// deleting file from assests folder
			if(file_exists($path_to_file) && unlink($path_to_file)){
				$deleted = $this->documentation_model->delete_document($id);
				print json_encode($deleted);
			}
			// updated deleted info in equipment documents table
		}
	}
}