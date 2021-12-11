<?php
class documentation_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function add_document($filename, $equipment_id){
		$data = array(
			'equipment_id'=>$equipment_id,
			'document_date'=>$this->input->post('document_date'),
			'document_type_id'=>$this->input->post('document_type'),
			'note'=>$this->input->post('note'),
			'document_link' => $filename,
			'created_by'=>$this->session->userdata('logged_in')['user_id']
		);

		$this->db->trans_start(); //Transaction begins
        $this->db->insert('equipment_documents',$data); //Insert 
        $this->db->trans_complete(); //Transaction Ends
		if($this->db->trans_status()===TRUE) return true; else return false; //if transaction completed successfully return true, else false.
	}
    
}